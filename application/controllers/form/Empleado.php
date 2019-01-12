<?php
class Empleado extends CI_Controller {
    
    function __construct(){
        parent::__construct();        	
    }
    
    public function index(){

        $empleados['datos'] = $this->Empleado_model->obtenerEmpleado();
        $this->load->view('template/header');
		$this->load->view('template/menu_quick_info');
		$this->load->view('template/sidebar_menu');
        $this->load->view('/form/empleado/nuevo_empleado', $empleados);
        $this->load->view('template/footer');
        
    }
    public function ingresar_empleado(){

        //die(json_encode($_POST));        
          
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
                'respuesta' => 'Duplicada'
            );            
        }

        echo json_encode($respuesta);     

    }

    public function obtenerEmpleado(){
        $obtenerEmpleado = $this->Empleado_model->obtenerEmpleado();
        return $obtenerEmpleado;
    }

    
}