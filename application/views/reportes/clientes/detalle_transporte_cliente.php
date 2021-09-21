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
<?php if (!empty($TransporteCliente)) : ?>
    <?php foreach ($TransporteCliente as $transporte) : ?>
        <div class="row">
            <div class="col-xs-6">
                <b>TRAMO</b><br>
                <b>Origen:</b> <?php echo $transporte['transporte']['NombrePredioOringen']; ?> <br>
                <b>Destino:</b> <?php echo $transporte['transporte']['NombrePredioDestino'] ?> <br>
                <b>Distancia:</b> <?php echo $transporte['transporte']['Distancia'] ?> Km <br>
            </div>
            <div class="col-xs-6">
                <b>Descripcion</b><br>
                <?php echo $transporte['transporte']['Descripcion'] ?> <br>
                <b>Fecha: </b> <?php echo $transporte['transporte']['Fecha'] ?><br>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <div>
                    <table id='' class='table jambo_table table-hover'>
                        <thead>
                            <tr>
                                <th>Nombre chofer</th>
                                <th>CI</th>
                                <th>Placa</th>
                                <th>Precio </th>
                                <th>Cantidad</th>
                                <th>Descuento</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $total = 0;
                            $facturado = 0;
                            ?>
                            <?php if (!empty($transporte['detalle_transporte'])) : ?>
                                <?php foreach ($transporte['detalle_transporte'] as $row) : ?>
                                    <tr>
                                        <td><?php echo (isset($row->NombresChofer)) ? $row->NombresChofer : $row->nombreChoferPropio; ?></td>
                                        <td><?php echo (isset($row->CI)) ? $row->CI : $row->CIcamionPropio; ?></td>
                                        <td><?php echo $row->N_Placa ?></td>
                                        <td><?php echo $row->Precio ?></td>
                                        <td><?php echo $row->Cantidad ?></td>
                                        <td><?php echo $row->Descuento ?></td>
                                        <td><?php echo $row->Total ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td>SubTotal</td>
                                <td colspan="5"></td>
                                <td><strong class="strong"><?php echo $transporte['transporte']['SubTotal']; ?></strong></td>
                            </tr>
                            <tr>
                                <td>Descuento</td>
                                <td colspan="5"></td>
                                <td><strong class="strong"><?php echo $transporte['transporte']['DescuentoTotal']; ?></strong></td>
                            </tr>
                            <tr>
                                <td>Total</td>
                                <td colspan="5"></td>
                                <td><strong class="strong"><?php echo $transporte['transporte']['Total']; ?></strong></td>
                            </tr>
                        </tfoot>
                    </table>
                    <hr>
                </div>
            </div>
        </div>
        <br>
        <hr>
        <p class="saltoPagina"></p>
    <?php endforeach; ?>
<?php endif; ?>

</div>