<?php
class Cliente_model extends CI_Model
{
    public function obtenerClientes()
    {
        //retorna todos los clientes activos en la tabla
        $this->db->select('*');
        $this->db->from('cliente');
        $this->db->where('Estado','Activo');
        return $this->db->get()->result();
    }
    
}