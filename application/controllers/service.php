<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Service extends Private_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model(array('services','areas'));
	}
	/*
	 * -------------------------------------------------------------------
	 *  MARKS
	 * -------------------------------------------------------------------
	 */
	public function start()
	{
		if(!@$this->user) redirect ('main');
		$title['title'] = 'vehiculo';

		$data['js'] = array(
			base_url()."static/js/library/alls.js",
			base_url()."static/js/users/service.js",
			base_url()."static/js/bootstrap-select.min.js",
			base_url()."static/js/i18n/defaults-es_CL.min.js",
			base_url()."static/js/pnotify.custom.min.js",
			"https://cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js",
			"https://cdn.datatables.net/plug-ins/1.10.7/integration/bootstrap/3/dataTables.bootstrap.js"
		);
		$data['funcion']="<script type='text/javascript'> seleccionar('mn_srv');</script>";
		$title['css'] = array(
			base_url()."static/css/bootstrap-select.min.css",
			base_url()."static/css/pnotify.custom.min.css",
			base_url()."static/css/bootstrap-colorpicker.min.css",
			"https://cdn.datatables.net/plug-ins/1.10.7/integration/bootstrap/3/dataTables.bootstrap.css"
		);
		$this->load->view('templates/header', $title);
		$this->load->view('user/services');
		$this->load->view('templates/footer', $data);
	}
	
	/* =========================>>> AREA DE TRABAJO <<<========================= */

	public function save_area()
	{
		if(!@$this->user) redirect ('main');
		if ($this->input->is_ajax_request()) 
    	{
			$data = array(strtoupper(trim($this->input->post('txtNameArea'))));
			$response = $this->areas->selectSQL("SELECT insert_area(?)",$data);
			echo json_encode($response);
		}
		else
		{
			exit('No direct script access allowed');
			show_404();
		}
		return FALSE;
	}
	
	public function get_areas_all()
	{
		if(!@$this->user) redirect ('main');
		if ($this->input->is_ajax_request()) 
    	{
    		//$data = $this->areas->get_all();
			//echo json_encode(array("data"=>$data));
			$response = $this->areas->selectSQLAll("select * from get_all_areas()",null);
			echo json_encode(array("data"=>$response));
		}
		else
		{
			exit('No direct script access allowed');
			show_404();
		}
		return FALSE;
	}
	
	public function edit_area()
	{
		if(!@$this->user) redirect ('main');
		if ($this->input->is_ajax_request()) 
    	{
			$estado=($this->input->post('chkEstEdit')?true:false);
			$data = array(
    			'art_nom'  => $this->input->post('txtNameAreaEdit'),
				'art_est' => $estado
    		);
			$response = $this->areas->update($this->input->get('trId'), $data);
			echo json_encode($response);
		}
		else
		{
			exit('No direct script access allowed');
			show_404();
		}
		return FALSE;
	}
	
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
	
	/* =========================>>> MARKS <<<========================= */
	
	public function save_mark()
	{
		if(!@$this->user) redirect ('main');
		if ($this->input->is_ajax_request()) 
    	{
    		$data = array(
    			'mar_nom'  => $this->input->post('nameMark')
    		);

			$response = $this->mark->save($data);
			echo $response;
		}
		else
		{
			exit('No direct script access allowed');
			show_404();
		}
		return FALSE;
	}
	
	public function get_marks_all()
	{
		if(!@$this->user) redirect ('main');
		if ($this->input->is_ajax_request()) 
    	{
    		$data = $this->mark->get_all();
			echo json_encode(array("data"=>$data));
		}
		else
		{
			exit('No direct script access allowed');
			show_404();
		}
		return FALSE;
	}
	
	public function edit_mark()
	{
		if(!@$this->user) redirect ('main');
		if ($this->input->is_ajax_request()) 
    	{
    		$data = array(
    			'mar_nom'  => $this->input->post('nameMarkEdit')
    		);
			$response = $this->mark->update($this->input->get('trId'), $data);
			echo json_encode($response);
		}
		else
		{
			exit('No direct script access allowed');
			show_404();
		}
		return FALSE;
	}
	
	public function delete_mark()
	{
		if(!@$this->user) redirect ('main');
		if ($this->input->is_ajax_request()) 
    	{
    		$data = array('mar_id' => $this->input->post('id'));
			$response = $this->mark->delete($data);
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