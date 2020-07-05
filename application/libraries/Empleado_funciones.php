<?php

class Empleado_funciones
{

    /**
     * @param Sueldo $Sueldo del empleado, durante el contrato
     * @param dateIngreso $FechaIngreso Ingreso el empleado
     * @param dateSalida $FechaSalida del empleado
     */
    function CalcularIngresos($sueldo, $FechaIngreso, $FechaSalida)
    {
        //Primero se obtienen los meses trabajados del empleado
        $fechainicio = new DateTime($FechaIngreso);
        $fechaFin = new DateTime($FechaSalida);
        $mesesTrabajados = $fechaFin->diff($fechainicio);
        $mesesTrabajados = ($mesesTrabajados->y * 12) + $mesesTrabajados->m;
        $IngresosEmpleado = array();
        $mesesTrabajadosAno = 1;
        // Se calcula todos los sueldos del empleado por los meses trabajados
        for ($i = 1; $i <= $mesesTrabajados; $i++) {
            $mesActual =  date("m", strtotime($FechaIngreso . "+ " . $i . " month"));
            if ($mesActual == '12') {
                $ano = date("Y", strtotime($FechaIngreso . "+ " . $i . " month"));
                global $IngresosEmpleado;
                $IngresosEmpleado[] = array(
                    'Fecha' =>  date("Y-m-d", strtotime($FechaIngreso . "+ " . $i . " month")),
                    'Descripcion' => 'Sueldo y salario',
                    'Monto' => (float) $sueldo,
                );
                $IngresosEmpleado[] = array(
                    'Fecha' =>  date("Y-m-d", strtotime($FechaIngreso . "+ " . $i . " month")),
                    'Descripcion' => 'Finiquito del año',
                    'Monto' => Finiquito($sueldo, $mesesTrabajadosAno),
                );
                $IngresosEmpleado[] = array(
                    'Fecha' =>  date("Y-m-d", strtotime($FechaIngreso . "+ " . $i . " month")),
                    'Descripcion' => 'Aguinaldo del año',
                    'Monto' => Aguinaldo($sueldo, $ano, $mesesTrabajadosAno),
                );
                $mesesTrabajadosAno = 0;
            } else {
                global $IngresosEmpleado;
                $IngresosEmpleado[] = array(
                    'Fecha' =>  date("Y-m-d", strtotime($FechaIngreso . "+ " . $i . " month")),
                    'Descripcion' => 'Sueldo y salario',
                    'Monto' => (float) $sueldo,
                );
            }
            $mesesTrabajadosAno = $mesesTrabajadosAno + 1;
        }
        return $IngresosEmpleado;
    }
    public function TotalIngreso($sueldo, $FechaIngreso, $FechaSalida)
    {
        //Primero se obtienen los meses trabajados del empleado
        $fechainicio = new DateTime($FechaIngreso);
        $fechaFin = new DateTime($FechaSalida);
        $mesesTrabajados = $fechaFin->diff($fechainicio);
        $mesesTrabajados = ($mesesTrabajados->y * 12) + $mesesTrabajados->m;
        $mesesTrabajadosAno = 1;
        $total = 0;
        // Se calcula todos los sueldos del empleado por los meses trabajados
        for ($i = 1; $i <= $mesesTrabajados; $i++) {
            $mesActual =  date("m", strtotime($FechaIngreso . "+ " . $i . " month"));
            if ($mesActual == '12') {
                $ano = date("Y", strtotime($FechaIngreso . "+ " . $i . " month"));

                $total = $total + (float) $sueldo;
                $Finiquito = Finiquito($sueldo, $mesesTrabajadosAno);
                $total = $total + $Finiquito;
                $aguinaldo = Aguinaldo($sueldo, $ano, $mesesTrabajadosAno);
                $total = $total + $aguinaldo;
                $mesesTrabajadosAno = 0;
            } else {
                $total = $total + (float) $sueldo;
            }
            $mesesTrabajadosAno = $mesesTrabajadosAno + 1;
        }
        return $total;
    }
}
/**
 * @param Sueldo $Sueldo del empleado, durante el contrato
 * @param ano $ano del pago del aguinaldo
 * @param mesesTrabajados $mesesTrabajados meses trabajados durante el ano
 */
function Aguinaldo($sueldo, $ano, $mesesTrabajados)
{
    if ($ano == '2018' || $ano == '2014' || $ano == '2015') {
        if ((int) $mesesTrabajados == 12) {
            $Aguinaldo = ((float) $sueldo) * 2;
        } else {
            $Aguinaldo = ((((float) $sueldo) / 12) * (int) $mesesTrabajados) * 2;
        }
    } else {
        if ((int) $mesesTrabajados == 12) {
            $Aguinaldo = ((float) $sueldo);
        } else {
            $Aguinaldo = (((float) $sueldo) / 12) * (int) $mesesTrabajados;
        }
    }
    return $Aguinaldo;
}
/**
 * @param Sueldo $Sueldo del empleado, durante el contrato
 * @param mesesTrabajados $mesesTrabajados meses trabajados durante el ano
 */
function Finiquito($sueldo, $mesesTrabajados)
{
    if ((int) $mesesTrabajados == 12) {
        $Finiquito = ((float) $sueldo);
    } else {
        $Finiquito = ((((float) $sueldo) / 12) * (int) $mesesTrabajados);
    }
    return $Finiquito;
}
