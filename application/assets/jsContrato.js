const formularioNuevoTipoContrato = document.querySelector('#nuevo_tipo_contrato'),
      formularioEditarTipoContrato = document.querySelector('#editar_tipo_contrato'),
      listadoTipoContrato = document.querySelector('#tablaTipoContrato tbody'),
      formularioNuevoContrato = document.querySelector('#nuevo_contrato');

addEventListeners();
var tabla = $('#tablaTipoContrato').DataTable();
function addEventListeners(){
    if (formularioNuevoTipoContrato){
        formularioNuevoTipoContrato.addEventListener('submit', ingresarTipoContrato);
    }

    if (formularioEditarTipoContrato){
        formularioEditarTipoContrato.addEventListener('submit', editarTipoContrato);
    }


    if(listadoTipoContrato){
        listadoTipoContrato.addEventListener('click',identificarAccion);
    }
        
    if(formularioNuevoContrato){
        formularioNuevoContrato.addEventListener('submit',ingresarContrato);
    }
    
    
}

function ingresarContrato(e){
    e.preventDefault();
    var nuevoContrato = document.querySelector('#tipoContrato').value;

    console.log(nuevoContrato);
}

function ingresarTipoContrato(e){
    
    e.preventDefault();

    const tipoContrato = document.querySelector('#tipoContrato').value,
        tipo = document.querySelector('#tipo').value;
    

    // Datos que se enviaran al servidor
    var datos = new FormData();
    datos.append('tipoContrato',tipoContrato);

    
    console.log(datos);
    // Creanda un llamado Ajax
    var xhr = new XMLHttpRequest();
    
    // Abrir la conexión
    xhr.open('POST', tipo, true);

    // Retorno de datos
    xhr.onload = function(){
        if(this.status === 200){

            // leemos la respuesta php
            var respuesta = JSON.parse(xhr.responseText);

            console.log(respuesta);

            if(respuesta.respuesta === 'Exitoso'){

                // Inserta un nuevo elemento a la tabla
                const nuevoTipoContrato = document.createElement('tr');

                nuevoTipoContrato.innerHTML = `
                    <td>${respuesta.datos.id_tipocontrato}</td>
                    <td>${respuesta.datos.tipocontrato}</td>                    
                `;

                //crear conteneodr para los botonoes
                const contenedorAcciones = document.createElement('td');

                // Crea el icono de Editar
                const iconoEditar = document.createElement('i');
                iconoEditar.classList.add('fas', 'fa-pencil-alt');

                // Crea el enlace para editar
                const btnEditar = document.createElement('a');
                btnEditar.setAttribute("data-id",respuesta.datos.id_tipocontrato); 
                btnEditar.setAttribute("href", respuesta.datos.hrefEditar); 
                btnEditar.setAttribute("data-acction","editar");       
                btnEditar.classList.add('btn', 'btn-info', 'btn-xs');                
                btnEditar.textContent = " Edit ";                
                btnEditar.appendChild(iconoEditar);

                // Agregarlo al padre
                contenedorAcciones.appendChild(btnEditar);

                // Crea el icono eliminar
                const iconoEliminar = document.createElement('i');
                iconoEliminar.classList.add('far', 'fa-trash-alt');

                // Crea el enlace para eliminar
                const btnEliminar = document.createElement('a');
                btnEliminar.setAttribute("data-id",respuesta.datos.id_tipocontrato);
                btnEliminar.setAttribute("value",respuesta.datos.hrefEliminar);
                btnEliminar.setAttribute("data-acction","borrar"); 
                btnEliminar.classList.add('btn', 'btn-danger', 'btn-xs');
                btnEliminar.textContent = " Delete ";
                btnEliminar.appendChild(iconoEliminar);

                // Agrego al pader
                contenedorAcciones.appendChild(btnEliminar);

                // Agrego al tr
                nuevoTipoContrato.appendChild(contenedorAcciones);

                // agregarlos con los contactos existentes
                //listadoTipoContrato.appendChild(nuevoTipoContrato);
                tabla.row.add(nuevoTipoContrato).draw(true);
                // Muestra mensaje que el empleado se adiciono exitosamente. 
                swal({
                    title: 'Nuevo Tipo Contrato',
                    text: 'El tipo de contrato fue ingresado correctamente',
                    type: 'success'
                });
            } else {
                if (respuesta.tipo === 'Formulario'){
                    error_formulario = document.querySelector('.error_formulario');                    
                    error_formulario.innerHTML = respuesta.respuesta;
                    swal({
                        title: 'Nuevo Tipo Contrato',
                        text: 'Error en el formulario',
                        type: 'error'
                    });
                }else{
                    swal({
                        title: 'Nuevo Tipo Contrato',
                        text: 'Error no clasificado',
                        type: 'error'
                    });

                }
                     
                
            }
        }
    }

    // Enviar la peticion
    xhr.send(datos);       
}

function identificarAccion(e){
    
    if (e.target.getAttribute('data-acction')==='borrar'){

        borrarEmpleado(e.target.getAttribute('data-id'), e.target.getAttribute('value') );
        
        console.log(e.target.parentNode.parentNode.rowIndex);
        var i = e.target.parentNode.parentNode.rowIndex;
        i = i -1;
        listadoTipoContrato.deleteRow(i);     
        
        
    }
    else if(e.target.getAttribute('data-acction')==='editar'){
        //editarEmpleado(e.target.getAttribute('data-id'));

    }
}

function borrarTipoContrato(id_empleado, dircontroller){
//Falta desarrolloar el borrado, esta con el codigo de empleado.
    // Datos que se enviaran al servidor
    var datos = new FormData();
    datos.append('ID_empleado',id_empleado);

    // Creanda un llamado Ajax
    var xhr = new XMLHttpRequest();
    
    // Abrir la conexión
    xhr.open('POST', dircontroller, true);

    // Retorno de datos
    xhr.onload = function(){
        if(this.status === 200){

            // leemos la respuesta php
            var respuesta = JSON.parse(xhr.responseText);
            console.log(respuesta);

                if (respuesta.tipo === 'Exitoso'){

                    swal({
                        title: 'Eliminar',
                        text: 'Se elimino al empleado satisfactoriamente',
                        type: 'success'
                    });

                }else {
                    error_formulario = document.querySelector('.error_formulario');                    
                    error_formulario.innerHTML = respuesta.respuesta;
                    swal({
                        title: 'Eliminar',
                        text: 'Error al enviar la información',
                        type: 'error'
                    });
                }
            

        }
    }

    // Enviar la peticion
    xhr.send(datos);

}
function editarTipoContrato(e){

    e.preventDefault();
    
    Boton = document.querySelector('#tipo');

    const   id_tipocontrato = Boton.getAttribute('id_data'),
            Descripcion = document.querySelector('#tipoContrato').value,
            tipo = document.querySelector('#tipo').value;
            accion = 'Editar';

    console.log(id_tipocontrato);
    console.log(Descripcion);
    console.log(tipo);

    var datos = new FormData();
    datos.append('id_tipoContrato',id_tipocontrato);
    datos.append('Descripcion', Descripcion);
    datos.append('accion', accion);
    
    // Creamos un llamado Ajax
    var xhr = new XMLHttpRequest();

    // Abrir la conexión
    xhr.open('POST', tipo, true);

    //Retorno de datos
    xhr.onload = function(){
        if(this.status ===200){
            //leemos la respuesta phph
            var respuesta = JSON.parse(xhr.responseText);
            if (respuesta.respuesta === 'Exitoso'){
                swal({
                    title: 'Editar tipo Contrato',
                    text: 'El tipo de contrato fue editado correctamente',
                    type: 'success'
                });
            }else{
                swal({
                    title: 'Editar tipo Contrato',
                    text: respuesta.mensage,
                    type: 'error'
                });
            }
            


            console.log(respuesta);
        }
    }

    // Envia la peticion
    xhr.send(datos);
}

