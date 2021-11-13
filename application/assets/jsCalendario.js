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
        dayClick: function (date, jsEvent, view) {
            alert("Valor Selecionado" + date.format());
            $('#modal').modal();
        },
        selectable: !0,
        selectHelper: !0,
        editable: !0,
        events: [{
            title: "All Day Event",
            start: new Date(d, c, 1)
        }, {
            title: "Long Event",
            start: new Date(d, c, b - 5),
            end: new Date(d, c, b - 2)
        }, {
            title: "Meeting",
            start: new Date(d, c, b, 10, 30),
            allDay: !1
        }, {
            title: "Lunch",
            start: new Date(d, c, b + 14, 12, 0),
            end: new Date(d, c, b, 14, 0),
            allDay: !1
        }, {
            title: "Birthday Party",
            start: new Date(d, c, b + 1, 19, 0),
            end: new Date(d, c, b + 1, 22, 30),
            allDay: !1
        }, {
            title: "Click for Google",
            start: new Date(d, c, 28),
            end: new Date(d, c, 29),
            url: "http://google.com/"
        }]
    });
});