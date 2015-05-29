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
			SELECT  cli_id, per_ced, per_nom||' '||per_ape as nombres, mar_id, mar_nom, mod_id, mod_nom , veh_pla, veh_col, veh_id
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
	
	/*
	 * -------------------------------------------------------------------
	 *  returns:
	 *			0 => insert incorrect,
	 *			1 => insert correct,
	 *			2 => car exists
	 * -------------------------------------------------------------------
	 */
	public function save($sql,$data)
	{
		$query = $this->db->query($sql,$data);
		return $query->row();
	}
	
}