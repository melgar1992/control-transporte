<?php
class DashboardClientes extends BaseController
{

    function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $datos = [];
        $this->loadView('DashboardClientes', '/form/cliente/dashboard_clientes', $datos);
    }
}
