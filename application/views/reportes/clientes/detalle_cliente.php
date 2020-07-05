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
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th width="15%">Fecha</th>
                    <th width="40%">Descripcion</th>
                    <th width="15%">Debe</th>
                    <th width="15%">Haber</th>
                    <th width="15%">Balance</th>
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
                    <td colspan="4">Total de Balance</td>
                    <td><?php echo number_format($balance, 2); ?> Bs</td>
                </tr>
            </tfoot>
      
    </div>
</div>