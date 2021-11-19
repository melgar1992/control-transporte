<div class="right_col" role="main">
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Calendario de transporte <small>-</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">

                    <div id="calendario"></div>

                </div>
            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="modal">
    <div class="modal-dialog modal-xs">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="titulo"></h4>
            </div>
            <div class="modal-body ui-front">

                <b>Descripcion</b>
                <h5 id="descripcion"></h5>
                <b>Origen</b>
                <h5 id="origen"></h5>
                <b>Destino</b>
                <h5 id="destino"></h5>
                <b>Balance</b>
                <h5 id="total"></h5>

            </div>
            <div class="modal-footer">
                <button type="button" id="btn-editar-transporte-cliente" class="btn btn-warning">Editar</button>
                <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cerrar</button>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</div>
<!-- /.modal -->