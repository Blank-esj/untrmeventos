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

        $resultado = ($sentencia->fetchAll(PDO::FETCH_ASSOC))[0];

        $sentencia->closeCursor();

        return $resultado;
    }
}
