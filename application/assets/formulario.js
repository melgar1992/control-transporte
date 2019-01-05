const formularioNuevoConductor = document.querySelector('#nuevo_conductor');

addEventListeners();

function addEventListeners(){
    formularioNuevoConductor.addEventListener('submit', ingresarConductor);
}

function ingresarConductor(e){
    
    e.preventDefault();

    var nuevo_conductor = document.querySelector('#nuevo_conductor').value,
        ci = document.querySelector('#CI').value,
        nombres = document.querySelector('#nombres').value,
        apellidop = document.querySelector('#apellido-paterno').value,
        apellidom = document.querySelector('#apellido-materno').value,
        fechan = document.querySelector('#fecha-nacimiento').value,
        email = document.querySelector('#email').value,
        direccion = document.querySelector('#direccion').value,
        ciudad = document.querySelector('#ciudad').value,
        telefono01 = document.querySelector('#telefono_01').value,
        telefono02 = document.querySelector('#telefono_02').value,
        calificacion = document.querySelector('#calificacion').value,
        descripcion = document.querySelector('#descripcion').value,
        tlicencia = document.querySelector('#tipo-licencia').value,
        fechavl = document.querySelector('#fecha-vencimiento-l').value,
        tipo = document.querySelector('#tipo').value;

    console.log(tipo);

    

    // Datos que se enviaran al servidor
    var datos = new FormData();
    datos.append('CI',ci);
    datos.append('nombres',nombres);
    datos.append('apellido-paterno',apellidop);
    datos.append('apellido-materno',apellidom);
    datos.append('fecha-nacimiento',fechan);
    datos.append('email',email);
    datos.append('direccion',direccion);
    datos.append('ciudad',ciudad);
    datos.append('telefono_01',telefono01);
    datos.append('telefono_02',telefono02);
    datos.append('calificacion',calificacion);
    datos.append('descripcion',descripcion);
    datos.append('tipo-licencia',tlicencia);
    datos.append('fecha-vencimiento-l',fechavl);
    
    console.log(tipo);
    // Creanda un llamado Ajax
    var xhr = new XMLHttpRequest();
    
    // Abrir la conexión
    xhr.open('POST', tipo, true);

    // Retorno de datos
    xhr.onload = function(){
        if(this.status === 200){
            var respuesta = JSON.parse(xhr.responseText);

            console.log(respuesta);

            if(respuesta.respuesta === 'Exitoso'){

                // Inserta un nuevo elemento a la tabla
                const nuevoEmpleado = document.createElement('tr');

                nuevoEmpleado.innerHTML = `
                    <td>${respuesta.datos.ci}</td>
                    <td>${respuesta.datos.nombres}</td>
                    <td>${respuesta.datos.apellidop}</td>
                    <td>${respuesta.datos.apellidom}</td>
                    <td>${respuesta.datos.fechan}</td>
                    <td>${respuesta.datos.telefono01}</td>
                    <td>${respuesta.datos.ciudad}</td>
                    <td>${respuesta.datos.tlicencia}</td>
                `;

                swal({
                    title: 'Nuevo Conductor',
                    text: 'El conductor fue ingresado correctamente',
                    type: 'success'
                });
            } else if(respuesta.respuesta === 'Duplicada'){
                swal({
                    title: 'Nuevo Conductor',
                    text: 'La Cedula de identidad esta duplicada',
                    type: 'error'
                });
            }
        }
    }

    // Enviar la peticion
    xhr.send(datos);   

    
}
