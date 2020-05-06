$(document).ready(function () {
	opcion = '';
	var tabla = $('#tablaCamionesProveedor').DataTable({
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
		ID_camion = parseInt(fila.find('td:eq(0)').text());
		$('.modal-title').text('Formulario camion proveedor editar');
		$('#modal-camionProveedor').modal('show');
		$.ajax({
			type: "POST",
			url: base_url + "/Camion/obtenerCamionProveedor",
			data: {
				ID_camion: ID_camion
			},
			dataType: "json",
			success: function (respuesta) {
				$("#ID_proveedor option[value=" + respuesta['ID_proveedor'] + "]").attr("selected", true);
				$('#NombresChofer').val(respuesta['NombresChofer']);
				$('#CI').val(respuesta['CI']);
				$('#Telefono').val(respuesta['Telefono']);
				$('#N_Placa').val(respuesta['N_Placa']);
				$('#Marca').val(respuesta['Marca']);
				$('#Color').val(respuesta['Color']);
				$('#Capacidad').val(respuesta['Capacidad']);
				$('#N_senasag').val(respuesta['N_Senasag']);

			}
		});
		opcion = 'editar';

	});
	$('#formcamionProveedor').submit(function (e) {
		e.preventDefault();
		ID_proveedor = $.trim($('#ID_proveedor').val());
		NombresChofer = $.trim($('#NombresChofer').val());
		CI = $.trim($('#CI').val());
		Telefono = $.trim($('#Telefono').val());
		Placa = $.trim($('#N_Placa').val());
		Marca = $.trim($('#Marca').val());
		Color = $.trim($('#Color').val());
		Capacidad = $.trim($('#Capacidad').val());
		N_senasag = $.trim($('#N_senasag').val());
		$('#modal-camionProveedor').modal('hide');
		if (opcion != 'editar') {
			$.ajax({
				type: "POST",
				url: base_url + "/Camion/ingresarCamionProveedor",
				data: {
					ID_proveedor: ID_proveedor,
					NombresChofer: NombresChofer,
					CI: CI,
					Telefono: Telefono,
					Placa: Placa,
					Marca: Marca,
					Color: Color,
					Capacidad: Capacidad,
					N_senasag: N_senasag,
					
				},
				dataType: "json",
				success: function (respuesta) {
					if (respuesta['respuesta'] === 'Exitoso') {
						ID_camion = respuesta['datos']['ID_camion'];
						CI = respuesta['datos']['CI'];
						NombreProveedor = respuesta['datos']['NombreProveedor'];
						NombresChofer = respuesta['datos']['NombresChofer'];
						Telefono = respuesta['datos']['Telefono'];
						Placa = respuesta['datos']['Placa'];
						Color = respuesta['datos']['Color'];
						Marca = respuesta['datos']['Marca'];
						Capacidad = respuesta['datos']['Capacidad'];
						N_senasag = respuesta['datos']['N_senasag'];
						tabla.row.add([ID_camion, NombreProveedor, NombresChofer, CI, Telefono, Placa, Marca, Color, Capacidad, N_senasag]).draw();
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
				url: base_url + "/Camion/editarCamionProveedor",
				data: {
					ID_camion: ID_camion,
					ID_proveedor: ID_proveedor,
					NombresChofer: NombresChofer,
					CI: CI,
					Telefono: Telefono,
					Placa: Placa,
					Marca: Marca,
					Color: Color,
					Capacidad: Capacidad,
					N_senasag: N_senasag,

				},
				dataType: "json",
				success: function (respuesta) {
					if (respuesta['respuesta'] === 'Exitoso') {
						ID_camion = respuesta['datos']['ID_camion'];
						CI = respuesta['datos']['CI'];
						NombreProveedor = respuesta['datos']['NombreProveedor'];
						NombresChofer = respuesta['datos']['NombresChofer'];
						Telefono = respuesta['datos']['Telefono'];
						Placa = respuesta['datos']['Placa'];
						Color = respuesta['datos']['Color'];
						Marca = respuesta['datos']['Marca'];
						Capacidad = respuesta['datos']['Capacidad'];
						N_senasag = respuesta['datos']['N_senasag'];
						LimpiarFormulario();
						tabla.row(fila).data([ID_camion, NombreProveedor, NombresChofer, CI, Telefono, Placa, Marca, Color, Capacidad, N_senasag]).draw();

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
			text: "El camion se eliminara, una vez eliminado no se recuperara!",
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
					url: base_url + "/Camion/eliminarCamionProveedor/" + id,
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
	$('#modal-camionProveedor').modal('hide');
	$('#formcamionProveedor').trigger('reset');
	$('.modal-title').text('Formulario camiones proveedores');
	$("#ID_proveedor option:selected").removeAttr("selected");

	opcion = '';
};
