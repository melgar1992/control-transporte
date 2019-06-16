<?php
class pagoEmpleado_model extends CI_Model
{
    // En este modulo se manejara los pagos de los empleados

    public function obtenerPagoEmpleados()
    {
        $query = $this->db->query('select * from pago');
        return $query;
    }
    public function insertarPagoEmpleado($id_contrato, $fecha_pago, $mes_correspondiente, $descripcion, $pago)
    {

        $data = array(
            'ID_contrato' => $id_contrato,
            'Fecha' => $fecha_pago,
            'MesCorrespondiente' => $mes_correspondiente,
            'Descripcion' => $descripcion,
            'Monto' => $pago,
        );
        $this->db->insert('pago', $data);

        $id_pagoEmpleado = $this->db->insert_id();
        return $id_pagoEmpleado;
    }
}
