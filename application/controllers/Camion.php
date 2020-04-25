<?php
class Camion extends BaseController
{

    function __construct()
    {
        parent::__construct();
    }
    public function camionesPropios()
    {
        $datos['camionesPropios'] = $this->Camion_model->obtenerCamionesPropios();
        $datos['Contratos'] = $this->Contrato_model->obtenerContratosEmpleadosActivos();
        $this->loadView('CamionPropio', '/form/camiones/nuevo_camionPropio', $datos);
    }
    public function ingresarCamionPropio()
    {
        $this->form_validation->set_rules('ID_contrato', 'ID_contrato', 'trim|xss_clean');
        $this->form_validation->set_rules('Placa', 'Placa', 'trim|xss_clean|is_unique[camion.N_Placa]');
        $this->form_validation->set_rules('Modelo', 'Modelo', 'trim|xss_clean');
        $this->form_validation->set_rules('Marca', 'Marca', 'trim|xss_clean');
        $this->form_validation->set_rules('Color', 'Color', 'trim|xss_clean');
        $this->form_validation->set_rules('Capacidad', 'Capacidad', 'trim|xss_clean');
        $this->form_validation->set_rules('N_senasag', 'N_senasag', 'trim|xss_clean');
        $this->form_validation->set_rules('Kilometraje', 'Kilometraje', 'trim|xss_clean');
       try {
            if ($this->form_validation->run() === false) {

                $error = form_error('Placa');

                $respuesta = array(
                    'respuesta' => 'Error',
                    'message' => 'Ocurrio un problema al validar los datos' . $error,
                );
            } else {
                $ID_contrato = $this->input->post('ID_contrato');
                $Placa = $this->input->post('Placa');
                $Modelo = $this->input->post('Modelo');
                $Marca = $this->input->post('Marca');
                $Color = $this->input->post('Color');
                $Capacidad = $this->input->post('Capacidad');
                $N_senasag = $this->input->post('N_senasag');
                $Kilometraje = $this->input->post('Kilometraje');

                $ID_camion = $this->Camion_model->ingresarCamionPropio($ID_contrato, $Placa, $Modelo, $Marca, $Color, $Capacidad, $N_senasag, $Kilometraje);
                $camion_ingresado = $this->Camion_model->obtenerCamionPropio($ID_camion);

                $respuesta = array(
                    'respuesta' => 'Exitoso',
                    'datos' => array(
                        'Nombres' => $camion_ingresado['Nombres'],
                        'Apellidos' => $camion_ingresado['Apellido_p'] . ' ' . $camion_ingresado['Apellido_m'],
                        'CI' => $camion_ingresado['CI'],
                        'ID_camion' => $ID_camion,
                        'Placa' => $Placa,
                        'Modelo' => $Modelo,
                        'Color' => $Color,
                        'Capacidad' => $Capacidad,
                        'N_senasag' => $camion_ingresado['N_senasag'],
                        'Kilometraje' => $Kilometraje,

                    ),
                    'message' => 'Se guardo correctamente',
                );
            }
        } catch (\Throwable $th) {
            $respuesta = array(
                'tipo' => 'Error',
                'message' => $th,
            );
        }

        echo json_encode($respuesta);
    }
    public function editarCamionPropio()
    {
       
        try {
            $ID_camion = $this->input->post('ID_camion');
            $ID_contrato = $this->input->post('ID_contrato');
            $Placa = $this->input->post('Placa');
            $Modelo = $this->input->post('Modelo');
            $Marca = $this->input->post('Marca');
            $Color = $this->input->post('Color');
            $Capacidad = $this->input->post('Capacidad');
            $N_senasag = $this->input->post('N_senasag');
            $Kilometraje = $this->input->post('Kilometraje');

            $camion_actual = $this->Camion_model->obtenerCamionPropio($ID_camion);

            if ($Placa == $camion_actual['N_Placa']) {
                $is_unique = '';
            } else {
                $is_unique = '|is_unique[camion.N_Placa]';
            }
            $this->form_validation->set_rules('ID_contrato', 'ID_contrato', 'trim|xss_clean');
            $this->form_validation->set_rules('Placa', 'Placa', 'trim|xss_clean'. $is_unique);
            $this->form_validation->set_rules('Modelo', 'Modelo', 'trim|xss_clean');
            $this->form_validation->set_rules('Marca', 'Marca', 'trim|xss_clean');
            $this->form_validation->set_rules('Color', 'Color', 'trim|xss_clean');
            $this->form_validation->set_rules('Capacidad', 'Capacidad', 'trim|xss_clean');
            $this->form_validation->set_rules('N_senasag', 'N_senasag', 'trim|xss_clean');
            $this->form_validation->set_rules('Kilometraje', 'Kilometraje', 'trim|xss_clean');

            if ($this->form_validation->run() === false) {

                $error = form_error('Placa');

                $respuesta = array(
                    'respuesta' => 'Error',
                    'message' => 'Ocurrio un problema al validar los datos' . $error,
                );
            } else {
              
                $this->Camion_model->editarCamionPropio($ID_camion, $ID_contrato, $Placa, $Modelo, $Marca, $Color, $Capacidad, $N_senasag, $Kilometraje);
                $camion_editado = $this->Camion_model->obtenerCamionPropio($ID_camion);

                $respuesta = array(
                    'respuesta' => 'Exitoso',
                    'datos' => array(
                        'Nombres' => $camion_editado['Nombres'],
                        'Apellidos' => $camion_editado['Apellido_p'] . ' ' . $camion_editado['Apellido_m'],
                        'CI' => $camion_editado['CI'],
                        'ID_camion' => $ID_camion,
                        'Placa' => $Placa,
                        'Modelo' => $Modelo,
                        'Color' => $Color,
                        'Capacidad' => $Capacidad,
                        'N_senasag' => $camion_editado['N_Senasag'],
                        'Kilometraje' => $Kilometraje,

                    ),
                    'message' => 'Se edito correctamente',
                );
            }
        } catch (\Throwable $th) {
            $respuesta = array(
                'respuesta' => 'Error',
                'message' => $th,
            );
        }

        echo json_encode($respuesta);
    }
    public function obtenerCamionPropio()
    {
        $ID_camion = $this->input->post('ID_camion');
        $camion = $this->Camion_model->obtenerCamionPropio($ID_camion);

        echo json_encode($camion);
    }
}
