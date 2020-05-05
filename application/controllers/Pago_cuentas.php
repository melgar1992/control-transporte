
<?php
class Pago_cuentas extends BaseController
{
    function __construct()
    {
        parent::__construct();
    }

    public function pagoClientes()
    {
        $datos['pagos_clientes'] = $this->Pagos_cuentas_model->obtenerPagosClientes();
        $datos['Clientes'] = $this->Cliente_model->obtenerClientes();
        $this->loadView('PagoCliente', '/form/pagos/pago_cliente', $datos);
    }
    public function ingresarPagoCliente()
    {
        $this->form_validation->set_rules('ID_Cliente', 'ID_Cliente', 'trim|xss_clean|required');
        $this->form_validation->set_rules('Fecha', 'Fecha', 'trim|xss_clean|required');
        $this->form_validation->set_rules('Descripcion', 'Descripcion', 'trim|xss_clean');
        $this->form_validation->set_rules('Debe', 'Debe', 'trim|xss_clean');
        $this->form_validation->set_rules('Haber', 'Haber', 'trim|xss_clean');

        try {
            if ($this->form_validation->run() === false) {

                $respuesta = array(
                    'respuesta' => 'Error',
                    'message' => 'Ocurrio un problema al validar los datos',
                );
            } else {

                $ID_Cliente = $this->input->post('ID_Cliente');
                $Fecha = $this->input->post('Fecha');
                $Descripcion = $this->input->post('Descripcion');
                $Debe = $this->input->post('Debe');
                $Haber = $this->input->post('Haber');


                $ID_pago_cuentas = $this->Pagos_cuentas_model->ingresarPagoCliente($ID_Cliente, $Fecha, $Descripcion, $Debe, $Haber);
                $Pago_ingresado = $this->Pagos_cuentas_model->obtenerPagoCliente($ID_pago_cuentas);

                $respuesta = array(
                    'respuesta' => 'Exitoso',
                    'datos' => array(
                        'ID_pago_cuentas' => $ID_pago_cuentas,
                        'Fecha' => $Pago_ingresado['fecha'],
                        'Nombre' => $Pago_ingresado['Nombre'] . ' ' . $Pago_ingresado['Apellidos'],
                        'CI' => $Pago_ingresado['CI'],
                        'Telefono_01' => $Pago_ingresado['Telefono_01'],
                        'Descripcion' => $Pago_ingresado['Descripcion'],
                        'Debe' => $Pago_ingresado['Debe'],
                        'Haber' => $Pago_ingresado['Haber'],
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
    public function obtenerPagoCliente()
    {
        $ID_pago_cuentas = $this->input->post('ID_pago_cuentas');
        $Pago_Cliente = $this->Pagos_cuentas_model->obtenerPagoCliente($ID_pago_cuentas);
        echo json_encode($Pago_Cliente);
    }
    public function editarPagoCliente()
    {
        $this->form_validation->set_rules('ID_pago_cuentas', 'ID_pago_cuentas', 'trim|xss_clean|required');
        $this->form_validation->set_rules('ID_Cliente', 'ID_Cliente', 'trim|xss_clean|required');
        $this->form_validation->set_rules('Fecha', 'Fecha', 'trim|xss_clean|required');
        $this->form_validation->set_rules('Descripcion', 'Descripcion', 'trim|xss_clean');
        $this->form_validation->set_rules('Debe', 'Debe', 'trim|xss_clean');
        $this->form_validation->set_rules('Haber', 'Haber', 'trim|xss_clean');

        try {
            if ($this->form_validation->run() === false) {

                $respuesta = array(
                    'respuesta' => 'Error',
                    'message' => 'Ocurrio un problema al validar los datos',
                );
            } else {

                $ID_pago_cuentas = $this->input->post('ID_pago_cuentas');
                $ID_Cliente = $this->input->post('ID_Cliente');
                $Fecha = $this->input->post('Fecha');
                $Descripcion = $this->input->post('Descripcion');
                $Debe = $this->input->post('Debe');
                $Haber = $this->input->post('Haber');


                $this->Pagos_cuentas_model->editarPagoCliente($ID_pago_cuentas, $ID_Cliente, $Fecha, $Descripcion, $Debe, $Haber);
                $Pago_editado = $this->Pagos_cuentas_model->obtenerPagoCliente($ID_pago_cuentas);

                $respuesta = array(
                    'respuesta' => 'Exitoso',
                    'datos' => array(
                        'ID_pago_cuentas' => $ID_pago_cuentas,
                        'Fecha' => $Pago_editado['fecha'],
                        'Nombre' => $Pago_editado['Nombre'] . ' ' . $Pago_editado['Apellidos'],
                        'CI' => $Pago_editado['CI'],
                        'Telefono_01' => $Pago_editado['Telefono_01'],
                        'Descripcion' => $Pago_editado['Descripcion'],
                        'Debe' => $Pago_editado['Debe'],
                        'Haber' => $Pago_editado['Haber'],
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
    public function eliminarPago($ID_pago_cuentas)
    {
        $this->Pagos_cuentas_model->eliminarPago($ID_pago_cuentas);
        $respuesta = array(
            'tipo' => 'Exitoso',
            'message' => 'Se elimino',
        );
        echo json_encode($respuesta);
    }


    //Las funciones de cuentas de Talleres y Ferreterias
    public function pagoTalleres()
    {
        $datos['pagos_talleres'] = $this->Pagos_cuentas_model->obtenerPagostalleres();
        $datos['talleres'] = $this->Taller_model->getTalleres();
        $this->loadView('PagoTaller', '/form/pagos/pago_talleres', $datos);
    }
    public function ingresarPagoTaller()
    {
        $this->form_validation->set_rules('ID_taller', 'ID_taller', 'trim|xss_clean|required');
        $this->form_validation->set_rules('Fecha', 'Fecha', 'trim|xss_clean|required');
        $this->form_validation->set_rules('Descripcion', 'Descripcion', 'trim|xss_clean');
        $this->form_validation->set_rules('Debe', 'Debe', 'trim|xss_clean');
        $this->form_validation->set_rules('Haber', 'Haber', 'trim|xss_clean');

        try {
            if ($this->form_validation->run() === false) {

                $respuesta = array(
                    'respuesta' => 'Error',
                    'message' => 'Ocurrio un problema al validar los datos',
                );
            } else {

                $ID_taller = $this->input->post('ID_taller');
                $Fecha = $this->input->post('Fecha');
                $Descripcion = $this->input->post('Descripcion');
                $Debe = $this->input->post('Debe');
                $Haber = $this->input->post('Haber');


                $ID_pago_cuentas = $this->Pagos_cuentas_model->ingresarPagoTaller($ID_taller, $Fecha, $Descripcion, $Debe, $Haber);
                $Pago_ingresado = $this->Pagos_cuentas_model->obtenerPagoTaller($ID_pago_cuentas);

                $respuesta = array(
                    'respuesta' => 'Exitoso',
                    'datos' => array(
                        'ID_pago_cuentas' => $ID_pago_cuentas,
                        'Fecha' => $Pago_ingresado['fecha'],
                        'NombreTaller' => $Pago_ingresado['NombreTaller'],
                        'Departamento' => $Pago_ingresado['Departamento'],
                        'Direccion' => $Pago_ingresado['Direccion'],
                        'Descripcion' => $Pago_ingresado['Descripcion'],
                        'Debe' => $Pago_ingresado['Debe'],
                        'Haber' => $Pago_ingresado['Haber'],
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
    public function obtenerPagoTaller()
    {
        $ID_pago_cuentas = $this->input->post('ID_pago_cuentas');
        $Pago_Cliente = $this->Pagos_cuentas_model->obtenerPagoTaller($ID_pago_cuentas);
        echo json_encode($Pago_Cliente);
    }
    public function editarPagoTaller()
    {
        $this->form_validation->set_rules('ID_pago_cuentas', 'ID_pago_cuentas', 'trim|xss_clean|required');
        $this->form_validation->set_rules('ID_taller', 'ID_taller', 'trim|xss_clean|required');
        $this->form_validation->set_rules('Fecha', 'Fecha', 'trim|xss_clean|required');
        $this->form_validation->set_rules('Descripcion', 'Descripcion', 'trim|xss_clean');
        $this->form_validation->set_rules('Debe', 'Debe', 'trim|xss_clean');
        $this->form_validation->set_rules('Haber', 'Haber', 'trim|xss_clean');

        try {
            if ($this->form_validation->run() === false) {

                $respuesta = array(
                    'respuesta' => 'Error',
                    'message' => 'Ocurrio un problema al validar los datos',
                );
            } else {

                $ID_pago_cuentas = $this->input->post('ID_pago_cuentas');
                $ID_taller = $this->input->post('ID_taller');
                $Fecha = $this->input->post('Fecha');
                $Descripcion = $this->input->post('Descripcion');
                $Debe = $this->input->post('Debe');
                $Haber = $this->input->post('Haber');


                $this->Pagos_cuentas_model->editarPagoCliente($ID_pago_cuentas, $ID_taller, $Fecha, $Descripcion, $Debe, $Haber);
                $Pago_editado = $this->Pagos_cuentas_model->obtenerPagoTaller($ID_pago_cuentas);

                $respuesta = array(
                    'respuesta' => 'Exitoso',
                    'datos' => array(
                        'ID_pago_cuentas' => $ID_pago_cuentas,
                        'Fecha' => $Pago_editado['fecha'],
                        'NombreTaller' => $Pago_editado['NombreTaller'],
                        'Departamento' => $Pago_editado['Departamento'],
                        'Direccion' => $Pago_editado['Direccion'],
                        'Descripcion' => $Pago_editado['Descripcion'],
                        'Debe' => $Pago_editado['Debe'],
                        'Haber' => $Pago_editado['Haber'],
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
