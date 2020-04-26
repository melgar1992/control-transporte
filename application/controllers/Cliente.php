<?php
class Cliente extends BaseController
{

    function __construct()
    {
        parent::__construct();
    }

    public function clientes()
    {
        $datos['clientes'] = $this->Cliente_model->obtenerClientes();
        $this->loadView('CamionPropio', '/form/cliente/nuevo_cliente', $datos);
    }
}