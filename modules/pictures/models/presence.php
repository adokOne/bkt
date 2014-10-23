<?php defined('SYSPATH') OR die('No direct access allowed.');

class Presence_Model extends ORM {
	protected $belongs_to  = array('picture', 'user');
}