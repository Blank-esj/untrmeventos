<?php

/**
 * Devuelve true si se crea corectamente sino devuelve false
 */
function crear($nombre_evento, $fecha_evento, $hora_evento, $id_cat_evento, $id_inv, $clave)
{
    include 'util/mensaje.php';
    include 'modelo/modelo-evento.php';

    try {

        $fecha = date('Y-m-d', strtotime($fecha_evento));
        $hora = date('H:i:s', strtotime($hora_evento));

        if (!is_string($fecha) && !is_string($hora))
            throw new Exception("Hay un error con las fechas");

        $modelo = new EventoModelo();

        if ($modelo->crear($nombre_evento, $fecha, $hora, $id_cat_evento, $id_inv, $clave)['filas'] > 0) {
            mensaje("Evento <strong>" . $nombre_evento . "</strong> agregado correctamente", "success");
            return true;
        } else throw new Exception("No se creó el evento");
    } catch (Exception $e) {
        mensaje("Lo siento hubo un error al crear el evento: " . $e->getMessage(), "error");
        return false;
    }
    return false;
}

function actualizar($id_evento, $nombre_evento, $fecha_evento, $hora_evento, $id_cat_evento, $id_inv, $clave)
{
    include 'util/mensaje.php';
    include 'modelo/modelo-evento.php';

    try {
        $modelo = new EventoModelo();

        if ($modelo->actualizar($id_evento, $nombre_evento, date('Y-m-d', strtotime($fecha_evento)), date('H:i:s', strtotime($hora_evento)), $id_cat_evento, $id_inv, $clave) > 0) {
            $modelo = null;
            mensaje("Evento <strong>" . $nombre_evento . "</strong> actualizado correctamente", "success");
        } else throw new Exception("No se actualizó el evento");
    } catch (Exception $e) {
        mensaje("Lo siento hubo un error al actualizar el evento: " . $e->getMessage(), "error");
    }
}

function eliminar($id_evento)
{
    include 'util/mensaje.php';
    include 'modelo/modelo-evento.php';

    try {
        $modelo = new EventoModelo();

        if ($modelo->eliminar($id_evento) > 0) {
            $modelo = null;
            mensaje("Evento eliminado correctamente", "success");
        } else throw new Exception("No se eliminó el evento");
    } catch (Exception $e) {
        mensaje("Lo siento hubo un error al eliminar el evento: " . $e->getMessage(), "error");
    }
}
