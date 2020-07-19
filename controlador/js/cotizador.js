(function () {
    "use strict";

    document.addEventListener('DOMContentLoaded', function () {

        if (document.getElementById('mapa')) {
            //Map
            var map = L.map('mapa').setView([-5.643183, -78.522766], 16);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

            L.marker([-5.643183, -78.522766]).addTo(map)
                .bindPopup('UNTRM - FISME - Bagua <br> Boletos disponibles')
                .openPopup()
                /*.bindTooltip('Un Tooltip')
                .openTooltip()*/;
        }

        if (document.getElementById('calcular')) {

            let idplan;
            let idArticulos = {};

            var regalo = document.getElementById('regalo');

            var errorDiv = document.getElementById('error');

            var lista_productos = document.getElementById('fila-resumen-articulo');

            //Campos datos usuario
            var nombre = document.getElementById('nombre');
            var apellidopa = document.getElementById('apellidopa');
            var apellidoma = document.getElementById('apellidoma');
            var email = document.getElementById('email');
            var telefono = document.getElementById('telefono');
            var doc_identidad = document.getElementById('doc_identidad');
            var descripcion = document.getElementById('descripcion');

            // Cuando se pierde el foco (evento "blur") de los siguientes elementos
            // y no están validados mostrará una advertencia
            nombre.addEventListener('blur', validarCampos);
            apellidopa.addEventListener('blur', validarCampos);
            apellidoma.addEventListener('blur', validarCampos);
            email.addEventListener('blur', validarCampos);
            telefono.addEventListener('blur', validarCampos);
            doc_identidad.addEventListener('blur', validarCampos);
            email.addEventListener('blur', validarEmail);
            descripcion.addEventListener('blur', validarCampos);

            // Se validarán los campos
            function validarCampos() {
                if (this.value == '') {
                    errorDiv.style.display = 'block';
                    errorDiv.innerHTML = "Este campo es obligatorio"
                    this.style.border = '1px solid red';
                    errorDiv.style.border = '1px solid red';
                } else {
                    errorDiv.style.display = 'none';
                    this.style.border = '1px solid #cccccc';
                }
            }

            function validarEmail() {
                if (this.value.indexOf("@") > -1) {
                    errorDiv.style.display = 'none';
                    this.style.border = '1px solid #cccccc';
                } else {
                    errorDiv.style.display = 'block';
                    errorDiv.innerHTML = "Debe tener al menos un @"
                    this.style.border = '1px solid red';
                    errorDiv.style.border = '1px solid red';
                }
            }

            // Hover con la sombra para los planes
            $(".tabla-precio").hover(function () {
                $(this).addClass("shadow-lg");
            }, function () {
                $(this).removeClass("shadow-lg");
            });

            // Si se selecciona un plan se obtiene el id de la etiqueta y cambia su color
            $(".tabla-precio").click(function () {
                $(".tabla-precio").css("background-color", "#fff"); // pone a todos de color blanco
                $(this).css("background-color", "#dededf");
                idplan = $(this).get(0).id;
            });

            $("#calcular").click(() => {
                if (validarTodosCampos() == '') {
                    calcularTotal();
                } else {
                    alert('Completa ' + validarTodosCampos());
                }
            });

            $('#btnRegistro').click(() => {
                if (validarTodosCampos() == '') {
                    calcularTotal();
                    let resServidor; // varialbe a que almacena la respuesta del servidor
                    $.post(
                        "//localhost:8080/untrmeventos/modelo/modelo-registrado.php",
                        {
                            registro: 'nuevo',
                            nombres: nombre.value,
                            apellidopa: apellidopa.value,
                            apellidoma: apellidoma.value,
                            email: email.value,
                            telefono: telefono.value,
                            doc_identidad: doc_identidad.value,
                            idplan: idplan,
                            idregalo: regalo.value,
                            descripcion: descripcion.value,
                            articulos: idArticulos
                        },
                        (data, status) => {
                            try {
                                resServidor = JSON.parse(data);
                            } catch (e) {
                                resServidor = data;
                            }
                            if (resServidor.respuesta == 'exito') {
                                Swal.fire(resServidor.respuesta, resServidor.mensaje, 'success');
                            } else {
                                Swal.fire(resServidor.respuesta, resServidor, 'error');
                            }
                            console.log(resServidor);
                            console.log(status);
                        }
                    );
                } else {
                    Swal.fire('Aviso', validarTodosCampos(), 'warning');
                }
            });

            /*$.ajax({
                type: "POST",
                url: url,
                data: data,
                success: success,
                dataType: dataType
            });*/

            /**
             * Calcula el total a pagar sin que se pidan los datos al servidor.
             * - Añade las filas a la tabla de resumen
             */
            function calcularTotal() {
                let listadoProductos = [];
                let listaArticulos = {}; // ID articulo y cantidad
                try {
                    let total = 0;
                    for (let i = 0; i < $('.nombre-articulo').get().length; i++) {
                        let fila = '';
                        if (i == 0) {
                            fila += '<tr> <td> 1 </td>' +
                                '<td>' + $('.nombre-plan-' + idplan).get(i).innerHTML + '</td>' +
                                '<td>' + $('.precio-plan-' + idplan).get(i).innerHTML + '</td> </tr>';
                            total += $('.precio-plan-' + idplan).get(i).innerHTML * 1;
                        }
                        if ($('.cantidad-articulo').get(i).value > 0) {
                            fila += '<tr> <td>' + $('.cantidad-articulo').get(i).value + '</td>' +
                                '<td>' + $('.nombre-articulo').get(i).innerHTML + '</td>' +
                                '<td>' + ' S/ ' + ($('.cantidad-articulo').get(i).value * $('.precio-articulo').get(i).innerHTML) + '</td> </tr>';

                            total += $('.cantidad-articulo').get(i).value * $('.precio-articulo').get(i).innerHTML;

                            // obtiene los IDs y cantidades de los articulos que tengan alguna cantidad
                            listaArticulos[$('.cantidad-articulo').get(i).id] = $('.cantidad-articulo').get(i).value;
                        }
                        if (i == $('.nombre-articulo').get().length - 1) {
                            fila += '<td style="text-align: center;" colspan="2"> <strong>Total</strong> </td>';
                            fila += '<td> S/ ' + total + '</td>';
                        }
                        listadoProductos.push(fila);
                    }

                    lista_productos.innerHTML = '';
                    listadoProductos.forEach(element => {
                        lista_productos.innerHTML += element;
                    });
                    idArticulos = listaArticulos; // Le pasamos a la variable lo que tenga listaArticulos
                } catch (e) {
                    alert(e);
                }
            }

            /**
             * Retorna el nombre del campo no válido.
             * Si todos son válidos retorna un String vacío ''
             */
            function validarTodosCampos() {
                if (idplan == null) return 'Selecciona un Plan';
                if (nombre.value == null || nombre.value == '') return 'Completa el campo Nombre';
                if (apellidopa.value == null || apellidopa.value == '') return 'Completa el campo Apellido Paterno';
                if (apellidoma.value == null || apellidoma.value == '') return 'Completa el campo Apellido Materno';
                if (email.value == null || email.value == '') return 'Completa el campo Email';
                if (telefono.value == null || telefono.value == '') return 'Completa el campo Telefono';
                if (doc_identidad.value == null || doc_identidad.value == '') return 'Completa el campo Documento de Identidad';
                if (descripcion.value == null || descripcion.value == '') return 'Completa el campo Documento de Identidad';
                return '';
            }
        }
    }); //DOM CONTENT LOADED
})();