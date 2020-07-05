<?php
class Reportes_model extends CI_Model
{

    public function Balance_camiones_gestion_actual()
    {
        $this->db->select('sum(total) - sum(ActViaje) - sum(Diesel) as ingreso');
        $this->db->from('camion');
        $this->db->join('detalle_transporte_ganado', 'camion.ID_camion = detalle_transporte_ganado.ID_camion');
        $this->db->where('camion.ID_contrato !=', 'NULL');
        $this->db->where('detalle_transporte_ganado.Fecha >=', date('Y') . '-01-01');
        $ingreso_camion = $this->db->get()->row_array();

        $this->db->select_sum('ImporteTotal');
        $this->db->from('detalle_mantenimiento');
        $this->db->where('ID_camion !=', 'NULL');
        $this->db->where('Fecha >=', date('Y') . '-01-01');
        $egreso_camion = $this->db->get()->row_array();

        $balance = (float) $ingreso_camion['ingreso'] - (float) $egreso_camion['ImporteTotal'];
        return $balance;
    }
    public function ingreso_comisiones_gestion_actual()
    {
        $this->db->select_sum('ComisionProveedor', 'comision');
        $this->db->from('detalle_transporte_ganado');
        $this->db->where('Fecha >=', date('Y') . '-01-01');
        return $this->db->get()->row_array();
    }
    public function CuentasPorPagar()
    {
        $this->db->select('(sum(Debe) - sum(Haber)) as BalancePagos');
        $this->db->from('pago_cuentas');
        $this->db->where('ID_taller !=', 'NULL');
        $this->db->or_where('ID_proveedor !=', 'NULL');
        $BalancePagos = $this->db->get()->row_array();

        $this->db->select('sum(ImporteTotal) as Total');
        $this->db->from('detalle_mantenimiento');
        $this->db->where('Porpagar', 1);
        $GastosCamionesPropios = $this->db->get()->row_array();

        $this->db->select('(sum(TotalProveedor) - sum(ActViaje)) as BalanceTransporteProveedores');
        $this->db->from('detalle_transporte_ganado');
        $this->db->where('TotalProveedor !=', 'NULL');
        $BalanceTransporteProveedores = $this->db->get()->row_array();

        $CuentasPorPagar =  $BalancePagos['BalancePagos'] + $GastosCamionesPropios['Total'] + $BalanceTransporteProveedores['BalanceTransporteProveedores'];
        return $CuentasPorPagar;
    }
    public function CuentasPorCobrar()
    {
        $this->db->select('(sum(Debe) - sum(Haber)) as Balance');
        $this->db->from('pago_cuentas');
        $this->db->or_where('ID_Cliente !=', 'NULL');
        $BalancePagoCuentas = $this->db->get()->row_array();

        $this->db->select_sum('Total', 'IngresoTransporte');
        $this->db->from('transporte');
        $this->db->where('Estado', 'Activo');
        $IngresoTrasnporte = $this->db->get()->row_array();

        $Balance = $BalancePagoCuentas['Balance'] + $IngresoTrasnporte['IngresoTransporte'];
        return (float) $Balance;
    }
    public function BalanceCuentasEmpresa()
    {
        $this->db->select('(sum(Haber) - sum(Debe)) as BalanceCuenta');
        $this->db->from('pago_cuentas');
        $this->db->where('ID_cuenta_empresa !=', 'NULL');
        $BalanceCuentas = $this->db->get()->row_array();
        return (float) $BalanceCuentas['BalanceCuenta'];
    }
    public function obtenerDetalleBalanceClientes()
    {
        $this->db->select('b.ID_cliente, b.Nombre, b.Apellidos, (b.transporte + b.Balancepago) as balance');
        $this->db->from('balance_cliente b');
        return $this->db->get()->result_array();
    }
    public function obtenerDetalleBalanceProveedores()
    {
        $this->db->select('ID_proveedor, CI, Nombres, Apellidos, Telefono_01, Telefono_02, (CuentasPagar + Transporte) as balance');
        $this->db->from('balance_proveedores');
        return $this->db->get()->result_array();
    }
    public function obtenerDetalleBalanceTaller()
    {
        $this->db->select('ID_taller, NombreTaller, Departamento, (CuentasPagar + GastosMantenimiento) as balance');
        $this->db->from('balance_taller');
        return $this->db->get()->result_array();
    }
    public function obtenerAnosTrasnporte()
    {
        $this->db->select('YEAR(Fecha) as year');
        $this->db->from('transporte');
        $this->db->group_by('year');
        $this->db->order_by('year', 'DESC');
        return $this->db->get()->result_array();
    }
    public function MovimientoGeneralTransportePorMes($year)
    {
        $TrasnporteTotal = array(
            0 => 0,
            1 => 0,
            2 => 0,
            3 => 0,
            4 => 0,
            5 => 0,
            6 => 0,
            7 => 0,
            8 => 0,
            9 => 0,
            10 => 0,
            11 => 0,
        );
        $this->db->select('sum(Total) as Total, month(Fecha) as mes');
        $this->db->from('transporte');
        $this->db->where('Fecha >=', $year . '-01-01');
        $this->db->where('Fecha <=', $year . '-12-31');
        $this->db->where('Estado', 'Activo');
        $this->db->group_by('mes');
        $resultado = $this->db->get()->result_array();
        foreach ($resultado as $row) {

            $TrasnporteTotal[(int) $row['mes'] - 1] = (float) $row['Total'];
        }

        return $TrasnporteTotal;
    }
    public function MovimientoGeneralTransporteCamionesEmpresa($year)
    {
        $TrasnporteTotal = array(
            0 => 0,
            1 => 0,
            2 => 0,
            3 => 0,
            4 => 0,
            5 => 0,
            6 => 0,
            7 => 0,
            8 => 0,
            9 => 0,
            10 => 0,
            11 => 0,
        );
        $this->db->select('sum(Total) as Total, month(Fecha) as mes');
        $this->db->from('detalle_transporte_ganado dt');
        $this->db->join('camion c', 'c.ID_camion = dt.ID_camion');
        $this->db->where('c.ID_contrato !=', 'NULL');
        $this->db->where('Fecha >=', $year . '-01-01');
        $this->db->where('Fecha <=', $year . '-12-31');
        $this->db->group_by('mes');

        $resultado = $this->db->get()->result_array();
        foreach ($resultado as $row) {
            $TrasnporteTotal[(int) $row['mes'] - 1] = (float) $row['Total'];
        }

        return $TrasnporteTotal;
    }
    public function obtenerDetalleCliente($ID_Cliente)
    {
        $this->db->select('*');
        $this->db->from('detallecliente');
        $this->db->where('ID_Cliente', $ID_Cliente);
        $this->db->order_by('fecha');
        return $this->db->get()->result_array();
    }
    public function obtenerDetalleProveedor($ID_proveedor)
    {
        $this->db->select('*');
        $this->db->from('detalleproveedor');
        $this->db->where('ID_proveedor', $ID_proveedor);
        $this->db->order_by('fecha');
        return $this->db->get()->result_array();
    }
    public function obtenerDetalleTaller($ID_taller)
    {
        $this->db->select('*');
        $this->db->from('detalletaller');
        $this->db->where('ID_taller', $ID_taller);
        $this->db->order_by('Fecha');
        return $this->db->get()->result_array();
    }
    public function obtenerDetalleCamion($ID_camion, $fechaIni, $fechaFin)
    {
        $this->db->select('dc.*, t.Descripcion as TransporteDescripcion');
        $this->db->from('detalle_camiones_propio dc');
        $this->db->join('transporte t', 't.ID_transporte = dc.ID_transporte', 'left');
        $this->db->where('dc.Fecha >=', $fechaIni);
        $this->db->where('dc.Fecha <=', $fechaFin);
        $this->db->where('dc.ID_camion', $ID_camion);
        $this->db->order_by('dc.Fecha');
        return $this->db->get()->result_array();
    }
    public function obtenerTop5GastosCamionEmpresa($ID_camion, $fechaIni, $fechaFin)
    {
   
        $this->db->select('coalesce(c.nombre, "Gastos de transporte" ) as Categoria  ,sum(egreso) as Egreso');
        $this->db->from('detalle_camiones_propio dc');
        $this->db->join('categoria_mantenimiento c', 'dc.ID_categoria_mantenimiento = c.ID_categoria_mantenimiento', 'left');
        $this->db->where('dc.Fecha >=', $fechaIni);
        $this->db->where('dc.Fecha <=', $fechaFin);
        $this->db->where('dc.ID_camion', $ID_camion);
        $this->db->group_by('c.nombre');
        $this->db->order_by('Egreso','DESC');
        $this->db->limit(4);
        $datos = $this->db->get()->result_array();

        $this->db->select('sum(egreso) as Egreso_total');
        $this->db->from('detalle_camiones_propio dc');
        $this->db->where('dc.Fecha >=', $fechaIni);
        $this->db->where('dc.Fecha <=', $fechaFin);
        $this->db->where('dc.ID_camion', $ID_camion);
        $totalGastos = $this->db->get()->row_array();
        $saldoGastos = $totalGastos['Egreso_total'];
        foreach ($datos as $row) {
            $saldoGastos = $saldoGastos - $row['Egreso'];
        }
        $datos[] = array(
            'Categoria' => 'Otros gastos',
            'Egreso' => $saldoGastos,

        );
        return $datos;

    }
}
