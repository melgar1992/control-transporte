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
    public function nuevoTransporte()
    {
        $datos['predios'] = $this->Predio_model->obtenerPredios();
        $datos['Clientes'] = $this->Cliente_model->obtenerClientes();
        $datos['camionesProveedor'] = $this->Camion_model->obtenerCamionesProveedor();
        $datos['camionesPropios'] = $this->Camion_model->obtenerCamionesPropios();
        $this->loadView('Transporte', '/form/transporte/nuevo_transporte',$datos);
    }
}
