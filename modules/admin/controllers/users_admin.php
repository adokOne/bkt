<?php 
class Users_Admin extends AdminGrid {
	
	
	protected $limit     = 10;
	protected $order_by  = 'id';
	protected $model     = 'user';
	protected $order_dir = 'desc';
	protected $group_by  = 'roles';
	
	protected $grid_title = "Користувачі";
	protected $grid_icon  = "user";
	
    protected $grid_colums = array(
    	"username" 		=> "Логин",
    	"name" 			=> "Ім'я",
    	"register_date" => "Дата регістрації",
    	"last_login" 	=> "Останній раз на сайті",
    	"email"			=> "Імейл",
    	"phone" 		=> "Тел.",
    );
    
    
    
    
    protected function get_aditional(){
    	$view = new View("user_additional");
    	$view->roles = ORM::factory("role")->find_all();
    	return
    		$view->render(false);
    }   
    
    
public function index(){
		
		
		
		
		
		$order  = $this->input->post('order',$this->order_by);
		$offset = $this->input->post('offset',1);
		$where  = $this->input->post('where',false,true);
		
		$fileds      = implode(",", array_keys($this->grid_colums));
		$fields_name = array_values($this->grid_colums);
		$total       = ORM::factory($this->model)->count_all();
		
		
		$view    = new View('dashboard');
		$view->modules = ORM::factory('module')->find_all();
		
		$content = new View('admin_grid');
        $content->grid_title = $this->grid_title;
        $content->grid_icon  = $this->grid_icon;
        $content->total      = $total;
        $content->_type      = $this->model;

		if($where != false){
			$role = ORM::factory('role',$where);
			$data = array();
			foreach($role->users as $us){
				$data[] = $us->id;
			}
			if(count($data) > 0){
			$this->db->from(inflector::plural($this->model)." AS parent")
				 ->select($fileds)
				 ->limit($this->limit)
				 ->offset(($this->limit *($offset - 1)))
				 ->where("id IN (".implode(",",$data).")")
				 ->orderby($order,$this->order_dir);
			}
			else{
			$this->db->from(inflector::plural($this->model)." AS parent")
				 ->select($fileds)
				 ->limit($this->limit)
				 ->offset(($this->limit *($offset - 1)))
				 ->where("id IN (0)")
				 ->orderby($order,$this->order_dir);
			}
		}
		else {
			$this->db->from(inflector::plural($this->model)." AS parent")
				 ->select($fileds)
				 ->limit($this->limit)
				 ->offset(($this->limit *($offset - 1)))
				 ->orderby($order,$this->order_dir);
		}
			

		
	 
		/*	$this->_tree();
	 	if(!empty($this->group_by))
	 		$this->db->groupby($this->group_by);
		*/
		$data = $this->db->get();
		$total = $this->db->count_last_query();
		$content->total     = $total;
		$content->order    = $order;
		$content->offset   = $offset;
		$content->field    = "";
		$content->where    = $where;
		$content->columns  = $fields_name;
		$content->data     = $data;
		$content->pagination = new Pagination(array(
				'total_items'    => $total,
				'items_per_page' => $this->limit,
				'style'          => 'twit',
				'auto_hide'      => true
		));

		$view->grid_content  = $content->render(false);
		$view->additional    = $this->get_aditional();
		$view->render(true);
	}
	
    public function roles(){
    	
    }
    
    
    
    
    
    
}

?>