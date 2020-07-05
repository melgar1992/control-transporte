$(document).ready(function () {
	opcion = '';
	var tabla = $('#tablaContratos').DataTable({
		responsive: "true",
		"order": [
			[0, "desc"]
		],
		"columnDefs": [{
			"targets": -1,
			"data": null,
			"defaultContent": "<div class='text-right'> <div class='btn-group'><button class='btn btn-warning' id='btn-editar'><i class='fas fa-pencil-alt'></i> Editar</button><button class='btn btn-danger' id='btn-borrar'><i class='fas fa-trash-alt'></i> Borrar</button></div></div>",
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
	$("#nombres").autocomplete({
		source: function (request, response) {
			$.ajax({
				url: base_url + "/Empleado/buscarEmpleadoajax",
				type: "POST",
				dataType: "json",
				data: {
					valor: request.term
				},
				success: function (data) {
					response(data);
				}
			});
		},
		minLength: 2,
		select: function (event, ui) {
			data = ui.item.label + " " + ui.item.Apellido_p + " " + ui.item.Apellido_m;
			ID_empleado = ui.item.ID_empleado;
			CI = ui.item.CI
			$('#ID_empleado').val(ID_empleado);
			$('#CI').val(CI);
		},
	});
	$("#CI").autocomplete({
		source: function (request, response) {
			$.ajax({
				url: base_url + "/Empleado/buscarEmpleadoaCIajax",
				type: "POST",
				dataType: "json",
				data: {
					valor: request.term
				},
				success: function (data) {
					response(data);
				}
			});
		},
		minLength: 2,
		select: function (event, ui) {
			data = ui.item.label;
			nombre = ui.item.Nombres + " " + ui.item.Apellido_p + " " + ui.item.Apellido_m;
			ID_empleado = ui.item.ID_empleado;
			$('#ID_empleado').val(ID_empleado);
			$('#nombres').val(nombre);
		},
	});
	$(document).on('click', '#btn-editar', function () {
		fila = $(this).closest('tr');
		ID_contrato = parseInt(fila.find('td:eq(0)').text());
		$('.modal-title').text('Formulario  de contrato empleado Editar');
		$('#modal-contratoEmpleado').modal('show');
		$.ajax({
			type: "POST",
			url: base_url + "/ContratoEmpleado/obtenerContratoxID",
			data: {
				ID_contrato: ID_contrato
			},
			dataType: "json",
			success: function (respuesta) {
				$('#CI').val(respuesta['datos']['CI']);
				$('#nombres').val(respuesta['datos']['Nombres']);
				$('#sueldo').val(respuesta['datos']['sueldo']);
				$('#FechaIngreso').val(respuesta['datos']['fechain']);
				$('#FechaSalida').val(respuesta['datos']['fechafin']);
				$("#tipocontrato option:contains(" + respuesta['datos']['Descripcion'] + ")").attr("selected", true);
				$('#CI').attr('readonly', true);
				$('#nombres').attr('readonly', true);
			}
		});
		opcion = 'editar';

	});
	$('#formContratoEmpleados').submit(function (e) {
		e.preventDefault();
		ID_empleado = $.trim($('#ID_empleado').val());
		tipocontrato = $.trim($('#tipocontrato').val());
		sueldo = $.trim($('#sueldo').val());
		FechaIngreso = $.trim($('#FechaIngreso').val());
		FechaSalida = $.trim($('#FechaSalida').val());
		$('#modal-contratoEmpleado').modal('hide');
		if (opcion != 'editar') {
			$.ajax({
				type: "POST",
				url: base_url + "/ContratoEmpleado/ingresar_contrato_empleado",
				data: {
					ID_empleado: ID_empleado,
					tipocontrato: tipocontrato,
					sueldo: sueldo,
					FechaIngreso: FechaIngreso,
					FechaSalida: FechaSalida,
				},
				dataType: "json",
				success: function (respuesta) {
					if (respuesta['respuesta'] === 'Exitoso') {
						id_contrato = respuesta['datos']['id_contrato'];
						CI = respuesta['datos']['CI'];
						nombres = respuesta['datos']['nombres'];
						Apellido_p = respuesta['datos']['Apellido_p'];
						Apellido_m = respuesta['datos']['Apellido_m'];
						descripcion = respuesta['datos']['descripcion'];
						sueldo = respuesta['datos']['sueldo'];
						fechain = respuesta['datos']['fechain'];
						fechafin = respuesta['datos']['fechafin'];
						d = new Date();
						fechaActual =(d.getFullYear() + "-" + (d.getMonth() + 1) + "-" + d.getDate());
						estado = respuesta['datos']['fechafin'] > fechaActual ? 'Vigente' : 'Vencido';
						tabla.row.add([id_contrato, CI, nombres, Apellido_p, Apellido_m, descripcion, sueldo, fechain, fechafin, estado]).draw();
						$('#modal-contratoEmpleado').modal('hide');
						LimpiarFormulario();
						swal({
							title: 'Guardar',
							text: respuesta['message'],
							type: 'success'
						});
						$('#formContatos').trigger('reset');
					} else {
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
				url: base_url + "/ContratoEmpleado/editar_contrato_empleado",
				data: {
					ID_contrato: ID_contrato,
					tipocontrato: tipocontrato,
					sueldo: sueldo,
					FechaIngreso: FechaIngreso,
					FechaSalida: FechaSalida,
				},
				dataType: "json",
				success: function (respuesta) {
					if (respuesta['respuesta'] === 'Exitoso') {
						id_contrato = respuesta['datos']['id_contrato'];
						CI = respuesta['datos']['CI'];
						nombres = respuesta['datos']['nombres'];
						Apellido_p = respuesta['datos']['Apellido_p'];
						Apellido_m = respuesta['datos']['Apellido_m'];
						descripcion = respuesta['datos']['Descripcion'];
						sueldo = respuesta['datos']['sueldo'];
						fechain = respuesta['datos']['fechain'];
						fechafin = respuesta['datos']['fechafin'];
						d = new Date();
						fechaActual =(d.getFullYear() + "-" + (d.getMonth() + 1) + "-" + d.getDate());
						estado = respuesta['datos']['fechafin'] > fechaActual ? 'Vigente' : 'Vencido';
						tabla.row(fila).data([id_contrato, CI, nombres, Apellido_p, Apellido_m, descripcion, sueldo, fechain, fechafin, estado]).draw();
						LimpiarFormulario();
						opcion = '';
						swal({
							title: 'Editado',
							text: respuesta['mensage'],
							type: 'success'
						});
					} else {
						swal({
							title: 'Error',
							text: respuesta['mensage'],
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
			text: "El contrato se eliminara, una vez eliminado no se recuperara!",
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
					url: base_url + "/ContratoEmpleado/eliminar_contrato_empleado/" + id,
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
	$('#modal-contratoEmpleado').modal('hide');
	$('.modal-title').text('Formulario  de contrato empleado');
	$("#tipocontrato option:selected").removeAttr("selected");
	$('#CI').attr('readonly', false);
	$('#nombres').attr('readonly', false);
	$('#formContratoEmpleados').trigger('reset');
	opcion = '';

}
