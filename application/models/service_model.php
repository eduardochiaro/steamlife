<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Service_model extends DAO {
	
	var $_table = 'service';
	var $_primary_key = 'id';

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
   
    function searchEntry($name)
    {
       	$this->db->where('name',$name);

        $query = $this->db->get('service');
        return $query->row();
    }
    
    function getUserService($user_id){
    	if($user_id){
	    	$this->db->select('s.*, us.token')
	    			->from('service AS s')
	    			->join('user_service AS us','us.service_id = s.id AND us.user_id = '.(int)$user_id,'LEFT');
	    	
	    	$query = $this->db->get();
	        return $query->result();
        }
    }
}