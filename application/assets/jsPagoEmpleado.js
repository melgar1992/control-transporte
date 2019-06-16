const formularioNuevoPago = document.querySelector('#nuevo_pago');






addEventListener();

function addEventListener(){

    if (formularioNuevoPago) {
        formularioNuevoPago.addEventListener('submit',ingresarNuevoPagoEmpleado);
    }

}

function ingresarNuevoPagoEmpleado(e) {
    e.preventDefault();

    const ci = document.querySelector('#CI').value;
          fecha_Pago = document.querySelector('#fecha_pago').value;
          mes_correspondiente = document.querySelector('#mes_correspondiente').value;
          descripcion = document.querySelector('#Descripcion').value;
          pago = document.querySelector('#pago').value;
          tipo = document.querySelector('#tipo').value;
    var datos   = new FormData();

    // datos que se enviaran al servidor
    datos.append('CI',ci);
    datos.append('fecha_pago',fecha_Pago);
    datos.append('mes_correspondiente', mes_correspondiente);
    datos.append('descripcion',descripcion);
    datos.append('pago',pago);
    
  
    console.log(...datos);
    // creando una llamada ajax
    var xhr = new XMLHttpRequest();
    //Abrir la conexion
    xhr.open('POST',tipo,true);
    //Retorno de datos
    xhr.onload = function() {
        if (this.status === 200) {
            console.log(JSON.parse(xhr.responseText));

            swal({
                title: 'Nuevo contrato',
                text: 'El contrato fue ingresado correctamente',
                type: 'success'
            });
            
        }
        
    }
    // se lee la respuesta
    // se envian los datos
    xhr.send(datos);
}