<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Clients extends CI_Model {

 
	/*
		Constructor del modelo
	*/
	function __construct() {
		parent::__construct();
	}
 
	
	public function get_all()
	{
		/*
			SELECT per_id, per_ced, per_nom, per_ape, cli_id, cli_dir, cli_eml, cli_tel
			FROM cliente
		*/
		return $this->db->get('cliente')->result_array();
		
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
}