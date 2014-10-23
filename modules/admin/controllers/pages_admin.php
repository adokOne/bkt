<?php 
class Pages_Admin extends AdminGrid {
	
	
	protected $limit     = 10;
	protected $order_by  = 'id';
	protected $model     = 'page';
	protected $order_dir = 'desc';
	
	protected $group_by   = "";
	
	protected $grid_title = "Контент сторінок";
	protected $grid_icon  = "list-alt";
	protected $where      = array("course_id"=>0);
    protected $grid_colums = array(
    	"id" => "",
    	"(SELECT name FROM pages_langs WHERE page_id = parent.id AND id_lang=0 ) AS name" => "Назва"
    );
    
   /* protected $lang_field = array(
		"meta_desc" =>"Мета опис",
		"meta_keywords" =>"Ключові слова",
		"title" =>"Тайтл",
		"name" =>"Назва",
	); */
	
	
	
	public function __construct(){
		parent::__construct();
		javascript::add(array('controllers/pages_controller'));
		$this->additional;
	}
    
	
    
    protected function get_aditional(){
    	$view = new View("pages_additional");
    	return
    		$view->render(false);
    }
    
    
   
    public function get_form(){
    	$data = "";
$html =  new View('page_form');
$html->seo_name="";
    	$id = (int)$this->input->post("id",null,true);
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
    		
    		$html->seo_name= $page["seo_name"];
    	}
    	
    	$html->c_id = 0;
		
    	$html->data = $data;
    	echo json_encode(array("html"=>$html->render(false),"data"=>$data,"success"=>true));
   
    }
    
    
    public function save(){
    	if(request::is_ajax()){
	    	$id = (int)$this->input->post("page_id",null,true);
	    	if($id > 0){
	    		$page = ORM::factory($this->model,$id);
			}
	    	else{
	    		$page = ORM::factory($this->model);
	    		$page->show = 1;
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
				$lang->seo_name 		 = $this->input->post("seo_name");
				$lang->save();
			}

	    	echo json_encode(array("success"=>true));
		}
		else {
			die;
		}
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
    
    
    
    
    
    
    
    
    
    
    
    
}

?>
