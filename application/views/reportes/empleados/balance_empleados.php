<div class="row">
    <div class="col-xs-12 text-left">
        <b>Balance de empleado</b><br>
        Nombre : <?php echo $empleado->Nombres . ' ' . $empleado->Apellido_p . ' ' . $empleado->Apellido_m; ?> <br>
        CI : <?php echo $empleado->CI; ?><br>
        Total Egresos : <?php echo number_format($Total_egresos['Total_pagos'], 2);  ?> Bs<br>
        Total Ingresos: <?php echo number_format($Total_ingresos, 2); ?> Bs<br>
        Balance : <?php echo number_format((float) $Total_ingresos - (float) $Total_egresos['Total_pagos'], 2); ?> Bs<br>
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
                    <th width="20%">Fecha</th>
                    <th width="60%">Descripcion</th>
                    <th width="20%">Egresos Bs</th>

                </tr>
            </thead>
            <tbody>
                <?php

                if (count($pago_empleado) > 0) {
                    foreach ($pago_empleado as $row) { 
                        $fecha = new DateTime($row['Fecha']);
                        ?>
                        <tr>
                            <td><?php echo date_format($fecha,'Y-M-d') ?></td>
                            <td><?php echo $row['Descripcion'] ?></td>
                            <td ALIGN="center"><?php echo number_format($row['Monto'], 2) ?></td>

                        </tr>
                <?php }
                }

                ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="2">Total de Egresos</td>
                    <td><?php echo number_format($Total_egresos['Total_pagos'], 2); ?> Bs</td>
                </tr>
            </tfoot>

        </table>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th width="20%">Fecha</th>
                    <th width="60%">Descripcion</th>
                    <th width="20%">Ingresos Bs</th>

                </tr>
            </thead>
            <tbody>
                <?php

                if (count($ingreso_empleado) > 0) {
                    foreach ($ingreso_empleado as $row) { ?>
                        <tr>
                            <td><?php echo $row['Fecha'] ?></td>
                            <td><?php echo $row['Descripcion'] ?></td>
                            <td ALIGN="center"><?php echo number_format($row['Monto'], 2) ?></td>

                        </tr>
                <?php }
                }

                ?>

            </tbody>
            <tfoot>
                <tr>
                    <td colspan="2">Total de Ingresos</td>
                    <td><?php echo number_format($Total_ingresos, 2); ?> Bs</td>
                </tr>
            </tfoot>

        </table>

    </div>
</div>