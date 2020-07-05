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
                    <th >Fecha</th>
                    <th >Descripcion</th>
                    <th >Origen</th>
                    <th >Destino</th>
                    <th >Precio</th>
                    <th >Comision</th>
                    <th >Cantidad</th>
                    <th >Acta</th>
                    <th >Descuento</th>
                    <th >Ingreso</th>
                    <th >Egreso</th>
                    <th >Balance</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $balance = 0;
                if (count($detalleProveedor) > 0) {
                    foreach ($detalleProveedor as $row) { 
                        $balance = $balance + (float)$row['Ingreso'] - (float)$row['Egreso'];
                        ?>
                        <tr>
                            <td><?php echo $row['Fecha'] ?></td>
                            <td><?php echo $row['Descripcion'] ?></td>
                            <td><?php echo $row['Origen'] ?></td>
                            <td><?php echo $row['Destino'] ?></td>
                            <td><?php echo $row['Precio'] ?></td>
                            <td><?php echo $row['Comision'] ?></td>
                            <td><?php echo $row['Cantidad'] ?></td>
                            <td><?php echo $row['Acta'] ?></td>
                            <td><?php echo $row['Descuento'] ?></td>
                            <td ALIGN="center"><?php echo number_format($row['Ingreso'], 2) ?></td>
                            <td ALIGN="center"><?php echo number_format($row['Egreso'], 2) ?></td>
                            <td ALIGN="center"><?php echo number_format($balance, 2) ?></td>
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