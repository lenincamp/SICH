<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Car extends Private_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model(array('cars','mark','model','category'));
	}


	public function start()
	{
		if(!@$this->user) redirect ('main');
		$title['title'] = 'vehículo';

		$data['js'] = array(
			base_url()."static/js/library/alls.js",
			base_url()."static/js/users/car.js",
			base_url()."static/js/bootstrap-select.min.js",
			base_url()."static/js/i18n/defaults-es_CL.min.js",
			base_url()."static/js/pnotify.custom.min.js",
			base_url()."static/js/bootstrap-colorpicker.min.js",
			base_url()."static/js/docs.js",
			base_url()."static/js/jquery.dataTables.min.js",
			base_url()."static/js/dataTables.bootstrap.js"
		);
		
		//array_push($this->$data['js'], base_url()."static/js/users/car.js");
		
		$data['funcion'] = "<script type='text/javascript'> 
								seleccionar('mn_car');
								$(function(){
									$('.demo2').colorpicker();
								});
							</script>";
							
		$title['css'] = array(
			base_url()."static/css/bootstrap-select.min.css",
			base_url()."static/css/pnotify.custom.min.css",
			base_url()."static/css/bootstrap-colorpicker.min.css",
			base_url()."static/css/dataTables.bootstrap.css"
		);

		$this->load->view('templates/header', $title);
		$this->load->view('user/car');
		$this->load->view('templates/footer', $data);
	}
	
	/* =========================>>> MODELS <<<========================= */

	public function save_model()
	{
		if(!@$this->user) redirect ('main');
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
			//show_404();
		}
		return FALSE;
	}
	
	public function get_models_all()
	{
		if(!@$this->user) redirect ('main');
		if ($this->input->is_ajax_request()) 
    	{
    		$data = $this->model->get_all();
			echo json_encode(array("data"=>$data));
		}
		else
		{
			exit('No direct script access allowed');
			//show_404();
		}
		return FALSE;
	}
	
	public function get_models_for_mark(){
		if(!@$this->user) redirect ('main');
		if ($this->input->is_ajax_request()) 
    	{
    		$data = array(
    			'id_marca' => $this->input->post('id')
    		);
    		$response = $this->model->get_for_mark($data);
			echo json_encode(array("data"=>$response));
		}
		else
		{
			exit('No direct script access allowed');
		}
		return FALSE;
	}
	
	public function edit_model()
	{
		if(!@$this->user) redirect ('main');
		if ($this->input->is_ajax_request()) 
    	{
    		$data = array(
    			'mod_nom'  => $this->input->post('nameMd'),
				'id_marca' => $this->input->post('id_markMd')
    		);
			$response = $this->model->update($this->input->get('trId'), $data);
			echo json_encode($response);
		}
		else
		{
			exit('No direct script access allowed');
			//show_404();
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
			//show_404();
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
			//show_404();
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
			//show_404();
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
			//show_404();
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
			//show_404();
		}
		return FALSE;
	}
	
	/* =========================>>> CATEGORIES <<<========================= */
	
	public function save_category()
	{
		if(!@$this->user) redirect ('main');
		if ($this->input->is_ajax_request()) 
    	{
    		$data = array(
    			'cat_nom'  => strtoupper(trim($this->input->post('txtNameCateg')))
    		);

			$response = $this->category->save($data);
			echo $response;
		}
		else
		{
			exit('No direct script access allowed');
			//show_404();
		}
		return FALSE;
	}
	
	public function get_categories_all()
	{
		if(!@$this->user) redirect ('main');
		if ($this->input->is_ajax_request()) 
    	{
    		$data = $this->category->get_all();
			echo json_encode(array("data"=>$data));
		}
		else
		{
			exit('No direct script access allowed');
			//show_404();
		}
		return FALSE;
	}
	
	public function edit_category()
	{
		if(!@$this->user) redirect ('main');
		if ($this->input->is_ajax_request()) 
    	{
    		$data = array(
    			'cat_nom'  => $this->input->post('txtNameCategEdit')
    		);
			$response = $this->category->update($this->input->get('trId'), $data);
			echo json_encode($response);
		}
		else
		{
			exit('No direct script access allowed');
			//show_404();
		}
		return FALSE;
	}
	
	public function delete_category()
	{
		if(!@$this->user) redirect ('main');
		if ($this->input->is_ajax_request()) 
    	{
    		$data = array('cat_id' => $this->input->post('id'));
			$response = $this->category->delete($data);
			echo json_encode($response);
		}
		else
		{
			exit('No direct script access allowed');
			//show_404();
		}
		return FALSE;
	}
	
	/* =========================>>> CARS <<<========================= */
	public function save_car()
	{
		if(!@$this->user) redirect ('main');
		if ($this->input->is_ajax_request()) 
    	{
    		$data = array(
    			$this->input->post('txtCedula'),
				$this->input->post('txtNombre'),
				$this->input->post('txtApellido'),
				$this->input->post('txtDireccion'),
				$this->input->post('txtTelefono'),
				$this->input->post('txtEmail'),
				$this->input->post('txtChasis'),
				$this->input->post('txtPlaca'),
				$this->input->post('txtAnio'),
				$this->input->post('txtMotor'),
				$this->input->post('txtCodigo'),
				$this->input->post('txtColor'),
				$this->input->get('id'),
				$this->input->post('cmbIdModel')
    		);

			$response = $this->cars->save("SELECT insert_car(?,?,?,?,?,?,?,?,?,?,?,?,?,?)",$data);
			//exit(print_r($response));
			echo json_encode($response);
		}
		else
		{
			exit('No direct script access allowed');
			//show_404();
		}
		return FALSE;
	}
	
	public function get_cars_all()
	{
		if(!@$this->user) redirect ('main');
		if ($this->input->is_ajax_request()) 
    	{
    		$data = $this->cars->get_all();
			echo json_encode(array("data"=>$data));
		}
		else
		{
			exit('No direct script access allowed');
			//show_404();
		}
		return FALSE;
	}
}
/* End of file main.php */
/* Location: ./application/controllers/car.php */