$(document).ready(function () {
	sumar();
	var tabla = $('#tablaMantenimiento').DataTable({
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
	$("#btn-agregar").on("click", function () {
		agregarProducto();
	});
	$(document).on('click', '#btn-editar', function () {
		fila = $(this).closest('tr');
		ID_mantenimiento = parseInt(fila.find('td:eq(0)').text());
		window.open((base_url + '/Mantenimiento/editarMantenimiento/' + ID_mantenimiento), '_self');

	});
	// Al cambiar la canditad del mantenimiento se realiza los calculos para el mantenimiento
	$(document).on('change', '#tbmantenimiento input.Cantidad', function () {
		cantidad = $(this).val();
		precioUnitario = $(this).closest('tr').find('td:eq(6)').children('input').val()
		ImporteTotal = cantidad * precioUnitario;
		$(this).closest('tr').find('td:eq(8)').children('input').val(ImporteTotal);
		$(this).closest('tr').find('td:eq(8)').children('p').text(ImporteTotal.toFixed(2));
		sumar();
	});
	// Al cambiar el precio unitario del mantenimiento se realiza los calculos para el mantenimiento
	$(document).on('change', '#tbmantenimiento input.PrecioUnitario', function () {
		precioUnitario = $(this).val();
		cantidad = $(this).closest('tr').find('td:eq(7)').children('input').val()
		ImporteTotal = cantidad * precioUnitario;
		$(this).closest('tr').find('td:eq(8)').children('input').val(ImporteTotal);
		$(this).closest('tr').find('td:eq(8)').children('p').text(ImporteTotal.toFixed(2));
		sumar();
	});
	//Remueve la fila seleccionada
	$(document).on("click", ".btn-remove-mantenimiento", function () {

		$(this).closest("tr").remove();
		sumar();
	});
	$(document).on('click', '#btn-borrar', function () {
		Swal.fire({
			title: 'Esta seguro de elimar?',
			text: "El detalle del mantenimiento se eliminara, una vez eliminado no se recuperara!",
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
					url: base_url + "/Mantenimiento/eliminarMantenimiento/" + id,
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

function sumar() {
	total = 0;
	$("#tbmantenimiento  tbody tr").each(function () {
		total = total + Number($(this).find("td:eq(8)").text());
	});
	$("input[name=total]").val(total.toFixed(2));
}

function agregarProducto() {
	fecha = $('#fecha').val();
	ID_taller = $('#ID_taller').val();
	taller = $('select[id="ID_taller"] option:selected').text();
	placa = $('select[id="ID_camion"] option:selected').text();
	ID_camion = $('#ID_camion').val();
	ID_categoria_mantenimiento = $('#ID_categoria_mantenimiento').val();
	mantenimiento = $('select[id="ID_categoria_mantenimiento"] option:selected').text();
	PorPagar = $('#PorPagar').val();
	Textopargar = $('select[id="PorPagar"] option:selected').text();
	if (ID_taller != '' && ID_categoria_mantenimiento != '') {
		html = "<tr>";
		html += "<td><input type='hidden' name= 'Fecha[]' value ='" + fecha + "'>" + fecha + "</td>";
		html += "<td><input type='hidden' name= 'ID_taller[]' value ='" + ID_taller + "'>" + taller + "</td>";
		html += "<td><input type='hidden' name = 'ID_categoria_mantenimiento[]' value ='" + ID_categoria_mantenimiento + "'>" + mantenimiento + "</td>";
		html += "<td><input type='hidden' name = 'ID_camion[]' value ='" + ID_camion + "'>" + placa + "</td>";
		html += "<td>";
		html += "<select name='Porpagar[]'>";
		html += "<option value='0' ";
		html += (PorPagar == 0) ? 'seleceted' : '';
		html += " >Contado</option>";
		html += "<option value='1' "
		html += (PorPagar != 0) ? 'selected' : '';
		html += ">Por pagar</option>";
		html += "</select>";
		html += "</td>";
		html += "<td><input type='text' maxlength='30' name = 'Descripcion[]' value =''></td>";
		html += "<td><input type = 'number' class='PrecioUnitario' min = '0'  name = 'PrecioUnitario[]' value = '0'></td>";
		html += "<td><input type = 'number' class='Cantidad' min = '0'  name = 'Cantidad[]' value = '1'></td>";
		html += "<td><input type ='hidden' name = 'ImporteTotal[]' value ='0'><p>0</p></td>";
		html += "<td><button type='button' class='btn btn-danger btn-remove-mantenimiento'><span class='fa fa-remove'></span></button></td>";
		html += "</tr>";
		$("#tbmantenimiento tbody").append(html);
		sumar();

	} else {
		alert("Taller o ferreteria y categoria de mantenimiento son obligatorios");
	}
}
