<?php
class Predio_model extends CI_Model
{

    public function obtenerPredios()
    {
        $this->db->select('*');
        return $this->db->get('predio')->result();
    }
    public function ingresarPredio($NombrePredio, $Departamento, $Provincia, $Municipio, $NombrePropietario, $ApellidoPropietario, $TipoPredio, $Direccion)
    {
        $datos = array(
            'NombrePredio' =>$NombrePredio ,
            'Departamento' =>$Departamento ,
            'Provincia' => $Provincia,
            'Municipio' => $Municipio,
            '' => ,
            '' => ,
        );
    }

}