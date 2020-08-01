<?php
function crear(string $nombre, float $precio, string $descripcion, array $arrayBeneficios = null)
{
    include 'modelo/modelo-plan.php';
    include 'util/mensaje.php';

    $modelo = new PlanModelo();

    try {
        if ($modelo->crear($nombre, $precio, $descripcion, $arrayBeneficios)) {
            mensaje("<strong>" . $nombre . "</strong> se guardó satisfactoriamente", "success");
            return true;
        } else {
            throw new Exception("No se pudo crear Plan");
        }
    } catch (Throwable $th) {
        mensaje("Lo siento hubo un error al crear plan: <br/>" . $th->getMessage(), "error");
        return false;
    }
    return false;
}

function actualizar(int $idplan, string $nombre, float $precio, string $descripcion, array $arrayBeneficios = null)
{
    include 'modelo/modelo-plan.php';
    include 'util/mensaje.php';

    $modelo = new PlanModelo();

    try {
        if ($modelo->actualizar($idplan, $nombre, $precio, $descripcion, $arrayBeneficios)) {
            mensaje("<strong>" . $nombre . "</strong> se actualizó satisfactoriamente", "success");
            return true;
        } else {
            throw new Exception("No se pudo actualizar plan");
        }
    } catch (Throwable $th) {
        mensaje("Lo siento hubo un error al actualizar plan: <br/>" . $th->getMessage(), "error");
        return false;
    }
    return false;
}

/**
 * Elimina un plan de acurdo al id que le pases por parámetro
 */
function eliminar($idplan)
{
    include 'util/mensaje.php';
    include 'modelo/modelo-plan.php';

    try {
        $modelo = new PlanModelo();

        if ($modelo->eliminar($idplan) > 0) {
            $modelo = null;
            mensaje("Plan eliminado correctamente", "success");
        } else throw new Exception("No se eliminó el plan");
    } catch (Exception $e) {
        mensaje("Lo siento hubo un error al eliminar el plan: " . $e->getMessage(), "error");
    }
}
