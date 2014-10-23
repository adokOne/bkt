<?php
/**
 * Pictures controller
 */

class Pictures_Controller extends Controller {
	
	function __construct(){
	     parent::__construct();
	}
/*	
	public function uploader_form($event_id = null){
		$this->session = Session::instance();
		$key = $this->session->id();
		
		$view = new View('uploader_form');
		$view->key = $key;
		$view->event_id = $event_id;
		$view->render(true);
	}
	
	public function upload(){
		
		$sessid = $this->input->post('hash', null, false);
		$this->session = Session::instance();
		$key = $this->session->id();
		Kohana::log('debug','SESSION STARTED_with_ID: ' . $key);
		Kohana::log('debug','SESSION POSTID: ' . $sessid);
		if(!empty($sessid) && $key != $sessid && !Auth::instance()->logged_in()){
			Kohana::log('debug','SESSION Creating.......................');
			$this->session->create(NULL, $sessid );
		}
		$key = $this->session->id();
		
		Kohana::log('debug','SESSION CREATEDID: ' . $key);
		
		if(!Auth::instance()->logged_in()){
			header('HTTP/1.1 501 Internal Server Error');	
			return;
		}else {
			$this->logged_in = true;
			$this->user = Auth::instance()->get_user();
		}
		
		$user_id = $this->user->id;
		$event_id = $this->input->post('event_id', 0, true);
		if(!$event_id){
			header('HTTP/1.1 500 Internal Server Error');	
			exit;
		}
		
		$u_id = uniqid();
		
		if( !empty($_FILES['Filedata']['tmp_name']) && EASYRENTPicture::process_picture($_FILES['Filedata']['tmp_name'], $u_id ,$user_id, $event_id ) ){
			
			$picture = ORM::factory('picture');
			$picture->name = $_FILES['Filedata']['name'];
			$picture->u_id = $u_id;
			$picture->adddate = time();
			$picture->author_id = $user_id;
			$picture->event_id = $event_id;
			$picture->save();
		} 
		$view = new View('image_item');
		$view->picture = $picture;
		$view->render(true);
	}
	

	public function drop_image($image_id){
		if(!$this->logged_in){
			Kohana::show_404();
		}
		$picture = ORM::factory('picture', $image_id);
		if($picture->author_id != $this->user->id){
			Kohana::show_404();
		}
		
		if(MOJOPicture::deletePicture($picture->event_id, $picture->u_id)){
			$picture->delete();
			return 1;
		}
		
		header('HTTP/1.1 500 Internal Server Error');
			
	}

	// does not delete picture from database
	public function remove_image($image_id){
		if(!$this->logged_in){
			Kohana::show_404();
		}
		$picture = ORM::factory('picture', $image_id);
		if($picture->author_id != $this->user->id){
			Kohana::show_404();
		}
		
		if(EASYRENTPicture::deletePicture($picture->event_id, $picture->u_id)){
			$comments = ORM::factory('comment')->where(array('item_type'=>'picture', 'item_id'=>$picture->id ))->delete_all();
			$picture->deleted = 1;
			$picture->save();
			echo json_encode( array('msg'=>'ok', 'data'=>'' ));
			return;
		}
		
		header('HTTP/1.1 500 Internal Server Error');
			
	}
*/
}
	