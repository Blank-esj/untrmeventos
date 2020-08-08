<?php
class InvitadoModelo
{
    /**
     * Lee un Invitado y devuelve un array de resultados
     */
    public function leer($id)
    {
        include_once 'controlador/util/bd_conexion_pdo.php';

        $conn = (new Conexion())->conectarPDO();

        $sentencia = $conn->prepare("SELECT * FROM v_invitado WHERE idpersona = :id");

        $sentencia->bindParam(":id", $id);

        $sentencia->execute();

        return $sentencia->fetchAll(PDO::FETCH_ASSOC);

        $sentencia = null;
        $conn = null;

        return $resultado;
    }

    /**
     * Devuelve todos los invitados que haya en la base datos
     */
    public function leerTodos()
    {
        include_once 'controlador/util/bd_conexion_pdo.php';

        $conn = (new Conexion())->conectarPDO();

        $sentencia = $conn->query("SELECT * FROM v_invitado;");

        return $sentencia->fetchAll(PDO::FETCH_ASSOC);

        $sentencia = null;
        $conn = null;

        return $resultado;
    }
    public function crear(
        $nombres,
        $apellidopa,
        $apellidoma,
        $descripcion,
        $url_imagen,
        $institucion_procedencia = null,
        $idgrado_instruccion = null,
        $email = null,
        $telefono = null,
        $doc_identidad = null,
        $nacimiento = null,
        $sexo = null
    ) {
        include_once 'controlador/util/bd_conexion_pdo.php';

        $conn = (new Conexion())->conectarPDO();
        try {
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $conn->beginTransaction(); // Comenzar una transacción, desactivando el modo 'autocommit'

            include 'modelo-persona.php';

            $personaModelo = new PersonaModelo();

            $idpersona = $personaModelo->ultimoId() + 1;

            if ($personaModelo->crear($idpersona, $nombres, $apellidopa, $apellidoma, $email, $telefono, $doc_identidad) > 0)
                return true;
            else throw new PDOException("No se creó Persona");

            if ($this->insertar($idpersona, $descripcion, $url_imagen, $institucion_procedencia, $idgrado_instruccion, $nacimiento, $sexo) > 0)
                return true;
            else throw new PDOException("No se creó Invitado");

            $personaModelo = null;
            $idpersona = null;

            $conn->commit(); // Guadamos los cambios

            return true;
        } catch (PDOException $e) {
            $conn->rollBack(); // Revertimos los cambios
            return false;
        }
        $conn = null;
        return false;
    }

    private function insertar(
        $idpersona,
        $descripcion,
        $url_imagen,
        $institucion_procedencia = null,
        $idgrado_instruccion = null,
        $nacimiento = null,
        $sexo = null
    ) {
        include_once 'controlador/util/bd_conexion_pdo.php';

        $conn = (new Conexion())->conectarPDO();
        $sentencia = $conn->prepare(
            "INSERT INTO invitado (
                idpersona,
                descripcion,
                url_imagen,
                institucion_procedencia,
                idgrado_instruccion,
                nacimiento,
                sexo) VALUES (
                :idpersona,
                :descripcion,
                :url_imagen,
                :institucion_procedencia,
                :idgrado_instruccion,
                :nacimiento,
                :sexo);"
        );

        $sentencia->bindParam(":idpersona", $idpersona, PDO::PARAM_INT);
        $sentencia->bindParam(":descripcion", $descripcion, PDO::PARAM_STR);
        $sentencia->bindParam(":url_imagen", $url_imagen, PDO::PARAM_STR);
        $sentencia->bindParam(":institucion_procedencia", $institucion_procedencia);
        $sentencia->bindParam(":idgrado_instruccion", $idgrado_instruccion);
        $sentencia->bindParam(":nacimiento", $nacimiento);
        $sentencia->bindParam(":sexo", $sexo);

        $sentencia->execute();

        return $sentencia->rowCount();

        $conn = null;
        $sentencia = null;

        return $resultado;
    }

    /**
     * Actualiza un invitado.
     * Si la url de la imagen es null, no se actualiza la imagen.
     * Devuelve true si se guardó correctamente sino false.
     */
    public function actualizar(
        $idpersona,
        $nombres,
        $apellidopa,
        $apellidoma,
        $descripcion,
        $url_imagen = null,
        $institucion_procedencia = null,
        $idgrado_instruccion = null,
        $email = null,
        $telefono = null,
        $doc_identidad = null,
        $nacimiento = null,
        $sexo = null
    ) {

        include_once 'controlador/util/bd_conexion_pdo.php';

        return false;
        $conn = (new Conexion())->conectarPDO();
        try {
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $conn->beginTransaction(); // Comenzar una transacción, desactivando el modo 'autocommit'

            include 'modelo-persona.php';

            $personaModelo = new PersonaModelo();

            $actualizoPersona = true;
            $actualizoInvitado = true;
            $mensaje = "";

            if ($personaModelo->actualizarVincular($conn, $idpersona, $nombres, $apellidopa, $apellidoma, $email, $telefono, $doc_identidad) <= 0) {
                $actualizoPersona = false;
                $mensaje = "No se actualizó persona ";
            }

            if ($this->update($conn, $idpersona, $descripcion, $url_imagen, $institucion_procedencia, $idgrado_instruccion, $nacimiento, $sexo) <= 0) {
                $actualizoInvitado = false;
                $mensaje .= "No se actualizó invitado ";
            }

            /**
             * Si ni en la tabla persona ni en invitado hay filas afectadas entonces
             * devuelve un error (esto podría manejarse diferente)
             * Si las filas de alguna de las tablas ha sido afectada el resultado es true
             */
            if (!$actualizoPersona && !$actualizoInvitado) throw new Exception($mensaje);
            else return true;


            $personaModelo = null;
            $idpersona = null;

            $conn->commit(); // Guadamos los cambios

            return true;
        } catch (Exception $e) {
            $conn->rollBack(); // Revertimos los cambios
            return false;
        }
        $conn = null;
        return $resultado;
    }

    /**
     * Si le pasamos la url de la imagen como NULL, no se actualiza la imagen.
     */
    private function update(\PDO &$conn, $idpersona, $descripcion, $url_imagen = null, $institucion_procedencia = null, $idgrado_instruccion = null, $nacimiento = null, $sexo = null)
    {
        include_once 'controlador/util/bd_conexion_pdo.php';

        $consulta =
            "UPDATE invitado SET
            descripcion = :u_descripcion, "
            . $url_imagen != null ? "url_imagen = :u_url_imagen, " : "" .
            "institucion_procedencia = :u_institucion_procedencia, 
            idgrado_instruccion = :u_idgrado_instruccion, 
            nacimiento = :u_nacimiento, 
            sexo = :u_sexo 
            WHERE idpersona = :u_idpersona;";

        $sentencia = $conn->prepare($consulta);

        $sentencia->bindParam(":u_idpersona", $idpersona, PDO::PARAM_INT);
        $sentencia->bindParam(":u_descripcion", $descripcion, PDO::PARAM_STR);

        if ($url_imagen != null)
            $sentencia->bindParam(":u_url_imagen", $url_imagen);

        $sentencia->bindParam(":u_institucion_procedencia", $institucion_procedencia);
        $sentencia->bindParam(":u_idgrado_instruccion", $idgrado_instruccion);
        $sentencia->bindParam(":u_nacimiento", $nacimiento);
        $sentencia->bindParam(":u_sexo", $sexo);

        $sentencia->execute();

        return $sentencia->rowCount();

        $sentencia = null;

        return $resultado;
    }

    public function eliminar($idpersona)
    {
        include_once 'controlador/util/bd_conexion_pdo.php';

        $conn = (new Conexion())->conectarPDO();

        $sentencia = $conn->prepare("DELETE FROM persona WHERE idpersona = :idpersona;");

        $sentencia->bindParam(":idpersona", $idpersona, PDO::PARAM_INT);

        $sentencia->execute();

        return $sentencia->rowCount();

        $conn = null;
        $sentencia = null;

        return $resultado;
    }
}
