<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Service_model extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
    function getEntries()
    {
        $query = $this->db->get('service');
        return $query->result();
    }

    function searchEntry($name)
    {
       	$this->db->where('name',$name);

        $query = $this->db->get('service');
        return $query->row();
    }
}