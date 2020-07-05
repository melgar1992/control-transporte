  <!-- page content -->
  <div class="right_col" role="main">
      <div class="">
          <div class="page-title">
              <div class="title_left">
                  <h3>Registrar transporte</h3>
              </div>

              <div class="title_right">
              </div>
          </div>

          <div class="clearfix"></div>

          <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                  <div class="x_panel">
                      <div class="x_title">
                          <h2>Formulario de servicio de transporte</h2>
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

                                  <form action="<?php echo site_url(); ?>/Transporte/actualizarTransporte" method="POST" class="form-horizontal">
                                      <input type="number" hidden='hidden' id='ID_transporte' name="ID_transporte" value="<?php echo  $transporte['ID_transporte'] ?>">
                                      <div class="form-group">
                                          <div class="col-md-3">
                                              <label for="">Predio Origen:</label>
                                              <div class="input-group">
                                                  <input type="hidden" name="ID_predio_origen" id="ID_predio_origen" value="<?php echo $transporte['ID_predio_origen'] ?>">
                                                  <input type="text" class="form-control" readonly="readonly" value="<?php echo $transporte['NombrePredioOringen'] ?>" required id="predioOrigen">
                                                  <span class="input-group-btn">
                                                      <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#modal-predioOrigen"><span class="fa fa-search"></span> Buscar</button>
                                                  </span>
                                              </div><!-- /input-group -->
                                          </div>
                                          <div class="col-md-3">
                                              <label for="">Predio Destino:</label>
                                              <div class="input-group">
                                                  <input type="hidden" name="ID_predio_destino" value="<?php echo $transporte['ID_predio_destino'] ?>" id="ID_predio_destino">
                                                  <input type="text" class="form-control" readonly="readonly" value="<?php echo $transporte['NombrePredioDestino'] ?>" required id="PredioDestino">
                                                  <span class="input-group-btn">
                                                      <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#modal-predioDestino"><span class="fa fa-search"></span> Buscar</button>
                                                  </span>
                                              </div><!-- /input-group -->
                                          </div>
                                          <div class="col-md-3">
                                              <label for="">Cliente:</label>
                                              <div class="input-group">
                                                  <input type="hidden" name="ID_Cliente" value="<?php echo $transporte['ID_Cliente'] ?>" id="ID_Cliente">
                                                  <input type="text" class="form-control" readonly="readonly" value="<?php echo $transporte['NombreCliente'] . ' ' . $transporte['ApellidosCliente'] ?>" required id="cliente">
                                                  <span class="input-group-btn">
                                                      <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#modal-Cliente"><span class="fa fa-search"></span> Buscar</button>
                                                  </span>
                                              </div><!-- /input-group -->
                                          </div>
                                      </div>
                                      <div class="form-group">
                                          <div class="col-md-3">
                                              <label for="">Fecha:</label>
                                              <input type="date" value="<?php echo $transporte['Fecha'] ?>" class="form-control" name="Fecha" required>
                                          </div>
                                          <div class="col-md-3 has-feedback">
                                              <label for="Distancia">Distancia</label>
                                              <input type="number" min="0" name="Distancia" value="<?php echo $transporte['Distancia'] ?>" id="Distancia" class="form-control">
                                              <span class="form-control-feedback right" aria-hidden="true"><strong>Km</strong></span>
                                          </div>

                                      </div>
                                      <div class="form-group">
                                          <div class="col-md-6">
                                              <label for="Descripcion_transporte" class="control-label">Descripcion general del transporte: <span class="required">*</span>
                                              </label>
                                              <textarea name="Descripcion_transporte" maxlength="150" id="Descripcion_transporte" class="form-control" rows="3" placeholder="" required="required"><?php echo $transporte['Descripcion'] ?></textarea>
                                          </div>

                                      </div>

                                      <label for="Productos" class="col-md-12">Buscar y agregar camiones para el servicio</label>
                                      <br></br>
                                      <div class="form-group">
                                          <div class="col-lg-2 col-md-3">

                                              <button class="btn btn-success btn-flat btn-block" type="button" data-toggle="modal" data-target="#modal-CamionesProveedores"><span class="fa fa-search"></span> Agregar camion proveedor</button>
                                          </div>
                                          <div class="col-lg-2 col-md-3">

                                              <button class="btn btn-success btn-flat btn-block" type="button" data-toggle="modal" data-target="#modal-CamionesPropios"><span class="fa fa-search"></span> Agregar camion propio</button>
                                          </div>
                                      </div>
                                      <br></br>
                                      <table id="tablaDetalleTransporte" class="table table-bordered table-condensed table-striped table-hover">
                                          <thead>
                                              <tr>
                                                  <th>Nombre chofer</th>
                                                  <th>CI</th>
                                                  <th>Placa</th>
                                                  <th>Act viaje</th>
                                                  <th>Diesel Bs</th>
                                                  <th>Precio proveedor</th>
                                                  <th>Precio cliente</th>
                                                  <th>Cantidad</th>
                                                  <th>Comision</th>
                                                  <th>Descuento</th>
                                                  <th>Total</th>
                                                  <th>Opciones</th>
                                              </tr>
                                          </thead>
                                          <tbody>
                                              <?php
                                                if (count($detalle_transporte) > 0) {
                                                    foreach ($detalle_transporte as $row) { ?>
                                                      <tr>
                                                          <td><?php echo (isset($row->NombresChofer)) ? $row->NombresChofer : $row->nombreChoferPropio; ?></td>
                                                          <td><?php echo (isset($row->CI)) ? $row->CI : $row->CIcamionPropio; ?></td>
                                                          <td><input type='hidden' name='ID_camion[]' value='<?php echo $row->ID_camion ?>'><?php echo $row->N_Placa ?></td>
                                                          <td><input type='number' class='form-control' name='ActViaje[]' value='<?php echo $row->ActViaje ?>'></td>
                                                          <td><input type='number' class='form-control' <?php echo (isset($row->ID_proveedor)) ? 'readonly' : '' ?> name='Diesel[]' value='<?php echo $row->Diesel ?>'></td>
                                                          <td><input type='number' class='form-control PrecioProveedor' name='PrecioProveedor[]' value='<?php echo $row->PrecioProveedor ?>'></td>
                                                          <td><input type='number' class='form-control Precio' name='Precio[]' value='<?php echo $row->Precio ?>'></td>
                                                          <td><input type='number' class='form-control Cantidad' name='Cantidad[]' value='<?php echo $row->Cantidad ?>'></td>
                                                          <td><input type='number' class='form-control Comision' name='Comision[]' value='<?php echo $row->Comision ?>'></td>
                                                          <td><input type='number' class='form-control Descuento' name='Descuento[]' value='<?php echo $row->Descuento ?>'></td>
                                                          <td><input type='hidden' name='TotalDetalle[]' value='<?php echo $row->Total ?>'>
                                                              <p><?php echo $row->Total ?></p>
                                                          </td>
                                                          <td><button type='button' class='btn btn-danger btn-remove-mantenimiento'><span class='fa fa-remove'></span></button></td>
                                                      </tr>
                                              <?php }
                                                }
                                                ?>
                                          </tbody>
                                      </table>

                                      <div class="form-group">
                                          <div class="col-md-3">
                                              <div class="input-group">
                                                  <span class="input-group-addon">Subtotal:</span>
                                                  <input type="text" class="form-control" placeholder="" value="0.00" name="SubTotal" readonly="readonly">
                                              </div>
                                          </div>
                                          <div class="col-md-3">
                                              <div class="input-group">
                                                  <span class="input-group-addon">Comision:</span>
                                                  <input type="text" class="form-control" placeholder="" value="0.00" name="ComisionTotal" readonly="readonly">
                                              </div>
                                          </div>
                                          <div class="col-md-3">
                                              <div class="input-group">
                                                  <span class="input-group-addon">Descuento:</span>
                                                  <input type="text" class="form-control" placeholder="" value="0.00" name="DescuentoTotal" value="0.00" readonly="readonly">
                                              </div>
                                          </div>
                                          <div class="col-md-3">
                                              <div class="input-group">
                                                  <span class="input-group-addon">Total cliente:</span>
                                                  <input type="text" class="form-control" placeholder="" value="0.00" name="Total" readonly="readonly">
                                              </div>
                                          </div>
                                      </div>

                                      <div class="form-group">
                                          <div class="col-md-12">
                                              <a class="btn btn-primary btn-flat" href="<?php echo site_url("Transporte/transporte") ?>" type="button">Volver</a>
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


  <div class="modal fade" id="modal-predioOrigen">
      <div class="modal-dialog modal-lg">
          <div class="modal-content">
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title">Lista de Predio origen</h4>
              </div>
              <div class="modal-body">
                  <table id="tablaPredioOrigen" class="table table-bordered table-striped table-hover">
                      <thead>
                          <tr>
                              <th>ID</th>
                              <th>Nombre</th>
                              <th>Direccion</th>
                              <th>Departamento</th>
                              <th>Provincia</th>
                              <th>Municipio</th>
                              <th>Nombre propietario</th>
                              <th>Tipo Predio</th>
                              <th>Acciones</th>
                          </tr>
                      </thead>
                      <tbody>
                          <?php if (!empty($predios)) : ?>
                              <?php foreach ($predios as $row) : ?>
                                  <tr>
                                      <td><?php echo $row->ID_predio ?></td>
                                      <td><?php echo $row->NombrePredio ?></td>
                                      <td><?php echo $row->Direccion ?></td>
                                      <td><?php echo $row->Departamento ?></td>
                                      <td><?php echo $row->Provincia ?></td>
                                      <td><?php echo $row->Municipio ?></td>
                                      <td><?php echo $row->NombrePropietario . ' ' . $row->ApellidoPropietario ?></td>
                                      <td><?php echo $row->TipoPredio ?></td>
                                      <?php $dataPredioOrigen = $row->ID_predio . "*" . $row->NombrePredio . "*" . $row->Direccion . "*" . $row->Departamento . "*" . $row->Provincia . "*" . $row->Municipio . "*" . $row->NombrePropietario . "*" . $row->ApellidoPropietario . '*' . $row->TipoPredio; ?>

                                      <td>
                                          <button type="button" class="btn btn-success btn-check-predioOrigen" value="<?php echo $dataPredioOrigen ?>"><span class="fa fa-check"></span></button>
                                      </td>
                                  </tr>
                              <?php endforeach; ?>
                          <?php endif; ?>

                      </tbody>
                  </table>

              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cerrar</button>
              </div>
          </div>
          <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->

  <div class="modal fade" id="modal-predioDestino">
      <div class="modal-dialog modal-lg">
          <div class="modal-content">
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title">Lista de predio destino</h4>
              </div>
              <div class="modal-body">
                  <table id="tablaPredioDestino" class="table table-bordered table-striped table-hover">
                      <thead>
                          <tr>
                              <th>ID</th>
                              <th>Nombre</th>
                              <th>Direccion</th>
                              <th>Departamento</th>
                              <th>Provincia</th>
                              <th>Municipio</th>
                              <th>Nombre propietario</th>
                              <th>Tipo Predio</th>
                              <th>Acciones</th>
                          </tr>
                      </thead>
                      <tbody>
                          <?php if (!empty($predios)) : ?>
                              <?php foreach ($predios as $row) : ?>
                                  <tr>
                                      <td><?php echo $row->ID_predio ?></td>
                                      <td><?php echo $row->NombrePredio ?></td>
                                      <td><?php echo $row->Direccion ?></td>
                                      <td><?php echo $row->Departamento ?></td>
                                      <td><?php echo $row->Provincia ?></td>
                                      <td><?php echo $row->Municipio ?></td>
                                      <td><?php echo $row->NombrePropietario . ' ' . $row->ApellidoPropietario ?></td>
                                      <td><?php echo $row->TipoPredio ?></td>
                                      <?php $dataPredioOrigen = $row->ID_predio . "*" . $row->NombrePredio . "*" . $row->Direccion . "*" . $row->Departamento . "*" . $row->Provincia . "*" . $row->Municipio . "*" . $row->NombrePropietario . "*" . $row->ApellidoPropietario . '*' . $row->TipoPredio; ?>

                                      <td>
                                          <button type="button" class="btn btn-success btn-check-predioDestino" value="<?php echo $dataPredioOrigen ?>"><span class="fa fa-check"></span></button>
                                      </td>
                                  </tr>
                              <?php endforeach; ?>
                          <?php endif; ?>

                      </tbody>
                  </table>

              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cerrar</button>
              </div>
          </div>
          <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->

  <div class="modal fade" id="modal-Cliente">
      <div class="modal-dialog modal-lg">
          <div class="modal-content">
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title">Lista de clientes</h4>
              </div>
              <div class="modal-body">
                  <table id="tablaCliente" class="table table-bordered table-striped table-hover">
                      <thead>
                          <tr>
                              <th>ID Cliente</th>
                              <th>CI</th>
                              <th>Nombres</th>
                              <th>Apellidos</th>
                              <th>Direccion</th>
                              <th>Teléfono 01</th>
                              <th>Telefono 02</th>
                              <th>Acciones</th>
                          </tr>
                      </thead>
                      <tbody>
                          <?php if (!empty($Clientes)) : ?>
                              <?php foreach ($Clientes as $row) : ?>
                                  <tr>
                                      <td><?php echo $row->ID_Cliente ?></td>
                                      <td><?php echo $row->CI ?></td>
                                      <td><?php echo $row->Nombre ?></td>
                                      <td><?php echo $row->Apellidos ?></td>
                                      <td><?php echo $row->Direccion ?></td>
                                      <td><?php echo $row->Telefono_01 ?></td>
                                      <td><?php echo $row->Telefono_02 ?></td>
                                      <?php $dataCliente = $row->ID_Cliente . "*" . $row->CI . "*" . $row->Nombre . "*" . $row->Apellidos . "*" . $row->Direccion . "*" . $row->Telefono_01 . "*" . $row->Telefono_02; ?>

                                      <td>
                                          <button type="button" class="btn btn-success btn-check-cliente" value="<?php echo $dataCliente ?>"><span class="fa fa-check"></span></button>
                                      </td>
                                  </tr>
                              <?php endforeach; ?>
                          <?php endif; ?>

                      </tbody>
                  </table>

              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cerrar</button>
              </div>
          </div>
          <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->
  <div class="modal fade" id="modal-CamionesProveedores">
      <div class="modal-dialog modal-lg">
          <div class="modal-content">
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title">Lista de camiones de proveedores</h4>
              </div>
              <div class="modal-body">
                  <table id="tablaCamionesProveedor" class="table table-bordered table-striped table-hover">
                      <thead>
                          <tr>
                              <th>ID camion</th>
                              <th>Proovedor</th>
                              <th>Nombre chofer</th>
                              <th>CI</th>
                              <th>Telefono</th>
                              <th>Placa</th>
                              <th>Capacidad</th>
                              <th>Nro Senasag</th>
                              <th>Acciones</th>
                          </tr>
                      </thead>
                      <tbody>
                          <?php if (!empty($camionesProveedor)) : ?>
                              <?php foreach ($camionesProveedor as $row) : ?>
                                  <tr>
                                      <td><?php echo $row->ID_camion ?></td>
                                      <td><?php echo $row->NombreProveedor . ' ' .  $row->ApellidosProveedor ?></td>
                                      <td><?php echo $row->NombresChofer ?></td>
                                      <td><?php echo $row->CI ?></td>
                                      <td><?php echo $row->Telefono ?></td>
                                      <td><?php echo $row->N_Placa ?></td>
                                      <td><?php echo $row->Capacidad ?></td>
                                      <td><?php echo $row->N_Senasag ?></td>
                                      <?php $dataCamionesProveedor = $row->ID_camion . "*" . $row->NombreProveedor . "*" . $row->ApellidosProveedor . "*" . $row->NombresChofer . "*" . $row->CI . "*" . $row->Telefono . "*" . $row->N_Placa . "*" . $row->Marca . "*" . $row->Color . "*" . $row->Capacidad . "*" . $row->N_Senasag; ?>

                                      <td>
                                          <button type="button" class="btn btn-success btn-check-camionesProveedores" value="<?php echo $dataCamionesProveedor ?>"><span class="fa fa-check"></span></button>
                                      </td>
                                  </tr>
                              <?php endforeach; ?>
                          <?php endif; ?>

                      </tbody>
                  </table>

              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cerrar</button>
              </div>
          </div>
          <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->
  <div class="modal fade" id="modal-CamionesPropios">
      <div class="modal-dialog modal-lg">
          <div class="modal-content">
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title">Lista de camiones propios</h4>
              </div>
              <div class="modal-body">
                  <table id="tablaCamionesPropios" class="table table-bordered table-striped table-hover">
                      <thead>
                          <tr>
                              <th>ID camion</th>
                              <th>Nombres</th>
                              <th>Apellidos</th>
                              <th>CI</th>
                              <th>Placa</th>
                              <th>Capacidad</th>
                              <th>Kilometraje</th>
                              <th>Nro Senasag</th>
                              <th>Acciones</th>
                          </tr>
                      </thead>
                      <tbody>
                          <?php if (!empty($camionesPropios)) : ?>
                              <?php foreach ($camionesPropios as $row) : ?>
                                  <tr>
                                      <td><?php echo $row->ID_camion ?></td>
                                      <td><?php echo $row->Nombres ?></td>
                                      <td><?php echo $row->Apellido_p . ' ' . $row->Apellido_m ?></td>
                                      <td><?php echo $row->CI ?></td>
                                      <td><?php echo $row->N_Placa ?></td>
                                      <td><?php echo $row->Capacidad ?></td>
                                      <td><?php echo $row->Kilometraje ?></td>
                                      <td><?php echo $row->N_Senasag ?></td>
                                      <?php $dataCamionesPropios = $row->ID_camion . "*" . $row->Nombres . "*" . $row->Apellido_p . "*" . $row->Apellido_m . "*" . $row->CI . "*" . $row->N_Placa . "*" . $row->Modelo . "*" . $row->Marca . "*" . $row->Color . "*" . $row->Capacidad . "*" . $row->Kilometraje . "*" . $row->N_Senasag; ?>

                                      <td>
                                          <button type="button" class="btn btn-success btn-check-camionesPropios" value="<?php echo $dataCamionesPropios ?>"><span class="fa fa-check"></span></button>
                                      </td>
                                  </tr>
                              <?php endforeach; ?>
                          <?php endif; ?>

                      </tbody>
                  </table>

              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cerrar</button>
              </div>
          </div>
          <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->