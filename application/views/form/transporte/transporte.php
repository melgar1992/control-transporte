<div class="right_col" role="main">
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Transporte <small>-</small></h2>
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
                                <a href="<?php echo site_url(); ?>/transporte/nuevoTransporte">
                                    <button class="btn btn-success" id='btn-nuevo' type="button">Agregar</button>
                                </a>
                            </div>
                        </div>
                    </div>

                    <br>

                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>Tabla de Transporte</h2>
                                <ul class="nav navbar-right panel_toolbox">
                                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                    </li>

                                    </li>
                                </ul>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">

                                <div class="table-responsive">
                                    <table class="table table-bordered table-condensed" id="tablaTransporte">
                                        <thead>
                                            <tr>
                                                <th>ID Transporte</th>
                                                <th>Fecha</th>
                                                <th>Origen</th>
                                                <th>Destino</th>
                                                <th>Cliente</th>
                                                <th>Descripcion</th>
                                                <th>SubTotal</th>
                                                <th>Comision</th>
                                                <th>Descuento</th>
                                                <th>Total</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if (count($transportes) > 0) {
                                                foreach ($transportes as $row) { ?>
                                                    <tr>
                                                        <td><?php echo $row->ID_transporte ?></td>
                                                        <td><?php echo $row->Fecha ?></td>
                                                        <td><?php echo $row->NombrePredioOringen ?></td>
                                                        <td><?php echo $row->NombrePredioDestino ?></td>
                                                        <td><?php echo $row->NombreCliente . ' ' . $row->ApellidosCliente?></td>
                                                        <td><?php echo $row->Descripcion ?></td>
                                                        <td><?php echo $row->SubTotal ?></td>
                                                        <td><?php echo $row->comisionTotal ?></td>
                                                        <td><?php echo $row->DescuentoTotal ?></td>
                                                        <td><?php echo $row->Total ?></td>
                                                        <td>
                                                            <button class="btn btn-warning btn-sm" title="Editar"  value="" id="btn-editar"><i class="fas fa-pencil-alt"></i></button>
                                                            <button class="btn btn-danger btn-sm"  title="Borrar" id="btn-borrar"><i class="fas fa-trash-alt"></i></button>
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

<div class="modal fade" id="modal-vista">
         <div class="modal-dialog modal-lg">
             <div class="modal-content">
                 <div class="modal-header">
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span></button>
                     <h4 class="modal-title">Vista</h4>
                 </div>
                 <div class="modal-body">


                 </div>
                 <div class="modal-footer">
                     <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cerrar</button>
                     <button type="button" class="btn btn-primary btn-print"><span class="fa fa-print">Imprimir</span></button>
                 </div>
             </div>
             <!-- /.modal-content -->
         </div>
         <!-- /.modal-dialog -->
     </div>