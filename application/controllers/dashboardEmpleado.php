<?php
class DashboardEmpleado extends BaseController
{

    function __construct()
    {
        parent::__construct();
    }

    public function index()
    {

        $datos['empleados'] = $this->Empleado_model->obtenerEmpleado();
        $datos['contratos'] = $this->Contrato_model->obtenerContratosEmpleadosActivos();
        $datos['Planilla_mensual'] = $this->Contrato_model->PlanillaMensual();
        $datos['pago'] = $this->pagoEmpleado_model->ObtenerPagosDelMesActual();

        $this->loadView('Dashboard_empleados', '/form/Dashboard/dashboard_empleados', $datos);
    }
    public function balanceEmpleado($ID_empleado)
    {
        $datos['empleado'] = $this->Empleado_model->idempleado($ID_empleado);
        $datos['pago_empleado'] = $this->Empleado_model->obtenerPagosEmpleado($ID_empleado);
        $datos['ingreso_empleado'] = $this->Empleado_model->obtenerIngresosEmpleado($ID_empleado);
        $datos['Total_ingresos'] = $this->Empleado_model->obtenerTotalingresoEmpleado($ID_empleado);
        $datos['Total_egresos'] = $this->Empleado_model->obtenerTotalegresoEmpleado($ID_empleado);
        $this->load->view('reportes/empleados/balance_empleados', $datos);
    }
}
