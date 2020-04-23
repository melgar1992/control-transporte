$(document).ready(function () {
	opcion = '';
	var tabla = $('#tablaEmpleados').DataTable({
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


	});
	$(document).on('click', '#btn-editar', function () {
		fila = $(this).closest('tr');
		id_empleado = parseInt(fila.find('td:eq(0)').text());
		$('.modal-title').text('Formulario empleado editar');
		$('#modal-empleados').modal('show');
		$.ajax({
			type: "POST",
			url: base_url + "/Empleado/obtenerEmpleadoAjax",
			data: {
				id_empleado: id_empleado
			},
			dataType: "json",
			success: function (respuesta) {
				$('#CI').val(respuesta['CI']);
				$('#nombres').val(respuesta['Nombres']);
				$('#apellido-paterno').val(respuesta['Apellido_p']);
				$('#apellido-materno').val(respuesta['Apellido_m']);
				$('#fecha-nacimiento').val(respuesta['Fecha_nacimiento']);
				$('#direccion').text(respuesta['Direccion']);
				$('#fecha-nacimiento').val(respuesta['Fecha_nacimiento']);
				$("#departamento option:contains(" + respuesta['Departamento'] + ")").attr("selected", true);
				$('#telefono_01').val(respuesta['Telefono_01']);
				$('#telefono_02').val(respuesta['Telefono_02']);
				$('#calificacion').val(respuesta['Calificacion']);
				$('#descripcion').val(respuesta['Descripcion']);
				$("#tipo-licencia option:contains(" + respuesta['TipoLicencia'] + ")").attr("selected", true);
				$('#fecha-vencimiento-l').val(respuesta['FechaVencimientoL']);

			}
		});
		opcion = 'editar';

	});
	$('#formEmpleados').submit(function (e) {
		e.preventDefault();
		CI = $.trim($('#CI').val());
		nombres = $.trim($('#nombres').val());
		apellido_paterno = $.trim($('#apellido-paterno').val());
		apellido_materno = $.trim($('#apellido-materno').val());
		fecha_nacimiento = $.trim($('#fecha-nacimiento').val());
		direccion = $.trim($('#direccion').val());
		departamento = $.trim($('#departamento').val());
		telefono_01 = $.trim($('#telefono_01').val());
		telefono_02 = $.trim($('#telefono_02').val());
		calificacion = $.trim($('#calificacion').val());
		descripcion = $.trim($('#descripcion').val());
		tipo_licencia = $.trim($('#tipo-licencia').val());
		fecha_vencimiento_l = $.trim($('#fecha-vencimiento-l').val());
		LimpiarFormulario();

		if (opcion != 'editar') {
			$.ajax({
				type: "POST",
				url: base_url + "/Empleado/ingresar_empleado",
				data: {
					CI: CI,
					nombres: nombres,
					apellido_paterno: apellido_paterno,
					apellido_materno: apellido_materno,
					fecha_nacimiento: fecha_nacimiento,
					direccion: direccion,
					departamento: departamento,
					telefono_01: telefono_01,
					telefono_02: telefono_02,
					calificacion: calificacion,
					descripcion: descripcion,
					tipo_licencia: tipo_licencia,
					fecha_vencimiento_l: fecha_vencimiento_l,
				},
				dataType: "json",
				success: function (respuesta) {
					if (respuesta['respuesta'] === 'Exitoso') {
						id_control = respuesta['datos']['id_empleado'];
						CI = respuesta['datos']['ci'];
						nombres = respuesta['datos']['nombres'];
						apellidop = respuesta['datos']['apellidop'];
						apellidom = respuesta['datos']['apellidom'];
						fechan = respuesta['datos']['fechan'];
						telefono01 = respuesta['datos']['telefono01'];
						departamento = respuesta['datos']['departamento'];
						tlicencia = respuesta['datos']['tlicencia'];
						tabla.row.add([id_control, CI, nombres, apellidop, apellidom, fechan, telefono01, departamento, tlicencia]).draw();
	
						swal({
							title: 'Guardar',
							text: respuesta['respuesta'],
							type: 'success'
						});
						$('#formEmpleados').trigger('reset');
					} else {
						swal({
							title: 'Error',
							text: respuesta['respuesta'],
							type: 'error'
						});
					}

				}
			});
		} else {
			$.ajax({
				type: "POST",
				url: base_url + "/Empleado/editarEmpleado",
				data: {
					id: id_empleado,
					CI: CI,
					nombres: nombres,
					apellido_paterno: apellido_paterno,
					apellido_materno: apellido_materno,
					fecha_nacimiento: fecha_nacimiento,
					direccion: direccion,
					departamento: departamento,
					telefono_01: telefono_01,
					telefono_02: telefono_02,
					calificacion: calificacion,
					descripcion: descripcion,
					tipo_licencia: tipo_licencia,
					fecha_vencimiento_l: fecha_vencimiento_l,
				},
				dataType: "json",
				success: function (respuesta) {
					if (respuesta['respuesta'] === 'Exitoso') {
						id_empleado = respuesta['datos']['ID_empleado'];
						CI = respuesta['datos']['CI'];
						nombres = respuesta['datos']['Nombres'];
						apellidop = respuesta['datos']['Apellido_p'];
						apellidom = respuesta['datos']['Apellido_m'];
						fechan = respuesta['datos']['Fecha_nacimiento'];
						telefono01 = respuesta['datos']['Telefono_01'];
						departamento = respuesta['datos']['Departamento'];
						tlicencia = respuesta['datos']['TipoLicencia'];
						tabla.row(fila).data([id_empleado, CI, nombres, apellidop, apellidom, fechan, telefono01, departamento, tlicencia]).draw();

						swal({
							title: 'Editado',
							text: respuesta['message'],
							type: 'success'
						});
						$('#formEmpleados').trigger('reset');
					} else {
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
			text: "El empleado se eliminara, una vez eliminado no se recuperara!",
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
					url: base_url + "/Empleado/eliminarEmpleado/" + id,
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
	$('#modal-empleados').modal('hide');
	$('#formEmpleados').trigger('reset');
	$('.modal-title').text('Formulario empleado');
	$('#direccion').text('');
	opcion = '';
};