<div class="right_col" role="main">
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Registro de transacciones de clientes <small>-</small></h2>
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
                                <button class="btn btn-success" id='btn-nuevo' type="button" >Agregar</button>
                            </div>
                        </div>
                    </div>

                    <br>

                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>Tabla de usuarios</h2>
                                <ul class="nav navbar-right panel_toolbox">
                                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                    </li>

                                    </li>
                                </ul>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">

                                <div class="table-responsive">
                                    <table class="table table-bordered" id="tablaUsuarios">
                                        <thead>
                                            <tr>
                                                <th>ID usuario</th>
                                                <th>Nombre de usuario</th>
                                                <th>Privilegios</th>
                                                <th>Nombre y apellido</th>
                                                <th>CI</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if (count($Usuarios) > 0) {
                                                foreach ($Usuarios as $row) { ?>
                                                    <tr>
                                                        <td><?php echo $row['ID_user'] ?></td>
                                                        <td><?php echo $row['username'] ?></td>
                                                        <td><?php echo $row['privilegios'] ?></td>
                                                        <td><?php echo $row['nombre'] . ' ' . $row['apellidos'] ?></td>
                                                        <td><?php echo $row['CI'] ?></td>
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
<div class="modal fade" id="modal-Usuarios">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Formulario de un nuevo usuario</h4>
            </div>
            <form action="" id="formUsuarios" autocomplete="off">
                <div class="modal-body">

                    <div class="error_formulario">
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="username">Nombre de usuario <span class="required">*</span>
                        </label>
                        <div class="">
                            <input type="text" autocomplete="nope" value="" id="username" maxlength="45" name="username" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>
                    <div class="form-group contrasena-antigua hide">
                        <label class="control-label" for="password_actual">Contraseña actual <span class="required">*</span>
                        </label>
                        <div class="">
                            <input type="password" disabled autocomplete="nope" value="" id="password_actual" maxlength="45" name="password_actual" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="password">Contraseña <span class="required">*</span>
                        </label>
                        <div class="">
                            <input type="password" autocomplete="nope" value="" id="password" maxlength="45" name="password" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="privilegios" class="control-label">Privilegios *:</label>
                        <div class="">
                            <select id="privilegios" name="privilegios" class="form-control" required='required'>
                                <option value=""></option>
                                <option value="Administrador">Administrador</option>
                                <option value="Operador">Operador</option>
                                <option value="Empleado">Empleado</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="nombre">Nombre <span class="required">*</span>
                        </label>
                        <div class="">
                            <input type="text" id="nombre" maxlength="45" name="nombre" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="apellidos">Apellidos <span class="required">*</span>
                        </label>
                        <div class="">
                            <input type="text" id="apellidos" maxlength="45" name="apellidos" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="CI">CI <span class="required">*</span>
                        </label>
                        <div class="">
                            <input type="number" id="CI" maxlength="7" minlength="7" name="CI" required="required" class="form-control col-md-7 col-xs-12" placeholder="Número de Carnet de Identidad">
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