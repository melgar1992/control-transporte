<div class="right_col" role="main">
  <div class="clearfix"></div>
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>Empleados <small>-</small></h2>
          <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>

            </li>
            <li><a class="close-link"><i class="fa fa-close"></i></a>
            </li>
          </ul>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <br />
          <div class="container">
            <div class="row">
              <div class="col-md-12 col-lg-12">
                <button class="btn btn-success" id='btn-nuevo' type="button" data-toggle="modal" data-target='#modal-empleados'>Agregar</button>
              </div>
            </div>
          </div>

          <br>

          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
              <div class="x_title">
                <h2>Tabla de <small>Empleado</small></h2>
                <ul class="nav navbar-right panel_toolbox">
                  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                  </li>
                  <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>

                  </li>
                  <li><a class="close-link"><i class="fa fa-close"></i></a>
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
                        <th>Acciones</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      if ($datos->num_rows()) {
                        foreach ($datos->result() as $row) { ?>
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
                              <button class="btn btn-warning" id="btn-editar"><i class="fas fa-pencil-alt"></i> Editar</button>
                              <button class="btn btn-danger" id="btn-borrar"><i class="fas fa-trash-alt"></i> Borrar</button>
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
          </form>
        </div>
      </div>

    </div>
  </div>
</div>
<div class="modal fade" id="modal-empleados">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Formulario empleados</h4>
      </div>
      <form action="" id="formEmpleados">
        <div class="modal-body">

          <div class="error_formulario">
          </div>

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
            </div>
          </div>
          <div class="form-group">
            <label class="control-label" for="apellido-paterno">Apellido Paterno <span class="required">*</span>
            </label>
            <div class="">
              <input type="text" maxlength="45" id="apellido-paterno" name="apellido-paterno" required="required" class="form-control col-md-7 col-xs-12">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label" for="apellido-materno">Apellido Materno <span class="required">*</span>
            </label>
            <div class="">
              <input type="text" maxlength="45" id="apellido-materno" name="apellido-materno" required="required" class="form-control col-md-7 col-xs-12">
            </div>
          </div>

          <div class="form-group">
            <label class="control-label" for="fecha-nacimiento">Fecha de Nacimiento <span class="required">*</span>
            </label>
            <div class="">
              <div class='input-group date' id='myDatepicker2'>
                <input type='date' class="form-control" id="fecha-nacimiento" name="fecha-nacimiento" />
              </div>
            </div>
          </div>

          <div class="form-group">
            <label for="direccion" class="control-label">Dirección <span class="required">*</span>
            </label>
            <div class="">
              <textarea name="direccion" id="direccion" class="form-control" rows="3" placeholder="Dirección" required="required"></textarea>
            </div>
          </div>


          <div class="form-group">
            <label for="departamento" class="control-label">Departamento *:</label>
            <div class="">
              <select id="departamento" name="departamento" class="form-control" required>
                <option value=""></option>
                <option value="Pando">Pando</option>
                <option value="Beni">Beni</option>
                <option value="Santa Cruz">Santa Cruz</option>
                <option value="Cochabamba">Cochabamba</option>
                <option value="La Paz">La Paz</option>
                <option value="Sucre">Sucre</option>
                <option value="Potosi">Potosi</option>
                <option value="Tarija">Tarija</option>
                <option value="Oruro">Oruro</option>
              </select>
            </div>
          </div>

          <div class="form-group">
            <label for="telefono_01" class="control-label">Telefono 01 <span class="required">*</span>
            </label>
            <div class="">
              <input id="telefono_01" class="form-control col-md-7 col-xs-12" type="number" name="telefono_01" required="required" placeholder="77800975-34622503">
            </div>
          </div>

          <div class="form-group">
            <label for="telefono_02" class="control-label">Telefono 02
            </label>
            <div class="">
              <input id="telefono_02" class="form-control col-md-7 col-xs-12" type="number" name="telefono_02" placeholder="77800975-34622503">
            </div>
          </div>

          <div class="form-group">
            <label for="calificacion" class="control-label">Calificación <span class="required">*</span>
            </label>
            <div class="">
              <input id="calificacion" class="form-control col-md-7 col-xs-12 chofer" type="number" name="calificacion" placeholder="Calificación del personal" min="1" max="10">
            </div>
          </div>

          <div class="form-group">
            <label for="descripcion" class="control-label">Descripción
            </label>
            <div class="">
              <textarea name="descripcion" id="descripcion" class="form-control chofer" rows="3" placeholder="Una brever descripción del personal"></textarea>
            </div>
          </div>

          <div class="form-group">
            <label for="tipo-licencia" class="control-label">Tipo de licencia <span class="required">*</span>
            </label>
            <div class="">
              <select id="tipo-licencia" name="tipo-licencia" class="form-control chofer">
                <option value=""></option>
                <option value="Motociclista">Motociclista</option>
                <option value="Particular">Particular</option>
                <option value="Profecional A">Profecional A</option>
                <option value="Profecional B">Profecional B</option>
                <option value="Profecional C">Profecional C</option>
                <option value="Motorista T">Motorista T</option>
              </select>
            </div>
          </div>

          <div class="form-group">
            <label class="control-label" for="fecha-vencimiento-l">Fecha de Vencimiento Licencia <span class="required">*</span>
            </label>
            <div class="">
              <div class='input-group date' id='myDatepicker2'>
                <input type='date' class="form-control chofer" id="fecha-vencimiento-l" name="fecha-vencimiento-l" />
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