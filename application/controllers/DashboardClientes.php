<?php
class DashboardClientes extends BaseController
{

    function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $datos['clientes'] = $this->Cliente_model->obtenerClientes();
        $this->loadView('DashboardClientes', '/form/cliente/dashboard_clientes', $datos);
    }
    public function reporteCliente()
    {
        $ID_Cliente = $this->input->post('ID_Cliente');
        $fechaIni = $this->input->post('fechaIni');
        $fechaFin = $this->input->post('fechaFin');
        $datos['saldoAnterior'] = $this->Reportes_model->SaldoAnteriorCliente($ID_Cliente,$fechaIni);
        $datos['clienteServiciosEntreFecha']= $this->Reportes_model->clienteServiciosEntreFecha($ID_Cliente,$fechaIni,$fechaFin);
        $datos['clientePagosEntreFecha']= $this->Reportes_model->clientePagosEntreFecha($ID_Cliente,$fechaIni,$fechaFin);
        echo json_encode($datos);
    }
}
