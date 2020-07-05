$(document).ready(function () {
    
    var tabla = $('#tablaEmpleados').DataTable({
		responsive: "true",
		"order": [
			[0, "desc"]
		],
		
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

    $(document).on('click', '.btn-balance-empleado', function () {
		fila = $(this).closest('tr');
		ID_empleado = parseInt(fila.find('td:eq(0)').text());
		$.ajax({
			type: "POST",
			url: base_url + "/DashboardEmpleado/balanceEmpleado/" + ID_empleado,
			dataType: "html",
			success: function (respuesta) {
                
				$('#modal-reporte .modal-body').html(respuesta);
			}
		});

    });
    $(document).on('click', '.btn-print', function () {

		$("#modal-reporte .modal-body").print({
			title: 'Balance',
		});
	});
});