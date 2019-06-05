<?php
class Contrato extends BaseController {
    
    function __construct(){
		parent::__construct();			
    }    
    
    public function tipocontrato(){
      $contratos['datos'] = $this->Contrato_model->obtenerTipoContrato();
      $contratos['Accion_pagina'] = 'NuevoTipoContrato';
      $this->loadView('Contrato', '/form/contrato/nuevo_tipo_contrato',$contratos);
    }

    public function ingresar_tipo_contrato(){

      // Validar el tipo de dato a ingresar

      $this->form_validation->set_rules('tipoContrato', 'Tipo del Contrato', 'trim|xss_clean');

      // Preguntamos si los datos fueron cargados correctamente

      if($this->form_validation->run()=== false){

        $error = form_error('tipoContrato');

        $respuesta = array(
          'tipo'=> 'Formulario',
          'respuesta' => $error
        );        
      }else {

        $tipocontrato = $this->input->post('tipoContrato');

        $id_tipoContrato = $this->Contrato_model->insertar_tipo_contrato($tipocontrato);

        $respuesta = array(
          'respuesta' => 'Exitoso',
          'datos' => array(
            'id_tipocontrato' => $id_tipoContrato,
            'tipocontrato' => $tipocontrato,
            'hrefEditar' => site_url('/Contrato/editar_tipo_contrato?id='.$id_tipoContrato),
            'hrefEliminar' => site_url('/Contrato/eliminar_tipo_Contrato')
          )
        );
      }
      echo json_encode($respuesta);
    }

    public function editar_tipo_contrato() {

      $id_tipoContrato = $this->input->get('id');
      
      if($id_tipoContrato){
        
        $contratos['datos'] = $this->Contrato_model->IdTipoContrato($id_tipoContrato);        
        $contratos['Accion_pagina'] = 'EditarTipoContrato';
        $this->loadView('Contrato', '/form/contrato/nuevo_tipo_contrato',$contratos);
      }
      else{
        $accion = $this->input->post('accion');
        if($accion == 'Editar'){
          try {
            //code...
            $id_tipoContrato = $this->input->post('id_tipoContrato');
            $Descripcion = $this->input->post('Descripcion');
            $this->Contrato_model->editar_tipo_contrato($id_tipoContrato, $Descripcion);
            
            $respuesta = array(
              'respuesta' => 'Exitoso',
              'mensage' => 'Se guardo correctamente'
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
    
}