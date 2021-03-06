<?php

include_once 'controlador/util/Sesion.php';
include_once 'controlador/global/config.php';
include_once 'controlador/util/bd_conexion_pdo.php';
include_once 'controlador/controlador-login.php';

$sesion = new Sesion();
$connPDO = (new Conexion())->conectarPDO();

$mensaje = "";

// Si hay un usuario logueado evaluamos las peticiones
// Sino te redirige a la página del login

$verificador = false;

if (isset($_SESSION[SESION][N_USUARIO][N_USUARIO_USUARIO]) && isset($_SESSION[SESION][N_USUARIO][N_CONTRASENA_USUARIO])) {

    $verificador = verificarUsuarioPassword(
        $sesion->leerUsuarioUsuario(),
        $sesion->leerContrasenaUsuario()
    );
}

if ($verificador) {
    if (isset($_POST['dashboard'])) { // Si hay alguna petición por POST
        //$dato = openssl_decrypt($_POST['dashboard'], COD, KEY);
        $dato = $_POST['dashboard'];

        if ($dato != 'admin1-crear' || $dato != 'login') include_once 'vista/plantillas/cabecera-admin.php';

        switch ($dato) {
            case 'login':
                evaluarLogeo();
                break;

            case 'admin1-crear':
                include_once 'vista/admin/home/login.php';
                break;

                // CRUD Categoría Evento
            case 'categoria-evento-crear':
                include 'controlador/controlador-categoria-evento.php';
                crear($connPDO, $_POST['nombre_categoria'], $_POST['icono']);
                include 'vista/admin/categoria/lista-categoria.php';
                break;

            case 'categoria-evento-editar0':
                include 'vista/admin/categoria/editar-categoria.php';
                break;

            case 'categoria-evento-editar1':
                include 'controlador/controlador-categoria-evento.php';
                actualizar($connPDO, openssl_decrypt($_POST['id'], COD, KEY), $_POST['nombre_categoria'], $_POST['icono']);
                include 'vista/admin/categoria/lista-categoria.php';
                break;

            case 'categoria-evento-eliminar':
                include 'controlador/controlador-categoria-evento.php';
                eliminar($connPDO, openssl_decrypt($_POST['id'], COD, KEY));
                include 'vista/admin/categoria/lista-categoria.php';
                break;

                // CRUD Invitado
            case 'invitado-crear':
                include 'controlador/controlador-invitado.php';

                $nombres = $_POST['nombres'];
                $apellidopa = $_POST['apellidopa'];
                $apellidoma = $_POST['apellidoma'];
                $descripcion = $_POST['descripcion'];
                $procedencia = $_POST['procedencia'];
                $grado = $_POST['grado'];
                $email = $_POST['email'];
                $telefono = $_POST['telefono'];
                $doc_identidad = $_POST['doc_identidad'];
                $nacimiento = $_POST['nacimiento'];
                $sexo = $_POST['sexo'];

                crear(
                    $nombres,
                    $apellidopa,
                    $apellidoma,
                    $descripcion,
                    $_FILES,
                    $procedencia == "" ? null : $procedencia,
                    $grado == "" ? null : $grado,
                    $email == "" ? null : $email,
                    $telefono == "" ? null : $telefono,
                    $doc_identidad == "" ? null : $doc_identidad,
                    $nacimiento == "" ? null : $nacimiento,
                    $sexo == "" ? null : $sexo
                ) ?
                    include 'vista/admin/invitado/lista-invitado.php' : include 'vista/admin/invitado/crear-invitado.php';
                break;

            case 'invitado-editar0':
                include 'vista/admin/invitado/editar-invitado.php';
                break;

            case 'invitado-editar1':
                include 'controlador/controlador-invitado.php';

                $nombres = $_POST['nombres'];
                $apellidopa = $_POST['apellidopa'];
                $apellidoma = $_POST['apellidoma'];
                $descripcion = $_POST['descripcion'];
                $procedencia = $_POST['procedencia'];
                $grado = $_POST['grado'];
                $email = $_POST['email'];
                $telefono = $_POST['telefono'];
                $doc_identidad = $_POST['doc_identidad'];
                $nacimiento = $_POST['nacimiento'];
                $sexo = $_POST['sexo'];

                actualizar(
                    openssl_decrypt($_POST['id'], COD, KEY),
                    $nombres,
                    $apellidopa,
                    $apellidoma,
                    $descripcion,
                    $_FILES,
                    $procedencia == "" ? null : $procedencia,
                    $grado == "" ? null : $grado,
                    $email == "" ? null : $email,
                    $telefono == "" ? null : $telefono,
                    $doc_identidad == "" ? null : $doc_identidad,
                    $nacimiento == "" ? null : $nacimiento,
                    $sexo == "" ? null : $sexo
                );
                include 'vista/admin/invitado/lista-invitado.php';
                break;

            case 'invitado-eliminar':
                include 'controlador/controlador-invitado.php';
                eliminar(openssl_decrypt($_POST['id'], COD, KEY));
                include 'vista/admin/invitado/lista-invitado.php';
                break;

                // CRUD Grado de Instrucción
            case 'grado-crear':
                include 'controlador/controlador-grado_instruccion.php';

                crear($_POST['nombre']) ?
                    include 'vista/admin/invitado/grado-instruccion/lista-grado.php' :
                    include 'vista/admin/invitado/grado-instruccion/crear-grado.php';
                break;

            case 'grado-editar0':
                include 'vista/admin/invitado/grado-instruccion/editar-grado.php';
                break;

            case 'grado-editar1':
                include 'controlador/controlador-grado_instruccion.php';

                actualizar(
                    openssl_decrypt($_POST['id'], COD, KEY),
                    $_POST['nombre']
                );
                include 'vista/admin/invitado/grado-instruccion/lista-grado.php';
                break;

            case 'grado-eliminar':
                include 'controlador/controlador-grado_instruccion.php';
                eliminar(openssl_decrypt($_POST['id'], COD, KEY));
                include 'vista/admin/invitado/grado-instruccion/lista-grado.php';
                break;

                // CRUD Evento
            case 'evento-crear':
                include 'controlador/controlador-evento.php';

                crear(
                    $_POST['nombre_evento'],
                    $_POST['fecha_evento'],
                    $_POST['hora_evento'],
                    (int)$_POST['categoria_evento'],
                    (int)$_POST['invitado'],
                    $_POST['clave']
                ) ?
                    include 'vista/admin/evento/lista-evento.php' : include 'vista/admin/evento/crear-evento.php';
                break;

            case 'evento-editar0':
                include 'vista/admin/evento/editar-evento.php';
                break;

            case 'evento-editar1':
                include 'controlador/controlador-evento.php';

                actualizar(
                    openssl_decrypt($_POST['id'], COD, KEY),
                    $_POST['nombre_evento'],
                    $_POST['fecha_evento'],
                    $_POST['hora_evento'],
                    (int)$_POST['categoria_evento'],
                    (int)$_POST['invitado'],
                    $_POST['clave']
                );
                include 'vista/admin/evento/lista-evento.php';
                break;

            case 'evento-eliminar':
                include 'controlador/controlador-evento.php';
                eliminar(openssl_decrypt($_POST['id'], COD, KEY));
                include 'vista/admin/evento/lista-evento.php';
                break;

                // CRUD Beneficio
            case 'beneficio-crear':
                include 'controlador/controlador-beneficio.php';

                crear($_POST['nombre']) ?
                    include 'vista/admin/plan/beneficio/lista-beneficio.php' :
                    include 'vista/admin/plan/beneficio/crear-beneficio.php';
                break;

            case 'beneficio-editar0':
                include 'vista/admin/plan/beneficio/editar-beneficio.php';
                break;

            case 'beneficio-editar1':
                include 'controlador/controlador-beneficio.php';

                actualizar(
                    openssl_decrypt($_POST['id'], COD, KEY),
                    $_POST['nombre']
                );
                include 'vista/admin/plan/beneficio/lista-beneficio.php';
                break;

            case 'beneficio-eliminar':
                include 'controlador/controlador-beneficio.php';
                eliminar(openssl_decrypt($_POST['id'], COD, KEY));
                include 'vista/admin/plan/beneficio/lista-beneficio.php';
                break;

                // CRUD Plan
            case 'plan-crear':
                include 'controlador/controlador-plan.php';

                crear(
                    $_POST['nombre'],
                    $_POST['precio'],
                    $_POST['descripcion'],
                    isset($_POST['check-beneficio']) ? $_POST['check-beneficio'] : []
                ) ?
                    include 'vista/admin/plan/lista-plan.php' :
                    include 'vista/admin/plan/crear-plan.php';
                break;

            case 'plan-editar0':
                include 'vista/admin/plan/editar-plan.php';
                break;

            case 'plan-editar1':
                include 'controlador/controlador-plan.php';

                actualizar(
                    openssl_decrypt($_POST['id'], COD, KEY),
                    $_POST['nombre'],
                    $_POST['precio'],
                    $_POST['descripcion'],
                    isset($_POST['check-beneficio']) ? $_POST['check-beneficio'] : []
                );
                include 'vista/admin/plan/lista-plan.php';
                break;

            case 'plan-eliminar':
                include 'controlador/controlador-plan.php';
                eliminar(openssl_decrypt($_POST['id'], COD, KEY));
                include 'vista/admin/plan/lista-plan.php';
                break;

                // CRUD Articulo
            case 'articulo-crear':
                include 'controlador/controlador-articulo.php';

                crear($_POST['nombre'], $_POST['precio'], $_POST['stock'], $_POST['descripcion'], $_FILES) ?
                    include 'vista/admin/articulo/lista-articulo.php' :
                    include 'vista/admin/articulo/crear-articulo.php';
                break;

            case 'articulo-editar0':
                include 'vista/admin/articulo/editar-articulo.php';
                break;

            case 'articulo-editar1':
                include 'controlador/controlador-articulo.php';

                actualizar(
                    openssl_decrypt($_POST['id'], COD, KEY),
                    $_POST['nombre'],
                    $_POST['precio'],
                    $_POST['stock'],
                    $_POST['descripción'],
                    $_FILES
                );
                include 'vista/admin/articulo/lista-articulo.php';
                break;

            case 'articulo-eliminar':
                include 'controlador/controlador-articulo.php';
                eliminar(openssl_decrypt($_POST['id'], COD, KEY));
                include 'vista/admin/articulo/lista-articulo.php';
                break;

                // CRUD Administrador
            case 'administrador-crear':
                include 'controlador/controlador-admins.php';

                $nombres = $_POST['nombres'];
                $apellidopa = $_POST['apellidopa'];
                $apellidoma = $_POST['apellidoma'];
                $email = $_POST['email'];
                $telefono = $_POST['telefono'];
                $doc_identidad = $_POST['doc_identidad'];
                $usuario = $_POST['usuario'];
                $contrasena = $_POST['password'];
                $nivel = $_POST['nivel'];

                crearA(
                    $nombres,
                    $apellidopa,
                    $apellidoma,
                    $email == "" ? null : $email,
                    $telefono == "" ? null : $telefono,
                    $doc_identidad == "" ? null : $doc_identidad,
                    $usuario,
                    $contrasena,
                    $nivel
                ) ?
                    include 'vista/admin/administrador/lista-admin.php' :
                    include 'vista/admin/administrador/crear-admin.php';
                break;

            case 'administrador-editar0':
                include 'vista/admin/administrador/editar-admin.php';
                break;

            case 'administrador-editar1':
                include 'controlador/controlador-admins.php';

                $nombres = $_POST['nombres'];
                $apellidopa = $_POST['apellidopa'];
                $apellidoma = $_POST['apellidoma'];
                $email = $_POST['email'];
                $telefono = $_POST['telefono'];
                $doc_identidad = $_POST['doc_identidad'];
                $usuario = $_POST['usuario'];
                $contrasena = $_POST['password'];
                $nivel = $_POST['nivel'];

                actualizarA(
                    openssl_decrypt($_POST['id'], COD, KEY),
                    $nombres,
                    $apellidopa,
                    $apellidoma,
                    $email == "" ? null : $email,
                    $telefono == "" ? null : $telefono,
                    $doc_identidad == "" ? null : $doc_identidad,
                    $usuario,
                    $contrasena,
                    $nivel
                );
                include 'vista/admin/administrador/lista-admin.php';
                break;

            case 'administrador-eliminar':
                include 'controlador/controlador-admins.php';
                eliminarA(openssl_decrypt($_POST['id'], COD, KEY));
                include 'vista/admin/administrador/lista-admin.php';
                break;

                // CRUD Regalo
            case 'regalo-crear':
                include 'controlador/controlador-regalo.php';

                crear($_POST['nombre'], $_POST['stock']) ?
                    include 'vista/admin/boleto/regalo/lista-regalo.php' :
                    include 'vista/admin/boleto/regalo/crear-regalo.php';
                break;

            case 'regalo-editar0':
                include 'vista/admin/boleto/regalo/editar-regalo.php';
                break;

            case 'regalo-editar1':
                include 'controlador/controlador-regalo.php';

                actualizar(
                    openssl_decrypt($_POST['id'], COD, KEY),
                    $_POST['nombre'],
                    $_POST['stock']
                );
                include 'vista/admin/boleto/regalo/lista-regalo.php';
                break;

            case 'regalo-eliminar':
                include 'controlador/controlador-regalo.php';
                eliminar(openssl_decrypt($_POST['id'], COD, KEY));
                include 'vista/admin/boleto/regalo/lista-regalo.php';
                break;

                // CRUD Boletos
            case 'boleto-crear':
                include 'controlador/controlador-boleto.php';

                $boleto = new BoletoControlador();

                $boleto->crear(
                    $_POST['nombre'],
                    $_POST['apellidopa'],
                    $_POST['apellidoma'],
                    $_POST['email'] != '' ? $_POST['email'] : null,
                    $_POST['telefono'] != '' ? $_POST['telefono'] : null,
                    $_POST['doc_identidad'] != '' ? $_POST['doc_identidad'] : null,
                    $_POST['venta'] != '' ? (int)$_POST['venta'] : null,
                    (int)$_POST['plan'],
                    $_POST['regalo'] != '' ? (int)$_POST['regalo'] : null
                ) ? include 'vista/admin/boleto/lista-boleto.php' :
                    include 'vista/admin/boleto/crear-boleto.php';
                break;

            case 'boleto-editar0':
                include 'vista/admin/boleto/editar-boleto.php';
                break;

            case 'boleto-editar1':
                include 'controlador/controlador-boleto.php';

                $boleto = new BoletoControlador();

                $boleto->actualizar(
                    $_POST['idboleto'],
                    $_POST['nombre'],
                    $_POST['apellidopa'],
                    $_POST['apellidoma'],
                    $_POST['email'],
                    $_POST['telefono'],
                    $_POST['doc_identidad'],
                    $_POST['venta'],
                    $_POST['plan'],
                    $_POST['regalo']
                );
                include 'vista/admin/boleto/lista-boleto.php';
                break;

            case 'boleto-eliminar':
                include 'controlador/controlador-boleto.php';
                $boleto = new BoletoControlador();
                $boleto->eliminar($_POST['id']);
                include 'vista/admin/boleto/lista-boleto.php';
                break;

            default:
                include_once 'vista/admin/home/admin-area.php';
                break;
        }
    } elseif (isset($_GET['dashboard'])) { // Si hay alguna petición por GET
        include_once 'vista/plantillas/cabecera-admin.php';
        switch ($_GET['dashboard']) {
            case 'area-admin':
                include_once 'vista/admin/home/admin-area.php';
                break;
            case 'dashboard':
                include_once 'vista/admin/home/dashboard.php';
                break;

            case 'lista-venta':
                include_once 'vista/admin/venta/lista-venta.php';
                break;

            case 'generar-reportes':
                include_once 'vista/admin/home/generar-reportes.php';
                break;

            case 'lista-evento':
                include_once 'vista/admin/evento/lista-evento.php';
                break;

            case 'crear-evento':
                include_once 'vista/admin/evento/crear-evento.php';
                break;

            case 'lista-categoria':
                include_once 'vista/admin/categoria/lista-categoria.php';
                break;

            case 'crear-categoria':
                include_once 'vista/admin/categoria/crear-categoria.php';
                break;

            case 'lista-invitado':
                include_once 'vista/admin/invitado/lista-invitado.php';
                break;

            case 'crear-invitado':
                include_once 'vista/admin/invitado/crear-invitado.php';
                break;

            case 'lista-boleto':
                include_once 'vista/admin/boleto/lista-boleto.php';
                break;

            case 'crear-boleto':
                include_once 'vista/admin/boleto/crear-boleto.php';
                break;

            case 'lista-admin':
                include_once 'vista/admin/administrador/lista-admin.php';
                break;

            case 'crear-admin':
                include_once 'vista/admin/administrador/crear-admin.php';
                break;

            case 'lista-plan':
                include_once 'vista/admin/plan/lista-plan.php';
                break;

            case 'crear-plan':
                include_once 'vista/admin/plan/crear-plan.php';
                break;

            case 'lista-beneficio':
                include_once 'vista/admin/plan/beneficio/lista-beneficio.php';
                break;

            case 'crear-beneficio':
                include_once 'vista/admin/plan/beneficio/crear-beneficio.php';
                break;

            case 'lista-articulo':
                include_once 'vista/admin/articulo/lista-articulo.php';
                break;

            case 'crear-articulo':
                include_once 'vista/admin/articulo/crear-articulo.php';
                break;

            case 'lista-grado':
                include_once 'vista/admin/invitado/grado-instruccion/lista-grado.php';
                break;

            case 'crear-grado':
                include_once 'vista/admin/invitado/grado-instruccion/crear-grado.php';
                break;

            case 'lista-regalo':
                include_once 'vista/admin/boleto/regalo/lista-regalo.php';
                break;

            case 'crear-regalo':
                include_once 'vista/admin/boleto/regalo/crear-regalo.php';
                break;

            default:
                include_once 'vista/admin/home/admin-area.php';
                break;
        }
    } else { // Si no hay peticiones ni GET ni POST que cumplan con que el índice se "dashboard"
        include_once 'vista/plantillas/cabecera-admin.php';
        include_once 'vista/admin/home/admin-area.php';
    }
} else {

    if (isset($_POST['dashboard'])) {
        if ($_POST['dashboard'] == 'login') {
            evaluarLogeo();
        } elseif ($_POST['dashboard'] == 'admin1-crear') {

            crearA(
                $_POST['nombres'],
                $_POST['apellidopa'],
                $_POST['apellidoma'],
                $_POST['email'],
                $_POST['telefono'],
                $_POST['doc_identidad'],
                $_POST['usuario'],
                $_POST['contrasena'],
                1
            );
            evaluarLogeo();
        } else {
            include_once 'vista/admin/home/login.php';
        }
    } else {
        include_once 'vista/admin/home/login.php';
    }
}

$connPDO = null;

function evaluarLogeo()
{
    $verificado = verificarUsuarioPassword($_POST['usuario'], $_POST['contrasena']);
    $sesion = new Sesion(); // Se intancia otra vez la sesion para que pueda ver la cabecera
    if ($verificado) {
        include_once 'vista/plantillas/cabecera-admin.php';
        include_once 'vista/admin/home/admin-area.php';
    } else {
        include_once 'vista/admin/home/login.php';
    }
}
