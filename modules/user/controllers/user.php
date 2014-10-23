<?php
/**
 * User controller
 * 
 * @package mojo
 * @subpackage user
 */
class User_Controller extends Controller {
	private $bkt_email = "bkt-support@ukr.net";
	
	public function _send_online_reg_email($user,$discount,$curs,$group){
		
		
		$email = new View("online_email");
		$email->user = $user;
		$email->curs = $curs;
		$email->group = $group;
		$email->discount = $discount;
		$subject = "Онлайн реєстрація";
		email::send(
			$this->bkt_email,
			Kohana::config('config.site_email'),
			$subject,
			$email->render(),
			TRUE
		);
		
		
	}
	
	
	function onine_reg(){
		$data = $_POST;
		$user = ORM::factory("online");
		foreach ($data as $k=>$v){
			$user->$k = $v;
		}
		$user->save();
		cookie::set("online_reg",$user->id);
		$discount = 0;
		if($data["disc_code"]!=""){
			$cupon = ORM::factory("cupon")->where("number",$data['disc_code'])->find();
			if($cupon->id!=0){
				if($cupon->many_use==0 && $cupon->use_count < 1 || $cupon->many_use==1){
					$cupon->use_count++;
					$cupon->save();
					$discount = $cupon->discount;
					$json = array("status"=>true,"msg"=>Kohana::lang("all.reg_complite")." ".Kohana::lang("all.discount_posible").$cupon->discount."%","discount"=>true);
				}
				else{
					$json = array("status"=>true,"msg"=>Kohana::lang("all.reg_complite")." ".Kohana::lang("all.discount_imposible"),"discount"=>true);
				}
			}
			else {
				$json = array("status"=>true,"msg"=>Kohana::lang("all.reg_complite")." ".Kohana::lang("all.discount_imposible_cupon_bad"),"discount"=>true);
			}
		}
		else{
			$json = array("status"=>true,"msg"=>Kohana::lang("all.reg_complite"),"discount"=>false);
		}
		echo json_encode($json);
		$course = Database::instance()->from("courses_langs")->select("name")->where("course_id",$user->course_id)->get()->current()->name ;
		$dec = $user->is_group=="on" ? " ГРУПОВИЙ, группа:".$user->group : " ";
		$dis = $discount > 0 ? "" : "Знижка ".$discount."%";
		$group = $this->input->post("group","",true);
		$this->_send_sms('ONLINE REG',$user->name." ".$user->phone." ".$user->email." ".$course.$dec." ".$dis);
		$this->_send_online_reg_email($user,$discount,$course,$group);
	}
	
	function __construct(){
	     parent::__construct();
	}
		
	public function register(){
		//$p = new Profiler;
		if($this->logged_in){
			url::redirect("/user/profile/", 301);
			exit;
		}
		
		$reg = $this->input->post("token",null,true);

		$view = new View('register_form');
		
		javascript::add(array(
                    'jquery.validate',
                    'jquery.validate.lang/ru',

                    //'http://vkontakte.ru/js/api/openapi.js',
                    //'http://connect.facebook.net/en_US/all.js',
                    'login',
                    //'jquery.jcarousel.pack'
                    
                ));
		stylesheet::add(array(
                    //'registration'
                ));
                
		$view->hide_flow = 1;
		$view->hide_days = 1;
		$view->errors = array();
	
		$this->session = Session::instance();
		
		if(!empty($reg)){
			
			$post = Validation::factory($_POST)
				->pre_filter('trim', TRUE)
				->add_rules('username', 'required','length[3,127]')
				->add_rules('email', 'required', 'valid::email')
			    ->add_rules('phone', 'required');

                 if (!in_array($this->input->post('code'), array('vkontakte', 'facebook','twitter'))) {
                            $post->add_rules('code', 'required', 'Captcha::valid')
                                 ->add_rules('password','required','length[4,127]','matches[confirm_password]')
				 				 ->add_rules('confirm_password','required','length[4,127]','matches[password]');

                 }
			
			$post->add_callbacks('email', array($this, '_unique_email'));
			//$post->add_callbacks('username', array($this, '_unique_username'));

			$token_check = false;
			if(isset($_POST['token']) && $_POST['token'] == $this->session->get('token') ){
				$token_check = true;					      
			}

			if(!$post->validate() || !$token_check){
				$form = $post->as_array();
				$view->errors = $post->errors('registration_custom_errors');
                                
				$view->fields = $form;
				if(request::is_ajax()){
					echo json_encode(array('success'=>false, 'errors'=>$view->errors ));
					return;
				}
			} else {

				$user = ORM::factory('user');
                                $user->usertype = $post["usertype"];
                
				$user->username = $post["username"];
				$user->password = (isset($post["password"])) ? $post["password"] : "";
                                $user->facebook = $post["facebook"];
                                $user->vkontakte = $post["vkontakte"];
                                $user->twitter = $post["twitter"];
				$user->email = $post["email"];
                                $user->phone = $post["phone"];
                                $user->agency_name = $post["agency_name"];
                                $user->description = $post["description"];
				$name=($post["agency_name"]="" && $post["usertype"]!="agency")? $post["username"]: $post["agency_name"] ;
				$seo = transliterate::render($name);
				$user->seo=$seo;
				$activation = sha1(uniqid());
				$user->activation = $activation;
				$user->join_date = date('Y-m-d');
				
				$user->save(); 
				
				
				$user->activation = '';
				$user->add(ORM::factory('role', 'login'));
				$user->save();
				if($post["usertype"] == "agency")
					Database::instance()->insert('agency',array('ag_id'=>$user->id));
				 $filename=DOCROOT ."img/avatars/man_93.png";
                 MOJOUser::processAvatar($filename, $user->id,false);
                //get user picture
                if($post['picture']) {
	                $tmp_dir = '/tmp/';
	                $filename = $tmp_dir.uniqid();
	                file_put_contents($filename, file_get_contents($post['picture']));
	                MOJOUser::processAvatar($filename, $user->id);
                }
                
                


				$this->session->set('token', "");
				Auth::instance()->force_login($user);
                                $this->_send_activation_email($activation, $user->username, $user->email, 'activation_email', Kohana::lang('user.activation_subject'));
				if(request::is_ajax()){
					echo json_encode(array('success'=>true , 'user_id'=>$user->id ));
					return;
				}
				url::redirect('user/registered',301);
				
				exit;

					
			}
			
		} else {
			$view->errors = false;
			$view->fields = false;
		}
		$token = text::random($type = 'alnum', $length = 8); 
		$this->session->set('t$dataoken', $token);
		$view->token = $token;
		$view->captcha = Captcha::factory('kcaptcha')->render(true);
		$view->lang = Kohana::lang('user');
		
		$this->title .= Kohana::lang('user.register_title') . ' | ' . Kohana::config('core.site_name');
		$view->lang['title'] = $this->title;
			
		$view->render(true);
		
	}
	
	/**
	 * @param Validation $array
	 * @param unknown_type $field
	 * @return unknown_type
	 */
	public function _unique_username(Validation $array, $field){
		if(preg_match('/[^a-zA-Z0-9-_]/', $array[$field])){
			$array->add_error($field, 'username_contain_not_allowed_symbols');
		}
		
		$username_exists = (bool) ORM::factory('user')->where('username', $array[$field])->count_all();
 
		if($username_exists){
			// add error to validation object
			$array->add_error($field, 'username_exists');
		}

	}
	
	/**
	 * 
	 * @param Validation $array
	 * @param unknown_type $field
	 * @return unknown_type
	 */
	public function _unique_email(Validation $array, $field){
		
		$email_exists = (bool) ORM::factory('user')->where('email', $array[$field])->count_all();
 
		if($email_exists){
			// add error to validation object
			$array->add_error($field, 'email_exists');
		}

	}

	public function unique_email(){
            $email = $this->input->post('email');
            $email_exists = (bool) ORM::factory('user')->where('email', $email)->count_all();
            echo json_encode(!$email_exists);
	}


	/**
	 * 
	 * @param unknown_type $activation_code
	 * @param unknown_type $username
	 * @param unknown_type $user_email
	 * @param unknown_type $template_name
	 * @param unknown_type $subject
	 * @return unknown_type
	 */
	public function _send_activation_email ($activation_code, $username, $user_email, $template_name, $subject){
		
		$email = new View($template_name);
		$email->site_name = Kohana::config('config.sitename');
		$email->activation = $activation_code;
		$email->new_email = $user_email;
		$email->username = $username;
		$email->site_domain = Kohana::config('config.site_domain');
		$email->activation_subject = $subject;
		
		email::send(
			$user_email,
			Kohana::config('config.site_email'),
			$subject,
			$email->render(),
			TRUE
		);
	}
	
	/**
	 *
	 */
	public function activate(){
		
		if($this->logged_in){
			Kohana::show_404();
			exit;
		}
		
		$activation_code = $this->uri->segment(3);
		if(empty($activation_code)){
			Kohana::show_404();
		} else {
			$result = self::_activate($activation_code);
		}

		if($result){
			$_POST = null;
			// по тз переходим в профайл	
			url::redirect('user/profile/' . Auth::instance()->get_user()->username ,301);
		} else {
			//по тз показуэм 404
			Kohana::show_404();
		}
	}
	
	
	/**
	 * 
	 * @param $code
	 * @return unknown_type	 
	 */
	public function _activate($code){
		
		$user = ORM::factory('user')->where('activation',$code)->find();
		
		if(!empty($user->id)){
			$user->activation = '';			
			$user->add(ORM::factory('role', 'login'));
			$user->save();
			
			Auth::instance()->force_login($user);
			
			if(  Auth::instance()->logged_in()   ){
				$this->logged_in = true;
				$user->last_login = 0;
                $user->save();
                return true;
			}
		}
		
		return false;
	}
	
	/**
	 *
	 */
	public function registered(){
		
		if($this->logged_in){
			url::redirect("",301,"my");
			exit;
		}
		//stylesheet::add(array());
		$view = new View("registered");
		
		$_POST = null;
		
		$lang = Kohana::lang('user');
		
		$lang['registered_body'] = sprintf($lang['registered_body'], url::site("user/activate"));
		
		$view->lang = $lang;
		
		$this->title .= Kohana::lang('user.register_title') . ' ' . Kohana::config('core.site_name');
		$view->lang['title'] = $this->title;
		
		$view->render(true);
		
	}
	
	public function profile($userid = null){
            /*
            $view = new View('userpage');
            $view->render(TRUE);
            die;
             *
             */
            if (!$this->user)
                url::redirect("/user/register");
            
            if(!$userid)
                $userid = $this->user->id;
		
            // filter sql control symbols
            $userid = str_replace( array('?', '#', '%', "'"),'',$userid );
		
            $user = null;
            $allow_edit = false;

            // відкриває вікно редагування персональних даних після активації
            $editPersonal = false;
		
            if( ($this->logged_in && $this->user->id == $userid ) ){
                $user = $this->user;
                if($user->last_login == 0){
                    $editPersonal = true;
                    $user->last_login = time();
                    $user->save();
                }
                $allow_edit = true;

                // провірка на синхронізацію мікроблогінгу з твітером
                /*
                if(isset($_SESSION['oauth_token']) && isset($_SESSION['oauth_token_secret']) && isset($_REQUEST['oauth_verifier'])){
                    $consumer_key = Kohana::config('user.TWITTER_KEY');
                    $consumer_secret = Kohana::config('user.TWITTER_SECRET');
                
                    include Kohana::find_file('vendor','TwitterOAuth');
                    $connection = new TwitterOAuth($consumer_key, $consumer_secret, $_SESSION['oauth_token'], $_SESSION['oauth_token_secret']);
                    $token_credentials = $connection->getAccessToken($_REQUEST['oauth_verifier']);
                    $user->twitter_token = $token_credentials['oauth_token'];
                    $user->twitter_secret = $token_credentials['oauth_token_secret'];
                    $user->twitter_last_sync = $user->twitter_last_sync != 0 ? $user->twitter_last_sync : 0;
                    $user->save();
                }
                */
            
            } else {
                $user = ORM::factory('user', $userid);
            }
		
            // user not found, show 404
            if(empty($user->id)){
                Kohana::show_404();
                exit;
            }
            
            javascript::add(array('comments','jquery.jcarousel.pack','friendship', 'swfobject', 'jquery.uploadify.v2.1.4'));
            stylesheet::add(array('jcarousel/jquery.jcarousel','jcarousel/skin', 'uploadify'));
		

            //javascript::add('messages');
        
            //$messagesCount = ORM::factory('message')->where('user_id', $user->id)->count_all();
            //$lastMessage = ORM::factory('message')->where('user_id', $user->id)->orderby('date', 'DESC')->limit(1)->find();
        	$statistic=Statistic_Controller::getInstance();
        	$view = new View('userpage');
            $view->standart=$statistic->getStats('standart');
            $view->site=$statistic->getStats('site');
            $view->filter=$statistic->getStats('filter');
            $view->user_profile = $user;
            $view->lang = Kohana::lang('user');
            $view->allowedit = $allow_edit;
            $view->editPersonal = $editPersonal;
        
            $view->logged_in_user = $this->user;
            //$view->ads_count = ORM::factory('ads')->where('user_id', $user->id)->count_all();

            //$view->user_stat = MOJOUser::user_statistic($user->id);
            //$view->friends = MOJOUser::get_friends($user->id);

            /*
            $view->was_events_count = ORM::factory('event')
							->join('events_users','events_users.event_id','events.id')
							->where(array('events_users.user_id'=>$user->id,
										  'events.start_date <' => time(),
										  'events.status'=>1 ))
							->orderby(array('events.start_date'=>'desc'))
							->count_all();
							
            $view->will_events_count = ORM::factory('event')
							->join('events_users','events_users.event_id','events.id')
							->where(array('events_users.user_id'=>$user->id,
										  'events.start_date >' => time(),
										  'events.status'=>1))
							->orderby(array('events.start_date'=>'asc'))
							->count_all();
		
            $view->was_events = ORM::factory('event')
							->join('events_users','events_users.event_id','events.id')
							->where(array('events_users.user_id'=>$user->id,
										  'events.start_date <' => time(),
										  'events.status'=>1 ))
							->orderby(array('events.start_date'=>'desc'))
							->find_all(4); 
							
            $view->will_events = ORM::factory('event')
							->join('events_users','events_users.event_id','events.id')
							->where(array('events_users.user_id'=>$user->id,
										  'events.start_date >' => time(),
										  'events.status'=>1))
							->orderby(array('events.start_date'=>'asc'))
							->find_all(4);
            $view->random_pictures = ORM::factory('picture')
									->select('pictures.*, events.name as event_name,  events.city_custom, events.location_custom, locations.city as loc_city, locations.name as loc_name')
									->join('events', 'events.id', 'pictures.event_id','INNER')
									->join('locations', 'events.location_id', 'locations.id','LEFT')
									->join('presences', 'presences.picture_id', 'pictures.id','INNER')
									->where(array('pictures.deleted'=>0, 'presences.user_id'=>$user->id))
									->find_all(40);
									
            */
            $view->set_global('hide_flow', true);
            $view->allow_edit = $allow_edit;
            $view->active = 1;
            $view->render(true);
	} 
	
	public function agencies(){
		
		if($this->logged_in){
			$view=new View('agencies');
			$view->id=$this->user->id;
			$view->active = 4;
			$view->render(true);
		}
		else 
		url::redirect("/user/register");
	}
public function messages($new=null){
		
		if($this->logged_in){
			$view=new View('messages');
			$view->new=$new;
			$view->id=$this->user->id;
			$view->active = 3;
			$view->render(true);
		}
		else
		url::redirect("/user/register");
	}
	public function ads(){
	
		if($this->logged_in){
			$view=new View('adverts');
			if($f=$this->input->get('f'))
				$view->f=$f;
			$view->id=$this->user->id;
			$view->active = 2;
			$view->render(true);
		}
		else
		url::redirect("/user/register");
	}
	
	public function login(){
		
		if($this->logged_in){
			url::redirect("user/profile/" . $this->user->username,301);
			exit;
		}
		
		javascript::add(array(
                    'jquery.validate',
                    'jquery.validate.lang/ru',
                ));
		//stylesheet::add(array());
		
		$post = Validation::factory($_POST)->pre_filter('trim', TRUE);		
		
		$view = new View('login_form');			
		$view->hide_flow = 1;
		$view->hide_days = 1;
		//$view->message = null;
		$view->errors = array();
		
		$lang = Kohana::lang('user');
		$view->lang = $lang;

		$post->add_rules('username', 'required', 'length[3,45]')
				->add_rules('password', 'required', 'length[4,45]')
				->add_callbacks('username', array($this, 'loginCheck'));

		
		if(!$post->validate() ){	
			$view->errors = $post->errors('login_errors');	
			$view->fields = $post->as_array();			
			$view->success_login = 0;
		}	else {
			$view->success_login = 1;
					
		}
		
		if(request::is_ajax()){
			if($view->success_login){
				echo json_encode(array('success'=>true, 'user_id'=>$this->user->id));
			}else {
				echo json_encode(array('success'=>false, 'errors'=>$view->errors));
			}
			return;
		}else {
			if($view->success_login){
				url::redirect("calendar/" . Auth::instance()->get_user()->username ,301);
				return ;
			}else {
				$view->render(TRUE);
			}
		}
	}
	
	public function get_loginform(){
		
            $this->session = Session::instance();
		
            $view = new View('ajax_login_register');
            $view->errors = false;
            $view->fields = false;
            $view->captcha = Captcha::factory('kcaptcha')->render(true);
            $token = text::random($type = 'alnum', $length = 8);
            $this->session->set('token', $token);
            $view->token = $token;
        
            echo json_encode(array('succes'=>true, 'login_form'=>true , 'html'=>$view->render() ));
	}
	

	public function ajax_login(){
		
		if(!request::is_ajax() ){
			Kohana::show_404();
		}
		
		$post = Validation::factory($_POST)->pre_filter('trim', TRUE);		
		
		$post->add_rules('username', 'required', 'length[3,45]')
				->add_rules('password', 'required', 'length[4,45]')
				->add_callbacks('username', array($this, 'loginCheck'));

		if(!$post->validate() ){				
			$errors = $post->errors('login_errors');
			$err = '';
			foreach($errors as $e){
				$err .= $e . "\n";
			}	
			
			echo json_encode(array('status'=>'error', 'msg'=>$err ) );
			return;
			
		}	else {
			echo json_encode(array('status'=>'ok', 'username'=>Auth::instance()->get_user()->id ) );
			return;
		}
	} 
	

    public function twitter_baloon(){
        if($this->logged_in){
            $redirect_url = false;
            
            if(!$this->user->twitter_token && !$this->user->twitter_secret){
                $consumer_key = Kohana::config('user.TWITTER_KEY');
                $consumer_secret = Kohana::config('user.TWITTER_SECRET');
                
                include Kohana::find_file('vendor','TwitterOAuth');
                $connection = new TwitterOAuth($consumer_key, $consumer_secret);
                $temporary_credentials = $connection->getRequestToken(url::base() . 'user/' . $this->user->username . '/');
                $_SESSION['oauth_token'] = $temporary_credentials['oauth_token'];
                $_SESSION['oauth_token_secret'] = $temporary_credentials['oauth_token_secret'];
                $redirect_url = $connection->getAuthorizeURL($temporary_credentials);
            }
            
            $view = new View('twitter_baloon');
            $view->redirect_url = $redirect_url;
            $view->render(true);
        }
    }
    
    public function stopTwitterSync(){
        if($this->logged_in && request::is_ajax()){
            $this->user->twitter_token = NULL;
            $this->user->twitter_secret = NULL;
            $this->user->save();
        }
    }
    

	public function logout(){		
		Auth::instance()->logout(true);
		url::redirect("/",301);	
	}
	
	/**
	 * 
	 * @param Validation $post
	 * @return unknown_type
	 */
	public function loginCheck(Validation $post){
		$user = ORM::factory('user', $post->username);
				
		$ip = Input::instance()->ip_address();		
		
		if(empty($user->id)){
			$post->add_error('login', 'default');
		}	elseif ( !Auth::instance()->login($user, $post->password, ( !empty($post->remember_me) ? true : false ) ) ){
			$post->add_error('login', 'default');
		}
		
	}

	/**
	 * Password reminder form
	 */
	public function reminder(){

		if($this->logged_in){
			url::redirect("user/profile",301);
			exit;
		}

		$post_token = $this->input->post("token",null,true);
		$sess_token = Session::instance()->get("token",null);

		$error = "";
		$view = new View('password_reminder_form');
		$view->errors = array();
		//stylesheet::add(array());
		javascript::add(array(
                    'jquery.validate',
                    'jquery.validate.lang/ru',
                ));


                $post = Validation::factory($_POST)
                    ->pre_filter('trim', TRUE)
                    ->add_rules('remindemail', 'required', 'valid::email');
                
		if(!empty($post_token) && $post_token == $sess_token){

			$email = $post['remindemail'];//$this->input->post("remindemail",null,true);
			$user = null;

			if($post->validate()){
				$user = ORM::factory('user')->where('email',$email)->find();

				if(!empty($user->id)){
					$user->activation = sha1(uniqid());
					$user->pwd_change = 1;
					$user->save();

					$view = new View('reminder_email');
					$view->activation_code = $user->activation;
					$view->username = $user->username;
					$view->sitename = Kohana::config('config.sitename');

					email::send(
							$user->email,
							Kohana::config('config.site_email'),
							Kohana::config('config.sitename') . " / " . Kohana::lang('user.reminder_subject'),
							$view->render(),
							TRUE
					);

					$_POST = null;

                                        if(request::is_ajax()){
                                            echo json_encode(array('success' => TRUE, 'errors' => array()));
                                            return;
                                        } else {
                                            $new_view = new View('remind_send');
                                            $new_view->lang = Kohana::lang('user');
                                            $new_view->render(true);
                                        }

					// rebuild token to prevent sending dublicates
					$token = md5(uniqid()) . "==";
					Session::instance()->set("token",$token);
					exit;

				} else {
					$error = Kohana::lang('user.not_found_by');
				}

			} else {
				$error = "Укажите корректный E-Mail адрес";
			}

			if($error != ""){
				$view->errors[] = $error;
			}
		}

                if(request::is_ajax()){
                    echo json_encode(array('success' => FALSE, 'errors' => $view->errors ));
                    return;
                }


		$view->lang = Kohana::lang('user');
		$token = md5(uniqid()) . "==";
		Session::instance()->set("token",$token);

		$view->token = $token;
		$this->title .= Kohana::lang('user.password_reminder_title') . ' | ' . Kohana::config('core.site_name');
		$view->lang['title'] = $this->title;

		$view->render(true);
	}
	
	/**
	 * Password changer 
	 * should be activated from link, which was send in email on request by password reminder form
	 */
	public function remind(){
		
		if($this->logged_in){
			url::redirect("user/profile",301);
			exit;
		}
		
		$post_token = $this->input->post("token",null,true);
		$sess_token = Session::instance()->get("token",null);
		
		//stylesheet::add(array());
		javascript::add(array(
                    'jquery.validate',
                    'jquery.validate.lang/ru',
                ));
		
		if(!empty($post_token) && $post_token == $sess_token){
			
			$password = $this->input->post("password",null,true);
			$confirm_password = $this->input->post("confirm_password",null,true);
			
		
			
			if(	!empty($password) &&
				!empty($confirm_password) &&
				$password == $confirm_password	)
				 {
				
				 	$user_id = Session::instance()->get("user_id",null);
				 	$activation_remind = Session::instance()->get("activation",null);
				 	
				 	$user = ORM::factory('user')->where(array('id'=>$user_id,"activation" => $activation_remind, "pwd_change" => 1))->find();
					
					if(!empty($user->id)){
						$user->password = $password;
						$user->pwd_change = 0;
						$user->activation = '';
						$user->save();
						
						$email = new View('reminder_email_success');
						$email->username = $user->username;
						$email->sitename = Kohana::config('config.site_name');
				
						email::send(
							$user->email,
							Kohana::config('config.site_email'),
							Kohana::config('config.sitename') . " / " . Kohana::lang('user.reminder_subject'),
							$email->render(),
							TRUE
						);
				
						$_POST = null;
						Auth::instance()->force_login($user);
						$new_view = new View('remind_success');
						$new_view->lang = Kohana::lang('user');
						$new_view->logged_in = true;
						$new_view->user = $user;
						$new_view->render(true);
						exit;
						
					} else {
						$view->error = Kohana::lang('user.remind_disabled');
					}
					
			} else {
				$view->error = Kohana::lang('user.pwd_doesnt_match');
			}
			
		}
		
		$activation_remind = $this->uri->segment(3);

		if(!empty($activation_remind)){
			
			$user = ORM::factory('user')->where(array("activation" => $activation_remind, "pwd_change" => 1))->find();
			if(!empty($user->id)){
				
				$view = new View('remindpwd_form');
				$view->lang = Kohana::lang('user');
				$view->lang['title'] = $view->lang['password_change'];
				
				$token = md5(uniqid());
				$view->token = $token;
				$view->activation = $activation_remind;
				Session::instance()->set("token",$token);
				Session::instance()->set("user_id", $user->id);
				Session::instance()->set("activation", $activation_remind);
				
				$view->title = Kohana::lang('user.password_reminder_title') . ' | ' . Kohana::config('core.sitename');
				//var_dump($token);
				$view->render(true);
				
			} else {
				Kohana::show_404();
			}
		} else {
			Kohana::show_404();
		}
		
	}
	
	public function edit(){
		if(!request::is_ajax() || !$this->logged_in){
			//Kohana::show_404();
		}
		
		$lang = Kohana::lang('user');
		
		$save_data = $this->input->post('save_data',null);
		if($save_data){
			$post = array();
			$post["firstname"] = $this->input->post('firstname',null,true);
			$post["lastname"] = $this->input->post('lastname',null,true);
			$post["gender"] = $this->input->post('gender',null,true);
			$post["country"] = $this->input->post('country',null,true);
			$post["city"] = $this->input->post('city',null,true);
            $post["phone"] = $this->input->post('phone',null,true);
			$post["url"] = $this->input->post('url',null,true);
			$post["about"] = $this->input->post('about',null,true);
			
			$post["birthday"] = $this->_getBirthday( $this->input->post('birthday',null,true), $this->input->post('birthmonth',null,true), $this->input->post('birthyear',null,true) );
			
			if(!$post["firstname"] || !$post["birthday"]){
				echo json_encode(array('msg'=>'error', 'data'=>$lang['fill_all_required_fields']));
				exit;
			}
			
			$user = ORM::factory('user', $this->user->id);
			$user->firstname = $post["firstname"];
			$user->lastname = $post["lastname"];
			$user->gender	= $post["gender"];
			$user->birthday	= $post["birthday"];
			$user->country	= $post["country"];
			$user->city	= $post["city"];
            $user->phone    = $post["phone"];
			$user->url	= $post["url"];
			$user->about = $post["about"];
            $user->moderated = 0; // відправляєм на модерацію пысля змін
			
			$user->save();
			
			$post['age'] = $user->age;
			echo json_encode(array('msg'=>'ok', 'data'=>$post));
			exit;
		}
		
		$view = new View('profile_edit');
		$view->user = ORM::factory('user', $this->user->id);
		
		$view->lang = $lang;
		$view->countries = ORM::factory('city')->where('parent_id',0)->find_all();
		
		$view->cities = ORM::factory('city')->where('parent_id',0)->find_all();
		$view->render(true);
	}
	
	public function newnickname(){
		
		if(request::is_ajax()){
			
			if(!$this->logged_in){
				echo json_encode(array('msg'=>'error', 'data'=>Kohana::lang('user.you_must_login_first')));
				return;
			}
			
			$username = $this->input->post('new_username_field',null,true);

			
			if( !preg_match('/[^a-zA-Z0-9-_]/', $username) ){
				
				$username_exists = (bool) ORM::factory('user')->where('username', $username)->count_all();
 
				if($username_exists){
					echo json_encode(array('msg'=>'error', 'data'=>'Имя пользователя уже используется' )) ;
					return;
				}
				
				
				$user = ORM::factory('user', $this->user->id);
				
				$user->username = 	$username;
				$user->save();			
				echo json_encode(array('msg'=>'ok', 'username'=> $user->username )) ;
				
			}else {
				echo json_encode(array('msg'=>'error', 'data'=>'Имя пользователя содержит недопустимые символы' )) ;
			}
		}else {
			Kohana::show_404();
		}
	}
	
	public function _getBirthday($day, $month, $year){
		
		if(!intval($day) || !intval($month) || !intval($year)){
			return false;
		}
		
		$date = mktime(0,0,0,intval($month), intval($day), intval($year) );
		
		if( date('n.j.Y',$date ) != intval($month) . '.' . intval($day) . '.' . intval($year) ){
			return false;
		}
		
		return $date;
	}
	
	public function avatar(){
		$view = new View('avatar_edit');
		$view->lang = Kohana::lang('user');
		$view->render(true);
	}
	
	public function avatar_upload(){
            if(!$this->logged_in){
                $id = uniqid();
		move_uploaded_file($_FILES['Filedata']['tmp_name'], '/tmp/'.$id);
                echo $id;
                return false;
            }

            $file = '/tmp/'.$this->input->post('file');
            if(!empty($file)) {
                MOJOUser::processAvatar($file, $this->user->id);
                echo json_encode(array('msg'=>'ok', 'data'=>''));
            } else {
                echo json_encode(array('msg'=>'error', 'data'=>Kohana::lang('user.select_avatar_picture') ) );
            }
	}

	public function newemail(){
		if(request::is_ajax()){
			
			if(!$this->logged_in){
				echo json_encode(array('msg'=>'error', 'data'=>Kohana::lang('user.you_must_login_first')));
				return;
			}
			
			// starting email change procedure
			$email = $this->input->post('new_email_field', null, true);
			if( valid::email($email) ){
				$user = ORM::factory('user', $this->user->id);
				if($user->email == $email){
					echo json_encode(array('msg'=>'error', 'data'=>Kohana::lang('user.you_cant_change_to_same_email')));
					return;
				}
				
				$user->email_change = $email;
				$activation = sha1(uniqid());
				$user->activation = $activation;
				$user->save();
				$this->_send_activation_email(	$activation, 
												$user->username, 
												$user->email_change, 
												'emailchange_email', 
												Kohana::lang('user.change_email_subject'));
				
				echo json_encode(array('msg'=>'ok', 'data'=>Kohana::lang('user.email_willbe_changed_affter_confirmation')));
				return;
			}else {
				echo json_encode(array('msg'=>'error', 'data'=>Kohana::lang('registration_custom_errors.email.email')));
				return;
			}	
		}
		
		$activation_code = preg_replace('/[^a-zA-Z0-9]/','', $this->uri->segment(3) );
		if(empty($activation_code)){
			Kohana::show_404();
			return;
		}
		
		$user = ORM::factory('user')->where("email_change is not null and activation='" . $activation_code . "'")
									->find();
		
		if(!empty($user->id)){
			$user->activation = '';			
			$user->email = $user->email_change;
			$user->email_change = null;
			$user->save();
			
			Auth::instance()->force_login($user);
			url::redirect('user/profile/' . $user->username ,301);
			return;
		}
		
		// code not found
		Kohana::show_404();
	}
	
	public function newpass(){
		
		if(request::is_ajax()){
			if(!$this->logged_in){
				echo json_encode(array('msg'=>'error', 'data'=>Kohana::lang('user.you_must_login_first')));
				return;
			}
			$post = Validation::factory($_POST)
					->pre_filter('trim', TRUE)
					->add_rules('pass_curr', 'required','length[4,127]')
					->add_rules('new_password','required','length[4,127]','matches[new_password_retype]')
					->add_rules('new_password_retype','required','length[4,127]','matches[new_password]');
			
			$post->add_callbacks('pass_curr', array($this, '_compare_passwords'));
			
			if( !$post->validate() ){
				$form = $post->as_array();
				$errors = $post->errors('registration_custom_errors');
				$msg = "";
				foreach($errors as $error){
					$msg = $error . "\n";
				}			
				echo json_encode(array('msg'=>'error', 'data'=>$msg ));
				return;
			} else {
				$user = ORM::factory('user', $this->user->id);
				$user->password = $post->new_password;
				$user->save();
				echo json_encode(array('msg'=>'ok', 'data'=>Kohana::lang('user.remind_success_title') ));
				return;
			}
		}
		//Kohana::show_404();
		
	}
	
	/**
	 * Save & edit user social networks
	 *
	 */
	public function social_network(){
		if($this->logged_in){
			
			$networks = Kohana::config('social_network.networks');
			$save_data = $this->input->post('save_data',null);
			if($save_data){
				foreach($networks as $network){
					$fieldname = str_replace(".","",$network);
					$this->user->$fieldname = $this->input->post($fieldname, null, true);
				}
				
				$this->user->save();
				echo json_encode(array('msg'=>'ok', 'data'=>''));
				exit;
			}
		
			$view = new View('social_network');
			$view->networks = $networks;
			$view->lang = Kohana::lang('user');
			$view->user = $this->user;
		
			$view->render(TRUE);
		} else Kohana::show_404();
	}
	
	/**
	 *	Edit tags
	 *
	 */
	public function edit_tags(){
		if($this->logged_in){
		
			$action = $this->input->post('action',null,true);
			if($action){
				$tag = $this->input->post('tag', null, true);

				if($action == "add"){
					$this->user->tags = trim(rtrim($this->user->tags,",")) . ", " . $tag;
					$this->user->save();
					echo json_encode(array('msg'=>'ok', 'data'=> array('tag' => $tag, 'size' => MOJOTagcloud::get_user_tagsize($this->user->id, utf8::strtolower(trim($tag))))));
					exit;
				} else if($action == "delete"){
					$this->user->tags = utf8::str_ireplace($tag, '', $this->user->tags);
					$this->user->tags = utf8::str_ireplace(", ,",",",trim($this->user->tags," ,"));
					$this->user->save();
					echo json_encode(array('msg'=>'delete_ok', 'data' => ''));
					exit;
				} else Kohana::show_404();
			}
		
			$view = new View('edit_tags');
			MOJOTagcloud::build_tags_content();
			$view->lang = Kohana::lang('user');
			$view->user = $this->user;
			$view->render(TRUE);
		}
	}
    
    public function get_tags($data){
		if((request::is_ajax() and !is_array($data)) or (isset($data[1]) and $data[1] == true)){
			
			$view = new View('tags');
			$user = ORM::factory('user',is_array($data) ? $data[0] : $data);
			$view->user = $user;	
			$view->render(true);
			
		} else Kohana::show_404();
	}
	
	public function _compare_passwords(Validation $array, $field){
		
		// Get the salt from the stored password
		$salt = Auth::instance()->find_salt( $this->user->password );
	
		// Create a hashed password using the salt from the stored password
		$password = Auth::instance()->hash_password($array[$field], $salt);
		
		if($password != $this->user->password){
			// add error to validation object
			$array->add_error($field, 'default');
		}
	}
	
	public function friends($user_id){
		//$p = new Profiler();
		if(preg_match('/[^a-zA-Z0-9-_@]/', $user_id )){
			Kohana::show_404();	
		}
		
		$user = ORM::factory('user', $user_id);
		
		if(empty($user->id)){
			Kohana::show_404();
		}
		
		stylesheet::add(array('friends', 'facebox','edit_style'));
		javascript::add(array('friendship', 'facebox', 'jquery.form'));
		
		$view = new View('friends');
		
		//friend requests
		$view->friend_req = ORM::factory('friendship')
							->select("users.*")
							->join("users","users.id", "friendships.user_id", "left")
							->where(array('friendships.friend_id' => $user->id, 'friendships.status' => 1))
							->find_all();

		//all friends
		$view->friends = ORM::factory('friendship')
							->select("users.*")//, events.id as event_id, events.name as eventname")
							->join("users","users.id", "friendships.user_id", "LEFT")
							//->join('events_users', 'users.id', 'events_users.user_id','LEFT')
							//->join('events', 'events.id = events_users.event_id and  events.start_date > ' .time() , '','LEFT')
							//->groupby('users.id')
							->where(array('friendships.friend_id' => $user->id, 'friendships.status' => 2))
							->find_all();
		$user_ids = array();
		$users_vs_events = array();
		foreach($view->friends as $fr){
			$user_ids[] = $fr->id;
			$users_vs_events[$fr->id] = array('event_id'=>null, 'event_name'=>null); 	
		}
		
		//friens future events
		if(count($user_ids) > 0) {
			$events = Database::instance()->query(' SELECT e.user_id,  e.id, e.name
												FROM (SELECT e.id, e.name, eu.user_id FROM `events` e 
													INNER JOIN events_users eu ON eu.event_id = e.id
												      WHERE eu.user_id IN (' . implode(', ',$user_ids) . ') AND e.start_date > ' . time() . ' 
												      ORDER BY e.start_date ASC) AS e 
												GROUP BY user_id');
		}else {
			$events = array();
		}
		foreach($events as $ev){
			$users_vs_events[$ev->user_id] = array('event_id'=>$ev->id, 'event_name'=>$ev->name); 
		}		
		
		$view->users_vs_events = $users_vs_events;
							
							
		//online users count					
		$view->online_count = ORM::factory('friendship')
							->join("users","users.id", "friendships.user_id", "left")
							->where(array('friendships.friend_id' => $user->id, 'friendships.status' => 2, 'users.last_login < '=>time() + 60*15 ))
							->count_all();

		
		//events where most friends goes
		$view->most_events = ORM::factory('friendship')
							 ->select('events.*', 'categories.id as catid', 'categories.name as catname', 'users.username', 'events_users.type',
							 		  '(SELECT type FROM events_users WHERE user_id = 6 AND event_id = events.id )AS type')
							 ->join('events_users', 'events_users.user_id', 'friendships.friend_id','INNER')
							 ->join('events', 'events_users.event_id', 'events.id','INNER')
							 ->join('categories', 'categories.id', 'events.category_id','INNER')
							 ->join('users', 'users.id', 'events.author_id','INNER')
							 ->where( array('friendships.user_id'=>$user->id,
							 				'events.start_date >'=>time() ) )
							 ->groupby('events_users.id')
							 ->orderby('COUNT(events_users.id)','desc')
							 ->find_all(5);
		if($this->logged_in && $this->user->id == $user->id){
			$view->my_friends = true;
		}else {
			$view->my_friends = false;
		}
			
		$view->owner = $user;
		$view->render(true);
	}
	
	public function xd_receiver(){
		$view = new View('xd_receiver');
		$view->render(true);
	}
	
	public function fbregister(){
		/*
		$args = array();
		parse_str(trim($_COOKIE['fbs_' . Kohana::config('user.FACEBOOK_APP_ID')], '\\"'), $args);

		ksort($args);
		$payload = '';
		  foreach ($args as $key => $value) {
		    if ($key != 'sig') {
		      $payload .= $key . '=' . $value;
		    }
		  }
		  if (md5($payload . Kohana::config('user.FACEBOOK_SECRET')) != $args['sig']) {
		  	//coockie data is corrupted or hack attemt
		    echo json_encode(array('status'=>'fail'));
			return;
		  }
		  */
		//receive user data
		$access_token = $this->input->post('access_token', null, true);
		$uid = $this->input->post('uid', null, true);
		$fb_user = @json_decode( @file_get_contents('https://graph.facebook.com/me?access_token='. $access_token .  '&fields=id,first_name,last_name,email,locale,picture,birthday,gender&type=large') );

		if(!$fb_user){
			echo json_encode(array('status'=>'fail', 'msg'=>'cant get info from facebook server'));
			return; 
		}

		// try to find user
		$user = ORM::factory('user')->orwhere(array('facebook'=>$uid, 'email'=>$fb_user->email ))->find();
		
		if(empty($user->id)){
                    echo json_encode($fb_user);
		} else {
                    Auth::instance()->force_login($user);
                    echo json_encode(array(
                        'status' => 'registered',
                        'user_id' => $user->id
                    ));
                }
	}
	
	public function vkregister (){
		$app_cookie = null;
		$app_cookie = $_COOKIE['vk_app_' . Kohana::config('user.VK_API_ID')];
		$valid_keys = array('expire', 'mid', 'secret', 'sid', 'sig');
		$session = array();
		
		 if (!empty($app_cookie)) {
		    $session_data = explode ('&', $app_cookie, 10);
		    
		    foreach ($session_data as $pair) {
		      list($key, $value) = explode('=', $pair, 2);
		      if (empty($key) || empty($value) || !in_array($key, $valid_keys)) {
		        continue;
		      }
		      $session[$key] = $value;
		    }

		    
		    ksort($session);
		
		    $sign = '';
		    foreach ($session as $key => $value) {
		      if ($key != 'sig') {
		        $sign .= ($key.'='.$value);
		      }
		    }
		    $sign .= Kohana::config('user.VK_API_SHARED_SECRET');
		    $sign = md5($sign);
		    if ($session['sig'] == $sign && $session['expire'] > time()) {
		      $member = array(
		        'id' => intval($session['mid']),
		        'secret' => $session['secret'],
		        'sid' => $session['sid']
		      );
		    }
		  }else {
		  	echo json_encode(array('status'=>'fail', 'msg'=>'Not logged in in vkontakte'));
			return; 
		  }
	
		// try to find user
		$user = ORM::factory('user')->orwhere(array('vkontakte'=>$member['id']))->find();
					
		if(empty($user->id)){
                    $sig     =   'api_id=' . Kohana::config('user.VK_API_ID')
						.'fields=first_name,last_name,nickname,sex,bdate,city,country,timezone,photo_big' 
						.'format=JSON'
						.'method=getProfiles'
						.'uids=' . $member['id']
						.'v=2.0'
						.Kohana::config('user.VK_API_SHARED_SECRET') ;
				
                    $sig =  md5( $sig );
							
                    $url  = 'http://api.vkontakte.ru/api.php?api_id=' . Kohana::config('user.VK_API_ID')
												  . '&method=getProfiles'
												  . '&uids=' . $member['id']
												  . '&fields=first_name,last_name,nickname,sex,bdate,city,country,timezone,photo_big'   
												  . '&v=2.0'
												  . '&format=JSON'
												  . '&sig=' . $sig;
							
                    $vk_user = json_decode( file_get_contents( $url ));
			
                    if( !is_object($vk_user) || empty($vk_user->response[0])){
                        echo json_encode(array('status'=>'fail', 'msg'=>'Not logged in in vkontakte'));
						return;
                    }
			
                    $vk_user = $vk_user->response[0];

                    echo json_encode($vk_user);
		} else {
                    Auth::instance()->force_login($user);
                    echo json_encode(array(
                        'status' => 'registered',
                        'user_id' => $user->id
                    ));
                }
	}//
	
	public function twitter(){
		include Kohana::find_file('vendor','TwitterOAuth');
		$consumer_key = Kohana::config('user.TWITTER_KEY');
		$consumer_secret = Kohana::config('user.TWITTER_SECRET');
	
		
		/* If the oauth_token is old—redirect to the connect page. */
		if ( isset($_GET['oauth_token']) && $_SESSION['oauth_token'] == $_GET['oauth_token'] ) {
			
			/* Create TwitteroAuth object with app key/secret and token key/secret from default phase */
			$connection = new TwitterOAuth(
												$consumer_key,
												$consumer_secret,
												$_SESSION['oauth_token'],
												$_SESSION['oauth_token_secret']
										   );
			
			/* Request access tokens from twitter */
			$access_token = $connection->getAccessToken($_GET['oauth_verifier']);
			
			/* If HTTP response is 200 continue otherwise send to connect page to retry */
			switch ($connection->http_code) {
				case 200:
					$content = $connection->get('account/verify_credentials');
					echo "OK TwitterSetData('$content->id', '$content->name', '$content->profile_image_url') ";
					echo "<script> window.opener.TwitterSetData('$content->id', '$content->name', '$content->profile_image_url'); window.close(); </script>";
				break;
				default:
					url::redirect('/user/twitter', 302);
			}
			
			
			return ;
			
		}
		
		
		
		
		
		/**********************************************************************/
		
		
		/* Build TwitterOAuth object with client credentials. */
		$connection = new TwitterOAuth($consumer_key, $consumer_secret);
		
	    /* Get temporary credentials. */
		$request_token = $connection->getRequestToken(url::base() . 'user/twitter/');
		
		/* Save temporary credentials to session. */
		$_SESSION['oauth_token'] = $request_token['oauth_token'];
		$_SESSION['oauth_token_secret'] = $request_token['oauth_token_secret'];
		
		/* If last connection failed don't display authorization link. */
		switch ($connection->http_code) {
			case 200:
				/* Build authorize URL and redirect user to Twitter. */
				$url = $connection->getAuthorizeURL($request_token);
				header('Location: ' . $url);  // ⇐ That's why we needed a popup window
				echo "Twitter Login. Please Wait...";
				break;
			default:
				/* Immediately return if something went wrong. */
				echo "USER_AUTH_FAILED";
		}
	}
	
	
	public function twregister(){

		//receive user data
		$uid = $this->input->post('uid', null, true);
	
		// try to find user
		$user = ORM::factory('user')->orwhere( array( 'twitter'=>$uid ))->find();
	
		if(empty($user->id)){
			echo json_encode(array());
		} else {
			Auth::instance()->force_login($user);
			echo json_encode(array(
	                        'status' => 'registered',
	                        'user_id' => $user->id
			));
		}
	}
	
	public function search(){
		
		if(!$this->logged_in)
			Kohana::show_404();
		
		$pagination_config = array(
			'uri_segment'    => 'page',
			'items_per_page' => 24,
			'style'          => 'digg',
			'auto_hide'      => true
		);
				
		$pagination = Pagination::singleton($pagination_config);
			
		stylesheet::add(array('jquery-ui'));
		$fields = array();
		$error = '';
		$results = false;
		$results_count = false;
		if( !empty($_GET['dosearch'] )){
			
			// parse and filter post variables
			$fields['city'] = trim(strip_tags($this->input->get('city', null, true)));
			if( $fields['city'] == "" ){
				$fields['city'] = $this->user->city;
			}
				
			$fields['onlineselector'] = ($this->input->get('onlineselector', null, true) == 'online' ? 'online' : 'all' );
			
			$gender = intval( $this->input->get('gender', null, true) );
			if(in_array($gender, array(1,2))){
				$fields['gender'] = $gender;
			}else {
				$fields['gender'] = 0;
			}
			
			$age_min = intval( $this->input->get('age_min', null, true) );
			$age_max = intval( $this->input->get('age_max', null, true) );
			
			if(in_array($age_min , array(0, 5,18,25,30,40,50,100))){
				$fields['age_min'] = $age_min;
			}else {
				$fields['age_min'] = 0;
			}
			
			if(in_array($age_max , array(0, 5,18,25,30,40,50,100))){
				$fields['age_max'] = $age_max;
			}else {
				$fields['age_max'] = 0;
			}
			
			// for shure:
			if($fields['age_max'] < $fields['age_min']){
			   $fields['age_max'] = $fields['age_min'];
			}
			// if min is at 0, set second to 0
			if( $fields['age_min'] == 0 )
				$fields['age_max'] =0;
			
			$compilance = intval( $this->input->get('compilance', null, true) );
			if( in_array($compilance, array(0,1,2,3,4,5)) ){
				$fields['compilance'] = intval($compilance); 
			}else {
				$fields['compilance'] = 1;
			}
			
			//get user tags
			$tags = array();
			$cache = Cache::instance();
			
			foreach(explode(",",$this->user->tags) as $tag){
				$tag = trim($tag);
				if( $tag != '' ){
					$weight = floor($cache->get("tag_" . md5($tag)));
					$tags[$tag] = $weight;
				}
			}
			arsort($tags, SORT_NUMERIC );
						
			if(count($tags) > 0 || $fields['compilance'] == 0 ){
				
				//BUILDING SEARCH QUERY
				$where = array();
				
				// Online only?
				if($fields['onlineselector'] == 'online'){
					$where[] = 'users.last_login > ' . (time() - 30 * 60); // 15 min affter login
				}
				
				// Use gender?
				if($fields['gender'] > 0 ){
					$where[] = 'users.gender = ' . $fields['gender'] ; // 15 min affter login
				}
				
				//Use age?
				if($fields['age_min'] > 0){
					$where[] = 'users.birthday < ' . (strtotime('-' . $fields['age_min'] . ' years' ));
				}
				if( $fields['age_max'] > 0 && $fields['age_max'] <= 50){
					$where[] = 'users.birthday > ' . (strtotime('-' . $fields['age_max'] . ' years', mktime(0,0,0,1,1,date('Y')) ));
				}
				
				//Use City?
				if( $fields['city'] != "" ){
					$where[] = "users.city = " . Database::instance()->escape( $fields['city'] ) ;
				}
				
				
				//set compare rate if enabled
				$tags_to_compare = false;
				if($fields['compilance'] > 0){
					$tags_to_compare = array();
					$i=1;
					foreach( $tags as $tag=>$w ){
						$tags_to_compare[] = "users.tags like '$tag'";
						$i++;
						if($i > $fields['compilance'] ){
							break;
						}
					}
					
					$where[] = implode( ' and ', $tags_to_compare ) ;
				}	

				$results = ORM::factory('user')
								->where( implode(' and ' , $where) )
								->find_all($pagination->sql_limit, $pagination->sql_offset);
								
								
				$results_count = Database::instance()->count_last_query();
				$pagination->set_total_items( $results_count );
			}else {
				$error = "У вас нету ниодного тега. Пожалуста добавте минимум 5 тегов к своему профайлу чтобы искать людей с похожими тегами.";
			}
		}

		$view = new View('usersearch');
		
		//load vip
		$view->vip = ORM::factory('user')->where('vip > ', time())->find_all(4);
		$view->error = $error;
		$view->fields = $fields;
		$view->results = $results;
		$view->results_count = $results_count;
		$view->pagination = $pagination;
		$view->render(true);	
		
		
	}
	
	public function invite($invited_user = null){
		
		if(!$this->logged_in){
			Kohana::show_404();
		}
		
		$myFutureEvents = ORM::factory('event')
							->join('events_users','events_users.event_id','events.id')
							->where(array('events_users.user_id'=>$this->user->id,
										  'events.start_date >' => time(),
										  'events.status'=>1))
							->orderby(array('events.start_date'=>'asc'))
							->find_all();
		$view = new View('my_events');
		$view->events = $myFutureEvents;
		$view->invited_user = $invited_user;
		$view->render(true);
	}


	private function _false() {
            echo json_encode(array('msg'=>'fail'));
            return false;
        }
        
	public function save_profile(){
            if(!request::is_ajax() || !$this->logged_in){
                return $this->_false();
            }

            $key = $this->input->post('key');
            
			$val = $this->input->post('val');
          

            $user = ORM::factory('user', $this->user->id);
	     	if($key=="email" && $val==""){
            	echo json_encode(array('msg'=>'empty','data' => $user->$key));
            	return;
           }
            $user->$key = $val;
            $user->save();

            echo json_encode(array('msg' => 'ok', 'data' => $user->$key));
	}
	
	
	public function logged_in_card(){
	if(!$this->logged_in){
	Kohana::show_404();
	}
	
	$view = new View('logged_in_card');
	$view->ads_count = ORM::factory('ad')->where('user_id', $this->user->id )->where('active_until>='.time())->where('active', 1)->count_all();
	$view->msg_count=ORM::factory('messag')->where('date > '.$this->user->mes_read.' AND recepient='.$this->user->id.' AND new=0')->count_all(); 
	$view->render(true);
	
	}

        public function settings()
        {
            if(!$this->logged_in)
                url::redirect("/user/register");

            $view = new View('profile_settings');
            $view->mails = Database::instance()
                    ->from('mails')
                    ->where('user_id', $this->user->id)
                    ->get();

            $view->periods = Database::instance()
                    ->from('periods')
                    ->get();

            $view->active = 5;
            $view->user = $this->user;
            $view->render(TRUE);
        }

        public function unmail()
        {
            if(!$this->logged_in)
            {
                echo json_encode(array('success' => FALSE, 'errors' => 'login'));
                return FALSE;
            }
            $result = Database::instance()
                    ->delete('mails', array(
                        "id" => $this->input->post('id'),
                        "user_id" => $this->user->id
                     ));

            echo json_encode(array('success' => TRUE));

        }

        public function set_period()
        {
            if(!$this->logged_in)
            {
                echo json_encode(array('success' => FALSE, 'errors' => 'login'));
                return FALSE;
            }
            $result = Database::instance()
                    ->update('users', array(
                        "period_id" => $this->input->post('id'),
                     ), "id = ".$this->user->id);

            echo json_encode(array('success' => TRUE));

        }

}