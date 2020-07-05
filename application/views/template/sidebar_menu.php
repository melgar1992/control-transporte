            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                  <li><a><i class="fas fa-home"></i> Home <span class="fas fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?php echo site_url("Inicio") ?>"> Dashboard</a></li>
                      <li><a href=<?php echo site_url("DashboardEmpleado/index") ?>>Dashboard de empleados</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fas fa-edit"></i> Formularios de Empresa<span class="fas fa-chevron-down"></span></a>
                    <ul class="nav child_menu">

                      <li><a href="<?php echo site_url("Contrato/tipocontrato") ?>">Tipos de Contratos Empleado</a></li>
                      <li><a href="<?php echo site_url("Empleado/index") ?>">Empleados</a></li>
                      <li><a href="<?php echo site_url("ContratoEmpleado/ContratoEmpleado") ?>">Contrato Empleados</a></li>
                      <li><a href="<?php echo site_url("CuentaEmpresa/cuentaEmpresa") ?>">Cuentas y cajas de la empresa</a></li>

                    </ul>
                  </li>
                  <li><a><i class="fas fa-edit"></i> Formularios de Proveedores<span class="fas fa-chevron-down"></span></a>
                    <ul class="nav child_menu">

                      <li><a href="<?php echo site_url("Proveedor/inicio") ?>">Proveedores</a></li>

                    </ul>
                  </li>
                  <li><a><i class="fas fa-truck"></i>Camiones<span class="fas fa-chevron-down"></span></a>
                    <ul class="nav child_menu">

                      <li><a href="<?php echo site_url("Camion/camionesPropios") ?>">Camiones propios</a></li>
                      <li><a href="<?php echo site_url("Camion/camionesProveedor") ?>">Camiones proveedores</a></li>

                    </ul>
                  </li>
                  <li><a><i class="fas fa-wrench"></i> Mantenimiento camiones<span class="fas fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?php echo site_url("Taller/talleres") ?>">Cuentas de camiones</a></li>
                      <li><a href="<?php echo site_url("Mantenimiento/mantenimientos") ?>">Mantenimiento</a></li>

                    </ul>
                  </li>
                  <li><a><i class="fas fa-group"></i> Clientes<span class="fas fa-chevron-down"></span></a>
                    <ul class="nav child_menu">

                      <li><a href="<?php echo site_url("Cliente/clientes") ?>">Clientes</a></li>
                      <li><a href="<?php echo site_url("Predio/predio") ?>">Predios</a></li>

                    </ul>
                  </li>
                  <li><a><i class="fas fa-truck"></i> Transporte<span class="fas fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?php echo site_url("Transporte/transporte") ?>">Movimientos</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fas fa-money"></i> Pagos<span class="fas fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?php echo site_url("Pago_cuentas/pagoClientes") ?>">Pago clientes</a></li>
                      <li><a href="<?php echo site_url("Pago_cuentas/pagoTalleres") ?>">Cuentas camiones</a></li>
                      <li><a href="<?php echo site_url("Pago_cuentas/pagoProveedores") ?>">Proveedores camiones</a></li>
                      <li><a href="<?php echo site_url("PagoEmpleados/pagoEmpleado") ?>">Pago empleados</a></li>
                      <li><a href="<?php echo site_url("Pago_cuentas/movimientoCajaEmpresa") ?>">Movimiento cuenta empresa</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fas fa-gears"></i> Configuracion de sistema<span class="fas fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?php echo site_url("Usuario/usuario") ?>">Administracion de usuarios</a></li>
                    </ul>
                  </li>
              </div>

            </div>
            <!-- /sidebar menu -->
            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Logout" href="<?php echo site_url("BaseController/logout") ?>">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
            <!-- /menu footer buttons -->
            </div>
            </div>

            <!-- top navigation -->
            <div class="top_nav">
              <div class="nav_menu">
                <nav>
                  <div class="nav toggle">
                    <a id="menu_toggle"><i class="fas fa-bars"></i></a>
                  </div>

                  <ul class="nav navbar-nav navbar-right">
                    <li class="">
                      <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        <img src="<?php
                                  if (isset($this->session->userdata['logged_in'])) {
                                    img($this->session->userdata['logged_in']['url_img']);
                                  } ?>" alt=""><?php
                                                if (isset($this->session->userdata['logged_in'])) {
                                                  echo  $this->session->userdata['logged_in']['username'];
                                                }
                                                ?>
                        <span class=" fa fa-angle-down"></span>
                      </a>
                      <ul class="dropdown-menu dropdown-usermenu pull-right">
                        <li><a href="<?php echo site_url("BaseController/logout") ?>"><i class="fas fa-sign-out pull-right"></i> Log Out</a></li>
                      </ul>
                    </li>

                  </ul>
                </nav>
              </div>
            </div>
            <!-- /top navigation -->