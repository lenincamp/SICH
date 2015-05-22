<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Model extends CI_Model {

 
	/*
		Constructor del modelo
	*/
	function __construct() {
		parent::__construct();
	}
 
	
	public function get_all(){
		return $this->db->order_by('mod_nom asc')->get('modelo')->result_array();
	}
	
	public function save($data){
		return $this->db->insert('modelo', $data);
	}
 
}