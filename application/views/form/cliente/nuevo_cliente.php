<div class="right_col" role="main">
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Clientes <small>-</small></h2>
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
                                <button class="btn btn-success" id='btn-nuevo' type="button" data-toggle="modal" data-target='#modal-cliente'>Agregar</button>
                            </div>
                        </div>
                    </div>

                    <br>

                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>Tabla de Clientes</h2>
                                <ul class="nav navbar-right panel_toolbox">
                                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                    </li>

                                    </li>
                                </ul>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">

                                <div class="table-responsive">
                                    <table class="table table-bordered" id="tablaCliente">
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
                                            <?php
                                            if (count($clientes) > 0) {
                                                foreach ($clientes as $row) { ?>
                                                    <tr>
                                                        <td><?php echo $row->ID_Cliente ?></td>
                                                        <td><?php echo $row->CI ?></td>
                                                        <td><?php echo $row->Nombre ?></td>
                                                        <td><?php echo $row->Apellidos ?></td>
                                                        <td><?php echo $row->Direccion ?></td>
                                                        <td><?php echo $row->Telefono_01 ?></td>
                                                        <td><?php echo $row->Telefono_02 ?></td>
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
<div class="modal fade" id="modal-cliente">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Formulario cliente</h4>
            </div>
            <form action="" id="formcliente">
                <div class="modal-body">

                    <div class="error_formulario">
                    </div>

                    <div class="form-group">
                        <label class="control-label" for="Nombre">Nombre <span class="required">*</span>
                        </label>
                        <div class="">
                            <input type="text" id="Nombre" maxlength="60" name="Nombre" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="Apellidos">Apellidos <span class="required">*</span>
                        </label>
                        <div class="">
                            <input type="text" maxlength="60" id="Apellidos" name="Apellidos" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="CI">CI <span class="required">*</span>
                        </label>
                        <div class="">
                            <input type="number" id="CI" maxlength="7" minlength="7" name="CI" required="required" class="form-control col-md-7 col-xs-12" placeholder="Número de Carnet de Identidad">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="Direccion" class="control-label">Dirección <span class="required">*</span>
                        </label>
                        <div class="">
                            <textarea name="Direccion" maxlength="200" id="Direccion" class="form-control" rows="3" placeholder="Dirección" required="required"></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="Telefono_01" class="control-label">Telefono 01 <span class="required">*</span>
                        </label>
                        <div class="">
                            <input id="Telefono_01" class="form-control col-md-7 col-xs-12" type="number" name="Telefono_01" required="required" placeholder="77800975-34622503">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="Telefono_02" class="control-label">Telefono 02
                        </label>
                        <div class="">
                            <input id="Telefono_02" class="form-control col-md-7 col-xs-12" type="number" name="Telefono_02" placeholder="77800975-34622503">
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