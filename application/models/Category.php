<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Category extends CI_Model {

 
	/*
		Constructor del modelo
	*/
	function __construct() {
		parent::__construct();
	}
	
	
	public function get_all(){
		return $this->db->order_by('cat_nom asc')->get('categoria')->result_array();
	}
	
	/*
	 * -------------------------------------------------------------------
	 *  returns:
	 *			0 => name exists,
	 *			1 => insert correct,
	 *			2 => insert incorrect
	 * -------------------------------------------------------------------
	 */
	public function save($data)
	{
		$name = $this->db->get_where('categoria', $data)->row();
		if($name != null){ return 0; }
		elseif($this->db->insert('categoria', $data)){ return 1; }
		else{ return 2; }
		
	}
 	
 	public function delete($data){ return $this->db->delete('categoria', $data); }
	
	public function update($id, $data)
	{
		if($id){
			return $this->db->update('categoria', $data, array('cat_id' => $id));
		}
		else{ return FALSE;}
	}
}