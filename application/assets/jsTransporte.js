$(document).ready(function () {
	var opcion = '';
	sumar();
	var tabla = $('#tablaTransporte').DataTable({
		responsive: "true",
		"order": [
			[1, "desc"]
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
	$(document).on('click', '#btn-editar', function () {
		fila = $(this).closest('tr');
		ID_transporte = parseInt(fila.find('td:eq(0)').text());
		window.open((base_url + '/Transporte/editarTransporte/' + ID_transporte), '_self');

	});
	$(document).on('click', '#btn-borrar', function () {
		Swal.fire({
			title: 'Esta seguro de elimar?',
			text: "El detalle del Transporte se eliminara, una vez eliminado no se recuperara!",
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
					url: base_url + "/Transporte/eliminarTransporte/" + id,
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
	$('#tablaPredioDestino').DataTable({
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
	$('#tablaPredioOrigen').DataTable({
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
	$('#tablaCliente').DataTable({
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
	$('#tablaCamionesProveedor').DataTable({
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
	$('#tablaCamionesPropios').DataTable({
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
	$(document).on('click', '.btn-check-predioOrigen', function () {

		predioOrigen = $(this).val();
		predioOrigen = predioOrigen.split('*');
		$('#ID_predio_origen').val(predioOrigen[0]);
		$('#predioOrigen').val(predioOrigen[1]);
		$('#modal-predioOrigen').modal('hide');

	});
	$(document).on('click', '.btn-check-predioDestino', function () {

		predioDestino = $(this).val();
		predioDestino = predioDestino.split('*');
		$('#ID_predio_destino').val(predioDestino[0]);
		$('#PredioDestino').val(predioDestino[1]);
		$('#modal-predioDestino').modal('hide');

	});
	$(document).on('click', '.btn-check-cliente', function () {

		Cliente = $(this).val();
		Cliente = Cliente.split('*');
		$('#ID_Cliente').val(Cliente[0]);
		$('#cliente').val(Cliente[2] + ' ' + Cliente[3]);
		$('#modal-Cliente').modal('hide');

	});
	$(document).on('click', '.btn-check-camionesPropios', function () {
		camionesPropios = $(this).val();
		camionesPropios = camionesPropios.split('*');
		$('#modal-CamionesPropios').modal('hide');
		if (camionesPropios != '') {
			html = "<tr>";
			html += "<td>" + camionesPropios[1] + ' ' + camionesPropios[2] + ' ' + camionesPropios[3] + "</td>";
			html += "<td>" + camionesPropios[4] + "</td>";
			html += "<td><input type='hidden' name = 'ID_camion[]' value ='" + camionesPropios[0] + "'>" + camionesPropios[5] + "</td>";
			html += "<td><input type='number'class = 'form-control' min='0' name = 'ActViaje[]' value ='0'></td>";
			html += "<td><input type='number' class = 'form-control' min='0' name = 'Diesel[]' value ='0'></td>";
			html += "<td><input type='number' class='PrecioProveedor form-control' min='0' name = 'PrecioProveedor[]' value ='0'></td>";
			html += "<td><input type='number' class='Precio form-control' min='0' name = 'Precio[]' value ='0'></td>";
			html += "<td><input type='number' class='Cantidad form-control' min='0' name = 'Cantidad[]' value ='" + camionesPropios[9] + "'></td>";
			html += "<td><input type='number' class='Comision form-control' min='0' name = 'Comision[]' value ='0'></td>";
			html += "<td><input type='number' class='Descuento form-control' min='0' name = 'Descuento[]' value ='0'></td>";
			html += "<td><input type ='hidden' name = 'TotalDetalle[]' value ='0'><p>0</p></td>";
			html += "<td><button type='button' class='btn btn-danger btn-remove-mantenimiento'><span class='fa fa-remove'></span></button></td>";
			html += "</tr>";
			$("#tablaDetalleTransporte tbody").append(html);
			sumar();

		} else {
			alert("Seleccionar un camion es obligatorios");
		}

	});
	$(document).on('click', '.btn-check-camionesProveedores', function () {
		camionesProveedores = $(this).val();
		camionesProveedores = camionesProveedores.split('*');
		$('#modal-CamionesProveedores').modal('hide');
		if (camionesProveedores != '') {
			html = "<tr>";
			html += "<td>" + camionesProveedores[3] + "</td>";
			html += "<td>" + camionesProveedores[4] + "</td>";
			html += "<td><input type='hidden' name = 'ID_camion[]' value ='" + camionesProveedores[0] + "'>" + camionesProveedores[6] + "</td>";
			html += "<td><input type='number' class = 'form-control' min='0' name = 'ActViaje[]' value ='0'></td>";
			html += "<td><input type='number' class ='form-control' readonly='readonly' min='0' name = 'Diesel[]' value ='0'></td>";
			html += "<td><input type='number' class='form-control PrecioProveedor' min='0' name = 'PrecioProveedor[]' value ='0'></td>";
			html += "<td><input type='number' class='form-control Precio' min='0' name = 'Precio[]' value ='0'></td>";
			html += "<td><input type='number' class='form-control Cantidad' min='0' name = 'Cantidad[]' value ='" + camionesProveedores[9] + "'></td>";
			html += "<td><input type='number' class='form-control Comision' min='0' name = 'Comision[]' value ='0'></td>";
			html += "<td><input type='number' class='form-control Descuento' min='0' name = 'Descuento[]' value ='0'></td>";
			html += "<td><input type ='hidden' name = 'TotalDetalle[]' value ='0'><p>0</p></td>";
			html += "<td><button type='button' class='btn btn-danger btn-remove-mantenimiento'><span class='fa fa-remove'></span></button></td>";
			html += "</tr>";
			$("#tablaDetalleTransporte tbody").append(html);
			sumar();

		} else {
			alert("Seleccionar un camion es obligatorios");
		}

	});
	// Al cambiar el precio transporte se realiza los calculos para el transporte
	$(document).on('change', '#tablaDetalleTransporte input.Precio', function () {
		sumar();

	});
	$(document).on('change', '#tablaDetalleTransporte input.PrecioProveedor', function () {
		sumar();

	});
	$(document).on('change', '#tablaDetalleTransporte input.Cantidad', function () {
		sumar();
	});
	$(document).on('change', '#tablaDetalleTransporte input.Comision', function () {
		sumar();
	});
	$(document).on('change', '#tablaDetalleTransporte input.Descuento', function () {
		sumar();
	});
	//Remueve la fila seleccionada
	$(document).on("click", ".btn-remove-mantenimiento", function () {

		$(this).closest("tr").remove();
		sumar();
	});

});

function sumar() {
	subTotal = 0;
	difPrecio = 0;
	cantidad = 0;
	comision = 0;
	comisionTotal = 0;
	descuento = 0;
	$("#tablaDetalleTransporte  tbody tr").each(function () {
		//Se calcula y se actualiza el monto a  pagar por el cliente por camion
		TotalporCamion = Number($(this).find("td:eq(6)").children('input').val()) * Number($(this).find("td:eq(7)").children('input').val());
		$(this).find("td:eq(10)").children('input').val(TotalporCamion);
		$(this).find("td:eq(10)").children('p').text(TotalporCamion.toFixed(2));
		//Se calcula el acumulado de la fila
		subTotal = subTotal + Number($(this).find("td:eq(10)").text());
		descuento = descuento + Number($(this).find("td:eq(9)").children('input').val())
		comision = Number($(this).find("td:eq(8)").children('input').val());
		cantidad = Number($(this).find("td:eq(7)").children('input').val());
		difPrecio = Number($(this).find("td:eq(6)").children('input').val()) - Number($(this).find("td:eq(5)").children('input').val());
		comisionTotal = comisionTotal + (difPrecio * cantidad) + comision;
		
	});
	$("input[name=SubTotal]").val(subTotal.toFixed(2));
	$("input[name=ComisionTotal]").val(comisionTotal.toFixed(2));
	$("input[name=DescuentoTotal]").val(descuento.toFixed(2));
	Total = subTotal - descuento;
	$("input[name=Total]").val(Total.toFixed(2));

}
