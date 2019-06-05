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
                'FechaVencimientoL' => $fechavl,
                'Estado' => 'Activo'
            );

            $this->db->insert('empleado', $data2);

            $id_conductor = $this->db->insert_id();

            return $id_conductor;

        }    
        public function obtenerEmpleado(){

            $query = $this->db->query('select * from persona p inner join empleado e on p.ID_persona = e.ID_persona where e.Estado = "Activo"');

            return $query;
        }  

        public function eliminarEmpleado($id_empleado){
            $data2 = array(
                'Estado' => 'Inactivo'
            );
            $this->db->where('ID_Empleado',$id_empleado);
            $this->db->update('empleado', $data2);

        }

        public function idempleado($id_empleado){

            $this->db->select('*');
            $this->db->from('persona');
            $this->db->join('empleado','persona.ID_persona = empleado.ID_persona');
            $this->db->where('empleado.ID_persona',$id_empleado);
            $query = $this->db->get();


            #$query = $this->db->query(" select * 
            #                            from persona p 
            #                            inner join empleado e on p.ID_persona = e.ID_persona
            #                            where e.ID_empleado = ".$id_empleado);
            
            return $query->row();

        }

        public function updateEmpleado($id_empleado,$calificacion,$descripcion,$tlicencia,$fechavl){
            $data2 = array(
                'Calificacion' => $calificacion,
                'Descripcion' => $descripcion,
                'TipoLicencia' => $tlicencia,
                'FechaVencimientoL' => $fechavl
            );
            $this->db->where('ID_Empleado',$id_empleado);
            $this->db->update('empleado', $data2);
        }

    }