            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                  <li><a><i class="fas fa-home"></i> Home <span class="fas fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?php echo site_url("Inicio") ?>"> Dashboard</a></li>
                      <li><a href=<?php echo site_url("dashboardEmpleado/index") ?>>Dashboard de empleados</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fas fa-edit"></i> Formularios de Empleados<span class="fas fa-chevron-down"></span></a>
                    <ul class="nav child_menu">

                      <li><a href="<?php echo site_url("Empleado/index") ?>">Empleados</a></li>
                      <li><a href="<?php echo site_url("Contrato/tipocontrato") ?>">Tipos de Contratos Empleado</a></li>
                      <li><a href="<?php echo site_url("ContratoEmpleado/ContratoEmpleado") ?>">Contrato Empleados</a></li>
                      <li><a href="<?php echo site_url("pagoEmpleados/pagoEmpleado") ?>">Pago Empleados</a></li>

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
                      <li><a href="<?php echo site_url("Taller/talleres") ?>">Taller o ferreteria</a></li>
                      <li><a href="<?php echo site_url("Mantenimiento/mantenimientos") ?>">Mantenimiento</a></li>

                    </ul>
                  </li>
                  <li><a><i class="fas fa-group"></i> Clientes<span class="fas fa-chevron-down"></span></a>
                    <ul class="nav child_menu">

                      <li><a href="<?php echo site_url("Cliente/clientes") ?>">Clientes</a></li>
                      <li><a href="<?php echo site_url("") ?>">Predios</a></li>

                    </ul>
                  </li>

                  <li><a><i class="far fa-chart-bar"></i> Reportes <span class="fas fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="chartjs.html">Chart JS</a></li>
                      <li><a href="chartjs2.html">Chart JS2</a></li>
                      <li><a href="morisjs.html">Moris JS</a></li>
                      <li><a href="echarts.html">ECharts</a></li>
                      <li><a href="other_charts.html">Other Charts</a></li>
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
                        <li><a href="javascript:;"> Profile</a></li>
                        <li>
                          <a href="javascript:;">
                            <span class="badge bg-red pull-right">50%</span>
                            <span>Settings</span>
                          </a>
                        </li>
                        <li><a href="javascript:;">Help</a></li>
                        <li><a href="<?php echo site_url("BaseController/logout") ?>"><i class="fas fa-sign-out pull-right"></i> Log Out</a></li>
                      </ul>
                    </li>

                  </ul>
                </nav>
              </div>
            </div>
            <!-- /top navigation -->