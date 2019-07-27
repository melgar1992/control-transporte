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
          <form method="post" id="<?php if ($Accion_pagina == 'NuevoContrato') {
                                    echo 'nuevo_contrato';
                                  } else {
                                    echo 'editar_contrato';
                                  }
                                  ?>" data-parsley-validate class="form-horizontal form-label-left">
            <!--value="" -->

            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="CI">CI <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <?php if ($Accion_pagina == 'NuevoContrato') { ?>
                  <input type="text" list="listCI" id="CI" name="CI" required="required" class="form-control col-md-7 col-xs-12" placeholder="Número de Carnet de Identidad">
                  <!-- Lista de Nombres -->
                  <datalist id="listCI">
                    <?php
                    $datosC = $this->Empleado_model->obtenerEmpleado();
                    if ($datosC->num_rows()) {
                      foreach ($datosC->result() as $row) { ?>
                        <option value="<?php echo $row->CI ?>"><?php echo $row->Nombres ?> <?php echo $row->Apellido_p ?></option>
                      <?php }
                    }
                  } else { ?>
                    <input type="text" disabled id="disabledInput" placeholder="<?php echo $datos->CI ?>" class="form-control col-md-7 col-xs-12">

                  <?php
                  }
                  ?>
                </datalist>

              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nombres">Nombres <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <?php if ($Accion_pagina == 'NuevoContrato') { ?>
                  <input type="text" id="nombres" name="nombres" required="required" class="form-control col-md-7 col-xs-12">
                <?php
                } else { ?>
                  <input type="text" disabled id="disabledInput" placeholder="<?php echo $datos->nombres ?>" class="form-control col-md-7 col-xs-12">
                <?php
                }
                ?>
              </div>

            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tipoContrato">Tipo de Contrato <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <?php if ($Accion_pagina == 'NuevoContrato') { ?>
                  <select id="tipoContrato" name="tipoContrato" class="form-control" required>
                    <?php $tipocontratos = $this->Contrato_model->obtenerTipoContrato();
                    if ($tipocontratos->num_rows()) {
                      foreach ($tipocontratos->result() as $row) { ?>

                        <option value="<?php echo $row->Descripcion ?>"><?php echo $row->Descripcion ?></option>

                      <?php }
                    } ?>
                  </select>
                <?php
                } else { ?>
                  <select id="tipoContrato" name="tipoContrato" class="form-control" required>
                    <?php $tipocontratos = $this->Contrato_model->obtenerTipoContrato();
                    if ($tipocontratos->num_rows()) {
                      foreach ($tipocontratos->result() as $row) { ?>


                        <option value="<?php echo $row->Descripcion ?>" <?php if ($row->Descripcion == $datos->Descripcion) {
                                                                          echo "selected";
                                                                        } ?>><?php echo $row->Descripcion ?></option>

                      <?php }
                    } ?>
                  </select>
                <?php
                }
                ?>
              </div>
            </div>
            <div class="form-group">
              <label for="sueldo" class="control-label col-md-3 col-sm-3 col-xs-12">Sueldo en Bs <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <?php if ($Accion_pagina == 'NuevoContrato') { ?>
                  <input id="sueldo" class="form-control col-md-7 col-xs-12" type="float" name="sueldo" required="required" placeholder="2000">
                <?php
                } else { ?>
                  <input id="sueldo" value="<?php echo $datos->sueldo ?>" class="form-control col-md-7 col-xs-12" type="float" name="sueldo" required="required" placeholder="2000">

                <?php
                }
                ?>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="fecha-ingreso">Fecha de Ingreso <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <div class='input-group date' id='myDatepicker2'>
                  <?php if ($Accion_pagina == 'NuevoContrato') { ?>
                    <input type='date' class="form-control" id="fecha-ingreso" name="fecha-ingreso" required="required" />
                  <?php
                  } else { ?>
                    <input type='date' value="<?php echo $datos->FechaIngreso; ?>" class="form-control" id="fecha-ingreso" name="fecha-ingreso" required="required" />
                  <?php
                  }
                  ?>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="fecha-salida">Fecha de Salida <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <div class='input-group date' id='myDatepicker2'>
                  <?php if ($Accion_pagina == 'NuevoContrato') { ?>
                    <input type='date' class="form-control" id="fecha-salida" name="fecha-salida" />
                  <?php
                  } else { ?>
                    <input type='date' value="<?php echo $datos->FechaSalida; ?>" class="form-control" id="fecha-salida" name="fecha-salida" />

                  <?php
                  }
                  ?>
                </div>
              </div>
            </div>

            <div class="ln_solid"></div>
            <div class="form-group" id="botones">
              <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
              <button class="btn btn-primary" id='volver' style="display:none" type="button">volver</button>
                <button class="btn btn-primary" type="reset">Borrar</button>
              <button type="submit" id="tipo" value="<?php echo site_url('ContratoEmpleado/ingresar_contrato_empleado') ?>" class="btn btn-success">Guardar</button>
                <button type='button' data-acction="editar"  style="display:none" id="editar" value="<?php echo site_url('ContratoEmpleado/editar_contrato_empleado') ?>" class="btn btn-warning">Editar</button>
              </div>
                </button> </div>
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
                      if ($Accion_pagina == 'NuevoContrato') {

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
                                <a data-id="<?php echo $row->ID_contrato ?>" data-acction="editar" value="<?php echo site_url('ContratoEmpleado/obtenerContratoxID') ?>" class="btn btn-info btn-xs"> Editar <i class="fas fa-pencil-alt"></i></a>
                                <a data-id="<?php echo $row->ID_contrato ?>" data-acction="borrar" value="<?php echo site_url('ContratoEmpleado/eliminar_contrato_empleado') ?>" class="btn btn-danger btn-xs"> Borrar <i class="far fa-trash-alt"></i></a>
                              </td>
                            </tr>
                          <?php }
                        }
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