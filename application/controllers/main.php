<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends Private_Controller {

	function __construct() {
		parent::__construct();
		//$this->removeCache();
		
		// Se carga el modelo de usuarios.
		$this->load->model('users');
	}
	
	public function index()
	{
		$this->load->helper('security');
		$str_data = file_get_contents(base_url()."static/js/users/prms.json");
		$data = json_decode($str_data,true);
		// Se carga el helper form.
		if($data["prma"]==substr(do_hash('y', 'md5'),1))
		{
			$this->load->helper('form');
			
			$this->load->view('login');
		}
		else
		{
			$this->load->helper('form');
			$this->load->view('active');
			$this->load->view('templates/footer');
		}
	}
	
	public function updateParams()
	{
		if(!@$this->user) redirect ('main');
		if ($this->input->is_ajax_request()) 
    	{
			$data = array(
				'iva'  => $this->input->post('txtIva'),
<<<<<<< HEAD
				'num_ord'  => $this->input->post('txtNumOrd')
=======
				'num_ord'  => $this->input->post('txtNumOrd'),
				'mrg_top_ord'  => $this->input->post('txtMrgTop')
>>>>>>> 43db682758d604ed75556dd5aac21348069683d3
			);
			echo json_encode($this->users->updateParameters($data));
		}
	}
	
	public function updatePass()
	{
		$this->load->helper('security');
		if(!@$this->user) redirect ('main');
		if ($this->input->is_ajax_request()) 
    	{
			$data = array(
    			'usu_pwd'  => do_hash($this->input->post('txtPassConfirm'), 'md5')
    		);
			$user_data = (array)$this->session->userdata('logged_user');
			if($user_data["usu_pwd"] === do_hash($this->input->post('txtActualPass'), 'md5'))
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
			base_url()."static/js/library/alls.js",
			base_url()."static/js/users/user.js",
			base_url()."static/js/bootstrap-select.min.js",
			base_url()."static/js/i18n/defaults-es_CL.min.js",
			base_url()."static/js/pnotify.custom.min.js"
			);
		$title['title'] = 'settings';
		$title['css'] = array(base_url()."static/css/pnotify.custom.min.css");
		$data['funcion']="<script type='text/javascript'> seleccionar(null) </script>";
		$contenido["params"]=$this->users->get_params();
		$this->load->view('templates/header', $title);
		$this->load->view('user/setting',$contenido);
		$this->load->view('templates/footer',$data);
	}
	
	public function help()
	{
		if(!@$this->user) redirect ('main');
		$title['title'] = 'help';
		$data['funcion']="<script type='text/javascript'> seleccionar(null) </script>";
		$this->load->view('templates/header', $title);
		$this->load->view('user/help');
		$this->load->view('templates/footer',$data);
	}
	
	public function login() {


		// Se carga el helper form y security.
		$this->load->helper(array('form', 'security'));

		// Se carga la libreria form_validation.
		$this->load->library('form_validation');
		
		$data = array();
 
		// Añadimos las reglas necesarias.
		$this->form_validation->set_rules('username', 'Usuario', 'required|trim|min_length[10]|max_length[10]|xss_clean|callback_validar_ci');
		$this->form_validation->set_rules('password', 'Contraseña', 'required|trim|md5|min_length[5]|max_length[32]|xss_clean');
 		
        
		// Generamos el mensaje de error personalizado para la accion 'required', 'min_lenght', 'max_lenght'
		$this->form_validation->set_message('required', ' * El campo %s es requerido.');
		$this->form_validation->set_message('min_length', ' * El %s debe tener al menos %s carácteres');
        $this->form_validation->set_message('max_length', ' * El %s debe tener al menos %s carácteres');
        $this->form_validation->set_message('validar_ci', ' * La Cédula es Incorrecta..!');
 		
 		$username = $this->input->post('username');
 		$passwd   = do_hash($this->input->post('password'), 'md5'); 
 		
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
		$this->session->sess_destroy();
		redirect('main');
	}
	
}

/* End of file main.php */
/* Location: ./application/controllers/main.php */