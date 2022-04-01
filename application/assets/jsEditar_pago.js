$(document).ready(function () {

	$(document).on('click', '#btn-editar', function (e) {
		e.preventDefault();
		cuenta_editar = $("#cuenta_editar").val();
		switch (cuenta_editar) {
			case 'cliente':
				console.log('Entro Cliente');
				break;
			case 'proveedor':
				console.log('Entro proveedor');
				break;
			case 'taller':
				console.log('Entro taller');
				break;

			default:
				break;
		}
	});

});

function editar_cliente() {

}

function editar_proveedor() {

}

function editar_taller() {

}
