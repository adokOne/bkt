<?php defined('SYSPATH') OR die('No direct access allowed.');

class Picture_Model extends ORM {
	
	// This class can be replaced or extende
	protected $sorting = array();


    
    public function delete_by_ad($id = NULL){
        if ($id === NULL AND $this->loaded){
            $id = $this->object[$this->primary_key];
        }
        
        $id = intval($id);
        
        $pictures = ORM::factory('picture')->where('ad_id', $id)->find_all();
        
        foreach($pictures as $picture){
            $this->delete($picture->id);
            
            dir::remove('upload/adv/'.$id);
        }
    }
    
    public function delete($id = NULL){
        if ($id === NULL AND $this->loaded){
            $id = $this->object[$this->primary_key];
        }
        
        $id = intval($id);
        
        $this->db->where('id', $id)->delete('pictures');
        
        return $this->clear();
    }
} // End User Model