<?php
class Empleado extends BaseController
{

    function __construct()
    {
        parent::__construct();
    }

    public function index()
    {

        $empleados['datos'] = $this->Empleado_model->obtenerEmpleado();
        $this->loadView('Empleado', '/form/empleado/nuevo_empleado', $empleados);
    }
    public function ingresar_empleado()
    {

        //die(json_encode($_POST));        
        $this->form_validation->set_rules('CI', 'CI', 'trim|xss_clean');
        $this->form_validation->set_rules('nombres', 'Nombres', 'trim|xss_clean');
        $this->form_validation->set_rules('apellido_paterno', 'Apellido Paterno', 'trim|xss_clean');
        $this->form_validation->set_rules('apellido_materno', 'Apellido Materno', 'trim|xss_clean');
        $this->form_validation->set_rules('direccion', 'Direccion', 'trim|xss_clean');
        $this->form_validation->set_rules('departamento', 'Nombres', 'trim|xss_clean');
        $this->form_validation->set_rules('telefono_01', 'Telefono 01', 'trim|xss_clean');
        $this->form_validation->set_rules('telefono_02', 'Telefono 02', 'trim|xss_clean');
        $this->form_validation->set_rules('calificacion', 'Calificacion', 'trim|xss_clean');
        $this->form_validation->set_rules('descripcion', 'Descripcion', 'trim|xss_clean');
        $this->form_validation->set_rules('tipo_licencia', 'Tipo de Licencia', 'trim|xss_clean');
        $this->form_validation->set_rules('fecha_vencimiento_l', 'Fecha de vencimiento Licencia', 'trim|xss_clean');

        if ($this->form_validation->run() === false) {

            $error = form_error('nombres');

            $respuesta = array(
                'tipo' => 'Formulario',
                'respuesta' => $error
            );
        } else {
            $ci = $this->input->post('CI');
            $nombres = $this->input->post('nombres');
            $apellidop = $this->input->post('apellido_paterno');
            $apellidom = $this->input->post('apellido_materno');
            $fechan = $this->input->post('fecha_nacimiento');
            $direccion = $this->input->post('direccion');
            $departamento = $this->input->post('departamento');
            $telefono01 = $this->input->post('telefono_01');
            $telefono02 = $this->input->post('telefono_02');
            $calificacion = $this->input->post('calificacion');
            $descripcion = $this->input->post('descripcion');
            $tlicencia = $this->input->post('tipo_licencia');
            $fechavl = $this->input->post('fecha_vencimiento_l');


            if ($this->Persona_model->id_persona($ci) == false) {
                $this->Persona_model->insertar($ci, $nombres, $apellidop, $apellidom, $fechan, $direccion, $departamento, $telefono01, $telefono02);
                $id_persona = $this->Persona_model->id_persona($ci);
                $id_empleado = $this->Empleado_model->insertar($id_persona, $calificacion, $descripcion, $tlicencia, $fechavl);

                $respuesta = array(
                    'respuesta' => 'Exitoso',
                    'datos' => array(
                        'id_persona' => $id_persona,
                        'id_empleado' => $id_empleado,
                        'ci' => $ci,
                        'nombres' => $nombres,
                        'apellidop' => $apellidop,
                        'apellidom' => $apellidom,
                        'fechan' => $fechan,
                        'telefono01' => $telefono01,
                        'departamento' => $departamento,
                        'tlicencia' => $tlicencia,

                    )
                );
            } else {
                $respuesta = array(
                    'tipo' => 'Duplicado',
                    'respuesta' => 'Duplicada'
                );
            }
        }
        echo json_encode($respuesta);
    }

    public function obtenerEmpleado()
    {
        $obtenerEmpleado = $this->Empleado_model->obtenerEmpleado();
        return $obtenerEmpleado;
    }
    public function obtenerEmpleadoAjax()
    {
        $id_empleado = $this->input->post('id_empleado');
        $obtenerEmpleado = $this->Empleado_model->idempleado($id_empleado);
        $respuesta = (array) $obtenerEmpleado;
        echo json_encode($respuesta);
    }

    public function eliminarEmpleado($id_empleado)
    {

        $this->Empleado_model->eliminarEmpleado($id_empleado);
        $respuesta = array(
            'tipo' => 'Exitoso',
            'respuesta' => 'Se elimino al empleado'
        );


        echo json_encode($respuesta);
    }
    public function editarEmpleado()
    {

        $id_empleado = $this->input->post('id');
        $empleado = $this->Empleado_model->idempleado($id_empleado);

        try {
            //code...
            $this->form_validation->set_rules('id', 'Id del empleado', 'trim|required|xss_clean');
            $this->form_validation->set_rules('CI', 'CI', 'trim|xss_clean');
            $this->form_validation->set_rules('apellido-paterno', 'Apellido Paterno', 'trim|xss_clean');
            $this->form_validation->set_rules('apellido_materno', 'Apellido Materno', 'trim|xss_clean');
            $this->form_validation->set_rules('fecha_nacimiento', 'Fecha de Nacimiento', 'trim|xss_clean');
            $this->form_validation->set_rules('direccion', 'Direccion', 'trim|xss_clean');
            $this->form_validation->set_rules('departamento', 'departamento', 'trim|xss_clean');
            $this->form_validation->set_rules('telefono_01', 'Telefono', 'trim|xss_clean');
            $this->form_validation->set_rules('telefono_02', 'Telefono', 'trim|xss_clean');
            $this->form_validation->set_rules('calificacion', 'Calificacion', 'trim|xss_clean');
            $this->form_validation->set_rules('descripcion', 'Descripcion', 'trim|xss_clean');
            $this->form_validation->set_rules('tipo_licencia', 'Licencia', 'trim|xss_clean');
            $this->form_validation->set_rules('fecha_vencimiento_l', 'Fecha de Vencimiento', 'trim|xss_clean');

            if ($this->form_validation->run() == FALSE) {
                $datos['estado'] = 'Error';
                $datos['message'] = 'Los datos del fomulario no son correcto.';
                $this->loadView('Empleado', '/form/empleado/editar_empleado', $datos);
            } else {
                $id_persona = $empleado->ID_persona;
                $id_empleado = $this->input->post('id');
                $ci = $this->input->post('CI');
                $nombres = $this->input->post('nombres');
                $apellidop = $this->input->post('apellido_paterno');
                $apellidom = $this->input->post('apellido_materno');
                $fechan = $this->input->post('fecha_nacimiento');
                $direccion = $this->input->post('direccion');
                $departamento = $this->input->post('departamento');
                $telefono01 = $this->input->post('telefono_01');
                $telefono02 = $this->input->post('telefono_02');
                $calificacion = $this->input->post('calificacion');
                $descripcion = $this->input->post('descripcion');
                $tlicencia = $this->input->post('tipo_licencia');
                $fechavl = $this->input->post('fecha_vencimiento_l');

                $this->Persona_model->updatePersona($id_persona, $ci, $nombres, $apellidop, $apellidom, $fechan, $direccion, $departamento, $telefono01, $telefono02);
                $this->Empleado_model->updateEmpleado($id_empleado, $calificacion, $descripcion, $tlicencia, $fechavl);
                $datos['datos'] = $this->Empleado_model->idempleado($id_empleado);
                $datos['respuesta'] = 'Exitoso';
                $datos['message'] = 'Los datos se editaron correctamente.';
            }
        } catch (\Throwable $th) {

            $datos['respuesta'] = 'Error';
            $datos['message'] = $th->getMessage();
        }

        echo json_encode($datos);
    }
    public function obtenerEmpleadoId()
    {
        $ci = $this->input->post('id_empleado');
        if ($this->Persona_model->id_persona($ci) == true) {
            $obtenerpersona = $this->Persona_model->obtenerPersona($ci);
            $respuesta = array(
                'respuesta' => 'encontrato',
                'datos' => array(

                    'ci' => $obtenerpersona['CI'],
                    'nombres' => $obtenerpersona['Nombres']
                )
            );
        } else {
            $respuesta = array(
                'tipo' => 'No Existe',
                'respuesta' => ' El epmleado no esta registrado'
            );
        }

        echo json_encode($respuesta);
    }
    public function buscarEmpleadoajax()
    {
        $valor = $this->input->post('valor');
        $empleados = $this->Empleado_model->BuscarEmpleadoNombre($valor);
        echo json_encode($empleados);

    }
    public function buscarEmpleadoaCIajax()
    {
        $ci = $this->input->post('valor');
        $empleados = $this->Empleado_model->BuscarEmpleadoCI($ci);
        echo json_encode($empleados);

    }
}
