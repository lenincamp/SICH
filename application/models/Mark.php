<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Mark extends CI_Model {

 
	/*
		Constructor del modelo
	*/
	function __construct() {
		parent::__construct();
	}
	
	
	public function get_all(){
		return $this->db->order_by('mar_nom asc')->get('marca')->result_array();
	}
	
	public function save($data)
	{
		return $this->db->insert('marca', $data);
	}
 	
 	public function delete($data)
	{
		return $this->db->delete('marca', $data); 
	}
	
	public function update($id, $data)
	{
		if($id){
			return $this->db->update('marca', $data, array('mod_id' => $id));
		}
		else{
			return FALSE;
		}
	}
}