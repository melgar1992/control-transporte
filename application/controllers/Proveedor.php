<?php
class Proveedor extends BaseController
{
    function __construct()
    {
        parent::__construct();
    }
    public function inicio()
    {
        $datos['proveedores'] = $this->Proveedor_model->obtenerProveedores();
        $this->loadView('Proveedor', '/form/proveedor/nuevo_proveedor', $datos);
    }
}
