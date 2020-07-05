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
                        'N_senasag' => $camion_ingresado['N_Senasag'],
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
            $this->form_validation->set_rules('Placa', 'Placa', 'trim|xss_clean' . $is_unique);
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
    public function eliminarCamionPropio($ID_camion)
    {

        $this->Camion_model->eliminarCamion($ID_camion);
        $respuesta = array(
            'respuesta' => 'Exitoso',
            'message' => 'Se elimino correctamente',
        );


        echo json_encode($respuesta);
    }

    // Comieza las funciones de camiones de proveedores
    public function camionesProveedor()
    {
        $datos['camionesProveedor'] = $this->Camion_model->obtenerCamionesProveedor();
        $datos['Proveedores'] = $this->Proveedor_model->obtenerProveedores();
        $this->loadView('CamionProveedor', '/form/camiones/nuevo_camionProveedor', $datos);
    }
    public function ingresarCamionProveedor()
    {
        $this->form_validation->set_rules('ID_proveedor', 'ID_proveedor', 'trim|xss_clean');
        $this->form_validation->set_rules('NombresChofer', 'NombresChofer', 'trim|xss_clean');
        $this->form_validation->set_rules('CI', 'CI', 'trim|xss_clean');
        $this->form_validation->set_rules('Telefono', 'Telefono', 'trim|xss_clean');
        $this->form_validation->set_rules('Placa', 'Placa', 'trim|xss_clean');
        $this->form_validation->set_rules('Marca', 'Marca', 'trim|xss_clean');
        $this->form_validation->set_rules('Color', 'Color', 'trim|xss_clean');
        $this->form_validation->set_rules('Capacidad', 'Capacidad', 'trim|xss_clean');
        $this->form_validation->set_rules('N_senasag', 'N_senasag', 'trim|xss_clean');

        try {
            if ($this->form_validation->run() === false) {
                $error = form_error('Placa');

                $respuesta = array(
                    'respuesta' => 'Error',
                    'message' => 'Ocurrio un problema al validar los datos' . $error,
                );
            } else {
                $ID_proveedor = $this->input->post('ID_proveedor');
                $NombresChofer = $this->input->post('NombresChofer');
                $CI = $this->input->post('CI');
                $Telefono = $this->input->post('Telefono');
                $Placa = $this->input->post('Placa');
                $Marca = $this->input->post('Marca');
                $Color = $this->input->post('Color');
                $Capacidad = $this->input->post('Capacidad');
                $N_senasag = $this->input->post('N_senasag');

                $ID_camion = $this->Camion_model->ingresarCamionProveedor($ID_proveedor, $NombresChofer, $CI, $Telefono, $Placa, $Marca, $Color, $Capacidad, $N_senasag);
                $camion_ingresado = $this->Camion_model->obtenerCamionProveedor($ID_camion);

                $respuesta = array(
                    'respuesta' => 'Exitoso',
                    'datos' => array(
                        'ID_camion' => $ID_camion,
                        'NombreProveedor' => $camion_ingresado['NombreProveedor'] . ' ' . $camion_ingresado['ApellidosProveedor'],
                        'NombresChofer' => $camion_ingresado['NombresChofer'],
                        'CI' => $camion_ingresado['CI'],
                        'Telefono' => $camion_ingresado['Telefono'],
                        'Placa' => $Placa,
                        'Color' => $Color,
                        'Marca' => $Marca,
                        'Capacidad' => $Capacidad,
                        'N_senasag' => $camion_ingresado['N_Senasag'],

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
    public function editarCamionProveedor()
    {
        $ID_camion = $this->input->post('ID_camion');
        $ID_proveedor = $this->input->post('ID_proveedor');
        $NombresChofer = $this->input->post('NombresChofer');
        $CI = $this->input->post('CI');
        $Telefono = $this->input->post('Telefono');
        $Placa = $this->input->post('Placa');
        $Marca = $this->input->post('Marca');
        $Color = $this->input->post('Color');
        $Capacidad = $this->input->post('Capacidad');
        $N_senasag = $this->input->post('N_senasag');


        $this->form_validation->set_rules('ID_camion', 'ID_camion', 'trim|xss_clean');
        $this->form_validation->set_rules('ID_proveedor', 'ID_proveedor', 'trim|xss_clean');
        $this->form_validation->set_rules('NombresChofer', 'NombresChofer', 'trim|xss_clean');
        $this->form_validation->set_rules('CI', 'CI', 'trim|xss_clean');
        $this->form_validation->set_rules('Telefono', 'Telefono', 'trim|xss_clean');
        $this->form_validation->set_rules('Placa', 'Placa', 'trim|xss_clean');
        $this->form_validation->set_rules('Marca', 'Marca', 'trim|xss_clean');
        $this->form_validation->set_rules('Color', 'Color', 'trim|xss_clean');
        $this->form_validation->set_rules('Capacidad', 'Capacidad', 'trim|xss_clean');
        $this->form_validation->set_rules('N_senasag', 'N_senasag', 'trim|xss_clean');

        try {
            if ($this->form_validation->run() === false) {
                $error = form_error('Placa');
                $respuesta = array(
                    'respuesta' => 'Error',
                    'message' => 'Ocurrio un problema al validar los datos' . $error,
                );
            } else {


                $this->Camion_model->editarCamionProveedor($ID_camion, $ID_proveedor, $NombresChofer, $CI, $Telefono, $Placa, $Marca, $Color, $Capacidad, $N_senasag);
                $camion_ingresado = $this->Camion_model->obtenerCamionProveedor($ID_camion);

                $respuesta = array(
                    'respuesta' => 'Exitoso',
                    'datos' => array(
                        'ID_camion' => $ID_camion,
                        'NombreProveedor' => $camion_ingresado['NombreProveedor'] . ' ' . $camion_ingresado['ApellidosProveedor'],
                        'NombresChofer' => $camion_ingresado['NombresChofer'],
                        'CI' => $camion_ingresado['CI'],
                        'Telefono' => $camion_ingresado['Telefono'],
                        'Placa' => $Placa,
                        'Color' => $Color,
                        'Marca' => $Marca,
                        'Capacidad' => $Capacidad,
                        'N_senasag' => $camion_ingresado['N_Senasag'],

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
    public function obtenerCamionProveedor()
    {
        $ID_camion = $this->input->post('ID_camion');
        $camion = $this->Camion_model->obtenerCamionProveedor($ID_camion);

        echo json_encode($camion);
    }
    public function eliminarCamionProveedor($ID_camion)
    {
        $this->Camion_model->eliminarCamion($ID_camion);
        $respuesta = array(
            'respuesta' => 'Exitoso',
            'message' => 'Se elimino correctamente',
        );


        echo json_encode($respuesta);
    }
}
