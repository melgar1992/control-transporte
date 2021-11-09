$(document).ready(function () {
    var tabla_pagos = $('#tabla_pagos').DataTable({
        "paging":   false,
        "ordering": false,
        "info":     false,
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

			// Total over all pages
			total = api
				.column(2)
				.data()
				.reduce(function (a, b) {
					return intVal(a) + intVal(b);
				}, 0);

			// Total over this page
			pageTotal = api
				.column(2, {
					page: 'current'
				})
				.data()
				.reduce(function (a, b) {
					return intVal(a) + intVal(b);
				}, 0);

			// Update footer
			$(api.column(2).footer()).html(
				total.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,') + ' Bs'
			);
		},
	});
    var tabla_servicios = $('#tabla_servicios').DataTable({
        "paging":   false,
        "ordering": false,
        "info":     false,
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

			// Total over all pages
			total = api
				.column(5)
				.data()
				.reduce(function (a, b) {
					return intVal(a) + intVal(b);
				}, 0);

			// Total over this page
			pageTotal = api
				.column(5, {
					page: 'current'
				})
				.data()
				.reduce(function (a, b) {
					return intVal(a) + intVal(b);
				}, 0);

			// Update footer
			$(api.column(5).footer()).html(
				total.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,') + ' Bs'
			);
		},
	});
    $(document).on('click', '.btn-print', function () {

		$(".reporteCliente").print({
			title: 'Balance',
		});
	});
    $(document).on('submit', '#reporteCliente', function (e) {
        e.preventDefault();
        ID_Cliente = $.trim($('#ID_Cliente').val());
        fechaIni = $.trim($('#fechaIni').val());
        fechaFin = $.trim($('#fechaFin').val());
        if (fechaIni < fechaFin) {
            $.ajax({
                type: "POST",
                url: base_url + "/DashboardClientes/reporteCliente",
                data: {
                    ID_Cliente: ID_Cliente,
                    fechaIni: fechaIni,
                    fechaFin: fechaFin,
                },
                dataType: "json",
                success: function (respuesta) {
                    tabla_pagos.clear().draw();;
                    tabla_servicios.clear().draw();;
                    suma_pagos = 0;
                    suma_servicios = 0;
                    saldoAnterior = respuesta['saldoAnterior'];
                    clienteServiciosEntreFecha = respuesta['clienteServiciosEntreFecha'];
                    clientePagosEntreFecha = respuesta['clientePagosEntreFecha'];
                    $("#nombre_cliente").text(saldoAnterior['Nombre'] + ' ' + saldoAnterior['Apellidos']);
                    $("#CI").text(saldoAnterior['CI']);
                    $('#balance_anterior').text(Number(saldoAnterior['balance']).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'));
                    for (let i = 0; i < clientePagosEntreFecha.length; i++) {
                        suma_pagos = suma_pagos + Number(clientePagosEntreFecha[i]['Haber']);
                        tabla_pagos.row.add([
                            clientePagosEntreFecha[i]['fecha'],
                            clientePagosEntreFecha[i]['Descripcion'],
                            Number(clientePagosEntreFecha[i]['Haber']).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'),
                        ]).draw();   
                    }
                    for (let i = 0; i < clienteServiciosEntreFecha.length; i++) {
                        servicioDespuesDescuento = clienteServiciosEntreFecha[i]['Debe'] - clienteServiciosEntreFecha[i]['Descuento'];
                        suma_servicios = suma_servicios + servicioDespuesDescuento;
                        tabla_servicios.row.add([
                            clienteServiciosEntreFecha[i]['fecha'],
                            clienteServiciosEntreFecha[i]['Descripcion'],
                            clienteServiciosEntreFecha[i]['Origen'] + ' -> ' + clienteServiciosEntreFecha[i]['Destino'],
                            clienteServiciosEntreFecha[i]['Camiones'],
                            clienteServiciosEntreFecha[i]['Descuento'],
                            Number(servicioDespuesDescuento).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'),
                        ]).draw();   
                    }
                    $("#balance_actual").text((Number(saldoAnterior['balance']) + Number(suma_servicios - suma_pagos)).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'));
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