<?php
class Mantenimiento extends BaseController
{

    function __construct()
    {
        parent::__construct();
    }
    public function mantenimientos()
    {
        $datos['mantenimientos'] = $this->Mantenimiento_model->obtenerMantenimientos();

        $this->loadView('Mantenimiento', '/form/mantenimiento/tablas_mantenimiento', $datos);
    }
    public function nuevoMantenimiento()
    {
        $datos['empleados'] = $this->Empleado_model->obtenerEmpleado();
        $datos['camiones'] = $this->Camion_model->obtenerCamionesPropios();
        $datos['talleres'] = $this->Taller_model->getTalleres();
        $datos['categorias_mantenimientos'] = $this->Mantenimiento_model->obtenrCategoriasMantenimientos();
        $this->loadView('Mantenimiento', '/form/mantenimiento/nuevo_mantenimiento', $datos);
    }
}
