<?php
class Cupons_Admin extends AdminGrid {
	
	protected $limit     = 5;
	protected $order_by  = 'id';
	protected $model     = 'cupon';
	protected $order_dir = 'desc';
	
	protected $group_by   = "";
	
	protected $grid_title = "Купони";
	protected $grid_icon  = "shopping-cart";
	
    protected $grid_colums = array(
    	"id"=>"",
    	"number"=>"Номер",
    	"(Select name From organizations Where id = parent.organization_id) AS organization"=> "Кому виданий",
    	"(IF (`many_use` =1 , TRIM('TAK') , TRIM('HI'))) AS `many_use`"=> "Багаторазовий?",
    	"use_count"=> "Використано",
    	"discount"=>"Процент знижки"
    	//"(Select name From courses_langs Where id_lang=0 AND course_id=parent.courses_id) AS course_name"=> "Курс",
    	//"(IF (`show` =1 , TRIM('TAK') , TRIM('HI'))) AS `show`"=> "Показувати?",
        //"(IF (`group` =1 , TRIM('TAK') , TRIM('HI'))) AS `group`"=> "Груповий?",
    	//"people_count" =>"К-ть людей"
    	
    );
	public function __construct(){
		parent::__construct();
		
	}

    protected function get_aditional(){
    	$view = new View("cupon_additional");
    	return
    		$view->render(false);
    } 
    
    public function get_form(){
    	$price = "";
    	$id = (int)$this->input->post("id",null,true);
    	if($id > 0){
    		$price = ORM::factory($this->model,$id)->as_array();
    		
    	}
    	$html =  new View('cupon_form');
    	$html->organizations = $this->get_orgs();
    	$html->courses       = $this->get_courses();
    	
    	echo json_encode(array("html"=>$html->render(false),"data"=>$price,"success"=>true));
   
    }
    public function get_organization_form(){
    	$html =  new View('organization_form');
    	echo json_encode(array("html"=>$html->render(false),"success"=>true));
   
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
    
    public function save_org(){
    	$org = ORM::factory("organization");
    	$org->name = $this->input->post("name","",true);
        $org->save();
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
    	$data = ORM::factory('course')->find_all();
		$courses = array();
		foreach($data as  $course){
			$group = $course->group == 1 ? "(груп)" : "";
			$name = !$course->courses_langs->current() ? "невказана назва" : $course->courses_langs->current()->where("id_lang",0)->name;
			$courses[$course->id] = $name." ".$group;
		}
		return $courses;
    }
    
    private function get_orgs(){
    	$data = ORM::factory('organization')->find_all();
		return $data;
    }
    
    
    
}

?>