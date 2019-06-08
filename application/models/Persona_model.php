<?php
    class datos_Persona {
        
        function __construct(){
            parent::__construct();
            
        }
    }

    class Persona_model extends CI_Model {
        
        public function insertar($ci,$nombres,$apellidop,$apellidom,$fechan,$direccion,$departamento,$telefono01,$telefono02){

            $data = array(
                'CI' => $ci,
                'Nombres' => $nombres,
                'Apellido_p' => $apellidop,
                'Apellido_m' => $apellidom,
                'Fecha_nacimiento' => $fechan,                
                'Direccion' => $direccion,
                'Departamento' => $departamento,
                'Telefono_01' => $telefono01,
                'Telefono_02' => $telefono02

            );
                        
            $this->db->insert('persona', $data);

        }
        
        function id_persona($ci){

            $this->db->where('CI',$ci);
            $this->db->from('persona');
            $persona = $this->db->get();

            $row = $persona->row_array();

            if (isset($row)){
                return  $row['ID_persona'];
            }
            else{return false;}

        }

        public function updatePersona($id_persona,$ci,$nombres,$apellidop,$apellidom,$fechan,$direccion,$departamento,$telefono01,$telefono02){

            $data = array(
                'CI' => $ci,
                'Nombres' => $nombres,
                'Apellido_p' => $apellidop,
                'Apellido_m' => $apellidom,
                'Fecha_nacimiento' => $fechan,                
                'Direccion' => $direccion,
                'Departamento' => $departamento,
                'Telefono_01' => $telefono01,
                'Telefono_02' => $telefono02

            );
            $this->db->where('ID_persona', $id_persona);
            $this->db->update('persona', $data);

        }
        function obtenerPersona($ci){

            $this->db->where('CI',$ci);
            $this->db->from('persona');
            $persona = $this->db->get();

            $row = $persona->row_array();

            if (isset($row)){
                return  $row;
            }
            else{return false;}

        }

    }