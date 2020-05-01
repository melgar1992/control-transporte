<?php
class Predio extends BaseController
{
    function __construct()
    {
        parent::__construct();
    }

    public function predio()
    {
        $datos['predios'] = $this->Predio_model->obtenerPredios();
        $this->loadView('Predio', '/form/cliente/nuevo_predio', $datos);
    }
    public function ingresarPredio()
    {
        $this->form_validation->set_rules('NombrePredio', 'NombrePredio', 'trim|xss_clean');
        $this->form_validation->set_rules('Departamento', 'Departamento', 'trim|xss_clean');
        $this->form_validation->set_rules('Direccion', 'Direccion', 'trim|xss_clean');
        $this->form_validation->set_rules('TipoPredio', 'TipoPredio', 'trim|xss_clean');

        try {
            if ($this->form_validation->run() === false) {
                $respuesta = array(
                    'respuesta' => 'Error',
                    'message' => 'Ocurrio un problema al validar los datos',
                );
            } else {

                $NombrePredio = $this->input->post('NombrePredio');
                $Departamento = $this->input->post('Departamento');
                $Provincia = $this->input->post('Provincia');
                $Municipio = $this->input->post('Municipio');
                $NombrePropietario = $this->input->post('NombrePropietario');
                $ApellidoPropietario = $this->input->post('ApellidoPropietario');
                $TipoPredio = $this->input->post('TipoPredio');
                $Direccion = $this->input->post('Direccion');

                $ID_predio = $this->Predio_model->ingresarPredio($NombrePredio, $Departamento, $Provincia, $Municipio, $NombrePropietario, $ApellidoPropietario, $TipoPredio, $Direccion);
                $Predio_ingresado = $this->Predio_model->obtenerPredio($ID_predio);

                $respuesta = array(
                    'respuesta' => 'Exitoso',
                    'datos' => array(
                        'ID_predio' => $ID_predio,
                        'NombrePredio' => $Predio_ingresado['NombrePredio'],
                        'Provincia' => $Predio_ingresado['Provincia'],
                        'Municipio' => $Predio_ingresado['Municipio'],
                        'NombrePropietario' => $Predio_ingresado['NombrePropietario'],
                        'ApellidoPropietario' => $Predio_ingresado['ApellidoPropietario'],
                        'TipoPredio' => $Predio_ingresado['TipoPredio'],
                        'Direccion' => $Predio_ingresado['Direccion'],
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
}
