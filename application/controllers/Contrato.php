<?php
class Contrato extends BaseController
{

  function __construct()
  {
    parent::__construct();
  }

  public function tipocontrato()
  {
    $contratos['datos'] = $this->Contrato_model->obtenerTipoContrato();
    $this->loadView('Contrato', '/form/contrato/nuevo_tipo_contrato', $contratos);
  }

  public function ingresar_tipo_contrato()
  {

    // Validar el tipo de dato a ingresar

    $this->form_validation->set_rules('tipoContrato', 'Tipo del Contrato', 'trim|xss_clean');

    // Preguntamos si los datos fueron cargados correctamente

    if ($this->form_validation->run() === false) {

      $error = form_error('tipoContrato');

      $respuesta = array(
        'tipo' => 'Formulario',
        'respuesta' => $error
      );
    } else {

      $tipocontrato = $this->input->post('tipoContrato');

      $id_tipoContrato = $this->Contrato_model->insertar_tipo_contrato($tipocontrato);

      $respuesta = array(
        'respuesta' => 'Exitoso',
        'datos' => array(
          'id_tipocontrato' => $id_tipoContrato,
          'tipocontrato' => $tipocontrato,
        )
      );
    }
    echo json_encode($respuesta);
  }

  public function editar_tipo_contrato()
  {


    $id_tipoContrato = $this->input->post('id_tipocontrato');
    $Descripcion = $this->input->post('tipoContrato');
    $this->Contrato_model->editar_tipo_contrato($id_tipoContrato, $Descripcion);

    $respuesta = array(
      'respuesta' => 'Exitoso',
      'mensage' => 'Se edito correctamente'
    );



    echo json_encode($respuesta);
  }



  public function eliminar($id_tipoContrato)
  {

    $this->Contrato_model->eliminarTipoContrato($id_tipoContrato);
    $respuesta = array(
      'respuesta' => 'Exitoso',
      'mensage' => 'Se elimino correctamente'
    );

    echo json_encode($respuesta);
  }
}
