$(document).ready(function () {

    /*Guardar registro (Extrae el formulario 
     de crear administrador y evita que se abra el action)*/
    $('#guardar-registro').on('submit', function (e) {
        e.preventDefault();

        console.log(e);

        var datos = $(this).serializeArray();

        $.ajax({
            type: $(this).attr('method'),
            data: datos,
            url: $(this).attr('action'),
            dataType: 'json',
            success: function (data) { //Cuando la llamada sea exitoso.
                console.log(data);
                var resultado = data;
                if (resultado.respuesta == 'exito') {
                    Swal.fire(
                        'Correcto!',
                        'Se guardó correctamente',
                        'success'
                    )
                    setTimeout(function() {
                        window.location.href = '../home/admin-area.php';
                        }, 2000);
                } else {
                    Swal.fire(
                        'Error!',
                        'Hubo un error',
                        'error'
                    )
                }
            }
        })
    });

    //Cogido que se ejecuta cuando hay un campo de archivo (imagen invitado)
    $('#guardar-registro-archivo').on('submit', function (e) {
        e.preventDefault();

        var datos = new FormData(this);

        $.ajax({
            type: $(this).attr('method'), //Type: POST o GET. Extrae el método del form.
            data: datos, //datos de los campos del form
            url: $(this).attr('action'), //Los datos se envian al valor de action. Al archivo PHP
            dataType: 'json', //Tipo de datos
            contentType: false,
            processData: false, //enviar imágenes procesadas
            async: true,
            cache: false, //para que no cacheé la URL al que se envia la img
            success: function (data) { //Cuando la llamada sea exitoso.
                console.log(data);
                var resultado = data;
                if (resultado.respuesta == 'exito') {
                    Swal.fire(
                        'Correcto!',
                        'Se guardó correctamente.',
                        'success'
                    )
                    setTimeout(function () {
                        window.location.href = '../home/admin-area.php';
                    }, 2000);
                    //$('#guardar-registro')[0].reset(); //limpia los campos del formulario.
                } else {
                    Swal.fire(
                        'Error!',
                        'Hubo un error',
                        'error'
                    )
                }
            }
        })
    });

    //Eliminar un registro
    $('.borrar_registro').on('click', function (e) {
        e.preventDefault();

        let id = $(this).attr('data-id');
        let tipo = $(this).attr('data-tipo');

        //Mandamos una alerta de confirmación  para ELIMINAR el registro.
        Swal.fire({
            title: 'Estás  seguro?',
            text: "Un registro eliminado no se puede recuperar",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, Eliminar!',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: 'post',
                    data: { //Hacemo un objeto de todos los datos que deseamos enviar.
                        'id': id,
                        'registro': 'eliminar'
                    },
                    url: 'modelo-' + tipo + '.php',
                    success: function (data) {
                        var resultado = JSON.parse(data); //Convierte el String enviado por el modelo a JSON.
                        console.log(data);
                        console.log(resultado);
                        if (resultado.respuesta == 'exito') {
                            Swal.fire(
                                'Eliminado!',
                                'Se eliminó el registro de la dase de datos.',
                                'success'
                            )
                            jQuery('[data-id="' + resultado.id_eliminado + '"]').parents('tr').remove();
                        }
                    }
                })
            } else {
                Swal.fire(
                    'Cancelado',
                    'No se eliminó el registro',
                    'error'
                )
            }
        })
    });
});