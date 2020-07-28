$(document).ready(function () {

    //Extrae el formulario de login de administrador y evita que se abra el action
    $('#login-admin').on('submit', function (e) {
        e.preventDefault();

        var datos = $(this).serializeArray();

        $.ajax({
            type: $(this).attr('method'),
            data: datos,
            url: $(this).attr('action'),
            dataType: 'json',
            success: function (data) {
                console.log('data');
                var resultado = data;
                if (resultado.respuesta == 'exitoso') {
                    Swal.fire(
                        'Login Correcto',
                        'Bienveid@ ' + resultado.usuario + ' !! ',
                        'success'
                    )
                    setTimeout(function () {
                        window.location.href = 'dashboard';
                    }, 2000);
                    Swal.fire(
                        'Error!',
                        'Usuario o Password Incorrecto',
                        'error'
                    )
                }
            }
        });
    });
});