<?php
    class Contrato_model extends CI_Model {
        // En este modulo se manejara tanto el tipo contrato como el contrato ya sea de
        // los proveedores como los colaboradores.
        
        PUBLIC function obtenerTipoContrato(){
            $query = $this->db->query('select * from tipocontrato');
            return $query;
        }

        public function insertar_tipo_contrato($tipocontrato){

            $data2 = array(
                'Descripcion' => $tipocontrato
            );

            $this->db->insert('tipocontrato', $data2);

            $ID_tipoContrato = $this->db->insert_id();

            return $ID_tipoContrato;
        }

        public function IdTipoContrato($ID_tipoContrato){

            $this->db->select('*');
            $this->db->from('tipocontrato');
            $this->db->where('ID_tipoContrato', $ID_tipoContrato);
            $query = $this->db->get();
            return $query->row();
        }

        public function editar_tipo_contrato($ID_tipoContrato, $Detalle){

            $data2 = array(
                'Descripcion' => $Detalle
            );
            $this->db->where('ID_tipoContrato',$ID_tipoContrato);
            $this->db->update('tipocontrato',$data2);
        }

        public function ObtenerIdTipoContrato($descripcion){

            $this->db->select('ID_tipoContrato');
            $this->db->from('tipocontrato');
            $this->db->where('Descripcion',$descripcion);
    
            $id_tipoContrato = $this->db->get();
    
            $row = $id_tipoContrato->row_array();
    
            return $row['ID_tipoContrato'];
    
    
        }


        // Funciones de Contratos Empleados


        public function obtenerContratoEmpleado (){

            $query = $this->db->query('select ID_contrato,c.ID_empleado, CI, Nombres, Apellido_p, Apellido_m, t.Descripcion, sueldo, FechaIngreso, FechaSalida from contrato c inner join tipocontrato t inner join empleado e inner join persona p on  p.ID_persona = e.ID_persona where  c.Estado = "Activo" and e.ID_empleado = c.ID_empleado and c.ID_tipocontrato = t.ID_tipocontrato');
      
            return $query;
      
        }

        public function insertarContratoEmpleado ($id_Empleado,$id_tipoContrato,$sueldo,$fechain,$fechafin){
        
            $data3 = array(
                'ID_empleado'=> $id_Empleado ,
                'ID_tipoContrato'=> $id_tipoContrato ,
                'sueldo'=> $sueldo ,
                'FechaIngreso'=> $fechain ,
                'FechaSalida'=> $fechafin ,
                'Estado'=> 'Activo' 
                    );
            $this->db->insert('contrato',$data3);
    
            $id_contrato = $this->db->insert_id();
    
            return $id_contrato;
    
    
    
        }
        public function updateContrato($ID_contrato, $tipocontrato,$sueldo,$fechain,$fechafin){

            $data = array(
                'ID_tipoContrato'=> $tipocontrato,
                'sueldo'=> $sueldo ,
                'FechaIngreso'=> $fechain ,
                'FechaSalida'=> $fechafin ,
                    );
                $this->db->where('ID_contrato',$ID_contrato);
                $this->db->update('contrato',$data);
    
        }


        public function eliminarContratoEmpleado($id_contrato){
            $data = array('Estado' => 'Inactivo' );

            $this->db->where('ID_contrato', $id_contrato);
            $this->db->update('contrato',$data);
            }


            public function ExisteContrato($ci) {
                $empleado = $this->Empleado_model->ObtenerEmpleadoxCI($ci);
                $id_Empleado = $empleado['ID_empleado'];
                $this->db->select('*');
                $this->db->from('contrato');
                $this->db->where('ID_empleado',$id_Empleado);
                $this->db->where('Estado','Activo');
        
                $contrato = $this->db->get();
        
                //$fechaActual = new DateTime($rows2['fecha']);
                
                $row = $contrato->row_array();
        
                if (isset($row) ) {
                    return $row;
                } else {
                    return false;
                }
                
        
            }

            public function obtenerContratoxID($id_contrato) {
                
                $this->db->select('p.CI, p.Nombres, t.Descripcion, sueldo, FechaIngreso, FechaSalida');
                $this->db->from('contrato c');
                $this->db->join('tipocontrato t','t.ID_tipocontrato = c.ID_tipocontrato');
                $this->db->join('empleado e','e.ID_empleado = c.ID_empleado');
                $this->db->join('persona p','p.ID_persona = e.ID_persona');
                $this->db->where('c.Estado','Activo');
                $this->db->where('e.Estado','Activo');
                $this->db->where('ID_contrato',$id_contrato);
        
                $query = $this->db->get();
        
                $contrato = $query->row_array();
        
                if (isset($contrato)){
                        
                    return  $contrato;
                    
                }
                else{return false;}
        
        
            }
 }