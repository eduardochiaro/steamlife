<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Maps_model extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
    function get()
    {
        $query = $this->db->get('maps');
        return $query->result();
    }

    function search($name)
    {
       	$this->db->where('name',$name);

        $query = $this->db->get('maps');
        return $query->row();
    }

    function save($data)
    {
 
 		if(is_array($data)) $this->db->insert('maps', $data); 

    }
}