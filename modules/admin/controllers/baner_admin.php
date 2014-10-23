<?php 
class Baner_Admin extends AdminGrid {
	
	
	protected $limit     = 10;
	protected $order_by  = 'id';
	protected $model     = 'baner';
	protected $order_dir = 'desc';
	
	protected $grid_title = "Банери";
	protected $grid_icon  = "user";
	
    protected $grid_colums = array(
    	
    	"id" 			=> "id",
    	"desc" 		=> "Назва",
    );
    
    
	public function __construct(){
		parent::__construct();
		javascript::add(array("fileuploader.min"));

	}
    
    protected function get_aditional(){
    	$view = new View("baner_additional");
    	return
    		$view->render(false);
    }   

    public function delete(){
    	ORM::factory("baner")->where("id",(int)$this->input->post("id"))->find()->delete();
    	echo json_encode(array("success"=>true));
    }

    public function upload_top_image(){
		$extensions = array("jpeg", "png", "gif" , "jpg");
		$uploader   = new Uploader($extensions);
		$result     = $uploader->handleUpload(DOCROOT.'upload/tmp');
		$this->save_image(0,$result["file"]);
		
		echo htmlspecialchars(json_encode($result), ENT_NOQUOTES);
    }

	public function upload_image($id){

		$extensions = array("jpeg", "png", "gif" , "jpg");
		$uploader   = new Uploader($extensions);
		$result     = $uploader->handleUpload(DOCROOT.'upload/tmp');
		$this->save_image($id,$result["file"]);
		
		echo htmlspecialchars(json_encode($result), ENT_NOQUOTES);
		

	}

	public function save_image($id,$f){
		$file = DOCROOT.'upload/tmp/'.$f;
		MOJOUser::processAvatar($file , $id,true,'upload/baners/',Kohana::config('baners.avatars'));
		
	}


    public function save(){
    	if(request::is_ajax()){
	    	$id = (int)$this->input->post("id",null,true);
	    	if($id > 0){
	    		$page = ORM::factory($this->model,$id);
			}
	    	else{
	    		$page = ORM::factory($this->model);
	    		
			}
	    		
			$page->desc = $this->input->post("desc");
			$page->alt = $this->input->post("alt");
			$page->title = $this->input->post("title");
			$page->link = $this->input->post("link");
			$page->link_text = $this->input->post("link_text");

			$page->save();
	    	echo json_encode(array("success"=>true));
		}
		else {
			die;
		}
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
	
    public function get_form(){
    	$data = "";
		$html =  new View('baner_form');
    	$id = (int)$this->input->post("id",null,true);
    	if($id > 0){
    		$data = array();
    			$page = ORM::factory("baner")->where("id",$id)->find()->as_array();
    			foreach($page as $a=>$v)
    					$data[$a] = $v;
    	}
    			
    	$html->data = $data;
    	echo json_encode(array("html"=>$html->render(false),"data"=>$data,"success"=>true));
   
    }
    
    
    
    
    
    
}

?>