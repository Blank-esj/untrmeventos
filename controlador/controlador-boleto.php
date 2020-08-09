<?php
class BoletoControlador
{
    public function crear(
        string $nombres,
        string $apellidopa,
        string $apellidoma,
        string $email = null,
        string $telefono = null,
        string $doc_identidad = null,
        int $idventa = null,
        int $idplan,
        int $idregalo = null
    ) {
        include 'modelo/modelo-boleto.php';
        include 'util/mensaje.php';

        $boleto = new BoletoModelo();

        try {
            if ($boleto->crear(
                $nombres,
                $apellidopa,
                $apellidoma,
                $email,
                $telefono,
                $doc_identidad,
                $idventa,
                $idplan,
                $idregalo
            )) {
                mensaje("<strong>" . $nombres . "</strong> se guardó satisfactoriamente", "success");
                return true;
            }
            throw new Exception("No se creó el boleto");
        } catch (Throwable $th) {
            mensaje("Lo siento hubo un error al crear el boleto <br/>" . $th->getMessage(), "error");
            return false;
        }
        return false;
    }

    /**
     * Actualiza todos los campos de boleto menos la venta ni el regalo
     */
    public function actualizar(
        $idboleto,
        $nombres,
        $apellidopa,
        $apellidoma,
        $email = null,
        $telefono = null,
        $doc_identidad = null,
        $idventa = null,
        $idplan,
        $idregalo = null
    ) {
        try {
            $_idboleto = openssl_decrypt($idboleto, COD, KEY);
            $_idventa = openssl_decrypt($idventa, COD, KEY);
            $_idplan = openssl_decrypt($idplan, COD, KEY);
            $_idregalo = openssl_decrypt($idregalo, COD, KEY);

            if (!is_int((int)$_idboleto)) return false;
            if (!is_int((int)$_idplan)) return false;

            if ($_idventa == "") $_idventa = null;
            if ($_idregalo == "") $_idregalo = null;

            include 'modelo/modelo-boleto.php';
            include 'util/mensaje.php';

            $boleto = new BoletoModelo();

            if ($boleto->actualizar(
                $_idboleto,
                $nombres,
                $apellidopa,
                $apellidoma,
                $email,
                $telefono,
                $doc_identidad,
                $_idventa,
                $_idplan,
                $_idregalo
            )) {
                mensaje("<strong>" . $nombres . "</strong> se actualizó satisfactoriamente", "success");
                return true;
            }
            throw new Exception("No se actualizó el boleto");
        } catch (Throwable $th) {
            mensaje("Lo siento hubo un error al actualizar el boleto <br/>" . $th->getMessage(), "error");
            return false;
        }
        return false;
    }

    public function eliminar($idboleto)
    {
        include 'modelo/modelo-boleto.php';
        include 'util/mensaje.php';

        $boleto = new BoletoModelo();

        try {
            if ($boleto->eliminar(openssl_decrypt($idboleto, COD, KEY)) > 0) {
                mensaje("Se eliminó satisfactoriamente", "success");
                return true;
            }
            throw new Exception("El boleto no se eliminó");
        } catch (Throwable $th) {
            mensaje("Lo siento hubo un error al aliminar el boleto <br/>" . $th->getMessage(), "error");
            return false;
        }
        return false;
    }
}
