<?php defined('SYSPATH') OR die('No direct access allowed.');

class User_Model extends Auth_User_Model {
	
	protected $has_one = array('role');
	protected $sorting = array();
	/**
	 * 
	 * @return void
	 */
	public function getAge(){
		$this->age = self::modifier_getAge($this->birthday); 	
	}
	
	/**
	 * 
	 * @param $birthday
	 * @return unknown_type
	 */
	static public function modifier_getAge($birthday){
		
		$dob = date("Y-m-d",$birthday);
    	$ageparts = explode("-",$dob);
    	$age = date("Y-m-d")-$dob;
	
		return (date("nd") < $ageparts[1].str_pad($ageparts[2],2,'0',STR_PAD_LEFT)) ? $age-=1 : $age;
	}
	
	public function __get($column){
		if($column == 'age'){
			return self::modifier_getAge(parent::__get('birthday'));
		}
		
		return parent::__get($column);
	}
	
	public function sorting($sortby = array()){
		
		$this->sorting = $sortby;
		
		return $this;
		
	}
	
	/**
	 * Видалення користувача
	 *
	 * @param integer $user_id - ID учетной записи пользователя
	 */
	public function delete_user($user_id){

		$user = ORM::factory('user',$user_id);
		$user->delete();				
		
		return true;		
		
	}
	
} // End User Model