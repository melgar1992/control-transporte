<div class="right_col" role="main">
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Cuentas o caja de la empresa <small>-</small></h2>
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
                                <button class="btn btn-success" id='btn-nuevo' type="button" data-toggle="modal" data-target='#modal-cuentaEmpresa'>Agregar</button>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="x_panel">
                    <div class="x_title">
                        <h2>Tabla de cuentas o caja de la empresa</h2>
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
                            <table class="table table-bordered" id="tablaCuentasEmpresa">
                                <thead>
                                    <tr>

                                        <th>ID de cuenta</th>
                                        <th>Tipo cuenta</th>
                                        <th>Nombre de la cuenta</th>
                                        <th>Descripcion</th>
                                        <th>Balance</th>
                                        <th>Acciones</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (isset($cuenta_empresa)) {
                                        foreach ($cuenta_empresa as $row) { ?>
                                            <tr>
                                                <td><?php echo $row['ID_cuenta_empresa'] ?></td>
                                                <td><?php echo $row['nombre'] ?></td>
                                                <td><?php echo $row['Nombre_cuenta'] ?></td>
                                                <td><?php echo $row['Descripcion'] ?></td>
                                                <td><?php echo number_format($row['balance'], 2)  ?></td>
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
            </div>

        </div>
    </div>

</div>

<div class="modal fade" id="modal-cuentaEmpresa">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Formulario cuentas o cajas de la empresa</h4>
            </div>
            <form action="" id="formcuentaEmpresa">
                <div class="modal-body ui-front">

                    <div class="form-group">
                        <label class="control-label" for="ID_tipo_cuenta">Seleccionar el tipo de cuenta <span class="required">*</span>
                        </label>
                        <div class="">
                            <select id="ID_tipo_cuenta" name="ID_tipo_cuenta" class="form-control" required='required'>
                                <option value=""></option>
                                <?php foreach ($tipo_cuenta as $row) : ?>
                                    <option value="<?php echo $row['ID_tipo_cuenta'] ?>"><?php echo $row['nombre'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="Nombre_cuenta">Nombre de la cuenta <span class="required">*</span>
                        </label>
                        <div class="">
                            <input type="text" id="Nombre_cuenta" maxlength="45" name="Nombre_cuenta" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="Descripcion">Descripcion de la cuenta <span class="required">*</span>
                        </label>
                        <div class="">
                        <textarea name="Descripcion" id="Descripcion" class="form-control" rows="3" placeholder="Dirección" required="required"></textarea>
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