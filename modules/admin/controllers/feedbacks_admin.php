<?php
class Feedbacks_Admin extends AdminGrid {
	
	protected $limit     = 10;
	protected $order_by  = 'id';
	protected $model     = 'feedback';
	protected $order_dir = 'desc';
	
	protected $group_by   = "";
	
	protected $grid_title = "Відгуки";
	protected $grid_icon  = "bullhorn";
	
    protected $grid_colums = array(
    	"id"=>"",
    	"name"=>"Від кого",
    	"text"=> "Текст",
    	"date"=> "Дата"
    	
    );
        
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

    public function get_form(){
    	$id = $this->input->post("id",0,true);
    	$view = new View('feed_com_form');
    	$view->id = $id;
    	echo json_encode(array("html"=>$view->render(false)));
    }


    public function save_comment(){
		$id = $this->input->post("id",0,true);

		$feed = ORM::factory($this->model);
		$feed->parent_id = $id;
		$feed->text = $this->input->post("text","",true);
		$feed->users_id = 1;
		$feed->name = "БКТ";
		$feed->date= date("Y-m-d H:i",time());
		$feed->save();
		echo json_encode(array("success"=>true));
    }
    
    
}

?>