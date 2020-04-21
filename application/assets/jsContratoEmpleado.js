$(document).ready(function () {
	opcion = '';
	var tabla = $('#tablaContratos').DataTable({
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
		$('#formContratoEmpleados').trigger('reset');
		$('.modal-title').text('Formulario  de contrato empleado');
		opcion = '';

	});
	$("#nombres").autocomplete({
		source: function (request, response) {
			$.ajax({
				url: base_url + "/Empleado/buscarEmpleadoajax",
				type: "POST",
				dataType: "json",
				data: { valor: request.term },
				success: function (data) {
					response(data);
				}
			});
		},
		minLength: 2,
		select: function (event, ui) {
			data = ui.item.label + " " + ui.item.Apellido_p + " " + ui.item.Apellido_m;
			ID_empleado = ui.item.ID_empleado;
			CI = ui.item.CI
			$('#ID_empleado').val(ID_empleado);
			$('#CI').val(CI);
		},
	});
	$("#CI").autocomplete({
		source: function (request, response) {
			$.ajax({
				url: base_url + "/Empleado/buscarEmpleadoaCIajax",
				type: "POST",
				dataType: "json",
				data: { valor: request.term },
				success: function (data) {
					response(data);
				}
			});
		},
		minLength: 2,
		select: function (event, ui) {
			data = ui.item.label;
			nombre = ui.item.Nombres+ " " + ui.item.Apellido_p + " " + ui.item.Apellido_m;
			ID_empleado = ui.item.ID_empleado;
			$('#ID_empleado').val(ID_empleado);
			$('#nombres').val(nombre);
		},
	});
});
