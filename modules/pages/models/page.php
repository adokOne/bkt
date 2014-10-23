<?php 
class Page_Model extends ORM{
	

	protected $has_many = array('pages_lang');
	
	public function sorting($sortby = array()){
		
		$this->sorting = $sortby;
		
		return $this;
		
	}
	
	
}