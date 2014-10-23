<?php
class Schedule_Admin extends AdminGrid {
	
	protected $limit     = 10;
	protected $order_by  = 'courses_id';
	protected $model     = 'schedule';
	protected $order_dir = 'asc';
	
	protected $group_by   = "";
	
	protected $grid_title = "Графік курсів";
	protected $grid_icon  = "calendar";
	
    protected $grid_colums = array(
    	"id"=>"",
    	"(Select name From courses_langs Where id_lang=0 AND course_id=parent.courses_id) AS course_name"=> "Курс",
    	
    	"group"=> "Группа",
    	"time_from"=> "Початок(час)",
    	"time_to"=> "Кінець(час)",
    	"days"=>"Дні",
    	"start_date"=>"Початок(дата)",
    	"price"=>"Ціна",
    	
    	//"(IF (`show` =1 , TRIM('TAK') , TRIM('HI'))) AS `show`"=> "Показувати?",
        //"(IF (`group` =1 , TRIM('TAK') , TRIM('HI'))) AS `group`"=> "Груповий?",
    	"people_count" =>"К-ть людей"
    	
    );
	public function __construct(){
		parent::__construct();
		javascript::add(array('controllers/schedule_controller',));
	}

    protected function get_aditional(){
    	$view = new View("schedule_additional");
    	return
    		$view->render(false);
    } 
    
    public function get_form(){
    	$price = "";
    	$id = (int)$this->input->post("id",null,true);
    	if($id > 0){
    		$price = ORM::factory($this->model,$id)->as_array();
    		
    	}
    	$html =  new View('schedule_form');
    	$html->courses = $this->get_courses();
    	echo json_encode(array("html"=>$html->render(false),"data"=>$price,"success"=>true));
   
    }
    
    
    public function save(){
    	$id = $this->input->post("id",null,true);
    	if((int)$id > 0)
    		$price = ORM::factory($this->model,$id);
    	else
    		$price = ORM::factory($this->model);
    	foreach($this->input->post() as $k=>$v){
    		$price->$k= $v;
    		
    	}
    	$price->save();
    	echo json_encode(array("success"=>true));
    }
    
    
    public function delete(){
    	if(request::is_ajax()){
	    	$id = (int)$this->input->post("id",null,true);
	    	if($id>0){
	    		$price = ORM::factory($this->model,$id);
	    		$price->delete();
	    		echo json_encode(array("success"=>true));
	    	}
	    	else{
	    		die;
	    	}
    	}
    	else{
    		die;
    	}
    }
    
    private function get_courses(){
    	$data = ORM::factory('course')->where('group',1)->find_all();
		$courses = array();
		foreach($data as  $course){
			$group = $course->group == 1 ? "(груп)" : "";
			$name = !$course->courses_langs->current() ? "невказана назва" : $course->courses_langs->current()->where("id_lang",0)->name;
			$courses[$course->id] = $name." ".$group;
		}
		return $courses;
    }
}

?>