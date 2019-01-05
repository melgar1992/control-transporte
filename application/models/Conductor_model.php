<?php
    class datos_Conductor {
        
        function __construct(){
            parent::Model();
            
        }
    }

    class Conductor_model extends CI_Model {


        public function insertar($id_persona,$calificacion,$descripcion,$tlicencia,$fechavl){           

            

            $data2 = array(
                'ID_persona' => $id_persona,
                'Calificacion' => $calificacion,
                'Descripcion' => $descripcion,
                'TipoLicencia' => $tlicencia,
                'FechaVencimientoL' => $fechavl
            );

            $this->db->insert('conductor', $data2);

            $id_conductor = $this->db->insert_id();

            return $id_conductor;

        }      

        

        

    }