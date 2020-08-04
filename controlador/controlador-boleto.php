<?php
class BoletoControlador
{
    public function crear(
        string $nombres,
        string $apellidopa,
        string $apellidoma,
        string $email = null,
        string $telefono = null,
        string $doc_identidad,
        int $idventa = null,
        int $idplan,
        int $idregalo = null
    ) {
        include 'modelo/modelo-boleto.php';
        include 'util/bd_conexion_pdo.php';
        include 'util/mensaje.php';

        $conexion = (new Conexion())->conectarPDO();

        $boleto = new BoletoModelo();

        try {
            if ($boleto->crear(
                $conexion,
                $nombres,
                $apellidopa,
                $apellidoma,
                $email,
                $telefono,
                $doc_identidad,
                $idventa,
                $idplan,
                $idregalo
            )['filas'] > 0) {
                mensaje("<strong>" . $nombres . "</strong> se guardó satisfactoriamente", "success");
                return true;
            }
            throw new Exception("No se creó el boleto");
        } catch (Throwable $th) {
            mensaje("Lo siento hubo un error al crear el boleto", "error");
            return false;
        }
        return false;
    }

    /**
     * Actualiza todos los campos de boleto menos la venta ni el regalo
     */
    public function actualizarSinVentaRegalo(
        int $idboleto,
        string $nombres,
        string $apellidopa,
        string $apellidoma,
        string $email,
        string $telefono,
        string $doc_identidad,
        int $idplan
    ) {
    }

    public function eliminar()
    {
    }
}
