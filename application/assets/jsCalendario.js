$(document).ready(function () {
    calendario();
    $(document).on('click', '#btn-editar-transporte-cliente', function () {
        id = $(this).val();
        window.open(base_url + "/Transporte/editarTransporte/" + id);
    });
});

function calendario() {
    $("#calendario").fullCalendar({
        themeSystem: 'bootstrap',
        dayNames: ['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado'],
        dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sáb'],
        monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
        monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
        buttonText: {
            today: 'Hoy',
            month: 'Mes',
            week: 'Semana',
            day: 'Día',
            list: 'Lista'
        },
        header: {
            left: 'prev,next',
            center: 'title',
            right: 'month,agendaWeek,agendaDay,listMonth'
        },
        // dayClick: function (date, jsEvent, view) {
        //     alert("Valor Selecionado" + date.format());
        //     $('#modal').modal();
        // },
        eventClick: function (calEvent, jsEvent, view) {

            $("#titulo").html(calEvent.title);
            $("#descripcion").text(calEvent.descripcion);
            $("#origen").text(calEvent.origen);
            $("#destino").text(calEvent.destino);
            $("#total").text(calEvent.balance);
            $("#btn-editar-transporte-cliente").val(calEvent.id);
            $('#modal').modal();

        },
        selectable: !0,
        selectHelper: !0,
        editable: !0,
        events: function (start, end, timezone, callback) {
            $.ajax({
                url: base_url + "/Transporte/obtenerTransportes",
                dataType: 'json',
                success: function (doc) {
                    var events = [];
                    $(doc).each(function () {
                        events.push({
                            id: $(this).attr('ID_transporte'),
                            title: $(this).attr('NombreCliente') + ' ' + $(this).attr('ApellidosCliente'),
                            start: $(this).attr('Fecha'),
                            descripcion: $(this).attr('Descripcion'),
                            origen: $(this).attr('NombrePredioOringen'),
                            destino: $(this).attr('NombrePredioDestino'),
                            balance: Number($(this).attr('Total')).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,') + " Bs",

                        });
                    });
                    callback(events);
                }
            });
        }
    });
}
