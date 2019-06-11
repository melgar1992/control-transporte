<?php
class pagoEmpleados extends BaseController {
    
    function __construct(){
	parent::__construct();			
    }
    
    public function pagoEmpleado()
    {
  
      $pagos['datos'] = $this->pagoEmpleado_model->obtenerPagoEmpleados();
      $this->loadView('','/form/pagoEmpleado/nuevo_pago',$pagos);
      
  
    }
}