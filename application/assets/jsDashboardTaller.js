$(document).ready(function () {
	var tabla_reporte = $('#tabla_reporte').DataTable({
		dom: "Brtip",
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
	});
	// Boton para imprimir
	$(document).on('click', '.btn-print', function () {

		$(".reportetaller").print({
			title: 'Balance',
		});
	});
	// Boton para generar el reporte entre fechas
	$(document).on('submit', '#reporteTaller', function (e) {
		e.preventDefault();
		ID_taller = $.trim($('#ID_taller').val());
		fechaIni = $.trim($('#fechaIni').val());
		fechaFin = $.trim($('#fechaFin').val());
		if (fechaIni < fechaFin) {
			$.ajax({
				type: "POST",
				url: base_url + "/DashboardTaller/reporteTallerEntreFechas",
				data: {
					ID_taller: ID_taller,
					fechaIni: fechaIni,
					fechaFin: fechaFin
				},
				dataType: "json",
				success: function (respuesta) {
					tabla_reporte.clear().draw();
					nombreTaller = respuesta['balanceTaller']['NombreTaller'];
					saldoAnterior = respuesta['balanceTaller']['balance'];
					detalleTaller = respuesta['detalleTaller'];
					let balance = Number(saldoAnterior);
					$('#nombre_taller').text(nombreTaller);
					$('#balance_anterior').text(Number(saldoAnterior).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'));
					for (let i = 0; i < detalleTaller.length; i++) {
						balance += Number(detalleTaller[i]['Debe'] - detalleTaller[i]['Haber']);
						tabla_reporte.row.add([
							detalleTaller[i]['Fecha'],
							detalleTaller[i]['N_placa'],
							detalleTaller[i]['Descripcion'],
							detalleTaller[i]['PrecioUnitario'],
							detalleTaller[i]['Cantidad'],
							detalleTaller[i]['Debe'],
							detalleTaller[i]['Haber'],
							balance.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,')
						]).draw();

					}
					$("#balance_actual").text(balance.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'));
					$('.reportetaller').removeClass('hidden');
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
