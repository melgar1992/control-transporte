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
    }