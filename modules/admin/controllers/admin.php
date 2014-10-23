<?php

/**
 * Админка
 *
 */
class Admin_Controller extends Controller {
	
	public function __construct(){
		
		parent::__construct();
		if($this->logged_in === FALSE){
			self::login();
			exit;
		}
	}
	
	/**
	 * главная страница админки
	 * 
	 * @access public
	 */
	public function index(){
		if ($this->logged_in){

			$user = Auth::instance()->get_user();
			if(!$user->has(ORM::factory('role','admin'))){
				Kohana::show_404();
				exit;
			}
			
			$view = new View('dashboard');
			$view->content = "";
			$view->lang = Kohana::lang('admin.dashboard');
			
			$modules = $modules = ORM::factory('module')->find_all();
			$view->modules = $modules;
			
			$view->user = $user;
			$view->grid_content = "";
			$view->additional    = "";
			$view->render(true);
			
		} else {
			self::login();
			exit;
		}
	}
	
	/**
	 * форма логина и авторизация
	 *
	 * @access public
	 */
	public function login(){
		if (!Auth::instance()->logged_in()){
			$username = $this->input->post('username',null,true);
			$password = $this->input->post('password',null,true);
			$remember = $this->input->post('remember',null,true);
			if(isset($username) AND isset($password)){
				
				$post = Validation::factory($_POST)
									->pre_filter('trim', TRUE)
									->add_rules('username', 'required', 'length[3,127]')
									->add_rules('password','required','length[4,127]');
							
				if(!$post->validate()){
					$response = array('status'=>false,'text'=>Kohana::lang('admin.error.default_login_error'));
				
				} else {
					$user = ORM::factory('user',$username);

					$response = array('status'=>false,'text'=>Kohana::lang('admin.error.default_login_error'));
					if($user->has(ORM::factory('role', 'admin'))){
						if (Auth::instance()->login($username, $password,!empty($remember))){
							
							$response = array('status'=>true);
						} else {
							$response = array('status'=>false,'text'=>Kohana::lang('admin.error.default_login_error'));
						}
					}
				}
			
				echo json_encode($response);
				exit;
			}
			
			$view = new View('admin_login_form');
		
			$view->render(true);
			
		}
	}

	/**
	 * Разлогинивает
	 *
	 */
	public function logout(){
		Auth::instance()->logout(TRUE);
		url::redirect('admin',301);
	}
	
	public function __call($name, $arguments){
        $user = Auth::instance()->get_user();
		if(!$user->has(ORM::factory('role','admin'))){
			Kohana::show_404();
			exit;
		}
		
		if (file_exists(MODPATH . 'admin/controllers/' . $name . '_admin.php')){
			require_once MODPATH . 'admin/controllers/' . $name . '_admin.php';	
		}
		
		if(class_exists( $name  . '_Admin', true)){
			$class_name = $name . '_Admin';
			$class = new $class_name; 
			
			if(!empty($arguments)){
				$method = $arguments[0];
			} else {
				$method = "index";
			}
			
			if(method_exists($class,$method)){
				if(isset($arguments[1]))
					$class->$method($arguments[1]);
					else
				$class->$method();
				
			} else {
				
				$view = new View('not_found');
				$view->title = Kohana::lang('admin.error.not_found_title');
				$view->msg = sprintf(Kohana::lang('admin.error.not_found_action'), $name, $method);
				$view->render(true);
				
			}
			
		} else {
			
			$view = new View('not_found');
			$view->title = Kohana::lang('admin.error.not_found_title');
			$view->msg = sprintf(Kohana::lang('admin.error.not_found'), $name);
			$view->render(true);
			
		}
	}
	
}
