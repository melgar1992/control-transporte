<?php
class Transporte_model extends CI_Model
{
    public function obtenerTransportes()
    {
        $this->db->select('t.*, po.NombrePredio as NombrePredioOringen, pd.NombrePredio as NombrePredioDestino,
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
    public function obtenerTransporte($ID_transporte)
    {
        $this->db->select('t.*, po.NombrePredio as NombrePredioOringen, pd.NombrePredio as NombrePredioDestino,
         c.Nombre as NombreCliente, c.Apellidos as ApellidosCliente, c.CI, u.Nombre as NombreUsuario, 
         u.Apellidos as ApellidosUsuario, u.CI as CIUsuario');
        $this->db->from('transporte t');
        $this->db->join('predio po', 'po.ID_predio = t.ID_predio_origen');
        $this->db->join('predio pd', 'pd.ID_predio = t.ID_predio_destino');
        $this->db->join('cliente c', 'c.ID_cliente = t.ID_cliente');
        $this->db->join('user u', 'u.ID_user = t.ID_user');
        $this->db->where('t.Estado', 'Activo');
        $this->db->where('ID_transporte', $ID_transporte);
        return $this->db->get()->row_array();
    }
    public function obtenerDetalleTransporte($ID_transporte)
    {
        $this->db->select("dt.*, c.*, concat( p.Nombres, ' ' , p.Apellido_p , ' ' ,p.Apellido_m) as nombreChoferPropio, p.CI as CIcamionPropio");
        $this->db->from('detalle_transporte_ganado dt');
        $this->db->join('camion c', 'c.ID_camion = dt.ID_camion');
        $this->db->join('contrato co', 'co.ID_contrato = c.ID_contrato', 'left');
        $this->db->join('empleado e', 'co.ID_empleado = e.ID_empleado', 'left');
        $this->db->join('persona p', 'p.ID_persona = e.ID_persona', 'left');
        $this->db->where('dt.ID_transporte', $ID_transporte);
        return $this->db->get()->result();
    }
    public function guardarTransporte($datos)
    {
        $this->db->insert('transporte', $datos);
        return $this->db->insert_id();
    }
    public function editarTransporte($ID_transporte, $datos)
    {
        $this->db->where('ID_transporte', $ID_transporte);
        $this->db->update('transporte', $datos);
    }
    public function guardarDetalleTransporte($datos)
    {
        $this->db->insert('detalle_transporte_ganado', $datos);
    }
    public function eliminarDetalleTransporte($ID_transporte)
    {
        $this->db->where('ID_transporte',$ID_transporte);
        $this->db->delete('detalle_transporte_ganado');
    }
}
