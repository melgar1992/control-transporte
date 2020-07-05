<?php
class Cliente extends BaseController
{

    function __construct()
    {
        parent::__construct();
    }

    public function clientes()
    {
        $datos['clientes'] = $this->Cliente_model->obtenerClientes();
        $this->loadView('Cliente', '/form/cliente/nuevo_cliente', $datos);
    }
    public function ingresarCliente()
    {
        $this->form_validation->set_rules('Nombre', 'Nombre', 'trim|xss_clean');
        $this->form_validation->set_rules('CI', 'CI', 'trim|xss_clean|is_unique[cliente.CI]');
        $this->form_validation->set_rules('Apellidos', 'Apellidos', 'trim|xss_clean');
        $this->form_validation->set_rules('Direccion', 'Direccion', 'trim|xss_clean');
        $this->form_validation->set_rules('Telefono_01', 'Telefono_01', 'trim|xss_clean');
        $this->form_validation->set_rules('Telefono_02', 'Telefono_02', 'trim|xss_clean');

        try {
            if ($this->form_validation->run() === false) {

                $error = form_error('CI');

                $respuesta = array(
                    'respuesta' => 'Error',
                    'message' => 'Ocurrio un problema al validar los datos' . $error,
                );
            } else {

                $Nombre = $this->input->post('Nombre');
                $CI = $this->input->post('CI');
                $Apellidos = $this->input->post('Apellidos');
                $Direccion = $this->input->post('Direccion');
                $Telefono_01 = $this->input->post('Telefono_01');
                $Telefono_02 = $this->input->post('Telefono_02');


                $ID_cliente = $this->Cliente_model->ingresarCliente($Nombre, $CI, $Apellidos, $Direccion, $Telefono_01, $Telefono_02);
                $cliente_ingresado = $this->Cliente_model->obtenerCliente($ID_cliente);

                $respuesta = array(
                    'respuesta' => 'Exitoso',
                    'datos' => array(
                        'Nombres' => $cliente_ingresado['Nombre'],
                        'Apellidos' => $cliente_ingresado['Apellidos'],
                        'CI' => $cliente_ingresado['CI'],
                        'ID_cliente' => $ID_cliente,
                        'Direccion' => $cliente_ingresado['Direccion'],
                        'Telefono_01' => $cliente_ingresado['Telefono_01'],
                        'Telefono_02' => $cliente_ingresado['Telefono_02'],
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
    public function obtenerCliente()
    {
        $ID_cliente = $this->input->post('ID_cliente');
        $cliente = $this->Cliente_model->obtenerCliente($ID_cliente);
        echo json_encode($cliente);
    }
    public function editarCliente()
    {
        $ID_cliente = $this->input->post('ID_cliente');
        $CI = $this->input->post('CI');
        $cliente_actual = $this->Cliente_model->obtenerCliente($ID_cliente);
        if ($CI == $cliente_actual['CI']) {
            $is_unique = '';
        } else {
            $is_unique = '|is_unique[cliente.CI]';
        }
        $this->form_validation->set_rules('Nombre', 'Nombre', 'trim|xss_clean');
        $this->form_validation->set_rules('CI', 'CI', 'trim|xss_clean' . $is_unique);
        $this->form_validation->set_rules('Apellidos', 'Apellidos', 'trim|xss_clean');
        $this->form_validation->set_rules('Direccion', 'Direccion', 'trim|xss_clean');
        $this->form_validation->set_rules('Telefono_01', 'Telefono_01', 'trim|xss_clean');
        $this->form_validation->set_rules('Telefono_02', 'Telefono_02', 'trim|xss_clean');


        try {
            if ($this->form_validation->run() === false) {

                $error = form_error('CI');

                $respuesta = array(
                    'respuesta' => 'Error',
                    'message' => 'Ocurrio un problema al validar los datos' . $error,
                );
            } else {

                $Nombre = $this->input->post('Nombre');
                $Apellidos = $this->input->post('Apellidos');
                $Direccion = $this->input->post('Direccion');
                $Telefono_01 = $this->input->post('Telefono_01');
                $Telefono_02 = $this->input->post('Telefono_02');


                $this->Cliente_model->editarCliente($ID_cliente, $Nombre, $CI, $Apellidos, $Direccion, $Telefono_01, $Telefono_02);
                $cliente_ingresado = $this->Cliente_model->obtenerCliente($ID_cliente);

                $respuesta = array(
                    'respuesta' => 'Exitoso',
                    'datos' => array(
                        'Nombres' => $cliente_ingresado['Nombre'],
                        'Apellidos' => $cliente_ingresado['Apellidos'],
                        'CI' => $cliente_ingresado['CI'],
                        'ID_cliente' => $ID_cliente,
                        'Direccion' => $cliente_ingresado['Direccion'],
                        'Telefono_01' => $cliente_ingresado['Telefono_01'],
                        'Telefono_02' => $cliente_ingresado['Telefono_02'],
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
    public function eliminarCliente($ID_cliente)
    {
        $this->Cliente_model->eliminarCliente($ID_cliente);
        $respuesta = array(
            'tipo' => 'Exitoso',
            'message' => 'Se elimino',
        );
        echo json_encode($respuesta);

    }
}
