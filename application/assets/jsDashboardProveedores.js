$(document).ready(function () {
    var tabla_pagos = $('#detalle_cuenta').DataTable({
		dom: "rtip",
        "paging": false,
        "ordering": false,
        "info": false,
        "order": [
            [0, "desc"]
        ],
        "language": {
            'lengthMenu': "Mostrar _MENU_ registros",
            "zeroRecords": "No se encontraron resultados",
            "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registro",
            "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "infoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sSearch": "Buscar",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast": "Ultimo",
                "sNext": "Siguiente",
                "sPrevious": "Anterior",

            },
            "sProcesing": "Procesando...",
        },
        "footerCallback": function (row, data, start, end, display, tfoot) {
            var api = this.api(),
                data;

            // Remove the formatting to get integer data for summation
            var intVal = function (i) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '') * 1 :
                    typeof i === 'number' ?
                        i : 0;
            };
        },
    });


    //    Boton para imprimir
    $(document).on('click', '.btn-print', function () {

        $(".reporteCliente").print({
            title: 'Balance',
        });
    });
    // Boton para generar el reporte del proveedor
    $(document).on('submit', '#reporteProveedores', function (e) {
        e.preventDefault();
        ID_Proveedor = $.trim($('#ID_Proveedor').val());
        fechaIni = $.trim($('#fechaIni').val());
        fechaFin = $.trim($('#fechaFin').val());
        if (fechaIni < fechaFin) {
            $.ajax({
                type: "POST",
                url: base_url + "/DashboardProveedores/reporteProveedorEntreFecha",
                data: {
                    ID_Proveedor: ID_Proveedor,
                    fechaIni: fechaIni,
                    fechaFin: fechaFin,
                },
                dataType: "json",
                success: function (respuesta) {
                    tabla_pagos.clear().draw();
                    saldoAnterior = respuesta['saldoAnterior'];
                    Balance = Number(saldoAnterior['Balance']);
                    detalleProveedorEntreFecha = respuesta['detalleProveedorEntreFecha'];
                    $("#nombre_proveedor").text(saldoAnterior['Nombres'] + ' ' + saldoAnterior['Apellidos']);
                    $("#telefono").text(saldoAnterior['Telefono_01']);
                    $('#balance_anterior').text(Number(saldoAnterior['Balance']).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'));
                    for (let i = 0; i < detalleProveedorEntreFecha.length; i++) {
                        Balance = Balance + Number(detalleProveedorEntreFecha[i]['Ingreso']) - Number(detalleProveedorEntreFecha[i]['Egreso']);
                        tabla_pagos.row.add([
                            detalleProveedorEntreFecha[i]['Fecha'],
                            detalleProveedorEntreFecha[i]['Descripcion'],
                            (detalleProveedorEntreFecha[i]['N_Placa'] != 'null ') ? detalleProveedorEntreFecha[i]['N_Placa'] : '',
                            (detalleProveedorEntreFecha[i]['Origen'] != 'null ') ? detalleProveedorEntreFecha[i]['Origen'] + '-->' + detalleProveedorEntreFecha[i]['Destino'] : '',
                            (detalleProveedorEntreFecha[i]['Precio'] != 'null ') ? detalleProveedorEntreFecha[i]['Precio'] : '',
                            (detalleProveedorEntreFecha[i]['Comision'] != 'null ') ? detalleProveedorEntreFecha[i]['Comision'] : '',
                            (detalleProveedorEntreFecha[i]['Cantidad'] != 'null ') ? detalleProveedorEntreFecha[i]['Cantidad'] : '',
                            (detalleProveedorEntreFecha[i]['Acta'] != 'null ') ? detalleProveedorEntreFecha[i]['Acta'] : '',
                            (detalleProveedorEntreFecha[i]['Descuento'] != 'null ') ? detalleProveedorEntreFecha[i]['Descuento'] : '',
                            Number(detalleProveedorEntreFecha[i]['Ingreso']).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'),
                            Number(detalleProveedorEntreFecha[i]['Egreso']).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'),
                            (Number(detalleProveedorEntreFecha[i]['Ingreso']) - Number(detalleProveedorEntreFecha[i]['Egreso'])).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'),
                            Balance.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'),
                        ]).draw();
                    }
                    $("#balance_actual").text(Balance.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'));
                    $('.reporteCliente').removeClass('hidden');
                }
            });
        } else {
            swal({
                title: 'Error de fecha',
                text: 'La fecha inicial no puede ser mayor que la final',
                type: 'error'
            });
        }

    });
});