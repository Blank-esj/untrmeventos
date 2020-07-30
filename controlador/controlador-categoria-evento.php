<?php

function crear(\PDO $conexion, $nombre, $icono)
{
    include 'modelo/modelo-categoria-evento.php';
    include 'util/mensaje.php';

    $modelo = new CategoriaEventoModelo();

    try {
        $modelo->crear($conexion, $nombre, $icono);
        mensaje($nombre . " se guardó satisfactoriamente", "success");
    } catch (PDOException $th) {
        mensaje("Lo siento hubo un error al crear la categoría", "error");
    }
}
