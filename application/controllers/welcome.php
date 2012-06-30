<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	function __construct(){
		// load controller parent
		parent::__construct();
		
		if(!$this->session->userdata('logged_in')) redirect('/login/');
		
		$this->load->model('service_model');
		
		$this->_data = new stdClass();
	}
	
	public function index()
	{
		$user = $this->session->userdata('user_data');
			
		$active_service = $this->service_model->getUserService($user['id']);
		
		$this->_data->services = $active_service;
	
		$this->load->view('welcome', $this->_data);
	}
	
}