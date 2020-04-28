<?php
class Taller extends BaseController
{

    function __construct()
    {
        parent::__construct();
    }
    public function talleres()
    {
        $datos['Talleres'] = $this->Taller_model->getTalleres();
        $this->loadView('Taller', '/form/mantenimiento/nuevo_taller', $datos);
    }
    public function ingresarTaller()
    {
        $this->form_validation->set_rules('NombreTaller', 'NombreTaller', 'trim|xss_clean');
        $this->form_validation->set_rules('Departamento', 'Departamento', 'trim|xss_clean');
        $this->form_validation->set_rules('Direccion', 'Direccion', 'trim|xss_clean');

        try {
            if ($this->form_validation->run() === false) {

                $error = form_error('CI');

                $respuesta = array(
                    'respuesta' => 'Error',
                    'message' => 'Ocurrio un problema al validar los datos' . $error,
                );
            } else {

                $NombreTaller = $this->input->post('NombreTaller');
                $Departamento = $this->input->post('Departamento');
                $Direccion = $this->input->post('Direccion');


                $ID_taller = $this->Taller_model->ingresarTaller($NombreTaller, $Departamento, $Direccion);
                $taller_ingresado = $this->Taller_model->obtenerTaller($ID_taller);

                $respuesta = array(
                    'respuesta' => 'Exitoso',
                    'datos' => array(
                        'ID_taller' => $ID_taller,
                        'NombreTaller' => $taller_ingresado['NombreTaller'],
                        'Departamento' => $taller_ingresado['Departamento'],
                        'Direccion' => $taller_ingresado['Direccion'],
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
    public function obtenerTaller()
    {
        $ID_taller = $this->input->post('ID_taller');
        $taller = $this->Taller_model->obtenerTaller($ID_taller);
        echo json_encode($taller);
    }
    public function editarTaller()
    {


        $this->form_validation->set_rules('NombreTaller', 'NombreTaller', 'trim|xss_clean');
        $this->form_validation->set_rules('Departamento', 'Departamento', 'trim|xss_clean');
        $this->form_validation->set_rules('Direccion', 'Direccion', 'trim|xss_clean');


        try {
            if ($this->form_validation->run() === false) {

                $respuesta = array(
                    'respuesta' => 'Error',
                    'message' => 'Ocurrio un problema al validar los datos',
                );
            } else {
                $ID_taller = $this->input->post('ID_taller');
                $NombreTaller = $this->input->post('NombreTaller');
                $Departamento = $this->input->post('Departamento');
                $Direccion = $this->input->post('Direccion');


                $this->Taller_model->editarTaller($ID_taller, $NombreTaller, $Departamento, $Direccion);
                $taller_editado = $this->Taller_model->obtenerTaller($ID_taller);

                $respuesta = array(
                    'respuesta' => 'Exitoso',
                    'datos' => array(
                        'ID_taller' => $ID_taller,
                        'NombreTaller' => $taller_editado['NombreTaller'],
                        'Departamento' => $taller_editado['Departamento'],
                        'Direccion' => $taller_editado['Direccion'],
                    ),
                    'message' => 'Se edito correctamente',
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
    public function eliminarTaller($ID_taller)
    {
        $this->Taller_model->eliminarTaller($ID_taller);
        $respuesta = array(
            'tipo' => 'Exitoso',
            'message' => 'Se elimino',
        );
        echo json_encode($respuesta);
    }
}
