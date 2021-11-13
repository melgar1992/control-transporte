<?php
class Calendario extends BaseController
{

    function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $datos[''] = '';
        $this->loadView('Calendario', '/calendario/calendario_view', $datos);
    }
   
}
