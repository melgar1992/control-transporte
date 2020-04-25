<?php
class Camion_model extends CI_Model
{
    public function obtenerCamionesPropios()
    {
        $this->db->select('c.ID_camion, c.N_Placa, c.Modelo, c.Marca,c.Color, c.Capacidad, c.N_Senasag,c.Kilometraje,c.ID_contrato, contrato.ID_empleado, persona.CI, Nombres, Apellido_p, Apellido_m, tipocontrato.Descripcion, sueldo, FechaIngreso, FechaSalida');
        $this->db->from('camion c');
        $this->db->join('contrato', 'contrato.ID_contrato = c.ID_contrato');
        $this->db->join('tipocontrato', 'contrato.ID_tipoContrato = tipocontrato.ID_tipoContrato');
        $this->db->join('empleado', 'empleado.ID_empleado = contrato.ID_empleado');
        $this->db->join('persona', 'empleado.ID_persona = persona.ID_persona');
        $this->db->where('c.Estado', 'Activo');
        return $this->db->get()->result();
    }
    public function ingresarCamionPropio($ID_contrato, $Placa, $Modelo, $Marca, $Color, $Capacidad, $N_senasag, $Kilometraje)
    {
        $datos = array(
            'ID_contrato' => $ID_contrato,
            'N_Placa' => $Placa,
            'Modelo' => $Modelo,
            'Marca' => $Marca,
            'Color' => $Color,
            'Capacidad' => $Capacidad,
            'N_senasag' => $N_senasag,
            'Kilometraje' => $Kilometraje,
            'Estado' => 'Activo',

        );
        $this->db->insert('camion', $datos);
        return $this->db->insert_id();
    }
    public function obtenerCamionPropio($ID_camion)
    {
        $this->db->select('c.N_Placa,c.Modelo, c.Marca,c.Color, c.Capacidad, c.N_Senasag,c.Kilometraje,c.ID_contrato, contrato.ID_empleado, persona.CI, Nombres, Apellido_p, Apellido_m, tipocontrato.Descripcion, sueldo, FechaIngreso, FechaSalida');
        $this->db->from('camion c');
        $this->db->join('contrato', 'contrato.ID_contrato = c.ID_contrato');
        $this->db->join('tipocontrato', 'contrato.ID_tipoContrato = tipocontrato.ID_tipoContrato');
        $this->db->join('empleado', 'empleado.ID_empleado = contrato.ID_empleado');
        $this->db->join('persona', 'empleado.ID_persona = persona.ID_persona');
        $this->db->where('c.Estado', 'Activo');
        $this->db->where('c.ID_camion', $ID_camion);
        return $this->db->get()->row_array();
    }
    public function editarCamionPropio($ID_camion,$ID_contrato, $Placa, $Modelo, $Marca, $Color, $Capacidad, $N_senasag, $Kilometraje)
    {
        $datos = array(
            'ID_contrato' => $ID_contrato,
            'N_Placa' => $Placa,
            'Modelo' => $Modelo,
            'Marca' => $Marca,
            'Color' => $Color,
            'Capacidad' => $Capacidad,
            'N_Senasag' => $N_senasag,
            'Kilometraje' => $Kilometraje,

        );
        $this->db->where('ID_camion',$ID_camion);
        $this->db->update('camion',$datos);
    }
    public function eliminarCamionPropio($ID_camion)
    {
        $datos = array(
            'Estado' => 'Inactivo',
            'N_Placa' => '0',
        );
        $this->db->where('ID_camion',$ID_camion);
        $this->db->update('camion', $datos);
    }
}
