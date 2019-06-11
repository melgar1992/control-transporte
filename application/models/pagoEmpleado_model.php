<?php
    class pagoEmpleado_model extends CI_Model {
        // En este modulo se manejara los pagos de los empleados
        
        PUBLIC function obtenerPagoEmpleados(){
            $query = $this->db->query('select * from pago');
            return $query;
        }
    }