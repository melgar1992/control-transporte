<?php
class Pagos_cuentas_model extends CI_Model
{
    public function obtenerPagosClientes()
    {
        $this->db->select('p.*, c.Nombre, c.Apellidos, c.CI, c.Direccion, c.Telefono_01, c.Telefono_02');
        $this->db->from('pago_cuentas p');
        $this->db->join('cliente c', 'c.ID_Cliente = p.ID_Cliente');
        $this->db->limit(500);
        return $this->db->get()->result();
    }
    public function ingresarPagoCliente($ID_Cliente, $Fecha, $Descripcion, $Debe, $Haber)
    {
        $datos = array(
            'ID_Cliente' => $ID_Cliente,
            'fecha' => $Fecha,
            'Descripcion' => $Descripcion,
            'Debe' => $Debe,
            'Haber' => $Haber,
        );
        $this->db->insert('pago_cuentas', $datos);
        return $this->db->insert_id();
    }
    public function obtenerPagoCliente($ID_pago_cuentas)
    {
        $this->db->select('p.*, c.Nombre, c.Apellidos, c.CI, c.Direccion, c.Telefono_01, c.Telefono_02');
        $this->db->from('pago_cuentas p');
        $this->db->join('cliente c', 'c.ID_Cliente = p.ID_Cliente');
        $this->db->where('ID_pago_cuentas', $ID_pago_cuentas);
        return $this->db->get()->row_array();
    }
    public function editarPagoCliente($ID_pago_cuentas, $ID_Cliente, $Fecha, $Descripcion, $Debe, $Haber)
    {
        $datos = array(
            'ID_Cliente' => $ID_Cliente,
            'fecha' => $Fecha,
            'Descripcion' => $Descripcion,
            'Debe' => $Debe,
            'Haber' => $Haber,
        );
        $this->db->where('ID_pago_cuentas', $ID_pago_cuentas);
        $this->db->update('pago_cuentas', $datos);
    }
    public function eliminarPago($ID_pago_cuentas)
    {
        $this->db->where('ID_pago_cuentas', $ID_pago_cuentas);
        $this->db->delete('pago_cuentas');
    }

    //Funciones de pago de talleres
    public function obtenerPagostalleres()
    {
        $this->db->select('p.*, t.NombreTaller, t.Departamento, t.Direccion');
        $this->db->from('pago_cuentas p');
        $this->db->join('taller t', 't.ID_taller = p.ID_taller');
        $this->db->limit(500);
        return $this->db->get()->result();
    }
    public function ingresarPagoTaller($ID_taller, $Fecha, $Descripcion, $Debe, $Haber)
    {
        $datos = array(
            'ID_taller' => $ID_taller,
            'fecha' => $Fecha,
            'Descripcion' => $Descripcion,
            'Debe' => $Debe,
            'Haber' => $Haber,
        );
        $this->db->insert('pago_cuentas', $datos);
        return $this->db->insert_id();
    }
    public function obtenerPagoTaller($ID_pago_cuentas)
    {
        $this->db->select('p.*, t.NombreTaller, t.Departamento, t.Direccion');
        $this->db->from('pago_cuentas p');
        $this->db->join('taller t', 't.ID_taller = p.ID_taller');
        $this->db->where('ID_pago_cuentas', $ID_pago_cuentas);
        return $this->db->get()->row_array();
    }
    public function editarPagoTaller($ID_pago_cuentas, $ID_taller, $Fecha, $Descripcion, $Debe, $Haber)
    {
        $datos = array(
            'ID_taller' => $ID_taller,
            'fecha' => $Fecha,
            'Descripcion' => $Descripcion,
            'Debe' => $Debe,
            'Haber' => $Haber,
        );
        $this->db->where('ID_pago_cuentas', $ID_pago_cuentas);
        $this->db->update('pago_cuentas', $datos);
    }

    //Funciones de pago de Proveedores
    public function obtenerPagosProveedor()
    {
        $this->db->select('p.*,po.CI, po.Nombres, po.Apellidos, po.Calificacion, po.Descripcion as DescripcionProveedor, po.Direccion, po.Departamento, po.Telefono_01, po.Telefono_02');
        $this->db->from('pago_cuentas p');
        $this->db->join('proveedor po', 'po.ID_proveedor = p.ID_proveedor');
        $this->db->limit(500);
        return $this->db->get()->result();
    }
    public function ingresarPagoProveedor($ID_proveedor, $Fecha, $Descripcion, $Debe, $Haber)
    {
        $datos = array(
            'ID_proveedor' => $ID_proveedor,
            'fecha' => $Fecha,
            'Descripcion' => $Descripcion,
            'Debe' => $Debe,
            'Haber' => $Haber,
        );
        $this->db->insert('pago_cuentas', $datos);
        return $this->db->insert_id();
    }
    public function obtenerPagoProveedor($ID_pago_cuentas)
    {
        $this->db->select('p.*,po.CI, po.Nombres, po.Apellidos, po.Calificacion, po.Descripcion as DescripcionProveedor, po.Direccion, po.Departamento, po.Telefono_01, po.Telefono_02');
        $this->db->from('pago_cuentas p');
        $this->db->join('proveedor po', 'po.ID_proveedor = p.ID_proveedor');
        $this->db->where('ID_pago_cuentas', $ID_pago_cuentas);
        return $this->db->get()->row_array();
    }
    public function editarPagoProveedor($ID_pago_cuentas, $ID_proveedor, $Fecha, $Descripcion, $Debe, $Haber)
    {
        $datos = array(
            'ID_proveedor' => $ID_proveedor,
            'fecha' => $Fecha,
            'Descripcion' => $Descripcion,
            'Debe' => $Debe,
            'Haber' => $Haber,
        );
        $this->db->where('ID_pago_cuentas', $ID_pago_cuentas);
        $this->db->update('pago_cuentas', $datos);
    }
    //Funciones de movimientos de la cuenta de la empresa.

    public function obtenerMovimientosCuentaEmpresa()
    {
        $this->db->select('p.*,ce.Nombre_cuenta, ce.Descripcion as DescripcionCuenta');
        $this->db->from('pago_cuentas p');
        $this->db->join('cuenta_empresa ce', 'ce.ID_cuenta_empresa = p.ID_cuenta_empresa');
        $this->db->limit(500);
        return $this->db->get()->result();
    }
    public function ingresarMovimientoEmpresa($ID_cuenta_empresa, $Fecha, $Descripcion, $Debe, $Haber)
    {
        $datos = array(
            'ID_cuenta_empresa' => $ID_cuenta_empresa,
            'fecha' => $Fecha,
            'Descripcion' => $Descripcion,
            'Debe' => $Debe,
            'Haber' => $Haber,
        );
        $this->db->insert('pago_cuentas', $datos);
        return $this->db->insert_id();
    }
    public function obtenerMovimientoEmpresa($ID_pago_cuentas)
    {
        $this->db->select('p.*,ce.Nombre_cuenta, ce.Descripcion as DescripcionCuenta');
        $this->db->from('pago_cuentas p');
        $this->db->join('cuenta_empresa ce', 'ce.ID_cuenta_empresa = p.ID_cuenta_empresa');
        $this->db->where('p.ID_pago_cuentas', $ID_pago_cuentas);
        return $this->db->get()->row_array();
    }
    public function editarMovimientoEmpresa($ID_pago_cuentas, $ID_cuenta_empresa, $Fecha, $Descripcion, $Debe, $Haber)
    {
        $datos = array(
            'ID_cuenta_empresa' => $ID_cuenta_empresa,
            'fecha' => $Fecha,
            'Descripcion' => $Descripcion,
            'Debe' => $Debe,
            'Haber' => $Haber,
        );
        $this->db->where('ID_pago_cuentas', $ID_pago_cuentas);
        $this->db->update('pago_cuentas', $datos);
    }
}
