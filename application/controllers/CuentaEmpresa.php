<?php
class CuentaEmpresa extends BaseController
{
    function __construct()
    {
        parent::__construct();
    }
    public function cuentaEmpresa()
    {
        $datos['tipo_cuenta'] = $this->Cuenta_empresa_model->obtenerTiposCuentas();
        $datos['cuenta_empresa'] = $this->Cuenta_empresa_model->obtenerCuentasEmpresa();
        $this->loadView('CuentaEmpresa', '/form/cuentaEmpresa/nueva_cuenta', $datos);
    }
    public function obtenerCuentaEmpresa()
    {
        $ID_cuenta_empresa = $this->input->post('ID_cuenta_empresa');
        $cuenta_empresa = $this->Cuenta_empresa_model->obtenerCuentaEmpresa($ID_cuenta_empresa);
        echo json_encode($cuenta_empresa);
    }
    public function ingresarCuentaEmpresa()
    {
        $this->form_validation->set_rules('ID_tipo_cuenta', 'ID_tipo_cuenta', 'trim|xss_clean');
        $this->form_validation->set_rules('Nombre_cuenta', 'Nombre_cuenta', 'trim|xss_clean');
        $this->form_validation->set_rules('Descripcion', 'Descripcion', 'trim|xss_clean');

        try {
            if ($this->form_validation->run() === false) {
                $error = form_error('Nombre_cuenta');
                $respuesta = array(
                    'respuesta' => 'Error',
                    'message' => 'No se ingresaron todos los campos correctamente' . $error,
                );
            } else {
                $ID_tipo_cuenta = $this->input->post('ID_tipo_cuenta');
                $Nombre_cuenta = $this->input->post('Nombre_cuenta');
                $Descripcion = $this->input->post('Descripcion');

                $ID_cuenta_empresa = $this->Cuenta_empresa_model->ingresarCuentaEmpresa($ID_tipo_cuenta, $Nombre_cuenta, $Descripcion);
                $cuenta_ingresada = $this->Cuenta_empresa_model->obtenerCuentaEmpresa($ID_cuenta_empresa);
                $respuesta = array(
                    'respuesta' => 'Exitoso',
                    'datos' => array(
                        'ID_cuenta_empresa' => $cuenta_ingresada['ID_cuenta_empresa'],
                        'nombre' => $cuenta_ingresada['nombre'],
                        'Nombre_cuenta' => $cuenta_ingresada['Nombre_cuenta'],
                        'balance' => $cuenta_ingresada['balance'],
                        'Descripcion' => $cuenta_ingresada['Descripcion'],

                    ),
                    'message' => 'Se guardo correctamente',
                );
            }
        } catch (\Throwable $th) {
            $respuesta = array(
                'respuesta' => 'Error',
                'message' => $th
            );
        }
        echo json_encode($respuesta);
    }
    public function editarCuentaEmpresa()
    {
        $this->form_validation->set_rules('ID_tipo_cuenta', 'ID_tipo_cuenta', 'trim|xss_clean');
        $this->form_validation->set_rules('Nombre_cuenta', 'Nombre_cuenta', 'trim|xss_clean');
        $this->form_validation->set_rules('Descripcion', 'Descripcion', 'trim|xss_clean');

        try {
            if ($this->form_validation->run() === false) {

                $respuesta = array(
                    'respuesta' => 'Error',
                    'message' => 'No se ingresaron todos los campos correctamente',
                );
            } else {
                $ID_cuenta_empresa = $this->input->post('ID_cuenta_empresa');
                $ID_tipo_cuenta = $this->input->post('ID_tipo_cuenta');
                $Nombre_cuenta = $this->input->post('Nombre_cuenta');
                $Descripcion = $this->input->post('Descripcion');

                $this->Cuenta_empresa_model->editarCuentaEmpresa($ID_cuenta_empresa, $ID_tipo_cuenta, $Nombre_cuenta, $Descripcion);
                $cuenta_editada = $this->Cuenta_empresa_model->obtenerCuentaEmpresa($ID_cuenta_empresa);
                $respuesta = array(
                    'respuesta' => 'Exitoso',
                    'datos' => array(
                        'ID_cuenta_empresa' => $cuenta_editada['ID_cuenta_empresa'],
                        'nombre' => $cuenta_editada['nombre'],
                        'Nombre_cuenta' => $cuenta_editada['Nombre_cuenta'],
                        'balance' => $cuenta_editada['balance'],
                        'Descripcion' => $cuenta_editada['Descripcion'],

                    ),
                    'message' => 'Se edito correctamente',
                );
            }
        } catch (\Throwable $th) {
            $respuesta = array(
                'respuesta' => 'Error',
                'message' => $th
            );
        }
        echo json_encode($respuesta);
    }
    public function eliminarCuentaEmpresa($ID_cuenta_empresa)
    {
        $this->Cuenta_empresa_model->eliminarCuentaEmpresa($ID_cuenta_empresa);
        $respuesta = array(
            'tipo' => 'Exitoso',
            'message' => 'Se elimino',
        );
        echo json_encode($respuesta);
    }
}
