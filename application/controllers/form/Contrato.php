<?php
class Contrato extends CI_Controller {
    
    function __construct(){
		parent::__construct();			
    }
    
    public function index(){

        $this->load->view('template/header');
		$this->load->view('template/menu_quick_info');
		$this->load->view('template/sidebar_menu');
        $this->load->view('/form/contrato/nuevo_contrato');
        $this->load->view('template/footer');
        
    }

    
}