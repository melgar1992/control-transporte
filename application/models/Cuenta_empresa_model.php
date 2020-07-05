<?php
class Cuenta_empresa_model extends CI_Model
{
    public function obtenerTiposCuentas()
    {
        $this->db->select('*');
        return $this->db->get('tipo_cuenta')->result_array();
    }
    public function obtenerCuentasEmpresa()
    {
        $this->db->select('ce.*, tc.nombre, (sum(Haber) - sum(Debe)) as balance');
        $this->db->from('cuenta_empresa ce');
        $this->db->join('tipo_cuenta tc', 'tc.ID_tipo_cuenta = ce.ID_tipo_cuenta');
        $this->db->join('pago_cuentas pc', 'pc.ID_cuenta_empresa = ce.ID_cuenta_empresa', 'left');
        $this->db->where('ce.Estado', 'Activo');
        $this->db->group_by('ce.ID_cuenta_empresa');
        return $this->db->get()->result_array();
    }
    public function ingresarCuentaEmpresa($ID_tipo_cuenta, $Nombre_cuenta, $Descripcion)
    {
        $datos = array(
            'ID_tipo_cuenta' => $ID_tipo_cuenta,
            'Nombre_cuenta' => $Nombre_cuenta,
            'Descripcion' => $Descripcion,
            'Estado' => 'Activo',
        );
        $this->db->insert('cuenta_empresa', $datos);
        return $this->db->insert_id();
    }
    public function editarCuentaEmpresa($ID_cuenta_empresa, $ID_tipo_cuenta, $Nombre_cuenta, $Descripcion)
    {
        $datos = array(
            'ID_tipo_cuenta' => $ID_tipo_cuenta,
            'Nombre_cuenta' => $Nombre_cuenta,
            'Descripcion' => $Descripcion,
        );
        $this->db->where('ID_cuenta_empresa', $ID_cuenta_empresa);
        $this->db->update('cuenta_empresa', $datos);
    }
    public function obtenerCuentaEmpresa($ID_cuenta_empresa)
    {
        $this->db->select('ce.*, tc.nombre, (sum(Haber) - sum(Debe)) as balance');
        $this->db->from('cuenta_empresa ce');
        $this->db->join('tipo_cuenta tc', 'tc.ID_tipo_cuenta = ce.ID_tipo_cuenta');
        $this->db->join('pago_cuentas pc', 'pc.ID_cuenta_empresa = ce.ID_cuenta_empresa', 'left');
        $this->db->where('ce.ID_cuenta_empresa', $ID_cuenta_empresa);
        $this->db->group_by('ce.ID_cuenta_empresa');
        return $this->db->get()->row_array();
    }
    public function BorrarCuentaEmpresa($ID_cuenta_empresa)
    {
        $datos = array(
            'Estado' => 'Inactivo',
        );
        $this->db->where('ID_cuenta_empresa', $ID_cuenta_empresa);
        $this->db->update('cuenta_empresa', $datos);
    }
}
