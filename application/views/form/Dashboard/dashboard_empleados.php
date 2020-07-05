     <!-- page content -->
     <div class="right_col" role="main">
         <div class="">
             <div class="row top_tiles">
                 <div class="animated flipInY col-lg-4 col-md-3 col-sm-6 col-xs-12">
                     <div class="tile-stats">
                         <div class="icon"><i class="fa fa-user"></i> </div>
                         <div class="count"><?php echo $empleados->num_rows(); ?></div>
                         <h3>Empleados Activos</h3>
                         <a href="<?php echo site_url("Empleado/index") ?>">
                             <p>Para mas informacion</p>
                         </a>

                     </div>
                 </div>
                 <div class="animated flipInY col-lg-4 col-md-3 col-sm-6 col-xs-12">
                     <div class="tile-stats">
                         <div class="icon"><i class="fa fa-money    "></i></div>
                         <div class="count"><?php echo (date('m') ==  12) ? number_format((float) $Planilla_mensual['Planilla_mensual'] * 2, 2) : number_format((float) $Planilla_mensual['Planilla_mensual'], 2)  ?> Bs</div>
                         <h3>Planilla mensual</h3>
                         <a href="<?php echo site_url("ContratoEmpleado/ContratoEmpleado") ?>">
                             <p>Para mas informacion</p>
                         </a>
                     </div>
                 </div>
                 <div class="animated flipInY col-lg-4 col-md-3 col-sm-6 col-xs-12">
                     <div class="tile-stats">
                         <div class="icon"><i class="fa fa-money"></i></div>
                         <div class="count"><?php echo number_format((float) $pago->Monto, 2); ?> Bs</div>
                         <h3>Pagos Realizados en el mes</h3>
                         <a href="<?php echo site_url("pagoEmpleados/pagoEmpleado") ?>">
                             <p>Para mas informacion</p>
                         </a>
                     </div>
                 </div>

             </div>
         </div>
         <div class="x_panel">
             <div class="x_title">
                 <h2>Reportes de Empleados</h2>
                 </ul>
                 <div class="clearfix"></div>
             </div>
             <div class="x_content">
                 <div class="col-md-12 col-sm-12 col-xs-12">
                     <div class="x_panel">
                         <div class="x_title">
                             <h2>Tabla de <small>estado de resultados de empleados</small></h2>
                             <ul class="nav navbar-right panel_toolbox">
                                 <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                 </li>

                                 </li>
                             </ul>
                             <div class="clearfix"></div>
                         </div>
                         <div class="x_content">

                             <div class="table-responsive">
                                 <table class="table table-bordered" id="tablaEmpleados">
                                     <thead>
                                         <tr>
                                             <th>ID Empleado</th>
                                             <th>CI</th>
                                             <th>Nombres</th>
                                             <th>Apellido Paterno</th>
                                             <th>Apellido Materno</th>
                                             <th>Fecha de Nacimiento</th>
                                             <th>Teléfono 01</th>
                                             <th>Departamento</th>
                                             <th>Tipo de Licencia</th>
                                             <th>Estado Resultado</th>
                                         </tr>
                                     </thead>
                                     <tbody>
                                         <?php
                                            if ($empleados->num_rows()) {
                                                foreach ($empleados->result() as $row) { ?>
                                                 <tr>
                                                     <td><?php echo $row->ID_empleado ?></td>
                                                     <td><?php echo $row->CI ?></td>
                                                     <td><?php echo $row->Nombres ?></td>
                                                     <td><?php echo $row->Apellido_p ?></td>
                                                     <td><?php echo $row->Apellido_m ?></td>
                                                     <td><?php echo $row->Fecha_nacimiento ?></td>
                                                     <td><?php echo $row->Telefono_01 ?></td>
                                                     <td><?php echo $row->Departamento ?></td>
                                                     <td><?php echo $row->TipoLicencia ?></td>
                                                     <td>
                                                         <div class='text-center'>
                                                             <button type="button" title="Reporte completo" class="btn btn-info btn-balance-empleado" data-toggle="modal" data-target="#modal-reporte" value="<?php echo $row->ID_empleado ?>"><span class="fa fa-search"></span></button>
                                                         </div>
                                                     </td>
                                                 </tr>
                                         <?php }
                                            }
                                            ?>
                                     </tbody>
                                 </table>
                             </div> <!-- Tabla responsiva-->
                         </div> <!-- contenedor Tabla -->
                     </div>
                 </div> <!-- Contenedor de toda la tabla -->
             </div>
         </div>

     </div>
     <!-- /page content -->



     <div class="modal fade" id="modal-reporte">
         <div class="modal-dialog">
             <div class="modal-content">
                 <div class="modal-header">
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span></button>
                     <h4 class="modal-title">Reporte</h4>
                 </div>
                 <div class="modal-body">


                 </div>
                 <div class="modal-footer">
                     <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cerrar</button>
                     <button type="button" class="btn btn-primary btn-print"><span class="fa fa-print">Imprimir</span></button>
                 </div>
             </div>
             <!-- /.modal-content -->
         </div>
         <!-- /.modal-dialog -->
     </div>