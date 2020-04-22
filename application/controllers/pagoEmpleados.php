<?php
class pagoEmpleados extends BaseController
{

  function __construct()
  {
    parent::__construct();
  }

  public function pagoEmpleado()
  {

    $pagos['datos'] = $this->pagoEmpleado_model->obtenerPagoEmpleados();
    $pagos['empleados'] = $this->Empleado_model->obtenerEmpleado();
    $pagos['Accion_pagina'] = 'NuevoPago';
    $this->loadView('PagoEmpleado', '/form/pagoEmpleado/nuevo_pago', $pagos);
  }
  public function IngresarPagoEmpleado()
  {
    $this->form_validation->set_rules('ID_contrato', 'ID_contrato', 'trim|xss_clean');
    $this->form_validation->set_rules('FechaPago', 'FechaPago', 'trim|xss_clean');
    $this->form_validation->set_rules('descripcion', 'descripcion', 'trim|xss_clean');
    $this->form_validation->set_rules('Monto', 'Monto', 'trim|xss_clean');
    try {
      if ($this->form_validation->run() === false) {

        $error = form_error('nombres');

        $respuesta = array(
          'tipo' => 'Formulario',
          'respuesta' => $error
        );
      } else {

        $ID_contrato = $this->input->post('ID_contrato');
        $FechaPago = $this->input->post('FechaPago');
        $descripcion = $this->input->post('descripcion');
        $Monto = $this->input->post('Monto');
        $contrato = $this->Contrato_model->obtenerContratoxID($ID_contrato);
        if (isset($contrato)) {

          $id_pagoEmpleado = $this->pagoEmpleado_model->insertarPagoEmpleado($ID_contrato, $FechaPago, $descripcion, $Monto);
          $respuesta = array(
            'respuesta' => 'Exitoso',
            'datos' => array(
              'id_pago' => $id_pagoEmpleado,
              'id_contrato' => $ID_contrato,
              'nombres' => $contrato['Nombres'],
              'Apellido_p' => $contrato['Apellido_p'],
              'FechaPago' => $FechaPago,
              'descripcion' => $descripcion,
              'Monto' => $Monto,
            ),
            'message' => 'Se agrego correctamente el pago!.',
          );
        } else {
          $respuesta = array(
            'tipo' => 'No Existe',
            'respuesta' => 'El Empleado no existe o el contrato no existe'
          );
        }
      }
    } catch (\Throwable $th) {
      $respuesta['respuesta'] = 'Error';
      $respuesta['message'] = $th->getMessage();
    }

    echo json_encode($respuesta);
  }
  public function editar_pago_empleado()
  {
    $id_pago = $this->input->get('id');

    if ($id_pago) {

      $pagos['datos'] = $this->pagoEmpleado_model->IdPagoEmpleado($id_pago);
      $pagos['empleados'] = $this->Empleado_model->obtenerEmpleado();
      $pagos['Accion_pagina'] = 'EditarPago';
      $this->loadView('PagoEmpleado', '/form/pagoEmpleado/nuevo_pago', $pagos);
    } else {
      $accion = $this->input->post('accion');
      if ($accion == 'Editar') {
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
            )
          );
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
  public function EliminarPagoEmpleado($id_pago)
  {

    $this->pagoEmpleado_model->EliminarPago($id_pago);
    $respuesta = array(
      'tipo' => 'Exitoso',
      'respuesta' => 'Se elimino al empleado'
    );
    echo json_encode($respuesta);
  }
}
