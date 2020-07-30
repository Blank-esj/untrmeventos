<?php

function crear(\PDO $conexion, $nombre, $icono)
{
    include 'modelo/modelo-categoria-evento.php';
    include 'util/mensaje.php';

    $modelo = new CategoriaEventoModelo();

    try {
        $modelo->crear($conexion, $nombre, $icono);
        mensaje("<strong>" . $nombre . "</strong> se guardó satisfactoriamente", "success");
    } catch (PDOException $th) {
        mensaje("Lo siento hubo un error al crear la categoría", "error");
    }
}

function actualizar(\PDO $conexion, $id, $nombre, $icono)
{
    include 'modelo/modelo-categoria-evento.php';
    include 'util/mensaje.php';

    $modelo = new CategoriaEventoModelo();

    try {
        if ($modelo->actualizar($conexion, $id, $nombre, $icono) > 0)
            mensaje("<strong>" . $nombre . "</strong> actualizado satisfactoriamente", "success");
        else
            throw new PDOException("No actualizó");
    } catch (PDOException $e) {
        mensaje("Lo siento hubo un error al actualizar la categoría: " . $e->getMessage(), "error");
    }
}

function eliminar(\PDO $conexion, $id)
{
    include 'modelo/modelo-categoria-evento.php';
    include 'util/mensaje.php';

    $modelo = new CategoriaEventoModelo();

    try {
        $modelo->eliminar($conexion, $id);
        mensaje("Eliminado satisfactoriamente", "success");
    } catch (PDOException $th) {
        mensaje("Lo siento hubo un error al eliminar la categoría", "error");
    }
}
