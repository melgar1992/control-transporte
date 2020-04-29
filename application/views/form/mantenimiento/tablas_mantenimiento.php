<div class="right_col" role="main">
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Mantenimiento <small>-</small></h2>
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
                                <a href="<?php echo site_url(); ?>/mantenimiento/nuevoMantenimiento">
                                <button class="btn btn-success" id='btn-nuevo' type="button" >Agregar</button>
                                </a>
                            </div>
                        </div>
                    </div>

                    <br>

                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>Tabla de Mantenimiento</h2>
                                <ul class="nav navbar-right panel_toolbox">
                                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                    </li>

                                    </li>
                                </ul>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">

                                <div class="table-responsive">
                                    <table class="table table-bordered" id="tablaMantenimiento">
                                        <thead>
                                            <tr>
                                                <th>ID Mantenimiento</th>
                                                <th>Nombre empleado</th>
                                                <th>Fecha </th>
                                                <th>Descripcion</th>
                                                <th>Cambio Aceite</th>
                                                <th>Total</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if (count($mantenimientos) > 0) {
                                                foreach ($mantenimientos as $row) { ?>
                                                    <tr>
                                                        <td><?php echo $row->ID_Mantenimiento ?></td>
                                                        <td><?php echo $row->Nombres . ' ' . $row->Apellido_p . ' ' . $row->Apellido_m ?></td>
                                                        <td><?php echo $row->Fecha_mantenimiento ?></td>
                                                        <td><?php echo $row->Descripcion ?></td>
                                                        <td><?php echo $row->CambioAceite ?></td>
                                                        <td><?php echo $row->MontoTotal ?></td>
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