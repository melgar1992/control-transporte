<?php
class DashboardProveedores extends BaseController
{
    function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $datos['Proveedores'] = $this->Proveedor_model->obtenerProveedores();
        $this->loadView('DashboardProveedores', '/form/Dashboard/dashboard_proveedores', $datos);
    }
    public function reporteProveedorEntreFecha()
    {
        $ID_Proveedor = $this->input->post('ID_Proveedor');
        $fechaIni = $this->input->post('fechaIni');
        $fechaFin = $this->input->post('fechaFin');

        $datos['saldoAnterior'] = $this->Reportes_model->saldoAnteriorProveedor($ID_Proveedor, $fechaIni);
        $datos['detalleProveedorEntreFecha'] = $this->Reportes_model->obtenerDetalleProveedorEntreFechas($ID_Proveedor, $fechaIni, $fechaFin);
        echo json_encode($datos);

    }
}
