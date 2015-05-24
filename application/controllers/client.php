<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Client extends Private_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model(array('clients'));
	}
	/*
	 * -------------------------------------------------------------------
	 *  MARKS
	 * -------------------------------------------------------------------
	 */
	public function start()
	{
		if(!@$this->user) redirect ('main');
		$title['title'] = 'clientes';

		$data['js'] = array(
			base_url()."static/js/users/clients.js",
			base_url()."static/js/bootstrap-select.min.js",
			base_url()."static/js/i18n/defaults-es_CL.min.js",
			base_url()."static/js/pnotify.custom.min.js",
			"https://cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js",
			"https://cdn.datatables.net/plug-ins/1.10.7/integration/bootstrap/3/dataTables.bootstrap.js"
		);
		$data['funcion']="<script type='text/javascript'> seleccionar('mn_cli') </script>";
		$title['css'] = array(
			base_url()."static/css/bootstrap-select.min.css",
			base_url()."static/css/pnotify.custom.min.css",
			"https://cdn.datatables.net/plug-ins/1.10.7/integration/bootstrap/3/dataTables.bootstrap.css"
		);
		
		
		$this->load->view('templates/header', $title);
		$this->load->view('user/client');
		$this->load->view('templates/footer', $data);
	}
	
	/*
	 * -------------------------------------------------------------------
	 * MODELS
	 * -------------------------------------------------------------------
	 */
	public function delete_model()
	{
		if(!@$this->user) redirect ('main');
		if ($this->input->is_ajax_request()) 
    	{
    		$data = array('mod_id' => $this->input->post('id'));
			$response = $this->model->delete($data);
			echo json_encode($response);
		}
		else
		{
			exit('No direct script access allowed');
			show_404();
		}
		return FALSE;
	}
	public function save_client()
	{
		if(!@$this->user) redirect ('main');
		if ($this->input->is_ajax_request()) 
    	{
    		$data = array(
    			'per_ced'  => $this->input->post('txtCedula'),
				'per_nom' => $this->input->post('txtNombre'),
				'per_ape' => $this->input->post('txtApellido'),
				'cli_dir' => $this->input->post('txtDireccion'),
				'cli_tel' => $this->input->post('txtTelefono'),
				'cli_eml' => $this->input->post('txtEmail')
    		);

			$response = $this->clients->save($data);
			echo json_encode($response);
		}
		else
		{
			exit('No direct script access allowed');
			show_404();
		}
		return FALSE;
	}
	
	public function get_clients_all()
	{
		if(!@$this->user) redirect ('main');
		if ($this->input->is_ajax_request()) 
    	{
    		$data = $this->clients->get_all();
			echo json_encode(array("data"=>$data));
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