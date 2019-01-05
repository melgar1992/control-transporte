<?php
class Usuario extends CI_Controller {
    
    function __construct(){
		parent::__construct();
		$this->SSS=new SesionMagica();
		
    }
    
    //Autentificación Base de Datos
	function dbLogin(){

		if (!$this->val_ajax(false)) return;
		
		$usr= $this->input->post('username');
		$pwd= $this->input->post('password');
		//$result['user'] = $this->input->post('username');
		//$result['pass'] = $this->input->post('password');
		//$result['resultado'] = $this->User_model->Login($usr, $pwd);
		//$this->load->view('template/resultado', $result);		
		
		if ($this->User_model->Login($usr,$pwd)) {	
			$this->json(true);	
		}else{
			$this->json(false,'Usuario incorrecto');	
		}

	}

	function salir(){
		Usr::limpiar();
		$this->json(true);
		$this->load->view('login');
	}

	function val_ajax($val_usuario=true,$val_admin=false){
		$ajax = isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
		if ($ajax){
			if($val_usuario)
				if(Usr::ok()) {
					if($val_admin)
			    		if(Usr::sa())
						    return true;
						else {		
							$this->json(false,'Operacion no permitida.');
							return false;
						}
					return true;
				}else{
					
				}
			return true;
		}else{
			$this->json(false,'Operación no permitida.');
			return false;
		}
	}

	public function json($ok,$msg=''){
		echo json_encode( ['ok' => $ok, 'msg' => $msg ] );
	}




}