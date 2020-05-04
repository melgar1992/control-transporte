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
        $this->loadView('Transporte', '/form/transporte/nuevo_transporte', $datos);
    }
    public function editarTransporte($ID_transporte)
    {
        $datos['predios'] = $this->Predio_model->obtenerPredios();
        $datos['Clientes'] = $this->Cliente_model->obtenerClientes();
        $datos['camionesProveedor'] = $this->Camion_model->obtenerCamionesProveedor();
        $datos['camionesPropios'] = $this->Camion_model->obtenerCamionesPropios();
        $datos['transporte'] = $this->Transporte_model->obtenerTransporte($ID_transporte);
        $datos['detalle_transporte'] = $this->Transporte_model->obtenerDetalleTransporte($ID_transporte);
        $this->loadView('Transporte', '/form/transporte/editar_transporte', $datos);
    }
    public function guardarTransporte()
    {
        //input para la tabla de Transporte
        $ID_predio_origen = $this->input->post('ID_predio_origen');
        $ID_predio_destino = $this->input->post('ID_predio_destino');
        $ID_Cliente = $this->input->post('ID_Cliente');
        $Fecha = $this->input->post('Fecha');
        $Distancia = $this->input->post('Distancia');
        $Descripcion = $this->input->post('Descripcion_transporte');
        $SubTotal = $this->input->post('SubTotal');
        $comisionTotal = $this->input->post('ComisionTotal');
        $DescuentoTotal = $this->input->post('DescuentoTotal');
        $Total = $this->input->post('Total');
        $ID_user = $this->session->userdata['logged_in']['ID_user'];

        //Datos para el detalle de Detalle de transporte

        $ID_camion = $this->input->post('ID_camion');
        $ActViaje = $this->input->post('ActViaje');
        $Diesel = $this->input->post('Diesel');
        $PrecioProveedor = $this->input->post('PrecioProveedor');
        $Precio = $this->input->post('Precio');
        $Cantidad = $this->input->post('Cantidad');
        $Comision = $this->input->post('Comision');
        $Descuento = $this->input->post('Descuento');
        $TotalDetalle = $this->input->post('TotalDetalle');


        $this->form_validation->set_rules('ID_predio_origen', 'Predio de donde se carga', 'required');
        $this->form_validation->set_rules('ID_predio_destino', 'Predio destino donde se descarga', 'required');
        $this->form_validation->set_rules('ID_Cliente', 'Cliente que solicita el sercivio', 'required');
        $this->form_validation->set_rules('Fecha', 'Fecha cuando se realiza el servicio', 'required');
        if ($this->form_validation->run()) {
            // se preparan los datos de transporte
            $Datos_transporte = array(
                'ID_user' => $ID_user,
                'ID_predio_origen' => $ID_predio_origen,
                'ID_predio_destino' => $ID_predio_destino,
                'ID_Cliente' => $ID_Cliente,
                'Fecha' => $Fecha,
                'Descripcion' => $Descripcion,
                'Distancia' => $Distancia,
                'SubTotal' => $SubTotal,
                'comisionTotal' => $comisionTotal,
                'DescuentoTotal' => $DescuentoTotal,
                'Total' => $Total,
                'Estado' => 'Activo',
            );
            $ID_transporte = $this->Transporte_model->guardarTransporte($Datos_transporte);
            if (isset($ID_transporte)) {

                $this->guardarDetalleTransporte($ID_transporte, $Distancia, $Fecha, $ID_camion, $ActViaje, $Diesel, $PrecioProveedor, $Precio, $Cantidad, $Comision, $Descuento, $TotalDetalle);
                redirect(site_url() . '/Transporte/transporte');
            } else {
                $this->session->set_flashdata('error', 'Ocurrio un error al ingresar los datos del transporte!');
                redirect(site_url() . '/Transporte/nuevoTransporte');
            }
        } else {
            $this->session->set_flashdata('error', 'Tiene que llenar los datos correctamente');
            redirect(site_url() . '/Transporte/nuevoTransporte');
        }
    }
    private function guardarDetalleTransporte($ID_transporte, $Distancia, $Fecha, $ID_camion, $ActViaje, $Diesel, $PrecioProveedor, $Precio, $Cantidad, $Comision, $Descuento, $Total)
    {
        if (isset($ID_camion)) {
            for ($i = 0; $i < count($ID_camion); $i++) {
                $camion_propio = $this->Camion_model->obtenerCamionPropio($ID_camion[$i]);
                if (isset($camion_propio)) {
                    $kilometraje = intval($camion_propio['Kilometraje']) + intval($Distancia);
                    $this->Camion_model->actualizarKilometraje($camion_propio['ID_camion'], $kilometraje);
                    $data = array(
                        'ID_transporte' => $ID_transporte,
                        'Fecha' => $Fecha,
                        'ID_camion' => $ID_camion[$i],
                        'ActViaje' => $ActViaje[$i],
                        'Diesel' => $Diesel[$i],
                        'PrecioProveedor' => $PrecioProveedor[$i],
                        'Precio' => $Precio[$i],
                        'Cantidad' => $Cantidad[$i],
                        'Comision' => $Comision[$i],
                        'Descuento' => $Descuento[$i],
                        'Total' => $Total[$i],
                    );
                    $this->Transporte_model->guardarDetalleTransporte($data);
                } else {
                    $data = array(
                        'ID_transporte' => $ID_transporte,
                        'Fecha' => $Fecha,
                        'ID_camion' => $ID_camion[$i],
                        'ActViaje' => $ActViaje[$i],
                        'Diesel' => $Diesel[$i],
                        'PrecioProveedor' => $PrecioProveedor[$i],
                        'Precio' => $Precio[$i],
                        'Cantidad' => $Cantidad[$i],
                        'Comision' => $Comision[$i],
                        'Descuento' => $Descuento[$i],
                        'Total' => $Total[$i],
                        'TotalProveedor' => (floatval($PrecioProveedor[$i]) * floatval($Cantidad[$i])) - floatval($Comision[$i]) - floatval($Descuento[$i]),
                    );
                    $this->Transporte_model->guardarDetalleTransporte($data);
                }
            }
        }
    }
}
