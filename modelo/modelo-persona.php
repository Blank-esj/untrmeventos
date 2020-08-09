<?php
include_once 'controlador/util/bd_conexion_pdo.php';
class PersonaModelo
{
    /**
     * Devuelve un array con el resultado de la persona que tenga el id que le pases
     */
    public function leer($id)
    {
        $conn = (new Conexion())->conectarPDO();

        $sentencia = $conn->prepare("SELECT * FROM persona WHERE idpersona = :id");

        $sentencia->bindParam(":id", $id, PDO::PARAM_INT);

        $sentencia->execute();

        $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);

        $conn = null;
        $sentencia = null;

        return $resultado;
    }

    /**
     * Devuelve todos los registros de personas
     */
    public function leerTodos()
    {
        $conn = (new Conexion())->conectarPDO();

        $sentencia = $conn->query("SELECT * FROM persona;");

        $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);

        $conn = null;
        $sentencia = null;

        return $resultado;
    }

    /**
     * Devuelve el último id de la tabla persona en caso no haya ninguno (NULL) devolverá 0
     */
    public function ultimoId(): int
    {
        $conn = (new Conexion())->conectarPDO();

        $resultado = $this->ultimoIdVincular($conn);

        $conn = null;

        return $resultado;
    }

    /**
     * Es una funcion dependiente de la conexión de base de datos porque se le tiene que pasar por
     * parámetro esta conexión.
     */
    public function ultimoIdVincular(\PDO &$conn): int
    {
        $sentencia = $conn->query("SELECT IFNULL((SELECT MAX(idpersona) FROM persona), 0) idpersona;");

        $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC)[0]['idpersona'];

        $sentencia->closeCursor();

        $sentencia = null;

        return $resultado;
    }

    /**
     * Inserta un registro persona en la base de datos de acuerdo a los datos que le pases.
     * Devuelve el número de filas afectadas
     */
    public function crear($idpersona, $nombres, $apellidopa, $apellidoma, $email = null, $telefono = null, $doc_identidad = null)
    {
        $conn = (new Conexion())->conectarPDO();

        $resultado = $this->crearVincular($conn, $idpersona, $nombres, $apellidopa, $apellidoma, $email, $telefono, $doc_identidad);

        $conn = null;

        return $resultado;
    }

    /**
     * Crea una persona pero pasándole la conexión en este caso el método que llame a este tendrá que cerrar la conexión.
     * Devuelve las filas afectadas
     */
    public function crearVincular(\PDO &$conn, $idpersona, $nombres, $apellidopa, $apellidoma, $email = null, $telefono = null, $doc_identidad = null)
    {
        $sentencia = $conn->prepare(
            "INSERT INTO persona VALUES (
            :idpersona,
            :nombres,
            :apellidopa,
            :apellidoma,
            :email,
            :telefono,
            :doc_identidad);"
        );

        $sentencia->bindParam(":idpersona", $idpersona, PDO::PARAM_INT);
        $sentencia->bindParam(":nombres", $nombres, PDO::PARAM_STR);
        $sentencia->bindParam(":apellidopa", $apellidopa, PDO::PARAM_STR);
        $sentencia->bindParam(":apellidoma", $apellidoma, PDO::PARAM_STR);
        $sentencia->bindParam(":email", $email);
        $sentencia->bindParam(":telefono", $telefono);
        $sentencia->bindParam(":doc_identidad", $doc_identidad);

        $sentencia->execute();

        $resultado = $sentencia->rowCount();

        $sentencia->closeCursor();

        $sentencia = null;

        return $resultado;
    }

    /**
     * Es una actualización en la que no se le pasa la conexión
     */
    public function actualizar($idpersona, $nombres, $apellidopa, $apellidoma, $email = null, $telefono = null, $doc_identidad = null)
    {
        include_once 'controlador/util/bd_conexion_pdo.php';

        $conn = (new Conexion())->conectarPDO();

        $resultado = $this->actualizarVincular($conn, $idpersona, $nombres, $apellidopa, $apellidoma, $email, $telefono, $doc_identidad);

        return $resultado;
    }

    /**
     * Actualiza un registro de persona de acuerdo los datos que le pases.
     * Devuelve el número de filas afectadas
     */
    public function actualizarVincular(\PDO &$conn, $idpersona, $nombres, $apellidopa, $apellidoma, $email = null, $telefono = null, $doc_identidad = null)
    {
        $sentencia = $conn->prepare(
            "UPDATE persona
            SET
            nombres = :u_nombres,
            apellidopa = :u_apellidopa,
            apellidoma = :u_apellidoma,
            email = :u_email,
            telefono = :u_telefono,
            doc_identidad = :u_doc_identidad
            WHERE idpersona = :u_idpersona;"
        );

        $sentencia->bindParam(":u_idpersona", $idpersona, PDO::PARAM_INT);
        $sentencia->bindParam(":u_nombres", $nombres, PDO::PARAM_STR);
        $sentencia->bindParam(":u_apellidopa", $apellidopa, PDO::PARAM_STR);
        $sentencia->bindParam(":u_apellidoma", $apellidoma, PDO::PARAM_STR);
        $sentencia->bindParam(":u_email", $email);
        $sentencia->bindParam(":u_telefono", $telefono);
        $sentencia->bindParam(":u_doc_identidad", $doc_identidad);

        $sentencia->execute();

        $resultado = $sentencia->rowCount();

        $sentencia = null;

        return $resultado;
    }

    /**
     * Elimina un registro de persona de la base de datos.
     * Devuelve el número de filas afectadas
     */
    public function eliminar($idpersona)
    {
        $conn = (new Conexion())->conectarPDO();

        $sentencia = $conn->prepare("DELETE FROM persona WHERE idpersona = :idpersona;");

        $sentencia->bindParam(":idpersona", $idpersona, PDO::PARAM_INT);

        $sentencia->execute();

        $resultado = $sentencia->rowCount();

        $conn = null;
        $sentencia = null;

        return $resultado;
    }

    /**
     * Compara todos los campos que le pasemos por parámetro y un registro de persona
     * @return bool devuelve true si TODOS son iguales sino devuelve false
     */
    public function esIgual($idpersona, $nombres, $apellidopa, $apellidoma, $email, $telefono, $doc_identidad)
    {
        $persona = $this->leer($idpersona)[0];
        if ($persona['nombres'] != $nombres) return false;
        if ($persona['apellidopa'] != $apellidopa) return false;
        if ($persona['apellidoma'] != $apellidoma) return false;
        if ($persona['email'] != $email) return false;
        if ($persona['telefono'] != $telefono) return false;
        if ($persona['doc_identidad'] != $doc_identidad) return false;
        return true;
    }
}
