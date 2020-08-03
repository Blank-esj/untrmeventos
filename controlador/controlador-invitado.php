<?php

function crear(
    $nombres,
    $apellidopa,
    $apellidoma,
    $descripcion,
    &$archivo,
    $institucion_procedencia = null,
    $idgrado_instruccion = null,
    $email = null,
    $telefono = null,
    $doc_identidad = null,
    $nacimiento = null,
    $sexo = null
) {
    include_once 'modelo/modelo-invitado.php';
    include_once 'controlador/global/config.php';
    include 'util/mensaje.php';

    $modelo = new InvitadoModelo();

    try {

        if (!is_dir(DIR_IMG_INVITADO)) {
            mkdir(DIR_IMG_INVITADO, 0755, true); // En caso que no existiera este DIR_IMG_INVITADO, lo crea
        }

        if (move_uploaded_file($archivo['archivo_imagen']['tmp_name'], DIR_IMG_INVITADO . $archivo['archivo_imagen']['name'])) {
            $imagen_url = $archivo['archivo_imagen']['name'];
        } else {
            throw new Exception("Error subir imagen");
        }

        if ($modelo->crear($nombres, $apellidopa, $apellidoma, $descripcion, $imagen_url, $institucion_procedencia, $idgrado_instruccion, $email, $telefono, $doc_identidad, $nacimiento, $sexo)) {
            mensaje("<strong>" . $nombres . "</strong> se guardó satisfactoriamente", "success");
            return true;
        } else
            throw new PDOException("Error al crear");
    } catch (Exception $e) {
        return false;
        mensaje("Lo siento hubo un error al crear el invitado: <br/>" . $e->getMessage(), "error");
    }
    return false;
}

function actualizar(
    $idpersona,
    $nombres,
    $apellidopa,
    $apellidoma,
    $descripcion,
    &$archivo,
    $institucion_procedencia = null,
    $idgrado_instruccion = null,
    $email = null,
    $telefono = null,
    $doc_identidad = null,
    $nacimiento = null,
    $sexo = null
) {

    include_once 'modelo/modelo-invitado.php';
    include_once 'controlador/global/config.php';
    include 'util/mensaje.php';

    $modelo = new InvitadoModelo();

    try {

        $tengo_imagen = $archivo['archivo_imagen']['size'] > 0;

        if ($tengo_imagen) {
            if (!is_dir(DIR_IMG_INVITADO)) {
                mkdir(DIR_IMG_INVITADO, 0755, true);
            }

            if (move_uploaded_file($archivo['archivo_imagen']['tmp_name'], DIR_IMG_INVITADO . $archivo['archivo_imagen']['name'])) {
                $imagen_url = $archivo['archivo_imagen']['name'];
            } else {
                throw new Exception("Error subir imagen");
            }
        }

        if ($modelo->actualizar($idpersona, $nombres, $apellidopa, $apellidoma, $descripcion, $tengo_imagen ? $imagen_url : null, $institucion_procedencia, $idgrado_instruccion, $email, $telefono, $doc_identidad, $nacimiento, $sexo)) {
            mensaje("<strong>" . $nombres . "</strong> se actualizó satisfactoriamente", "success");
            return true;
        } else
            throw new PDOException("Error al actualizar <strong>" . $nombres . "</strong>");
    } catch (Exception $e) {
        mensaje("Lo siento hubo un error al actualizar el invitado: <br/>" . $e->getMessage(), "error");
        return false;
    }
    return false;
}


function eliminar($id)
{
    include 'modelo/modelo-invitado.php';
    include 'util/mensaje.php';

    $modelo = new InvitadoModelo();

    try {
        if ($modelo->eliminar($id) > 0) {
            mensaje("Eliminado satisfactoriamente", "success");
        } else {
            throw new Exception("Error al eliminar este invitado");
        }
    } catch (Throwable $th) {
        mensaje("Lo siento hubo un error al eliminar el invitado: <br/>" . $th->getMessage(), "error");
    }
}
