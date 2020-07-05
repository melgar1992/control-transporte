<?php
class Taller_model extends CI_Model
{
    public function getTalleres()
    {
        $this->db->select('*');
        $this->db->from('taller');
        $this->db->where('Estado','Activo');
        $this->db->order_by('NombreTaller');
        return $this->db->get()->result();
    }
    public function ingresarTaller($NombreTaller, $Departamento, $Direccion)
    {
        $datos = array(
            'NombreTaller' => $NombreTaller ,
            'Departamento' => $Departamento,
            'Direccion' => $Direccion,
            'Estado' => 'Activo',
         );
         $this->db->insert('taller',$datos);
         return $this->db->insert_id();
    }
    public function obtenerTaller($ID_taller)
    {
        $this->db->select('*');
        $this->db->from('taller');
        $this->db->where('ID_taller',$ID_taller);
        return $this->db->get()->row_array();
    }
    public function editarTaller($ID_taller,$NombreTaller, $Departamento, $Direccion )
    {
        $datos = array(
            'NombreTaller' => $NombreTaller ,
            'Departamento' => $Departamento,
            'Direccion' => $Direccion,
         );
         $this->db->where('ID_taller',$ID_taller);
         $this->db->update('taller',$datos);
        
    }
    public function eliminarTaller($ID_taller)
    {
        $datos = array('Estado' => 'Inactivo', );
        $this->db->where('ID_taller',$ID_taller);
        $this->db->update('taller',$datos);
    }
}