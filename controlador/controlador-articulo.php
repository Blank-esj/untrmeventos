<?php

function crear(string $nombre, float $precio, float $stock, string $descripción, &$archivo)
{
    include_once 'modelo/modelo-articulo.php';
    include_once 'controlador/global/config.php';
    include 'util/mensaje.php';

    $modelo = new ArticuloModelo();

    try {

        $tengo_imagen = $archivo['archivo_imagen']['size'] > 0;

        if ($tengo_imagen) {
            if (!is_dir(DIR_IMG_ARTICULO)) {
                mkdir(DIR_IMG_ARTICULO, 0755, true);
            }

            if (move_uploaded_file($archivo['archivo_imagen']['tmp_name'], DIR_IMG_ARTICULO . $archivo['archivo_imagen']['name'])) {
                $imagen_url = $archivo['archivo_imagen']['name'];
            } else {
                throw new Exception("Error subir imagen");
            }
        }

        if ($modelo->crear($nombre, $precio, $stock, $descripción, $tengo_imagen ? $imagen_url : null)['filas'] > 0) {
            mensaje("<strong>" . $nombre . "</strong> se actualizó satisfactoriamente", "success");
            return true;
        } else
            throw new PDOException("Error al actualizar <strong>" . $nombres . "</strong>");
    } catch (Exception $e) {
        mensaje("Lo siento hubo un error al actualizar el articulo: <br/>" . $e->getMessage(), "error");
        return false;
    }
    return false;
}

function actualizar(int $id, string $nombre, float $precio, float $stock, string $descripción, &$archivo)
{
    include_once 'modelo/modelo-articulo.php';
    include_once 'controlador/global/config.php';
    include 'util/mensaje.php';

    $modelo = new ArticuloModelo();

    try {

        $tengo_imagen = $archivo['archivo_imagen']['size'] > 0;

        if ($tengo_imagen) {
            if (!is_dir(DIR_IMG_ARTICULO)) {
                mkdir(DIR_IMG_ARTICULO, 0755, true);
            }

            if (move_uploaded_file($archivo['archivo_imagen']['tmp_name'], DIR_IMG_ARTICULO . $archivo['archivo_imagen']['name'])) {
                $imagen_url = $archivo['archivo_imagen']['name'];
            } else {
                throw new Exception("Error subir imagen");
            }
        }

        if ($modelo->actualizar($id, $nombre, $precio, $stock, $descripción, $tengo_imagen ? $imagen_url : null) > 0) {
            mensaje("<strong>" . $nombre . "</strong> se actualizó satisfactoriamente", "success");
            return true;
        } else
            throw new PDOException("Error al actualizar <strong>" . $nombre . "</strong>");
    } catch (Exception $e) {
        mensaje("Lo siento hubo un error al actualizar el articulo: <br/>" . $e->getMessage(), "error");
        return false;
    }
    return false;
}

function eliminar(int $id)
{
    include 'modelo/modelo-articulo.php';
    include 'util/mensaje.php';

    $modelo = new ArticuloModelo();

    try {
        if ($modelo->eliminar($id) > 0) {
            mensaje("Eliminado satisfactoriamente", "success");
        } else {
            throw new Exception("Error al eliminar este invitado");
        }
    } catch (Throwable $th) {
        mensaje("Lo siento hubo un error al eliminar el articulo: <br/>" . $th->getMessage(), "error");
    }
}
