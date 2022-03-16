<div class="right_col" role="main">
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Editar <small>-</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <?php if (isset($cliente)) { ?>
                        <?php print_r($Pago_Cliente); ?>
                        <form action="" id="formPagoCliente">
                            <div class="modal-body">
                                <div class="error_formulario">
                                </div>
                                <div class="form-group">
                                    <label for="ID_Cliente" class="control-label">Cliente *:</label>
                                    <div class="">
                                        <select id="ID_Cliente" name="ID_Cliente" class="form-control" required='required'>
                                            <option value=""></option>
                                            <?php foreach ($Clientes as $row) : ?>
                                                <?php if ($row->ID_Cliente == $Pago_Cliente['ID_Cliente']) { ?>
                                                    <option value="<?php echo $row->ID_Cliente ?>" selected><?php echo $row->Nombre . ' ' . $row->Apellidos ?></option>
                                                <?php } else { ?>
                                                    <option value="<?php echo $row->ID_Cliente ?>"><?php echo $row->Nombre . ' ' . $row->Apellidos ?></option>
                                                <?php } ?>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="Fecha">Fecha<span class="required">*</span>
                                    </label>
                                    <div class="">
                                        <input type="date" id="Fecha" value="<?php echo $Pago_Cliente['fecha'] ?>" name="Fecha" required="required" class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Descripcion" class="control-label">Descripcion <span class="required">*</span>
                                    </label>
                                    <div class="">
                                        <textarea name="Descripcion" maxlength="100" id="Descripcion" class="form-control" rows="3" placeholder="Descripcion del movimiento" required="required"><?php echo $Pago_Cliente['Descripcion'] ?></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="Debe">Debe<span class="required">*</span>
                                    </label>
                                    <div class="">
                                        <input type="number" id="Debe" min="0" value="<?php echo $Pago_Cliente['Debe'] ?>" name="Debe" class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="Haber">Haber<span class="required">*</span>
                                    </label>
                                    <div class="">
                                        <input type="number" id="Haber" min="0" value="<?php echo $Pago_Cliente['Haber'] ?>" name="Haber" class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>

                                <br> </br>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger pull-left" id="btn-cerrar" data-dismiss="modal">Cerrar</button>
                                <button class="btn btn-primary pull-right" type="reset">Borrar</button>
                                <button type="submit" class="btn btn-warning pull-right" id="btn-editar">Editar</button>
                            </div>
                        </form>
                    <?php } ?>
                    <br />
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12 col-lg-12">

                            </div>
                        </div>
                    </div>

                    <br>

                </div>
            </div>

        </div>
    </div>
</div>
<!-- /.modal -->