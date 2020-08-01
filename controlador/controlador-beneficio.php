<?php

function crear($nombre)
{
    include 'modelo/modelo-beneficio.php';
    include 'util/mensaje.php';

    $modelo = new BeneficioModelo();

    try {
        if ($modelo->crear($nombre)['filas'] > 0) {
            mensaje("<strong>" . $nombre . "</strong> se guardó satisfactoriamente", "success");
            return true;
        } else {
            throw new Exception("No se pudo crear Beneicio");
        }
    } catch (PDOException $th) {
        mensaje("Lo siento hubo un error al crear beneficio", "error");
        return false;
    }
    return false;
}

function actualizar($idbeneficio, $nombre)
{
    include 'modelo/modelo-beneficio.php';
    include 'util/mensaje.php';

    $modelo = new BeneficioModelo();

    try {
        if ($modelo->actualizar($idbeneficio, $nombre) > 0) {
            mensaje("<strong>" . $nombre . "</strong> actualizado satisfactoriamente", "success");
            return true;
        } else
            throw new PDOException("No se actualizó");
    } catch (PDOException $e) {
        mensaje("Lo siento hubo un error al actualizar el beneficio: " . $e->getMessage(), "error");
        return false;
    }
    return false;
}

function eliminar($idbeneficio)
{
    include 'modelo/modelo-beneficio.php';
    include 'util/mensaje.php';

    $modelo = new BeneficioModelo();

    try {
        if ($modelo->eliminar($idbeneficio) > 0)
            mensaje("Beneficio eliminado satisfactoriamente", "success");
        else
            throw new PDOException("No se eliminó");
    } catch (PDOException $th) {
        mensaje("Lo siento hubo un error al eliminar el beneficio", "error");
    }
}
