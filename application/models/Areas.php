<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Areas extends CI_Model {

 
	/*
		Constructor del modelo
	*/
	function __construct() {
		parent::__construct();
	}
 
	
	public function get_all()
	{
		/*
			SELECT per_id, per_ced, per_nom, per_ape, cli_id, cli_dir, cli_tel, cli_eml
			FROM cliente
		*/
		$response = $this->db->select('per_id, per_ced, per_nom, per_ape, cli_id, cli_dir, cli_tel, cli_eml')
						 ->from('cliente')
						 ->get()->result_array();
		return $response;
	}
	
	public function get($data) {
		return $this->db->get_where('area_trabajo', $data)->row();
	}
	
	public function save($data)
	{
		return $this->db->insert('area_trabajo', $data);
	}
	
	public function delete($data)
	{
		return $this->db->delete('area_trabajo', $data); 
	}
	
	public function selectSQL($sql,$data)
	{
		$query=null;
		if($data!=null)
		{
			$query = $this->db->query($sql,$data);
		}
		else		
		{
			$query = $this->db->query($sql);
		}		
		return $query->row();
	}
 
	public function selectSQLAll($sql,$data)
	{
		$query=null;
		if($data!=null)
		{
			$query = $this->db->query($sql,$data);
		}
		else		
		{
			$query = $this->db->query($sql);
		}		
		return $query->result_array();
	}
	
	public function update($id, $data)
	{
		if($id){
			return $this->db->update('area_trabajo', $data, array('art_id' => $id));
		}
		else{
			return FALSE;
		}
	}
}