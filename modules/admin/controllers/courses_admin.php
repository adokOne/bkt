<?php 
class Courses_Admin extends AdminGrid {
	
	
	protected $limit     = 10;
	protected $order_by  = 'parent_id';
	protected $model     = 'course';
	protected $order_dir = 'desc';
	
	protected $group_by   = "";
	
	protected $grid_title = "Курсы";
	protected $grid_icon  = "book";
	
    protected $grid_colums = array(
    	"id"=>"Назва",
    	
    );
    
    protected $lang_field = array(
		
	); 
	
	
	
	public function __construct(){
		parent::__construct();
		javascript::add(array("fileuploader.min",'controllers/courses_edit_controller'));
		$this->additional;
	}
    
	public function index(){
		
		
		
		
		
		$order  = $this->input->post('order',$this->order_by);
		$offset = $this->input->post('offset',1);
		
		
		$fileds      = implode(",", array_keys($this->grid_colums));
		$fields_name = array_values($this->grid_colums);
		$total       = ORM::factory($this->model)->count_all();
		$data = ORM::factory($this->model)->find_all();

		$_data = arr::ORM_object_to_array($data);
		$_data = arr::array_stack($_data,'parent_id','children');
		$_data = $this->prepare($_data);
				
		$view    = new View('dashboard');
		$view->modules = ORM::factory('module')->find_all();
		
		$content = new View('courses_grid');
        $content->grid_title = $this->grid_title;
        $content->grid_icon  = $this->grid_icon;
        $content->total      = $total;
		
				 
		$content->order    = $order;
		$content->offset   = $offset;

		$content->data     = $_data;
		$courses = array();
		foreach($data as  $course){
			if(!$course->group){
			$name = !$course->courses_langs->current() ? "невказана назва" : $course->courses_langs->current()->where("id_lang",0)->name;
			$courses[$course->id] = $name;
			}
		}
		$content->courses    = $courses;
		$view->grid_content  = $content->render(false);
		$view->additional    = $this->get_aditional();
		echo $view->render(true);
	}
    
	public function get(){
		if(request::is_ajax()){
			$id     = (int)$this->input->post("id");
			$course = ORM::factory($this->model,$id);
			if($course){
				$data = array(
					"id"		 => $course->id,
					"parent_id"  => $course->parent_id,
				    "group"      => $course->group,
				    "seo_name"   => $course->seo_name,
				    "individual_price" => $course->individual_price,
				    "l_count" => $course->l_count,
				    "sale_price" => $course->sale_price,
				    "img_title"  => $course->img_title,
				    "img_alt"    => $course->img_alt,
				    "has_presentation" => $course->has_presentation,
					"name_0"     => "",
					"name_1"	 => "",
					"src"        => $course->has_logo > 0 ? "logos/".$course->id."/pic_93.jpg" : ""
				);
				$lang_data = array();
				foreach ($course->courses_langs as $lang){
					$lang_data["name_".$lang->id_lang] 		= $lang->name;
					$data = array_merge($data,$lang_data);
				}
				echo json_encode(array("success"=>true,"data"=>$data));
				
			}
			else
				echo json_encode(array("success"=>false));
		}
		else die;
		
	}
	public function upload_image(){

		$extensions = array("jpeg", "png", "gif" , "jpg");
		$uploader   = new Uploader($extensions);
		$result     = $uploader->handleUpload(DOCROOT.'/upload/tmp');

		
		echo htmlspecialchars(json_encode($result), ENT_NOQUOTES);
		

	}

	public function save_image($id){
		$file = DOCROOT.'/upload/tmp/'.$this->input->post('image_name');
		MOJOUser::processAvatar($file , $id,true,'upload/logos/');
		
	}


	public function upload_present($id){

		$extensions = array("ppt", "pptx", "pps" , "ppsx", "odp");
		$uploader   = new Uploader($extensions);
		$result     = $uploader->handleUpload(DOCROOT.'upload/tmp');
		list($name,$ext) = explode(".", $result["file"]);
		$pr = ORM::factory("course")->where("id",$id)->find();
		$pr->present_name = $id.".".$ext;
		$pr->save();
		rename(DOCROOT.'upload/tmp/'.$result["file"], DOCROOT.'upload/presentations/'.$id.".".$ext);
		echo htmlspecialchars(json_encode($result), ENT_NOQUOTES);
		

	}


	public function delete(){
		if(request::is_ajax()){
			$id = (int)$this->input->post("id");
			ORM::factory($this->model,$id)->delete();
			echo json_encode(array("success"=>true));
			
		}
		else 	
			die;
	}


	public function get_plan(){
		if(!request::is_ajax())
			die;
		$id   = (int)$this->input->post("id");
		$plan = ORM::factory("plan")->where("course_id",$id)->find_all();
		$view  = new View("plan_form");
		$view->plans = $plan;
		$view->id = $id;
		echo json_encode(array("success"=>true,"html"=>$view->render(false)));

	}
    public function get_group_form(){
 		if(!request::is_ajax())
			die;
    	$price = "";
    	$course_id = (int)$this->input->post("course_id",0,true);
    	$id = (int)$this->input->post("id",null,true);
    	if($id > 0){
    		$price = ORM::factory("group",$id)->as_array();
    		
    	}
    	$html =  new View('schedule_form');
    	$html->course_id= $course_id;
        $html->id = $id;
    	echo json_encode(array("html"=>$html->render(false),"data"=>$price,"success"=>true));
   
    }

	public function get_groups(){
		if(!request::is_ajax())
			die;
		$id   = (int)$this->input->post("id");
		$group = ORM::factory("group")->where("course_id",$id)->find_all();
		$view  = new View("group_form");
		$view->groups = $group;
		$view->id = $id;
		echo json_encode(array("success"=>true,"html"=>$view->render(false)));
	}

	public function gelete_group(){
		if(!request::is_ajax())
			die;
		$id   = (int)$this->input->post("id");
		$group = ORM::factory("group",$id)->delete();
		echo json_encode(array("success"=>true));
	}

    public function save_group(){
    	$id = $this->input->post("id",null,true);
    	if((int)$id > 0)
    		$price = ORM::factory("group",$id);
    	else
    		$price = ORM::factory("group");
    	foreach($this->input->post() as $k=>$v){
    		$price->$k= $v;
    		
    	}
    	$price->save();
    	echo json_encode(array("success"=>true));
    }

	public function save_plan(){
		if(!request::is_ajax())
			die;
		$id = (int)$this->input->post("course_id");
		$names = $this->input->post("name",array(),true);	
		if($id != 0){
			$arr = array();
			$plan = ORM::factory("plan")->where("course_id",(int)$this->input->post("course_id"))->find_all();
			foreach($plan as $i=>$p)
				$p->delete();
				try{
					@$p->delete();
				}
				catch(exception $e) {

					foreach ($names[$i] as $lang => $value) {
						$name = "name_".$lang;
						$p->$name = $value;
					}
				       $p->save();
					$arr[] = $i;
					continue;
				}
		}
		
		if(count($names) > 0){
			foreach ($names as  $i=>$name_arr) {
				if(in_array($i, $arr))
					continue;
				$plan = ORM::factory("plan");
				foreach ($name_arr as $lang => $value) {
					$name = "name_".$lang;
					$plan->$name = $value;
				}
				$plan->course_id =(int)$this->input->post("course_id");
				$plan->save();
			}
		}
		echo json_encode(array("success"=>true));

	}

	public function save_planthemes(){
		if(!request::is_ajax())
			die;
		$id = (int)$this->input->post("plan_id");
			
		if($id != 0){
			$plan = ORM::factory("plan_theme")->where("plan_id",$id)->find_all();
			foreach($plan as $p)
				$p->delete();
		}
		$names = $this->input->post("name",array(),true);
		if(count($names) > 0){
			foreach ($names as  $name_arr) {
				$plan = ORM::factory("plan_theme");
				foreach ($name_arr as $lang => $value) {
					$name = "name_".$lang;
					$plan->$name = $value;
				}
				$plan->plan_id =$id;
				$plan->save();
			}
		}
		echo json_encode(array("success"=>true));
	}


	public function get_themes(){
		if(!request::is_ajax())
			die;
		$id = (int)$this->input->post("id");
		$plan = ORM::factory("plan_theme")->where("plan_id",$id)->find_all();
		$view  = new View("plan_themes");
		$view->plans = $plan;
		$view->id = $id;
		echo json_encode(array("success"=>true,"html"=>$view->render(false)));
	}
	
	public function save(){
		if(request::is_ajax()){
			$id = (int)$this->input->post("id");
			
			if($id == 0){

				$course = ORM::factory($this->model);
				$course->parent_id =null;
				$course->save();
				$id = $course->id;
				foreach ($this->langs as $k=>$l){
					$lang   = ORM::factory("courses_lang");
					$lang->course_id = $id;
					$lang->id_lang   = $k;
					$lang->save();
				}
			}
			$course = $course = ORM::factory($this->model,$id);
			$course->parent_id = $this->input->post("parent_id",null,true);
			$course->group = $this->input->post("group",null,true);
			$course->seo_name = $this->input->post("seo_name",null,true);

			$course->l_count = $this->input->post("l_count",null,true);
            $course->sale_price = $this->input->post("sale_price",0,true);


            $course->img_alt = $this->input->post("img_alt","",true);
            $course->img_title = $this->input->post("img_title","",true);

			$course->individual_price = $this->input->post("individual_price",null,true);
			$course->has_presentation = $this->input->post("has_presentation",null,true);

			$course->has_logo   = is_null($this->input->post("image_name",null,true)) ? 0 : 1;
			
			$course->save();
			foreach ($this->langs as $k=>$l){
				$lang = ORM::factory("courses_lang")->where(array("course_id"=>$id,"id_lang"=>$k))->find();
				$lang->name     = $this->input->post("name_".$k);
				
				$lang->save();
			}
			if($course->has_logo && $this->input->post("image_name",false,true) !=="")
				@$this->save_image($course->id);
			echo json_encode(array("success"=>true));
			
		}
		else 	
			die;
	}
	
    private function prepare($data){
    	$result = array();
    	foreach($data as $d){
    		if(isset($d["children"]))
    			$d["children"] = $this->prepare($d["children"]);
    		@$name = $this->db->from(inflector::plural($this->model)."_langs")->select("name")->where(array("id_lang"=>0,"course_id"=>$d["id"]))->get()->current()->name;
    		$d = array_merge($d,array("name"=>$name));
    		@$group = $this->db->from(inflector::plural($this->model))->select("group")->where("id",$d["id"])->get()->current()->group;
    		$d = array_merge($d,array("group"=>$group));
    		$result[] = $d;
    	}
    	return $result;
		
    } 
    
    protected function get_aditional(){
    	$view = new View("course_additional");
    	return
    		$view->render(false);
    }




    public function get_page_form(){
    	$data = "";
    	$c_id = (int)$this->input->post("id",null,true);
    	$page = ORM::factory("page")->where("course_id",$c_id)->find_all()->current();
    	$id   = $page === false ? 0 : $page->id;
    	if($id > 0){
    		$data = array();
    		foreach($this->langs as $k=>$lang){
    			$page = ORM::factory("pages_lang")->where(array('page_id'=>$id,"id_lang"=>$k))->find()->as_array();
    			foreach($page as $a=>$v){
    				if($a == "page_id" or $a == "id")
    					$data[$a] = $v;
					else
    					$data[$a."_".$k] = $v;
    			}
    			
    		}
    		
    		
    	}
    	$html =  new View('page_form');
    	$html->data = $data;
    	$html->c_id = $c_id;
    	echo json_encode(array("html"=>$html->render(false),"data"=>$data,"success"=>true));
   
    }




	public function text_window(){
	$view = new View('text_window');
	echo json_encode(array("html"=>$view->render(false)));
	}


    
    
    public function save_page(){
    	if(request::is_ajax()){
	    	$id = (int)$this->input->post("page_id",null,true);
	    	if($id > 0){
	    		$page = ORM::factory("page",$id);
			}
	    	else{
	    		$page = ORM::factory("page");
	    		$page->show = 1;
	    		$page->course_id = $this->input->post("course_id");
	    		$page->save();

				foreach ($this->langs as $k=>$l){
					$lang   = ORM::factory("pages_lang");
					$lang->page_id = $page->id;
					$lang->id_lang  = $k;
					$lang->save();
				}
			}
	    	
			foreach ($this->langs as $k=>$l){
				$lang = ORM::factory("pages_lang")->where(array("page_id"=>$page->id,"id_lang"=>$k))->find();
				
				$lang->name     		 = $this->input->post("name_".$k);
				$lang->title   			 = $this->input->post("title_".$k);
				$lang->text    			 = $this->input->post("text_".$k);
				$lang->meta_desc 		 = $this->input->post("meta_desc_".$k);
				$lang->meta_keywords     = $this->input->post("meta_keywords_".$k);
				$lang->save();
			}

	    	echo json_encode(array("success"=>true));
		}
		else {
			die;
		}
    }




	public function get_prepare_form(){
		$id = $this->input->post("id",0,true);
		$prepare = ORM::factory("preparation")->where("course_id",$id)->find();
		if($prepare->count_all() == 0 ){
			$prepare->course_id = $id;
			$prepare->save();
		}
		$view = new View("prepare_form");
		$view->prepare = $prepare;
		$view->id = $id;
		echo json_encode(array("success"=>true,"html"=>$view->render(false)));
	}

	public function save_prepare(){
		$id = $this->input->post("course_id",0,true);
		$prepare = ORM::factory("preparation")->where("course_id",$id)->find();
		foreach ($_POST as $key => $value) {
			$prepare->$key = $value;
		}
		$prepare ->save();
		echo json_encode(array("success"=>true));
	}















    
}



















?>