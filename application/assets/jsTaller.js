$(document).ready(function () {
    opcion = '';
	var tabla = $('#tablaTalleres').DataTable({
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
		ID_taller = parseInt(fila.find('td:eq(0)').text());
		$('.modal-title').text('Formulario tallerres o ferreterias editar');
		$('#modal-talleres').modal('show');
		$.ajax({
			type: "POST",
			url: base_url + "/Taller/obtenerTaller",
			data: {
				ID_taller: ID_taller
			},
			dataType: "json",
			success: function (respuesta) {

				$('#NombreTaller').val(respuesta['NombreTaller']);
				$("#Departamento option:contains(" + respuesta['Departamento'] + ")").attr("selected", true);
				$('#Direccion').text(respuesta['Direccion']);
			}
		});
		opcion = 'editar';

	});
	$('#formtalleres').submit(function (e) {
		e.preventDefault();
		NombreTaller = $.trim($('#NombreTaller').val());
		Departamento = $.trim($('#Departamento').val());
		Direccion = $.trim($('#Direccion').val());

		$('#modal-talleres').modal('hide');

		if (opcion != 'editar') {
			$.ajax({
				type: "POST",
				url: base_url + "/Taller/ingresarTaller",
				data: {
					NombreTaller: NombreTaller,
					Departamento: Departamento,
					Direccion: Direccion,
			
				},
				dataType: "json",
				success: function (respuesta) {
					if (respuesta['respuesta'] === 'Exitoso') {
						ID_taller = respuesta['datos']['ID_taller'];
						NombreTaller = respuesta['datos']['NombreTaller'];
						Departamento = respuesta['datos']['Departamento'];
						Direccion = respuesta['datos']['Direccion'];
						tabla.row.add([ID_taller, NombreTaller, Departamento, Direccion]).draw();
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
				url: base_url + "/Taller/editarTaller",
				data: {
					ID_taller: ID_taller,
					NombreTaller: NombreTaller,
					Departamento: Departamento,
					Direccion: Direccion,
				},
				dataType: "json",
				success: function (respuesta) {
					if (respuesta['respuesta'] === 'Exitoso') {
						ID_taller = respuesta['datos']['ID_taller'];
						NombreTaller = respuesta['datos']['NombreTaller'];
						Departamento = respuesta['datos']['Departamento'];
						Direccion = respuesta['datos']['Direccion'];
						LimpiarFormulario();
						tabla.row(fila).data([ID_taller, NombreTaller, Departamento, Direccion]).draw();

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
			text: "El taller o ferreteria se eliminara, una vez eliminado no se recuperara!",
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
					url: base_url + "/Taller/eliminarTaller/" + id,
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
	$('#modal-talleres').modal('hide');
	$('#formtalleres').trigger('reset');
	$('.modal-title').text('Formulario talleres o ferreterias');
	$('#Direccion').text('');
	opcion = '';
};