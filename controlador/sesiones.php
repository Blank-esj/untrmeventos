<?php
    function usuario_autenticado() {
        if(!revisar_usuario()) { //Si no se encuentra el usuario en SESSION.
            header('location:../untrmeventos/dashboard'); //Redirige al login
            exit();
        }
    }

    function revisar_usuario() {
        return isset($_SESSION['usuario']); //Revisa que exista el usuario en SESSION.
        //Si existe retorna TRUE sino FALSE.
    }
    usuario_autenticado();
