<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class BaseController extends CI_Controller { 
    function __construct(){
		parent::__construct();		
    }
		
		
	private function user_already_logged(){
		return isset($this->session->userdata['logged_in']);
	}


	//Ingresa un nuevo usuario
	public function new_user_registration() {

		// Check validation for user input in SignUp form
		$this->form_validation->set_rules('username', 'Usuario', 'trim|required|xss_clean');
		$this->form_validation->set_rules('privilegio', 'Privilegio', 'trim|required|xss_clean');
		$this->form_validation->set_rules('password', 'Contraseña', 'trim|required|xss_clean');
		if ($this->form_validation->run() == FALSE) {
			$this->load->view('login');
		} else {
				$data = array(
						'username' => $this->input->post('username'),
						'privilegios' => $this->input->post('privilegio'),
						'password' => $this->input->post('password'),
						'url_img' => 'images/user.png'
				);

				//Applying security to the password. Must be encrypted
				$hashed_password = password_hash($data['password'], PASSWORD_DEFAULT);
				$data['password'] = $hashed_password;

				$result = $this->User_model->registration_insert($data);
				if ($result == TRUE) {
						$data['message_display'] = 'Registration Successfully !';
						$this->load->view('login', $data);
				} else {
						$data['message_display'] = 'Username or Email already exist!';
						$this->load->view('registration_form', $data);
				}
		}
}

	// Validar usuario y seguridad
	public function loadView($pagina,$url,$datos=[]){
		$datos['pagina']=$pagina;
		$this->load->view('template/header');
		$this->load->view('template/menu_quick_info');
		$this->load->view('template/sidebar_menu');
		$this->load->view($url,$datos);
		$this->load->view('template/footer');
	}


	//Valida el usuario que se quiere conectar.
	public function user_login_process(){
		$this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');

		if ($this->form_validation->run() == FALSE) {
			if(isset($this->session->userdata['logged_in'])){
				$this->loadView('inicio','inicio');
			}else{
				$this->load->view('login');
			}
		}else {
			$data = array(
				'username' => $this->input->post('username'),
				'password' => $this->input->post('password')
			);

			$result = $this->User_model->login($data);

			if (password_verify($data['password'], $result[0]->password)){
				$username = $this->input->post('username');
				$result = $this->User_model->read_user_information($username);
				if ($result != false) {
					$session_data = array(
						'username' => $result[0]->username,
						'url_img' => $result[0]->url_img,
						'privilegios' => $result[0]->privilegios
					);

					//Añade los datos a la session
					$this->session->set_userdata('logged_in', $session_data);
					$this->loadView('inicio','inicio');
				}		
			}

		}




	}

	// Logout from admin page

	public function logout() {

		// Removing session data
		$sess_array = array(
				'username' => ''
		);
		$this->session->unset_userdata('logged_in', $sess_array);
		$this->session->sess_destroy();
		$data['message_display'] = 'Successfully Logout';
		$this->load->view('login', $data);
}

}