<?php
class ContratoEmpleado extends BaseController {
    
    function __construct(){
	parent::__construct();			
    }
    
    public function ContratoEmpleado()
    {
  
      $contratos['datos'] = $this->Contrato_model->obtenerContratoEmpleado();
      $contratos['Accion_pagina'] = 'NuevoContrato';
      $this->loadView('ContratoEmpleado','/form/ContratoEmpleado/nuevo_ContratoEmpleado',$contratos);
      
  
    }

    public function ingresar_contrato(){

    $this->form_validation->set_rules('tipoContrato', 'TipoContrato', 'trim|xss_clean');

    if ($this->form_validation->run() === false) {

      $error = form_error('nombres');

      $respuesta = array(
        'tipo' => 'Formulario',
        'respuesta' => $error
      );
    } else {

      $tipocontrato = $this->input->post('tipocontrato');

      $id_tipocontrato = $this->Contrato_model->insertarTipoContrato($tipocontrato);

      $respuesta = array(
        'respuesta' => 'Exitoso',
        'datos' => array(
          'id_contrato' => $id_tipocontrato,
          'tipocontrato' => $tipocontrato
        )
      );
    }

    echo json_encode($respuesta);
  }

  public function ingresar_contrato_empleado()
  {

    $this->form_validation->set_rules('CI', 'CI', 'trim|xss_clean');
    $this->form_validation->set_rules('nombres', 'Nombres', 'trim|xss_clean');
    $this->form_validation->set_rules('tipoContrato', 'TipoContrato', 'trim|xss_clean');
    $this->form_validation->set_rules('sueldo', 'sueldo', 'trim|xss_clean');
    $this->form_validation->set_rules('fecha-ingreso', 'Fecha Ingreso', 'trim|xss_clean');
    $this->form_validation->set_rules('#fecha-salida', 'Fecha Salida', 'trim|xss_clean');

    if ($this->form_validation->run() === false) {

      $error = form_error('nombres');

      $respuesta = array(
        'tipo' => 'Formulario',
        'respuesta' => $error
      );
    } else {


      $ci = $this->input->post('CI');
      $nombres = $this->input->post('nombres');
      $tipocontrato = $this->input->post('tipocontrato');
      $sueldo = $this->input->post('sueldo');
      $fechain = $this->input->post('FechaIngreso');
      $fechafin = $this->input->post('FechaSalida');

      if ($this->Contrato_model->ExisteContrato($ci) == false) {

        if ($this->Empleado_model->ObtenerEmpleadoxCI($ci) == true) {

          $empleado = $this->Empleado_model->ObtenerEmpleadoxCI($ci);
          $id_tipoContrato = $this->Contrato_model->ObtenerIdTipoContrato($tipocontrato);
          $id_Empleado = $empleado['ID_empleado'];
          $idContrato = $this->Contrato_model->insertarContratoEmpleado($id_Empleado, $id_tipoContrato, $sueldo, $fechain, $fechafin);

          $respuesta = array(
            'respuesta' => 'Exitoso',
            'datos' => array(

              'id_contrato' => $idContrato,
              'id_empleado' => $id_Empleado,
              'id_tipocontrato' => $id_tipoContrato,
              'CI'=> $empleado['CI'],
              'nombres'=> $empleado['Nombres'],
              'Apellido_p'=> $empleado['Apellido_p'],
              'Apellido_m'=>$empleado['Apellido_m'],
              'descripcion'=>$tipocontrato,
              'sueldo' => $sueldo,
              'fechain' => $fechain,
              'fechafin' => $fechafin,
              'hrefEditar'=> site_url('/Contrato/obtenerContratoxID'),
              'hreBorrar'=> site_url('Contrato/eliminar_contrato_empleado'),
            )
          );
        } else {
          $respuesta = array(
            'tipo' => 'No Existe',
            'respuesta' => 'El Empleado no existe'
          );
        }
      } else {
        $respuesta = array(

          'tipo' => 'Empelado activo',
          'respuesta' => 'El Empleado tiene un contrato activo'
        );
      }
    }

    echo json_encode($respuesta);
  }

  public function editar_contrato_empleado()
  {
    $this->form_validation->set_rules('CI', 'CI', 'trim|xss_clean');
    $this->form_validation->set_rules('nombres', 'Nombres', 'trim|xss_clean');
    $this->form_validation->set_rules('tipoContrato', 'TipoContrato', 'trim|xss_clean');
    $this->form_validation->set_rules('sueldo', 'sueldo', 'trim|xss_clean');
    $this->form_validation->set_rules('fecha-ingreso', 'Fecha Ingreso', 'trim|xss_clean');
    $this->form_validation->set_rules('#fecha-salida', 'Fecha Salida', 'trim|xss_clean');

    if ($this->form_validation->run() === false) {

      $error = form_error('nombres');

      $respuesta = array(
        'tipo' => 'Formulario',
        'respuesta' => $error
      );
    } else {

      $ci = $this->input->post('CI');
      $tipocontrato = $this->input->post('tipocontrato');
      $sueldo = $this->input->post('sueldo');
      $fechain = $this->input->post('FechaIngreso');
      $fechafin = $this->input->post('FechaSalida');

      if ($this->Contrato_model->ExisteContrato($ci) == true) {

        $id_contrato = $this->Contrato_model->ExisteContrato($ci);
        $id_tipoContrato = $this->Contrato_model->ObtenerIdTipoContrato($tipocontrato);
        $this->Contrato_model->updateContrato($id_contrato['ID_contrato'],$id_tipoContrato,$sueldo,$fechain,$fechafin);

          $respuesta = array(
            'respuesta' => 'Exitoso',
            'datos' => array(
              'id_tipocontrato' => $tipocontrato,
              'sueldo' => $sueldo,
              'fechain' => $fechain,
              'fechafin' => $fechafin,
            )
          );
        
      } else {
        $respuesta = array(

          'tipo' => 'Contrato no encontrado',
          'respuesta' => 'El contrato no fue encontrado en la base de datos'
        );
      }
    }
    echo json_encode($respuesta);
  }
  public function eliminar_contrato_empleado()
  {
   $id_contrato = $this->input->post('ID_contrato');

   $this->Contrato_model->eliminarContratoEmpleado($id_contrato);

   $respuesta = array(
    'tipo' => 'Exitoso',
    'respuesta' => 'Se elimino al empleado'
    );
    echo json_encode($respuesta);
  }
  public function obtenerContrato()
  {
    $obtenerContrato = $this->Contrato_model->obtenerContrato();
    return $obtenerContrato;
    
  }

  public function obtenerContratoxID()
  {
    $id_contrato = $this->input->post('ID_contrato');

    if ($this->Contrato_model->obtenerContratoxID($id_contrato) == true) {

      $contrato = $this->Contrato_model->obtenerContratoxID($id_contrato);
      $respuesta = array(
        'respuesta' => 'Exitoso',
        'datos' => array(

          'CI' => $contrato['CI'],
          'Nombres' => $contrato['Nombres'],
          'Descripcion' => $contrato['Descripcion'],
          'sueldo' => $contrato['sueldo'],
          'fechain' => $contrato['FechaIngreso'],
          'fechafin' => $contrato['FechaSalida'],
        )
      );
    } else {
      $respuesta = array(

        'tipo' => 'Contrato no encontrato',
        'respuesta' => 'El contrato no fue encontrado'
      );
    }
    echo json_encode($respuesta);
  }


}