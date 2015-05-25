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
}