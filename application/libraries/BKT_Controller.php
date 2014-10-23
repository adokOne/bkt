<?php

class Controller extends Controller_Core {
	
	public $logged_in = false;
	public $user      = null;
	public $db;
	protected $title = null;
	protected $langs = array('ru','ua');




	public function __construct(){
		
		$this->db = Database::instance();
		$this->ip_log();
		$this->_set_user();
		$this->_prepare_layout();
		$this->_set_title();
		
		
		parent::__construct();
		View::set_global('blog',$this->get_main_blog());
		
	}
	
		protected function _get_menu(){
			
		$data = ORM::factory("menu")->where('position_id',1)->find_all();

		$_data = arr::ORM_object_to_array($data);
		$_data = arr::array_stack($_data,'parent_id','children');			
		#$data = $this->_prepare($_data);
		$i = 0;
		$data = ORM::factory('course')->find_all();

		$_data_ = arr::ORM_object_to_array($data);
		$_data_ = arr::array_stack($_data_,'parent_id','children');
		#var_dump($_data_);die;
		foreach ($_data as $key => $value) {
			$i++;
			if($i == 2){
				$r = $this->_prepare_courses($_data_,"courses/");
				$_data[$key] = array(
					"name"=> $this->lang == 0 ? "Учебные курсы" : "Навчальні курси",
					"parent_id"=>null,
					"id"=>54354,
					"seo_name"=>"courses",
					"children"=>$r);
				#unset($_data[$key]);
				#$_data = array_merge($_data,$r) ;#= $r;#$this->_prepare_courses($_data_);
		}
		}
		return $_data;


		}


		private function _prepare_courses($data,$l=""){
    	$result = array();
    	foreach($data as $d){

    		@$name = $this->db->from("courses_langs")->select("name")->where(array("id_lang"=>$this->lang,"course_id"=>$d["id"]))->get()->current()->name;
    		$d = array_merge($d,array("name"=>$name));
    		@$seo_name = $this->db->from('courses')->select("seo_name")->where("id",$d["id"])->get()->current()->seo_name;
    		$link = $l.$seo_name;
    		$d = array_merge($d,array("link"=>$link));
    		if(isset($d["children"]))
    			$d["children"] = $this->_prepare_courses($d["children"],$link."/");
    		$result[] = $d;
    	}
    	return $result;
		}
		
    	protected function prepare_courses(){
    		$data = ORM::factory("course")->where("parent_id IS NOT NULL")->find_all();
			$courses = array();
			foreach($data as  $course){
				if(!$course->group){
					$name = !$course->courses_langs->current() ? "невказана назва" : $course->where("id_lang",$this->lang)->courses_langs->current()->name;
					$courses[$course->id] = $name;
				}
			}
	    	return $courses;
		
    } 


    protected function get_main_blog(){
    	$view = new View("main_blog");
    	$news = ORM::factory("news_lang")->where("id_lang",$this->lang)->orderby("id","DESC")->limit(5)->find_all();	
    	$view->news = $news;
    	return $view->render(false);
    }
	
	protected function _send_sms($theme,$desc,$count="online_reg_count"){
			$this->ip_log($count);
			include_once 'GCalendarEvent.php';
			$event = new GCalendarEvent(Kohana::config("core.g_mail"),Kohana::config("core.g_pass"));
			$result = $event->addEvent($theme, $desc, $desc,date('c', time()),date('c', time()),1);
	}
	private function _set_user(){
		if( $this->logged_in = Auth::instance()->logged_in() ) {
			$this->user = Auth::instance()->get_user();
			View::set_global('user',$this->user);


		}
		View::set_global('cls','');
		
	
		View::set_global('logged_in', $this->logged_in);
	}
	
	
	protected function ip_log($field = "count"){
		$ip 	= Input::instance()->ip_address();
		$ip_row = ORM::factory('visitor')->where("ip",$ip)->find();
		
		if($ip_row->count_all()==0)
			$ip_row->ip = $ip;
		$ip_row->$field += 1;
		$ip_row->save();
	}
	
	private function _prepare_layout(){
		stylesheet::add(array(
			"my_css",
			#"lightbox",
			"sdmenu"
		));

		
		
		$langs = array_flip($this->langs);
		$this->lang = $langs[Router::$current_language];
		View::set_global("cur_lang",$this->lang);
    
	}
	
	public function _set_title($name = false){
		if(!$name){
			$title = Kohana::config('core.sitename');
		} else {
			$title = $name . " : " . Kohana::config('core.sitename');
		}
		
		View::set_global('page_title', $title);
		View::set_global('langs', $this->langs);
		View::set_global('lang', Kohana::lang("all"));


	}

}