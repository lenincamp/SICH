<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Mark extends CI_Model {

 
	/*
		Constructor del modelo
	*/
	function __construct() {
		parent::__construct();
	}
 
	/*
		Con esta funcion comprobamos que exista el
		usuario en la base de datos, si es asi retornamos
		el contenido del registro, de lo contrario se
		retorna FALSE.
	*/
	/*public function get($username='', $password='') {
		return $this->db->get_where(
			$this->table, array(
				'per_ced' => $username,
				'usu_pwd' => $password
			)
		)->row();
	}*/
	
	public function get_all(){
		return $this->db->order_by('mar_nom asc')->get('marca')->result_array();
	}
 
}