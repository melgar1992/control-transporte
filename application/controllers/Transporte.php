<?php
class Transporte extends BaseController
{
    function __construct()
    {
        parent::__construct();
    }
    public function transporte()
    {
        $datos['transportes'] = $this->Transporte_model->obtenerTransportes();
        $this->loadView('Transporte', '/form/transporte/transporte', $datos);
    }
}
