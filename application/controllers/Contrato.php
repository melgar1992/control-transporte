<?php
class Contrato extends BaseController {
    
    function __construct(){
		parent::__construct();			
    }
    
    public function index(){

        $contratos['datos'] = $this->Contrato_model->obtenerContrato();
        $this->loadView('Contrato', '/form/contrato/nuevo_contrato',$contratos);
        
    }

    public function ingresar_contrato(){

    }
    
}