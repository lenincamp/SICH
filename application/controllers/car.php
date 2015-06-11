<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Car extends Private_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model(array('cars','mark','model','category','details_inventary'));
	}


	public function start()
	{
		if(!@$this->user) redirect ('main');
		$title['title'] = 'vehículo';

		$data['js'] = array(
			base_url()."static/js/library/alls.js",
			base_url()."static/js/users/car.js",
			base_url()."static/js/pnotify.custom.min.js",
			base_url()."static/js/bootstrap-colorpicker.min.js",
			base_url()."static/js/docs.js",
			base_url()."static/js/jquery.dataTables.min.js",
			base_url()."static/js/dataTables.bootstrap.js",
			base_url()."static/js/fileinput.min.js",
			base_url()."static/js/fileinput_locale_es.js"
		);
		
		//array_push($this->$data['js'], base_url()."static/js/users/car.js");
		
		$data['funcion'] = "<script type='text/javascript'> 
								seleccionar('mn_car');
								$(function(){
									$('.demo2').colorpicker();
								});
							</script>";
							
		$title['css'] = array(
			base_url()."static/css/pnotify.custom.min.css",
			base_url()."static/css/bootstrap-colorpicker.min.css",
			base_url()."static/css/dataTables.bootstrap.css",
			base_url()."static/css/fileinput.min.css"
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
				'id_marca' => $this->input->post('id_mark'),
				'cat_id'   => $this->input->post('id_cat')
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
				'id_marca' => $this->input->post('id_markMd'),
				'cat_id'   => $this->input->post('id_catMd')
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
	
	/* =========================>>> DETAILS INVENTARY <<<========================= */
	
	public function save_inventary()
	{
		if(!@$this->user) redirect ('main');
		if ($this->input->is_ajax_request()) 
    	{
    		$data = array(
    			'pie_nom'  => $this->input->post('txtNameInventario')
    		);

			$response = $this->details_inventary->save($data);
			echo $response;
		}
		else
		{
			exit('No direct script access allowed');
			//show_404();
		}
		return FALSE;
	}
	
	public function get_inventary_all()
	{
		if(!@$this->user) redirect ('main');
		if ($this->input->is_ajax_request()) 
    	{
    		$data = $this->details_inventary->get_all();
			echo json_encode(array("data"=>$data));
		}
		else
		{
			exit('No direct script access allowed');
			//show_404();
		}
		return FALSE;
	}
	
	public function edit_inventary()
	{
		if(!@$this->user) redirect ('main');
		if ($this->input->is_ajax_request()) 
    	{
    		$data = array(
    			'pie_nom'  => $this->input->post('txtNameInventarioEdit')
    		);
			$response = $this->details_inventary->update($this->input->get('trIdInv'), $data);
			echo json_encode($response);
		}
		else
		{
			exit('No direct script access allowed');
			//show_404();
		}
		return FALSE;
	}
	
	public function delete_inventary()
	{
		if(!@$this->user) redirect ('main');
		if ($this->input->is_ajax_request()) 
    	{
    		$data = array('pie_id' => $this->input->post('id'));
			$response = $this->details_inventary->delete($data);
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
			$path = "uploads/";
			$filesUrl = $_FILES;
			$new_name = $this->input->post('txtPlaca');
			if($this->do_upload($this->input->post('txtPlaca'), 'images'))
			{
				$img = $path.$new_name."_".$filesUrl['images']['name'][0].",".$path.$new_name."_".$filesUrl['images']['name'][1];
			}
			else
			{
				$img = $path.$new_name."_".$filesUrl['images']['name'][0];
			}
			
    		$data = array(
    			$this->input->post('txtCedula'),
				$this->input->post('txtNombre'),
				$this->input->post('txtApellido'),
				$this->input->post('txtDireccion'),
				$this->input->post('txtEmail'),
				$this->input->post('txtChasis'),
				$this->input->post('txtPlaca'),
				$this->input->post('txtAnio'),
				$this->input->post('txtMotor'),
				$this->input->post('txtCodigo'),
				$this->input->post('txtColor'),
				$this->input->get('id'),
				$this->input->post('cmbIdModel'),
				"{".$this->input->get('tels')."}",
				"{".$img."}"
    		);

			$response = $this->cars->querySQL("SELECT insert_car(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)",$data);
			echo json_encode($response);
			
		}
		else
		{
			exit('No direct script access allowed');
		}
		return FALSE;
	}
	
	function do_upload($ci,$name)
	{
	    $files = $_FILES;
	    $cpt = count($_FILES[$name]['name']);
	    for($i=0; $i<$cpt; $i++)
	    {
			//if($files['images']['size'][$i] > (1024000) && $files['images']['size'][$i] <= (2048000)) //can't be larger than 1 MB - 2mb
			//{
		        $_FILES[$name]['name']		= $files[$name]['name'][$i];
		        $_FILES[$name]['type']		= $files[$name]['type'][$i];
		        $_FILES[$name]['tmp_name']	= $files[$name]['tmp_name'][$i];
		        $_FILES[$name]['error']		= $files[$name]['error'][$i];
		        $_FILES[$name]['size']		= $files[$name]['size'][$i];
				$new_name = $ci."_".$_FILES[$name]['name'];
			    move_uploaded_file($_FILES[$name]['tmp_name'], './uploads/'.$new_name);
			//}
			
	    }
		if ($cpt>1)
		{
			return true;
		}
		else{
			return false;
		}
	}
	
	public function update_car()
	{
		if(!@$this->user) redirect ('main');
		if ($this->input->is_ajax_request()) 
    	{
			$path = "uploads/";
			$filesUrl = $_FILES;
			$new_name = $this->input->post('txtPlacaMd');
			if($this->do_upload($this->input->post('txtPlacaMd'), 'imagesMd'))
			{
				$img = $path.$new_name."_".$filesUrl['imagesMd']['name'][0].",".$path.$new_name."_".$filesUrl['imagesMd']['name'][1];
			}
			else
			{
				$img = $path.$new_name."_".$filesUrl['imagesMd']['name'][0];
			}
    		$data = array(
				$this->input->post('txtNombreMd'),
				$this->input->post('txtApellidoMd'),
				$this->input->post('txtDireccionMd'),
				$this->input->post('txtEmailMd'),
				$this->input->post('txtChasisMd'),
				$this->input->post('txtPlacaMd'),
				$this->input->post('txtAnioMd'),
				$this->input->post('txtMotorMd'),
				$this->input->post('txtCodigoMd'),
				$this->input->post('txtColorMd'),
				$this->input->post('cmbIdModelMd'),
				$this->input->get('id'),
				$this->input->get('idCl'),
				"{".$this->input->get('tels')."}",
				"{".$img."}"
    		);

			$response = $this->cars->querySQL("SELECT update_car(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)",$data);
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
	
	public function get_for_client()
	{
		if(!@$this->user) redirect ('main');
		if ($this->input->is_ajax_request()) 
    	{
			$data=array('cli_id' => $this->input->get('id'));
    		$response = $this->cars->get_for_client($data);
			echo json_encode(array("data"=>$response));
		}
		else
		{
			exit('No direct script access allowed');
			//show_404();
		}
		return FALSE;
	}
	
	public function get_car_by_id()
	{
		if(!@$this->user) redirect ('main');
		if ($this->input->is_ajax_request()) 
    	{
    		$data = array('veh_id' => $this->input->post('id'));
    		$response = $this->cars->get_for_id($data);
			echo json_encode($response);
		}
		else
		{
			exit('No direct script access allowed');
		}
		return FALSE;
	}
	
	public function delete_car()
	{
		if(!@$this->user) redirect ('main');
		if ($this->input->is_ajax_request()) 
    	{
    		$data = array('veh_id' => $this->input->post('id'));
			$response = $this->cars->delete($data);
			echo json_encode($response);
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