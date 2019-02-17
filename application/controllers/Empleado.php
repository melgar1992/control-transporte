<?php
class Empleado extends BaseController {
    
    function __construct(){
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->helper('codhtml_helper');
    }
    
    public function index(){

        if (Usr::ok()){
            $empleados['datos'] = $this->Empleado_model->obtenerEmpleado();
            //$this->load->view('template/header');
            //$this->load->view('template/menu_quick_info');
            //$this->load->view('template/sidebar_menu');
            $this->loadWeb('/form/empleado/nuevo_empleado', $empleados);
            //$this->load->view('template/footer');
        }else{
            $this->load->view('login');
        }
        
        
    }
    public function ingresar_empleado(){

        //die(json_encode($_POST));        
        $this->form_validation->set_rules('nombres','Nombres','required');

        if ($this->form_validation->run() === false){

            $error = form_error('nombres');

            $respuesta = array(
                'tipo' =>'Formulario',
                'respuesta' => $error
            );

        } else {
            $ci= $this->input->post('CI');
            $nombres= $this->input->post('nombres');
            $apellidop= $this->input->post('apellido-paterno');
            $apellidom= $this->input->post('apellido-materno');
            $fechan= $this->input->post('fecha-nacimiento');
            $direccion= $this->input->post('direccion');
            $departamento= $this->input->post('departamento');
            $telefono01= $this->input->post('telefono_01');
            $telefono02= $this->input->post('telefono_02');
            $calificacion= $this->input->post('calificacion');
            $descripcion= $this->input->post('descripcion');
            $tlicencia= $this->input->post('tipo-licencia');
            $fechavl= $this->input->post('fecha-vencimiento-l');
            

            if($this->Persona_model->id_persona($ci) == false){            
                $this->Persona_model->insertar($ci,$nombres,$apellidop,$apellidom,$fechan,$direccion,$departamento,$telefono01,$telefono02);
                $id_persona = $this->Persona_model->id_persona($ci);
                $id_empleado = $this->Empleado_model->insertar($id_persona,$calificacion,$descripcion,$tlicencia,$fechavl);

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
                        'tlicencia' => $tlicencia
                    )
                );
            }   
            else{
                $respuesta = array(
                    'tipo' => 'Duplicado',
                    'respuesta' => 'Duplicada'
                );            
            }            
        }       
        echo json_encode($respuesta);
    }

    public function obtenerEmpleado(){
        $obtenerEmpleado = $this->Empleado_model->obtenerEmpleado();
        return $obtenerEmpleado;
    }

    public function eliminarEmpleado(){
        
    }
    public function editarEmpleado(){
        $id_empleado = $this->input->get('id');
        if($id_empleado){
            $empleado['datos']= $this->Empleado_model->idempleado($id_empleado);;
            $this->load->view('template/header');
		    $this->load->view('template/menu_quick_info');
		    $this->load->view('template/sidebar_menu');
            $this->load->view('/form/empleado/editar_empleado', $empleado);
            $this->load->view('template/footer');
        }
        else{
            $formulario = $this->input->post('button');
            if($formulario == "editar"){
                
                try {
                    //code...
                    $id_persona= $this->input->post('ID_persona');
                    $id_empleado= $this->input->post('ID_empleado');
                    $ci= $this->input->post('CI');
                    $nombres= $this->input->post('nombres');
                    $apellidop= $this->input->post('apellido-paterno');
                    $apellidom= $this->input->post('apellido-materno');
                    $fechan= $this->input->post('fecha-nacimiento');
                    $direccion= $this->input->post('direccion');
                    $departamento= $this->input->post('departamento');
                    $telefono01= $this->input->post('telefono_01');
                    $telefono02= $this->input->post('telefono_02');
                    $calificacion= $this->input->post('calificacion');
                    $descripcion= $this->input->post('descripcion');
                    $tlicencia= $this->input->post('tipo-licencia');
                    $fechavl= $this->input->post('fecha-vencimiento-l');

                    $this->Persona_model->updatePersona($id_persona,$ci,$nombres,$apellidop,$apellidom,$fechan,$direccion,$departamento,$telefono01,$telefono02);
                    $this->Empleado_model->updateEmpleado($id_empleado,$calificacion,$descripcion,$tlicencia,$fechavl);
                    $datos['estado'] = 'successful';
                    $this->load->view('template/header');
                    $this->load->view('template/menu_quick_info');
                    $this->load->view('template/sidebar_menu');
                    $this->load->view('/form/empleado/editar_empleado', $datos);
                    $this->load->view('template/footer');

                } catch (\Throwable $th) {
                    //throw $th;
                    $datos['estado'] = 'Error';
                    $datos['message'] = $th->getMessage();
                }
            }                       
        }
        
        

    }

    
}