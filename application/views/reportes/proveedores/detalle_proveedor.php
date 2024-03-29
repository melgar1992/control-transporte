<div class="row">
    <div class="col-xs-12 text-left">
        <b>Detalle de Proveedor</b><br>
        Nombre : <?php echo $Proveedor['Nombres'] . ' ' . $Proveedor['Apellidos']; ?> <br>
        CI : <?php echo $Proveedor['CI']; ?><br>
        Fecha : <?php echo date('Y-m-d'); ?><br>
    </div>
</div>
<br>
</br>
<div class="row">
    <div class="table-responsive col-md-12 col-xs-12">
        <table class="table table-bordered table-condensed">
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Descripcion</th>
                    <th>Placa</th>
                    <th>Tramo</th>
                    <th>Precio</th>
                    <th>Comision</th>
                    <th>Cantidad</th>
                    <th>Acta</th>
                    <th>Descuento</th>
                    <th>Ingreso</th>
                    <th>Egreso</th>
                    <th>Balance</th>
                    <th>Opciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $balance = 0;
                if (count($detalleProveedor) > 0) {
                    foreach ($detalleProveedor as $row) {
                        $balance = $balance + (float)$row['Ingreso'] - (float)$row['Egreso'];
                        $fecha = new DateTime($row['Fecha']);
                ?>
                        <tr>
                            <td><?php echo date_format($fecha, 'Y-M-d') ?></td>
                            <td><?php echo $row['Descripcion'] ?></td>
                            <td><?php echo $row['N_Placa'] ?></td>
                            <td><?php echo ($row['Origen']) ? $row['Origen'] . " -> " . $row['Destino'] : ""; ?></td>
                            <td><?php echo $row['Precio'] ?></td>
                            <td><?php echo $row['Comision'] ?></td>
                            <td><?php echo $row['Cantidad'] ?></td>
                            <td><?php echo $row['Acta'] ?></td>
                            <td><?php echo $row['Descuento'] ?></td>
                            <td ALIGN="center"><?php echo number_format($row['Ingreso'], 2) ?></td>
                            <td ALIGN="center"><?php echo number_format($row['Egreso'], 2) ?></td>
                            <td ALIGN="center"><?php echo number_format($balance, 2) ?></td>
                            <td>
                                <?php if ($row['ID_transporte'] > 0) { ?>
                                    <button type="button" value="<?php echo $row['ID_transporte'] ?>" class="btn btn-warning btn-editar-transporte_camion"><span class='fas fa-pencil-alt'></span></button>
                                <?php } else { ?>
                                    <button type="button" value="<?php echo $row['ID_pago_cuentas'] ?>" class="btn btn-warning btn-editar-pago"><span class='fas fa-pencil-alt'></span></button>
                                <?php } ?>
                            </td>
                        </tr>
                <?php }
                }

                ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="11">Total de Balance</td>
                    <td><?php echo number_format($balance, 2); ?> Bs</td>
                </tr>
            </tfoot>

    </div>
</div>