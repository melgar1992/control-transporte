$(document).ready(function () {
	opcion = '';
	var tabla = $('#tablaCliente').DataTable({
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
		ID_cliente = parseInt(fila.find('td:eq(0)').text());
		$('.modal-title').text('Formulario cleinte editar');
		$('#modal-cliente').modal('show');
		$.ajax({
			type: "POST",
			url: base_url + "/Cliente/obtenerCliente",
			data: {
				ID_cliente: ID_cliente
			},
			dataType: "json",
			success: function (respuesta) {

				$('#Nombre').val(respuesta['Nombre']);
				$('#Apellidos').val(respuesta['Apellidos']);
				$('#CI').val(respuesta['CI']);
				$('#Direccion').text(respuesta['Direccion']);
				$('#Telefono_01').val(respuesta['Telefono_01']);
				$('#Telefono_02').val(respuesta['Telefono_02']);
			}
		});
		opcion = 'editar';

	});
	$('#formcliente').submit(function (e) {
		e.preventDefault();
		Nombre = $.trim($('#Nombre').val());
		Apellidos = $.trim($('#Apellidos').val());
		CI = $.trim($('#CI').val());
		Direccion = $.trim($('#Direccion').val());
		Telefono_01 = $.trim($('#Telefono_01').val());
		Telefono_02 = $.trim($('#Telefono_02').val());

		$('#modal-cliente').modal('hide');

		if (opcion != 'editar') {
			$.ajax({
				type: "POST",
				url: base_url + "/Cliente/ingresarCliente",
				data: {
					Nombre: Nombre,
					Apellidos: Apellidos,
					CI: CI,
					Direccion: Direccion,
					Telefono_01: Telefono_01,
					Telefono_02: Telefono_02,

				},
				dataType: "json",
				success: function (respuesta) {
					if (respuesta['respuesta'] === 'Exitoso') {
						ID_cliente = respuesta['datos']['ID_cliente'];
						CI = respuesta['datos']['CI'];
						Nombres = respuesta['datos']['Nombres'];
						Apellidos = respuesta['datos']['Apellidos'];
						Direccion = respuesta['datos']['Direccion'];
						Telefono_01 = respuesta['datos']['Telefono_01'];
						Telefono_02 = respuesta['datos']['Telefono_02'];
						tabla.row.add([ID_cliente, CI, Nombres, Apellidos, Direccion, Telefono_01, Telefono_02]).draw();
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
				url: base_url + "/Cliente/editarCliente",
				data: {
					ID_cliente: ID_cliente,
					Nombre: Nombre,
					Apellidos: Apellidos,
					CI: CI,
					Direccion: Direccion,
					Telefono_01: Telefono_01,
					Telefono_02: Telefono_02,
				},
				dataType: "json",
				success: function (respuesta) {
					if (respuesta['respuesta'] === 'Exitoso') {
						ID_cliente = respuesta['datos']['ID_cliente'];
						CI = respuesta['datos']['CI'];
						Nombres = respuesta['datos']['Nombres'];
						Apellidos = respuesta['datos']['Apellidos'];
						Direccion = respuesta['datos']['Direccion'];
						Telefono_01 = respuesta['datos']['Telefono_01'];
						Telefono_02 = respuesta['datos']['Telefono_02'];
						LimpiarFormulario();
						tabla.row(fila).data([ID_cliente, CI, Nombres, Apellidos, Direccion, Telefono_01, Telefono_02]).draw();

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
			text: "El cliente se eliminara, una vez eliminado no se recuperara!",
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
					url: base_url + "/cliente/eliminarCliente/" + id,
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
	$('#modal-cliente').modal('hide');
	$('#formcliente').trigger('reset');
	$('.modal-title').text('Formulario cliente');
	opcion = '';
};
