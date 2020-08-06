<div class="row">
    <div class="col-xs-12 text-right">
        Fecha: <?php echo $transporte['Fecha'] ?><br>

    </div>
</div> <br>
<div class="row">
    <div class="col-xs-6">
        <b>CLIENTE</b><br>
        <b>Nombre:</b> <?php echo $transporte['NombreCliente'] . ' ' . $transporte['ApellidosCliente'] ?> <br>
        <b>TRAMO</b><br>
        <b>Origen:</b> <?php echo $transporte['NombrePredioOringen']; ?> <br>
        <b>Destino:</b> <?php echo $transporte['NombrePredioDestino'] ?> <br>
        <b>Distancia:</b> <?php echo $transporte['Distancia'] ?> Km <br>
    </div>
    <div class="col-xs-6">
        <b>Descripcion</b><br>
        <?php echo $transporte['Descripcion'] ?> <br>
    </div>
</div>
<br>
<div class="row">
    <div class="col-xs-12">
        <div>
            <table id='tablaDetalleTransporte' class='table jambo_table table-hover'>
                <thead>
                    <tr>
                        <th>Nombre chofer</th>
                        <th>CI</th>
                        <th>Placa</th>
                        <th>Act viaje</th>
                        <th>Diesel Bs</th>
                        <th>Precio proveedor</th>
                        <th>Precio cliente</th>
                        <th>Cantidad</th>
                        <th>Comision</th>
                        <th>Descuento</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $total = 0;
                    $facturado = 0;
                    ?>
                    <?php if (!empty($detalle_transporte)) : ?>
                        <?php foreach ($detalle_transporte as $row) : ?>
                            <tr>
                                <td><?php echo (isset($row->NombresChofer)) ? $row->NombresChofer : $row->nombreChoferPropio; ?></td>
                                <td><?php echo (isset($row->CI)) ? $row->CI : $row->CIcamionPropio; ?></td>
                                <td><?php echo $row->N_Placa ?></td>
                                <td><?php echo $row->ActViaje ?></td>
                                <td><?php echo $row->Diesel ?></td>
                                <td><?php echo $row->PrecioProveedor ?></td>
                                <td><?php echo $row->Precio ?></td>
                                <td><?php echo $row->Cantidad ?></td>
                                <td><?php echo $row->Comision ?></td>
                                <td><?php echo $row->Descuento ?></td>
                                <td><?php echo $row->Total ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
            <hr>
        </div>
    </div>
</div>
<div class="form-group">
    <div class="col-md-3">
        <div class="input-group">
            <span class="input-group-addon">Subtotal:</span>
            <input type="text" class="form-control" placeholder="" value="<?php echo $transporte['SubTotal']; ?>" name="SubTotal" readonly="readonly">
        </div>
    </div>
    <div class="col-md-3">
        <div class="input-group">
            <span class="input-group-addon">Comision:</span>
            <input type="text" class="form-control" placeholder="" value="<?php echo $transporte['comisionTotal']; ?>" name="ComisionTotal" readonly="readonly">
        </div>
    </div>
    <div class="col-md-3">
        <div class="input-group">
            <span class="input-group-addon">Descuento:</span>
            <input type="text" class="form-control" placeholder="" value="<?php echo $transporte['DescuentoTotal']; ?>" name="DescuentoTotal" readonly="readonly">
        </div>
    </div>
    <div class="col-md-3">
        <div class="input-group">
            <span class="input-group-addon">Total cliente:</span>
            <input type="text" class="form-control" placeholder="" value="<?php echo $transporte['Total']; ?>" name="Total" readonly="readonly">
        </div>
    </div>
</div>
<br>