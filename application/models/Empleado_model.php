<?php

class Empleado_model extends CI_Model
{


    public function insertar($id_persona, $calificacion, $descripcion, $tlicencia, $fechavl)
    {



        $data2 = array(
            'ID_persona' => $id_persona,
            'Calificacion' => $calificacion,
            'Descripcion' => $descripcion,
            'TipoLicencia' => $tlicencia,
            'FechaVencimientoL' => $fechavl,
            'Estado' => 'Activo'
        );

        $this->db->insert('empleado', $data2);

        $id_conductor = $this->db->insert_id();

        return $id_conductor;
    }
    public function obtenerEmpleado()
    {

        $query = $this->db->query('select *, e.ID_empleado from persona p inner join empleado e on p.ID_persona = e.ID_persona where e.Estado = "Activo"');

        return $query;
    }

    public function eliminarEmpleado($id_empleado)
    {
        $data2 = array(
            'Estado' => 'Inactivo',
        );
        $this->db->where('ID_Empleado', $id_empleado);
        $this->db->update('empleado', $data2);
        $this->db->where('ID_Empleado', $id_empleado);
        $empleado = $this->db->get('empleado')->row();
        $data = array(
            'CI' => '0',
        );
        $this->db->update('persona', $data, array('ID_persona' => $empleado->ID_persona));
    }

    public function idempleado($id_empleado)
    {

        $this->db->select('*');
        $this->db->from('persona');
        $this->db->join('empleado', 'persona.ID_persona = empleado.ID_persona');
        $this->db->where('empleado.ID_empleado', $id_empleado);
        $query = $this->db->get();
        return $query->row();
    }

    public function updateEmpleado($id_empleado, $calificacion, $descripcion, $tlicencia, $fechavl)
    {
        $data2 = array(
            'Calificacion' => $calificacion,
            'Descripcion' => $descripcion,
            'TipoLicencia' => $tlicencia,
            'FechaVencimientoL' => $fechavl
        );
        $this->db->where('ID_Empleado', $id_empleado);
        $this->db->update('empleado', $data2);
    }
    public function ObtenerEmpleadoxCI($CI)
    {

        //Valida que exista un empleado por CI y retorna todos los datos del empleado

        $this->db->select('*');
        $this->db->from('persona');
        $this->db->join('empleado', 'persona.ID_persona = empleado.ID_persona');
        $this->db->where('persona.CI', $CI);
        $this->db->where('empleado.Estado', 'Activo');

        $query = $this->db->get();

        $row = $query->row_array();

        if (isset($row)) {

            return  $row;
        } else {
            return false;
        }
    }
    public function BuscarEmpleado($teclaPulsada)
    {
        $this->db->select('ID_empleado, Nombres, Apellido_p, Apellido_m ');
        $this->db->from('empleado');
        $this->db->join('persona', 'empleado.ID_persona = persona.ID_persona');
        $this->db->where('empleado.Estado', 'Activo');
        $this->db->like('Nombres', $teclaPulsada);

        $query = $this->db->get();
        $listaNombres = $query->result_array();
        return $listaNombres;
    }
    public function BuscarEmpleadoNombre($teclaPulsada)
    {
        $this->db->select('ID_empleado, CI, Nombres, Apellido_p, Apellido_m, Nombres as label');
        $this->db->from('empleado');
        $this->db->join('persona', 'empleado.ID_persona = persona.ID_persona');
        $this->db->where('empleado.Estado', 'Activo');
        $this->db->like('persona.Nombres', $teclaPulsada);

        $query = $this->db->get();
        $listaNombres = $query->result_array();
        return $listaNombres;
    }
    public function BuscarEmpleadoCI($teclaPulsada)
    {
        $this->db->select('ID_empleado, CI as label, Nombres, Apellido_p, Apellido_m,');
        $this->db->from('empleado');
        $this->db->join('persona', 'empleado.ID_persona = persona.ID_persona');
        $this->db->where('empleado.Estado', 'Activo');
        $this->db->like('persona.CI', $teclaPulsada);

        $query = $this->db->get();
        $listaNombres = $query->result_array();
        return $listaNombres;
    }
    public function obtenerPagosEmpleado($id_empleado)
    {
        $this->db->select('p.Fecha, p.Descripcion, p.Monto');
        $this->db->from('empleado e');
        $this->db->join('contrato c', 'c.ID_empleado = e.ID_empleado');
        $this->db->join('pago p', 'p.ID_contrato = c.ID_contrato');
        $this->db->order_by('p.Fecha');
        $this->db->where('e.ID_empleado', $id_empleado);

        return $this->db->get()->result_array();
    }
    public function obtenerIngresosEmpleado($id_empleado)
    {
        $this->db->select('*');
        $this->db->from('empleado e');
        $this->db->join('contrato c', 'c.ID_empleado = e.ID_empleado');
        $this->db->where('e.ID_empleado', $id_empleado);
        $contrato_empleado = $this->db->get()->result_array();
        $empleado = new Empleado_funciones();
        foreach ($contrato_empleado as $row) {
            if ($row['FechaSalida'] <= date('Y-m-d')) {
                $ingreso_empleado = $empleado->CalcularIngresos($row['sueldo'], $row['FechaIngreso'], $row['FechaSalida']);
            } else {
                $ingreso_empleado = $empleado->CalcularIngresos($row['sueldo'], $row['FechaIngreso'],  date('Y-m-d'));
            }
        }
        return $ingreso_empleado;
    }
    public function obtenerTotalingresoEmpleado($id_empleado)
    {
        $this->db->select('*');
        $this->db->from('empleado e');
        $this->db->join('contrato c', 'c.ID_empleado = e.ID_empleado');
        $this->db->where('e.ID_empleado', $id_empleado);
        $contrato_empleado = $this->db->get()->result_array();
        $empleado = new Empleado_funciones();
        $Total_ingreso = 0;
        foreach ($contrato_empleado as $row) {
            if ($row['FechaSalida'] <= date('Y-m-d')) {
                $Total_ingreso = $Total_ingreso + $empleado->TotalIngreso($row['sueldo'], $row['FechaIngreso'], $row['FechaSalida']);
            } else {
                $Total_ingreso = $Total_ingreso + $empleado->TotalIngreso($row['sueldo'], $row['FechaIngreso'],  date('Y-m-d'));
            }
        }
        return $Total_ingreso;
    }
    public function obtenerTotalegresoEmpleado($id_empleado)
    {
        $this->db->select_sum('p.Monto', 'Total_pagos');
        $this->db->from('empleado e');
        $this->db->join('contrato c', 'c.ID_empleado = e.ID_empleado');
        $this->db->join('pago p', 'p.ID_contrato = c.ID_contrato');
        $this->db->where('e.ID_empleado', $id_empleado);
        return $this->db->get()->row_array();
    }
}
