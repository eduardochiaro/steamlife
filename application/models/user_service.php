<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_Service extends DAO {
	
	var $_table = 'user_service';
	var $_primary_key = 'id';

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
   
    function getByUserAndService($user_id, $service_id)
    {
       	$this->db->where('user_id',$user_id);
       	$this->db->where('service_id',$service_id);

        $query = $this->db->get($this->_table);
        return $query->row();
    }
    
}