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
	public function delete_orden()
	{
		if(!@$this->user) redirect ('main');
		if ($this->input->is_ajax_request()) 
    	{
    		$data = array('ord_id' => $this->input->post('id'));
			$response = $this->orders->delete($data);
			echo json_encode($response);
		}
		else
		{
			exit('No direct script access allowed');
			show_404();
		}
		return FALSE;
	}
	public function save_orden()
	{
		if(!@$this->user) redirect ('main');
		if ($this->input->is_ajax_request()) 
    	{
			$IdsServicios=explode(",",$this->input->get('srv'));
			$costos=array();
			$IdsAreas=explode(",",$this->input->get('idsArt'));
			$areas=array();
			$IdsInventario=explode(",",$this->input->get('idsInv'));
			$inventario=array();
			foreach ($IdsAreas as $keyA => $valueA) 
			{
				if($this->input->post('cat'.$valueA))
				{
					array_push($areas,$this->input->post('cat'.$valueA));
				}
			}
			foreach ($IdsInventario as $keyA => $valueA) 
			{
				if($this->input->post('inv'.$valueA))
				{
					array_push($inventario,$this->input->post('inv'.$valueA));
				}
			}
			foreach ($IdsServicios as $keyA => $valueA) 
			{
				if($this->input->post('prc'.$valueA))
				{
					array_push($costos,$this->input->post('prc'.$valueA));
				}
			}
			$abono=$this->input->post('txtAbono')?$this->input->post('txtAbono'):0;
			$reserva=$this->input->post('chkReserva')?true:false;
    		$data = array(
    			$this->input->post('txtNumeroOrden'),
				$this->input->post('txtFecha'),
				$this->input->post('txtFechaIngreso'),
				$this->input->post('txtFechaEntrega'),
				$this->input->post('txtCosto'),
				$reserva,
				$abono,
				$this->input->post('txtTarjeta'),
				$this->input->post('txtObservacionesGeneral'),
				substr($this->input->get('idVeh'), 0, strlen($this->input->get('idVeh'))-3),
				$this->input->post('slcFormaPAgo'),
				$this->input->get('cmb'),
				$this->input->post('txtKilometraje'),
				$this->input->post('txtObservacionInventario'),
				"{".implode(",",$inventario)."}",
				"{".implode(",",$costos)."}",
				"{".$this->input->get('srv')."}",
				"{".implode(",",$areas)."}"
    		);
			$response = $this->orders->selectSQL("SELECT insert_orden(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)",$data);
			echo json_encode($response);
		}
		else
		{
			exit('No direct script access allowed');
			show_404();
		}
		return FALSE;
	}
	
	public function edit_orden()
	{
		if(!@$this->user) redirect ('main');
		if ($this->input->is_ajax_request()) 
    	{
			$IdsServicios=explode(",",$this->input->get('srv'));
			$costos=array();
			$IdsAreas=explode(",",$this->input->get('idsArt'));
			$areas=array();
			$IdsInventario=explode(",",$this->input->get('idsInv'));
			$inventario=array();
			foreach ($IdsAreas as $keyA => $valueA) 
			{
				if($this->input->post('Editcat'.$valueA))
				{
					array_push($areas,$this->input->post('Editcat'.$valueA));
				}
			}
			foreach ($IdsInventario as $keyA => $valueA) 
			{
				if($this->input->post('invEdit'.$valueA))
				{
					array_push($inventario,$this->input->post('invEdit'.$valueA));
				}
			}
			foreach ($IdsServicios as $keyA => $valueA) 
			{
				if($this->input->post('prcEdit'.$valueA))
				{
					array_push($costos,$this->input->post('prcEdit'.$valueA));
				}
			}
			$abono=$this->input->post('txtAbonoEdit')?$this->input->post('txtAbono'):0;
			$reserva=$this->input->post('chkReservaEdit')?true:false;
    		$data = array(
    			$this->input->post('txtNumeroOrdenEdit'),
				$this->input->post('txtFechaEdit'),
				$this->input->post('txtFechaIngresoEdit'),
				$this->input->post('txtFechaEntregaEdit'),
				$this->input->post('txtCostoEdit'),
				$reserva,
				$abono,
				$this->input->post('txtTarjetaEdit'),
				$this->input->post('txtObservacionesGeneralEdit'),
				substr($this->input->get('idVeh'), 0, strlen($this->input->get('idVeh'))-3),
				$this->input->post('slcFormaPAgoEdit'),
				$this->input->get('cmb'),
				$this->input->post('txtKilometrajeEdit'),
				$this->input->post('txtObservacionInventarioEdit'),
				"{".implode(",",$inventario)."}",
				"{".implode(",",$costos)."}",
				"{".$this->input->get('srv')."}",
				"{".implode(",",$areas)."}",
				$this->input->get('trId')
    		);
			$response = $this->orders->selectSQL("SELECT update_orden(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)",$data);
			echo json_encode($response);
		}
		else
		{
			exit('No direct script access allowed');
			show_404();
		}
		return FALSE;
	}
	
	public function get_orders_all()
	{
		if(!@$this->user) redirect ('main');
		if ($this->input->is_ajax_request()) 
    	{
    		$data = $this->orders->selectSQLMultiple("SELECT * from orden_trabajo_basico",array());
			echo json_encode(array("data"=>$data));
		}
		else
		{
			exit('No direct script access allowed');
			show_404();
		}
		return FALSE;
	}
	
	public function search_order()
	{
		if(!@$this->user) redirect ('main');
		if ($this->input->is_ajax_request()) 
    	{
			$data= array($this->input->post("id"));
			
			$response=array();
			$response[0] = $this->orders->selectSQLMultiple("SELECT ot.*, veh.veh_id, cli.per_ced from orden_trabajo ot, vehiculo veh, cliente cli where ord_id=? and ot.id_veh=veh.veh_id and cli.cli_id=veh.id_cli",$data);
			$response[1] = $this->orders->selectSQLMultiple("select * from inventario where ord_id=? ",$data);
			$response[2] = $this->orders->selectSQLMultiple("select dipa.* from inventario inv, detalle_inventario_piezas_auto dipa where inv.ord_id=? and dipa.inv_id=inv.inv_id ",$data);
			$response[3] = $this->orders->selectSQLMultiple("select * from detalle_servicio_orden where ord_id=? ",$data);
			$response[4] = $this->orders->selectSQLMultiple("select * from detalle_orden_area where ord_id=? ",$data);
			echo json_encode(array("data"=>$response));
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