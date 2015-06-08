<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Details_Inventary extends CI_Model {

 
	/*
		Constructor del modelo
	*/
	function __construct() {
		parent::__construct();
	}
	
	
	public function get_all(){
		return $this->db->order_by('pie_nom asc')->get('piezas_auto')->result_array();
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
		$name = $this->db->get_where('piezas_auto', $data)->row();
		if($name != null){ return 0; }
		elseif($this->db->insert('piezas_auto', $data)){ return 1; }
		else{ return 2; }
		
	}
 	
 	public function delete($data){ return $this->db->delete('piezas_auto', $data); }
	
	public function update($id, $data)
	{
		if($id){
			return $this->db->update('piezas_auto', $data, array('pie_id' => $id));
		}
		else{ return FALSE;}
	}
}