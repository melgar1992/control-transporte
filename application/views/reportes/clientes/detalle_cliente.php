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
                    <th>Origen</th>
                    <th>Destino</th>
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
                if (count($detalleCliente) > 0) {
                    foreach ($detalleCliente as $row) { 
                        $balance = $balance + (float)$row['Debe'] - (float)$row['Haber'];
                        ?>
                        <tr>
                            <td><?php echo $row['fecha'] ?></td>
                            <td><?php echo $row['Descripcion'] ?></td>
                            <td><?php echo $row['Origen'] ?></td>
                            <td><?php echo $row['Destino'] ?></td>
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