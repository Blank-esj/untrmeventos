<?php
class AdministradorModelo
{
    /**
     * Lee un Administrador y devuelve un array de resultado
     */
    public function leer($id)
    {
        include_once 'controlador/util/bd_conexion_pdo.php';

        $conn = (new Conexion())->conectarPDO();

        $sentencia = $conn->prepare("SELECT * FROM v_admins WHERE idpersona = :id");

        $sentencia->bindParam(":id", $id);

        $sentencia->execute();

        return $sentencia->fetchAll(PDO::FETCH_ASSOC);

        $sentencia = null;
        $conn = null;

        return $resultado;
    }

    /**
     * Devuelve todos los Administradores que haya en la bd
     */
    public function leerTodos()
    {
        include_once 'controlador/util/bd_conexion_pdo.php';

        $conn = (new Conexion())->conectarPDO();

        $sentencia = $conn->query("SELECT * FROM v_admins;");

        return $sentencia->fetchAll(PDO::FETCH_ASSOC);

        $sentencia = null;
        $conn = null;

        return $resultado;
    }

    public function crear(
        $nombres,
        $apellidopa,
        $apellidoma,
        $email = null,
        $telefono = null,
        $doc_identidad = null,
        $usuario,
        $contrasena,
        $nivel
    ) {
        include_once 'controlador/util/bd_conexion_pdo.php';

        $rpta = false;
        $conn = (new Conexion())->conectarPDO();
        try {
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $conn->beginTransaction(); // Comenzar una transacción, desactivando el modo 'autocommit'

            include 'modelo-persona.php';

            $personaModelo = new PersonaModelo();

            $idpersona = $personaModelo->ultimoId() + 1;

            if ($personaModelo->crearVincular($conn, $idpersona, $nombres, $apellidopa, $apellidoma, $email, $telefono, $doc_identidad) > 0)
                $rpta = true;
            else throw new PDOException("No se creó Persona");

            if ($this->insertar($conn, $idpersona, $usuario, $contrasena, $nivel) > 0)
                $rpta = true;
            else throw new PDOException("No se creó Administrador");

            $personaModelo = null;
            $idpersona = null;

            $conn->commit(); // Guadamos los cambios
        } catch (PDOException $e) {
            $conn->rollBack(); // Revertimos los cambios
            $rpta = false;
        }
        $conn = null;
        return $rpta;
    }

    private function insertar(
        \PDO &$conn,
        $idpersona,
        $usuario,
        $contrasena,
        $nivel
    ) {
        $sentencia = $conn->prepare(
            "INSERT INTO admins (
                idpersona,
                usuario,
                password,
                nivel) VALUES (
                :idpersona,
                :usuario,
                :password,
                :nivel);"
        );

        $sentencia->bindParam(":idpersona", $idpersona, PDO::PARAM_INT);
        $sentencia->bindParam(":usuario", $usuario, PDO::PARAM_STR);
        $sentencia->bindParam(":password", $contrasena, PDO::PARAM_STR);
        $sentencia->bindParam(":nivel", $nivel);

        $sentencia->execute();

        $resultado = $sentencia->rowCount();

        $sentencia->closeCursor();
        $sentencia = null;

        return $resultado;
    }

    /**
     * Actualiza un administrador.
     * Devuelve true si se guardó correctamente sino false.
     */
    public function actualizar(
        $idpersona,
        $nombres,
        $apellidopa,
        $apellidoma,
        $email = null,
        $telefono = null,
        $doc_identidad = null,
        $usuario,
        $contrasena,
        $nivel
    ) {

        include_once 'controlador/util/bd_conexion_pdo.php';

        $resultado = false;
        $conn = (new Conexion())->conectarPDO();
        try {
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $conn->beginTransaction(); // Comenzar una transacción, desactivando el modo 'autocommit'

            include 'modelo-persona.php';

            $personaModelo = new PersonaModelo();

            $actualizoPersona = true;
            $actualizoAdministrador = true;
            $mensaje = "";

            $noCambioPersona = $personaModelo->esIgual($idpersona, $nombres, $apellidopa, $apellidoma, $email, $telefono, $doc_identidad);

            if (!$noCambioPersona && $personaModelo->actualizarVincular($conn, $idpersona, $nombres, $apellidopa, $apellidoma, $email, $telefono, $doc_identidad) <= 0) {
                $actualizoPersona = false;
                $mensaje = "No se actualizó persona ";
            }

            $cambioAmdin = $this->esIgual($idpersona, $usuario, $contrasena, $nivel);

            if (!$cambioAmdin && $this->update($conn, $idpersona, $usuario, $contrasena, $nivel) <= 0) {
                $actualizoAdministrador = false;
                $mensaje .= "No se actualizó Administrador ";
            }

            /**
             * Si ni en la tabla persona ni en Administrador hay filas afectadas entonces
             * devuelve un error (esto podría manejarse diferente)
             * Si las filas de alguna de las tablas ha sido afectada el resultado es true
             */
            if (!$actualizoPersona && !$actualizoAdministrador) throw new Exception($mensaje);
            else $resultado = true;

            $personaModelo = null;
            $idpersona = null;

            $conn->commit(); // Guadamos los cambios
        } catch (Exception $e) {
            $conn->rollBack(); // Revertimos los cambios
            echo "mensaje Error: " . var_dump($e) . "<br/>";
            //echo var_dump($e);
            $resultado = false;
        }
        $conn = null;
        return $resultado;
    }

    private function update(\PDO &$conn, $idpersona, $usuario, $contrasena, $nivel)
    {
        $consulta =
            "UPDATE admins SET
            usuario = :u_usuario, "
            . ($contrasena != null ? "password = :u_password, " : "") .
            "nivel = :u_nivel 
            WHERE idpersona = :u_idpersona;";

        $sentencia = $conn->prepare($consulta);

        $sentencia->bindParam(":u_idpersona", $idpersona, PDO::PARAM_INT);
        $sentencia->bindParam(":u_usuario", $usuario, PDO::PARAM_STR);
        if ($contrasena != null)
            $sentencia->bindParam(":u_password", $contrasena);
        $sentencia->bindParam(":u_nivel", $nivel);

        $sentencia->execute();

        $resultado = $sentencia->rowCount();

        $sentencia->closeCursor();
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

    /**
     * 
     */

    public function esIgual($idpersona, $usuario, $contrasena, $nivel)
    {
        $admins = $this->leer($idpersona)[0];
        if ($admins['usuario'] != $usuario) return false;
        if ($contrasena != null) return false;
        if ($admins['nivel'] != $nivel) return false;
        return true;
    }
}
