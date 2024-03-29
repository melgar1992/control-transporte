<div class="row">
    <div class="col-xs-12 text-left">
        <b>Detalle de Cuenta</b><br>
        Nombre cuenta : <?php echo $Taller['NombreTaller']; ?> <br>
        Departamento : <?php echo $Taller['Departamento']; ?><br>
        Direccion : <?php echo $Taller['Direccion']; ?><br>
        Fecha : <?php echo date('Y-m-d'); ?><br>
    </div>
</div>
<br>
</br>
<div class="row">
    <div class="col-xs-12">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Placa camion</th>
                    <th>Descripcion</th>
                    <th>Precio Unitario</th>
                    <th>Cantidad</th>
                    <th>Debe</th>
                    <th>Haber</th>
                    <th>Balacne</th>
                    <th>Opciones</th>

                </tr>
            </thead>
            <tbody>
                <?php
                $balance = 0;
                if (count($detalleTaller) > 0) {
                    foreach ($detalleTaller as $row) {
                        $balance = $balance + (float)$row['Debe'] - (float)$row['Haber'];
                        $fecha = new DateTime($row['Fecha']);
                ?>
                        <tr>
                            <td><?php echo date_format($fecha, 'Y-M-d') ?></td>
                            <td><?php echo $row['N_Placa'] ?></td>
                            <td><?php echo $row['Descripcion'] ?></td>
                            <td><?php echo $row['PrecioUnitario'] ?></td>
                            <td><?php echo $row['Cantidad'] ?></td>
                            <td ALIGN="center"><?php echo number_format($row['Debe'], 2) ?></td>
                            <td ALIGN="center"><?php echo number_format($row['Haber'], 2) ?></td>
                            <td ALIGN="center"><?php echo number_format($balance, 2) ?></td>
                            <td>
                                <?php if ($row['ID_Mantenimiento'] > 0) { ?>
                                    <button type="button" value="<?php echo $row['ID_Mantenimiento'] ?>" class="btn btn-warning btn-editar-mantenimiento"><span class='fas fa-pencil-alt'></span></button>
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
                    <td colspan="7">Total de Balance</td>
                    <td><?php echo number_format($balance, 2); ?> Bs</td>
                </tr>
            </tfoot>

    </div>
</div>