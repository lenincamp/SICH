<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

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
	
	public function home()
	{
		$title['title']  = 'home';
		$this->load->view('templates/header', $title);
		$this->load->view('user/inicio');
		$this->load->view('templates/footer');
	}
	
	public function menu()
	{
		$data['prueba'] = 'Prueba renderiza variable';
		$title['title']  = 'home';
		$this->load->view('templates/header', $title);
		$this->load->view('user/body', $data);
		$this->load->view('templates/footer');
	}
}
