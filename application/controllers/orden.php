<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Orden extends Private_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model(array('clients','areas','services','details_inventary','orders'));
	}
	/*
	 * -------------------------------------------------------------------
	 *  ORDEN
	 * -------------------------------------------------------------------
	 */
	public function start()
	{
		if(!@$this->user) redirect ('main');
		$title['title'] = 'orden de trabajo';

		$data['js'] = array(
			base_url()."static/js/library/alls.js",
			base_url()."static/js/canvas.js",
			base_url()."static/js/users/orden.js",
			base_url()."static/js/pnotify.custom.min.js",
			base_url()."static/js/jquery.dataTables.min.js",
			base_url()."static/js/dataTables.bootstrap.js"
		);
		$data['funcion']="<script type='text/javascript'> seleccionar('mn_ord') </script>";
		$title['css'] = array(
			base_url()."static/css/pnotify.custom.min.css",
			base_url()."static/css/dataTables.bootstrap.css"
		);
		$contenido['detallesTrabajo']  = $this->areas->selectSQLAll("select * from get_all_areas() where art_est=true",null);
		$contenido['servicios']  = $this->services->get_all();
		$contenido['inventario']  = $this->details_inventary->get_all();
		$contenido['formasPago']  = $this->orders->selectSQLMultiple("select * from forma_pago",null);
		$this->load->view('templates/header', $title);
		$this->load->view('user/orden',$contenido);
		$this->load->view('templates/footer', $data);
	}
	
	/*
	 * -------------------------------------------------------------------
	 * MODELS
	 * -------------------------------------------------------------------
	 */
	public function delete_client()
	{
		if(!@$this->user) redirect ('main');
		if ($this->input->is_ajax_request()) 
    	{
    		$data = array('cli_id' => $this->input->post('id'));
			$response = $this->clients->delete($data);
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
    		/*$data = array(
    			'per_ced'  => $this->input->post('txtCedula'),
				'per_nom' => $this->input->post('txtNombre'),
				'per_ape' => $this->input->post('txtApellido'),
				'cli_dir' => $this->input->post('txtDireccion'),
				'cli_tel' => $this->input->post('txtTelefono'),
				'cli_eml' => $this->input->post('txtEmail')
    		);*/
			$data = array(
    			$this->input->post('txtCedula'),
				$this->input->post('txtNombre'),
				$this->input->post('txtApellido'),
				$this->input->post('txtDireccion'),
				$this->input->post('txtTelefono'),
				$this->input->post('txtEmail')
    		);

			//$response = $this->clients->save($data);
			$response = $this->clients->selectSQL("SELECT insert_client(?,?,?,?,?,?)",$data);

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
	
	public function search_client_by_id()
	{
		if(!@$this->user) redirect ('main');
		if ($this->input->is_ajax_request()) 
    	{
			$data= array('cli_id' => $this->input->post('id'));
    		$response = $this->clients->get($data);
			echo json_encode($response);
		}
		else
		{
			exit('No direct script access allowed');
			show_404();
		}
		return FALSE;
	}
	
	public function edit_client()
	{
		if(!@$this->user) redirect ('main');
		if ($this->input->is_ajax_request()) 
    	{
			$data = array(
    			'per_nom' => $this->input->post('txtNombreMd'),
				'per_ape' => $this->input->post('txtApellidoMd'),
				'cli_dir' => $this->input->post('txtDireccionMd'),
				'cli_tel' => $this->input->post('txtTelefonoMd'),
				'cli_eml' => $this->input->post('txtEmailMd')
    		);
			$response = $this->clients->update($this->input->get('trId'), $data);
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