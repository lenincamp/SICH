<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Cars extends CI_Model {

 
	/*
		Constructor del modelo
	*/
	function __construct() {
		parent::__construct();
	}
	
	
	public function get_all()
	{
		/*
			SELECT  per_ced, per_nom||' '||per_ape as nombres, mar_nom, mod_nom , veh_pla, veh_col, veh_id
			FROM    cliente, vehiculo, modelo, marca
			WHERE id_cli = cli_id AND id_modelo = mod_id AND id_marca = mar_id
			ORDER BY per_nom, per_ape;
	    */
		$response = $this->db->select("cli_id, per_ced, per_nom||' '||per_ape as nombres, mar_id, mar_nom, mod_id, mod_nom , veh_pla, veh_col, veh_id")
						 ->from('vehiculo')
						 ->join('cliente', 'id_cli = cli_id')
						 ->join('modelo', 'id_modelo = mod_id')
						 ->join('marca', 'id_marca = mar_id')
						 ->order_by('per_nom asc, per_ape asc')
						 ->get()->result_array();
		return $response;
	}
	
	public function get_for_client($data)
	{
		/*
			SELECT  per_ced, per_nom||' '||per_ape as nombres, mar_nom, mod_nom , veh_pla, veh_col, veh_id
			FROM    cliente, vehiculo, modelo, marca
			WHERE id_cli = cli_id AND id_modelo = mod_id AND id_marca = mar_id
			ORDER BY per_nom, per_ape;
	    */
		$response = $this->db->select("cli_id, per_ced, per_nom||' '||per_ape as nombres, mar_id, mar_nom, mod_id, mod_nom , veh_pla, veh_col, veh_id, mod.cat_id, cat_nom")
						 ->from('vehiculo')
						 ->join('cliente', 'id_cli = cli_id')
						 ->join('modelo as mod', 'id_modelo = mod.mod_id')
						 ->join('marca', 'id_marca = mar_id')
						 ->join('categoria as cat', 'cat.cat_id = mod.cat_id')
						 ->order_by('per_nom asc, per_ape asc')
						 ->where($data)->get()->result_array();
		return $response;
	}
	
	public function get_for_id($data)
	{ return $this->db->get_where('vehiculo', $data)->row(); }
	
	/*
	 * -------------------------------------------------------------------
	 *  returns:
	 *			0 => insert incorrect,
	 *			1 => insert correct,
	 *			2 => car exists
	 * -------------------------------------------------------------------
	 */
	public function querySQL($sql,$data){ return $this->db->query($sql,$data)->row(); }

	
	public function delete($data){ return $this->db->delete('vehiculo', $data); }
}