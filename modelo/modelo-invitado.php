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

        $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);

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

        $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);

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

        $resultado = false;

        $conn = (new Conexion())->conectarPDO();
        try {
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $conn->beginTransaction(); // Comenzar una transacción, desactivando el modo 'autocommit'

            include 'modelo-persona.php';

            $personaModelo = new PersonaModelo();

            $idpersona = $personaModelo->ultimoId() + 1;

            if ($personaModelo->crear($idpersona, $nombres, $apellidopa, $apellidoma, $email, $telefono, $doc_identidad) > 0)
                $resultado = true;
            else throw new PDOException("No se creó Persona");

            if ($this->insertar($idpersona, $descripcion, $url_imagen, $institucion_procedencia, $idgrado_instruccion, $nacimiento, $sexo) > 0)
                $resultado = true;
            else throw new PDOException("No se creó Invitado");

            $personaModelo = null;
            $idpersona = null;

            $conn->commit(); // Guadamos los cambios

            $resultado = true;
        } catch (PDOException $e) {
            $conn->rollBack(); // Revertimos los cambios
            echo $e->getMessage();
            $resultado = false;
        }
        $conn = null;
        return $resultado;
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

        $resultado = $sentencia->rowCount();

        $conn = null;
        $sentencia = null;

        return $resultado;
    }

    public function actualizar(
        $idpersona,
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

        $resultado = false;
        $conn = (new Conexion())->conectarPDO();
        try {
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $conn->beginTransaction(); // Comenzar una transacción, desactivando el modo 'autocommit'

            include 'modelo-persona.php';

            $personaModelo = new PersonaModelo();

            if ($personaModelo->actualizar($idpersona, $nombres, $apellidopa, $apellidoma, $email, $telefono, $doc_identidad) > 0)
                $resultado = true;
            else throw new PDOException("No se actualizó correctaente");

            if ($this->update($idpersona, $descripcion, $url_imagen, $institucion_procedencia, $idgrado_instruccion, $nacimiento, $sexo) > 0)
                $resultado = true;
            else throw new PDOException("No se actualizó correctaente");

            $personaModelo = null;
            $idpersona = null;

            $conn->commit(); // Guadamos los cambios

            $resultado = true;
        } catch (PDOException $e) {
            $conn->rollBack(); // Revertimos los cambios
            $resultado = false;
        }
        $conn = null;
        return $resultado;
    }

    private function update($idpersona, $descripcion, $url_imagen, $institucion_procedencia = null, $idgrado_instruccion = null, $nacimiento = null, $sexo = null)
    {
        include_once 'controlador/util/bd_conexion_pdo.php';

        $conn = (new Conexion())->conectarPDO();

        $sentencia = $conn->prepare(
            "UPDATE invitado
            SET
            descripcion = :u_descripcion,
            url_imagen = :u_url_imagen,
            institucion_procedencia = :u_institucion_procedencia,
            idgrado_instruccion = :u_idgrado_instruccion,
            nacimiento = :u_nacimiento,
            sexo = :u_sexo
            WHERE idpersona = :u_idpersona;"
        );

        $sentencia->bindParam(":u_idpersona", $idpersona, PDO::PARAM_INT);
        $sentencia->bindParam(":u_descripcion", $descripcion, PDO::PARAM_STR);
        $sentencia->bindParam(":u_url_imagen", $url_imagen, PDO::PARAM_STR);
        $sentencia->bindParam(":u_institucion_procedencia", $institucion_procedencia);
        $sentencia->bindParam(":u_idgrado_instruccion", $idgrado_instruccion);
        $sentencia->bindParam(":u_nacimiento", $nacimiento);
        $sentencia->bindParam(":u_sexo", $sexo);

        $sentencia->execute();

        $resultado = $sentencia->rowCount();

        $conn = null;
        $sentencia = null;

        return $resultado;
    }

    public function eliminar($idpersona)
    {
        include_once 'controlador/util/bd_conexion_pdo.php';

        $conn = (new Conexion())->conectarPDO();

        $sentencia = $conn->prepare("DELETE FROM invitado WHERE idpersona = :idpersona;");

        $sentencia->bindParam(":idpersona", $idpersona, PDO::PARAM_INT);

        $sentencia->execute();

        $resultado = $sentencia->rowCount();

        $conn = null;
        $sentencia = null;

        return $resultado;
    }
}
