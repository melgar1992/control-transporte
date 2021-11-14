$(document).ready(function () {
    var e, f, a = new Date;

    b = a.getDate();
    c = a.getMonth();
    d = a.getFullYear();
    $("#calendario").fullCalendar({
        themeSystem: 'bootstrap',
        locale: 'es',
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
                            title: $(this).attr('NombreCliente') + ' ' + $(this).attr('ApellidosCliente') ,
                            start: $(this).attr('Fecha'),
                        });
                    });
                    callback(events);
                }
            });
        }
    });
});