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
        $datos['categorias_mantenimientos'] = $this->Mantenimiento_model->obtenerCategoriasMantenimientos();
        $this->loadView('Mantenimiento', '/form/mantenimiento/nuevo_mantenimiento', $datos);
    }
    public function editarMantenimiento($ID_mantenimiento)
    {
        $datos['empleados'] = $this->Empleado_model->obtenerEmpleado();
        $datos['camiones'] = $this->Camion_model->obtenerCamionesPropios();
        $datos['talleres'] = $this->Taller_model->getTalleres();
        $datos['categorias_mantenimientos'] = $this->Mantenimiento_model->obtenerCategoriasMantenimientos();
        $datos['mantenimiento'] = $this->Mantenimiento_model->obtenerMantenimiento($ID_mantenimiento);
        $datos['detalle_mantenimientos'] = $this->Mantenimiento_model->obtenerDetalleMantenimiento($ID_mantenimiento);
        $this->loadView('Mantenimiento', '/form/mantenimiento/editar_mantenimiento', $datos);
    }
    public function guardarMantenimiento()
    {
        //input para la tabla de mantenimiento
        $ID_empleado = $this->input->post('ID_empleado');
        $Fecha_mantenimiento = $this->input->post('Fecha_mantenimiento');
        $Descripcion_mantenimiento = $this->input->post('Descripcion_mantenimiento');
        $MontoTotal = $this->input->post('total');
        $ID_user = $this->session->userdata['logged_in']['ID_user'];

        //Datos para el detalle de mantenimiento

        $Fecha = $this->input->post('Fecha');
        $ID_taller = $this->input->post('ID_taller');
        $ID_categoria_mantenimiento = $this->input->post('ID_categoria_mantenimiento');
        $ID_camion = $this->input->post('ID_camion');
        $Porpagar = $this->input->post('Porpagar');
        $Descripcion = $this->input->post('Descripcion');
        $PrecioUnitario = $this->input->post('PrecioUnitario');
        $Cantidad = $this->input->post('Cantidad');
        $ImporteTotal = $this->input->post('ImporteTotal');


        $this->form_validation->set_rules('Fecha_mantenimiento', 'Fecha de ingreso del mantenimiento', 'required');
        $this->form_validation->set_rules('ID_empleado', 'ID_empleado del empleado responsable de los gastos', 'required');
        $this->form_validation->set_rules('Descripcion_mantenimiento', 'Descripcion del mantenimiento', 'required');
        if ($this->form_validation->run()) {
            // se preparan los datos
            $datos_mantenimiento = array(
                'ID_user' => $ID_user,
                'ID_empleado' => $ID_empleado,
                'Fecha_mantenimiento' => $Fecha_mantenimiento,
                'Descripcion' => $Descripcion_mantenimiento,
                'MontoTotal' => $MontoTotal,
                'Estado' => 'Activo',
            );
            $ID_mantenimiento = $this->Mantenimiento_model->guardarMantenimiento($datos_mantenimiento);
            if (isset($ID_mantenimiento)) {

                $this->guardarDetalleMantenimiento($ID_mantenimiento, $ID_taller, $ID_categoria_mantenimiento, $ID_camion, $Porpagar, $Fecha, $Descripcion, $PrecioUnitario, $Cantidad, $ImporteTotal);
                redirect(site_url() . '/Mantenimiento/mantenimientos');
            } else {
                $this->session->set_flashdata('error', 'Ocurrio un error al ingresar los datos del mantenimiento!');
                redirect(site_url() . '/Mantenimiento/nuevoMantenimiento');
            }
        } else {
            $this->session->set_flashdata('error', 'Tiene que llenar los datos correctamente');
            redirect(site_url() . '/Mantenimiento/nuevoMantenimiento');
        }
    }
    public function guardarDetalleMantenimiento($ID_mantenimiento, $ID_taller, $ID_categoria_mantenimiento, $ID_camion, $Porpagar, $Fecha, $Descripcion, $PrecioUnitario, $Cantidad, $ImporteTotal)
    {
        for ($i = 0; $i < count($ID_categoria_mantenimiento); $i++) {
            $camion_actual = $this->Camion_model->obtenerCamionPropio($ID_camion[$i]);
            if (isset($camion_actual)) {
                $data = array(
                    'ID_mantenimiento' => $ID_mantenimiento,
                    'ID_taller' => $ID_taller[$i],
                    'ID_categoria_mantenimiento' => $ID_categoria_mantenimiento[$i],
                    'ID_camion' => $ID_camion[$i],
                    'Porpagar' => $Porpagar[$i],
                    'Fecha' => $Fecha[$i],
                    'Descripcion' => $Descripcion[$i],
                    'PrecioUnitario' => $PrecioUnitario[$i],
                    'Cantidad' => $Cantidad[$i],
                    'ImporteTotal' => $ImporteTotal[$i],
                    'Kilometraje' => $camion_actual['Kilometraje'],
                    'Placa' => $camion_actual['N_Placa'],
                );
                $this->Mantenimiento_model->guardarDetalleMantenimiento($data);
               
            } else {
                $data = array(
                    'ID_mantenimiento' => $ID_mantenimiento,
                    'ID_taller' => $ID_taller[$i],
                    'ID_categoria_mantenimiento' => $ID_categoria_mantenimiento[$i],
                    'ID_camion' => $ID_camion[$i],
                    'Porpagar' => $Porpagar[$i],
                    'Fecha' => $Fecha[$i],
                    'Descripcion' => $Descripcion[$i],
                    'PrecioUnitario' => $PrecioUnitario[$i],
                    'Cantidad' => $Cantidad[$i],
                    'ImporteTotal' => $ImporteTotal[$i],
                    'Kilometraje' => '0',
                    'Placa' => '',
                );
                $this->Mantenimiento_model->guardarDetalleMantenimiento($data);
               
            }
        }
    }
}
