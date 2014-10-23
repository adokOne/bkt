<?php 
class Menu_Admin extends AdminGrid {
	
	
	protected $limit     = 10;
	protected $order_by  = 'menu';
	protected $model     = 'menu';
	protected $order_dir = 'desc';
	
	protected $group_by   = "";
	
	protected $grid_title = "Менюшки";
	protected $grid_icon  = "tasks";
		
	
	
	public function __construct(){
		parent::__construct();
		javascript::add(array('controllers/courses_edit_controller'));
		$this->additional;
	}
    
	public function index(){
		
		
		$types = ORM::factory("position")->find_all();
		
		
		$order  = $this->input->post('order',$this->order_by);
		$offset = $this->input->post('offset',1);

				
		$view    = new View('dashboard');
		$view->modules = ORM::factory('module')->find_all();
		
		$content = new View('menu_grid');
        $content->grid_title = $this->grid_title;
        $content->grid_icon  = $this->grid_icon;
        $content->total      = "";
        $content->types      = $types;
		
				 
		$content->order    = $order;
		$content->offset   = $offset;
		$content->courses    = array();
		$view->grid_content  = $content->render(false);
		$view->additional    = "";
		echo $view->render(true);
	}
    
    
    
    public function get_form(){
    	$view = new View("menu_form");
    	$pages = ORM::factory("page")->find_all();
    	
    	$view->pages = $pages;
    	$view->id = $this->input->post("id");
    	$view->parent_id = (int)$this->input->post("parent_id");
    	echo json_encode(array("html"=>$view->render(false)));
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
	
	public function save(){
		if(request::is_ajax()){
			$id = (int)$this->input->post("position_id");
			$menu = ORM::factory("menu");
			$menu->position_id = $id;
			$menu->name = $this->input->post("name");
			$menu->parent_id   = (int)$this->input->post("parent_id") == 0 ? null : (int)$this->input->post("parent_id");
			$menu->link = $this->input->post("link");
			$menu->save();
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

    		$result[] = $d;
    	}
    	return $result;
		
    } 

    
}

?>


