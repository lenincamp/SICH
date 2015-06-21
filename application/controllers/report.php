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
		$this->load->model(array('reports','orders'));
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
			base_url()."static/js/users/clients.js",
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
	 
	 public function hello_world()
	 {
		$this->load->library('cezpdf');
		try{
		$tabla=array();
		$total=0;
		$response = $this->orders->selectSQLMultiple("select otb.ord_num, otb.ord_fch, nombre, servs, ord_cst from orden_trabajo_revision otr, orden_trabajo_basico otb where otb.ord_id=otr.ord_id",array());
		foreach ($response as $keyA => $valueA) 
		{
			array_push($tabla,array("<i>N° Ord.</i>"=>$valueA["ord_num"],"<i>Fecha</i>"=>$valueA["ord_fch"],"Cliente"=>$valueA["nombre"],"Servicios"=>$valueA["servs"],"Total"=>$valueA["ord_cst"]));
			$total=$total+$valueA["ord_cst"];
		}
		
		//$this->cezpdf->ezImage("http://192.168.1.9:8080/sich/static/img/Splash.jpg");
		//$this->cezpdf->addJpegFromFile("http://192.168.1.9:8080/sich/static/img/Splash.jpg",100,100,100,100);
		//$this->cezpdf->addPngFromFile("http://192.168.1.9:8080/sich/static/img/delete.png",100,100,25,25);
		$this->cezpdf->ezText('REPORTE DE VENTAS', 12, array('justification' => 'center'));
		$this->cezpdf->ezSetDy(-10);
		$content = 'Total: '.$total."\n";
		$this->cezpdf->ezText($content, 10);
		$this->cezpdf->ezTable($tabla,12);
		$this->cezpdf->line(20,50,580,50); 
		$this->cezpdf->ezStartPageNumbers(80,35,10,'','','');
		$this->cezpdf->ezStream();
		}catch(Exception $ex)
		{
			echo $ex;
		}
	 }
	 
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
		$pdf->writeHTML($html, true, false, true, false, '');
		
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
		$general = $this->orders->selectSQLMultiple("select * from orden_trabajo_basico where ord_id=?",array($idOrd));
		$servs = $this->orders->selectSQLMultiple("select * from detalle_servicio_orden dso,  servicio srv where dso.srv_id=srv.srv_id and ord_id=?",array($idOrd));
		/*foreach ($response as $keyA => $valueA) 
		{
			array_push($tabla,array($valueA["ord_num"],$valueA["ord_fch"],$valueA["nombre"],$valueA["servs"],$valueA["ord_cst"]));
			$total=$total+$valueA["ord_cst"];
			$facturas++;
		}*/
		
		// create new PDF document
		$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		// set auto page breaks
		$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
		// set font
		$pdf->SetFont('helvetica', '', 9);

		// add a page
		$pdf->AddPage();
		
		// create some HTML content
		$html='<table><tr><td style="height:106px;"></td></tr></table>
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
		<tr><td colspan="3" style="height:17px;"></td><td colspan="2" align="right">'.round($general[0]["ord_cst"]*0.12,2).'</td></tr>
		<tr><td colspan="3" style="height:17px;"></td><td colspan="2" align="right">'.round($general[0]["ord_cst"]*1.12,2).'</td></tr>
		</table>';
		$html = utf8_encode ($html);
		
		// output the HTML content
		$pdf->writeHTML($html, false, false, false, false, '');
		
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
		$pdf->writeHTML($html, true, false, true, false, '');
		
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
}
/* End of file main.php */
/* Location: ./application/controllers/car.php */