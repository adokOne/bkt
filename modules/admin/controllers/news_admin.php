<?php 
class News_Admin extends AdminGrid {
	
	
	protected $limit     = 10;
	protected $order_by  = 'id';
	protected $model     = 'news';
	protected $order_dir = 'desc';
	
	protected $group_by   = "";
	
	protected $grid_title = "Новини";
	protected $grid_icon  = "list-alt";
	
    protected $grid_colums = array(
    	"id" => "",
    	"(SELECT title FROM news_langs WHERE news_id = parent.id AND id_lang=0) AS title" => "Назва",
    	"created_date" => "Дата створення/оновлення",
    	"(IF (`active` =1 , TRIM('TAK') , TRIM('HI'))) AS `active`"=> "Активна",
    	"(IF (`show_on_main` =1 , TRIM('TAK') , TRIM('HI'))) AS `show_on_main`"=> "Відображати на головній",
    	
    );
    
   /* protected $lang_field = array(
		"meta_desc" =>"Мета опис",
		"meta_keywords" =>"Ключові слова",
		"title" =>"Тайтл",
		"name" =>"Назва",
	); */
	
	
	
	public function __construct(){
		parent::__construct();
		javascript::add(array('controllers/news_controller'));
		$this->additional;
	}
    
	
    
    protected function get_aditional(){
    	$view = new View("news_additional");
    	return
    		$view->render(false);
    }
       
    public function get_form(){
    	$data = "";
    	$id = (int)$this->input->post("id",null,true);
    	if($id > 0){
    		$data = array();
    		foreach($this->langs as $k=>$lang){
    			$page = ORM::factory("news_lang")->where(array('news_id'=>$id,"id_lang"=>$k))->find()->as_array();
    			foreach($page as $a=>$v){
    				if($a == "news_id" or $a == "id")
    					$data[$a] = $v;
					else
    					$data[$a."_".$k] = $v;
    			}
    			
    		}
    		
    		
    	}
    	$html =  new View('news_form');
    	$html->data = $data;
    	echo json_encode(array("html"=>$html->render(false),"data"=>$data,"success"=>true));
   
    }
    
    
    public function save(){
    	if(request::is_ajax()){
	    	$id = (int)$this->input->post("news_id",null,true);
	    	if($id > 0){
	    		$page = ORM::factory($this->model,$id);
			}
	    	else{
	    		$page = ORM::factory($this->model);

	    		$page->created_date = date("Y-m-d");
	    		$page->save();
				foreach ($this->langs as $k=>$l){
					$lang   = ORM::factory("news_lang");
					$lang->news_id = $page->id;
					$lang->id_lang  = $k;
					$lang->save();
				}
			}
	    	$page->active = $this->input->post("active");
	    	$page->show_on_main = $this->input->post("show_on_main");
			foreach ($this->langs as $k=>$l){
				$lang = ORM::factory("news_lang")->where(array("news_id"=>$page->id,"id_lang"=>$k))->find();
				
				$lang->title   			 = $this->input->post("title_".$k);
				$lang->text    			 = $this->input->post("text_".$k);
				$lang->meta_desc 		 = $this->input->post("meta_desc_".$k);
				$lang->meta_keywords     = $this->input->post("meta_keywords_".$k);
				$lang->seo_name 		 = $this->input->post("seo_name_".$k);
				$lang->save();
			}
			$page->save();
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


