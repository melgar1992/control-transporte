$(document).ready(function () {
	var tabla_pagos = $('#tabla_pagos').DataTable({
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
		$("#DetalleCliente").empty();
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
					IngresarDellateCliente(ID_Cliente, fechaIni, fechaFin);
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

function IngresarDellateCliente(ID_Cliente, fechaIni, fechaFin) {

	$.ajax({
		type: "POST",
		url: base_url + "/DashboardClientes/detalleTransporteCliente",
		data: {
			ID_Cliente: ID_Cliente,
			fechaIni: fechaIni,
			fechaFin: fechaFin,
		},
		dataType: "json",
		success: function (respuesta) {
			transporteCliente = respuesta['TransporteCliente'];
			transporteCliente.forEach(transporteCliente => {
				html = '<div class="row">';
				html += '<div class="col-xs-6">';
				html += '<b>TRAMO: ' + transporteCliente['transporte']['NombrePredioOringen'] + ' => ' + transporteCliente['transporte']['NombrePredioDestino'] + '</b><br>';
				html += '<b>Distancia:</b> ' + transporteCliente['transporte']['Distancia'] + ' Km <br>';
				html += '</div>';
				html += '<div class="col-xs-6">';
				html += '<b>Descripcion</b><br>';
				html += ' ' + transporteCliente['transporte']['Descripcion'] + ' <br>';
				html += '<b>Fecha: ' + transporteCliente['transporte']['Fecha'] + ' <br>';
				html += '</div>'; // div del detalle
				html += '</div>'; // div del titulo
				html += '<br>';
				html += '</br>';
				html += '<div class="row">';
				html += '<div class="col-xs-12">';
				html += '<div>';
				html += "<table id='' class='table jambo_table table-hover'>";
				html += "<thead>";
				html += "<tr>";
				html += "<th>Nombre chofer</th>";
				html += "<th>CI</th>";
				html += "<th>Placa</th>";
				html += "<th>Precio </th>";
				html += "<th>Cantidad</th>";
				html += "<th>Descuento</th>";
				html += "<th>Total</th>";
				html += "</tr>";
				html += "</thead>";
				html += "<tbody>";
				transporteCliente['detalle_transporte'].forEach(detalle_transporte => {
					html += "<tr>";
					html += "<td>";
					detalle_transporte['NombresChofer'] ? html += detalle_transporte['NombresChofer']: html += detalle_transporte['nombreChoferPropio'] ;
					html += "</td>";
					html += " <td> ";
					detalle_transporte['CI'] ? html += detalle_transporte['CI']: html += detalle_transporte['CIcamionPropio'];
					html += "</td>";
					html += "<td>" + detalle_transporte['N_Placa'] + "</td>";
					html += "<td>" + detalle_transporte['Precio'] + "</td>";
					html += "<td>" + detalle_transporte['Cantidad'] + "</td>";
					html += "<td>" + detalle_transporte['Descuento'] + "</td>";
					html += "<td>" + detalle_transporte['Total'] + "</td>";
					html += "</tr>";
				});
				html += "</tbody>";
				html += "<tfoot>";
				html += "<tr>";
				html += "<td>SubTotal</td>";
				html += "<td colspan='5'></td>";
				html += "<td><strong class='strong'>" + transporteCliente['transporte']['SubTotal'] + "</strong></td>";
				html += "</tr>";
				html += "<tr>";
				html += "<td>Descuento</td>";
				html += "<td colspan='5'></td>";
				html += "<td><strong class='strong'>" + transporteCliente['transporte']['DescuentoTotal'] + "</strong></td>";
				html += "</tr>";
				html += "<tr>";
				html += "<td>Total</td>";
				html += "<td colspan='5'></td>";
				html += "<td><strong class='strong'>" + transporteCliente['transporte']['Total'] + "</strong></td>";
				html += "</tr>";
				html += "</tfoot>";
				html += "<hr>";
				html += "</table>";
				html += '</div>'; // div de la tabla
				html += '</div>'; //div tabla col-xs-12
				html += '</div>'; //div row
				html += '<br>';
				html += '<hr>';
				html += '<p class="saltoPagina"></p>';
				$('#DetalleCliente').append(html);
			});


		}
	});

}
