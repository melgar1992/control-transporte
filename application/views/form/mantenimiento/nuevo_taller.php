<div class="right_col" role="main">
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>cuentas de camiones <small>-</small></h2>
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
                                <button class="btn btn-success" id='btn-nuevo' type="button" data-toggle="modal" data-target='#modal-talleres'>Agregar</button>
                            </div>
                        </div>
                    </div>

                    <br>

                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>Tabla de cuentas de camiones</h2>
                                <ul class="nav navbar-right panel_toolbox">
                                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                    </li>

                                    </li>
                                </ul>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">

                                <div class="table-responsive">
                                    <table class="table table-bordered" id="tablaTalleres">
                                        <thead>
                                            <tr>
                                                <th>ID Taller</th>
                                                <th>Nombre</th>
                                                <th>Departamento</th>
                                                <th>Direccion</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if (count($Talleres) > 0) {
                                                foreach ($Talleres as $row) { ?>
                                                    <tr>
                                                        <td><?php echo $row->ID_taller ?></td>
                                                        <td><?php echo $row->NombreTaller ?></td>
                                                        <td><?php echo $row->Departamento ?></td>
                                                        <td><?php echo $row->Direccion ?></td>
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
<div class="modal fade" id="modal-talleres">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Formulario cuentas de camiones</h4>
            </div>
            <form action="" id="formtalleres">
                <div class="modal-body">

                    <div class="error_formulario">
                    </div>

                    <div class="form-group">
                        <label class="control-label" for="NombreTaller">Nombre cuenta<span class="required">*</span>
                        </label>
                        <div class="">
                            <input type="text" id="NombreTaller" maxlength="100" name="NombreTaller" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="Departamento" class="control-label">Departamento *:</label>
                        <div class="">
                            <select id="Departamento" name="Departamento" class="form-control" required>
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
                        <label for="Direccion" class="control-label">Dirección <span class="required">*</span>
                        </label>
                        <div class="">
                            <textarea name="Direccion" maxlength="200" id="Direccion" class="form-control" rows="3" placeholder="Dirección" required="required"></textarea>
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