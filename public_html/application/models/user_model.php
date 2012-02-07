<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
    function getEntries()
    {
        $query = $this->db->get('user');
        return $query->result();
    }

    function searchEntry($email)
    {
       	$this->db->where('email',$email);

        $query = $this->db->get('user');
        return $query->row();
    }
}