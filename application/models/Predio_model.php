<?php
class Predio_model extends CI_Model
{

    public function obtenerPredios()
    {
        $this->db->select('*');
        $this->db->where('Estado', '1');
        return $this->db->get('predio')->result();
    }
    public function ingresarPredio($NombrePredio, $Departamento, $Provincia, $Municipio, $NombrePropietario, $ApellidoPropietario, $TipoPredio, $Direccion)
    {
        $datos = array(
            'NombrePredio' => $NombrePredio,
            'Departamento' => $Departamento,
            'Provincia' => $Provincia,
            'Municipio' => $Municipio,
            'NombrePropietario' => $NombrePropietario,
            'ApellidoPropietario' => $ApellidoPropietario,
            'TipoPredio' => $TipoPredio,
            'Direccion' => $Direccion,
            'Estado' => '1',
        );
        $this->db->insert('predio', $datos);
        return $this->db->insert_id();
    }
    public function obtenerPredio($ID_predio)
    {
        $this->db->select('*');
        $this->db->where('ID_predio', $ID_predio);
        return $this->db->get('predio')->row_array();
    }
    public function editarPredio($ID_predio, $NombrePredio, $Departamento, $Provincia, $Municipio, $NombrePropietario, $ApellidoPropietario, $TipoPredio, $Direccion)
    {
        $datos = array(
            'NombrePredio' => $NombrePredio,
            'Departamento' => $Departamento,
            'Provincia' => $Provincia,
            'Municipio' => $Municipio,
            'NombrePropietario' => $NombrePropietario,
            'ApellidoPropietario' => $ApellidoPropietario,
            'TipoPredio' => $TipoPredio,
            'Direccion' => $Direccion,
        );
        $this->db->where('ID_predio', $ID_predio);
        $this->db->update('predio', $datos);
    }
    public function eliminarPredio($ID_predio)
    {
        $datos = array('Estado' => '0',);
        $this->db->where('ID_predio', $ID_predio);
        $this->db->update('predio', $datos);
    }
}
