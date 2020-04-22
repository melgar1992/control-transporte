$(document).ready(function () {
    opcion = '';
	var tabla = $('#tablaPagos').DataTable({
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
		$('#formpagoEmpleado').trigger('reset');
		$('.modal-title').text('Formulario  de pago empleado');
		$('#CI').attr('readonly', false);
        $('#nombres').attr('readonly', false);
        $('ID_contrato').val('');
        opcion = '';
    });
    $("#nombres").autocomplete({
		source: function (request, response) {
			$.ajax({
				url: base_url + "/ContratoEmpleado/buscarEmpleadoNombreAjax",
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
			ID_contrato = ui.item.ID_contrato;
			CI = ui.item.CI
			$('#ID_contrato').val(ID_contrato);
            $('#CI').val(CI);
            $("#sueldo").val(ui.item.sueldo);
		},
	});
	$("#CI").autocomplete({
		source: function (request, response) {
			$.ajax({
				url: base_url + "/ContratoEmpleado/buscarEmpleadoCIAjax",
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
			ID_contrato = ui.item.ID_contrato;
			$('#ID_contrato').val(ID_contrato);
            $('#nombres').val(nombre);
            $("#sueldo").val(ui.item.sueldo);
		},
    });
    //Aqui es donde se guarda o se elimina segun el estado de la opcion
    $('#formpagoEmpleado').submit(function (e) {
		e.preventDefault();
		ID_contrato = $.trim($('#ID_contrato').val());
        Monto = $.trim($('#Monto').val());
        descripcion = $.trim($('#descripcion').val());
		FechaPago = $.trim($('#FechaPago').val());
	
		if (opcion != 'editar') {
			$.ajax({
				type: "POST",
				url: base_url + "/pagoEmpleados/IngresarPagoEmpleado",
				data: {
					ID_contrato: ID_contrato,
					Monto: Monto,
					FechaPago: FechaPago,
					descripcion: descripcion,
				},
				dataType: "json",
				success: function (respuesta) {
					if (respuesta['respuesta'] === 'Exitoso') {
						id_pago = respuesta['datos']['id_pago'];
						nombres = respuesta['datos']['nombres'];
						Apellido_p = respuesta['datos']['Apellido_p'];
						descripcion = respuesta['datos']['descripcion'];
						Monto = respuesta['datos']['Monto'];
						FechaPago = respuesta['datos']['FechaPago'];
						tabla.row.add([id_pago, nombres, Apellido_p, FechaPago, descripcion, Monto]).draw();
						$('#modal-pagoEmpleado').modal('hide');
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
				url: base_url + "/pagoEmpleados/IngresarPagoEmpleado",
				data: {
					ID_contrato: ID_contrato,
					tipocontrato: tipocontrato,
					Monto: Monto,
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
						tabla.row(fila).data([id_contrato, CI, nombres, Apellido_p, Apellido_m, descripcion, sueldo, fechain, fechafin]).draw();
						$('#modal-pagoEmpleado').modal('hide');
						$('.modal-title').text('Formulario  de contrato empleado');
						$('#formpagoEmpleado').trigger('reset');
						$('#CI').attr('readonly', false);
						$('#nombres').attr('readonly', false);
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
			text: "El pago se eliminara, una vez eliminado no se recuperara!",
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
					url: base_url + "/pagoEmpleados/EliminarPagoEmpleado/" + id,
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
