const formularioNuevoPago = document.querySelector('#nuevo_pago');
      formularioEditarPagoEmpleado = document.querySelector('#EditarPago');
      ListadoPagos = document.querySelector('#tablaPagos tbody');






addEventListener();

function addEventListener(){

    if (formularioNuevoPago) {
        formularioNuevoPago.addEventListener('submit',ingresarNuevoPagoEmpleado);
    }
    if (formularioEditarPagoEmpleado) {
        formularioEditarPagoEmpleado.addEventListener('submit',EditarPagoEmpleado);
    }
    if (ListadoPagos) {
        ListadoPagos.addEventListener('click',identificarAccion);
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
            var respuesta = JSON.parse(xhr.responseText);
            
            console.log(respuesta.datos);

            if (respuesta.respuesta === 'Exitoso') {

                //Insertar un nuevo elemento en la tabla

                const nuevoPago_Empleado = document.createElement('tr');

                nuevoPago_Empleado.innerHTML = `
                <td>${respuesta.datos.id_pago}</td>
                <td>${respuesta.datos.nombres}</td>
                <td>${respuesta.datos.Apellido_p}</td>
                <td>${respuesta.datos.fecha_pago}</td>
                <td>${respuesta.datos.mes_correspondiente}</td>
                <td>${respuesta.datos.descripcion}</td>
                <td>${respuesta.datos.pago}</td>
                `;  
                //Crear el contenedor para los botones
                const contenedorAcciones = document.createElement('td');
                             
                //crear el icono de editar
                const iconoEditar = document.createElement('i');
                iconoEditar.classList.add('fas','fa-pencil-alt');
                //crea el enlace para editar

                const btnEditar = document.createElement('a');
                    btnEditar.setAttribute("data-id",respuesta.datos.id_pago); 
                    btnEditar.setAttribute("value", ''); 
                    btnEditar.setAttribute("data-acction","editar");       
                    btnEditar.classList.add('btn', 'btn-info', 'btn-xs');                
                    btnEditar.textContent = " Editar ";                
                    btnEditar.appendChild(iconoEditar);
                
                // agregando el editar al padre
                contenedorAcciones.appendChild(btnEditar);

                 //Crear el boton eliminar
                 const iconoEliminar = document.createElement('i');
                 iconoEliminar.classList.add('far', 'fa-trash-alt');

                 // Crea el enlace para eliminar
                 const btnEliminar = document.createElement('a');
                 btnEliminar.setAttribute("data-id",respuesta.datos.id_contrato);
                 btnEliminar.setAttribute("value",'');
                 btnEliminar.setAttribute("data-acction","borrar"); 
                 btnEliminar.classList.add('btn', 'btn-danger', 'btn-xs');
                 btnEliminar.textContent = " Borrar ";
                 btnEliminar.appendChild(iconoEliminar);

                 //Agregarlo al padre

                 contenedorAcciones.appendChild(btnEliminar);

                 //Agregando al tr

                 nuevoPago_Empleado.appendChild(contenedorAcciones);

                 //Agregando con los contratos existentes

                 ListadoPagos.appendChild(nuevoPago_Empleado);
                


                swal({
                    title: 'Nuevo contrato',
                    text: 'El contrato fue ingresado correctamente',
                    type: 'success'
                });
                
            } else {

                if (respuesta.tipo === 'Formulario'){
                    error_formulario = document.querySelector('.error_formulario');                    
                    error_formulario.innerHTML = respuesta.respuesta;


                    swal({
                        title: 'Nuevo Conductor',
                        text: 'Error en el formulario',
                        type: 'error'
                    });
                }else{
                    if (respuesta.tipo === 'No Existe') {

                        swal({
                            title: 'Error',
                            text: respuesta.respuesta,
                            type: 'error'
                        });
                    }

                }
                
            }
            
            
        }
        
    }
    // se lee la respuesta
    // se envian los datos
    xhr.send(datos);
}

function identificarAccion(e){
    
    if (e.target.getAttribute('data-acction')==='borrar'){

            
        console.log('borrar');
        
    }
    else if(e.target.getAttribute('data-acction')==='editar'){
        //editarEmpleado(e.target.getAttribute('data-id'));

    }
}

function EditarPagoEmpleado(e) {
    e.preventDefault();

    Boton = document.querySelector('#tipo');
    const id_pago = Boton.getAttribute('id_data');
          fecha_Pago = document.querySelector('#fecha_pago').value;
          mes_correspondiente = document.querySelector('#mes_correspondiente').value;
          descripcion = document.querySelector('#Descripcion').value;
          pago = document.querySelector('#pago').value;
          tipo = document.querySelector('#tipo').value;
          accion = 'Editar';
    var datos   = new FormData();

    // datos que se enviaran al servidor
    datos.append('ID_pago',id_pago);
    datos.append('fecha_pago',fecha_Pago);
    datos.append('mes_correspondiente', mes_correspondiente);
    datos.append('descripcion',descripcion);
    datos.append('pago',pago);
    datos.append('accion',accion);

    console.log(...datos);
    // creando una llamada ajax
    var xhr = new XMLHttpRequest();
    //Abrir la conexion
    xhr.open('POST',tipo,true);
    //Retorno de datos
    xhr.onload = function(){
        if (this.status === 200) {

            var respuesta = JSON.parse(xhr.responseText);
            
            console.log(respuesta.datos);

            if (respuesta.respuesta === 'Exitoso') {
                swal({
                    title: 'Editar Pago',
                    text: 'El pago fue editado correctamente',
                    type: 'success'
                });
            
            
            }


        }
    }
    xhr.send(datos);

    
}