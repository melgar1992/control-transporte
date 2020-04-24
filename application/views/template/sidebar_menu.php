            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                  <li><a><i class="fas fa-home"></i> Home <span class="fas fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?php echo site_url("Inicio") ?>">Dashboard</a></li>
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
                      <li><a href="<?php echo site_url("") ?>">Camiones proveedores</a></li>
                      <li><a href="<?php echo site_url("") ?>">Gastos de mantenimiento</a></li>

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
                  <!-- <li><a><i class="fas fa-clone"></i>Layouts <span class="fas fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="fixed_sidebar.html">Fixed Sidebar</a></li>
                      <li><a href="fixed_footer.html">Fixed Footer</a></li>
                    </ul>
                  </li>
                </ul>
              </div>
              <div class="menu_section">
                <h3>Live On</h3>
                <ul class="nav side-menu">
                  <li><a><i class="fas fa-bug"></i> Additional Pages <span class="fas fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="e_commerce.html">E-commerce</a></li>
                      <li><a href="projects.html">Projects</a></li>
                      <li><a href="project_detail.html">Project Detail</a></li>
                      <li><a href="contacts.html">Contacts</a></li>
                      <li><a href="profile.html">Profile</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fab fa-windows"></i> Extras <span class="fas fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="page_403.html">403 Error</a></li>
                      <li><a href="page_404.html">404 Error</a></li>
                      <li><a href="page_500.html">500 Error</a></li>
                      <li><a href="plain_page.html">Plain Page</a></li>
                      <li><a href="login.html">Login Page</a></li>
                      <li><a href="pricing_tables.html">Pricing Tables</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fas fa-sitemap"></i> Multilevel Menu <span class="fas fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        <li><a href="#level1_1">Level One</a>
                        <li><a>Level One<span class="fas fa-chevron-down"></span></a>
                          <ul class="nav child_menu">
                            <li class="sub_menu"><a href="level2.html">Level Two</a>
                            </li>
                            <li><a href="#level2_1">Level Two</a>
                            </li>
                            <li><a href="#level2_2">Level Two</a>
                            </li>
                          </ul>
                        </li>
                        <li><a href="#level1_2">Level One</a>
                        </li>
                    </ul>
                  </li>                  
                  <li><a href="javascript:void(0)"><i class="fas fa-laptop"></i> Landing Page <span class="label label-success pull-right">Coming Soon</span></a></li>
                </ul> -->
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