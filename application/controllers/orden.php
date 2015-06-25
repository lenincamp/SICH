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
    			$this->input->post('txtNumeroOrden')==""?0:$this->input->post('txtNumeroOrden'),
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
				"{".implode(",",$areas)."}",
				$this->input->post('txtAsesor'),
				$this->input->post('txtPerEnt'),
				$this->input->post('txtEntTlf')
    		);
			$response = $this->orders->selectSQL("SELECT insert_orden(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)",$data);
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
				$this->input->get('trId'),
				$this->input->post('txtAsesorEdit'),
				$this->input->post('txtPerEntEdit'),
				$this->input->post('txtEntTlfEdit')
    		);
			$response = $this->orders->selectSQL("SELECT update_orden(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)",$data);
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
	
	public function sendMailGmail()
	{
		//if(!@$this->user) redirect ('main');
		//if ($this->input->is_ajax_request()) 
    	{
			
			$revision = $this->orders->selectSQLMultiple("select * from revision where rev_id=? ",$this->input->get("id"));
			$revision=$revision[0];
			$data= array($revision["ord_id"]);
			$cliente = $this->orders->selectSQLMultiple("SELECT cli.* from orden_trabajo ot, vehiculo veh, cliente cli where ord_id=? and ot.id_veh=veh.veh_id and cli.cli_id=veh.id_cli",$data);
			$vehiculo = $this->orders->selectSQLMultiple("SELECT veh.* , mod.mod_nom, mar.mar_nom from orden_trabajo ot, vehiculo veh, modelo mod, marca mar where ord_id=? and ot.id_veh=veh.veh_id and mod.mod_id=veh.id_modelo and mar.mar_id=mod.id_marca",$data);
			$ordentrb = $this->orders->selectSQLMultiple("SELECT * from orden_trabajo, forma_pago where ord_id=? and fpg_id=id_fpg",$data);
			$servs = $this->orders->selectSQLMultiple("select * from detalle_servicio_orden dso,  servicio srv where dso.srv_id=srv.srv_id and ord_id=?",$data);
			$inventarioGeneral = $this->orders->selectSQLMultiple("select * from inventario where ord_id=? ",$data);
			
			$cliente=$cliente[0];
			$vehiculo=$vehiculo[0];
			$ordentrb=$ordentrb[0];
			$inventarioGeneral=$inventarioGeneral[0];
			$servicios="";
			$separador=", ";
			$total=0;
			foreach ($servs as $keyA => $valueA) 
			{
				$servicios=$valueA["srv_nom"].$separador.$servicios;
				$total+=$valueA["dso_prc"];
			}
			$dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
			$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
			//contenido html del mensaje a enviar
			$html='<div style=" font-family: Arial, Helvetica, sans-serif;">
			<div style="height:99vh; width:98vw; z-index:-1; opacity: 0.1; filter: alpha(opacity=10); position:absolute;  background: url('.base_url().'/static/img/logo_grande_chan.png) no-repeat center center; background-size: 45vw auto;"></div>
			<img src="'.base_url().'static/img/cabecera.jpg" height="100"/>
			<p align="center" style="color:#C61414; font-size:14pt;"><i><strong>CARTA DE GARANTIA</strong></i></p>
			<p><strong>Propietario del Vehículo: </strong>'.utf8_decode($cliente["per_nom"].' '.$cliente["per_ape"]).'</p>
			<p><strong>Números de contactos: </strong>'.str_replace(array("{","}"),"",$cliente["cli_tel"]).'</p>
			<p><strong>Dirección: </strong>'.utf8_decode($cliente["cli_dir"]).'</p>
			<p><strong>E-Mail:</strong>'.utf8_decode($cliente["cli_eml"]).'</p>
			<p align="center" style="color:#C61414; font-size:14pt;"><i><strong>DATOS DEL VEHICULO</strong></i></p>
			<p><strong>Marca: </strong>'.utf8_decode($vehiculo["mar_nom"]).' </p>
			<p><strong>Modelo: </strong>'.utf8_decode($vehiculo["mod_nom"]).' </p>
			<p><strong>Año: </strong>'.$vehiculo["veh_yar"].' </p>
			<span style="width:200px;"><strong>Color: </strong></span><div style="border: 1px solid black; display:inline-block; width:20px; height:20px; background-color:'.$vehiculo["veh_col"].'"> </div>
			<p><strong>Numero de chasis: </strong>'.$vehiculo["veh_cha"].' </p>
			<p><strong>Número de Motor: </strong>'.$vehiculo["veh_mot"].' </p>
			<p><strong>Placas: </strong>'.$vehiculo["veh_pla"].'</p>
			<p><strong>Observaciones: </strong>'.utf8_decode($inventarioGeneral["inv_obs"]).'</p>
			<p align="center" style="color:#C61414; font-size:14pt;"><i><strong>DATOS DE INGRESO</strong></i></p>
			<p><strong>Fecha de ingreso:</strong> '.$dias[date('w',strtotime($ordentrb["ord_fch_ing"]))]." ".date('d',strtotime($ordentrb["ord_fch_ing"]))." de ".$meses[date('n',strtotime($ordentrb["ord_fch_ing"]))-1]. " del ".date('Y',strtotime($ordentrb["ord_fch_ing"])).' </p>
			<p><strong>Fecha de salida:</strong> '.$dias[date('w',strtotime($ordentrb["ord_fch_ent"]))]." ".date('d',strtotime($ordentrb["ord_fch_ent"]))." de ".$meses[date('n',strtotime($ordentrb["ord_fch_ent"]))-1]. " del ".date('Y',strtotime($ordentrb["ord_fch_ent"])).' </p>
			<p><strong>Tipo de empastado:</strong> '.substr($servicios,0,strlen($servicios)-2).' </p>
			<p><strong>Costo del Empastado:</strong> $'.$total.' </p>
			<p style="background-color:yellow; width:400px;"><strong>REVISION: </strong>'.$dias[date('w',strtotime($revision["rev_fch"]))]." ".date('d',strtotime($revision["rev_fch"]))." de ".$meses[date('n',strtotime($revision["rev_fch"]))-1]. " del ".date('Y',strtotime($revision["rev_fch"])) .'</p>
			<p style="color:#C61414; font-size:12pt;"><i>Cláusula de Garantía 7años*</strong></i></p><p>*La garantía del vehículo que brinda la empresa CHAN es bajo el respaldo y licencia de la compañía Sherwin Williams® la cual bajo responsabilidad y compromiso adquirido con el cliente la garantía cubrirá lo siguiente: Golpes, montículos y corrosión en las partes que se aplicó el producto, siempre y cuando no sean de mucha gravedad. La garantía es intransferible. En Caso de Choque el vehículo tendrá que ingresar a los talleres Chan Protección Contra el óxido, después de haber salido de latonería, caso contrario la garantía será cobrada. 
			
			<p>Entregue Conforme:</p>
			<i><strong>Ing. Daniel Chan Mora </strong></i>
			<table boder="0" cellspacing="0" cellpadding="0">
			<tr><td><small><i>Juan Montalvo y Eloy Alfaro esq.</small></i></td></tr>
			<tr><td><small><i>2932-911/ 0997863-315 </small></i></td></tr>
			<tr><td><small><i>chanmora@hotmail.com </small></i></td></tr>
			<tr><td><small><i>Machala - Ecuador</small></i></td></tr>
			</table>
			
			<table boder="0" cellspacing="0" cellpadding="0" align="right">
			<tr><td><img src="'.base_url().'static/img/sherwin.jpg" height="80"/></td></tr>
			<tr><td align="center"><strong><small>www.sherwinwilliams.com</small></strong></td></tr>
			</table>
			</div>';
			
			//cargamos la libreria email de ci
			$this->load->library("email");
			if($cliente["cli_eml"]!=""&&$cliente["cli_eml"]!=null)
			{
				//configuracion para gmail
				$configGmail = array(
					'protocol' => 'smtp',
					'smtp_host' => 'ssl://smtp.gmail.com',
					'smtp_port' => 465,
					'smtp_user' => 'alex.nb.92@gmail.com',
					'smtp_pass' => '21792Alexander',
					'mailtype' => 'html',
					'charset' => 'utf-8',
					'newline' => "\r\n"
				);    
		 
				//cargamos la configuración para enviar con gmail
				$this->email->initialize($configGmail);
				$this->email->from('CHAN SHIELD & CLEANING');
				$this->email->to($cliente["cli_eml"]);
				$this->email->subject('CARTA DE GARANTIA');
				$this->email->message(utf8_encode ($html));
				$this->email->send();
				//con esto podemos ver el resultado
				if(strlen($this->email->print_debugger())<20){
					echo json_encode(true);
				}
				else
				{
					echo json_encode(false);
				}
			}
			else{
				echo json_encode("no email");
			}
		}
	}
}
/* End of file main.php */
/* Location: ./application/controllers/car.php */