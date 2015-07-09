<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// Include the main TCPDF library (search for installation path).
require_once($_SERVER["DOCUMENT_ROOT"].'/sich/application/libraries/tcpdf.php');

// extend TCPF with custom functions
class MYPDF extends TCPDF {

    // Colored table
    public function ColoredTable($w, $header,$data) {
      
        // Colors, line width and bold font
        $this->SetFillColor(30, 30, 30);
        $this->SetTextColor(255);
        $this->SetDrawColor(30, 30, 30);
        $this->SetLineWidth(0.3);
        $this->SetFont('', 'B');
        // Header
  
        $num_headers = count($header);
        for($i = 0; $i < $num_headers; ++$i) {
			$this->Cell($w[$i], 7, utf8_encode($header[$i]), 1, 0, 'C', 1);
        }
        $this->Ln();
        // Color and font restoration
        $this->SetFillColor(224, 235, 255);
        $this->SetTextColor(0);
        $this->SetFont('');
        // Data
         
        $fill = 0;
        $cont = 0;
        foreach($data as $row) {
             
            $cellcount = array();
            //write text first
            $startX = $this->GetX();
            $startY = $this->GetY();
            //draw cells and record maximum cellcount
            //cell height is 6 and width is 80
     
            foreach ($row as $key => $column):
                 $cellcount[] = $this->MultiCell($w[$key],6,$column,0,'L',$fill,0);
            endforeach;
         
            $this->SetXY($startX,$startY);
  
            //now do borders and fill
            //cell height is 6 times the max number of cells
         
            $maxnocells = max($cellcount);
         
            foreach ($row as $key => $column):
                 $this->MultiCell($w[$key],$maxnocells * 6,'','LR','L',$fill,0);
            endforeach;
		
        $this->Ln();
			$cont += $maxnocells;
			if ($cont > 23) {
				$this->AddPage('P', 'A4');
				$cont = 0;
			}
            
            // fill equals not fill (flip/flop)
            $fill=!$fill;
             
        }
		$this->Cell(array_sum($w), 0, '', 'T');
	}
	// Page footer
    public function Footer() {
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        // Page number
        $this->Cell(0, 10, utf8_encode('Página '.$this->getAliasNumPage().'/'.$this->getAliasNbPages()), 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }
}

class Report extends Private_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model(array('reports','orders','users'));
		//$this->load->library('tcpdf');
	}
	/*
	 * -------------------------------------------------------------------
	 *  reportes
	 * -------------------------------------------------------------------
	 */
	public function start()
	{
		if(!@$this->user) redirect ('main');
		$title['title'] = 'reporte';

		$data['js'] = array(
			base_url()."static/js/library/alls.js",
			base_url()."static/js/users/reports.js",
			base_url()."static/js/jquery.dataTables.min.js",
			base_url()."static/js/dataTables.bootstrap.js",
			base_url()."static/js/pnotify.custom.min.js",
		);
		
		$data['funcion']="<script type='text/javascript'> seleccionar('mn_rpt') </script>"; //al hacer click queda seleccionado en el menu
		
		$title['css'] = array(
			base_url()."static/css/pnotify.custom.min.css",
			base_url()."static/css/dataTables.bootstrap.css"
		);
		
		
		$this->load->view('templates/header', $title); //necesario
		$this->load->view('user/report'); // el que carga el template
		$this->load->view('templates/footer', $data); // necesario
	}
	
	/*
	 * -------------------------------------------------------------------
	 * REPORTS
	 * -------------------------------------------------------------------
	 */
	 
	public function ventas_pdf()
	{
		if(!@$this->user) redirect ('main');
		$desde=$this->input->get("desde");
		$hasta=$this->input->get("hasta");
		$estado=$this->input->get("est");
		$tabla=array();
		$total=0;
		$facturas=0;
		$response;
		$docs="";
		switch($estado)
		{
		case "1":
			$docs="Reservas y ventas.";
			$response = $this->orders->selectSQLMultiple("select otb.ord_num, otb.ord_fch, nombre, servs, ord_cst from orden_trabajo_revision otr, orden_trabajo_basico otb where otb.ord_id=otr.ord_id and otr.ord_fch between ? and ?",array($desde,$hasta));
			break;
		case "2":
			$docs="Solo reservas";
			$response = $this->orders->selectSQLMultiple("select otb.ord_num, otb.ord_fch, nombre, servs, ord_cst from orden_trabajo_revision otr, orden_trabajo_basico otb where otb.ord_id=otr.ord_id and otb.ord_rsv=true and otr.ord_fch between ? and ?",array($desde,$hasta));
			break;
		case "3":
			$docs="Solo ventas";
			$response = $this->orders->selectSQLMultiple("select otb.ord_num, otb.ord_fch, nombre, servs, ord_cst from orden_trabajo_revision otr, orden_trabajo_basico otb where otb.ord_id=otr.ord_id and otb.ord_rsv=false and otr.ord_fch between ? and ?",array($desde,$hasta));
			break;
		}
		foreach ($response as $keyA => $valueA) 
		{
			array_push($tabla,array($valueA["ord_num"],$valueA["ord_fch"],$valueA["nombre"],$valueA["servs"],$valueA["ord_cst"]));
			$total=$total+$valueA["ord_cst"];
			$facturas++;
		}
		
		// create new PDF document
		$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		$pdf->setPrintHeader(false);
		// set auto page breaks
		$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
		// set font
		$pdf->SetFont('helvetica', '', 12);

		// add a page
		$pdf->AddPage();
		
		// create some HTML content
		$html = '<br/><br/><img src="/sich/static/img/cabecera.jpg" height="80"/>
		<div align="center">
			<h4><strong>REPORTE DE INGRESOS</strong></h4>
		</div>
		<table cellpadding="0" cellspacing="0" border="0" style="text-align:left; vertical-align: middle; margin-top:20px;">
			<tr><td><h5><strong>Total ingresos: </strong>'.$total.'</h5></td></tr>
			<tr><td><h5><strong>Documentos: </strong>'.$docs.'</h5></td></tr>
			<tr><td><h5><strong>Total documentos: </strong>'.$facturas.'</h5></td></tr>
			<tr><td><h5><strong>Periodo: </strong>'.(($desde==$hasta)?$desde:($desde." al ".$hasta)).'</h5></td></tr>
		</table>
		<br/>
		';
		$html = utf8_encode ($html);
		
		// output the HTML content
		$pdf->writeHTML($this->especiales($html), true, false, true, false, '');
		
		// column titles
		$header = array('N° Ord', 'Fecha', 'Cliente', 'Servicios', 'Total');

		// print colored table
		$pdf->ColoredTable(array(30,30,50,52,30),$header, $tabla);
		
		// reset pointer to the last page
		$pdf->lastPage();

		// ---------------------------------------------------------

		//Close and output PDF document
		$pdf->Output('reporte_ingresos_'.(($desde==$hasta)?$desde:($desde."_al_".$hasta)).'.pdf', 'I');
	}
	
	public function factura_pdf()
	 {
		if(!@$this->user) redirect ('main');
		$idOrd=$this->input->get("id");
		$total=0;
		$facturas=0;
		$response;
		$docs="";
		$pixel=37.795275591;
		$general = $this->orders->selectSQLMultiple("select * from orden_trabajo_basico where ord_id=?",array($idOrd));
		$servs = $this->orders->selectSQLMultiple("select * from detalle_servicio_orden dso,  servicio srv where dso.srv_id=srv.srv_id and ord_id=?",array($idOrd));
		$parametros=$this->orders->selectSQLMultiple("select * from parametros;",array());
		$margen=$this->users->get_params();
		$margen=$margen[0]['mrg_top_ord'];
		$parametros=$parametros[0];
		// create new PDF document
		$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		$pdf->setPrintHeader(false);
		// set auto page breaks
		$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
		// set font
		$pdf->SetFont('helvetica', '', 9);

		// add a page
		$pdf->AddPage();
		
		// create some HTML content
		$html='<table><tr><td style="height:'.($pixel*$margen).'px;"></td></tr></table>
		<table>
		<tr><td style="width:70px; height:19px;"></td><td style="width:160px;">'.$general[0]["ord_fch"].'</td><td style="width:35px;"></td><td style="width:100px;">'.$general[0]["tlf"].'</td><td style="width:90px;"></td><td>Machala</td></tr>
		<tr><td style="width:70px; height:19px;"></td><td colspan="3">'.$general[0]["nombre_cliente"].'</td><td></td><td >'.$general[0]["per_ced"].'</td></tr>
		<tr><td style="width:70px; height:19px;"></td><td colspan="3">'.$general[0]["cli_dir"].'</td><td></td><td>'.$general[0]["fpg_nom"].'</td></tr>
		</table>
		<table>
		<tr><td style="height:20px;"></td></tr>
		</table>
		<table>';
		$contador=0;
		foreach ($servs as $keyA => $valueA) 
		{
			$html.='<tr><td style="width:20px;"></td><td style="width:365px; height:17px;">'.$valueA["srv_nom"].'</td><td style="width:30px;" align="center" >1</td><td style="width:50px;" align="right">'.$valueA["dso_prc"].'</td><td style="width:50px;" align="right">'.$valueA["dso_prc"].'</td></tr>';
			$contador++;
		}
		$html.=str_repeat('<tr><td colspan="5" style="height:15px;"></td></tr>', 8-$contador);
		$html.='<tr><td colspan="3" style="height:17px;"></td><td colspan="2" align="right">'.$general[0]["ord_cst"].'</td></tr>
		<tr><td colspan="3" style="height:17px;"></td><td colspan="2" align="right">'.round($general[0]["ord_cst"]*($parametros["iva"]/100),2).'</td></tr>
		<tr><td colspan="3" style="height:17px;"></td><td colspan="2" align="right">'.round($general[0]["ord_cst"]*(1+($parametros["iva"]/100)),2).'</td></tr>
		</table>';
		$html = utf8_encode ($html);
		
		// output the HTML content
		$pdf->writeHTML($this->especiales($html), false, false, false, false, '');
		
		// column titles
		$header = array('N° Ord', 'Fecha', 'Cliente', 'Servicios', 'Total');

		// print colored table
		//$pdf->ColoredTable(array(30,30,50,52,30),$header, $tabla);
		
		// reset pointer to the last page
		$pdf->lastPage();

		// ---------------------------------------------------------

		//Close and output PDF document
		$pdf->Output('factura_ord_num_'.$idOrd.'.pdf', 'I');
	 }
	 
	 public function garantias_pdf()
	 {
		if(!@$this->user) redirect ('main');
		$limit=$this->input->get("limit");
		$desde=$this->input->get("desde");
		$hasta=$this->input->get("hasta");
		$estado=$this->input->get("est");
		$tabla=array();
		$garantias=0;
		$response;
		$docs="";
		switch($estado)
		{
		case "1":
			$docs="Obligatorias y no obligatorias.";
			$response = $this->orders->selectSQLMultiple("select * from revisiones_all_view where date_part('year'::text, age(rev_fch::timestamp with time zone)) = 0::double precision AND date_part('month'::text, age(rev_fch::timestamp with time zone)) = 0::double precision AND date_part('day'::text, age(rev_fch::timestamp with time zone)) >= (-1*?::double precision) AND date_part('day'::text, age(rev_fch::timestamp with time zone)) <= (0::double precision)",array($limit));
			break;
		case "2":
			$docs="Obligatorias";
			$response = $this->orders->selectSQLMultiple("select * from revisiones_all_view where rev_obl=true and date_part('year'::text, age(rev_fch::timestamp with time zone)) = 0::double precision AND date_part('month'::text, age(rev_fch::timestamp with time zone)) = 0::double precision AND date_part('day'::text, age(rev_fch::timestamp with time zone)) >= (-1*?::double precision) AND date_part('day'::text, age(rev_fch::timestamp with time zone)) <= (0::double precision)",array($limit));
			break;
		case "3":
			$docs="No obligatorias";
			$response = $this->orders->selectSQLMultiple("select * from revisiones_all_view where rev_obl=false and date_part('year'::text, age(rev_fch::timestamp with time zone)) = 0::double precision AND date_part('month'::text, age(rev_fch::timestamp with time zone)) = 0::double precision AND date_part('day'::text, age(rev_fch::timestamp with time zone)) >= (-1*?::double precision)",array($limit));
			break;
		}
		foreach ($response as $keyA => $valueA) 
		{
			array_push($tabla,array($valueA["rev_fch"],$valueA["nombre"],$valueA["auto"],$valueA["veh_pla"],$valueA["servs"]));
			$garantias++;
		}
		
		// create new PDF document
		$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		$pdf->setPrintHeader(false);
		// set auto page breaks
		$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
		// set font
		$pdf->SetFont('helvetica', '', 12);

		// add a page
		$pdf->AddPage();
		
		// create some HTML content
		$html = '<br/><br/><img src="/sich/static/img/cabecera.jpg" height="80"/>
		<div align="center">
			<h4><strong>REPORTE DE GARANTIAS</strong></h4>
		</div>
		<table cellpadding="0" cellspacing="0" border="0" style="text-align:left; vertical-align: middle; margin-top:20px;">
			<tr><td><h5><strong>Garantías a efectuarse: </strong>'.($limit<1?"hoy":($limit==1?"Hasta mañana":"en ".$limit." días.")).'</h5></td></tr>
			<tr><td><h5><strong>Garantías: </strong>'.$docs.'</h5></td></tr>
			<tr><td><h5><strong>Total garantías: </strong>'.$garantias.'</h5></td></tr>
		</table>
		<br/>
		';
		$html = utf8_encode ($html);
		
		// output the HTML content
		$pdf->writeHTML($this->especiales($html), true, false, true, false, '');
		
		// column titles
		$header = array('Fecha', 'Cliente', 'Vehículo', 'Placa', 'Servicios');

		// print colored table
		$pdf->ColoredTable(array(25,50,47,20,50),$header, $tabla);
		
		// reset pointer to the last page
		$pdf->lastPage();

		// ---------------------------------------------------------

		//Close and output PDF document
		$pdf->Output('garantias.pdf', 'I');
	 }
	 
	 public function especiales($str)
	{
		$find=array("á","é","í","ó","ú");
		$remp=array("&aacute;","&eacute;","&iacute;","&oacute;","&uacute;");
		return str_replace($find, $remp, $str);
	}
	 
	 public function orden_pdf()
	{
		if(!@$this->user) redirect ('main');
		$data= array($this->input->get("id"));
		$cliente = $this->orders->selectSQLMultiple("SELECT cli.* from orden_trabajo ot, vehiculo veh, cliente cli where ord_id=? and ot.id_veh=veh.veh_id and cli.cli_id=veh.id_cli",$data);
		$vehiculo = $this->orders->selectSQLMultiple("SELECT veh.* , mod.mod_nom, mar.mar_nom from orden_trabajo ot, vehiculo veh, modelo mod, marca mar where ord_id=? and ot.id_veh=veh.veh_id and mod.mod_id=veh.id_modelo and mar.mar_id=mod.id_marca",$data);
		$ordentrb = $this->orders->selectSQLMultiple("SELECT * from orden_trabajo, forma_pago where ord_id=? and fpg_id=id_fpg",$data);
		$servs = $this->orders->selectSQLMultiple("select * from detalle_servicio_orden dso,  servicio srv where dso.srv_id=srv.srv_id and ord_id=?",$data);
		$detallesTrabajo = $this->orders->selectSQLMultiple("SELECT * from detalle_orden_area doa, area_trabajo art where doa.art_id=art.art_id and art.art_est=true and ord_id=? ",$data);
		$invent = $this->orders->selectSQLMultiple("select dipa.*, pie.pie_nom from inventario inv, detalle_inventario_piezas_auto dipa, piezas_auto pie where inv.ord_id=? and dipa.inv_id=inv.inv_id and pie.pie_id=dipa.pie_id",$data);
		$inventarioGeneral = $this->orders->selectSQLMultiple("select * from inventario where ord_id=? ",$data);
		$cliente=$cliente[0];
		$vehiculo=$vehiculo[0];
		$ordentrb=$ordentrb[0];
		$inventarioGeneral=$inventarioGeneral[0];
		$servicios="";
		$inventario="";
		$contadorDetalle=1;
		$coorComb=explode("-",$inventarioGeneral["inv_com"]);
		$detalles="";
		foreach ($servs as $keyA => $valueA) 
		{
			$servicios.=$valueA["srv_nom"].'&nbsp;&nbsp;<strong>:</strong>&nbsp;&nbsp;$'.$valueA["dso_prc"].'&nbsp;&nbsp;<strong>|</strong>&nbsp;&nbsp;&nbsp;&nbsp;';
		}
		foreach ($detallesTrabajo as $key => $value) 
		{
			if($contadorDetalle==1)
			{
				$detalles.="<tr>";
			}
			$detalles.='<td style="border-left: 1px solid '.($contadorDetalle==1?"white":"gray").';">'.$value["art_nom"].'</td>';
			if($contadorDetalle==3)
			{
				$detalles.="</tr>";
				$contadorDetalle=0;
			}
			$contadorDetalle++;
		}
		if($contadorDetalle==2)
		{
		$detalles.=str_repeat("<td></td>",3-$contadorDetalle).'</tr>';
		}
		$contadorDetalle=1;
		foreach ($invent as $key => $value) 
		{
			if($contadorDetalle==1)
			{
				$inventario.="<tr>";
			}
			$inventario.='<td style="border-left: 1px solid '.($contadorDetalle==1?"white":"gray").';">'.$value["pie_nom"].'</td>';
			if($contadorDetalle==3)
			{
				$inventario.="</tr>";
				$contadorDetalle=0;
			}
			$contadorDetalle++;
		}
		if($contadorDetalle==2)
		{
		$inventario.=str_repeat("<td></td>",3-$contadorDetalle).'</tr>';
		}
		/*$response = $this->orders->selectSQLMultiple("select otb.ord_num, otb.ord_fch, nombre, servs, ord_cst from orden_trabajo_revision otr, orden_trabajo_basico otb where otb.ord_id=otr.ord_id and otr.ord_fch between ? and ?",array();
		foreach ($response as $keyA => $valueA) 
		{
			array_push($tabla,array($valueA["ord_num"],$valueA["ord_fch"],$valueA["nombre"],$valueA["servs"],$valueA["ord_cst"]));
			$total=$total+$valueA["ord_cst"];
			$facturas++;
		}*/
		
		// create new PDF document
		$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		$pdf->setPrintHeader(false);
		// set auto page breaks
		$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
		// set font
		$pdf->SetFont('helvetica', '', 12);

		// add a page
		$pdf->AddPage();
		
		// create some HTML content
		$html = '<br/><br/>
		<img src="/sich/static/img/cabecera.jpg" height="80"/><img src="/sich/static/img/ford.jpg" height="70"/>
		<div align="center">
			<strong>ORDEN DE TRABAJO</strong>
		</div>
		<table cellpadding="3" cellspacing="0" rules="none" border="0" style="text-align:right; font-size:11pt;">
			<tr><td><span style="width:100px;"><strong>Serie </strong>001-001-</span><span style="color:red; width:100px;"><strong>'.(str_repeat("0",9-strlen($ordentrb["ord_num"]))).$ordentrb["ord_num"].'</strong></span></td></tr>
		</table>
		<table cellpadding="0" cellspacing="0" style="border: 1px solid gray;">
			<table cellpadding="3" cellspacing="0" rules="none" border="0" style="font-size:11pt;">
				<tr><td style="width:300px;"><strong>Cliente:</strong> '.utf8_decode($cliente["per_nom"].' '.$cliente["per_ape"]).'</td><td style="width:200px;"><strong>E-mail:</strong> '.$cliente["cli_eml"].'</td></tr>
				<tr><td style="width:300px;"><strong>Télefono:</strong> '.str_replace(array("{","}"),"",$cliente["cli_tel"]).'</td><td style="width:200px;"><strong>C.I./R.U.C.:</strong> '.$cliente["per_ced"].'</td></tr>
				<tr><td colspan="4"><strong>Dirección:</strong> '.utf8_decode($cliente["cli_dir"]).'</td></tr>
				<tr><td style="width:300px;"><strong>¿Quién entrega?:</strong> '.utf8_decode($ordentrb["ord_per_ent"]).'</td><td style="width:200px;"><strong>Teléfono:</strong> '.$ordentrb["ord_per_tel"].'</td></tr>
				<tr><td style="width:300px;"><strong>Asesor:</strong> '.utf8_decode($ordentrb["ord_asr"]).'</td><td style="width:200px;"><strong>Fecha:</strong> '.$ordentrb["ord_fch"].'</td></tr>
			</table>
		</table>
		<br/>
		<br/>
		<table cellpadding="0" cellspacing="0" style="border: 1px solid gray;">
			<table cellpadding="3" cellspacing="0" rules="none" border="0" style="font-size:11pt;">
				<tr><td style="width:300px;"><strong>Vehiculo Marca:</strong> '.utf8_decode($vehiculo["mar_nom"]).'</td><td style="width:240px;"><strong>Modelo:</strong> '.utf8_decode($vehiculo["mod_nom"]).'</td></tr>
				<tr><td><strong>Chasís:</strong> '.$vehiculo["veh_cha"].'</td><td ><strong>Placa:</strong> '.$vehiculo["veh_pla"].'</td></tr>
				<tr><td><strong>Año:</strong> '.$vehiculo["veh_yar"].'</td><td ><strong>Motor:</strong> '.$vehiculo["veh_mot"].'</td></tr>
				<tr><td><strong>Color:</strong> <span style="background-color:'.$vehiculo["veh_col"].';">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></td><td><strong>Código:</strong> '.$vehiculo["veh_cla"].'</td></tr>
			</table>
		</table>
		<br/>
		<br/>
		<table cellpadding="0" cellspacing="0" style="border: 1px solid gray;">
			<table cellpadding="3" cellspacing="3" style="font-size:11pt; ">
				<tr><td colspan="2"><strong>Combustible:</strong><img src="/sich/static/img/gasometro.png" height="70"/></td></tr>
			</table>
			<table cellpadding="3" cellspacing="3" style="font-size:11pt; ">
				<tr><td colspan="3" align="center"><strong>INVENTARIO DEL VEHICULO</strong></td></tr>
				'.utf8_decode($inventario).'
				<tr><td colspan="3"><strong>Kilometraje:</strong>'.utf8_decode($inventarioGeneral["inv_kil"]).' Km</td></tr>
				<tr><td colspan="3"><strong>Observaciones:</strong>'.utf8_decode($inventarioGeneral["inv_obs"]).'</td></tr>
			</table>
		</table>
		';
		$html = utf8_encode ($html);
		$pdf->writeHTML($this->especiales($html), true, false, true, false, '');
		$style2 = array('width' => 0.5, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(255, 0, 0));
		$pdf->SetLineStyle($style2);
		$pdf->Line(49.25, 149, 49.25+(($coorComb[0]-50)*0.175), 149+(($coorComb[1]-70)*0.16), $style2);
		
		$html='
		<br/>
		<table cellpadding="0" cellspacing="0" style="border: 1px solid gray;">
			<table cellpadding="3" cellspacing="0" rules="none" border="0" style="font-size:11pt;">
				<tr><td style="width:270px;"><strong>Fecha ingreso:</strong> '.$ordentrb["ord_fch_ing"].'</td><td style="width:270px;"><strong>Fecha estimada de entrega:</strong> '.$ordentrb["ord_fch_ent"].'</td></tr>
				<tr><td colspan="4" align="center"><strong> </strong></td></tr>
				<tr><td colspan="4" align="center"><strong>SERVICIO : COSTO</strong></td></tr>
				<tr><td colspan="4">'.utf8_decode($servicios).'</td></tr>
				<tr><td colspan="4" align="center"><strong> </strong></td></tr>
				<tr><td colspan="4" align="center"><strong>DETALLE DEL TRABAJO</strong></td></tr>
			</table>
			<table cellpadding="3" cellspacing="3" style="font-size:11pt; ">
				'.utf8_decode($detalles).'
			</table>
		</table>
		<br/>
		<br/>
		<table cellpadding="0" cellspacing="0">
			<table cellpadding="3" cellspacing="0" rules="none" border="0" style="font-size:11pt;">
				<tr><td style="width:270px;"><strong>Costo Total:</strong> '.$ordentrb["ord_cst"].'</td><td style="width:270px;"><strong>Pago con tarjeta:</strong> '.$ordentrb["ord_trj"].'</td></tr>';
		$abonos=str_replace(array('{','}'),array('',''),$ordentrb["ord_abn"]);
		$totalAbonos=0;
		$abonos=explode (',',$abonos);
		foreach ($abonos as $valor) {
			$abono = explode (':',$valor);
			$html.='<tr><td colspan="4"><strong>Abono ('.$abono[0].'):</strong> '.$abono[1].'</td></tr>';
			$totalAbonos+=$abono[1];
		}
		$html.='
				<tr><td colspan="4"><strong>Saldo:</strong> '.round($ordentrb["ord_cst"]-$totalAbonos,2).'</td></tr>
				<tr><td colspan="4"><strong>Observaciones:</strong>'.utf8_decode($ordentrb["ord_obs"]).'</td></tr>
			</table>
		</table>
		<br/>
		<br/>
		<br/>
		<br/>
		<br/>
		<br/>
		<table cellpadding="0" cellspacing="0" border="0">
			<tr><td align="center">______________________________</td><td align="center">______________________________</td></tr>
			<tr><td align="center">RECIBÍ CONFORME</td><td align="center">ENTREGUÉ CONFORME</td></tr>
			<tr><td align="center" colspan="2"><small><strong>IMPORTANTE:</strong> No nos responsabilizamos por objetos de valor en su vehiculo, que no estén relacionados con la orden de trabajo.</small></td></tr>
		</table>
		';
		
		// output the HTML content
		$html = utf8_encode ($html);
		$pdf->writeHTML($this->especiales($html), true, false, true, false, '');
		
		// reset pointer to the last page
		$pdf->lastPage();

		// ---------------------------------------------------------

		//Close and output PDF document
		$pdf->Output('orden_trabajo_.pdf', 'I');
	}
}
/* End of file main.php */
/* Location: ./application/controllers/car.php */