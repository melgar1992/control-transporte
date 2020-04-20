$(document).ready(function () {
	var tabla = $('#tablaTipoContrato').DataTable({
		responsive: "true",
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
		$('#formContatos').trigger('reset');

	});
	$('#formContatos').submit(function (e) {
		e.preventDefault();
		tipoContrato = $.trim($('#tipoContrato').val());

		$.ajax({
			type: "POST",
			url: base_url + "/Contrato/ingresar_tipo_contrato",
			data: {
				tipoContrato: tipoContrato,
			},
			dataType: "json",
			success: function (respuesta) {
				if (respuesta['respuesta'] === 'Exitoso') {
					id_control = respuesta['datos']['id_tipocontrato'];
					tipoContrato = respuesta['datos']['tipocontrato'];
                    tabla.row.add([id_control, tipoContrato]).draw();
                    $('#modal-default').modal('hide');
					swal({
						title: 'Guardar',
						text: respuesta['respuesta'],
						type: 'success'
					});
                    $('#formContatos').trigger('reset');
				} else {
					swal({
						title: 'Error',
						text: respuesta['respuesta'],
						type: 'error'
					});
				}

			}
		});

	});
	$(document).on('click', '#btn-borrar', function () {


		Swal.fire({
			title: 'Esta seguro de elimar?',
			text: "El tipo de contrato se eliminara, una vez eliminado no se recuperara!",
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
					url: base_url + "/Contrato/eliminar/" + id,
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
