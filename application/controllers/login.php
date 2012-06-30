<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	var $_data = null;

	function __construct(){
		// load controller parent
		parent::__construct();
		
		$this->_data = new stdClass();
	}
	public function index()
	{
		$this->load->helper('form');
		
		$url = $this->session->userdata('actual_url');
		$this->session->set_userdata('actual_url',null);
		if(empty($url)){
			$url = "welcome";
		}

		$this->load->library('form_validation');

		$this->form_validation->set_rules('username', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'required');

		if ($this->form_validation->run() == FALSE)
		{
			//$this->load->view('myform');
		}else{
		
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			
			if($this->_login($username,$password)){
				
				$user = $this->session->userdata('user_data');
				redirect('/'.$url.'/', 'refresh');
				
			}
			
			$error = $this->session->userdata('login_error');
			if($error){
				$this->_data->error = $error;
			}
			$this->session->set_userdata('login_error',null);
		
		
		}
		
		$this->load->view('login/form', $this->_data);
	}
	
	/**
     * Login and sets session variables
     *
     * @access    private
     * @param    string
     * @param    string
     * @return    bool
     */
    private function _login($user = '', $password = '') {
      
        //Make sure login info was sent
        if($user == '' OR $password == '') {
            return false;
        }

        //Check if already logged in
        if($this->session->userdata('username') == $user) {
            //User is already logged in.
            return false;
        }
        $access = false;
        $row = array();
		
		$this->load->model('user_model');
		
		$return = $this->user_model->searchEntry($user);
		
		
	    
        if (!empty($return)) {
        	
			if($return->password != sha1($password.':'.$return->salt)){
	        	$this->session->set_userdata('login_error','wrong username or password');
	            return false;
			}
				
			$row = array(
				'id' => $return->id,
				'email' => $return->email
			);

            //Destroy old session
            $this->session->sess_destroy();
            
            //Create a fresh, brand new session
            $this->session->sess_create();
            
            //Set session data
            $this->session->set_userdata('user_data', $row);
            
            //Set logged_in to true
            $this->session->set_userdata('logged_in', true);            
            
            //Login was successful            
            return true;
        } else {
        	$this->session->set_userdata('login_error','wrong username or password');
            //No user result found
            return false;
        }    

    }

    /**
     * Logout user
     *
     * @access    public
     * @return    void
     */
    function logout() {     

        //Destroy session
        $this->session->sess_destroy();
		redirect('/login/', 'refresh');
    }
}