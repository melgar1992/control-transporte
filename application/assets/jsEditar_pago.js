$(document).ready(function () {

	$(document).on('click', '#btn-editar', function (e) {
		e.preventDefault();
		cuenta_editar = $("#cuenta_editar").val();
		switch (cuenta_editar) {
			case 'cliente':
				editar_cliente();
				break;
			case 'proveedor':
				editar_proveedor();
				break;
			case 'taller':
				editar_taller();
				break;

			default:
				break;
		}
	});
	$("#btn-cerrar").click(function (e) { 
		e.preventDefault();
		window.close();
	});

});

function editar_cliente() {

	ID_pago_cuentas = $.trim($('#ID_pago_cuentas').val());
	ID_Cliente = $.trim($('#ID_Cliente').val());
	Fecha = $.trim($('#Fecha').val());
	Descripcion = $.trim($('#Descripcion').val());
	Debe = $.trim($('#Debe').val());
	Haber = $.trim($('#Haber').val());

	$.ajax({
		type: "POST",
		url: base_url + "/Pago_cuentas/editarPagoCliente",
		data: {
			ID_pago_cuentas: ID_pago_cuentas,
			ID_Cliente: ID_Cliente,
			Fecha: Fecha,
			Descripcion: Descripcion,
			Debe: Debe,
			Haber: Haber,
		},
		dataType: "json",
		success: function (respuesta) {
			if (respuesta['respuesta'] === 'Exitoso') {
				Swal.fire({
					title: 'Se guardo!',
					text: "Se guardo todo correctamente!",
					type: 'success',
					showCancelButton: false,
					confirmButtonColor: '#3085d6',
					cancelButtonColor: '#d33',
					confirmButtonText: 'Ok'
				}).then((result) => {
					if (result.value) {
						window.close();
					}
				});

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

function editar_proveedor() {
	ID_pago_cuentas = $.trim($('#ID_pago_cuentas').val());
	ID_proveedor = $.trim($('#ID_proveedor').val());
	Fecha = $.trim($('#Fecha').val());
	Descripcion = $.trim($('#Descripcion').val());
	Debe = $.trim($('#Debe').val());
	Haber = $.trim($('#Haber').val());
	$.ajax({
		type: "POST",
		url: base_url + "/Pago_cuentas/editarPagoProveedor",
		data: {
			ID_pago_cuentas: ID_pago_cuentas,
			ID_proveedor: ID_proveedor,
			Fecha: Fecha,
			Descripcion: Descripcion,
			Debe: Debe,
			Haber: Haber,
		},
		dataType: "json",
		success: function (respuesta) {
			if (respuesta['respuesta'] === 'Exitoso') {
				Swal.fire({
					title: 'Se guardo!',
					text: "Se guardo todo correctamente!",
					type: 'success',
					showCancelButton: false,
					confirmButtonColor: '#3085d6',
					cancelButtonColor: '#d33',
					confirmButtonText: 'Ok'
				}).then((result) => {
					if (result.value) {
						window.close();
					}
				});
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

function editar_taller() {

	ID_pago_cuentas = $.trim($('#ID_pago_cuentas').val());
	ID_taller = $.trim($('#ID_taller').val());
	Fecha = $.trim($('#Fecha').val());
	Descripcion = $.trim($('#Descripcion').val());
	Debe = $.trim($('#Debe').val());
	Haber = $.trim($('#Haber').val());

	$.ajax({
		type: "POST",
		url: base_url + "/Pago_cuentas/editarPagoTaller",
		data: {
			ID_pago_cuentas: ID_pago_cuentas,
			ID_taller: ID_taller,
			Fecha: Fecha,
			Descripcion: Descripcion,
			Debe: Debe,
			Haber: Haber,
		},
		dataType: "json",
		success: function (respuesta) {
			if (respuesta['respuesta'] === 'Exitoso') {
				Swal.fire({
					title: 'Se guardo!',
					text: "Se guardo todo correctamente!",
					type: 'success',
					showCancelButton: false,
					confirmButtonColor: '#3085d6',
					cancelButtonColor: '#d33',
					confirmButtonText: 'Ok'
				}).then((result) => {
					if (result.value) {
						window.close();
					}
				});
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
