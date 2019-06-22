<?php
class pagoEmpleados extends BaseController {
    
    function __construct(){
	parent::__construct();			
    }
    
    public function pagoEmpleado()
    {
  
      $pagos['datos'] = $this->pagoEmpleado_model->obtenerPagoEmpleados();
      $pagos['empleados']= $this->Empleado_model->obtenerEmpleado();
      $pagos['Accion_pagina']= 'NuevoPago';
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
          $empleado = $this->Empleado_model->ObtenerEmpleadoxCI($ci);
          $respuesta = array(
            'respuesta' => 'Exitoso',
            'datos' => array(
              'id_pago' => $id_pagoEmpleado,
              'id_contrato' => $contrato['ID_contrato'],
              'nombres' => $empleado['Nombres'],
              'Apellido_p' => $empleado['Apellido_p'],
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
  public function editar_pago_empleado()
  {
    $id_pago = $this->input->get('id');
      
      if($id_pago){
        
        $pagos['datos'] = $this->pagoEmpleado_model->IdPagoEmpleado($id_pago);
        $pagos['empleados']= $this->Empleado_model->obtenerEmpleado();        
        $pagos['Accion_pagina'] = 'EditarPago';
        $this->loadView('PagoEmpleado','/form/pagoEmpleado/nuevo_pago',$pagos);
      }
      else{
        $accion = $this->input->post('accion');
        if($accion == 'Editar'){
          try {
            
            $id_pago = $this->input->post('ID_pago');
            $fecha_pago = $this->input->post('fecha_pago');
            $mes_correspondiente = $this->input->post('mes_correspondiente');
            $descripcion = $this->input->post('descripcion');
            $pago = $this->input->post('pago');
            $this->pagoEmpleado_model->editar_pago_empleado($id_pago, $fecha_pago, $mes_correspondiente, $descripcion, $pago);
            
            $respuesta = array(
              'respuesta' => 'Exitoso',
              'mensage' => 'Se guardo correctamente',
              'datos' => array(
                'id_pago' => $id_pago,
                'fecha_pago' => $fecha_pago,
                'mes_correspondiente' => $mes_correspondiente,
                'descripcion' => $descripcion,
                'pago' => $pago
            ));
          } catch (\Throwable $th) {
            //throw $th;
            $respuesta = array(
              'respuesta' => 'Error',
              'mensage' => $th
            );
          }
        }

        echo json_encode($respuesta);

      }
    
  }
}