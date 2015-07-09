<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Users extends CI_Model {
 
	protected $table;
	protected $id;
 
	/*
		Constructor del modelo, aqui establecemos
		que tabla utilizamos y cual es su llave primaria.
	*/
	function __construct() {
		parent::__construct();
		$this->table = 'usuario';
		$this->id = 'usu_id';
	}
 
	/*
		Con esta funcion comprobamos que exista el
		usuario en la base de datos, si es asi retornamos
		el contenido del registro, de lo contrario se
		retorna FALSE.
	*/
	public function get($username='', $password='') {
		return $this->db->get_where(
			$this->table, array(
				'per_ced' => $username,
				'usu_pwd' => $password
			)
		)->row();
	}
	
	public function get_params()
	{
		/*
			SELECT *
			FROM parametros
		*/
		$response = $this->db->select('num_ord, iva, mrg_top_ord')
						 ->from('parametros')
						 ->get()->result_array();
		return $response;
	}
	
	public function updateParameters($data)
	{
		return $this->db->update('parametros', $data);
	}
	
	public function update($data,$id)
	{
		$this->db->where($this->id, $id);
		return $this->db->update($this->table, $data);
	}
 
}