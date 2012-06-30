<?php
class Dao extends CI_Model{

	
	var $_table = 'table';
	var $_primary_key = 'id';

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    function insert($data)
    {
 		if(is_array($data)){
 			$this->db->insert($this->_table, $data); 
 		}
    }

    function update($data, $primary_key)
    {
 		if(is_array($data)){
 			$this->db->where($this->_table.'.'.$this->_primary_key, $primary_key);
 			$this->db->update($this->_table, $data); 
 		}
    }
    
    function getAll()
    {
        $query = $this->db->get('user');
        return $query->result();
    }

    function get($primary_key)
    {
       	$this->db->where($this->_table.'.'.$this->_primary_key,$primary_key);

        $query = $this->db->get($this->_table);
        return $query->row();
    }
}