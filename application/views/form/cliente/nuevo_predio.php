<div class="right_col" role="main">
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Predios registrados <small>-</small></h2>
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
                                <button class="btn btn-success" id='btn-nuevo' type="button" data-toggle="modal" data-target='#modal-predio'>Agregar</button>
                            </div>
                        </div>
                    </div>

                    <br>

                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>Tabla de Predios</h2>
                                <ul class="nav navbar-right panel_toolbox">
                                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                    </li>

                                    </li>
                                </ul>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">

                                <div class="table-responsive">
                                    <table class="table table-bordered" id="tablaPredio">
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
                                            <?php
                                            if (count($predios) > 0) {
                                                foreach ($predios as $row) { ?>
                                                    <tr>
                                                        <td><?php echo $row->ID_predio ?></td>
                                                        <td><?php echo $row->NombrePredio ?></td>
                                                        <td><?php echo $row->Direccion ?></td>
                                                        <td><?php echo $row->Departamento ?></td>
                                                        <td><?php echo $row->Provincia ?></td>
                                                        <td><?php echo $row->Municipio ?></td>
                                                        <td><?php echo $row->NombrePropietario . ' ' . $row->ApellidoPropietario ?></td>
                                                        <td><?php echo $row->TipoPredio ?></td>
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
<div class="modal fade" id="modal-predio">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Formulario predio</h4>
            </div>
            <form action="" id="formpredio">
                <div class="modal-body">

                    <div class="error_formulario">
                    </div>

                    <div class="form-group">
                        <label class="control-label" for="NombrePredio">Nombre Predio <span class="required">*</span>
                        </label>
                        <div class="">
                            <input type="text" id="NombrePredio" maxlength="60" name="NombrePredio" required="required" class="form-control col-md-7 col-xs-12">
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
                        <label for="Departamento" class="control-label">Departamento *:</label>
                        <div class="">
                            <select id="Departamento" name="Departamento" class="form-control" required='required'>
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
                        <label class="control-label" for="Provincia">Provincia 
                        </label>
                        <div class="">
                            <input type="text" maxlength="45" id="Provincia" name="Provincia"  class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="Municipio">Municipio 
                        </label>
                        <div class="">
                            <input type="text" maxlength="45" id="Municipio" name="Municipio"  class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="NombrePropietario">Nombre Propietario 
                        </label>
                        <div class="">
                            <input type="text" id="NombrePropietario" maxlength="60" name="NombrePropietario"  class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="ApellidoPropietario">Apellido Propietario
                        </label>
                        <div class="">
                            <input type="text" id="ApellidoPropietario" maxlength="60" name="ApellidoPropietario"  class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="TipoPredio" class="control-label">Tipo Predio *:</label>
                        <div class="">
                            <select id="TipoPredio" name="TipoPredio" class="form-control" required='required'>
                                <option value=""></option>
                                <option value="Estancia">Estancia</option>
                                <option value="Confinamiento">Confinamiento</option>
                                <option value="Matadero">Matadero</option>
                                <option value="Transito">Transito</option>
                            </select>
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