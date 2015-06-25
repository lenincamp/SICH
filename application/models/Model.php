<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Model extends CI_Model {

 
	/*
		Constructor del modelo
	*/
	function __construct() {
		parent::__construct();
	}
 
	
	public function get_all()
	{
		/*
			SELECT mod_id, mod_nom, marca.*, cat_id
			FROM modelo, marca
			WHERE id_marca = mar_id
			GROUP BY mar_nom, mod_id, mar_id
			ORDER BY mar_nom, mod_nom
		*/
		$response = $this->db->select('mod_id, mod_nom, marca.*, cat_id')
						 ->from('modelo')
						 ->join('marca', 'id_marca = mar_id')
						 ->get()->result_array();
		return $response;
	}
	
	public function get_for_mark($data)
	{
		$response = $this->db->order_by('mod_nom asc')
						 ->get_where('modelo', $data)
						 ->result_array();
		return $response;
	}
	
	public function save($data)
	{
		return $this->db->insert('modelo', $data);
	}
	
	public function delete($data)
	{
		return $this->db->delete('modelo', $data); 
	}
	
	public function update($id, $data)
	{
		if($id){
			return $this->db->update('modelo', $data, array('mod_id' => $id));
		}
		else{
			return FALSE;
		}
	}
 
}