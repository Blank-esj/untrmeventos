<?php

include_once 'controlador/util/Sesion.php';
include_once 'controlador/login-admin.php';
include_once 'controlador/global/config.php';
include_once 'controlador/util/bd_conexion_pdo.php';

$sesion = new Sesion();
$connPDO = (new Conexion())->conectarPDO();

$mensaje = "";

// Si hay un usuario legeado evaluamos las peticiones
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

                // CRUD Evento
            case 'evento-crear':
                include 'controlador/controlador-evento.php';

                echo var_dump($_POST['nombre_evento']) . "<br/>";
                echo var_dump($_POST['fecha_evento']) . "<br/>";
                echo var_dump($_POST['hora_evento']) . "<br/>";
                echo var_dump((int)$_POST['categoria_evento']) . "<br/>";
                echo var_dump((int)$_POST['invitado']) . "<br/>";
                echo var_dump($_POST['clave']) . "<br/>";

                crear(
                    $_POST['nombre_evento'],
                    $_POST['fecha_evento'],
                    $_POST['hora_evento'],
                    (int)$_POST['categoria_evento'],
                    (int)$_POST['invitado'],
                    $_POST['clave'],
                ) ?
                    include 'vista/admin/evento/lista-evento.php' : include 'vista/admin/evento/crear-evento.php';
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

            case 'lista-registrado':
                include_once 'vista/admin/registrado/lista-registrado.php';
                break;

            case 'crear-registrado':
                include_once 'vista/admin/registrado/crear-registrado.php';
                break;

            case 'lista-admin':
                include_once 'vista/admin/administrador/lista-admin.php';
                break;

            case 'crear-admin':
                include_once 'vista/admin/administrador/crear-admin.php';
                break;

            case 'generar-reportes':
                include_once 'vista/admin/home/generar-reportes.php';
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
                include_once 'vista/admin/invitado/grado-instruccion/admin-instruccion/lista-grado.php';
                break;

            case 'crear-grado':
                include_once 'vista/admin/invitado/grado-instruccion/crear-grado.php';
                break;

            case 'lista-regalo':
                include_once 'vista/admin/registrado/regalo/lista-regalo.php';
                break;

            case 'crear-regalo':
                include_once 'vista/admin/registrado/regalo/crear-regalo.php';
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
    $verificado = verificarUsuarioPassword($_POST['usuario'], $_POST['password']);
    $sesion = new Sesion(); // Se intancia otra vez la sesion para que pueda verlo cabecera
    if ($verificado) {
        include_once 'vista/plantillas/cabecera-admin.php';
        include_once 'vista/admin/home/admin-area.php';
    } else {
        include_once 'vista/admin/home/login.php';
    }
}
