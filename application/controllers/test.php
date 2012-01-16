<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Test extends CI_Controller {
	
	var $params = '';
	
	var $params_facebook = '';
	
	function index(){
		echo '<a href="'.site_url("test/twitter_request_token").'" onclick="window.open(this.href,\'name\',\'height=200,width=700\'); return false;">access via twitter</a>';
		echo '<a href="'.site_url("test/facebook_request_token").'" onclick="window.open(this.href,\'name\',\'height=200,width=700\'); return false;">access via facebook</a>';
	}

	function twitter_request_token()
	{
	  $params = $this->params;
	  $this->load->library('twitter_oauth', $params);
	  
	  $response = $this->twitter_oauth->get_request_token(site_url("test/twitter_access_token"));
	  $this->session->set_userdata('facebook_token_secret', $response['token_secret']);
	  redirect($response['redirect']);
	}
	 
	function twitter_access_token()
	{
	  $params = $this->params;
	  $this->load->library('twitter_oauth', $params);
	  $response = $this->twitter_oauth->get_access_token(false, $this->session->userdata('twitter_token_secret'));
	  
	  echo '
	  <script>
	 	window.close();
	  </script>
	  ';
	  //$this->_store_in_db($response);
	}

	function facebook_request_token()
	{
	  $params = $this->params_facebook;
	  $this->load->library('facebook_oauth', $params);
	  
	  $response = $this->facebook_oauth->get_request_token(site_url("test/facebook_access_token"));
	  
	  redirect(redirect("https://www.facebook.com/dialog/oauth?client_id=".$params['key']."&redirect_uri=".site_url("test/facebook_access_token")));
	}
	 
	function facebook_access_token()
	{
	  $params = $this->params_facebook;
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