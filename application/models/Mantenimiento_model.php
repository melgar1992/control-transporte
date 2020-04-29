<?php
class Mantenimiento_model extends CI_Model
{

    public function obtenerMantenimientos()
    {
        $this->db->select('*, p.Nombres, p.Apellido_p, p.Apellido_m');
        $this->db->from('mantenimiento m');
        $this->db->join('empleado e','e.ID_empleado = m.ID_empleado');
        $this->db->join('persona p','p.ID_persona = e.ID_persona');
        $this->db->where('m.Estado','Activo');
        return $this->db->get()->result();
    }
    public function obtenrCategoriasMantenimientos()
    {
        $this->db->select('*');
        $this->db->from('categoria_mantenimiento');
        return $this->db->get()->result();
    }
}