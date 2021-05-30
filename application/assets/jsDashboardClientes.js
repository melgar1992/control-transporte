$(document).ready(function () {
    $(document).on('submit', '#reporteCliente', function (e) {
        e.preventDefault();
        ID_Cliente = $.trim($('#ID_Cliente').val());
        fechaIni = $.trim($('#fechaIni').val());
        fechaFin = $.trim($('#fechaFin').val());
        if (fechaIni < fechaFin) {
            $.ajax({
                type: "POST",
                url: base_url + "/DashboardClientes/reporteCliente",
                data: {
                    ID_Cliente: ID_Cliente,
                    fechaIni: fechaIni,
                    fechaFin: fechaFin,
                },
                dataType: "json",
                success: function (respuesta) {
                    console.log(respuesta);
                }
            });
        } else {
            swal({
                title: 'Error de fecha',
                text: 'La fecha inicial no puede ser mayor que la final',
                type: 'error'
            });
        }

    });
});