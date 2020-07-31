<?php
class Admins
{
    /**
     * Hace una consulta a la base de datos comparando el usuario que le pases por parámetro con el usuario que haya en la base de datos
     * y devuelve un array con los usuario; idpersona, usuario, nombre_completo, password y nivel del admin
     */
    public function leerDatosLoginAdmin(\PDO $conexion, string $usuario)
    {
        $sentencia = $conexion->prepare('SELECT idpersona, usuario, nombre_completo, password, nivel FROM v_admins WHERE usuario = :usuario;');
        $sentencia->bindParam(':usuario', $usuario);

        $sentencia->execute();

        $resultado = ($sentencia->fetchAll(PDO::FETCH_ASSOC));

        $sentencia->closeCursor();

        return $resultado;
    }

    /**
     * Devuelve el total de adminsitradores que hay en la base de datos
     */
    public function cuentaAdmins(\PDO $conexion)
    {
        $sentencia = $conexion->query("SELECT COUNT(*) total FROM admins");
        $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
        $sentencia = null;

        return $resultado;
    }

    /**
     * Crea un nuevo administrador
     */
    public function crear(
        \PDO $conexion,
        $nombres,
        $apellidopa,
        $apellidoma,
        $email,
        $telefono,
        $doc_identidad,
        $usuario,
        $contrasena,
        $nivel = 1
    ) {

        $sentencia = $conexion->prepare("CALL sp_crear_administrador (
            :nombres,
            :apellidopa,
            :apellidoma,
            :email,
            :telefono,
            :doc_identidad,
            :usuario,
            :contrasena,
            :nivel
        );");
        $sentencia->bindParam(":nombres", $nombres);
        $sentencia->bindParam(":apellidopa", $apellidopa);
        $sentencia->bindParam(":apellidoma", $apellidoma);
        $sentencia->bindParam(":email", $email);
        $sentencia->bindParam(":telefono", $telefono);
        $sentencia->bindParam(":doc_identidad", $doc_identidad);
        $sentencia->bindParam(":usuario", $usuario);
        $sentencia->bindParam(":contrasena", $contrasena);
        $sentencia->bindParam(":nivel", $nivel);

        $sentencia->execute();

        $sentencia->closeCursor();

        $resultado = $sentencia->rowCount();

        return $resultado;
    }

    public function leerTodos(\PDO $conexion)
    {
        $sentencia = $conexion->query("SELECT * total FROM admins");

        return $sentencia;
    }
}
