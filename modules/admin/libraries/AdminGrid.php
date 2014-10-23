<?php defined('SYSPATH') or die('No direct script access.');


class AdminGrid extends Controller {

	
	protected $limit      = 5;
	protected $order_by   = 'id';
	protected $model      = 'user';
	protected $order_dir  = 'asc';
	protected $group_by   = null;
	
	protected $grid_title = "";
	protected $grid_icon  = "";
	protected $additional = "";
	
	protected $grid_colums = array();
	protected $lang_field = array();
	
	protected $grid_content;
	
	public function __construct(){
		parent::__construct();
		javascript::add(array(
			'controllers/admin_grid_controller',
			'jquery-ui-timepicker-addon',
			'controllers/'.$this->model.'_action_controller'
		));
		
        foreach($this->langs as $k=>$lang)
        	foreach ($this->lang_field as $filed=>$c)
	    		$this->grid_colums = array_merge($this->grid_colums,array("(SELECT ".$filed." FROM ".inflector::plural($this->model)."_langs WHERE ".inflector::plural($this->model)."_id = parent.id AND id_lang={$k}) AS ".$filed."_{$k}" => $c." ".$lang));
		
		
	}
	
	public function index(){
		
		
		
		
		
		$order  = $this->input->post('order',$this->order_by);
		$offset = $this->input->post('offset',1);
		$field  = $this->input->post('filed',false,true);
		$where  = $this->input->post('where',false,true);
		
		$fileds      = implode(",", array_keys($this->grid_colums));
		$fields_name = array_values($this->grid_colums);
		$total       = ORM::factory($this->model);

		$total = isset($this->where) ? $total->where($this->where)->count_all() : $total->count_all();
		
		
		
		$view    = new View('dashboard');
		$view->modules = ORM::factory('module')->find_all();
		
		$content = new View('admin_grid');
        $content->grid_title = $this->grid_title;
        $content->grid_icon  = $this->grid_icon;
        $content->total      = $total;
        $content->_type      = $this->model;

		

		$this->db->from(inflector::plural($this->model)." AS parent")
				 ->select($fileds)
				 ->limit($this->limit);
				 if(isset($this->where))
				 	$this->db->where($this->where);
		$this->db
				 ->offset(($this->limit *($offset - 1)))
				 ->orderby($order,$this->order_dir);
		if($field!=false && $where != false)	
			$this->db->where($field,$where);	 
		/*	$this->_tree();
	 	if(!empty($this->group_by))
	 		$this->db->groupby($this->group_by);
		*/
		$content->order    = $order;
		$content->offset   = $offset;
		$content->field    = $field;
		$content->where    = $where;
		$content->columns  = $fields_name;
		$content->data     = $this->db->get();
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
	
	
	
    protected function get_aditional(){
		return "";
    }
	
	
	
	
	
	
	
}


?>