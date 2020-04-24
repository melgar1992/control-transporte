$(document).ready(function () {
	opcion = '';
	var tabla = $('#tablaCamionesPropio').DataTable({
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
		$('.modal-title').text('Formulario camion editar');
		$('#modal-camionPropio').modal('show');
		$.ajax({
			type: "POST",
			url: base_url + "/Camion/obtenerCamionPropio",
			data: {
				ID_camion: ID_camion
			},
			dataType: "json",
			success: function (respuesta) {

				$("#ID_contrato option[value=" + respuesta['ID_contrato'] + "]").attr("selected", true);
				$('#Placa').val(respuesta['N_placa']);
				$('#Modelo').val(respuesta['Modelo']);
				$('#Marca').val(respuesta['Marca']);
				$('#Color').val(respuesta['Color']);
				$('#Capacidad').val(respuesta['Capacidad']);
				$('#N_senasag').val(respuesta['N_senasag']);
				$('#Kilometraje').val(respuesta['Kilometraje']);

			}
		});
		opcion = 'editar';

	});
	$('#formcamionPropio').submit(function (e) {
		e.preventDefault();
		ID_contrato = $.trim($('#ID_contrato').val());
		Placa = $.trim($('#Placa').val());
		Modelo = $.trim($('#Modelo').val());
		Marca = $.trim($('#Marca').val());
		Color = $.trim($('#Color').val());
		Capacidad = $.trim($('#Capacidad').val());
		N_senasag = $.trim($('#N_senasag').val());
		Kilometraje = $.trim($('#Kilometraje').val());
		LimpiarFormulario();

		if (opcion != 'editar') {
			$.ajax({
				type: "POST",
				url: base_url + "/Camion/ingresarCamionPropio",
				data: {
					ID_contrato: ID_contrato,
					Placa: Placa,
					Modelo: Modelo,
					Marca: Marca,
					Color: Color,
					Capacidad: Capacidad,
					N_senasag: N_senasag,
					Kilometraje: Kilometraje,
				},
				dataType: "json",
				success: function (respuesta) {
					if (respuesta['respuesta'] === 'Exitoso') {
						ID_camion = respuesta['datos']['ID_camion'];
						CI = respuesta['datos']['CI'];
						Nombres = respuesta['datos']['Nombres'];
						Apellidos = respuesta['datos']['Apellidos'];
						Placa = respuesta['datos']['Placa'];
						Modelo = respuesta['datos']['Modelo'];
						Color = respuesta['datos']['Color'];
						N_senasag = respuesta['datos']['N_senasag'];
						Kilometraje = respuesta['datos']['Kilometraje'];
						tabla.row.add([ID_camion, Nombres, Apellidos, CI, Placa, Modelo, Marca, Color, Capacidad, N_senasag]).draw();
						swal({
							title: 'Guardar',
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
		} else {
			$.ajax({
				type: "POST",
				url: base_url + "/Empleado/editarEmpleado",
				data: {
					ID_contrato: ID_contrato,
					Placa: Placa,
					Modelo: Modelo,
					Marca: Marca,
					Color: Color,
					Capacidad: Capacidad,
					N_senasag: N_senasag,
					Kilometraje: Kilometraje,
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
						tabla.row(fila).data([ID_camion, Nombres, Apellidos, CI, Placa, Modelo, Marca, Color, Capacidad, N_senasag]).draw();

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
});

function LimpiarFormulario() {
	$('#modal-camionPropio').modal('hide');
	$('#formcamionPropio').trigger('reset');
	$('.modal-title').text('Formulario camiones propios');
	opcion = '';
};
