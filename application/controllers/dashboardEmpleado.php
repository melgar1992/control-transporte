<?php
class dashboardEmpleado extends BaseController {
    
    function __construct(){
        parent::__construct();
    }
    
    public function index(){

        $datos['empleados'] = $this->Empleado_model->obtenerEmpleado();
        $datos['contratos'] = $this->Contrato_model->obtenerContratoEmpleado();
        $datos['pago'] = $this->pagoEmpleado_model->ObtenerPagosDelMesActual();
       
        $this->loadView('Dashboard_empleados','/form/Dashboard/dashboard_empleados',$datos);

     }


}