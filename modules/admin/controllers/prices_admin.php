<?php
class Prices_Admin extends AdminGrid {
	
	protected $limit     = 5;
	protected $order_by  = 'id';
	protected $model     = 'price';
	protected $order_dir = 'desc';
	
	protected $group_by   = "";
	
	protected $grid_title = "Ціни";
	protected $grid_icon  = "shopping-cart";
    protected $grid_colums = array(
    	"id"=>"",
        "(Select name From courses_langs Where id_lang=1 AND course_id=parent.course_id) AS course_name"=> "Курс",
    	"price_1"=>"Ціна 2",
    	"price_2"=> "Ціна 3-4",
    	"price_3"=> "Ціна 5-6",
    	"price_4"=> "Ціна 7-8"
    	
    );
	public function __construct(){
		parent::__construct();
		
	}

    protected function get_aditional(){
    	$view = new View("prices_additional");
    	return
    		$view->render(false);
    } 
    
    public function get_form(){
    	$price = "";
    	$id = (int)$this->input->post("id",null,true);
    	if($id > 0){
    		$price = ORM::factory($this->model,$id)->as_array();
    		
    	}
    	$html =  new View('price_form');
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
    	$data = ORM::factory('course')->find_all();
		$courses = array();
		foreach($data as  $course){
            $course->reset_select();
			if(ORM::factory('course')->where("parent_id",$course->id)->count_all() > 0)
                continue;
			$name = !$course->courses_langs->current() ? "невказана назва" : $course->where("id_lang",0)->courses_langs->current()->name;
			$courses[$course->id] = $name;
		}
		return $courses;
    }
}

?>