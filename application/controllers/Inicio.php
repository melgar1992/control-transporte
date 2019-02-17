<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inicio extends BaseController {
	function __construct(){
		parent::__construct();
    }


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
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	
	public function login()
	{
		$this->load->view('login');
	}
	
	 public function index()
	{
		if(Usr::ok()){
			
			$this->load->view('template/header');
			$this->load->view('template/menu_quick_info');
			$this->load->view('template/sidebar_menu');
			$this->load->view('inicio');
			$this->load->view('template/footer');

		}
		else{
			$this->login();
		}

	}

}
