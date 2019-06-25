const formularioNuevoContrato = document.querySelector('#nuevo_contrato');
        formularioEditarContrato = document.querySelector('#botones');
        listadoContratos = document.querySelector('#tablaContratos tbody');
        seleccionarEmpleado = document.querySelector('#tablaEmpleados');



addEventListeners();

function addEventListeners() {


    formularioNuevoContrato.addEventListener('submit', ingresarContratoEmpleado);

    if (formularioEditarContrato) {
        formularioEditarContrato.addEventListener('click', EditarContrato);
    }


    if (seleccionarEmpleado) {
        seleccionarEmpleado.addEventListener('click', seleccionaEmpleado);
    }
    if (listadoContratos) {
        listadoContratos.addEventListener('click', identificarAccion);
    }

}


function ingresarContratoEmpleado(e) {

    e.preventDefault();


    const ci = document.querySelector('#CI').value;
    nombres = document.querySelector('#nombres').value;
    tipocontrato = document.querySelector('#tipoContrato').value,
        sueldo = document.querySelector('#sueldo').value;
    fechain = document.querySelector('#fecha-ingreso').value;
    fechafin = document.querySelector('#fecha-salida').value;
    tipo = document.querySelector('#tipo').value;

    var datos = new FormData();

    // datos que se enviaran al servidor

    datos.append('CI', ci);
    datos.append('nombres', nombres);
    datos.append('tipocontrato', tipocontrato);
    datos.append('sueldo', sueldo);
    datos.append('FechaIngreso', fechain);
    datos.append('FechaSalida', fechafin);



    console.log(...datos);

    // Creando una llamada Ajax

    var xhr = new XMLHttpRequest();
    // Abrir la conexion
    xhr.open('POST', tipo, true);

    // Retorno de datos

    xhr.onload = function () {
        if (this.status === 200) {

            // leemos las respuesta php

            var respuesta = JSON.parse(xhr.responseText);

            console.log(respuesta);
            console.log(respuesta.datos);

            if (respuesta.respuesta === 'Exitoso') {

                //Insertar un nuevo elemento en la tabla
                const nuevoContrato_Empleado = document.createElement('tr');

                nuevoContrato_Empleado.innerHTML = `
                    <td>${respuesta.datos.CI}</td>
                    <td>${respuesta.datos.nombres}</td>
                    <td>${respuesta.datos.Apellido_p}</td>
                    <td>${respuesta.datos.Apellido_m}</td>
                    <td>${respuesta.datos.descripcion}</td>
                    <td>${respuesta.datos.sueldo}</td>
                    <td>${respuesta.datos.fechain}</td>
                    <td>${respuesta.datos.fechafin}</td>
                    `;
                // crear el contenedor para los botones
                const contenedorAcciones = document.createElement('td');

                // crea el icono de editar

                const iconoEditar = document.createElement('i');
                iconoEditar.classList.add('fas', 'fa-pencil-alt');

                //crea el enlace para editar

                const btnEditar = document.createElement('a');
                btnEditar.setAttribute("data-id", respuesta.datos.id_contrato);
                btnEditar.setAttribute("value", respuesta.datos.hrefEditar);
                btnEditar.setAttribute("data-acction", "editar");
                btnEditar.classList.add('btn', 'btn-info', 'btn-xs');
                btnEditar.textContent = " Editar ";
                btnEditar.appendChild(iconoEditar);

                // Agregando editar al padre
                contenedorAcciones.appendChild(btnEditar);

                //Crear el boton eliminar
                const iconoEliminar = document.createElement('i');
                iconoEliminar.classList.add('far', 'fa-trash-alt');

                // Crea el enlace para eliminar
                const btnEliminar = document.createElement('a');
                btnEliminar.setAttribute("data-id", respuesta.datos.id_contrato);
                btnEliminar.setAttribute("value", respuesta.datos.hreBorrar);
                btnEliminar.setAttribute("data-acction", "borrar");
                btnEliminar.classList.add('btn', 'btn-danger', 'btn-xs');
                btnEliminar.textContent = " Borrar ";
                btnEliminar.appendChild(iconoEliminar);

                //Agregarlo al padre

                contenedorAcciones.appendChild(btnEliminar);

                //Agregando al tr

                nuevoContrato_Empleado.appendChild(contenedorAcciones);

                //Agregando con los contratos existentes

                listadoContratos.appendChild(nuevoContrato_Empleado);

                swal({
                    title: 'Nuevo contrato',
                    text: 'El contrato fue ingresado correctamente',
                    type: 'success'
                });


            } else {
                if (respuesta.tipo === 'No Existe') {

                    swal({
                        title: 'Error',
                        text: 'El Empleado no existe, por favor ingrese un empleado valido',
                        type: 'error'
                    });

                } else {
                    if (respuesta.tipo === 'Empelado activo') {

                        swal({
                            title: 'Empelado activo',
                            text: 'El Empleado tiene un contrato activo',
                            type: 'error'
                        });

                    }

                }

            }
        } else {
            swal({
                title: 'Error de conecion',
                text: 'Error en la coneccion',
                type: 'error'
            });
        }

    }
    xhr.send(datos);


}

function EditarContrato(e) {
    if (e.target.getAttribute('data-acction') === 'editar') {

        console.log('Diste Click en editar');

        const ci = document.querySelector('#CI').value;
        tipocontrato = document.querySelector('#tipoContrato').value,
            sueldo = document.querySelector('#sueldo').value;
        fechain = document.querySelector('#fecha-ingreso').value;
        fechafin = document.querySelector('#fecha-salida').value;
        direccion = document.querySelector('#editar').value;

        if (ci === '' || tipocontrato === '' || sueldo === '' || fechain === '') {
            swal({
                title: 'Error',
                text: 'Todos los campos son Obligatorios',
                type: 'error'
            });
        } else {

            var datos2 = new FormData();

            // datos que se enviaran al servidor

            datos2.append('CI', ci);
            datos2.append('tipocontrato', tipocontrato);
            datos2.append('sueldo', sueldo);
            datos2.append('FechaIngreso', fechain);
            datos2.append('FechaSalida', fechafin);


            // creando llamada AJAX
            var xhr = new XMLHttpRequest();
            // Abrir la conexion
            xhr.open('POST', direccion, true);
            // Retorno de datos
            xhr.onload = function () {

                if (this.status === 200) {

                    var respuesta = JSON.parse(xhr.responseText);

                    if (respuesta.respuesta === 'Exitoso') {


                        swal({
                            title: 'Contrato Editado',
                            text: 'El contrato fue editado correctamente',
                            type: 'success'
                        });


                    } else {
                        if (respuesta.tipo === 'Formulario') {
                            error_formulario = document.querySelector('.error_formulario');
                            error_formulario.innerHTML = respuesta.respuesta;
                            swal({
                                title: 'Nuevo Conductor',
                                text: 'Error en el formulario',
                                type: 'error'
                            });
                        } else {
                            if (respuesta.tipo === 'Contrato no encontrado') {

                                swal({
                                    title: 'Error',
                                    text: 'El Contrato a editar no fue encontrado',
                                    type: 'error'
                                });
                            }

                        }


                    }



                }

            }
            // Envio de datos
            xhr.send(datos2);

        }
    }
}

function borrarContrato(id_contrato, dircontroller) {
    console.log('Se borro el contrato' + id_contrato);
    console.log('Direccion del controlador' + dircontroller);

    //datos que se enviaran al servidor
    var datos = new FormData();
    datos.append('ID_contrato', id_contrato);
    //Creando una llamada AJAX
    var xhr = new XMLHttpRequest();
    // Abrir la conexion
    xhr.open('POST', dircontroller, true);
    // Retorno de datos
    xhr.onload = function () {
        if (this.status === 200) {

            //leemos la respuesta php
            var respuesta = JSON.parse(xhr.responseText);
            console.log(respuesta);
            if (respuesta.tipo === 'Exitoso') {

                swal({
                    title: 'Eliminar',
                    text: 'Se elimino al empleado satisfactoriamente',
                    type: 'success'
                });

            } else {

                swal({
                    title: 'Eliminar',
                    text: 'Error al borrar el contrato',
                    type: 'error'
                });
            }

        }

    }
    //Envio de datos
    xhr.send(datos);
}



function seleccionaEmpleado(e) {


    if (e.target.getAttribute('data-acction') === 'seleccionar') {

        //console.log('click');
        //console.log(e.target.getAttribute('data-id'));
        //console.log(e.target.getAttribute('value'));


        //datos que se enviaran al servidor
        var id_empleado = new FormData();

        id_empleado.append('id_empleado', e.target.getAttribute('data-id'));

        //console.log(...id_empleado);


        //creando una llamada a ajax
        var xhr = new XMLHttpRequest();

        //abrir la coneccion
        //poner la direccion con tiene que ser dinamico
        xhr.open('POST', e.target.getAttribute('value'), true);

        //retorno de datos

        xhr.onload = function () {
            if (this.status === 200) {

                const respuesta = JSON.parse(xhr.responseText);

                console.log(respuesta);


                if (respuesta.respuesta === 'encontrato') {
                    $("#CI").val(respuesta.datos.ci);
                    $('#nombres').val(respuesta.datos.nombres);



                } else {
                    swal({
                        title: 'Error',
                        text: 'Error en la coneccion',
                        type: 'error'
                    });

                }

            }
        }
        //envio de datos
        xhr.send(id_empleado);

    }
}

function llenarCamposEmpleado() {


}

function identificarAccion(e) {
    if (e.target.getAttribute('data-acction') === 'editar') {

        //console.log('diste click');
        //datos que se enviaran al servidor
        var id_contrato = new FormData();

        id_contrato.append('ID_contrato', e.target.getAttribute('data-id'));
        //console.log(...id_contrato);

        //creando una llamada ajax
        var xhr = new XMLHttpRequest();
        //abrir la coneccion
        xhr.open('POST', e.target.getAttribute('value'), true);

        //retorno de datos
        xhr.onload = function () {

            if (this.status === 200) {

                const respuesta = JSON.parse(xhr.responseText);

                console.log(respuesta);
                if (respuesta.respuesta === 'Exitoso') {

                    $("#CI").val(respuesta.datos.CI);
                    $('#nombres').val(respuesta.datos.Nombres);
                    $('#tipoContrato').val(respuesta.datos.Descripcion);
                    $('#sueldo').val(respuesta.datos.sueldo);
                    $('#fecha-ingreso').val(respuesta.datos.fechain);
                    $('#fecha-salida').val(respuesta.datos.fechafin);



                } else {
                    swal({
                        title: 'Error',
                        text: 'Error al buscar el contrato',
                        type: 'error'
                    });

                }

            }

        }
        //envio de datos
        xhr.send(id_contrato);
    } else {
        if (e.target.getAttribute('data-acction') === 'borrar') {

            borrarContrato(e.target.getAttribute('data-id'), e.target.getAttribute('value'));

            console.log(e.target.parentNode.parentNode.rowIndex);
            var i = e.target.parentNode.parentNode.rowIndex;
            i = i - 1;
            listadoContratos.deleteRow(i);

        }

    }

}

$('#tablaContratos').DataTable();
