<?php

class News_Lang_Model extends ORM_Tree{
	protected $has_one = array('news');
	protected $has_many = array('comments');
}


?>