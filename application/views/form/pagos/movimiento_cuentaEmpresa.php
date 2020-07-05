<div class="right_col" role="main">
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Registro de transacciones de cuentas de la empresa <small>-</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>

                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br />
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12 col-lg-12">
                                <button class="btn btn-success" id='btn-nuevo' type="button" data-toggle="modal" data-target='#modal-MovimientoCuentaEmpresa'>Agregar</button>
                            </div>
                        </div>
                    </div>

                    <br>

                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>Tabla de transacciones de las cuentas</h2>
                                <ul class="nav navbar-right panel_toolbox">
                                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                    </li>

                                    </li>
                                </ul>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">

                                <div class="table-responsive">
                                    <table class="table table-bordered" id="tablaMovimientoCuentaEmpresa">
                                        <thead>
                                            <tr>
                                                <th>ID Transaccion</th>
                                                <th>Fecha</th>
                                                <th>Nombre cuenta</th>
                                                <th>Descripcion de la cuenta</th>
                                                <th>Descripcion</th>
                                                <th>Debe</th>
                                                <th>Haber</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if (count($movimiento_cuentaEmpresa) > 0) {
                                                foreach ($movimiento_cuentaEmpresa as $row) { ?>
                                                    <tr>
                                                        <td><?php echo $row->ID_pago_cuentas ?></td>
                                                        <td><?php echo $row->fecha ?></td>
                                                        <td><?php echo $row->Nombre_cuenta ?></td>
                                                        <td><?php echo $row->DescripcionCuenta ?></td>
                                                        <td><?php echo $row->Descripcion ?></td>
                                                        <td><?php echo $row->Debe ?></td>
                                                        <td><?php echo $row->Haber ?></td>
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
                            </div> <!-- contenedor Tabla -->
                        </div>
                    </div> <!-- Contenedor de toda la tabla -->
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
<div class="modal fade" id="modal-MovimientoCuentaEmpresa">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Formulario transacciones de cuentas de empresa</h4>
            </div>
            <form action="" id="formMovimientoCuentaEmpresa">
                <div class="modal-body">

                    <div class="error_formulario">
                    </div>
                    <div class="form-group">
                        <label for="ID_cuenta_empresa" class="control-label">Cuenta *:</label>
                        <div class="">
                            <select id="ID_cuenta_empresa" name="ID_cuenta_empresa" class="form-control" required='required'>
                                <option value=""></option>
                                <?php foreach ($cuenta_empresa as $row) : ?>
                                    <option value="<?php echo $row['ID_cuenta_empresa'] ?>"><?php echo $row['Nombre_cuenta'] . ' - ' . $row['Descripcion'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="Fecha">Fecha<span class="required">*</span>
                        </label>
                        <div class="">
                            <input type="date" id="Fecha" value="<?php echo date('Y-m-d') ?>" name="Fecha" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="Descripcion" class="control-label">Descripcion <span class="required">*</span>
                        </label>
                        <div class="">
                            <textarea name="Descripcion" maxlength="100" id="Descripcion" class="form-control" rows="3" placeholder="Descripcion del movimiento" required="required"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="Debe">Debe<span class="required">*</span>
                        </label>
                        <div class="">
                            <input type="number" id="Debe" min="0" value="0" name="Debe" class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="Haber">Haber<span class="required">*</span>
                        </label>
                        <div class="">
                            <input type="number" id="Haber" min="0" value="0" name="Haber" class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>

                    <br> </br>
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