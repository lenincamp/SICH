<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Car extends Private_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model(array('mark','model'));
	}
	
	public function start()
	{
		if(!@$this->user) redirect ('main');
		$title['title'] = 'vehiculo';
		$data['js'] = array(
			base_url()."static/js/users/car.js",
			base_url()."static/js/bootstrap-select.min.js",
			base_url()."static/js/i18n/defaults-es_CL.min.js"			
		);
		$data['funcion']="<script type='text/javascript'> seleccionar('mn_car') </script>";
		$title['css'] = array("href" => base_url()."static/css/bootstrap-select.min.css");
		
		$mark['mark'] = $this->mark->get_all();
		
		$this->load->view('templates/header', $title);
		$this->load->view('user/car', $mark);
		$this->load->view('templates/footer', $data);
	}
	
	public function save_model()
	{
		if ($this->input->is_ajax_request()) 
    	{
    		$data = array(
    			'mod_nom'  => $this->input->post('name'),
				'id_marca' => $this->input->post('id_mark')
    		);

			$response = $this->model->save($data);
			echo json_encode($response);
		}
		else
		{
			exit('No direct script access allowed');
			show_404();
		}
		return FALSE;
	}
}
/* End of file main.php */
/* Location: ./application/controllers/car.php */