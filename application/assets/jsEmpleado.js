const formularioNuevoConductor = document.querySelector('#nuevo_empleado'),
      listadoEmpleados = document.querySelector('#tablaEmpleados tbody')
      formularioNuevoContrato = document.querySelector('#nuevo_contrato');

addEventListeners();

function addEventListeners(){
    if (formularioNuevoConductor){
        formularioNuevoConductor.addEventListener('submit', ingresarEmpleado);
    }

    if(listadoEmpleados){
        listadoEmpleados.addEventListener('click',identificarAccion);
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

function ingresarEmpleado(e){
    
    e.preventDefault();

    const ci = document.querySelector('#CI').value,
        nombres = document.querySelector('#nombres').value,
        apellidop = document.querySelector('#apellido-paterno').value,
        apellidom = document.querySelector('#apellido-materno').value,
        fechan = document.querySelector('#fecha-nacimiento').value,        
        direccion = document.querySelector('#direccion').value,
        departamento = document.querySelector('#departamento').value,
        telefono01 = document.querySelector('#telefono_01').value,
        telefono02 = document.querySelector('#telefono_02').value,
        calificacion = document.querySelector('#calificacion').value,
        descripcion = document.querySelector('#descripcion').value,
        tlicencia = document.querySelector('#tipo-licencia').value,
        fechavl = document.querySelector('#fecha-vencimiento-l').value,
        tipo = document.querySelector('#tipo').value;
    

    // Datos que se enviaran al servidor
    var datos = new FormData();
    datos.append('CI',ci);
    datos.append('nombres',nombres);
    datos.append('apellido-paterno',apellidop);
    datos.append('apellido-materno',apellidom);
    datos.append('fecha-nacimiento',fechan);    
    datos.append('direccion',direccion);
    datos.append('departamento',departamento);
    datos.append('telefono_01',telefono01);
    datos.append('telefono_02',telefono02);
    datos.append('calificacion',calificacion);
    datos.append('descripcion',descripcion);
    datos.append('tipo-licencia',tlicencia);
    datos.append('fecha-vencimiento-l',fechavl);
    
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
                const nuevoEmpleado = document.createElement('tr');

                nuevoEmpleado.innerHTML = `
                    <td>${respuesta.datos.id_empleado}</td>
                    <td>${respuesta.datos.ci}</td>
                    <td>${respuesta.datos.nombres}</td>
                    <td>${respuesta.datos.apellidop}</td>
                    <td>${respuesta.datos.apellidom}</td>
                    <td>${respuesta.datos.fechan}</td>
                    <td>${respuesta.datos.telefono01}</td>
                    <td>${respuesta.datos.departamento}</td>
                    <td>${respuesta.datos.tlicencia}</td>
                `;

                //crear conteneodr para los botonoes
                const contenedorAcciones = document.createElement('td');

                // Crea el icono de Editar
                const iconoEditar = document.createElement('i');
                iconoEditar.classList.add('fas', 'fa-pencil-alt');

                // Crea el enlace para editar
                const btnEditar = document.createElement('a');
                btnEditar.setAttribute("data-id",respuesta.datos.id_empleado); 
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
                btnEliminar.setAttribute("data-id",respuesta.datos.id_empleado);
                btnEliminar.setAttribute("value",respuesta.datos.hrefEliminar);
                btnEliminar.setAttribute("data-acction","borrar"); 
                btnEliminar.classList.add('btn', 'btn-danger', 'btn-xs');
                btnEliminar.textContent = " Delete ";
                btnEliminar.appendChild(iconoEliminar);

                // Agrego al pader
                contenedorAcciones.appendChild(btnEliminar);

                // Agrego al tr
                nuevoEmpleado.appendChild(contenedorAcciones);

                // agregarlos con los contactos existentes
                listadoEmpleados.appendChild(nuevoEmpleado);
                // Muestra mensaje que el empleado se adiciono exitosamente. 
                swal({
                    title: 'Nuevo Conductor',
                    text: 'El conductor fue ingresado correctamente',
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
                    swal({
                        title: 'Nuevo Conductor',
                        text: 'Error Cedula de identidad duplicada',
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
        listadoEmpleados.deleteRow(i);     
        
        
    }
    else if(e.target.getAttribute('data-acction')==='editar'){
        editarEmpleado(e.target.getAttribute('data-id'));

    }
}

function borrarEmpleado(id_empleado, dircontroller){
    console.log("se borro el empleado :"+id_empleado);
    console.log("Dirección del cotrolador :"+dircontroller);

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
function editarEmpleado(id_empleado){
    
    console.log("Editar Empleado: "+id_empleado);


}
$('#tablaEmpleados').DataTable();

$('#checkbox-chofer').change(function() {
    
    if($(this).is(":checked")) {
        $('.chofer').prop('disabled',false);
        $('.chofer').prop('required',true);
    }
    else{
        $('.chofer').prop('disabled',true);
        $('.chofer').prop('required',false);
    }
  });

