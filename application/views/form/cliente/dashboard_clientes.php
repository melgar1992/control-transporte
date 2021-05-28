<div class="right_col" role="main">
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Reporte de cliente<small></small></h2>
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

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
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
                    <div class="container">
                        <div class="row">
                            <form action="" id="reporteCliente">
                                <div class="col-md-2 col-xs-12">
                                    <select name="cliente" id="ID_Cliente" class="form-control" required>
                                        <option value=""></option>
                                        <?php foreach ($clientes as $row) : ?>
                                            <option value="<?php echo $row->ID_Cliente ?>"><?php echo $row->Nombre . ' ' . $row->Apellidos ?></option>
                                        <?php endforeach ?>
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
                                &nbsp;
                                <div class="col-md-1 col-xs-12">
                                    <button type="submit" class="btn btn-block btn-success">Generar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <hr style="border: 2px;">
                    <div class="reporteCliente hidden">
                                            
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>