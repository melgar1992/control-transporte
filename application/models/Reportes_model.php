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

        if (date('Y') == 2020) {
            $this->db->select_sum('Monto', 'PagoSueldos');
            $this->db->from('contrato c');
            $this->db->join('pago p', 'p.ID_contrato = c.ID_contrato');
            $this->db->where('c.ID_camion !=', 'NULL');
            $this->db->where('p.Fecha >=', '2020-05-01');
            $egreso_sueldo = $this->db->get()->row_array();
        } else {
            $this->db->select_sum('Monto', 'PagoSueldos');
            $this->db->from('contrato c');
            $this->db->join('pago p', 'p.ID_contrato = c.ID_contrato');
            $this->db->where('c.ID_camion !=', 'NULL');
            $this->db->where('p.Fecha >=', date('Y') . '-01-01');
            $egreso_sueldo = $this->db->get()->row_array();
        }
        $balance = (float) $ingreso_camion['ingreso'] - (float) $egreso_camion['ImporteTotal'] - (float)$egreso_sueldo['PagoSueldos'];
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
        $this->db->select('dc.ID_transporte, dc.fecha,
        (select NombrePredio  from transporte t join predio p on p.ID_predio = t.ID_predio_origen where t.ID_transporte = dc.ID_transporte ) as Origen,
        (select NombrePredio from transporte t join predio p on p.ID_predio = t.ID_predio_destino where t.ID_transporte = dc.ID_transporte ) as Destino,
        (select count(Cantidad) from transporte t join detalle_transporte_ganado dt on dt.ID_transporte = t.ID_transporte where t.ID_transporte = dc.ID_transporte ) as Camiones,
        (select sum(Descuento) from transporte t join detalle_transporte_ganado dt on dt.ID_transporte = t.ID_transporte where t.ID_transporte = dc.ID_transporte  ) as Descuento,
         dc.Descripcion, dc.Debe, dc.Haber');
        $this->db->from('detallecliente dc');
        $this->db->where('dc.ID_Cliente', $ID_Cliente);
        $this->db->order_by('fecha');
        return $this->db->get()->result_array();
    }
    public function obtenerTransporteCliente($ID_Cliente)
    {
        $detalleTrasportes = [];
        $this->db->select('dc.*');
        $this->db->from('detallecliente dc');
        $this->db->where('dc.ID_cliente', $ID_Cliente);
        $this->db->where('ID_transporte !=', 'NULL');
        $this->db->order_by('fecha', 'DESC');
        $detalleTrasportes = $this->db->get()->result_array();

        for ($i = 0; $i < count($detalleTrasportes); $i++) {
            $detalleTrasportes[$i]['transporte'] = $this->Transporte_model->obtenerTransporte($detalleTrasportes[$i]['ID_transporte']);
            $detalleTrasportes[$i]['detalle_transporte'] = $this->Transporte_model->obtenerDetalleTransporte($detalleTrasportes[$i]['ID_transporte']);
        }
        return $detalleTrasportes;
    }
    public function obtenerDetalleProveedor($ID_proveedor)
    {
        $this->db->select('dp.*, c.N_Placa');
        $this->db->from('detalleproveedor dp');
        $this->db->join('camion c', 'c.ID_camion = dp.ID_camion', 'left');
        $this->db->where('dp.ID_proveedor', $ID_proveedor);
        $this->db->order_by('fecha');
        return $this->db->get()->result_array();
    }
    public function rankingProveedores($year)
    {
        $this->db->select("dp.ID_proveedor,p.Nombres, p.Apellidos, p.Telefono_01, 
        sum(dp.Ingreso) as servicios");
        $this->db->from("detalleProveedor dp");
        $this->db->join("proveedor p", "dp.ID_proveedor = p.ID_proveedor");
        $this->db->where("dp.ID_transporte !=", "NULL");
        $this->db->where('Fecha >=',  $year . '-01-01');
        $this->db->where('Fecha <=',  $year . '-12-31');
        $this->db->group_by('dp.ID_proveedor');
        $this->db->order_by('servicios', 'DESC');

        $rankingProveedores = $this->db->get()->result_array();

        return $rankingProveedores;
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

        $this->db->select('dc.Nombre_categoria as Categoria,sum(egreso) as Egreso');
        $this->db->from('detalle_camiones_propio dc');
        $this->db->where('dc.Fecha >=', $fechaIni);
        $this->db->where('dc.Fecha <=', $fechaFin);
        $this->db->where('dc.ID_camion', $ID_camion);
        $this->db->group_by('dc.Nombre_categoria');
        $this->db->order_by('Egreso', 'DESC');
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
    public function obtenerServiciosCliente($ID_Cliente)
    {
        $this->db->select('dc.fecha, dc.Descripcion, dc.Debe, dc.Haber,
        (select NombrePredio  from transporte t join predio p on p.ID_predio = t.ID_predio_origen where t.ID_transporte = dc.ID_transporte ) as Origen,
        (select NombrePredio from transporte t join predio p on p.ID_predio = t.ID_predio_destino where t.ID_transporte = dc.ID_transporte ) as Destino,
        (select count(Cantidad) from transporte t join detalle_transporte_ganado dt on dt.ID_transporte = t.ID_transporte where t.ID_transporte = dc.ID_transporte ) as Camiones,
        (select sum(Descuento) from transporte t join detalle_transporte_ganado dt on dt.ID_transporte = t.ID_transporte where t.ID_transporte = dc.ID_transporte  ) as Descuento');
        $this->db->from('detallecliente dc');
        $this->db->where('dc.ID_Cliente', $ID_Cliente);
        $this->db->where('dc.Debe >', 0);
        $this->db->order_by('fecha');
        return $this->db->get()->result_array();
    }
    public function obtenerKilometrajeUltimoCambioAceite($ID_camion, $fechaIni, $fechaFin)
    {

        $this->db->select('t.Fecha, t.Distancia');
        $this->db->from('transporte t');
        $this->db->join('detalle_transporte_ganado dt', 't.ID_transporte = dt.ID_transporte');
        $this->db->join('camion c', 'dt.ID_camion = c.ID_camion');
        $this->db->where('dt.ID_camion', $ID_camion);
        $this->db->where('t.Fecha >=', $fechaIni);
        $this->db->where('t.Fecha <=', $fechaFin);
        $this->db->where('c.Propio', 1);
        $this->db->order_by('t.Fecha', 'DESC');

        $ViajesCamion = $this->db->get()->result_array();

        $this->db->select('Fecha, kilometraje');
        $this->db->from('detalle_camiones_propio');
        $this->db->where('ID_camion', $ID_camion);
        $this->db->where('Nombre_categoria', 'Cambio aceite');
        $this->db->where('Fecha >=', $fechaIni);
        $this->db->where('Fecha <=', $fechaFin);
        $this->db->order_by('Fecha', 'DESC');
        $this->db->limit(1);

        $ultimoCambioAceite = $this->db->get()->row_array();

        $i = 0;
        $kilometrajeAcumulado = 0;
        $count = count($ViajesCamion) - 1;
        if (isset($ultimoCambioAceite['Fecha'])) {
            while ($ViajesCamion[$i]['Fecha'] > $ultimoCambioAceite['Fecha']) {
                $kilometrajeAcumulado = $kilometrajeAcumulado + $ViajesCamion[$i]['Distancia'];
                $i++;
                if ($i > $count) {
                    break;
                }
            }
        } else {
            $kilometrajeAcumulado = 'No se encontro cambio de aceite dentro de las fechas';
        }

        return $kilometrajeAcumulado;
    }
    public function balanceClienteEntreFechas($ID_Cliente, $fechaIni, $fechaFin)
    {
        $this->db->select("dc.ID_cliente, c.Nombre, c.Apellidos, c.CI, c.Direccion, 
        c.Telefono_01, c.Telefono_02, sum(dc.Debe) as egreso, 
        sum(dc.Haber) as ingreso, 
        (sum(dc.Debe) - sum(dc.Haber) ) as balance");
        $this->db->from("detallecliente dc");
        $this->db->join("cliente c", "dc.ID_cliente = c.ID_Cliente");
        $this->db->where("c.Estado", "Activo");
        $this->db->where("dc.ID_cliente", $ID_Cliente);
        $this->db->where('Fecha >=', $fechaIni);
        $this->db->where('Fecha <=', $fechaFin);

        $balanceClienteEntreFecha = $this->db->get()->result_array();

        return $balanceClienteEntreFecha;
    }
    public function clientesRanking($year)
    {
        $this->db->select("dc.ID_cliente, c.Nombre, c.Apellidos, c.CI, c.Direccion, 
        c.Telefono_01, c.Telefono_02, sum(dc.Debe) as servicios");
        $this->db->from("detallecliente dc");
        $this->db->join("cliente c", "dc.ID_cliente = c.ID_Cliente");
        $this->db->where("c.Estado", "Activo");
        $this->db->where('Fecha >=',  $year . '-01-01');
        $this->db->where('Fecha <=',  $year . '-12-31');
        $this->db->group_by('dc.ID_cliente');
        $this->db->order_by('servicios', 'DESC');

        $rankingClientes = $this->db->get()->result_array();

        return $rankingClientes;
    }
    public function clienteServiciosEntreFecha($ID_Cliente, $fechaIni, $fechaFin)
    {
        $this->db->select('dc.ID_transporte, dc.fecha,
        (select NombrePredio  from transporte t join predio p on p.ID_predio = t.ID_predio_origen where t.ID_transporte = dc.ID_transporte ) as Origen,
        (select NombrePredio from transporte t join predio p on p.ID_predio = t.ID_predio_destino where t.ID_transporte = dc.ID_transporte ) as Destino,
        (select count(Cantidad) from transporte t join detalle_transporte_ganado dt on dt.ID_transporte = t.ID_transporte where t.ID_transporte = dc.ID_transporte ) as Camiones,
        (select sum(Descuento) from transporte t join detalle_transporte_ganado dt on dt.ID_transporte = t.ID_transporte where t.ID_transporte = dc.ID_transporte  ) as Descuento,
         dc.Descripcion, dc.Debe, dc.Haber');
        $this->db->from('detallecliente dc');
        $this->db->where('dc.Debe >', 0);
        $this->db->where('dc.ID_Cliente', $ID_Cliente);
        $this->db->where('Fecha >=', $fechaIni);
        $this->db->where('Fecha <=', $fechaFin);
        $this->db->order_by('fecha');
        return $this->db->get()->result_array();
    }
    public function clientePagosEntreFecha($ID_Cliente, $fechaIni, $fechaFin)
    {
        $this->db->select('dc.fecha, dc.Descripcion, dc.Debe, dc.Haber');
        $this->db->from('detallecliente dc');
        $this->db->where('dc.ID_pago_cuentas !=', 'null');
        $this->db->where('dc.Debe =', 0);
        $this->db->where('dc.ID_Cliente', $ID_Cliente);
        $this->db->where('Fecha >=', $fechaIni);
        $this->db->where('Fecha <=', $fechaFin);
        $this->db->order_by('fecha');
        return $this->db->get()->result_array();
    }
    public function obtenerKilometrajeUltimoCambioAceiteCamiones()
    {
        $this->db->select("c.ID_camion, c.N_placa , 
        (select max(dc.Fecha) from detalle_camiones_propio dc where Nombre_categoria = 'Cambio aceite' and dc.ID_camion = c.ID_camion) as Fecha");
        $this->db->where('propio', '1');
        $this->db->from('camion c');
        $FechasCambioAceite = $this->db->get()->result_array();
        $fechaHoy = date('Y-m-d H:i:s');
        foreach ($FechasCambioAceite as $i => $FechaCambioAceite) {
            $kilometrajeAcumulado = $this->obtenerKilometrajeUltimoCambioAceite($FechaCambioAceite['ID_camion'], $FechaCambioAceite['Fecha'], $fechaHoy);
            $FechasCambioAceite[$i]['KmAcumulado'] = $kilometrajeAcumulado;
        }
        return $FechasCambioAceite;
    }
}
