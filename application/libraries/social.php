<?php


class Social {

    private $_consumer = false;
    private $_back = false;
    private $CI = false;

    public function __construct($params)
    {
        $this->CI = get_instance();
        
        if(!array_key_exists('method', $params))$params['method'] = 'GET';
        if(!array_key_exists('algorithm', $params))$params['algorithm'] = OAUTH_ALGORITHMS::HMAC_SHA1;
        
        $this->_consumer = $params;
        
    }
	
	function loadService($backpage){
		 $classname = 'social/'.$this->_consumer->class;
		 $this->CI->load->library($classname);
		 
		 $response = $this->CI->{$this->_consumer->class}->get_request_token($backpage);
		 
	}
}