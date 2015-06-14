<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Garantia extends Private_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model(array('garantias','services'));
	}
	/*
	 * -------------------------------------------------------------------
	 *  MAIN GARANTIAS
	 * -------------------------------------------------------------------
	 */
	public function start()
	{
		if(!@$this->user) redirect ('main');
		$title['title'] = 'garantias';

		$data['js'] = array(
			base_url()."static/js/library/alls.js",
			base_url()."static/js/users/garantias.js",
			base_url()."static/js/pnotify.custom.min.js",
			base_url()."static/js/jquery.dataTables.min.js",
			base_url()."static/js/dataTables.bootstrap.js"
		);
		$data['funcion']="<script type='text/javascript'> seleccionar('mn_rvs'); 
		$(function(){
			
		});</script>";
		$title['css'] = array(
			base_url()."static/css/pnotify.custom.min.css",
			base_url()."static/css/dataTables.bootstrap.css"
		);
		$this->load->view('templates/header', $title);
		$this->load->view('user/garantias');
		$this->load->view('templates/footer', $data);
	}
	
	/* =========================>>> GARANTIAS <<<========================= */
	
	public function save_service()
	{
		$detalles=array();
		$precios=array();
		if(!@$this->user) redirect ('main');
		if ($this->input->is_ajax_request()) 
    	{
			

			$categorias=explode(",",$this->input->get('ctgId'));
			$areas=explode(",",$this->input->get('arsId'));
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
	
	public function get_guarantee_by_id()
	{
		if(!@$this->user) redirect ('main');
		if ($this->input->is_ajax_request()) 
    	{
			if($this->input->post("id"))
			{
				$response = $this->garantias->selectSQL("SELECT * from revisiones_view where rev_id=?",array($this->input->post("id")));
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
	
	public function get_guarantee_all()
	{
		if(!@$this->user) redirect ('main');
		if ($this->input->is_ajax_request()) 
    	{
			$response = $this->garantias->selectSQLMultiple("SELECT * from revisiones_view where rev_est=false",array());
			echo json_encode(array("data"=>$response));
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
	public function edit_guarantee()
	{
		if(!@$this->user) redirect ('main');
		if ($this->input->is_ajax_request()) 
    	{
			if($this->input->get('id'))
			{
				$data=array(
					'rev_obs'=>$this->input->post('txtObsRev'),
					'rev_est'=>true);
				$response=$this->garantias->update($this->input->get('id'), $data);
				echo json_encode($response);
			}
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