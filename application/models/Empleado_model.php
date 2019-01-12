<?php
    class datos_Empleado {
        
        function __construct(){
            parent::Model();
            
        }
    }

    class Empleado_model extends CI_Model {


        public function insertar($id_persona,$calificacion,$descripcion,$tlicencia,$fechavl){           

            

            $data2 = array(
                'ID_persona' => $id_persona,
                'Calificacion' => $calificacion,
                'Descripcion' => $descripcion,
                'TipoLicencia' => $tlicencia,
                'FechaVencimientoL' => $fechavl
            );

            $this->db->insert('empleado', $data2);

            $id_conductor = $this->db->insert_id();

            return $id_conductor;

        }    
        public function obtenerEmpleado(){

            $query = $this->db->query("select * from persona p inner join empleado e on p.ID_persona = e.ID_persona");

            return $query;
        }  

        

        

    }