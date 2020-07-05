$(document).ready(function () {
	opcion = '';
	var tabla = $('#tablaUsuarios').DataTable({
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
	$('#btn-nuevo').on('click', function () {
		LimpiarFormulario();
		$('#modal-Usuarios').modal('show');
	});
	$(document).on('click', '#btn-editar', function () {
		LimpiarFormulario();
		fila = $(this).closest('tr');
		ID_user = parseInt(fila.find('td:eq(0)').text());
		$('.modal-title').text('Formulario usuario EDITAR');
		$('.contrasena-antigua').removeClass('hide');
		$('#password_actual').prop('disabled',false);
		$('#password').prop('required',false);
		$('#modal-Usuarios').modal('show');
		$.ajax({
			type: "POST",
			url: base_url + "/Usuario/obtenerUsuarioAjax",
			data: {
				ID_user: ID_user
			},
			dataType: "json",
			success: function (respuesta) {

				$('#username').val(respuesta['username']);			
				$("#privilegios option[value=" + respuesta['privilegios'] + "]").attr("selected", true);
				$('#nombre').val(respuesta['nombre']);
				$('#apellidos').val(respuesta['apellidos']);
				$('#CI').val(respuesta['CI']);

			}
		});
		opcion = 'editar';
	});
	$('#formUsuarios').submit(function (e) {
		e.preventDefault();

		username = $.trim($('#username').val());
		password_actual = $.trim($('#password_actual').val());
		password = $.trim($('#password').val());
		privilegios = $.trim($('#privilegios').val());
		nombre = $.trim($('#nombre').val());
		apellidos = $.trim($('#apellidos').val());
		CI = $.trim($('#CI').val());
		$('#modal-Usuarios').modal('hide');

		if (opcion != 'editar') {
			$.ajax({
				type: "POST",
				url: base_url + "/Usuario/ingresarUsuario",
				data: {
					username: username,
					password: password,
					privilegios: privilegios,
					nombre: nombre,
					apellidos: apellidos,
					CI: CI,
				},
				dataType: "json",
				success: function (respuesta) {
					if (respuesta['respuesta'] === 'Exitoso') {
						ID_user = respuesta['datos']['ID_user'];
						username = respuesta['datos']['username'];
						privilegios = respuesta['datos']['privilegios'];
						nombre = respuesta['datos']['nombre'];
						apellidos = respuesta['datos']['apellidos'];
						CI = respuesta['datos']['CI'];
						tabla.row.add([ID_user, username, privilegios, nombre, apellidos, CI]).draw();
						LimpiarFormulario();
						swal({
							title: 'Guardar',
							text: respuesta['respuesta'],
							type: 'success'
						});

					} else {
						LimpiarFormulario();
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
				url: base_url + "/Usuario/editarUsuario",
				data: {
					ID_user         : ID_user,
					username        : username,
					password_actual : password_actual,
					password        : password,
					privilegios     : privilegios,
					nombre          : nombre,
					apellidos       : apellidos,
					CI              : CI,
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
						tabla.row(fila).data([ID_user, username, privilegios, nombre, apellidos, CI]).draw();

						swal({
							title: 'Editado',
							text: respuesta['respuesta'],
							type: 'success'
						});
						$('#formEmpleados').trigger('reset');
					} else {
						LimpiarFormulario();
						swal({
							title: 'Error',
							text: respuesta['respuesta'],
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
			text: "El usuario se eliminara, una vez eliminado no se recuperara!",
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
	$('#modal-Usuarios').modal('hide');
	$('.modal-title').text('Formulario de un nuevo usuario');
	$('#Descripcion').text('');
	$("#privilegios option:selected").removeAttr("selected");
	$('.contrasena-antigua').addClass('hide');
	$('#password_actual').prop('disabled',true);
	$('#password').prop('required',true);
	$('#formUsuarios').trigger('reset');
	opcion = '';
};
