<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Services extends CI_Model {

 
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
		return $this->db->get_where('cliente', $data)->row();
	}
	
	public function save($data)
	{
		return $this->db->insert('cliente', $data);
	}
	
	public function delete($data)
	{
		return $this->db->delete('cliente', $data); 
	}
	
	public function selectSQL($sql,$data)
	{
		$query = $this->db->query($sql,$data);
		Return $query->row();
	}
 
	public function update($id, $data)
	{
		if($id){
			return $this->db->update('cliente', $data, array('cli_id' => $id));
		}
		else{
			return FALSE;
		}
	}
}