<div class="right_col" role="main">
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Reporte de otros <small>-</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>

                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="container">
                        <div class="row">
                            <form action="" id="reporteTaller">
                                <div class="col-md-2 col-xs-12">
                                    <select name="taller" id="ID_taller" class="form-control" required>
                                        <option value=""></option>
                                        <?php foreach ($talleres as $taller) : ?>
                                            <option value="<?php echo $taller->ID_taller; ?>">
                                                <?php echo $taller->NombreTaller ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <label for="fechaIni" class="col-md-1 col-xs-12 control-label text-right">Desde: </label>
                                <div class="col-md-3 col-xs-12">
                                    <input type="date" name="fechaIni" id="fechaIni" class="form-control" required>
                                </div>
                                <label for="fechaFin" class="col-md-1 col-xs-12 control-label text-right">Hasta: </label>
                                <div class="col-md-3 col-xs-12">
                                    <input type="date" name="fechaFin" id="fechaFin" class="form-control" required>
                                </div>
                                &nbsp;
                                <div class="col-md-1 col-xs-12">
                                    <button type="submit" class="btn btn-block btn-success">Generar</button>
                                </div>
                            </form>
                        </div>
                        <hr>
                    </div>
                    <div class="reportetaller hidden">
                        <div class="row">
                            <div class="col-xs-12 text-left">
                                <b>Reporte de otros</b><br>
                                Nombre : <b id="nombre_taller"></b> <br>
                                Fecha : <?php echo date('Y-m-d'); ?><br>
                                Saldo anterior : <b class="" id="balance_anterior"></b> Bs<br>
                                Balance Actual : <b class="" id="balance_actual"></b> Bs<br>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <b>Tabla detalle cuenta</b>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <table id="tabla_reporte" class="table table-bordered jambo_table">
                                    <thead>
                                        <tr>
                                            <th>Fecha</th>
                                            <th>Placa</th>
                                            <th>Descripcion</th>
                                            <th>Precio unitario</th>
                                            <th>Cantidad</th>
                                            <th>Debe</th>
                                            <th>Haber</th>
                                            <th>Balance</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                    <tfoot>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        <hr>
                    </div>
                    <div class="row">
                        <button type="button" class="btn btn-primary btn-print"><span class="fa fa-print">Imprimir</span></button>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>