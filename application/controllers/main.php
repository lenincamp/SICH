<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends Private_Controller {

	/*function __construct() {
		parent::__construct();
		$this->removeCache();
	}*/
	
	public function index()
	{
		$this->load->view('login');
	}
	
	public function updatePass()
	{
		if(!@$this->user) redirect ('main');
		if ($this->input->is_ajax_request()) 
    	{
			$data = array(
    			'usu_pwd'  => $this->input->post('txtPassConfirm')
    		);
			$user_data = (array)$this->session->userdata('logged_user');
			if($user_data["usu_pwd"]==$this->input->post('txtActualPass'))
			{	
				$response = $this->users->update($data,$user_data["usu_id"]);
				echo json_encode($response);
			}
			else
			{
				$response="noPass";
				echo json_encode($response);
			}
			
		}
		else
		{
			exit('No direct script access allowed');
			show_404();
		}
		return FALSE;
	}
	
	public function home()
	{
		if(!@$this->user) redirect ('main');
		$title['title'] = 'home';
		$data['funcion']="<script type='text/javascript'> seleccionar('mn_home') </script>";
		$this->load->view('templates/header', $title);
		$this->load->view('user/inicio');
		$this->load->view('templates/footer',$data);
	}
	
	public function conf()
	{
		if(!@$this->user) redirect ('main');
		$data['js'] = array(
			base_url()."static/js/users/user.js",
			base_url()."static/js/bootstrap-select.min.js",
			base_url()."static/js/i18n/defaults-es_CL.min.js",
			base_url()."static/js/pnotify.custom.min.js"
			);
		$title['title'] = 'settings';
		$title['css'] = array(base_url()."static/css/pnotify.custom.min.css");
		$data['funcion']="<script type='text/javascript'> seleccionar(null) </script>";
		$this->load->view('templates/header', $title);
		$this->load->view('user/setting');
		$this->load->view('templates/footer',$data);
	}
	
	public function login() {
 
		$data = array();
 
		// Añadimos las reglas necesarias.
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
 
		// Generamos el mensaje de error personalizado para la accion 'required'
		$this->form_validation->set_message('required', 'El campo %s es requerido.');
 		
 		$username = $this->input->post('username');
 		$passwd   = $this->input->post('password'); 
 		
		// Si username y password existen en post
		if($username && $passwd) {
			// Si las reglas se cumplen, entramos a la condicion.
			if ($this->form_validation->run()) {
 
				// Obtenemos la informacion del usuario desde el modelo users.
				$logged_user = $this->users->get($username, $passwd);

				// Si existe el usuario creamos la sesion y redirigimos al index.
				if($logged_user) {
					$this->session->set_userdata('logged_user', $logged_user);
					redirect('main/home/');
				} else {
					// De lo contrario se activa el error_login.
					$data['error_login'] = TRUE;
				}
			}
		}
 
		$this->load->view('login', $data);
	}
 
	public function logout() {
		$this->session->unset_userdata('logged_user');
		redirect('main');
	}
	
}

/* End of file main.php */
/* Location: ./application/controllers/main.php */