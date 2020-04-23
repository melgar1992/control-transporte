<?php
class Proveedor_model extends CI_Model
{
    public function obtenerProveedores()
    {
        $this->db->select('*');
        $this->db->from('proveedor');
        $this->db->where('Estado','1');
        return $this->db->get()->result();
    }
}
