$(document).ready(function () {
	opcion = '';
	var tabla = $('#tablaPagoTaller').DataTable({
		responsive: "true",
		"order": [
			[0, "desc"]
		],
		"columnDefs": [{
			"targets": -1,
			"data": null,
			"defaultContent": "<div class='text-right'> <div class='btn-group'><button class='btn btn-warning btn-sm' id='btn-editar'><i class='fas fa-pencil-alt'></i> Editar</button><button class='btn btn-danger btn-sm' id='btn-borrar'><i class='fas fa-trash-alt'></i> Borrar</button></div></div>",
		}],
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
		}
	});
	$('#btn-cerrar').on('click', function () {
		LimpiarFormulario();
	});
	$(document).on('click', '#btn-editar', function () {
		fila = $(this).closest('tr');
		ID_pago_cuentas = parseInt(fila.find('td:eq(0)').text());
		$('.modal-title').text('Formulario transacciones de Taller EDITAR');
		$('#modal-PagoTaller').modal('show');
		$.ajax({
			type: "POST",
			url: base_url + "/Pago_cuentas/obtenerPagoTaller",
			data: {
				ID_pago_cuentas: ID_pago_cuentas
			},
			dataType: "json",
			success: function (respuesta) {
				$("#ID_taller option[value=" + respuesta['ID_taller'] + "]").attr("selected", true);
				$('#Fecha').val(respuesta['fecha']);
				$('#Descripcion').text(respuesta['Descripcion']);
				$('#Debe').val(respuesta['Debe']);
				$('#Haber').val(respuesta['Haber']);

			}
		});
		opcion = 'editar';
	});
	$('#formPagoTaller').submit(function (e) {
		e.preventDefault();

		ID_taller = $.trim($('#ID_taller').val());
		Fecha = $.trim($('#Fecha').val());
		Descripcion = $.trim($('#Descripcion').val());
		Debe = $.trim($('#Debe').val());
		Haber = $.trim($('#Haber').val());
		$('#modal-PagoTaller').modal('hide');

		if (opcion != 'editar') {
			$.ajax({
				type: "POST",
				url: base_url + "/Pago_cuentas/ingresarPagoTaller",
				data: {
					ID_taller: ID_taller,
					Fecha: Fecha,
					Descripcion: Descripcion,
					Debe: Debe,
					Haber: Haber,
				},
				dataType: "json",
				success: function (respuesta) {
					if (respuesta['respuesta'] === 'Exitoso') {
						ID_pago_cuentas = respuesta['datos']['ID_pago_cuentas'];
						Fecha = respuesta['datos']['Fecha'];
						Nombre = respuesta['datos']['NombreTaller'];
						Departamento = respuesta['datos']['Departamento'];
						Direccion = respuesta['datos']['Direccion'];
						Descripcion = respuesta['datos']['Descripcion'];
						Debe = respuesta['datos']['Debe'];
						Haber = respuesta['datos']['Haber'];
						tabla.row.add([ID_pago_cuentas, Fecha, Nombre, Departamento, Direccion, Descripcion, Debe, Haber]).draw();
						LimpiarFormulario();
						swal({
							title: 'Guardar',
							text: respuesta['message'],
							type: 'success'
						});

					} else {
						LimpiarFormulario();
						swal({
							title: 'Error',
							text: respuesta['message'],
							type: 'error'
						});
					}

				}
			});
		} else {
			$.ajax({
				type: "POST",
				url: base_url + "/Pago_cuentas/editarPagoTaller",
				data: {
					ID_pago_cuentas: ID_pago_cuentas,
					ID_taller: ID_taller,
					Fecha: Fecha,
					Descripcion: Descripcion,
					Debe: Debe,
					Haber: Haber,
				},
				dataType: "json",
				success: function (respuesta) {
					if (respuesta['respuesta'] === 'Exitoso') {

						Fecha = respuesta['datos']['Fecha'];
						Nombre = respuesta['datos']['NombreTaller'];
						Departamento = respuesta['datos']['Departamento'];
						Direccion = respuesta['datos']['Direccion'];
						Descripcion = respuesta['datos']['Descripcion'];
						Debe = respuesta['datos']['Debe'];
						Haber = respuesta['datos']['Haber'];
						LimpiarFormulario();
						tabla.row(fila).data([ID_pago_cuentas, Fecha, Nombre, Departamento, Direccion, Descripcion, Debe, Haber]).draw();

						swal({
							title: 'Editado',
							text: respuesta['message'],
							type: 'success'
						});
						$('#formEmpleados').trigger('reset');
					} else {
						LimpiarFormulario();
						swal({
							title: 'Error',
							text: respuesta['message'],
							type: 'error'
						});
					}

				}
			});
		}


	});
	$(document).on('click', '#btn-borrar', function () {
		Swal.fire({
			title: 'Esta seguro de elimar?',
			text: "El movimiento se eliminara, una vez eliminado no se recuperara!",
			type: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Si, deseo elimniar!',
			cancelButtonText: 'Cancelar'
		}).then((result) => {
			if (result.value) {
				fila = $(this).closest('tr');
				id = parseInt(fila.find('td:eq(0)').text());
				$.ajax({
					url: base_url + "/Pago_cuentas/eliminarPago/" + id,
					type: 'POST',
					success: function (respuesta) {

						tabla.row(fila).remove().draw();
						swal({
							title: 'Eliminado',
							text: 'Se borro correctamente',
							type: 'success'
						});


					}
				})


			}
		})

	})
});

function LimpiarFormulario() {
	$('#modal-PagoTaller').modal('hide');
	$('.modal-title').text('Formulario transacciones de Taller');
	$('#Descripcion').text('');
	$("#ID_taller option:selected").removeAttr("selected");
	$('#formPagoTaller').trigger('reset');
	opcion = '';
};
