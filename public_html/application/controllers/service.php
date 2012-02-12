<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Service extends CI_Controller {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
		$this->load->model('service_model');
    }
	
	function request($id = 0){
		if(!$id){
			$this->load->view('default/close');
			return;
		}
		$params = $this->service_model->searchEntryId($id);
		$this->load->library('social/'.$params->class, (array)$params);
		 
		$response = $this->{$params->class}->get_request_token(site_url("service/access/".$id));
		redirect($response['redirect']);	
	}
	
	function access($id){
		if(!$id){
			$this->load->view('default/close');
			return;
		}
		$params = $this->service_model->searchEntryId($id);
		$this->load->library('social/'.$params->class, (array)$params);
	
		$response = $this->{$params->class}->get_access_token();
		var_dump($response);
		
		/*
		* oauth_token
		* oauth_verifier
		*/
		
		//$this->service->saveUserService();
	}
	
	
	

	function twitter_request_token()
	{
		$this->load->model('service_model');
		$params = $this->service_model->searchEntry('twitter');
		$result = array('key' => $params->key, 'secret' => $params->secret);
		$this->load->library('twitter_oauth', $result);
		//test
		$response = $this->twitter_oauth->get_request_token(site_url("test/twitter_access_token"));
		$this->session->set_userdata('twitter_token_secret', $response['token_secret']);
		redirect($response['redirect']);
	}
	 
	function twitter_access_token()
	{
		$this->load->model('service_model');
		$this->load->library('twitteroauth/twitteroauth','','twitteroauth');
		
		$params = $this->service_model->searchEntry('twitter');
		$result = array('key' => $params->key, 'secret' => $params->secret);
		$this->load->library('twitter_oauth', $result);
		
		$response = $this->twitter_oauth->get_access_token(false, $this->session->userdata('twitter_token_secret'));
		
		$this->twitteroauth->prepare($params->key, $params->secret, $response['oauth_token'], $response['oauth_token_secret']);
		$content = $this->twitteroauth->get("statuses/home_timeline");
		
		
		foreach($content as $row){
			echo $row->text."<br><br>";
		}
		die();
		echo '
		<script>
		window.close();
		</script>
		';
		//$this->_store_in_db($response);
	}

	function facebook_request_token()
	{
		$this->load->model('service_model');
		$params = $this->service_model->searchEntry('facebook');
		$this->load->library('facebook_oauth', $params);
		
		$response = $this->facebook_oauth->get_request_token(site_url("test/facebook_access_token"));
		
		redirect("https://www.facebook.com/dialog/oauth?client_id=".$params->key."&redirect_uri=".site_url("test/facebook_access_token").'&response_type=token');
	}
	 
	function facebook_access_token()
	{
		$this->load->model('service_model');
		$params = $this->service_model->searchEntry('facebook');
		$this->load->library('facebook_oauth', $params);
		$response = $this->facebook_oauth->get_access_token(false, $this->session->userdata('facebook_token_secret'));
		
		echo '
		<script>
			window.close();
		</script>
		';
		//$this->_store_in_db($response);
	}
}