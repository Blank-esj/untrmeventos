<?php
error_reporting(E_ALL ^ E_NOTICE);
include_once 'controlador/funciones-evento.php';
include_once 'controlador/bd_conexion_pdo.php';
include_once 'controlador/util/Sesion.php';
include_once 'controlador/debug_to_console.php';

include_once 'model/boleto.php'; // Es utilizado por este archivo
include_once 'model/regalo.php'; // Es utilizado por este archivo

$conexion = (new Conexion())->conectarPDO();    // Conexión a la base de datos
$sesion = new Sesion();        // Instanciamos la sesión
$boleto = new BoletoModelo();  // Controlador de boleto
$regalo = new RegaloModelo();  // Controlador de regalo
$mensaje = "";

if (isset($_POST['registro'])) {
    switch ($_POST['registro']) {
        case 'nuevo':
            die($boleto->guardarBoleto($conexion, $_POST));
            break;
        case 'actualizar':

            break;
        case 'eliminar':

            break;
        case 'pagar':
            $pagar = new PagarBoleto();
            die($pagar->evaluarPago($conexion, $_POST));
            break;

        default:
            die(json_encode(array("respuesta" => "error", "mensaje" => "No entiendo tu petición")));
            break;
    }
} elseif (isset($_POST['registrarAsistente'])) {
    switch ($_POST['registrarAsistente']) {

            // Selecciona un Plan
        case 'seleccionaPlan':
            // Desencriptamos los datos enviados
            $id = (int)openssl_decrypt($_POST['id'], COD, KEY);
            $nombre = (string)openssl_decrypt($_POST['nombre'], COD, KEY);
            $precio = (float)openssl_decrypt($_POST['precio'], COD, KEY);

            // Validamos que los datos enviados sean correctos
            if (validoAumentarPlan($id, $nombre, $precio, $mensaje)) {
                // Agregamos el plan a la sesión actual
                $sesion->agregarPlan(
                    $id,
                    $nombre,
                    $precio
                );
                $mensaje = "El plan <strong>" . $nombre . "</strong> agregado a su carrito";
            }
            break;

            // Aumenta o suma un articulo al carrito
        case 'aumentarUnArticulo':
            // Desencriptar los datos que nos es enviado
            $id = (int)openssl_decrypt($_POST['id'], COD, KEY);
            $nombre = (string)openssl_decrypt($_POST['nombre'], COD, KEY);
            $precio = (float)openssl_decrypt($_POST['precio'], COD, KEY);
            $stock = (float)openssl_decrypt($_POST['stock'], COD, KEY);

            // Evaluamos que las variables desencriptadas
            if (validoAumentarArticulo($id, $nombre, $precio, $stock, $mensaje)) {

                /**
                 * Si este articulo existe se sumará la cantidad
                 * Sino se agregará al array un nuevo articulo
                 */
                if ($sesion->existeArticulo($id)) {

                    $cantidad = (float)$sesion->leerCantidadArticulo($id);

                    /**
                     * Evaluamos si la cantidad de stock es menor a la cantidad que le estamos pasando
                     * Si es menor se sumará "1" a la cantidad del articulo
                     * Sino no hará nada y mostrará un mensaje informando esto
                     */

                    if ($cantidad <= $stock) {
                        $sesion->sumarCantidadArticulo($id, 1);
                        $mensaje = "Se agregó 1 <strong>" . $nombre . "</strong> a su carrito";
                    } else {
                        $mensaje = "Lo siento ya no hay <strong>" . $nombre . "</strong>";
                    }
                } else {
                    $sesion->agregarArticulo($id, $nombre, $precio, 1);
                    $mensaje = "Se agregó <strong>" . $nombre . "</strong> a su carrito";
                }
            }

            break;
        case 'disminuirUnArticulo':
            // Desencriptamos el id
            $id = (int)openssl_decrypt($_POST['id'], COD, KEY);

            // Verificamos que sea válido
            if (is_numeric($id)) {
                if ($sesion->existeArticulo($id)) {

                    $cantidad = (float)$sesion->leerCantidadArticulo($id);

                    /**
                     * Evaluamos si la cantidad de stock es menor a la cantidad que le estamos pasando
                     * Si es menor se sumará "1" a la cantidad del articulo
                     * Sino no hará nada y mostrará un mensaje informando esto
                     */

                    if ($cantidad <=  $stock) {
                        $sesion->sumarCantidadArticulo($id, 1);
                        $mensaje = "Se agregó 1 <strong>" . $nombre . "</strong> a su carrito";
                    } else {
                        $mensaje = "Lo siento ya no hay <strong>" . $nombre . "</strong>";
                    }
                } else {
                    $sesion->agregarArticulo($id, $nombre, $precio, 1);
                    $mensaje = "Se agregó <strong>" . $nombre . "</strong> a su carrito";
                }
            } else {
                $mensaje .= "Upps... algo pasa con el id <br/>";
            }
            echo var_dump($_SESSION[SESION]);
            break;
        case 'actualizarAsistente':
            // Desencriptamos los datos
            $id = (int)openssl_decrypt($_POST['id'], COD, KEY);
            $indice = (int)openssl_decrypt($_POST['indice'], COD, KEY);

            // Validamos que el id del plan y el indice sean correctos
            if (validaActualizarAsistente($id, $indice, $mensaje)) {
                $idregalo = openssl_decrypt($_POST['idregalo'], COD, KEY);


                // Actualizamos el asistente
                $sesion->agregarAsistente(
                    $id,
                    $indice,
                    $_POST['doc_identidad'],
                    $_POST['nombre'],
                    $_POST['apellidopa'],
                    $_POST['apellidoma'],
                    $_POST['email'],
                    $_POST['telefono']
                );

                $mensaje = "Se apuntó a <strong>" . $_POST['nombre'] . "</strong>";

                if (is_numeric($idregalo)) {
                    $sesion->agregarRegalo(
                        $id,
                        $indice,
                        $idregalo
                    );
                    $mensaje .= " y regalo";
                } else {
                    if ($sesion->existeRegalo($id, $indice)) {
                        $sesion->eliminarRegalo($id, $indice);
                    }
                    $mensaje .= " y se quitó el regalo";
                }
            }
            break;

        case 'borrarAsistente':
            $id = openssl_decrypt($_POST['indice'], COD, KEY);
            $id = openssl_decrypt($_POST['id'], COD, KEY);

            if (validaActualizarAsistente($id, $indice, $mensaje)) {
                $sesion->eliminarAsistente($id, $indice);
            }

            break;
        default:
            $mensaje = "";
            break;
    }
    //print_r($_SESSION);
}

/**
 * Valida que los datos desencriptados sean correctos.
 * Devuelve true si lo son sino devuelve false
 */
function validoAumentarArticulo($id, $nombre, $precio, $stock, &$mensaje)
{
    if (!is_numeric($id)) {
        $mensaje .= "Upps... algo pasa con el id <br/>";
        return false;
    }

    if (!is_string($nombre)) {
        $mensaje .= "Upps... algo pasa con el nombre <br/>";
        return false;
    }

    if (!is_float($precio)) {
        $mensaje .= "Upps... algo pasa con el precio <br/>";
        return false;
    }

    if (!is_float($stock)) {
        $mensaje .= "Upps... algo pasa con el stock <br/>";
        return false;
    }
    return true;
}

function validoAumentarPlan($id, $nombre, $precio, &$mensaje)
{
    if (!is_numeric($id)) {
        $mensaje .= "Upps... algo pasa con el id <br/>";
        return false;
    }

    if (!is_string($nombre)) {
        $mensaje .= "Upps... algo pasa con el nombre <br/>";
        return false;
    }

    if (!is_float($precio)) {
        $mensaje .= "Upps... algo pasa con el precio <br/>";
        return false;
    }
    return true;
}

function validaActualizarAsistente($id, $indice, &$mensaje)
{
    if (!is_numeric($id)) {
        $mensaje .= "Upps... algo pasa con el id" . var_dump($id) . " <br/>";
        return false;
    }

    if (!is_numeric($indice)) {
        $mensaje .= "Upps... algo pasa con el indice <br/>";
        return false;
    }
    return true;
}
