<?php
class Taller extends BaseController
{

    function __construct()
    {
        parent::__construct();
    }
    public function talleres()
    {
        $datos['Talleres'] = $this->Taller_model->getTalleres();
        $this->loadView('Taller', '/form/mantenimiento/nuevo_taller', $datos);

    }
}