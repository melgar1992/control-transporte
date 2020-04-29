  <!-- page content -->
  <div class="right_col" role="main">
      <div class="">
          <div class="page-title">
              <div class="title_left">
                  <h3>Registrar Mantenimiento</h3>
              </div>

              <div class="title_right">
              </div>
          </div>

          <div class="clearfix"></div>

          <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                  <div class="x_panel">
                      <div class="x_title">
                          <h2>Formulario de mantenimiento</h2>
                          <ul class="nav navbar-right panel_toolbox">
                              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                              </li>
                              <li><a class="close-link"><i class="fa fa-close"></i></a>
                              </li>
                          </ul>
                          <div class="clearfix"></div>
                      </div>
                      <div class="x_content">
                          <div class="row">
                              <div class="col-md-12">

                                  <form action="<?php echo base_url(); ?>movimientos/ventas/guardar" method="POST" class="form-horizontal">
                                      <div class="form-group">
                                          <div class="col-md-3">
                                              <label for="">Empleado a cargo:</label>
                                              <select name="ID_empleado" id="ID_empleado" class="form-control" required>
                                                  <option value="">Seleccione...</option>
                                                  <?php foreach ($empleados->result() as $empleado) : ?>
                                                      <option value="<?php echo $empleado->ID_empleado; ?>">
                                                          <?php echo $empleado->Nombres . ' ' . $empleado->Apellido_p . ' ' . $empleado->Apellido_m ?></option>
                                                  <?php endforeach; ?>
                                              </select>
                                          </div>
                                          <div class="col-md-3">
                                              <label for="">Fecha:</label>
                                              <input type="date" value="<?php echo date("Y-m-d") ?>" class="form-control" name="Fecha_mantenimiento" id="Fecha_mantenimiento" required>
                                          </div>

                                      </div>
                                      <div class="form-group">

                                          <div class="col-md-6">
                                              <label for="Descripcion" class="control-label">Descripcion del mantenimiento: <span class="required">*</span>
                                              </label>
                                              <textarea name="Descripcion" maxlength="200" id="Descripcion" class="form-control" rows="3" placeholder="" required="required"></textarea>

                                          </div>

                                      </div>

                                      <label for="Productos" class="col-md-12">Ingresar un dato de mantenimiento </label>
                                      <br></br>
                                      <div class="form-group">
                                          <div class="col-md-2">
                                              <label for="">Fecha:</label>
                                              <input type="date" value="<?php echo date("Y-m-d") ?>" class="form-control" id="fecha" required>
                                          </div>
                                          <div class="col-md-2">
                                              <label for="">Taller o ferreteria:</label>
                                              <select id="ID_taller" class="form-control" required>
                                                  <option value="">Seleccione...</option>
                                                  <?php foreach ($talleres as $taller) : ?>
                                                      <option value="<?php echo $taller->ID_taller; ?>">
                                                          <?php echo $taller->NombreTaller ?></option>
                                                  <?php endforeach; ?>
                                              </select>
                                          </div>
                                          <div class="col-md-2">
                                              <label for="">Camion:</label>
                                              <select id="ID_camion" class="form-control">
                                                  <option value="">Ninguo</option>
                                                  <?php foreach ($camiones as $camion) : ?>
                                                      <option value="<?php echo $camion->ID_camion; ?>">
                                                          <?php echo $camion->N_Placa ?></option>
                                                  <?php endforeach; ?>
                                              </select>
                                          </div>
                                          <div class="col-md-2">
                                              <label for="">Categoria de gasto:</label>
                                              <select id="ID_categoria_mantenimiento" class="form-control">
                                                  <option value="">Ninguo</option>
                                                  <?php foreach ($categorias_mantenimientos as $categoria_mantenimiento) : ?>
                                                      <option value="<?php echo $categoria_mantenimiento->ID_categoria_mantenimiento; ?>">
                                                          <?php echo $categoria_mantenimiento->Nombre ?></option>
                                                  <?php endforeach; ?>
                                              </select>
                                          </div>
                                          <div class="col-md-2">
                                              <label for="">Tipo pago:</label>
                                              <select id="PorPagar" class="form-control">
                                                  <option value="">Contado</option>
                                                  <option value="1">Por pagar</option>
                                              </select>
                                          </div>
                                          <div class="col-md-1">
                                              <label for="">&nbsp;</label>
                                              <button id="btn-agregar" type="button" class="btn btn-success btn-flat btn-block"><span class="fa fa-plus"></span> Agregar</button>
                                          </div>
                                      </div>
                                      <br></br>
                                      <table id="tbmantenimiento" class="table table-bordered table-striped table-hover">
                                          <thead>
                                              <tr>
                                                  <th>Fecha</th>
                                                  <th>Taller o ferreteria</th>
                                                  <th>Categoria de mantenimiento</th>
                                                  <th>Camion</th>
                                                  <th>Por pagar</th>
                                                  <th>Descripcion</th>
                                                  <th>Precio unitario.</th>
                                                  <th>Cantidad</th>
                                                  <th>Importe</th>
                                                  <th>Opciones</th>
                                              </tr>
                                          </thead>
                                          <tbody>

                                          </tbody>
                                      </table>

                                      <div class="form-group">
                                          <div class="col-md-3">
                                              <div class="input-group">
                                                  <span class="input-group-addon">Total:</span>
                                                  <input type="text" class="form-control" placeholder="" value="0.00" name="total" readonly="readonly">
                                              </div>
                                          </div>
                                      </div>

                                      <div class="form-group">
                                          <div class="col-md-12">
                                              <a class="btn btn-primary btn-flat" href="<?php echo site_url("Mantenimiento/mantenimientos") ?>" type="button">Volver</a>
                                              <button type="submit" class="btn btn-success btn-flat">Guardar</button>
                                          </div>

                                      </div>
                                  </form>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
  <!-- /page content -->