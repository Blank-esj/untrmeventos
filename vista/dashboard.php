<?php
echo '<strong>GET:</strong> ';
echo var_dump($_GET);
echo '----- <strong>POST:</strong> ';
echo var_dump($_POST);
echo '----- <strong>SESSION:</strong> ';
echo var_dump($_SESSION);
echo '<br/>';

include_once 'controlador/Sesion.php';
include_once 'controlador/global/config.php';

$sesion = new Sesion();

// Si hay un usuario legeado evaluamos las peticiones
// Sino te redirige a la página del login
if ($sesion->existeUsuario()) {

    include_once 'vista/plantillas/cabecera-admin.php';

    if (isset($_POST['dashboard'])) { // Si hay alguna petición por POST
        switch ($_POST['dashboard']) {
            case 'login':
                echo 'vamos a admin-area';
                include_once 'vista/admin/home/admin-area.php';
                break;

            default:
                echo 'vamos a POST SWITCH DEFAULT login';
                include_once 'vista/admin/home/login.php';
                break;
        }
    } elseif (isset($_GET['dashboard'])) { // Si hay alguna petición por GET
        switch ($_GET['dashboard']) {
            case 'login':
                echo 'vamos a admin-area';
                include_once 'vista/admin/home/admin-area.php';
                break;

            case 'area-admin':
                echo 'vamos a admin-area';
                include_once 'vista/admin/home/admin-area.php';
                break;

            case 'dashboard':
                echo 'vamos a dashboard';
                include_once 'vista/admin/home/dashboard.php';
                break;

            case 'dashboard':
                echo 'vamos a dashboard';
                include_once 'vista/admin/home/dashboard.php';
                break;

            case 'lista-evento':
                echo 'vamos a lista-evento';
                include_once 'vista/admin/evento/lista-evento.php';
                break;

            case 'crear-evento':
                echo 'vamos a crear-evento';
                include_once 'vista/admin/evento/crear-evento.php';
                break;

            case 'lista-categoria':
                echo 'vamos a lista-categoria';
                include_once 'vista/admin/categoria/lista-categoria.php';
                break;

            case 'crear-categoria':
                echo 'vamos a crear-categoria';
                include_once 'vista/admin/categoria/crear-categoria.php';
                break;

            case 'lista-invitado':
                echo 'vamos a lista-invitado';
                include_once 'vista/admin/invitado/lista-invitado.php';
                break;

            case 'crear-invitado':
                echo 'vamos a crear-invitado';
                include_once 'vista/admin/invitado/crear-invitado.php';
                break;

            case 'lista-registrado':
                echo 'vamos a lista-registrado';
                include_once 'vista/admin/registrado/lista-registrado.php';
                break;

            case 'crear-registrado':
                echo 'vamos a crear-registrado';
                include_once 'vista/admin/registrado/crear-registrado.php';
                break;

            case 'lista-admin':
                echo 'vamos a lista-admin';
                include_once 'vista/admin/administrador/lista-admin.php';
                break;

            case 'crear-admin':
                echo 'vamos a crear-admin';
                include_once 'vista/admin/administrador/crear-admin.php';
                break;

            case 'generar-reportes':
                echo 'vamos a generar-reportes';
                include_once 'vista/admin/home/generar-reportes.php';
                break;

            default:
                echo 'vamos a GET SWITCH DEFAULT login';
                include_once 'vista/admin/home/login.php';
                break;
        }
    } else { // Si no hay peticiones ni GET ni POST que cumplan con que el índice se "dashboard"
        echo 'vamos a ELSE login';
        include_once 'vista/admin/home/admin-area.php';
    }
    include_once 'vista/plantillas/footer-admin.php';
} else {
    echo 'vamos login, no hay usuario logeado';
    include_once 'vista/admin/home/login.php';
}
