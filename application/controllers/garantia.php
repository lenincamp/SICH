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
	
	public function save_guarantee()
	{
		if(!@$this->user) redirect ('main');
		if ($this->input->is_ajax_request()) 
    	{
			$oblg=$this->input->post('chkOblgGarant')?true:false;
			$est=$this->input->post('chkPendGarant')?false:true;
			$data = array(
				'rev_fch'=>$this->input->post('txtFechaGarant'),
				'rev_obs'=>$this->input->post('txtObsGarant'),
				'ord_id'=>$this->input->get('idOrd'),
				'rev_obl'=>$oblg,
				'rev_est'=>$est
    		);
			$response = $this->garantias->save($data);
			echo json_encode($response);
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
				$response = $this->garantias->selectSQL("SELECT * from revisiones_all_view where rev_id=?",array($this->input->post("id")));
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
			$response = $this->garantias->selectSQLMultiple("SELECT * from revisiones_all_view",array());
			echo json_encode(array("data"=>$response));
		}
		else
		{
			exit('No direct script access allowed');
			show_404();
		}
		return FALSE;
	}
	
	public function get_guarantee_pending_all()
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
	
	public function get_orders_guarantee_all()
	{
		if(!@$this->user) redirect ('main');
		if ($this->input->is_ajax_request()) 
    	{
			$response = $this->garantias->selectSQLMultiple("SELECT * from orden_trabajo_revision",array());
			echo json_encode(array("data"=>$response));
		}
		else
		{
			exit('No direct script access allowed');
			show_404();
		}
		return FALSE;
	}
	
	public function check_guarantee()
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
	
	public function edit_guarantee()
	{
		if(!@$this->user) redirect ('main');
		if ($this->input->is_ajax_request()) 
    	{
			$oblg=$this->input->post('chkOblgEdit')?true:false;
			$est=$this->input->post('chkPendEdit')?false:true;
			if($this->input->get('id'))
			{
				$data=array(
					'rev_fch'=>$this->input->post('txtFechaEdit'),
					'rev_obs'=>$this->input->post('txtObsEdit'),
					'rev_obl'=>$oblg,
					'rev_est'=>$est);
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