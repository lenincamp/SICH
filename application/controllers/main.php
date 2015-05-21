<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends Private_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->view('login');
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
					redirect('main/menu/');
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
	
	public function menu()
	{
		if(!@$this->user) redirect ('main');
		$data['prueba'] = 'Prueba renderiza variable';
		$title['title'] = 'home';
		$this->load->view('templates/header', $title);
		$this->load->view('user/body', $data);
		$this->load->view('templates/footer');
	}
}

/* End of file main.php */
/* Location: ./application/controllers/welcome.php */