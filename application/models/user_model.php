<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends DAO {
	
	var $_table = 'email';
	var $_primary_key = 'id';
	
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    function searchEntry($email)
    {
       	$this->db->where('email',$email);

        $query = $this->db->get('user');
        return $query->row();
    }
}