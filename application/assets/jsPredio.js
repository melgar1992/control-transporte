$(document).ready(function () {
	opcion = '';
	var tabla = $('#tablaPredio').DataTable({
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
		ID_predio = parseInt(fila.find('td:eq(0)').text());
		$('.modal-title').text('Formulario predio editar');
		$('#modal-predio').modal('show');
		$.ajax({
			type: "POST",
			url: base_url + "/Predio/obtenerPredio",
			data: {
				ID_predio: ID_predio
			},
			dataType: "json",
			success: function (respuesta) {

				$('#NombrePredio').val(respuesta['NombrePredio']);
				$('#Provincia').val(respuesta['Provincia']);
				$('#Municipio').val(respuesta['Municipio']);
				$('#NombrePropietario').val(respuesta['NombrePropietario']);
				$('#ApellidoPropietario').val(respuesta['ApellidoPropietario']);
				$("#Departamento option:contains(" + respuesta['Departamento'] + ")").attr("selected", true);
				$("#TipoPredio option:contains(" + respuesta['TipoPredio'] + ")").attr("selected", true);
				$('#Direccion').text(respuesta['Direccion']);
			}
		});
		opcion = 'editar';

	});
	$('#formpredio').submit(function (e) {
		e.preventDefault();

		NombrePredio = $.trim($('#NombrePredio').val());
		Departamento = $.trim($('#Departamento').val());
		Provincia = $.trim($('#Provincia').val());
		Municipio = $.trim($('#Municipio').val());
		NombrePropietario = $.trim($('#NombrePropietario').val());
		ApellidoPropietario = $.trim($('#ApellidoPropietario').val());
		TipoPredio = $.trim($('#TipoPredio').val());
		Direccion = $.trim($('#Direccion').val());

		$('#modal-predio').modal('hide');

		if (opcion != 'editar') {
			$.ajax({
				type: "POST",
				url: base_url + "/Predio/ingresarPredio",
				data: {
					NombrePredio: NombrePredio,
					Departamento: Departamento,
					Provincia: Provincia,
					Municipio: Municipio,
					NombrePropietario: NombrePropietario,
					ApellidoPropietario: ApellidoPropietario,
					TipoPredio: TipoPredio,
					Direccion: Direccion,

				},
				dataType: "json",
				success: function (respuesta) {
					if (respuesta['respuesta'] === 'Exitoso') {
						ID_predio = respuesta['datos']['ID_predio'];
						NombrePredio = respuesta['datos']['NombrePredio'];
						Direccion = respuesta['datos']['Direccion'];
						Departamento = respuesta['datos']['Departamento'];
						Provincia = respuesta['datos']['Provincia'];
						Municipio = respuesta['datos']['Municipio'];
						NombrePropietario = respuesta['datos']['NombrePropietario'] + ' ' + respuesta['datos']['ApellidoPropietario'];
						TipoPredio = respuesta['datos']['TipoPredio'];
						tabla.row.add([ID_predio, NombrePredio, Direccion, Departamento, Provincia, Municipio, NombrePropietario, TipoPredio]).draw();
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
				url: base_url + "/Predio/editarPredio",
				data: {
					ID_predio: ID_predio,
					NombrePredio: NombrePredio,
					Departamento: Departamento,
					Provincia: Provincia,
					Municipio: Municipio,
					NombrePropietario: NombrePropietario,
					ApellidoPropietario: ApellidoPropietario,
					TipoPredio: TipoPredio,
					Direccion: Direccion,
				},
				dataType: "json",
				success: function (respuesta) {
					if (respuesta['respuesta'] === 'Exitoso') {

						NombrePredio = respuesta['datos']['NombrePredio'];
						Direccion = respuesta['datos']['Direccion'];
						Departamento = respuesta['datos']['Departamento'];
						Provincia = respuesta['datos']['Provincia'];
						Municipio = respuesta['datos']['Municipio'];
						NombrePropietario = respuesta['datos']['NombrePropietario'] + ' ' + respuesta['datos']['ApellidoPropietario'];
						TipoPredio = respuesta['datos']['TipoPredio'];
						LimpiarFormulario();
						tabla.row(fila).data([ID_predio, NombrePredio, Direccion, Departamento, Provincia, Municipio, NombrePropietario, TipoPredio]).draw();

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
			text: "El predio se eliminara, una vez eliminado no se recuperara!",
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
					url: base_url + "/Predio/eliminarPredio/" + id,
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
	$('#modal-predio').modal('hide');
	$('#formpredio').trigger('reset');
	$('.modal-title').text('Formulario predio ');
	$("#Departamento option:selected").removeAttr("selected");
	$("#TipoPredio option:selected").removeAttr("selected");
	$('#Direccion').text('');
	opcion = '';
};
