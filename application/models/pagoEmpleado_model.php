<?php
class pagoEmpleado_model extends CI_Model
{
    // En este modulo se manejara los pagos de los empleados

    public function obtenerPagoEmpleados()
    {
        $this->db->select('pago.ID_pago, persona.nombres, persona.Apellido_p, Fecha, MesCorrespondiente, pago.Descripcion, Monto');
        $this->db->from('pago');
        $this->db->join('contrato','pago.ID_contrato = contrato.ID_contrato');
        $this->db->join('empleado','empleado.ID_empleado = contrato.ID_empleado');
        $this->db->join('tipocontrato','contrato.ID_tipocontrato = tipocontrato.ID_tipocontrato');
        $this->db->join('persona','persona.ID_persona = empleado.ID_persona');
        $this->db->where('contrato.Estado','Activo');
        $this->db->where('empleado.Estado','Activo');
      

        $datos = $this->db->get();
        
        return $datos;
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
