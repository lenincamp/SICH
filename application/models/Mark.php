<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Mark extends CI_Model {

 
	/*
		Constructor del modelo
	*/
	function __construct() {
		parent::__construct();
	}
	
	
	public function get_all(){
		//return $this->db->order_by('mar_nom asc')->get('marca')->result_array();
		return $this->db->get('marca')->result_array();
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
		$name = $this->db->get_where('marca', $data)->row();
		if($name != null){ return 0; }
		elseif($this->db->insert('marca', $data)){ return 1; }
		else{ return 2; }
		
	}
 	
 	public function delete($data){ return $this->db->delete('marca', $data); }
	
	public function update($id, $data)
	{
		if($id){
			return $this->db->update('marca', $data, array('mar_id' => $id));
		}
		else{ return FALSE;}
	}
}