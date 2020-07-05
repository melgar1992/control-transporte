$(document).ready(function () {
	opcion = '';
	var tabla = $('#tablaMovimientoCuentaEmpresa').DataTable({
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
		$('.modal-title').text('Formulario transacciones de cuentas de empresa EDITAR');
		$('#modal-MovimientoCuentaEmpresa').modal('show');
		$.ajax({
			type: "POST",
			url: base_url + "/Pago_cuentas/obtenermovimientoCajaEmpresa",
			data: {
				ID_pago_cuentas: ID_pago_cuentas
			},
			dataType: "json",
			success: function (respuesta) {
				$("#ID_cuenta_empresa option[value=" + respuesta['ID_cuenta_empresa'] + "]").attr("selected", true);
				$('#Fecha').val(respuesta['fecha']);
				$('#Descripcion').text(respuesta['Descripcion']);
				$('#Debe').val(respuesta['Debe']);
				$('#Haber').val(respuesta['Haber']);

			}
		});
		opcion = 'editar';
	});
	$('#formMovimientoCuentaEmpresa').submit(function (e) {
		e.preventDefault();

		ID_cuenta_empresa = $.trim($('#ID_cuenta_empresa').val());
		Fecha = $.trim($('#Fecha').val());
		Descripcion = $.trim($('#Descripcion').val());
		Debe = $.trim($('#Debe').val());
		Haber = $.trim($('#Haber').val());


		$('#modal-MovimientoCuentaEmpresa').modal('hide');

		if (opcion != 'editar') {
			$.ajax({
				type: "POST",
				url: base_url + "/Pago_cuentas/ingresarmovimientoCajaEmpresa",
				data: {
					ID_cuenta_empresa: ID_cuenta_empresa,
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
						Nombre = respuesta['datos']['Nombre'];
						DescripcionCuenta = respuesta['datos']['DescripcionCuenta'];
						Descripcion = respuesta['datos']['Descripcion'];
						Debe = respuesta['datos']['Debe'];
						Haber = respuesta['datos']['Haber'];
						tabla.row.add([ID_pago_cuentas, Fecha, Nombre, DescripcionCuenta, Descripcion, Debe, Haber]).draw();
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
				url: base_url + "/Pago_cuentas/editarmovimientoCajaEmpresa",
				data: {
					ID_pago_cuentas: ID_pago_cuentas,
					ID_cuenta_empresa: ID_cuenta_empresa,
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
						Nombre = respuesta['datos']['Nombre'];
						DescripcionCuenta = respuesta['datos']['DescripcionCuenta'];
						Descripcion = respuesta['datos']['Descripcion'];
						Debe = respuesta['datos']['Debe'];
						Haber = respuesta['datos']['Haber'];
						LimpiarFormulario();
						tabla.row(fila).data([ID_pago_cuentas, Fecha, Nombre, DescripcionCuenta, Descripcion, Debe, Haber]).draw();

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
	$('#modal-MovimientoCuentaEmpresa').modal('hide');
	$('.modal-title').text('Formulario transacciones de cuentas de empresa');
	$('#Descripcion').text('');
	$("#ID_cuenta_empresa option:selected").removeAttr("selected");
	$('#formMovimientoCuentaEmpresa').trigger('reset');
	opcion = '';
};
