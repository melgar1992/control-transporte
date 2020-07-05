<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Inicio extends BaseController
{
	function __construct()
	{
		parent::__construct();
	}



	public function login()
	{
		$this->load->view('login');
	}

	public function index()
	{
		$datos['balance_camiones'] = $this->Reportes_model->Balance_camiones_gestion_actual();
		$datos['comision'] = $this->Reportes_model->ingreso_comisiones_gestion_actual();
		$datos['CuentasPorPagar'] = $this->Reportes_model->CuentasPorPagar();
		$datos['CuentasPorCobrar'] = $this->Reportes_model->CuentasPorCobrar();
		$datos['BalanceCuentas'] = $this->Reportes_model->BalanceCuentasEmpresa();
		$datos['Balance'] = (float) $datos['BalanceCuentas'] + (float) $datos['CuentasPorCobrar'] - (float) $datos['CuentasPorPagar'];
		$datos['DetalleBalanceCliente'] = $this->Reportes_model->obtenerDetalleBalanceClientes();
		$datos['DetalleBalanceProveedores'] = $this->Reportes_model->obtenerDetalleBalanceProveedores();
		$datos['DetalleBalanceTaller'] = $this->Reportes_model->obtenerDetalleBalanceTaller();
		$datos['year'] = $this->Reportes_model->obtenerAnosTrasnporte();
		$datos['camiones'] = $this->Camion_model->obtenerCamionesPropios();
		$this->loadView('inicio', 'inicio', $datos);
	}
	public function graficoMovimiento()
	{
		$year = $this->input->post('year');
		$datos['MovimientoGeneralTransportePorMes'] = $this->Reportes_model->MovimientoGeneralTransportePorMes($year);
		$datos['MovimientoGeneralTransporteCamionesEmpresa'] = $this->Reportes_model->MovimientoGeneralTransporteCamionesEmpresa($year);

		echo json_encode($datos);
	}
	public function detalleCliente($ID_Cliente)
	{
		$datos['detalleCliente'] = $this->Reportes_model->obtenerDetalleCliente($ID_Cliente);
		$datos['Cliente'] = $this->Cliente_model->obtenerCliente($ID_Cliente);
		$this->load->view('reportes/clientes/detalle_cliente',$datos);
	}
	public function detalleProveedor($ID_proveedor)
	{
		$datos['detalleProveedor'] = $this->Reportes_model->obtenerDetalleProveedor($ID_proveedor);
		$datos['Proveedor'] = $this->Proveedor_model->obtenerProveedor($ID_proveedor);
		$this->load->view('reportes/proveedores/detalle_proveedor',$datos);
	}
	public function detalleTaller($ID_taller)
	{
		$datos['detalleTaller'] = $this->Reportes_model->obtenerDetalleTaller($ID_taller);
		$datos['Taller'] = $this->Taller_model->obtenerTaller($ID_taller);
		$this->load->view('reportes/talleres/detalle_taller',$datos);
	}
	public function detalleCamionEmpresa()
	{
		$ID_camion = $this->input->post('ID_camion');
		$fechaIni = $this->input->post('fechaIni');
		$fechaFin = $this->input->post('fechaFin');
		$datos['detalleCamionEmpresa'] = $this->Reportes_model->obtenerDetalleCamion($ID_camion, $fechaIni, $fechaFin);
		$datos['top5Gastos'] = $this->Reportes_model->obtenerTop5GastosCamionEmpresa($ID_camion, $fechaIni, $fechaFin);
		echo json_encode($datos);
	}
}
