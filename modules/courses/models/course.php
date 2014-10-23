<?php

class Course_Model extends ORM_Tree{
	protected $has_many = array('courses_langs','groups','plans');
	protected $has_one = array('page','preparation','price');


	public function parent(){
		if($this->parent_id == null)
			return $this;
		else
			
		return ORM::factory("course")->where("id",$this->parent_id)->find();
	}



	public function childs($id=0){

		$id = $id == 0 ? $this->id : $id;
		$childs = array();
		foreach(ORM::factory("course")->where("parent_id",$id)->find_all() as $course){
			if(count($course->childs()) > 0)
				$childs[] =  $this->childs($course->id);
			else 
				$childs[] = $course;
		}

		return $childs;
	}
}

	

?>