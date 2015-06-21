<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Service extends Private_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model(array('services','areas','category'));
	}
	/*
	 * -------------------------------------------------------------------
	 *  MAIN SERVICES
	 * -------------------------------------------------------------------
	 */
	public function start()
	{
		if(!@$this->user) redirect ('main');
		$title['title'] = 'servicios';

		$data['js'] = array(
			base_url()."static/js/library/alls.js",
			base_url()."static/js/users/service.js",
			base_url()."static/js/pnotify.custom.min.js",
			base_url()."static/js/jquery.dataTables.min.js",
			base_url()."static/js/dataTables.bootstrap.js"
		);
		$data['funcion']="<script type='text/javascript'> seleccionar('mn_srv'); 
		$(function(){
			$.renderizeDivDetailsService('contenedor_servicios','');
			
		});</script>";
		$title['css'] = array(
			base_url()."static/css/pnotify.custom.min.css",
			base_url()."static/css/bootstrap-colorpicker.min.css",
			base_url()."static/css/dataTables.bootstrap.css"
		);
		$contenido["categorias"]=$this->category->get_all();
		$this->load->view('templates/header', $title);
		$this->load->view('user/services',$contenido);
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
	
	public function get_areas_enable()
	{
		if(!@$this->user) redirect ('main');
		if ($this->input->is_ajax_request()) 
    	{
    		//$data = $this->areas->get_all();
			//echo json_encode(array("data"=>$data));
			$response = $this->areas->selectSQLAll("select * from get_all_areas() where art_est=true",null);
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
	
	public function delete_area()
	{
		if(!@$this->user) redirect ('main');
		if ($this->input->is_ajax_request()) 
    	{
    		$data = array('art_id' => $this->input->post('id'));
			$response = $this->areas->delete($data);
			echo json_encode($response);
		}
		else
		{
			exit('No direct script access allowed');
			show_404();
		}
		return FALSE;
	}
	
	/* =========================>>> SERVICE <<<========================= */
	
	public function save_service()
	{
		$detalles=array();
		$precios=array();
		if(!@$this->user) redirect ('main');
		if ($this->input->is_ajax_request()) 
    	{
			

			$categorias=explode(",",$this->input->get('ctgId'));
			$areas=explode(",",$this->input->get('arsId'));
			/*foreach ($categorias as $keyC => $valueC) 
			{
				foreach ($areas as $keyA => $valueA) 
				{
					if($this->input->post('txtPrc'.$valueC."_".$valueA))
					{
						array_push($response,$this->input->post('txtPrc'.$valueC."_".$valueA));
					}
				}
			}
			$data = array(
				$this->input->post('txtNameService'),
    			"{".$this->input->get('ctgId')."}",
				"{".$this->input->get('arsId')."}",
				"{".implode(",",$response)."}"
    		);
			//$response = $this->services->selectSQL("SELECT insert_service(?,?,?,?)",$data);
			echo json_encode($response);*/
			foreach ($areas as $keyA => $valueA) 
			{
				if($this->input->post('cat'.$valueA))
				{
					array_push($detalles,$this->input->post('cat'.$valueA));
				}
			}
			foreach ($categorias as $keyC => $valueC) 
			{
				if($this->input->post('prc'.$valueC))
				{
					array_push($precios,$this->input->post('prc'.$valueC));
				}
			}
			$data = array(
				$this->input->post('txtNameService'),
    			"{".$this->input->get('ctgId')."}",
				"{".implode(",",$detalles)."}",
				"{".implode(",",$precios)."}"
    		);
			$response = $this->services->selectSQL("SELECT insert_service(?,?,?,?)",$data);
			echo json_encode($response);
		}
		else
		{
			exit('No direct script access allowed');
			show_404();
		}
		return FALSE;
	}
	
	public function get_service_all()
	{
		if(!@$this->user) redirect ('main');
		if ($this->input->is_ajax_request()) 
    	{
    		$data = $this->services->get_all();
			echo json_encode(array("data"=>$data));
		}
		else
		{
			exit('No direct script access allowed');
			show_404();
		}
		return FALSE;
	}
	
	public function search_price_service_by_id()
	{
		if(!@$this->user) redirect ('main');
		if ($this->input->is_ajax_request()) 
    	{
			if($this->input->post('id'))
    		{
    			$data= array($this->input->post('id'));
				$response = $this->services->selectSQLMultiple("SELECT * from detalle_categoria_servicio where srv_id=?",$data);
				echo json_encode($response);
			}
		}
		else
		{
			exit('No direct script access allowed');
			show_404();
		}
		return FALSE;
	}
	
	public function search_service_by_id_and_cat()
	{
		if(!@$this->user) redirect ('main');
		if ($this->input->is_ajax_request()) 
    	{
			if($this->input->post('id'))
    		{
    			$data= array($this->input->post('id'),$this->input->post('cat'));
				$response = $this->services->selectSQLMultiple("SELECT dcs.*, srv.srv_nom from detalle_categoria_servicio dcs, servicio srv where srv.srv_id=dcs.srv_id and dcs.srv_id=? and dcs.cat_id=?",$data);
				echo json_encode(array("data"=>$response));
			}
		}
		else
		{
			exit('No direct script access allowed');
			show_404();
		}
		return FALSE;
	}
	
	
	public function get_das_by_idServ()
	{
		if(!@$this->user) redirect ('main');
		if ($this->input->is_ajax_request()) 
    	{
			if($this->input->post('id'))
    		{
    			$data= array($this->input->post('id'));
				$response = $this->services->selectSQLMultiple("SELECT * from detalle_area_servicio das, area_trabajo at where das.srv_id=? and das.das_est=true and at.art_id=das.art_id",$data);
				echo json_encode($response);
			}
		}
		else
		{
			exit('No direct script access allowed');
			show_404();
		}
		return FALSE;
	}
	
	public function search_area_service_by_id()
	{
		if(!@$this->user) redirect ('main');
		if ($this->input->is_ajax_request()) 
    	{
			if($this->input->post('id'))
    		{
    			$data= array($this->input->post('id'));
				$response = $this->services->selectSQLMultiple("SELECT * from detalle_area_servicio where srv_id=? and das_est=true",$data);
				echo json_encode($response);
			}
		}
		else
		{
			exit('No direct script access allowed');
			show_404();
		}
		return FALSE;
	}
	public function edit_service()
	{
		$detalles=array();
		$precios=array();
		$response=array();
		if(!@$this->user) redirect ('main');
		if ($this->input->is_ajax_request()) 
    	{
			

			$categorias=explode(",",$this->input->get('ctgId'));
			$areas=explode(",",$this->input->get('arsId'));
			foreach ($areas as $keyA => $valueA) 
			{
				if($this->input->post('editcat'.$valueA))
				{
					array_push($detalles,$this->input->post('editcat'.$valueA));
				}
			}
			foreach ($categorias as $keyC => $valueC) 
			{
				if($this->input->post('editprc'.$valueC))
				{
					array_push($precios,$this->input->post('editprc'.$valueC));
				}
			}
			$data = array(
				$this->input->post('txtNameServicioEdit'),
    			"{".$this->input->get('ctgId')."}",
				"{".implode(",",$detalles)."}",
				"{".implode(",",$precios)."}",
				$this->input->get('trId')
    		);
			$response = $this->services->selectSQL("SELECT update_service(?,?,?,?,?)",$data);
			echo json_encode($response);
		}
		else
		{
			exit('No direct script access allowed');
			show_404();
		}
		return FALSE;
	}
	
	public function delete_service()
	{
		if(!@$this->user) redirect ('main');
		if ($this->input->is_ajax_request()) 
    	{
    		$data = array('srv_id' => $this->input->post('id'));
			$response = $this->services->delete($data);
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