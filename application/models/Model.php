<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Model extends CI_Model {

 
	/*
		Constructor del modelo
	*/
	function __construct() {
		parent::__construct();
	}
 
	
	public function get_all(){
		/*
			SELECT mod_id, mod_nom, mar_nom
			FROM modelo, marca
			WHERE id_marca = mar_id
			GROUP BY mar_nom, mod_id
			ORDER BY mar_nom, mod_nom
		*/
		$response = $this->db->select('mod_id, mod_nom, mar_nom')
						 ->from('modelo')
						 ->join('marca', 'id_marca = mar_id')
						 ->get()->result_array();
		return $response;
	}
	
	public function save($data){
		return $this->db->insert('modelo', $data);
	}
 
}