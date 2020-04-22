<div class="right_col" role="main">
  <div class="clearfix"></div>
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>Nuevo pago Empleado <small>-</small></h2>
          <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
          </ul>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <br />
          <div class="container">
            <div class="row">
              <div class="col-md-12 col-lg-12">
                <button class="btn btn-success" id='btn-nuevo' type="button" data-toggle="modal" data-target='#modal-pagoEmpleado'>Agregar</button>
              </div>
            </div>
          </div>

        </div>

        <div class="x_panel">
          <div class="x_title">
            <h2>Tabla de Pagos</h2>
            <ul class="nav navbar-right panel_toolbox">
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
              </li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">

            <div class="table-responsive">
              <table class="table table-bordered" id="tablaPagos">
                <thead>
                  <tr>

                    <th>ID de pago</th>
                    <th>Nombres</th>
                    <th>Apellido Paterno</th>
                    <th>Fecha</th>
                    <th>Descripcion</th>
                    <th>Monto</th>
                    <th>Acciones</th>

                  </tr>
                </thead>
                <tbody id="datos-contratos">
                  <?php
                  if ($Accion_pagina == 'NuevoPago') {
                    if ($datos->num_rows()) {
                      foreach ($datos->result() as $row) { ?>
                        <tr>
                          <td><?php echo $row->ID_pago ?></td>
                          <td><?php echo $row->nombres ?></td>
                          <td><?php echo $row->Apellido_p ?></td>
                          <td><?php echo $row->Fecha ?></td>
                          <td><?php echo $row->Descripcion ?></td>
                          <td><?php echo $row->Monto ?></td>
                          <td>
                            <button class="btn btn-warning btn-sm" id="btn-editar"><i class="fas fa-pencil-alt"></i> Editar</button>
                            <button class="btn btn-danger btn-sm" id="btn-borrar"><i class="fas fa-trash-alt"></i> Borrar</button>
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
      </div>

    </div>
  </div>

</div>

<div class="modal fade" id="modal-pagoEmpleado">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Formulario pago de empleado</h4>
      </div>
      <form action="" id="formpagoEmpleado">
        <div class="modal-body ui-front">

          <div class="form-group">
            <label class="control-label" for="CI">Buscar por CI <span class="required">*</span>
            </label>
            <div class="">
              <input type="number" id="CI" maxlength="7" minlength="7" name="CI" required="required" class="form-control col-md-7 col-xs-12" placeholder="Número de Carnet de Identidad">
            </div>
          </div>

          <div class="form-group">
            <label class="control-label" for="nombres">Buscar por Nombres <span class="required">*</span>
            </label>
            <div class="">
              <input type="text" id="nombres" maxlength="45" name="nombres" required="required" class="form-control col-md-7 col-xs-12">
              <input type="number" hidden='hidden' name='ID_contrato' id="ID_contrato">
            </div>
          </div>
          <div class="form-group">
            <label for="sueldo" class="control-label">Sueldo base <span class="required">*</span>
            </label>
            <div class="">
              <input id="sueldo" step="0.01" readonly class="form-control col-md-7 col-xs-12" type="number" min='0' name="sueldo" required="required" placeholder="">
            </div>
          </div>

          <div class="form-group">
            <label for="Monto" class="control-label">Monto a pagar <span class="required">*</span>
            </label>
            <div class="">
              <input id="Monto" step="0.01" class="form-control col-md-7 col-xs-12" type="number" min='0' name="Monto" required="required" placeholder="Monto a pagar">
            </div>
          </div>
          <div class="form-group">
            <label for="descripcion" class="control-label">Descripción
            </label>
            <div class="">
              <textarea name="descripcion" id="descripcion" class="form-control chofer" rows="3" placeholder="Una brever descripción del pago"></textarea>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label" for="FechaPago">Fecha de pago <span class="required">*</span>
            </label>
            <div class="">
              <div class='input-group date' id='myDatepicker2'>
                <input type='date' required='required' value="<?php echo date('Y-m-d'); ?>" class="form-control" id="FechaPago" name="FechaPago" />
              </div>
            </div>
          </div>
         



        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger pull-left" id="btn-cerrar" data-dismiss="modal">Cerrar</button>
          <button class="btn btn-primary pull-right" type="reset">Borrar</button>
          <button type="submit" class="btn btn-success pull-right" id="btn-guardar">Guardar</button>
        </div>
      </form>
    </div>

    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->