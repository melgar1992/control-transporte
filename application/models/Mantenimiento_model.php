<?php
class Mantenimiento_model extends CI_Model
{

    public function obtenerMantenimientos()
    {
        $this->db->select('*,m.Descripcion as DescripcionMantenimiento, p.Nombres, p.Apellido_p, p.Apellido_m');
        $this->db->from('mantenimiento m');
        $this->db->join('empleado e', 'e.ID_empleado = m.ID_empleado');
        $this->db->join('persona p', 'p.ID_persona = e.ID_persona');
        $this->db->where('m.Estado', 'Activo');
        return $this->db->get()->result();
    }
    public function obtenerCategoriasMantenimientos()
    {
        $this->db->select('*');
        $this->db->from('categoria_mantenimiento');
        $this->db->order_by('Nombre');
        return $this->db->get()->result();
    }
    public function guardarMantenimiento($datos)
    {
        $this->db->insert('mantenimiento', $datos);
        return $this->db->insert_id();
    }
    public function actualizarMantenimiento($ID_mantenimiento,$datos)
    {
        $this->db->where('ID_mantenimiento',$ID_mantenimiento);
        $this->db->update('mantenimiento',$datos);
    }
    public function guardarDetalleMantenimiento($datos)
    {
        $this->db->insert('detalle_mantenimiento', $datos);
    }
    public function obtenerMantenimiento($ID_mantenimiento)
    {
        $this->db->select('*');
        $this->db->where('ID_Mantenimiento', $ID_mantenimiento);
        return $this->db->get('mantenimiento')->row_array();
    }
    public function obtenerDetalleMantenimiento($ID_mantenimiento)
    {
        $this->db->select('dm.*, t.NombreTaller, cm.Nombre as NombreCategoria');
        $this->db->from('detalle_mantenimiento dm');
        $this->db->join('taller t', 't.ID_taller = dm.ID_taller');
        $this->db->join('categoria_mantenimiento cm', 'cm.ID_categoria_mantenimiento = dm.ID_categoria_mantenimiento');
        $this->db->where('dm.ID_mantenimiento', $ID_mantenimiento);
        $this->db->order_by('dm.Fecha');
        return $this->db->get()->result();
    }
    public function eliminarDetalleMantenimiento($ID_mantenimiento)
    {
        $this->db->where('ID_mantenimiento',$ID_mantenimiento);
        $this->db->delete('detalle_mantenimiento');
    }
}
