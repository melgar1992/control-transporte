<?php
class Proveedor extends BaseController
{
    function __construct()
    {
        parent::__construct();
    }
    public function inicio()
    {
        $datos['proveedores'] = $this->Proveedor_model->obtenerProveedores();
        $this->loadView('Proveedor', '/form/proveedor/nuevo_proveedor', $datos);
    }
    public function ingresar_proveedor()
    {


        $this->form_validation->set_rules('CI', 'CI', 'trim|xss_clean');
        $this->form_validation->set_rules('nombres', 'Nombres', 'trim|xss_clean');
        $this->form_validation->set_rules('Apellidos', 'Apellido Paterno', 'trim|xss_clean');
        $this->form_validation->set_rules('direccion', 'Direccion', 'trim|xss_clean');
        $this->form_validation->set_rules('departamento', 'Nombres', 'trim|xss_clean');
        $this->form_validation->set_rules('telefono_01', 'Telefono 01', 'trim|xss_clean');
        $this->form_validation->set_rules('telefono_02', 'Telefono 02', 'trim|xss_clean');
        $this->form_validation->set_rules('calificacion', 'Calificacion', 'trim|xss_clean');
        $this->form_validation->set_rules('descripcion', 'Descripcion', 'trim|xss_clean');
        try {
            if ($this->form_validation->run() === false) {
                $error = form_error('nombres');
                $respuesta = array(
                    'respuesta' => 'Error',
                    'message' => $error
                );
            } else {
                $ci = $this->input->post('CI');
                $nombres = $this->input->post('nombres');
                $Apellidos = $this->input->post('Apellidos');
                $direccion = $this->input->post('direccion');
                $departamento = $this->input->post('departamento');
                $telefono01 = $this->input->post('telefono_01');
                $telefono02 = $this->input->post('telefono_02');
                $calificacion = $this->input->post('calificacion');
                $descripcion = $this->input->post('descripcion');

                if ($this->Proveedor_model->BuscarCI($ci) == false) {
                    $id_proveedor = $this->Proveedor_model->insertar($ci, $nombres, $Apellidos, $direccion, $departamento, $telefono01, $telefono02, $calificacion, $descripcion);

                    $respuesta = array(
                        'respuesta' => 'Exitoso',
                        'datos' => array(
                            'ID_proveedor' => $id_proveedor,
                            'CI' => $ci,
                            'Nombres' => $nombres,
                            'Apellidos' => $Apellidos,
                            'Calificacion' => $calificacion,
                            'Descripcion' => $descripcion,
                            'Direccion' => $direccion,
                            'Departamento' => $departamento,
                            'Telefono_01' => $telefono01,
                            'Telefono_02' => $telefono02,
                        ),
                        'message' => 'Se guardo correctamente'
                    );
                } else {
                    $respuesta = array(
                        'respuesta' => 'Error',
                        'message' => 'Carnet de identidad duplicado'
                    );
                }
            }
        } catch (\Throwable $th) {
            $respuesta = array(
                'respuesta' => 'Error',
                'message' => $th
            );
        }

        echo json_encode($respuesta);
    }
    public function editarProveedor()
    {
        $this->form_validation->set_rules('CI', 'CI', 'trim|xss_clean');
        $this->form_validation->set_rules('nombres', 'Nombres', 'trim|xss_clean');
        $this->form_validation->set_rules('Apellidos', 'Apellido Paterno', 'trim|xss_clean');
        $this->form_validation->set_rules('direccion', 'Direccion', 'trim|xss_clean');
        $this->form_validation->set_rules('departamento', 'Nombres', 'trim|xss_clean');
        $this->form_validation->set_rules('telefono_01', 'Telefono 01', 'trim|xss_clean');
        $this->form_validation->set_rules('telefono_02', 'Telefono 02', 'trim|xss_clean');
        $this->form_validation->set_rules('calificacion', 'Calificacion', 'trim|xss_clean');
        $this->form_validation->set_rules('descripcion', 'Descripcion', 'trim|xss_clean');
        try {
            if ($this->form_validation->run() === false) {
                $error = form_error('nombres');
                $respuesta = array(
                    'respuesta' => 'Error',
                    'message' => $error
                );
            } else {
                $ID_proveedor = $this->input->post('ID_proveedor');
                $ci = $this->input->post('CI');
                $nombres = $this->input->post('nombres');
                $Apellidos = $this->input->post('Apellidos');
                $direccion = $this->input->post('direccion');
                $departamento = $this->input->post('departamento');
                $telefono01 = $this->input->post('telefono_01');
                $telefono02 = $this->input->post('telefono_02');
                $calificacion = $this->input->post('calificacion');
                $descripcion = $this->input->post('descripcion');
                $proveedor_actual = $this->Proveedor_model->obtenerProveedor($ID_proveedor);
                if ($proveedor_actual['CI'] == $ci) {
                    $this->Proveedor_model->editar($ID_proveedor, $ci, $nombres, $Apellidos, $direccion, $departamento, $telefono01, $telefono02, $calificacion, $descripcion);

                    $respuesta = array(
                        'respuesta' => 'Exitoso',
                        'datos' => array(
                            'ID_proveedor' => $ID_proveedor,
                            'CI' => $ci,
                            'Nombres' => $nombres,
                            'Apellidos' => $Apellidos,
                            'Calificacion' => $calificacion,
                            'Descripcion' => $descripcion,
                            'Direccion' => $direccion,
                            'Departamento' => $departamento,
                            'Telefono_01' => $telefono01,
                            'Telefono_02' => $telefono02,
                        ),
                        'message' => 'Se edito correctamente'
                    );
                } else {
                    if ($this->Proveedor_model->BuscarCI($ci) == false) {
                        $this->Proveedor_model->editar($ID_proveedor, $ci, $nombres, $Apellidos, $direccion, $departamento, $telefono01, $telefono02, $calificacion, $descripcion);

                        $respuesta = array(
                            'respuesta' => 'Exitoso',
                            'datos' => array(
                                'ID_proveedor' => $ID_proveedor,
                                'CI' => $ci,
                                'Nombres' => $nombres,
                                'Apellidos' => $Apellidos,
                                'Calificacion' => $calificacion,
                                'Descripcion' => $descripcion,
                                'Direccion' => $direccion,
                                'Departamento' => $departamento,
                                'Telefono_01' => $telefono01,
                                'Telefono_02' => $telefono02,
                            ),
                            'message' => 'Se edito correctamente'
                        );
                    } else {
                        $respuesta = array(
                            'respuesta' => 'Error',
                            'message' => 'Carnet de identidad duplicado'
                        );
                    }
                }
            }
        } catch (\Throwable $th) {
            $respuesta = array(
                'respuesta' => 'Error',
                'message' => $th
            );
        }

        echo json_encode($respuesta);
    }
    public function eliminarProveedor($ID_proveedor)
    {
        $this->Proveedor_model->eliminarProveedor($ID_proveedor);
        $respuesta = array(
            'tipo' => 'Exitoso',
            'respuesta' => 'Se elimino al empleado'
        );
        echo json_encode($respuesta);
        
    }
    public function obtenerProveedorAjax()
    {
        $ID_proveedor = $this->input->post('ID_proveedor');
        $respuesta = $this->Proveedor_model->obtenerProveedor($ID_proveedor);
        echo json_encode($respuesta);
    }
}
