<?php
class DashboardTaller extends BaseController
{
    function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $datos['talleres'] = $this->Taller_model->getTalleres();
        $this->loadView('DashboardTaller', '/form/mantenimiento/dashboard_taller', $datos);
    }
    public function reporteTallerEntreFechas()
    {
        $ID_taller = $this->input->post('ID_taller');
        $fechaIni = $this->input->post('fechaIni');
        $fechaFin = $this->input->post('fechaFin');
        $datos['balanceTaller'] = $this->Reportes_model->saldoAnteriorTaller($ID_taller, $fechaIni);
        $datos['detalleTaller'] = $this->Reportes_model->obtenerDetalleTallerEntreFecha($ID_taller, $fechaIni, $fechaFin);

        echo json_encode($datos);

    }

}