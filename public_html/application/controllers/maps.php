<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Maps extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->library('GoogleMapAPI');
		
		$this->load->model('maps_model');
	}

	public function index()
	{
		ini_set('display_errors',1);
		ini_set('error_reporting',1);
		
		$this->googlemapapi->_minify_js = isset($_REQUEST["min"])?FALSE:TRUE;
		$this->googlemapapi->setWidth('100%');
		$this->googlemapapi->setHeight('500px');
		
		$this->googlemapapi->setTypeControlsStyle('dropdown');
		$this->googlemapapi->setMapType('map');
		
		$results = $this->maps_model->get();
		
		foreach($results as $row){
		
			$this->googlemapapi->addMarkerByCoords($row->position_x, $row->position_y ,'<b>'.$row->name.'</b>','','',site_url('static/images/home.png'));
		}

		$this->load->view('maps/view');
		
	}
	
	
	function save(){
		
		$position = $this->input->get_post('position');
		$name = $this->input->get_post('name');
		
		$geocode = $this->googlemapapi->getGeocode($position);
		
		$sha1 = sha1(uniqid('maps'));
		
		$array = array(
			'name' => $name,
			'position'=> $position,
			'position_x' => $geocode['lon'],
			'position_y' => $geocode['lat'],
			'hashcode' => $sha1
		);
		
		$this->maps_model->save($array);
		
		redirect('maps');
	}
}