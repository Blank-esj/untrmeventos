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
    include 'util/mensaje.php';

    $resultado = false;

    $modelo = new InvitadoModelo();

    try {

        $directorio = "assets/img/invitados/";
        if (!is_dir($directorio)) {
            mkdir($directorio, 0755, true); // En caso que no existiera este directorio, lo crea
        }

        print_r($archivo);

        if (move_uploaded_file($archivo['archivo_imagen']['tmp_name'], $directorio . $archivo['archivo_imagen']['name'])) {
            $imagen_url = $archivo['archivo_imagen']['name'];
        } else {
            throw new Exception("Error subir imagen");
        }

        if ($modelo->crear($nombres, $apellidopa, $apellidoma, $descripcion, $imagen_url, $institucion_procedencia, $idgrado_instruccion, $email, $telefono, $doc_identidad, $nacimiento, $sexo)) {
            mensaje("<strong>" . $nombres . "</strong> se guardó satisfactoriamente", "success");
            $resultado = true;
        } else
            throw new PDOException("Error al crear");
    } catch (Exception $e) {
        $resultado = false;
        mensaje("Lo siento hubo un error al crear el invitado: <br/>" . $e->getMessage(), "error");
    }
    return $resultado;
}
