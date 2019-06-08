<div class="right_col" role="main">
  <div class="clearfix"></div>
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>Nuevo Contrato del Empleado <small>-</small></h2>
          <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="#">Settings 1</a>
                </li>
                <li><a href="#">Settings 2</a>
                </li>
              </ul>
            </li>
            <li><a class="close-link"><i class="fa fa-close"></i></a>
            </li>
          </ul>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <br />
          <form method="post" id="nuevo_contrato" data-parsley-validate class="form-horizontal form-label-left">
            <!--value="<?php
                        ?>" -->

            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="CI">CI <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" id="CI" name="CI" required="required" class="form-control col-md-7 col-xs-12" placeholder="Número de Carnet de Identidad">
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nombres">Nombres <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" id="nombres" name="nombres" required="required" class="form-control col-md-7 col-xs-12">
              </div>
              <button type="button" id="buscar" class="btn btn-primary">Buscar Empleado</button>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tipoContrato">Tipo de Contrato <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <select id="tipoContrato" name="tipoContrato" class="form-control" required>
                  <?php $tipocontratos = $this->Contrato_model->obtenerTipoContrato();

                  if ($tipocontratos->num_rows()) {
                    foreach ($tipocontratos->result() as $row) { ?>

                      <option value="<?php echo $row->Descripcion ?>"><?php echo $row->Descripcion ?></option>

                    <?php }
                } ?>
                </select>

              </div>
            </div>
            <div class="form-group">
              <label for="sueldo" class="control-label col-md-3 col-sm-3 col-xs-12">Sueldo en Bs <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input id="sueldo" class="form-control col-md-7 col-xs-12" type="float" name="sueldo" required="required" placeholder="2000">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="fecha-ingreso">Fecha de Ingreso <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <div class='input-group date' id='myDatepicker2'>
                  <input type='date' class="form-control" id="fecha-ingreso" name="fecha-ingreso" required="required" />
                </div>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="fecha-salida">Fecha de Salida <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <div class='input-group date' id='myDatepicker2'>
                  <input type='date' class="form-control" id="fecha-salida" name="fecha-salida" />
                </div>
              </div>
            </div>

            <div class="ln_solid"></div>
            <div class="form-group" id="botones">
              <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                <button class="btn btn-primary" type="button">Cancelar</button>
                <button class="btn btn-primary" type="reset">Borrar</button>
                <button type="submit" id="tipo" value="<?php echo site_url('ContratoEmpleado/ingresar_contrato_empleado') ?>" class="btn btn-success">Guardar</button>
                <button  type= 'button' data-acction="editar" id="editar"value="<?php echo site_url('ContratoEmpleado/editar_contrato_empleado') ?>" class="btn btn-warning">Editar</button>
              </div>
            </div>

            <br>
            
            <br>
            
            <div class="x_panel">
              <div class="x_title">
                <h2>Tabla de Contratos</h2>
                <ul class="nav navbar-right panel_toolbox">
                  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                  </li>
                  <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                    <ul class="dropdown-menu" role="menu">
                      <li><a href="#">Settings 1</a>
                      </li>
                      <li><a href="#">Settings 2</a>
                      </li>
                    </ul>
                  </li>
                  <li><a class="close-link"><i class="fa fa-close"></i></a>
                  </li>
                </ul>
                <div class="clearfix"></div>
              </div>
              <div class="x_content">

                <div class="table-responsive">
                  <table class="table table-bordered" id="tablaContratos">
                    <thead>
                      <tr>
                        
                        <th>CI</th>
                        <th>Nombres</th>
                        <th>Apellido Paterno</th>
                        <th>Apellido Materno</th>
                        <th>Descripcion</th>
                        <th>Sueldo</th>
                        <th>Fecha Ingreso</th>
                        <th>Fecha Salida</th>
                        <th>Acciones</th>
                      </tr>
                    </thead>
                    <tbody id="datos-contratos">
                      <?php

                      if ($datos->num_rows()) {
                        foreach ($datos->result() as $row) { ?>
                          <tr>
                            
                            <td><?php echo $row->CI ?></td>
                            <td><?php echo $row->Nombres ?></td>
                            <td><?php echo $row->Apellido_p ?></td>
                            <td><?php echo $row->Apellido_m ?></td>
                            <td><?php echo $row->Descripcion ?></td>
                            <td><?php echo $row->sueldo ?></td>
                            <td><?php echo $row->FechaIngreso ?></td>
                            <td><?php echo $row->FechaSalida ?></td>


                            <td>
                              <a data-id="<?php echo $row->ID_contrato ?>" data-acction="editar" value = "<?php echo site_url('ContratoEmpleado/obtenerContratoxID') ?>" class="btn btn-info btn-xs"> Editar <i class="fas fa-pencil-alt"></i></a>
                              <a data-id="<?php echo $row->ID_contrato ?>" data-acction="borrar" value = "<?php echo site_url('ContratoEmpleado/eliminar_contrato_empleado') ?>" class="btn btn-danger btn-xs"> Borrar <i class="far fa-trash-alt"></i></a>
                            </td>
                          </tr>
                        <?php }
                    }
                    ?>
                    </tbody>
                  </table>
                </div> <!-- Tabla responsiva-->
              </div>
            </div>


            <!--Tabla para seleccionar empleados  -->

            <div class="x_panel">
              <div class="x_title">
                <h2>Selecionar el Empleado<small></small></h2>
                <ul class="nav navbar-right panel_toolbox">
                  <li><a class="collapse-link" ><i class="fa fa-chevron-up" ></i></a>
                  </li>
                  <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                    <ul class="dropdown-menu" role="menu">
                      <li><a href="#">Settings 1</a>
                      </li>
                      <li><a href="#">Settings 2</a>
                      </li>
                    </ul>
                  </li>
                  <li><a class="close-link" ><i class="fa fa-close"></i></a>
                  </li>
                </ul>
                <div class="clearfix"></div>
              </div>
              <div class="x_content" id='seleccionarEmpleado'>
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="buscar-empleado">Buscar Empleado por Nombre
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" id="buscar-empleado" name="buscar-empleado" class="form-control col-md-7 col-xs-12">
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="buscar-ci">Buscar Empleado Carnet Identidad
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="number" id="buscar-ci" name="buscar-ci" class="form-control col-md-7 col-xs-12">
                  </div>
                </div>

                <div class="table-responsive">
                  <table class="table table-bordered" id="tablaEmpleados">
                    <thead>
                      <tr>
                        <th>ID Empleado</th>
                        <th>CI</th>
                        <th>Nombres</th>
                        <th>Apellido Paterno</th>
                        <th>Apellido Materno</th>
                        <th>Acciones</th>
                      </tr>
                    </thead>
                    <tbody id="datos-empleados">
                      <?php
                      $datosC = $this->Empleado_model->obtenerEmpleado();
                      if ($datosC->num_rows()) {
                        foreach ($datosC->result() as $row) { ?>
                          <tr>
                            <th scope="row"><?php echo $row->ID_empleado ?></th>
                            <td><?php echo $row->CI ?></td>
                            <td><?php echo $row->Nombres ?></td>
                            <td><?php echo $row->Apellido_p ?></td>
                            <td><?php echo $row->Apellido_m ?></td>

                            <td>
                              <a data-id="<?php echo $row->CI ?>" data-acction="seleccionar" id="seleccionar" value="<?php echo site_url('/Empleado/obtenerEmpleadoId') ?>" class="btn btn-info btn-xs"> Seleccionar <i class="fas fa-pencil-alt"></i></a>

                            </td>
                          </tr>
                        <?php }
                    }
                    ?>
                    </tbody>
                  </table>
                </div> <!-- Tabla responsiva-->
              </div>
            </div>
           
        <!--Termina el contenido principal -->

        </form>
      </div>
    </div>
  </div>
</div>
</div>
