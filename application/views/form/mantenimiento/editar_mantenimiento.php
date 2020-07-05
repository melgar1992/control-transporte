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
                          <?php if ($this->session->flashdata("error")) : ?>
                              <div class="alert alert-danger alert-dismissable">
                                  <button type="button" class="close" data-dissmiss="alert" aria-hidden="true"></button>
                                  <p><i class="icon fa fa-ban"></i><?php echo $this->session->flashdata("error"); ?></p>

                              </div>
                          <?php endif; ?>
                          <div class="row">
                              <div class="col-md-12">

                                  <form action="<?php echo site_url(); ?>/mantenimiento/actualizarMantenimiento" method="POST" class="form-horizontal">
                                  <input type="text" hidden='hidden' id="ID_mantenimiento" name="ID_mantenimiento" value="<?php echo $mantenimiento['ID_Mantenimiento'] ?>">
                                      <div class="form-group">
                                          <div class="col-md-3">
                                              <label for="">Empleado a cargo:</label>
                                              <select name="ID_empleado" id="ID_empleado" class="form-control" required>
                                                  <option value="">Seleccione...</option>
                                                  <?php foreach ($empleados->result() as $empleado) : ?>
                                                      <?php if ($mantenimiento['ID_empleado'] == $empleado->ID_empleado) : ?>
                                                          <option selected="selected" value="<?php echo $empleado->ID_empleado; ?>">
                                                              <?php echo $empleado->Nombres . ' ' . $empleado->Apellido_p . ' ' . $empleado->Apellido_m ?></option>
                                                      <?php else : ?>
                                                          <option value="<?php echo $empleado->ID_empleado; ?>">
                                                              <?php echo $empleado->Nombres . ' ' . $empleado->Apellido_p . ' ' . $empleado->Apellido_m ?></option>
                                                      <?php endif ?>
                                                  <?php endforeach; ?>
                                              </select>
                                          </div>
                                          <div class="col-md-3">
                                              <label for="">Fecha:</label>
                                              <input type="date" value="<?php echo $mantenimiento['Fecha_mantenimiento'] ?>" class="form-control" name="Fecha_mantenimiento" id="Fecha_mantenimiento" required>
                                          </div>

                                      </div>
                                      <div class="form-group">

                                          <div class="col-md-6">
                                              <label for="Descripcion_mantenimiento" class="control-label">Descripcion general del mantenimiento: <span class="required">*</span>
                                              </label>
                                              <textarea name="Descripcion_mantenimiento" maxlength="200" id="Descripcion_mantenimiento" class="form-control" rows="3" placeholder="" required="required"><?php echo $mantenimiento['Descripcion'] ?></textarea>

                                          </div>

                                      </div>

                                      <label for="Productos" class="col-md-12">Ingresar un dato de mantenimiento </label>
                                      <br></br>
                                      <div class="form-group">
                                          <div class="col-md-2">
                                              <label for="">Fecha:</label>
                                              <input type="date" value="<?php echo date("Y-m-d") ?>" class="form-control" id="fecha">
                                          </div>
                                          <div class="col-md-2">
                                              <label for="">Taller o ferreteria:</label>
                                              <select id="ID_taller" class="form-control">
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
                                                  <option value="0">Contado</option>
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
                                              <?php
                                                if (count($detalle_mantenimientos) > 0) {
                                                    foreach ($detalle_mantenimientos as $row) { ?>
                                                      <tr>
                                                          <td><input type='hidden' name='Fecha[]' value='<?php echo $row->Fecha ?>'><?php echo $row->Fecha ?></td>
                                                          <td><input type='hidden' name='ID_taller[]' value='<?php echo $row->ID_taller ?>'><?php echo $row->NombreTaller ?></td>
                                                          <td><input type='hidden' name='ID_categoria_mantenimiento[]' value='<?php echo $row->ID_categoria_mantenimiento ?>'><?php echo $row->NombreCategoria ?></td>
                                                          <td><input type='hidden' name='ID_camion[]' value='<?php echo $row->ID_camion ?>'><?php echo $row->Placa ?></td>
                                                          <td><input type='hidden' name='Porpagar[]' value='<?php echo $row->Porpagar ?>'><?php echo ($row->Porpagar == 0) ? 'Contado' : 'Por pagar'; ?></td>
                                                          <td><input type='text' maxlength='30' name='Descripcion[]' value='<?php echo $row->Descripcion ?>'></td>
                                                          <td><input type='number' class='PrecioUnitario' min='0' name='PrecioUnitario[]' value='<?php echo $row->PrecioUnitario ?>'></td>
                                                          <td><input type='number' class='Cantidad' min='0' name='Cantidad[]' value='<?php echo $row->Cantidad ?>'></td>
                                                          <td><input type='hidden' name='ImporteTotal[]' value='<?php echo $row->ImporteTotal ?>'>
                                                              <p><?php echo $row->ImporteTotal ?></p>
                                                          </td>
                                                          <td><button type='button' class='btn btn-danger btn-remove-mantenimiento'><span class='fa fa-remove'></span></button></td>
                                                      </tr>
                                              <?php }
                                                }
                                                ?>

                                          </tbody>
                                      </table>

                                      <div class="form-group">
                                          <div class="col-md-2 col-md-offset-10">
                                              <div class="input-group">
                                                  <span class="input-group-addon">Total:</span>
                                                  <input type="text" class="form-control" placeholder="" value="<?php echo $mantenimiento['MontoTotal'] ?>" name="total" readonly="readonly">
                                              </div>
                                          </div>
                                      </div>

                                      <div class="form-group">
                                          <div class="col-md-12">
                                              <a class="btn btn-primary btn-flat" href="<?php echo site_url("Mantenimiento/mantenimientos") ?>" type="button">Volver</a>
                                              <button type="submit" class="btn btn-warning btn-flat">Editar</button>
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