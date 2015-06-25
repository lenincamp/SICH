<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Private_Controller extends CI_Controller {

	public $user;

	/*
		La clase Private_Controller hereda de CI_Controller
		ahora aqui establecemos el usuario logueado.
	*/
	function __construct() {
		parent::__construct();
		// Se le asigna a la informacion a la variable $user.
		$this->user = @$this->session->userdata('logged_user');
	}
	
	/*public function removeCache()
    {
        $this->output->set_header('Last-Modified:'.gmdate('D, d M Y H:i:s').'GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
        $this->output->set_header('Cache-Control: post-check=0, pre-check=0',false);
        $this->output->set_header('Pragma: no-cache');
    }*/
    public function validar_ci($strCedula)
	{
	   $suma = 0;
	   $strOriginal = $strCedula;
	   $intProvincia = substr($strCedula,0,2);
	   $intTercero = $strCedula[2];
	   $intUltimo = $strCedula[9];
	   if (! settype($strCedula,"float")) return FALSE;
	   if ((int) $intProvincia < 1 || (int) $intProvincia > 23) return FALSE;
	   if ((int) $intTercero >= 6) return FALSE;
	   for($indice = 0; $indice < 9; $indice++) {
		 //echo $strOriginal[$indice],'</br>';
		 switch($indice) {
			case 0:
			case 2:
			case 4:
			case 6:
			case 8:
			   $arrProducto[$indice] = $strOriginal[$indice] * 2;
			   if ($arrProducto[$indice] >= 10) $arrProducto[$indice] -= 9;
			   //echo $arrProducto[$indice],'</br>';
			   break;
			case 1:
			case 3:
			case 5:
			case 7:
			   $arrProducto[$indice] = $strOriginal[$indice] * 1;
			   if ($arrProducto[$indice] >= 10) $arrProducto[$indice] -= 9;
			   //echo $arrProducto[$indice],'</br>';
			   break;
		 }
	   }
	   foreach($arrProducto as $indice => $producto) $suma += $producto;
	   $residuo = $suma % 10;
	   $intVerificador = $residuo==0 ? 0: 10 - $residuo;
	   return ($intVerificador == $intUltimo? TRUE: FALSE);
	}
}