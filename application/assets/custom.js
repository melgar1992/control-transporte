

function frmAccion(frm,callback){
	$(frm).submit(function(){
		var f = $(this)
		var data = f.serialize()
		$.ajax({
			type: "POST",
			dataType: "json",
			url: f.attr('action'),
			data: data,
			success: function(data) {
				callback(data)
			}
		});
		return false;
	});
	
}

function frmAccion2(frm,before,callback) {
	
	$(frm).submit(function(){
		before()
		var f = $(this)
		var data = f.serialize()
		$.ajax( {
			type: "POST",
			dataType: "json",
			url: f.attr('action'),
			data: data,
			//beforeSend: before,
			success: function(data) {
				callback(data)
			}
		});
		return false;
	}); 
	
}  
function ajaxAccion(accion,callback){
	$.ajax({
		type: "POST",
		dataType: "json",
		url: url2 + accion,
		success: function(res) {
			callback(res)
		}
	});
	return false;
}

function ajaxAccionParam(accion,param,callback){
	$.ajax({
		type: "POST",
		dataType: "json",
		data:param,
		url: url2 + accion,
		success: function(res) {
			callback(res)
		}
	});
	return false;
}

function msgError(msg){
	$('#dlg-msg .modal-content').removeClass('modal-rojo').removeClass('modal-verde').addClass('modal-rojo')
	$('#dlg-msg-body').html(msg)
	$('#dlg-msg').modal('show')
}

function msgInfo(msg){
	$('#dlg-msg .modal-content').removeClass('modal-rojo').removeClass('modal-verde').addClass('modal-verde')
	$('#dlg-msg-body').html(msg)
	$('#dlg-msg').modal('show')
}

function msgYesNo(m,si,no){
	$('#dlg-sino-msg').html(m)
	$('#dlg-sino').modal('show')
	$('#confirmar-si').unbind('click').click(si)
	$('#confirmar-no').unbind('click').click(no)
	
}

function dlgFrm(accion,ancho){
	$('#dlg-frm .modal-dialog').css('width',(ancho || 600)+'px')
	$('#dlg-frm-body').html('<i id="cargando" class="fa fa-refresh fa-spin"></i> Cargando...')
	$('#dlg-frm-body').load(url2+accion) //
	
	$('#dlg-frm').modal('show')
}

function dlgErr(msg){
	$('#dlg-error').remove()
	var div='<div id="dlg-error" class="alert alert-danger alert-dismissible fade in " role="alert" style="margin-bottom:5px;padding:1px 25px;">'
	div += '<button type="button" class="close" data-dismiss="alert"><span>×</span> </button>'
	div += '<span id="error"> </span>'
    div += '</div>'
	$(div).insertAfter($('#dlg-tit'))
	
	$('#error').html(msg);
}

function setDataTable(t){
	$(t).dataTable( {
		"sPaginationType": "full_numbers",
		"oLanguage":{
			"sProcessing":     "Procesando...",
			"sLengthMenu":     "Mostrar _MENU_ registros",
			"sZeroRecords":    "No se encontraron resultados",
			"sEmptyTable":     "Ningún dato disponible en esta tabla",
			"sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
			"sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
			"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
			"sInfoPostFix":    "",
			"sSearch":         "Buscar:",
			"sUrl":            "",
			"sInfoThousands":  ",",
			"sLoadingRecords": "Cargando...",
			"oPaginate": {
				"sFirst":    "Primero",
				"sLast":     "Último",
				"sNext":     "Siguiente",
				"sPrevious": "Anterior"
			},
			"oAria": {
				"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
				"sSortDescending": ": Activar para ordenar la columna de manera descendente"
			}
		}
	});
}

RECALCULAR=false;

function setDataTable2(t){
	var tbl=$(t).dataTable({
		bPaginate:false,
		sDom: 't',
		oLanguage:{
			"sProcessing":     "Procesando...",
			"sLengthMenu":     "Mostrar _MENU_ registros",
			"sZeroRecords":    "No se encontraron resultados",
			"sEmptyTable":     "Ningún dato disponible en esta tabla",
			"sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
			"sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
			"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
			"sInfoPostFix":    "",
			"sSearch":         "Buscar:",
			"sUrl":            "",
			"sInfoThousands":  ",",
			"sLoadingRecords": "Cargando...",
			"oPaginate": {"sFirst": "Primero","sLast": "Último","sNext": "Siguiente","sPrevious": "Anterior"},
			"oAria": {"sSortAscending":  ": Activar para ordenar la columna de manera ascendente","sSortDescending": ": Activar para ordenar la columna de manera descendente"}
		},
		bSort:true,
		fixedHeader: true
	})
	
	/*$('#txfiltro').keyup( function () {
		tbl.fnFilter( this.value );
	} );
	tbl.fnFilter($('#txfiltro').val());
	*/
}



function seleccionar(obj){
	if (window.getSelection) { 
		var sel = window.getSelection();
		var range = document.createRange();
		range.selectNodeContents(obj);
		sel.removeAllRanges();
		sel.addRange(range);
	} 
	else if (document.selection) { 
		document.selection.empty();
		var range = document.body.createTextRange();
		range.moveToElementText(obj);
		range.select();
	}
}

function cls(sel,clase_agregar,clase_quitar){
	$(sel).removeClass(clase_quitar)
	if(!$(sel).hasClass(clase_agregar))$(sel).addClass(clase_agregar)
}


var hexDigits = new Array
        ("0","1","2","3","4","5","6","7","8","9","a","b","c","d","e","f"); 

//Function to convert rgb color to hex format
function rgb2hex(rgb) {
 rgb = rgb.match(/^rgb\((\d+),\s*(\d+),\s*(\d+)\)$/);
 return "#" + hex(rgb[1]) + hex(rgb[2]) + hex(rgb[3]);
}

function hex(x) {
  return isNaN(x) ? "00" : hexDigits[(x - x % 16) / 16] + hexDigits[x % 16];
 }


//###########################################################################################
//###########################################################################################
//###########################################################################################

/*
'use strict';

// Load the fonts

Highcharts.createElement('link', {
   href: 'https://fonts.googleapis.com/css?family=Unica+One',
   rel: 'stylesheet',
   type: 'text/css'
}, null, document.getElementsByTagName('head')[0]);
*/

/*
if(typeof Highcharts !== "undefined"   ){
	
Highcharts.theme = {
    colors: ['#abb0ef', '#a0ee9e', '#f47b7b', '#7798BF', '#aaeeee', '#ff0066', '#eeaaee',
      '#55BF3B', '#DF5353', '#7798BF', '#aaeeee'],
    chart: {
      backgroundColor: {
         linearGradient: { x1: 0, y1: 0, x2: 1, y2: 1 },
         stops: [
            [0, '#2A3F54'],
            [1, '#3A4F74']
         ]
      },
      style: {
         fontFamily: '\'Unica One\', sans-serif'
      },
      plotBorderColor: '#606063'
    },
    title: {
      style: {
         color: '#E0E0E3',
         textTransform: 'uppercase',
         fontSize: '20px'
      }
    },
    subtitle: {
      style: {
         color: '#E0E0E3',
         textTransform: 'uppercase'
      }
    },
    xAxis: {
      gridLineColor: '#707073',
      labels: {
         style: {
            color: '#E0E0E3'
         }
      },
      lineColor: '#707073',
      minorGridLineColor: '#505053',
      tickColor: '#707073',
      title: {
         style: {
            color: '#A0A0A3'

         }
      }
   },
   yAxis: {
      gridLineColor: '#707073',
      labels: {
         style: {
            color: '#E0E0E3'
         }
      },
      lineColor: '#707073',
      minorGridLineColor: '#505053',
      tickColor: '#707073',
      tickWidth: 1,
      title: {
         style: {
            color: '#A0A0A3'
         }
      }
   },
   tooltip: {
      backgroundColor: 'rgba(0, 0, 0, 0.85)',
      style: {
         color: '#F0F0F0'
      }
   },
   plotOptions: {
      series: {
         dataLabels: {
            color: '#B0B0B3'
         },
         marker: {
            lineColor: '#333'
         }
      },
      boxplot: {
         fillColor: '#505053'
      },
      candlestick: {
         lineColor: 'white'
      },
      errorbar: {
         color: 'white'
      }
   },
   legend: {
      itemStyle: {
         color: '#E0E0E3'
      },
      itemHoverStyle: {
         color: '#FFF'
      },
      itemHiddenStyle: {
         color: '#606063'
      }
   },
   credits: {
      style: {
         color: '#666'
      }
   },
   labels: {
      style: {
         color: '#707073'
      }
   },

   drilldown: {
      activeAxisLabelStyle: {
         color: '#F0F0F3'
      },
      activeDataLabelStyle: {
         color: '#F0F0F3'
      }
   },

   navigation: {
      buttonOptions: {
         symbolStroke: '#DDDDDD',
         theme: {
            fill: '#505053'
         }
      }
   },

   // scroll charts
   rangeSelector: {
      buttonTheme: {
         fill: '#505053',
         stroke: '#000000',
         style: {
            color: '#CCC'
         },
         states: {
            hover: {
               fill: '#707073',
               stroke: '#000000',
               style: {
                  color: 'white'
               }
            },
            select: {
               fill: '#000003',
               stroke: '#000000',
               style: {
                  color: 'white'
               }
            }
         }
      },
      inputBoxBorderColor: '#505053',
      inputStyle: {
         backgroundColor: '#333',
         color: 'silver'
      },
      labelStyle: {
         color: 'silver'
      }
   },

   navigator: {
      handles: {
         backgroundColor: '#666',
         borderColor: '#AAA'
      },
      outlineColor: '#CCC',
      maskFill: 'rgba(255,255,255,0.1)',
      series: {
         color: '#7798BF',
         lineColor: '#A6C7ED'
      },
      xAxis: {
         gridLineColor: '#505053'
      }
   },

   scrollbar: {
      barBackgroundColor: '#808083',
      barBorderColor: '#808083',
      buttonArrowColor: '#CCC',
      buttonBackgroundColor: '#606063',
      buttonBorderColor: '#606063',
      rifleColor: '#FFF',
      trackBackgroundColor: '#404043',
      trackBorderColor: '#404043'
   },

   // special colors for some of the
   legendBackgroundColor: 'rgba(0, 0, 0, 0.5)',
   background2: '#505053',
   dataLabelsColor: '#B0B0B3',
   textColor: '#C0C0C0',
   contrastTextColor: '#F0F0F3',
   maskColor: 'rgba(255,255,255,0.3)'
};

// Apply the theme
//Highcharts.setOptions(Highcharts.theme);

	
}*/

//moment.locale("es")