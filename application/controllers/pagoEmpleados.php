<?php
class pagoEmpleados extends BaseController {
    
    function __construct(){
	parent::__construct();			
    }
    
    public function pagoEmpleado()
    {
  
      $pagos['datos'] = $this->pagoEmpleado_model->obtenerPagoEmpleados();
      $pagos['empleados']= $this->Empleado_model->obtenerEmpleado();
      $pagos['AccionPagina']= 'NuevoPago';
      $this->loadView('PagoEmpleado','/form/pagoEmpleado/nuevo_pago',$pagos);
      
  
    }
    public function IngresarPagoEmpleado(){
      $this->form_validation->set_rules('CI', 'CI', 'trim|xss_clean');
      $this->form_validation->set_rules('fecha_pago', 'fecha_pago', 'trim|xss_clean');
      $this->form_validation->set_rules('mes_correspondiente', 'mes_correspondiente', 'trim|xss_clean');
      $this->form_validation->set_rules('descripcion', 'descripcion', 'trim|xss_clean');
      $this->form_validation->set_rules('pago', 'pago', 'trim|xss_clean');

      if ($this->form_validation->run() === false) {

        $error = form_error('nombres');
  
        $respuesta = array(
          'tipo' => 'Formulario',
          'respuesta' => $error
        );
      } else {

        $ci = $this->input->post('CI');
        $fecha_pago = $this->input->post('fecha_pago');
        $mes_correspondiente = $this->input->post('mes_correspondiente');
        $descripcion = $this->input->post('descripcion');
        $pago = $this->input->post('pago');
        if ($this->Contrato_model->ExisteContrato($ci)) {

          $contrato = $this->Contrato_model->ExisteContrato($ci);
          $id_pagoEmpleado = $this->pagoEmpleado_model->insertarPagoEmpleado($contrato['ID_contrato'],$fecha_pago,$mes_correspondiente,$descripcion,$pago);

          $respuesta = array(
            'respuesta' => 'Exitoso',
            'datos' => array(
              'id_contrato' => $id_pagoEmpleado,
              'id_contrato' => $contrato['ID_contrato'],
              'fecha_pago' => $fecha_pago,
              'mes_correspondiente' => $mes_correspondiente,
              'descripcion' => $descripcion,
              'pago' => $pago
            )
          );
          
          
        } else {
          $respuesta = array(
            'tipo' => 'No Existe',
            'respuesta' => 'El Empleado no existe o el contrato no existe'
          );
        }
        
    }
    echo json_encode($respuesta);
  }
}