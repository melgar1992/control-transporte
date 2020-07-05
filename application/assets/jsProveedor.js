$(document).ready(function () {
	opcion = '';
	var tabla = $('#tablaProveedor').DataTable({
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
		ID_proveedor = parseInt(fila.find('td:eq(0)').text());
		$('.modal-title').text('Formulario Proveedor editar');
		$('#modal-proveedor').modal('show');
		$.ajax({
			type: "POST",
			url: base_url + "/Proveedor/obtenerProveedorAjax",
			data: {
				ID_proveedor: ID_proveedor
			},
			dataType: "json",
			success: function (respuesta) {
			
				$('#CI').val(respuesta['CI']);
				$('#nombres').val(respuesta['Nombres']);
				$('#apellidos').val(respuesta['Apellidos']);
				$('#direccion').text(respuesta['Direccion']);
				$("#departamento option:contains(" + respuesta['Departamento'] + ")").attr("selected", true);
				$('#telefono_01').val(respuesta['Telefono_01']);
				$('#telefono_02').val(respuesta['Telefono_02']);
				$('#calificacion').val(respuesta['Calificacion']);
				$('#descripcion').val(respuesta['Descripcion']);

			}
		});
		opcion = 'editar';

	});
	$('#formProveedor').submit(function (e) {
		e.preventDefault();
		CI = $.trim($('#CI').val());
		nombres = $.trim($('#nombres').val());
		Apellidos = $.trim($('#apellidos').val());
		direccion = $.trim($('#direccion').val());
		departamento = $.trim($('#departamento').val());
		telefono_01 = $.trim($('#telefono_01').val());
		telefono_02 = $.trim($('#telefono_02').val());
		calificacion = $.trim($('#calificacion').val());
		descripcion = $.trim($('#descripcion').val());
		$('#modal-proveedor').modal('hide');

		if (opcion != 'editar') {
			$.ajax({
				type: "POST",
				url: base_url + "/Proveedor/ingresar_proveedor",
				data: {
					CI: CI,
					nombres: nombres,
					Apellidos: Apellidos,
					direccion: direccion,
					departamento: departamento,
					telefono_01: telefono_01,
					telefono_02: telefono_02,
					calificacion: calificacion,
					descripcion: descripcion,

				},
				dataType: "json",
				success: function (respuesta) {
					if (respuesta['respuesta'] === 'Exitoso') {
						ID_proveedor = respuesta['datos']['ID_proveedor'];
						CI = respuesta['datos']['CI'];
						nombres = respuesta['datos']['Nombres'];
						Apellidos = respuesta['datos']['Apellidos'];
						telefono01 = respuesta['datos']['Telefono_01'];
						telefono_02 = respuesta['datos']['Telefono_02'];
						departamento = respuesta['datos']['departamento'];
						tabla.row.add([ID_proveedor, CI, nombres, Apellidos, telefono01, telefono_02, calificacion, descripcion]).draw();

						swal({
							title: 'Guardar',
							text: respuesta['message'],
							type: 'success'
						});
						$('#formProveedor').trigger('reset');
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
				url: base_url + "/Proveedor/editarProveedor",
				data: {
					ID_proveedor: ID_proveedor,
					CI: CI,
					nombres: nombres,
					Apellidos: Apellidos,
					direccion: direccion,
					departamento: departamento,
					telefono_01: telefono_01,
					telefono_02: telefono_02,
					calificacion: calificacion,
					descripcion: descripcion,
				},
				dataType: "json",
				success: function (respuesta) {
					if (respuesta['respuesta'] === 'Exitoso') {
						ID_proveedor = respuesta['datos']['ID_proveedor'];
						CI = respuesta['datos']['CI'];
						nombres = respuesta['datos']['Nombres'];
						Apellidos = respuesta['datos']['Apellidos'];
						telefono01 = respuesta['datos']['Telefono_01'];
						telefono_02 = respuesta['datos']['Telefono_02'];
						departamento = respuesta['datos']['departamento'];
						tabla.row(fila).data([ID_proveedor, CI, nombres, Apellidos, telefono01, telefono_02, calificacion, descripcion]).draw();

						swal({
							title: 'Editado',
							text: respuesta['message'],
							type: 'success'
						});
						$('#formProveedor').trigger('reset');
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
			text: "El proveedor se eliminara, una vez eliminado no se recuperara!",
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
					url: base_url + "/Proveedor/eliminarProveedor/" + id,
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
	$('#modal-proveedor').modal('hide');
	$('.modal-title').text('Formulario proveedor');
	$("#departamento option:selected").removeAttr("selected");
	$('#direccion').text('');
	$('#formProveedor').trigger('reset');
	opcion = '';
}