<!-- page content -->

<div class="right_col" role="main">

  <div class="" role="main">
    <div class="row tile_count">
      <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
        <span class="count_top"><i class="fa fa-truck"></i>Balance de camiones</span>
        <div class="count green"><?php echo number_format($balance_camiones, 2)  ?>
          <small>Bs</small>
        </div>
        <span class="count_bottom">Balance de los camiones del año actual</span>
      </div>
      <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
        <span class="count_top"><i class="fa fa-money"></i> Ingreso por comisión</span>
        <div class="count green"><?php echo number_format($comision['comision'], 2)  ?>
          <small>Bs</small>
        </div>
        <span class="count_bottom"> Ingreso por comision del año actual</span>
      </div>
      <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
        <span class="count_top"><i class="fa fa-money"></i> Liquidez</span>
        <div class="count green"><?php echo number_format($BalanceCuentas, 2)  ?>
          <small>Bs</small>
        </div>
        <span class="count_bottom">Liquides de las cuentas de la empresa</span>
      </div>
      <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
        <span class="count_top"><i class="fa fa-money"></i> Cuentas por cobrar</span>
        <div class="count <?php echo ($CuentasPorCobrar >= 0) ? 'green' : 'red' ?>"><?php echo number_format($CuentasPorCobrar, 2)  ?>
          <small>Bs</small>
        </div>
        <span class="count_bottom"> Balance de las cuentas de los clientes</span>
      </div>
      <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
        <span class="count_top"><i class="fa fa-money"></i> Cuentas por pagar</span>
        <div class="count red"><?php echo number_format($CuentasPorPagar, 2) ?>
          <small>Bs</small>
        </div>
        <span class="count_bottom"> Balance de las cuentas por pagar</span>
      </div>
      <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
        <span class="count_top"><i class="fa fa-money"></i> Balance</span>
        <div class="count <?php echo ($Balance >= 0) ? 'green' : 'red' ?>"><?php echo number_format(abs($Balance), 2) ?>
          <small>Bs</small>
        </div>
        <span class="count_bottom"> Balance de la empresa</span>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Grafico transporte general </h2>
            <ul class="nav navbar-right panel_toolbox">
              <select name="year" id="year" class="form-control">
                <?php foreach ($year as $row) : ?>
                  <option value="<?php echo $row['year'] ?>"><?php echo $row['year'] ?></option>
                <?php endforeach; ?>
              </select>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <div class="GraficoMovimiento" id="GraficoMovimiento" style="position: relative; height: 300px;">
              <canvas id="GraficoM"></canvas>
            </div>
          </div>
        </div>

      </div>
    </div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Tablas de balances</h2>
            <ul class="nav navbar-right panel_toolbox">
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
              </li>

              </li>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <div class="" role="tabpanel" data-example-id="togglable-tabs">
              <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                <li role="tablaProdcutos" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Clientes</a>
                </li>
                <li role="tablaProdcutos" class=""><a href="#tab_content2" id="home-tab" role="tab" data-toggle="tab" aria-expanded="false">Proveedores</a>
                </li>
                <li role="tablaProdcutos" class=""><a href="#tab_content3" id="home-tab" role="tab" data-toggle="tab" aria-expanded="false">Cuentas camiones</a>
                </li>
              </ul>
              <div id="myTabContent" class="tab-content">
                <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
                  <table class="table table-hover jambo_table" id="tablaDetalleCliente">
                    <thead>
                      <tr>
                        <th>ID cliente</th>
                        <th>Nombres</th>
                        <th>Apellidos </th>
                        <th>Balance</th>
                        <th>Acciones</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      if (isset($DetalleBalanceCliente)) {
                        foreach ($DetalleBalanceCliente as $row) {
                          if ($row['balance'] != 0) { ?>
                            <tr>
                              <td><?php echo $row['ID_cliente'] ?></td>
                              <td><?php echo $row['Nombre'] ?></td>
                              <td><?php echo $row['Apellidos'] ?></td>
                              <td><?php echo $row['balance'] ?></td>
                              <td>
                                <div class='text-center'>
                                  <button type="button" title="Reporte cliente" class="btn btn-info btn-reporte-cliente" data-toggle="modal" data-target="#modal-detalle" value=""><span class="fa fa-search"></span></button>
                                </div>
                              </td>
                            </tr>
                      <?php }
                        }
                      }
                      ?>
                    </tbody>
                    <tfoot>
                      <tr>
                        <th>ID cliente</th>
                        <th>Nombres</th>
                        <th style="text-align:right">Total de general:</th>
                        <th colspan="2" style="text-align: left"></th>
                      </tr>
                    </tfoot>
                  </table>
                  <!-- Tabla responsiva-->
                </div>
                <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">
                  <table class="table table-hover jambo_table" id="tablaDetalleProveedores">
                    <thead>
                      <tr>
                        <th>ID proveedor</th>
                        <th>Nombres</th>
                        <th>Apellidos </th>
                        <th>Balance</th>
                        <th>Acciones</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      if (isset($DetalleBalanceProveedores)) {
                        foreach ($DetalleBalanceProveedores as $row) {
                          if ($row['balance'] != 0) { ?>
                            <tr>
                              <td><?php echo $row['ID_proveedor'] ?></td>
                              <td><?php echo $row['Nombres'] ?></td>
                              <td><?php echo $row['Apellidos'] ?></td>
                              <td><?php echo $row['balance'] ?></td>
                              <td>
                                <div class='text-center'>
                                  <button type="button" title="Reporte completo" class="btn btn-info btn-reporte-proveedor" data-toggle="modal" data-target="#modal-detalle" value=""><span class="fa fa-search"></span></button>
                                </div>
                              </td>
                            </tr>
                      <?php }
                        }
                      }
                      ?>
                    </tbody>
                    <tfoot>
                      <tr>
                        <th>ID cliente</th>
                        <th>Nombres</th>
                        <th style="text-align:right">Total de general:</th>
                        <th colspan="2" style="text-align: left"></th>
                      </tr>
                    </tfoot>
                  </table>
                  <!-- Tabla responsiva-->
                </div>
                <div role="tabpanel" class="tab-pane fade" id="tab_content3" aria-labelledby="profile-tab">
                  <table class="table table-hover jambo_table" id="tablaDetalleTaller">
                    <thead>
                      <tr>
                        <th>ID cuenta</th>
                        <th>Nombre cuenta</th>
                        <th>Departamento </th>
                        <th>Balance</th>
                        <th>Acciones</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      if (isset($DetalleBalanceTaller)) {
                        foreach ($DetalleBalanceTaller as $row) {
                          if ($row['balance'] != 0) { ?>
                            <tr>
                              <td><?php echo $row['ID_taller'] ?></td>
                              <td><?php echo $row['NombreTaller'] ?></td>
                              <td><?php echo $row['Departamento'] ?></td>
                              <td><?php echo $row['balance'] ?></td>
                              <td>
                                <div class='text-center'>
                                  <button type="button" title="Reporte completo" class="btn btn-info btn-reporte-taller" data-toggle="modal" data-target="#modal-detalle" value=""><span class="fa fa-search"></span></button>
                                </div>
                              </td>
                            </tr>
                      <?php }
                        }
                      }
                      ?>
                    </tbody>
                    <tfoot>
                      <tr>
                        <th>ID cliente</th>
                        <th>Nombres</th>
                        <th style="text-align:right">Total de general:</th>
                        <th colspan="2" style="text-align: left"></th>
                      </tr>
                    </tfoot>
                  </table>
                  <!-- Tabla responsiva-->
                </div>
              </div>
            </div><!-- Termina el contenido del row-->
          </div>
        </div>

      </div>

    </div>

  </div>
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>Reportes de camiones empresa </h2>
          <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
            </li>

            </li>
          </ul>

          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <form action="" id="reporte-camion">
            <div class="form-group">
              <label for="camion" class="col-md-1 col-xs-12 control-label text-right">Camion: </label>
              <div class="col-md-2 col-xs-12">
                <select name="camion" id="camion" class="form-control" required>
                  <option value=""></option>
                  <?php foreach ($camiones as $row) : ?>
                    <option value="<?php echo $row->ID_camion ?>"><?php echo $row->N_Placa . ' - ' . $row->Marca ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
              <label for="fechaIni" class="col-md-1 col-xs-12 control-label text-right">Desde: </label>
              <div class="col-md-2 col-xs-12">
                <input type="date" name="fechaIni" id="fechaIni" class="form-control" required>
              </div>
              <label for="fechaFin" class="col-md-1 col-xs-12 control-label text-right">Hasta: </label>
              <div class="col-md-2 col-xs-12">
                <input type="date" name="fechaFin" id="fechaFin" class="form-control" required>
              </div>
              <div class="col-md-1 col-xs-12">
                <button type="submit" class="btn btn-block btn-success">Generar</button>
              </div>
            </div>
            <br></br>
          </form>
          <hr style="border:2px;"></hr>
          <div class="Reporte-camion hidden">
            <div class="row">
              <div class="col-lg-4 col-md-5 col-sm-6 col-xs-12" id="GraficoDCamionesEmpresa">
                <canvas id="GraficoDoughnutsCamionesEmpresa"></canvas>
              </div>
              <div class="col-md-5 col-sm-6 col-xs-12">
                <table class="table tabla-gastos-categoria-camion">
                  <thead>
                    <tr>
                      <th class="col-md-3 col-sm-4 col-xs-12">
                        <p>Descripcion</p>
                      </th>
                      <th class="col-md-2 col-sm-2 col-xs-12">
                        <p>Total</p>
                      </th>
                    </tr>
                  </thead>
                  <tbody>

                  </tbody>
                </table>
              </div>
            </div>
            <hr style="border:2px;"></hr>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Detalle de reporte </h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>

                      </li>
                    </ul>

                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div>
                      <table id="tabla_detalle_camion" class="table table-bordered jambo_table">
                        <thead>
                          <tr>
                            <th>Placa</th>
                            <th>Fecha </th>
                            <th>Descripcion</th>
                            <th>Precio</th>
                            <th>Cantidad</th>
                            <th>Descuento</th>
                            <th>Ingreso</th>
                            <th>Egreso</th>
                            <th>Balance</th>
                          </tr>
                        </thead>
                        <tbody>

                        </tbody>
                        <tfoot>
                          <tr>
                            <th colspan="6">Total</th>
                            <th></th>
                            <th></th>
                            <th></th>
                          </tr>
                        </tfoot>
                      </table>

                    </div>
                  </div>
                </div>
              </div>

            </div>
          </div>

        </div>
      </div>
    </div>

  </div>
</div>
</div>



<!-- /page content -->

<div class="modal fade" id="modal-detalle">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Detalle de cuenta</h4>
      </div>
      <div class="modal-body ui-front">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary btn-print"><span class="fa fa-print">Imprimir</span></button>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
</div>
<!-- /.modal -->