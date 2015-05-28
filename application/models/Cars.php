<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Cars extends CI_Model {

 
	/*
		Constructor del modelo
	*/
	function __construct() {
		parent::__construct();
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