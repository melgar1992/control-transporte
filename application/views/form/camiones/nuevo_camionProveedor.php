<div class="right_col" role="main">
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Camiones <small>-</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>

                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br />
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12 col-lg-12">
                                <button class="btn btn-success" id='btn-nuevo' type="button" data-toggle="modal" data-target='#modal-camionProveedor'>Agregar</button>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="x_panel">
                    <div class="x_title">
                        <h2>Tabla de camiones de proveedores</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>

                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">

                        <div class="table-responsive">
                            <table class="table table-bordered" id="tablaCamionesProveedor">
                                <thead>
                                    <tr>
                                        <th>ID camion</th>
                                        <th>Proovedor</th>
                                        <th>Nombre chofer</th>
                                        <th>CI</th>
                                        <th>Telefono</th>
                                        <th>Placa</th>
                                        <th>Marca</th>
                                        <th>Color</th>
                                        <th>Capacidad</th>
                                        <th>Nro Senasag</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody id="datos-camiones-propios">
                                    <?php
                                    if (count($camionesProveedor) > 0) {
                                        foreach ($camionesProveedor as $row) { ?>
                                            <tr>
                                                <td><?php echo $row->ID_camion ?></td>
                                                <td><?php echo $row->NombreProveedor . ' ' .  $row->ApellidosProveedor ?></td>
                                                <td><?php echo $row->NombresChofer ?></td>
                                                <td><?php echo $row->CI ?></td>
                                                <td><?php echo $row->Telefono ?></td>
                                                <td><?php echo $row->N_Placa ?></td>
                                                <td><?php echo $row->Marca ?></td>
                                                <td><?php echo $row->Color ?></td>
                                                <td><?php echo $row->Capacidad ?></td>
                                                <td><?php echo $row->N_Senasag ?></td>
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

<div class="modal fade" id="modal-camionProveedor">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Formulario camiones proveedores</h4>
            </div>
            <form action="" id="formcamionProveedor">
                <div class="modal-body ui-front">
                    <div class="form-group">
                        <label for="ID_proveedor" class="control-label">Proveedor :</label>
                        <div class="">
                            <select id="ID_proveedor" name="ID_proveedor" class="form-control" required='required'>
                                <option value=""></option>
                                <?php foreach ($Proveedores as $proveedor) : ?>
                                    <option value="<?php echo $proveedor->ID_proveedor ?>"><?php echo $proveedor->Nombres . ' ' . $proveedor->Apellidos ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="NombresChofer">Nombre completo del chofer <span class="required">*</span>
                        </label>
                        <div class="">
                            <input type="text" onkeyup="mayus(this);" maxlength="40" id="NombresChofer" name="NombresChofer" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="CI">CI <span class="required">*</span>
                        </label>
                        <div class="">
                            <input type="number" maxlength="10" id="CI" name="CI" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="Telefono">Telefono
                        </label>
                        <div class="">
                            <input type="text" onkeyup="mayus(this);" maxlength="10" id="Telefono" name="Telefono" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="N_Placa">Placa <span class="required">*</span>
                        </label>
                        <div class="">
                            <input type="text" maxlength="10" required='required' id="N_Placa" name="N_Placa" class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="Marca">Marca
                        </label>
                        <div class="">
                            <input type="text" maxlength="20" id="Marca" name="Marca" class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="Color">Color
                        </label>
                        <div class="">
                            <input type="text" maxlength="40" id="Color" name="Color" class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="Capacidad" class="control-label">Capacidad<span class="required">*</span>
                        </label>
                        <div class="">
                            <input id="Capacidad" class="form-control col-md-7 col-xs-12" type="number" min='0' maxlenght='2' max='80' name="Capacidad" required="required" placeholder="50, 40, 35">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="N_senasag" class="control-label">Numero Senasag
                        </label>
                        <div class="">
                            <input id="N_senasag" class="form-control col-md-7 col-xs-12" type="text" name="N_senasag" placeholder="">
                        </div>
                    </div>

                    <hr>
                    </hr>
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