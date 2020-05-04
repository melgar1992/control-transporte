<?php
class Transporte_model extends CI_Model
{
    public function obtenerTransportes()
    {
        $this->db->select('t.*, po.NombrePredio as NombrePredioOringen, po.NombrePredio as NombrePredioDestino,
         c.Nombre as NombreCliente, c.Apellidos as ApellidosCliente, c.CI, u.Nombre as NombreUsuario, 
         u.Apellidos as ApellidosUsuario, u.CI as CIUsuario');
        $this->db->from('transporte t');
        $this->db->join('predio po', 'po.ID_predio = t.ID_predio_origen');
        $this->db->join('predio pd', 'pd.ID_predio = t.ID_predio_destino');
        $this->db->join('cliente c', 'c.ID_cliente = t.ID_cliente');
        $this->db->join('user u', 'u.ID_user = t.ID_user');
        $this->db->limit(500);
        $this->db->where('t.Estado', 'Activo');
        return $this->db->get()->result();
    }
    public function guardarTransporte($datos)
    {
        $this->db->insert('Transporte',$datos);
        return $this->db->insert_id();
    }
    public function guardarDetalleTransporte($datos)
    {
        $this->db->insert('detalle_transporte_ganado',$datos);
    }
}