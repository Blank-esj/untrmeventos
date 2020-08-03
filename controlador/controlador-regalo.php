<?php

function crear($nombre, $stock)
{
    include 'modelo/modelo-regalo.php';
    include 'util/mensaje.php';

    $modelo = new RegaloModelo();

    try {
        $modelo->crear($nombre, $stock);
        mensaje("<strong>" . $nombre . "</strong> se guardó satisfactoriamente", "success");
        return true;
    } catch (PDOException $th) {
        mensaje("Lo siento hubo un error al crear el regalo", "error");
        return false;
    }
    return false;
}

function actualizar($id, $nombre, $stock)
{
    include 'modelo/modelo-regalo.php';
    include 'util/mensaje.php';

    $modelo = new RegaloModelo();

    try {
        if ($modelo->actualizar($id, $nombre, $stock) > 0)
            mensaje("<strong>" . $nombre . "</strong> actualizado satisfactoriamente", "success");
        else
            throw new PDOException("No actualizó");
    } catch (PDOException $e) {
        mensaje("Lo siento hubo un error al actualizar el regalo: " . $e->getMessage(), "error");
    }
}

function eliminar($id)
{
    include 'modelo/modelo-regalo.php';
    include 'util/mensaje.php';

    $modelo = new RegaloModelo();

    try {
        $modelo->eliminar($id);
        mensaje("Eliminado satisfactoriamente", "success");
    } catch (PDOException $th) {
        mensaje("Lo siento hubo un error al eliminar el regalo", "error");
    }
}
