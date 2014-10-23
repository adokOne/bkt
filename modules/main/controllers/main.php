<?php 
	class Main_Controller extends Controller{
			private $bkt_email = "bkt-support@ukr.net";
		
		public function __construct(){

			parent::__construct();
			javascript::add(array(
				"admin/jquery-1.7.2.min",
				"admin/jquery-ui-1.8.21.custom.min",
				"jquery.mvc",
				"script",
				"jquery.jNice",
				'jquery.validate'
			)); 	
			javascript::add(array(
				"controllers/front_menu_controller",
				"controllers/call_back_controller"
			));
			stylesheet::add(array("orange"));
			
			
		}



				public function price(){
			javascript::add(array(
				"admin/jquery-1.7.2.min",
				"admin/jquery-ui-1.8.21.custom.min",
				"jquery.mvc",
				"script",
				
			)); 
			
			
			stylesheet::add(array("jqueryslidemenu","form"));
			javascript::add(array(
				"controllers/front_menu_controller",
			));
			$view = new View('main');
			$view->menu = $this->_get_menu();
			$view->view_slide = false;
			Router::$site_title = Kohana::config("core.sitename")." ПРАЙС" ;
			Router::$site_description = Kohana::config("core.site_desc");
			Router::$site_keywords = Kohana::config("core.site_keyw");
			Router::$page_title = "Прайс";

			$content = new View("main_price");
	    	$data = ORM::factory('course')->where("parent_id",null)->find_all();

			$courses = array();
			foreach($data as  $course){
	            
	            $courses[] = $course->childs();

			}
			$output = array();

	        foreach($courses as $c) {

	        	if(is_array($c))
	        		$output = array_merge($output,$c);
	        	else
	        		$output[] = $c;
	        }
			$output_ = array();

	        foreach($output as $c) {

	        	if(is_array($c))
	        		$output_ = array_merge($output_,$c);
	        	else
	        		$output_[] = $c;
	        }
	        $output = array();
	        foreach($output_ as $c) {

	        	if(is_array($c))
	        		$output = array_merge($output,$c);
	        	else
	        		$output[] = $c;
	        }
			$output_ = array();

	        foreach($output as $c) {

	        	if(is_array($c))
	        		$output_ = array_merge($output_,$c);
	        	else
	        		$output_[] = $c;
	        }

	        $courses = array();
			foreach($output_ as  $course){
	            
	            $courses[$course->parent()->parent()->id][] = $course;

			}
			$content->courses = $courses;
			$prices = array();
			$content->prices = ORM::factory("price")->find_all();
			foreach($content->prices as $pr){
				$prices[$pr->course->parent_id][] = $pr;
			}
			$prices_ = array();
			foreach($prices as $k=>$v){
				$course = ORM::factory('course')->where("id",$k)->find()->parent();
				if($course->parent_id == null){
					$prices_[$course->id][] = $v;
				}
				else{
					$prices_[$course->parent()->id][] = $v;
				}
				
			}
			$content->prices = $prices_;

			Router::$page_content = $content->render(false);
			
			$view->render(true);
		}

		public function send_feedback(){
			
			$feed = ORM::factory("feedback");
			$feed->users_id = 1;
			$feed->name = trim($this->input->post("name"));
			$feed->text = mysql_escape_string($this->input->post("text"));
            $feed->email = mysql_escape_string($this->input->post("email"));
			$feed->date= date("Y-m-d H:i",time());
			$feed->save();
			echo json_encode(array("success"=>true));
			 	
		}



	private function _redirect($key){



		$_redirect_array = array(

			"97" =>  "/courses/bazovi-kompyuterni-kursy/Kompyuter-dlya-pochatkivciv",
			"74" => "/courses/kompyuterna-grafika/Adobe-Photoshop",
			"75" => "/courses/kompyuterna-grafika/Adobe-Illustrator",
			"79" => "/courses/Kompyuterna_animaciya/Adobe-Flash",
			"80" => "/courses/Kompyuterna_animaciya/ActionScript",
			"111" => "/courses/buxgalteriya/1c-7_7",
			"102" => "/courses/buxgalteriya/1c-8_2",
			"110" => "/courses/buxgalteriya/buxgalterskyj-oblik",
			"104" => "/courses/buxgalteriya/programming-1c-7_7",
			"113" => "/courses/buxgalteriya/programming-1c-8_2",
			"62" => "/courses/kompyuterna-grafika ",
			"61" => "/courses/bazovi-kompyuterni-kursy",
			"63" => "/courses/Kompyuterna_animaciya",
			"64" => "courses/programyvannya",
			"86" => "/courses/programyvannya/c-plus-plus",
			"84" => "/courses/programyvannya/c-sharp",
			"105" => "/courses/programyvannya/Java",
			"109" => "/courses/programyvannya/objective-c",
			"87" => "/courses/programyvannya/web-programming/PHP",
			"89" => "/courses/programyvannya/web-programming/Html-Css",
			"90" => "/courses/programyvannya/web-programming/JavaScript",
			"106" => "/courses/programyvannya/XML-XSLT",
			"88" => "/courses/programyvannya/MySql",
			"Kursi-dlya-ditey" => "/courses/dlya-ditej",
			"Kursi-programuvannya"=>"/courses/programyvannya/osnovy-programming",
			"Kursi-programuvannya-na-Ruby"=>"/courses/programyvannya/ruby"


			);


				if($key!==false && array_key_exists($key, $_redirect_array)){
					url::redirect($_redirect_array[$key], 301);
				}
	}


	public function thanks(){

			#
			javascript::add(array(
				"admin/jquery-1.7.2.min",
				"jquery.validate",
				"admin/jquery-ui-1.8.21.custom.min",
				"jquery.form",
				"jquery.mvc",
				"script",
				"form",
				
			)); 

			$online = ORM::factory("online")->where("id",cookie::get("online_reg"))->find();
			if($online->id == 0)
				Kohana::show_404();

			cookie::delete("online_reg");

			stylesheet::add(array("jqueryslidemenu","form"));
			javascript::add(array(
				"controllers/front_menu_controller",
			));
			$view = new View('main');
			$view->menu 	  = $this->_get_menu();
			$view->view_slide = false;
			$content = new View("thanks");
			$content->online = $online;
			Router::$site_title = "Дякуемо за звернення | ".Kohana::config("core.sitename");
			Router::$site_description = Kohana::config("core.site_desc");
			Router::$site_keywords = Kohana::config("core.site_keyw");
			Router::$page_content = $content->render(false);
			Router::$page_title = "Дякуемо за звернення";
			$view->render(true);	}


        public function feedbacks(){
			javascript::add(array(
				"admin/jquery-1.7.2.min",
				"jquery.validate",
				"admin/jquery-ui-1.8.21.custom.min",
				"jquery.form",
				"jquery.mvc",
				"script",
				"form",
				
			)); 
			
			
			stylesheet::add(array("jqueryslidemenu","form"));
			javascript::add(array(
				"controllers/front_menu_controller",
				"controllers/feedback_page_controller"
			));
			$view = new View('main');
			$view->menu 	  = $this->_get_menu();
			$view->view_slide = false;
			$content = new View("feedback_list");
			$content->feedbacks = ORM::factory('feedback')->where("parent_id",0)->orderby("date","DESC")->find_all();
			Router::$site_title = Router::$current_language ==  "ru" ? "Отзывы БКТ | Компьютерные Курсы | Курсы программирования Львов" : "Відгуки БКТ | Комп'ютерні Курси | Курси програмування Львів";
			Router::$site_description = Kohana::config("core.site_desc");
			Router::$site_keywords = Kohana::config("core.site_keyw");
			Router::$page_content = $content->render(false);
			Router::$page_title = "Відгуки";
			$view->render(true);

        }

				
		public function get_call_back_form(){
			$view = new View("call_back_from");
			$token = text::random($type = 'alnum', $length = 8); 

			Session::instance()->set('token', $token);
			$view->captcha = Captcha::factory('kcaptcha')->render(true);
			$view->token   = $token;
			$html = $view->render(false);
			echo json_encode(array("html"=>$html));
		}
			
		public function get_online_reg_form($course,$group,$type_){
			$view   = new View('reg_form');
			$course = ORM::factory('course')->find($course);
			$token = text::random($type = 'alnum', $length = 8); 
			Session::instance()->set('token', $token);
			$view->group = $group;
			$view->course = $course;
			$view->captcha = Captcha::factory('kcaptcha')->render(true);
			$view->token   = $token;
			$view->is_group = (int)$type_;
			echo json_encode(array("html"=>$view->render()));
		}


		public function do_online_reg(){
			$post_token = $this->input->post("token",null,true);
		    $sess_token = Session::instance()->get("token",null);	
			$token_chek = $post_token == $sess_token ? true : false;
			$name = trim($this->input->post("name","",true));
			$phone = trim($this->input->post("phone","",true));
			$post = Validation::factory($_POST)
				->pre_filter('trim', TRUE)
				->add_rules('name', 'required','length[4,60]')
				->add_rules('phone', 'required', 'length[10,12]')
			        ->add_rules('code', 'required', 'Captcha::valid');
 			if(!$post->validate() || !$token_chek){
 				echo json_encode(array("status"=>false));
			    die;
			}
			else{

				$this->onine_reg();
			}
			Session::instance()->set('token',"");
		}
	public function _send_online_reg_email($user,$discount,$curs,$group){
		
		
		$email = new View("online_email");
		$email->user  = $user;
		$email->curs  = $curs;
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
			if($k!=="code")
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
		
		$dis = $discount > 0 ? "" : "Знижка ".$discount."%";
		$group = $this->input->post("group","",true);
		$dec = $user->is_group==1 ? " ГРУПОВИЙ, группа:".$this->input->post("group","",true) : " ";
		$this->_send_sms('ONLINE REG',$user->name." ".$user->phone." ".$user->email." ".$course.$dec." ".$dis);
		$this->_send_online_reg_email($user,$discount,$course,$group);
	}
		
		public function callback(){
		        $post_token = $this->input->post("token",null,true);
		        $sess_token = Session::instance()->get("token",null);
			$token_chek = $post_token == $sess_token ? true : false;
			$name = trim($this->input->post("name","",true));
			$phone = trim($this->input->post("phone","",true));
			$post = Validation::factory($_POST)
				->pre_filter('trim', TRUE)
				->add_rules('name', 'required','length[4,23]')
				->add_rules('phone', 'required', 'length[10,12]')
			        ->add_rules('code', 'required', 'Captcha::valid');
 			if(!$post->validate() || !$token_chek){
 				echo json_encode(array("status"=>false));
 				die;
 			}
			    
			
			$desc = $name." ".$phone;
			$this->_send_sms('Call Back',$desc);
			Session::instance()->set('token',"");
			echo json_encode(array("status"=>true));
		}
		
		
		public function other($seo){
			
			if($page = $this->_get_pages($seo))
				$this->index_other($page);
			else
			{
				if($seo!="main")
					Kohana::show_404();
				$this->input->get("pid",46,true);
				$this->index();
			}
		}
		
		
			public function index_other($page){
		
			
			stylesheet::add(array("jqueryslidemenu"));

			
			$view = new View('main');
			$view->menu = $this->_get_menu();
			$view->view_slide = false;
			Router::$site_title = $page->title;
			Router::$site_description = $page->meta_desc;
			Router::$site_keywords = $page->meta_keywords;
			Router::$page_content = $page->text;
			Router::$page_title = $page->name;
			$view->render(true);
		}







		public function courses($first=false,$second = false,$third=false,$fourth=false){
			$this->_redirect($first);
			#echo url::current();die;
			var_dump($first);
			var_dump($second);
		    if($first == $second) Kohana::show_404();
			#var_dump($first);var_dump($second);var_dump($third);var_dump($fourth);die;
			if($first==false && $second == false && $third==false){
				$courses = ORM::factory("course")->where("parent_id",null)->find_all();
				$view = new View('main');
				$view->menu = $this->_get_menu();
				$view->view_slide = false;
				stylesheet::add(array("jqueryslidemenu"));



				
				$content = new View("base_template");
				$content->courses = array();


					if(count($courses) > 0){
						$page = ORM::factory("pages_lang")->where(array("page_id"=>46 ,"id_lang"=>$this->lang))->find();
						Router::$site_title = $page->title;
						Router::$site_description = $page->meta_desc;
						Router::$site_keywords = $page->meta_keywords;
						Router::$page_title = $page->name;
						$content->courses = $courses;
					}
				Router::$page_content = $content->render(false);
				$view->render(true);
			}
			elseif(!$second && !$third){
				$course = ORM::factory("course")->where("seo_name",$first)->find_all()->current();
				$view = new View('main');
				$view->menu = $this->_get_menu();
				$view->view_slide = false;
				stylesheet::add(array("jqueryslidemenu"));



				
				$content = new View("base_template");
				$content->courses = array();
                                $content->course = $course;
				$content->seo = $course->seo_name;
				if(is_null($course->parent_id)){
					$courses = ORM::factory("course")->where("parent_id",$course->id)->find_all();
					if(count($courses) > 0){
						$page = ORM::factory("pages_lang")->where(array("page_id"=>$course->page->id ,"id_lang"=>$this->lang))->find();
						Router::$site_title = $page->title;
						Router::$site_description = $page->meta_desc;
						Router::$site_keywords = $page->meta_keywords;
						Router::$page_title = $page->name;
						$content->courses = $courses;
					}
					#$content->desc    = $page->text;
				}
				Router::$page_content = $content->render(false);
				$view->render(true);
			}
			elseif($second !== false && $third==false){
				$course = ORM::factory("course")->where("seo_name",$second)->find_all()->current();
				$c_hilds = ORM::factory("course")->where("parent_id",$course->id)->count_all();
				$view = new View('main');
				$view->menu = $this->_get_menu();
				$view->view_slide = false;
				stylesheet::add(array("jqueryslidemenu"));

				if($c_hilds < 1){
					$content = new View("base_template_2");
					$content->courses = array();
					
					$page = ORM::factory("pages_lang")->where(array("page_id"=>$course->page->id ,"id_lang"=>$this->lang))->find();
					Router::$site_title = $page->title;
					Router::$site_description = $page->meta_desc;
					Router::$site_keywords = $page->meta_keywords;
					Router::$page_title = $page->name;
						$content->desc    = $page->text;
						$content->course = $course;
					Router::$page_content = $content->render(false);
				}
				else{
					$content = new View("base_template_3");
					$courses = ORM::factory("course")->where("parent_id",$course->id)->find_all();
					$content->courses = $courses;
					$page = ORM::factory("pages_lang")->where(array("page_id"=>$course->page->id ,"id_lang"=>$this->lang))->find();
					Router::$site_title = $page->title;
					Router::$site_description = $page->meta_desc;
					Router::$site_keywords = $page->meta_keywords;
					Router::$page_title = $page->name;
						$content->desc    = $page->text;
						$content->course = $course;
					Router::$page_content = $content->render(false);
				}
				$view->render(true);
			}
			elseif($second !== false && $third!=false && $fourth == false){
				$view = new View('main');
				$view->menu = $this->_get_menu();
				$view->view_slide = false;
				stylesheet::add(array("jqueryslidemenu"));

				$parent_id = ORM::factory('course')->where('seo_name',$second)->find()->id;
				$course = ORM::factory("course")->where(array("seo_name"=>$third,"parent_id"=>$parent_id))->find_all()->current();
				

				$c_hilds = ORM::factory("course")->where("parent_id",$course->id)->count_all();

				if($c_hilds > 0){
					$content = new View("base_template_3");
					$courses = ORM::factory("course")->where("parent_id",$course->id)->find_all();
					$content->courses = $courses;
					$page = ORM::factory("pages_lang")->where(array("page_id"=>$course->page->id ,"id_lang"=>$this->lang))->find();
					Router::$site_title = $page->title;
					Router::$site_description = $page->meta_desc;
					Router::$site_keywords = $page->meta_keywords;
					Router::$page_title = $page->name;
						$content->desc    = $page->text;
						$content->course = $course;
					Router::$page_content = $content->render(false);
				}

				else{

					$content = new View("base_template_2");
					$content->courses = array();
					
					$page = ORM::factory("pages_lang")->where(array("page_id"=>$course->page->id ,"id_lang"=>$this->lang))->find();
					Router::$site_title = $page->title;
					Router::$site_description = $page->meta_desc;
					Router::$site_keywords = $page->meta_keywords;
					Router::$page_title = $page->name;
					$courses = ORM::factory("course")->where("parent_id",$course->id)->find_all();
						$content->desc    = $page->text;
						$content->course = $course;
					Router::$page_content = $content->render(false);
				}
				$view->render(true);
			}



			elseif($second !== false && $third!=false && $fourth != false){
				$view = new View('main');
				$view->menu = $this->_get_menu();
				$view->view_slide = false;
				stylesheet::add(array("jqueryslidemenu"));

				$parent_id = ORM::factory('course')->where('seo_name',$third)->find()->id;
				$course = ORM::factory("course")->where(array("seo_name"=>$fourth,"parent_id"=>$parent_id))->find_all()->current();


				$content = new View("base_template_2");
				$content->courses = array();
					
				$page = ORM::factory("pages_lang")->where(array("page_id"=>$course->page->id ,"id_lang"=>$this->lang))->find();
				Router::$site_title = $page->title;
				Router::$site_description = $page->meta_desc;
				Router::$site_keywords = $page->meta_keywords;
				Router::$page_title = $page->name;
				$courses = ORM::factory("course")->where("parent_id",$course->id)->find_all();
				$content->desc    = $page->text;
				$content->course = $course;
				Router::$page_content = $content->render(false);
				$view->render(true);
			}


			else{
				Kohana::show_404();
			}




		}
		
		
		
		
		
		
		
		
		
		
		
		
		
		public function index($page = false){	
			
			stylesheet::add(array("jqueryslidemenu"));
			
			$id = (int)$this->input->get("pid",46,true);
			$this->_redirect($id);
			#var_dump(url::current());die;
			
			$view = new View('main');
			$view->menu = $this->_get_menu();
			#$view->blog = $this->get_main_blog();
			$view->view_slide = $id == 46 ? true : false;
			$ff = $id == 46 ? 178 : 57 ;
			$page = ORM::factory("pages_lang")->where(array("page_id"=>$ff ,"id_lang"=>$this->lang))->find();
			if($id==46){
				$content = new View("grafic");
				$content->desc = $page->text;
				$content->schedule = ORM::factory("course")->find_all();
				Router::$page_content = $content->render(false);
			}
			else {
				
				Router::$page_content = $page->text;
			}
			
			
			
			
			
			Router::$site_title = $page->title;
			Router::$site_description = $page->meta_desc;
			Router::$site_keywords = $page->meta_keywords;
			
			Router::$page_title = $page->name;
			
			$view->render(true);
		}
		
		public function online_registration(){
			javascript::add(array(
				"admin/jquery-1.7.2.min",
				"jquery.validate",
				"admin/jquery-ui-1.8.21.custom.min",
				"jquery.form",
				"jquery.mvc",
				"script",
				"form",
				
			)); 
			
			
			stylesheet::add(array("jqueryslidemenu","form"));
			javascript::add(array(
				"controllers/front_menu_controller",
				"controllers/online_reg_controller"
			));
			


			$id = 115;
			$page = ORM::factory("page")->where("old_id",$id)->find();
			if(!$page->id)
				$page = ORM::factory("page")->where("old_id",46)->find();
			$view = new View('main');
			$view->menu 	  = $this->_get_menu();
			$view->view_slide = false;
			$content = new View("online_reg");
	    	$data = ORM::factory('course')->find_all();
			$courses = array();
			foreach($data as  $course){
				if(ORM::factory('course')->where("parent_id",$course->id)->count_all() > 0)
	                continue;
	            $courses[] = $course;

			}
			$content->courses = $courses;
			$page = $page->pages_lang->current()->where("id_lang",$this->lang);
			Router::$site_title = $page->title;
			Router::$site_description = $page->meta_desc;
			Router::$site_keywords = $page->meta_keywords;
			Router::$page_content = $content->render(false);
			Router::$page_title = $page->name;
			$view->render(true);
		}
		
		
		

		
		private function _prepare($data){
	    	$result = array();
	    	foreach($data as $d){
	    		if(isset($d["children"]))
	    			$d["children"] = $this->_prepare($d["children"]);
	    		@$name = $this->db->from("pages_langs")->select("name")->where(array("id_lang"=>$this->lang,"page_id"=>$d["id"]))->get()->current()->name;
	    		$d = array_merge($d,array("name"=>$name));
	    		$result[] = $d;
	    	}
	    	return $result;
		}

		
		

		
		
		
		private function _get_pages($seo){
			$page = ORM::factory("pages_lang")->where(array("seo_name"=>$seo,"id_lang"=>$this->lang))->find();
			if($page->id < 1)
			 	return false;
			else
				return $page;
			 	
		}
		
	}

?>