$(document).ready(function () {
	var year = new Date();
	var year = year.getFullYear();
	// Tablas inicializadas con data tables
	var tablaCliente = $('#tablaDetalleCliente').DataTable({
		responsive: "true",
		"order": [
			[3, "desc"]
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
				.column(3)
				.data()
				.reduce(function (a, b) {
					return intVal(a) + intVal(b);
				}, 0);

			// Total over this page
			pageTotal = api
				.column(3, {
					page: 'current'
				})
				.data()
				.reduce(function (a, b) {
					return intVal(a) + intVal(b);
				}, 0);

			// Update footer
			$(api.column(3).footer()).html(
				total.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,') + ' Bs'
			);
		},
	});
	var tablaProveedores = $('#tablaDetalleProveedores').DataTable({
		responsive: "true",
		"order": [
			[3, "desc"]
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
				.column(3)
				.data()
				.reduce(function (a, b) {
					return intVal(a) + intVal(b);
				}, 0);

			// Total over this page
			pageTotal = api
				.column(3, {
					page: 'current'
				})
				.data()
				.reduce(function (a, b) {
					return intVal(a) + intVal(b);
				}, 0);

			// Update footer
			$(api.column(3).footer()).html(
				total.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,') + ' Bs'
			);
		},
	});
	var tablaTalleres = $('#tablaDetalleTaller').DataTable({
		responsive: "true",
		"order": [
			[3, "desc"]
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
				.column(3)
				.data()
				.reduce(function (a, b) {
					return intVal(a) + intVal(b);
				}, 0);

			// Total over this page
			pageTotal = api
				.column(3, {
					page: 'current'
				})
				.data()
				.reduce(function (a, b) {
					return intVal(a) + intVal(b);
				}, 0);

			// Update footer
			$(api.column(3).footer()).html(
				total.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,') + ' Bs'
			);
		},
	});
	var tablaDetalleCamion = $('#tabla_detalle_camion').DataTable({
		responsive: "true",
		"order": [
			[1, "asc"]
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
			totalIngreso = api
				.column(6)
				.data()
				.reduce(function (a, b) {
					return intVal(a) + intVal(b);
				}, 0);
			totalEgreso = api
				.column(7)
				.data()
				.reduce(function (a, b) {
					return intVal(a) + intVal(b);
				}, 0);

			// Update footer
			$(api.column(6).footer()).html(
				totalIngreso
			);
			$(api.column(7).footer()).html(
				totalEgreso
			);
			$(api.column(8).footer()).html(
				totalIngreso - totalEgreso
			);
		},

	});
	var tablaRankingClientes = $('#rankingClientes').DataTable({
		responsive: "true",
		dom: 'frtp',
		pageLength: 5,
		"order": [
			[2, "desc"]
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
					i.replace(/[\Bs,]/g, '') * 1 :
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
	var tablaRankingProveedores = $('#rankingProveedores').DataTable({
		responsive: "true",
		dom: 'frtp',
		pageLength: 5,
		"order": [
			[2, "desc"]
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
	// Funciones de la paginas
	GenerarGraficoMovimiento(year);
	//Resetea la grafica de movimiento de transporte
	$('#year').on('change', function () {
		yearselected = $(this).val();
		GenerarGraficoMovimiento(yearselected);
	});
	//Resetea el ranking de clientes
	$('#yearClientes').on('change', function () {
		yearselected = $(this).val();
		$.ajax({
			type: "POST",
			url: base_url + "/Inicio/rankingClientes",
			data: {
				yearselected: yearselected
			},
			dataType: "json",
			success: function (respuesta) {
				tablaRankingClientes.clear();
				rankingClientes = respuesta['rankingClientes'];
				totalServicios = respuesta['totalServicios'];
				for (let i = 0; i < rankingClientes.length; i++) {
					porcentaje = (Number(rankingClientes[i]['servicios']) * 100) / Number(totalServicios);
					tablaRankingClientes.row.add([
						rankingClientes[i]['Nombre'] + ' ' + rankingClientes[i]['Apellidos'],
						"<div class='progress'>" +
						"<div class='progress bg-green' role='progressbar' style='width: " + porcentaje + "%;' aria-valuenow=' " + porcentaje.toFixed(2) + "' aria-valuemin='0' aria-valuemax='100'></div>" +
						"</div>",
						Number(rankingClientes[i]['servicios']).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'),
					]).draw();
				}

			}
		});
	});
	//Resetea el ranking de los proveedores
	$('#yearProveedores').on('change', function () {
		yearselected = $(this).val();
		$.ajax({
			type: "POST",
			url: base_url + "/Inicio/rankingProveedores",
			data: {
				yearselected: yearselected
			},
			dataType: "json",
			success: function (respuesta) {
				tablaRankingProveedores.clear();
				rankingProveedores = respuesta['rankingProveedores'];
				totalServicios = respuesta['totalServicios'];
				for (let i = 0; i < rankingProveedores.length; i++) {
					porcentaje = (Number(rankingProveedores[i]['servicios']) * 100) / Number(totalServicios);
					tablaRankingProveedores.row.add([
						rankingProveedores[i]['Nombres'] + ' ' + rankingProveedores[i]['Apellidos'],
						"<div class='progress'>" +
						"<div class='progress bg-green' role='progressbar' style='width: " + porcentaje + "%;' aria-valuenow=' " + porcentaje.toFixed(2) + "' aria-valuemin='0' aria-valuemax='100'></div>" +
						"</div>",
						Number(rankingProveedores[i]['servicios']).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'),
					]).draw();
				}

			}
		});
	});
	//Funcion para ver Km de cambio de aceite camiones
	verificarCambioAceite();
	//Funciones de clientes
	$(document).on('click', '.btn-reporte-cliente', function () {
		fila = $(this).closest('tr');
		ID_Cliente = parseInt(fila.find('td:eq(0)').text());
		$.ajax({
			type: "POST",
			url: base_url + "/Inicio/detalleCliente/" + ID_Cliente,
			dataType: "html",
			success: function (response) {
				$('#modal-detalle .modal-body').html(response);
			}
		});
	});
	$(document).on('click', '.btn-reporte-transporte-cliente', function () {
		fila = $(this).closest('tr');
		ID_Cliente = parseInt(fila.find('td:eq(0)').text());
		$.ajax({
			type: "POST",
			url: base_url + "/Inicio/detalleTransporteCliente/" + ID_Cliente,
			dataType: "html",
			success: function (response) {
				$('#modal-detalle .modal-body').html(response);
			}
		});
	});
	//Funciones de proveedores
	$(document).on('click', '.btn-reporte-proveedor', function () {
		fila = $(this).closest('tr');
		ID_proveedor = parseInt(fila.find('td:eq(0)').text());
		$.ajax({
			type: "POST",
			url: base_url + "/Inicio/detalleProveedor/" + ID_proveedor,
			dataType: "html",
			success: function (response) {
				$('#modal-detalle .modal-body').html(response);
			}
		});
	});
	$(document).on('click', '.btn-reporte-taller', function () {
		fila = $(this).closest('tr');
		ID_taller = parseInt(fila.find('td:eq(0)').text());
		$.ajax({
			type: "POST",
			url: base_url + "/Inicio/detalleTaller/" + ID_taller,
			dataType: "html",
			success: function (response) {
				$('#modal-detalle .modal-body').html(response);
			}
		});
	});
	$(document).on('click', '.btn-print', function () {

		$("#modal-detalle .modal-body").print({
			title: 'Balance',
		});
	});
	$(document).on('click', '.btn-editar-detalle_camion', function () {
		id = $(this).val();
		window.open(base_url + "/Mantenimiento/editarMantenimiento/" + id);
	});
	$(document).on('click', '.btn-editar-transporte_camion,  .btn-editar-transporte-cliente', function () {
		id = $(this).val();
		window.open(base_url + "/Transporte/editarTransporte/" + id);
	});
	$(document).on('click', '.btn-editar-pago', function () {
		id = $(this).val();
		window.open(base_url + "/Pago_cuentas/editarPago/" + id);
	});
	$(document).on('click', '.btn-editar-mantenimiento', function () {
		id = $(this).val();
		window.open(base_url + '/Mantenimiento/editarMantenimiento/' + id);

	});
	//Reporte de Camiones de la empresa
	$(document).on('submit', '#reporte-camion', function (e) {
		e.preventDefault();
		ID_camion = $.trim($('#camion').val());
		fechaIni = $.trim($('#fechaIni').val());
		fechaFin = $.trim($('#fechaFin').val());
		if (fechaIni < fechaFin) {
			$.ajax({
				type: "POST",
				url: base_url + "/Inicio/detalleCamionEmpresa",
				data: {
					ID_camion: ID_camion,
					fechaIni: fechaIni,
					fechaFin: fechaFin,
				},
				dataType: "json",
				success: function (respuesta) {
					$('.Reporte-camion').removeClass('hidden');
					detalleCamionEmpresa = respuesta['detalleCamionEmpresa'];
					resumenGastosCamion(respuesta['top5Gastos']);
					$('.KilometrosAcumulados').text(respuesta['KilometrosAcumulados']);
					balance = 0;
					sumIngresos = 0;
					sumEgresos = 0;
					tablaDetalleCamion.clear();
					for (let i = 0; i < detalleCamionEmpresa.length; i++) {
						balance = balance + Number(detalleCamionEmpresa[i]['Ingreso']) - Number(detalleCamionEmpresa[i]['Egreso']);
						sumIngresos = sumIngresos + Number(detalleCamionEmpresa[i]['Ingreso']);
						sumEgresos = sumEgresos + Number(detalleCamionEmpresa[i]['Egreso']);
						tablaDetalleCamion.row.add([
							detalleCamionEmpresa[i]['Nombre_categoria'],
							detalleCamionEmpresa[i]['Fecha'],
							(detalleCamionEmpresa[i]['Descripcion'] != null) ? detalleCamionEmpresa[i]['Descripcion'] : detalleCamionEmpresa[i]['TransporteDescripcion'],
							detalleCamionEmpresa[i]['Precio'],
							detalleCamionEmpresa[i]['Cantidad'],
							detalleCamionEmpresa[i]['Descuento'],
							detalleCamionEmpresa[i]['Ingreso'],
							detalleCamionEmpresa[i]['Egreso'],
							balance,
							(detalleCamionEmpresa[i]['ID_mantenimiento'] > 0) ?
							"<td><button type='button' value = '" + detalleCamionEmpresa[i]['ID_mantenimiento'] + "' class='btn btn-warning btn-editar-detalle_camion'><span class='fas fa-pencil-alt'></span></button></td>" :
							(detalleCamionEmpresa[i]['ID_transporte'] > 0) ?
							"<td><button type='button' value = '" + detalleCamionEmpresa[i]['ID_transporte'] + "' class='btn btn-warning btn-editar-transporte_camion'><span class='fas fa-pencil-alt'></span></button></td>" :
							null,
						]).draw();
					}
					$(".ingreso_camion").text(Number(sumIngresos).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,') + "Bs");
					$(".egreso_camion").text(Number(sumEgresos).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,') + "Bs");
					eficiancia = ((sumIngresos - sumEgresos) * 100) / sumIngresos;
					$('.color_balance_camion').removeClass('green red');
					(sumIngresos - sumEgresos) > 0 ? $(".color_balance_camion").addClass("green") : $(".color_balance_camion").addClass("red");
					$(".balance_camion").text((sumIngresos - sumEgresos).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,') + "Bs");
					$(".eficiencia").text(eficiancia.toFixed(2) + "%");
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

function resetGrafico() {
	$('#GraficoM').remove(); // this is my <canvas> element
	$('#GraficoMovimiento').append('<canvas id="GraficoM" ></canvas>');
}

function resetGraficoGastosCamion() {
	$('#GraficoDoughnutsCamionesEmpresa').remove(); // this is my <canvas> element
	$('#GraficoDCamionesEmpresa').append('<canvas id="GraficoDoughnutsCamionesEmpresa"></canvas>');
}

function GenerarGraficoMovimiento(year) {
	$.ajax({
		type: "POST",
		url: base_url + "/inicio/graficoMovimiento",
		data: {
			year: year
		},
		dataType: "json",
		success: function (response) {
			resetGrafico();
			GraficoMovimiento(response);
		}
	});
}

function GraficoMovimiento(Datos) {

	var f = document.getElementById("GraficoM");
	var f = document.getElementById("GraficoM").getContext('2d');
	new Chart(f, {
		type: "line",
		data: {
			labels: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
			datasets: [{
				label: "Movimiento total de transporte",
				backgroundColor: "rgba(38, 185, 154, 0.31)",
				borderColor: "rgba(38, 185, 154, 0.7)",
				pointBorderColor: "rgba(38, 185, 154, 0.7)",
				pointBackgroundColor: "rgba(38, 185, 154, 0.7)",
				pointHoverBackgroundColor: "#fff",
				pointHoverBorderColor: "rgba(220,220,220,1)",
				pointBorderWidth: 1,
				data: Datos['MovimientoGeneralTransportePorMes']
			}, {
				label: "Movimiento por camiones de la empresa",
				backgroundColor: "rgba(3, 88, 106, 0.3)",
				borderColor: "rgba(3, 88, 106, 0.70)",
				pointBorderColor: "rgba(3, 88, 106, 0.70)",
				pointBackgroundColor: "rgba(3, 88, 106, 0.70)",
				pointHoverBackgroundColor: "#fff",
				pointHoverBorderColor: "rgba(151,187,205,1)",
				pointBorderWidth: 1,
				data: Datos['MovimientoGeneralTransporteCamionesEmpresa']
			}]
		},
		options: {
			legend: {
				display: true,
				position: 'bottom',
				Align: 'start',
			},
			maintainAspectRatio: false,
		}

	});
}

function resumenGastosCamion(datos) {
	resetGraficoGastosCamion();
	$('.tabla-gastos-categoria-camion tbody').empty();
	tablaGastosCategoriaCamion(datos);
	GraficoDoughnutsCamionesEmpresa(datos);
}

function tablaGastosCategoriaCamion(datos) {

	// se obtiene el total de los gastos para poder sacar el % de los mismos.
	total = 0;
	for (let i = 0; i < datos.length; i++) {
		total = total + parseFloat(datos[i].Egreso);
	}
	for (let i = 0; i < datos.length; i++) {

		porcentaje = (parseFloat(datos[i].Egreso) * 100) / total;
		html = '<tr>';
		html += '<th>' + datos[i].Categoria + '</th>';
		html += '<th>% ' + porcentaje.toFixed(2) + '</th>'
		html += '</tr>';

		$('.tabla-gastos-categoria-camion tbody').append(html);

	}

}

function GraficoDoughnutsCamionesEmpresa(datos) {
	labels = Object.keys(datos).map(function (key) {
		return datos[key].Categoria;
	});
	Egreso = Object.keys(datos).map(function (key) {
		return datos[key].Egreso;
	});
	var f = document.getElementById("GraficoDoughnutsCamionesEmpresa"),
		i = {
			labels: labels,
			datasets: [{
				data: Egreso,
				backgroundColor: ["#BDC3C7", "#9B59B6", "#E74C3C", "#26B99A", "#3498DB"],
				hoverBackgroundColor: ["#CFD4D8", "#B370CF", "#E95E4F", "#36CAAB", "#49A9EA"]
			}]
		};
	new Chart(f, {
		type: "doughnut",
		tooltipFillColor: "rgba(51, 51, 51, 0.55)",
		data: i,
		maintainAspectRatio: false,
		options: {
			legend: {
				display: false,
			},
			title: {
				display: true,
				text: 'Gastos por categoria'
			},
		},

	})
}

function verificarCambioAceite() {

	$.ajax({
		type: "POST",
		url: base_url + "/Camion/oobtenerKilometrajeUltimoCambioAceiteCamionesAjax",
		dataType: "json",
		success: function (datos) {
			if (datos.length > 0) {
				datos.forEach(dato => {
					if (dato['KmAcumulado'] > 5500) {
						"undefined" != typeof PNotify, new PNotify({
							title: "Cambio de aceite!",
							type: "error",
							text: 'El camion  ' + dato['N_placa'] + ' tiene ' + dato['KmAcumulado'] + ' Km desde su ultimo cambion',
							styling: "bootstrap3",
							hide: !1,
						});
					}
				});
			}
		}
	});

}
