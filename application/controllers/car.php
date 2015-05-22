<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Car extends Private_Controller {

	function __construct() {
		parent::__construct();
	}
	
	public function start()
	{
		if(!@$this->user) redirect ('main');
		$title['title'] = 'vehiculo';
		$data['js'] = array(
			"src" => base_url()."static/js/users/car.js",
			"src" => base_url()."static/js/bootstrap-select.min.js",
			//"src" => base_url()."static/js/i18n/defaults-es_CL.min.js"			
		);
		$title['css'] = array("href" => base_url()."static/css/bootstrap-select.min.css");
		$this->load->view('templates/header', $title);
		$this->load->view('user/car');
		$this->load->view('templates/footer', $data);
	}
}
/* End of file main.php */
/* Location: ./application/controllers/car.php */