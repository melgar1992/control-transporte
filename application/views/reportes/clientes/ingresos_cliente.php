<div class="row">
    <div class="col-xs-12 text-left">
        <b>Detalle de cliente</b><br>
        Nombre : <?php echo $Cliente['Nombre'] . ' ' . $Cliente['Apellidos']; ?> <br>
        CI : <?php echo $Cliente['CI']; ?><br>
        Fecha : <?php echo date('Y-m-d'); ?><br>
    </div>
</div>
<br>
</br>
<div class="row">
    <div class="col-xs-12">
        <table class="table table-bordered table-condensed">
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Descripcion</th>
                    <th>Tramo</th>
                    <th>Camiones</th>
                    <th>Descuento</th>
                    <th>Debe</th>
                    <th>Haber</th>
                    <th>Balance</th>

                </tr>
            </thead>
            <tbody>
                <?php
                $balance = 0;
                if (count($serviciosCliente) > 0) {
                    foreach ($serviciosCliente as $row) {
                        $balance = $balance + (float)$row['Debe'] - (float)$row['Haber'];
                        $fecha = new DateTime($row['fecha']);
                ?>
                        <tr>
                            <td><?php echo date_format($fecha, 'Y-M-d') ?></td>
                            <td><?php echo $row['Descripcion'] ?></td>
                            <td><?php echo $row['Origen'] . '  - > ' . $row['Destino'] ?></td>
                            <td><?php echo $row['Camiones'] ?></td>
                            <td><?php echo $row['Descuento'] ?></td>
                            <td ALIGN="center"><?php echo number_format($row['Debe'], 2) ?></td>
                            <td ALIGN="center"><?php echo number_format($row['Haber'], 2) ?></td>
                            <td ALIGN="center"><?php echo number_format($balance, 2) ?></td>
                        </tr>
                <?php }
                }

                ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="8">Total de Balance</td>
                    <td><?php echo number_format($balance, 2); ?> Bs</td>
                </tr>
            </tfoot>

    </div>
</div>