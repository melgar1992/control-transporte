<div class="right_col" role="main">
  <div class="clearfix"></div>
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>Contrato de Empleado <small>-</small></h2>
          <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
            </li>

          </ul>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <br />
          <div class="container">
            <div class="row">
              <div class="col-md-12 col-lg-12">
                <button class="btn btn-success" id='btn-nuevo' type="button" data-toggle="modal" data-target='#modal-contratoEmpleado'>Agregar</button>
              </div>
            </div>
          </div>


          <br>

          <div class="x_panel">
            <div class="x_title">
              <h2>Tabla de Contratos</h2>
              <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li>
              </ul>
              <div class="clearfix"></div>
            </div>
            <div class="x_content">

              <div class="table-responsive">
                <table class="table table-bordered" id="tablaContratos">
                  <thead>
                    <tr>
                      <th>ID Contrato</th>
                      <th>CI</th>
                      <th>Nombres</th>
                      <th>Apellido Paterno</th>
                      <th>Apellido Materno</th>
                      <th>Descripcion</th>
                      <th>Sueldo</th>
                      <th>Fecha Ingreso</th>
                      <th>Fecha Salida</th>
                      <th>Estado</th>
                      <th>Acciones</th>
                    </tr>
                  </thead>
                  <tbody id="datos-contratos">
                    <?php
                    if ($datos->num_rows()) {
                      foreach ($datos->result() as $row) { ?>
                        <tr>
                          <td><?php echo $row->ID_contrato ?></td>
                          <td><?php echo $row->CI ?></td>
                          <td><?php echo $row->Nombres ?></td>
                          <td><?php echo $row->Apellido_p ?></td>
                          <td><?php echo $row->Apellido_m ?></td>
                          <td><?php echo $row->Descripcion ?></td>
                          <td><?php echo $row->sueldo ?></td>
                          <td><?php echo $row->FechaIngreso ?></td>
                          <td><?php echo $row->FechaSalida ?></td>
                          <td><?php echo ($row->FechaSalida > date('Y-m-d') ? 'Vigente' : 'Vencido') ?></td>

                          <td>
                            <button class="btn btn-warning btn-sm" id="btn-editar"><i class="fas fa-pencil-alt"></i> Editar</button>
                            <button class="btn btn-danger btn-sm" id="btn-borrar"><i class="fas fa-trash-alt"></i> Borrar</button>
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

<!--Ventana modal -->

<div class="modal fade" id="modal-contratoEmpleado">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Formulario contrato de empleados</h4>
      </div>
      <form action="" id="formContratoEmpleados">
        <div class="modal-body ui-front">

          <div class="form-group">
            <label class="control-label" for="CI">CI <span class="required">*</span>
            </label>
            <div class="">
              <input type="number" id="CI" maxlength="7" minlength="7" name="CI" required="required" class="form-control col-md-7 col-xs-12" placeholder="Número de Carnet de Identidad">
            </div>
          </div>

          <div class="form-group">
            <label class="control-label" for="nombres">Nombres <span class="required">*</span>
            </label>
            <div class="">
              <input type="text" id="nombres" maxlength="45" name="nombres" required="required" class="form-control col-md-7 col-xs-12">
              <input type="number" hidden='hidden' name='ID_empleado' id="ID_empleado">
            </div>
          </div>


          <div class="form-group">
            <label for="tipocontrato" class="control-label">tipo contrato *:</label>
            <div class="">
              <select id="tipocontrato" name="tipocontrato" class="form-control" required='required'>
                <option value=""></option>
                <?php foreach ($tipocontratos->result() as $tipocontrato) : ?>
                  <option value="<?php echo $tipocontrato->ID_tipoContrato ?>"><?php echo $tipocontrato->Descripcion ?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>

          <div class="form-group">
            <label for="sueldo" class="control-label">Salario <span class="required">*</span>
            </label>
            <div class="">
              <input id="sueldo" step="0.01" class="form-control col-md-7 col-xs-12" type="number" min='0' name="sueldo" required="required" placeholder="Sueldo del empleado">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label" for="FechaIngreso">Fecha de ingreso <span class="required">*</span>
            </label>
            <div class="">
              <div class='input-group date' id='myDatepicker2'>
                <input type='date' required='required' class="form-control" id="FechaIngreso" name="FechaIngreso" />
              </div>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label" for="FechaSalida">Fecha de salida
            </label>
            <div class="">
              <div class='input-group date' id='myDatepicker2'>
                <input type='date' class="form-control" id="FechaSalida" name="FechaSalida" />
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