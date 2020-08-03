<?php

function crear($grado)
{
    include 'modelo/modelo-grado_instruccion.php';
    include 'util/mensaje.php';

    $modelo = new GradoInstruccionModelo();

    try {
        if ($modelo->crear($grado)['filas'] > 0) {
            mensaje("<strong>" . $grado . "</strong> se guardó satisfactoriamente", "success");
            return true;
        } else {
            throw new Exception("No se pudo crear Grado Académico");
        }
    } catch (PDOException $th) {
        mensaje("Lo siento hubo un error al crear grado académico", "error");
        return false;
    }
    return false;
}

function actualizar($idgrado_instruccion, $grado)
{
    include 'modelo/modelo-grado_instruccion.php';
    include 'util/mensaje.php';

    $modelo = new GradoInstruccionModelo();

    try {
        if ($modelo->actualizar($idgrado_instruccion, $grado) > 0) {
            mensaje("<strong>" . $grado . "</strong> actualizado satisfactoriamente", "success");
            return true;
        } else
            throw new PDOException("No se actualizó");
    } catch (PDOException $e) {
        mensaje("Lo siento hubo un error al actualizar el grado académico: " . $e->getMessage(), "error");
        return false;
    }
    return false;
}

function eliminar($idgrado_instruccion)
{
    include 'modelo/modelo-grado_instruccion.php';
    include 'util/mensaje.php';

    $modelo = new GradoInstruccionModelo();

    try {
        if ($modelo->eliminar($idgrado_instruccion) > 0)
            mensaje("Grado Académico eliminado satisfactoriamente", "success");
        else
            throw new PDOException("No se eliminó");
    } catch (PDOException $th) {
        mensaje("Lo siento hubo un error al eliminar el grado académico", "error");
    }
}
