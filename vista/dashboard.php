<?php
echo '<strong>GET:</strong> ';
echo var_dump($_GET);
echo '----- <strong>POST:</strong> ';
echo var_dump($_POST);
echo '<br/>';

if (isset($_POST['dashboard'])) {
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
} elseif (isset($_GET['dashboard'])) {
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

        default:
            echo 'vamos a GET SWITCH DEFAULT login';
            include_once 'vista/admin/home/login.php';
            break;
    }
} else {
    echo 'vamos a ELSE login';
    include_once 'vista/admin/home/login.php';
}
