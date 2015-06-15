<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Garantias extends CI_Model {

 
	/*
		Constructor del modelo
	*/
	function __construct() {
		parent::__construct();
	}
 
	public function get($data) {
		return $this->db->get_where('revision', $data)->row();
	}
	
	public function selectSQLMultiple($sql,$data) {
		$query = $this->db->query($sql,$data);
		Return $query->result_array();
	}
	
	public function save($data)
	{
		return $this->db->insert('revision', $data);
	}
	
	public function delete($data)
	{
		return $this->db->delete('revision', $data); 
	}
	
	public function selectSQL($sql,$data)
	{
		$query = $this->db->query($sql,$data);
		Return $query->row();
	}
 
	public function update($id, $data)
	{
		if($id){
			return $this->db->update('revision', $data, array('rev_id' => $id));
		}
		else{
			return FALSE;
		}
	}
}