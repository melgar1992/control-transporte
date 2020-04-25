<?php
class ContratoEmpleado extends BaseController
{

  function __construct()
  {
    parent::__construct();
  }

  public function ContratoEmpleado()
  {

    $contratos['tipocontratos'] = $this->Contrato_model->obtenerTipoContrato();
    $contratos['datos'] = $this->Contrato_model->obtenerContratoEmpleado();
    $contratos["empleados"] = $this->Empleado_model->obtenerEmpleado();
    $this->loadView('ContratoEmpleado', '/form/ContratoEmpleado/nuevo_ContratoEmpleado', $contratos);
  }

  public function ingresar_contrato()
  {

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

    try {
      $this->form_validation->set_rules('ID_empleado', 'ID_empleado', 'trim|xss_clean');
      $this->form_validation->set_rules('tipocontrato', 'tipocontrato', 'trim|xss_clean');
      $this->form_validation->set_rules('sueldo', 'sueldo', 'trim|xss_clean');
      $this->form_validation->set_rules('FechaIngreso', 'Fecha Ingreso', 'trim|xss_clean');
      $this->form_validation->set_rules('#FechaSalida', 'Fecha Salida', 'trim|xss_clean');

      if ($this->form_validation->run() === false) {

        $error = form_error('nombres');

        $respuesta = array(
          'tipo' => 'Formulario',
          'respuesta' => $error
        );
      } else {


        $ID_empleado = $this->input->post('ID_empleado');
        $id_tipoContrato = $this->input->post('tipocontrato');
        $sueldo = $this->input->post('sueldo');
        $fechain = $this->input->post('FechaIngreso');
        $fechafin = $this->input->post('FechaSalida');

        if ($this->Contrato_model->ExisteContrato($ID_empleado) == false) {

          if ($this->Empleado_model->idempleado($ID_empleado) == true) {

            $empleado = (array) $this->Empleado_model->idempleado($ID_empleado);
            $idContrato = $this->Contrato_model->insertarContratoEmpleado($ID_empleado, $id_tipoContrato, $sueldo, $fechain, $fechafin);
            $tipoContrato = $this->Contrato_model->ObtenerTipoContratoxID($id_tipoContrato);
            $respuesta = array(
              'respuesta' => 'Exitoso',
              'datos' => array(
                'id_contrato' => $idContrato,
                'id_empleado' => $ID_empleado,
                'id_tipocontrato' => $id_tipoContrato,
                'CI' => $empleado['CI'],
                'nombres' => $empleado['Nombres'],
                'Apellido_p' => $empleado['Apellido_p'],
                'Apellido_m' => $empleado['Apellido_m'],
                'descripcion' => $tipoContrato['Descripcion'],
                'sueldo' => $sueldo,
                'fechain' => $fechain,
                'fechafin' => $fechafin,

              ),
              'message' => 'El contrato se guardo correctamente',
            );
          } else {
            $respuesta = array(
              'estado' => 'Error',
              'message' => 'El Empleado no existe'
            );
          }
        } else {
          $respuesta = array(

            'estado' => 'Error',
            'message' => 'El Empleado tiene un contrato activo'
          );
        }
      }
    } catch (\Throwable $th) {
      //throw $th;
      $respuesta['estado'] = 'Error';
      $respuesta['message'] = $th->getMessage();
    }


    echo json_encode($respuesta);
  }

  public function editar_contrato_empleado()
  {


    $this->form_validation->set_rules('tipocontrato', 'TipoContrato', 'trim|xss_clean');
    $this->form_validation->set_rules('sueldo', 'sueldo', 'trim|xss_clean');
    $this->form_validation->set_rules('FechaIngreso', 'Fecha Ingreso', 'trim|xss_clean');
    $this->form_validation->set_rules('FechaSalida', 'Fecha Salida', 'trim|xss_clean');
    try {
      if ($this->form_validation->run() === false) {
        $error = form_error('nombres');
        $respuesta = array(
          'tipo' => 'Formulario',
          'respuesta' => $error
        );
      } else {

        $id_contrato = $this->input->post('ID_contrato');
        $id_tipoContrato = $this->input->post('tipocontrato');
        $sueldo = $this->input->post('sueldo');
        $fechain = $this->input->post('FechaIngreso');
        $fechafin = $this->input->post('FechaSalida');

        if ($this->Contrato_model->updateContrato($id_contrato, $id_tipoContrato, $sueldo, $fechain, $fechafin)) {
          $nuevoContrato = $this->Contrato_model->obtenerContratoxID($id_contrato);
          $respuesta = array(
            'respuesta' => 'Exitoso',
            'datos' => array(
              'id_contrato' => $id_contrato,
              'CI' => $nuevoContrato['CI'],
              'nombres' => $nuevoContrato['Nombres'],
              'Apellido_p' => $nuevoContrato['Apellido_p'],
              'Apellido_m' => $nuevoContrato['Apellido_m'],
              'Descripcion' => $nuevoContrato['Descripcion'],
              'sueldo' => $sueldo,
              'fechain' => $fechain,
              'fechafin' => $fechafin,

            ),
            'message' => 'El contrato se edito correctamente',
          );
        }
      }
    } catch (\Throwable $th) {
      $respuesta = array(
        'estado' => 'Error',
        'message' =>  $th->getMessage(),
      );
    }

    echo json_encode($respuesta);
  }
  public function eliminar_contrato_empleado($id_contrato)
  {
    $this->Contrato_model->eliminarContratoEmpleado($id_contrato);
    $respuesta = array(
      'tipo' => 'Exitoso',
      'respuesta' => 'Se elimino el contrato'
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
    $contrato = $this->Contrato_model->obtenerContratoIDSinFecha($id_contrato);
    if (isset($contrato)) {

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
    echo json_encode((array) $respuesta);
  }
  public function buscarEmpleadoNombreAjax()
  {
    $valor = $this->input->post('valor');
    $contrato = $this->Contrato_model->buscarContratoxNombre($valor);
    echo json_encode($contrato);
  }
  public function buscarEmpleadoCIAjax()
  {
    $valor = $this->input->post('valor');
    $contrato = $this->Contrato_model->buscarContratoxCI($valor);
    echo json_encode($contrato);
  }
}
