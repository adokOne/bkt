<?php

/**
 * Friends controller
 * 
 * @author dem
 * @package mojo
 * @subpackage user
 */
class Friends_Controller extends Controller {
	
	public function index(){
		
	}
	
	public function create(){
		
	}
	
	public function update(){
		if($this->logged_in and request::is_ajax()){
			$action = $this->input->post('action', null, true);
			$user_id = $this->input->post('user_id', null, true);
			//var_dump($_POST);
			//
			if($action == 'add' and ctype_digit($user_id)){
				$result = MOJOFriendship::create($this->user->id, $user_id);
				if($result == TRUE){
					echo json_encode(array('msg'=>'ok', 'data'=>'Приглашение отослано'));
				} else {
					echo json_encode(array('msg'=>'fail', 'data'=>'Не удалось отправить приглашение'));
				}
				exit;
			}
		} else Kohana::show_404();
	}
	
	public function destroy(){
		$friend_id = intval( $this->input->post('friend_id', 0, true) );
		
		if($friend_id > 0 && $this->logged_in && request::is_ajax()){
			$friend = ORM::factory('user', $friend_id);
			if( !empty($friend->id)){ 
				MOJOFriendship::cancel($this->user->id, $friend->id);
				echo json_encode( array('msg'=>'ok', 'data'=>'' ));
				return;	
			}
		}
		Kohana::show_404();
	}
	
	public function approve(){
		$friend_id = intval( $this->input->post('friend_id', 0, true) );
		
		//$friend_id = 1;
		//$p=new Profiler();
		if($friend_id > 0 && $this->logged_in ){
			$friend = ORM::factory('user', $friend_id);
			$event = ORM::factory('event')
						->join('events_users', 'events_users.event_id', 'events.id')
						->where(array('events_users.user_id'=>$friend_id,
									  'events.start_date >'=>time()) )
						->orderby('events.start_date', 'asc')
						->find();
			if( !empty($friend->id)){ 
				MOJOFriendship::approve($this->user->id, $friend->id);
				
				$view = new View('friend_one');
				$view->friend = $friend;
				$view->event = $event;
				echo json_encode( array('msg'=>'ok', 'data'=>$view->render() ));
				return;	
			}
		}
		Kohana::show_404();
		
	}
	
	public function decline(){
		$friend_id = intval( $this->input->post('friend_id', 0, true) );
		
		//$friend_id = 1;
		//$p=new Profiler();
		if($friend_id > 0 && $this->logged_in ){
			$friend = ORM::factory('user', $friend_id);
			$event = ORM::factory('event')
						->join('events_users', 'events_users.event_id', 'events.id')
						->where(array('events_users.user_id'=>$friend_id,
									  'events.start_date >'=>time()) )
						->orderby('events.start_date', 'asc')
						->find();
			if( !empty($friend->id)){ 
				MOJOFriendship::cancel($this->user->id, $friend->id);
				
				$view = new View('friend_one');
				$view->friend = $friend;
				$view->event = $event;
				echo json_encode( array('msg'=>'ok', 'data'=>$view->render() ));
				return;	
			}
		}
		Kohana::show_404();
		
	}
	
	public function add_form(){
		if($this->logged_in && request::is_ajax() ){
			$view = new View('friends_add_form');
			$view->render(true);
			return;
		}
		Kohana::show_404();
	}
	
	public function add_friends(){
		if($this->logged_in && request::is_ajax() ){
			
			$friends = str_replace(' ', '', trim( $this->input->post('friends_list', null, true) ));
			if(!empty($friends)){
				$pieces = explode(',',$friends);
				$not_found_users = array();
				$added_users = array();
				
				foreach($pieces as $u){
					$friend = ORM::factory('user');
					$friend->find($u);
					if(!empty($friend->id) && $friend->id != $this->user->id){
						//adding as friend
						MOJOFriendship::create($this->user->id, $friend->id);
						$added_users[] = $friend;
					}else {
						$not_found_users[] = $u;
					}
					//$friend->clear();
				}
				$view = new View('friends_added');
				$view->not_found = $not_found_users;
				$view->added_users = $added_users;
				echo json_encode( array('msg'=>'ok', 'data'=>$view->render() ));
				return;
			}else {			
				echo json_encode( array('msg'=>'error', 'data'=>Kohana::lang('user.input_username_or_email') ));
				return;
			}
		}
		Kohana::show_404();
	}
}