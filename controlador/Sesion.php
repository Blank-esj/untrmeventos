<?php

/**
 * Clase para manejar las sesion
 */
class Sesion
{
    public function __construct()
    {
    }

    private function sesion()
    {
        return $_SESSION[SESION];
    }

    /**
     * Retorna TRUE si existe el array raiz creado
     * Sino retorna FALSE
     */
    public function existe(): bool
    {
        return isset($_SESSION[SESION]);
    }

    /**Leer todos los planes */
    public function leerPlanes()
    {
        return $this->sesion()[N_PLANES];
    }

    /** Lee un plan pasandole su ID */
    public function leerPlan($idPlan)
    {
        return $this->leerPlanes()[$idPlan];
    }

    /** lee el nombre de un plan pasandole su ID */
    public function leerNombrePlan($idPlan)
    {
        return $this->leerPlan($idPlan)[N_NOMBRE_PLAN];
    }

    /** lee el precio de un plan pasandole su ID */
    public function leerPrecioPlan($idPlan)
    {
        return $this->leerPlan($idPlan)[N_PRECIO_PLAN];
    }

    /** lee todos los asistentes de un plan pasandole su ID */
    public function leerAsistentesPlan($idPlan)
    {
        return $this->leerPlan($idPlan)[N_ASISTENTES_PLAN];
    }

    /** lee el asistente de un plan pasandole su ID */
    public function leerAsistente($idPlan, $indice)
    {
        return $this->leerAsistentesPlan($idPlan)[$indice];
    }

    /** lee el indice que contiene al array asistente de un plan pasandole su ID del plan y el indice
     * que contiene ese asistente
     */
    public function leerDocIdentidadAsistente($idPlan, $indice)
    {
        return $this->leerAsistente($idPlan, $indice)[N_DOC_IDENTIDAD_ASISTENTE];
    }

    /** lee el nombre de asistente de un plan pasandole su ID del plan y el indice
     * que contiene ese asistente
     */
    public function leerNombreAsistente($idPlan, $indice)
    {
        return $this->leerAsistente($idPlan, $indice)[N_NOMBRE_ASISTENTE];
    }

    /** lee el Apellido Paterno de asistente de un plan pasandole su 
     * ID del plan y el indice que contiene al array asistente
     */
    public function leerApellidoPaAsistente($idPlan, $indice)
    {
        return $this->leerAsistente($idPlan, $indice)[N_APELLIDOPA_ASISTENTE];
    }

    /** lee el Apellido Materno de asistente de un plan pasandole su 
     * ID del plan y el indice que contiene al array asistente
     */
    public function leerApellidoMaAsistente($idPlan, $indice)
    {
        return $this->leerAsistente($idPlan, $indice)[N_APELLIDOMA_ASISTENTE];
    }

    /** lee el Email de asistente de un plan pasandole su 
     * ID del plan y el indice que contiene al array asistente
     */
    public function leerEmailAsistente($idPlan, $indice)
    {
        return $this->leerAsistente($idPlan, $indice)[N_EMAIL_ASISTENTE];
    }

    /** lee el Telefono de asistente de un plan pasandole su 
     * ID del plan y el indice que contiene al array asistente
     */
    public function leerTelefonoAsistente($idPlan, $indice)
    {
        return $this->leerAsistente($idPlan, $indice)[N_TELEFONO_ASISTENTE];
    }

    /** lee el Regalo de un asistente de un plan pasandole su 
     * ID del plan y el indice que contiene al array asistente
     */
    public function leerRegaloAsistente($idPlan, $indice)
    {
        return $this->leerAsistente($idPlan, $indice)[N_REGALO_ASISTENTE];
    }

    /** lee el Id de un regalo pasandole su 
     * ID del plan y el indice que contiene al array asistente
     */
    public function leerIdRegalo($idPlan, $indice)
    {
        return $this->leerRegaloAsistente($idPlan, $indice)[N_ID_REGALO];
    }

    /** lee todos los articulos
     */
    public function leerArticulos()
    {
        return $this->sesion()[N_ARTICULOS];
    }

    /** lee un articulo pasandole su Id
     */
    public function leerArticulo($idArticulo)
    {
        return $this->leerArticulos()[$idArticulo];
    }

    /** lee nombre de un articulo pasandole si Id
     */
    public function leerNombreArticulo($idArticulo)
    {
        return $this->leerArticulo($idArticulo)[N_NOMBRE_ARTICULO];
    }

    /** lee cantidad de un articulo pasandole si Id
     */
    public function leerCantidadArticulo($idArticulo)
    {
        return isset($_SESSION[SESION][N_ARTICULOS][$idArticulo][N_CANTIDAD_ARTICULO]) ?
            $this->leerArticulo($idArticulo)[N_CANTIDAD_ARTICULO] : 0;
    }

    /** lee precio de un articulo pasandole si Id
     */
    public function leerPrecioArticulo($idArticulo)
    {
        return $this->leerArticulo($idArticulo)[N_PRECIO_ARTICULO];
    }

    //  ----------------------------------------------------------

    /** agrega un plan a la lista pasandole el idPlan. Cuando el usuario le da click al card plan.
     * @param string $idPlan id del plan
     * @param string $nombre nombre del plan
     * @param float $precio precio del plan
     * @param array $asistentes asistentes del plan
     * ```
     * // Ejemplo
     * "idPlan" => array (
     *      "nombre" => nombre,
     *      "precio" => precio,
     *      "asistentes" => array ()
     * )
     * ```
     */
    public function agregarPlan($idPlan, $nombre, $precio)
    {
        $_SESSION[SESION][N_PLANES][$idPlan][N_NOMBRE_PLAN] = $nombre;
        $_SESSION[SESION][N_PLANES][$idPlan][N_PRECIO_PLAN] = $precio;

        if ($this->existeAsistentesPlan($idPlan)) {
            $_SESSION[SESION][N_PLANES][$idPlan][N_ASISTENTES_PLAN][count($_SESSION[SESION][N_PLANES][$idPlan][N_ASISTENTES_PLAN])] =
                [
                    N_DOC_IDENTIDAD_ASISTENTE => "",
                    N_NOMBRE_ASISTENTE => "",
                    N_APELLIDOPA_ASISTENTE => "",
                    N_APELLIDOMA_ASISTENTE => "",
                    N_EMAIL_ASISTENTE => "",
                    N_TELEFONO_ASISTENTE => ""
                ];
        } else {
            $_SESSION[SESION][N_PLANES][$idPlan][N_ASISTENTES_PLAN][0] =
                [
                    N_DOC_IDENTIDAD_ASISTENTE => "",
                    N_NOMBRE_ASISTENTE => "",
                    N_APELLIDOPA_ASISTENTE => "",
                    N_APELLIDOMA_ASISTENTE => "",
                    N_EMAIL_ASISTENTE => "",
                    N_TELEFONO_ASISTENTE => ""
                ];
        }
    }

    /** 
     * Agrega un asistente a un plan a la lista pasandole el id del plan y el indice que contiene al array asistente
     * @param string $idPlan id del plan
     * @param string $indice Documento de identidad del asisitente
     * @param string $nombre Nombre del Asistente
     * @param string $apellidopa Apellido Paterno
     * @param string $apellidoma Apellido Materno
     * @param string $email Email del asistente
     * @param string $telefono Telefono del asistente
     * @param array $regalo Array del regalo
     * ```
     * // Ejemplo
     * "64392348" => (
     *     "nombre" => "Jhon Doe",
     *     "apellidopa" => "Cupertino",
     *     "apellidoma" => "Davez",
     *     "email" => "jhondoecuper@gmail.com",
     *     "telefono" => "965785432",
     *     "regalo" => array()
     * )
     * ```
     */
    public function agregarAsistente(
        $idPlan,
        $indice,
        $doc_identidad,
        $nombre,
        $apellidopa,
        $apellidoma,
        $email,
        $telefono
    ) {
        $_SESSION[SESION][N_PLANES][$idPlan][N_ASISTENTES_PLAN][$indice][N_DOC_IDENTIDAD_ASISTENTE] = $doc_identidad;
        $_SESSION[SESION][N_PLANES][$idPlan][N_ASISTENTES_PLAN][$indice][N_NOMBRE_ASISTENTE] = $nombre;
        $_SESSION[SESION][N_PLANES][$idPlan][N_ASISTENTES_PLAN][$indice][N_APELLIDOPA_ASISTENTE] = $apellidopa;
        $_SESSION[SESION][N_PLANES][$idPlan][N_ASISTENTES_PLAN][$indice][N_APELLIDOMA_ASISTENTE] = $apellidoma;
        $_SESSION[SESION][N_PLANES][$idPlan][N_ASISTENTES_PLAN][$indice][N_EMAIL_ASISTENTE] = $email;
        $_SESSION[SESION][N_PLANES][$idPlan][N_ASISTENTES_PLAN][$indice][N_TELEFONO_ASISTENTE] = $telefono;
    }


    /** agrega un regalo al asistente pasandole el idPlan y indice que contiene al array asistente
     * @param string $idPlan id del plan
     * @param string $indice Documento de identidad del asisitente
     * @param int $id id del regalo
     * @param string $nombre nombre del regalo
     * ```
     * // Ejemplo
     * "regalo" => array (
     *     "id" => 4,
     *     "nombre" => "stickes"
     * )
     * ```
     */
    public function agregarRegalo($idPlan, $indice, $id)
    {
        $_SESSION[SESION][N_PLANES][$idPlan][N_ASISTENTES_PLAN][$indice][N_REGALO_ASISTENTE][N_ID_REGALO] = $id;
    }

    /** Agrega un nuevo articulo tomando como el ID del nodo el id del articulo.
     * Si el nodo ya existe se reemplazarán los datos existentes
     */
    public function agregarArticulo($idArticulo, $nombre, $precio, $cantidad)
    {
        $_SESSION[SESION][N_ARTICULOS][$idArticulo] = [];
        $_SESSION[SESION][N_ARTICULOS][$idArticulo][N_NOMBRE_ARTICULO] = $nombre;
        $_SESSION[SESION][N_ARTICULOS][$idArticulo][N_PRECIO_ARTICULO] = $precio;
        $_SESSION[SESION][N_ARTICULOS][$idArticulo][N_CANTIDAD_ARTICULO] = $cantidad;
    }

    /** Suma la cantidad que le pases por paramentro a la cantidad que ya tiene el articulo */
    public function sumarCantidadArticulo($idArticulo, $cantidad)
    {
        $_SESSION[SESION][N_ARTICULOS][$idArticulo][N_CANTIDAD_ARTICULO] =
            $this->leerCantidadArticulo($idArticulo) + $cantidad;
    }

    /**
     * Devuelve true si hay planes agregados existe de lo contrario false
     */
    public function existePlanes()
    {
        return isset($_SESSION[SESION][N_PLANES]) ? true : false;
    }

    /**
     * Devuelve true si el plan existe de lo contrario false
     * @param mixed $idPlan id del articulo a evaluar
     */
    public function existePlan($idPlan)
    {
        return ($this->leerPlan($idPlan) !== null) ? true : false;
    }

    /**
     * Devuelve true si el articulo existe de lo contrario false
     * @param mixed $idArticulo id del articulo a evaluar
     */
    public function existeArticulo($idArticulo)
    {
        return isset($_SESSION[SESION][N_ARTICULOS][$idArticulo]);
    }

    public function existeCantidadArticulo($idArticulo)
    {
        return isset($_SESSION[SESION][N_ARTICULOS][$idArticulo][N_CANTIDAD_ARTICULO]);
    }

    /**
     * Evalúa todos los planes y busca y existe algún asistente en estos.
     * Devuelve true si existe algún asiste en alguno de todos
     */
    public function existeAsistentes()
    {
        if ($this->existePlanes()) {
            foreach ($this->leerPlanes() as $idPlan => $arrayPlan) {
                if ($this->existeAsistentesPlan($idPlan))
                    return true;
            }
        }
        return false;
    }

    /**
     * Devuelve true si el plan tiene asistentes de lo contrario devuelve false
     * @param mixed $idPlan id del plan que se desea evaluar
     */
    public function existeAsistentesPlan($idPlan)
    {
        return isset($_SESSION[SESION][N_PLANES][$idPlan][N_ASISTENTES_PLAN]);
    }

    /**
     * Devuelve true si el plan tiene asistentes de lo contrario devuelve false
     * @param mixed $idPlan id del plan que se desea evaluar
     */
    public function existeAsistentePlan($idPlan, $indice)
    {
        return ($this->leerPlanes($idPlan)[$indice] !== null) ? true : false;
    }

    /**
     * Devuelve true si el asistente tiene algún regalo sino retornará false
     * @param mixed $idPlan id del plan que se desea evaluar
     * @param mixed $indice indice o id que contiene al asistente
     */
    public function existeRegalo($idPlan, $indice)
    {
        return isset($_SESSION[SESION][N_PLANES][$idPlan][N_ASISTENTES_PLAN][$indice][N_REGALO_ASISTENTE]) ? true : false;
    }

    /**
     * Elimina un plan del array de planes
     * @param mixed $idPlan id del plan a elimnar
     */
    public function eliminarPlan($idPlan)
    {
        if (count($_SESSION[SESION][N_PLANES]) === 1) {
            unset($_SESSION[SESION][N_PLANES]);
        } else {
            unset($_SESSION[SESION][N_PLANES][$idPlan]);
        }
    }

    /**
     * Elimina un asistente del array del plan según el idPlan que le pases por parámetro
     * @param mixed $idPlan id del plan a elimnar
     * @param mixed $indice indice que contiene al array asistente
     */
    public function eliminarAsistente($idPlan, $indice)
    {
        if (count($this->leerAsistentesPlan($idPlan)) <= 1) {
            $this->eliminarPlan($idPlan);
        } else {
            array_splice($_SESSION[SESION][N_PLANES][$idPlan][N_ASISTENTES_PLAN], $indice, 1);
        }
    }

    /**
     * Devuelve true si hay articulos agregados de lo contrario retorna false
     */
    public function existeArticulos()
    {
        return isset($_SESSION[SESION][N_ARTICULOS]) ? true : false;
    }

    /**
     * Elimina un regalo del array asistente del plan según el idPlan que le pases por parámetro
     * @param mixed $idPlan id del plan a elimnar
     * @param mixed $indice indice que contiene al array asistente
     */
    public function eliminarRegalo($idPlan, $indice)
    {
        unset($_SESSION[SESION][N_PLANES][$idPlan][N_ASISTENTES_PLAN][$indice][N_REGALO_ASISTENTE]);
    }

    /**
     * Elimina un articulo del array de sesión según el idArticulo que le pases por parámetro
     * @param mixed $idPlan id del plan a elimnar
     * @param mixed $indice indice que contiene al array asistente
     */
    public function eliminarArticulo($idArticulo)
    {
        unset($_SESSION[SESION][N_ARTICULOS][$idArticulo]);
    }


    /**
     * 
     * Devuelve un array con los subtotales de plan y articulos, un ejemplo a continuación
     * ```
     * [0] => [
     *  "nombre" => "Todos los días + combo",
     *  "tipo" => "Plan",
     *  "cantidad" => 4,
     *  "precio" => 350,
     *  "subtotal" => 1400,
     * ],
     * [1] => [
     *  "nombre" => "Camisa",
     *  "tipo" => "Articulo",
     *  "cantidad" => 8,
     *  "precio" => 50,
     *  "subtotal" => 400,
     * ];
     * ```
     * 
     */
    public function subtotal()
    {
        $subtotal = [];
        $indice = 0;
        if ($this->existePlanes()) {
            foreach ($this->leerPlanes() as $arrayPlan) {
                $subtotal[$indice] = [
                    "nombre" => $arrayPlan[N_NOMBRE_PLAN],
                    "tipo" => N_PLANES,
                    "cantidad" => count($arrayPlan[N_ASISTENTES_PLAN]),
                    "precio" => $arrayPlan[N_PRECIO_PLAN],
                    "subtotal" => ($arrayPlan[N_PRECIO_PLAN] * count($arrayPlan[N_ASISTENTES_PLAN]))
                ];
                $indice++;
            }
        }

        if ($this->existeArticulos()) {
            foreach ($this->leerArticulos() as $arrayArticulo) {
                $subtotal[$indice] = [
                    "nombre" => $arrayArticulo[N_NOMBRE_ARTICULO],
                    "tipo" => N_ARTICULOS,
                    "cantidad" => $arrayArticulo[N_CANTIDAD_ARTICULO],
                    "precio" => $arrayArticulo[N_PRECIO_ARTICULO],
                    "subtotal" => ($arrayArticulo[N_PRECIO_ARTICULO] * $arrayArticulo[N_CANTIDAD_ARTICULO])
                ];
                $indice++;
            }
        }

        return $subtotal;
    }

    /**
     * Retorna la cantidad de pepido que tiene en el carrito
     */
    public function cantidadTotal()
    {
        $total = 0;
        foreach (array_column($this->subtotal(), "cantidad") as $value) {
            $total += $value;
        }
        return $total;
    }

    /**
     * Retorna el total a pagar
     */
    public function total()
    {
        $total = 0;
        // Obtenemos el total
        foreach ($this->subtotal() as $subtotales) {
            $total += $subtotales['subtotal'];
        }
        return $total;
    }

    /**
     * Retorna true si existe usuario
     */

    public function existeUsuario()
    {
        return isset($_SESSION[SESION][N_USUARIO]);
    }

    /**
     * retorna un arreglo con los datos del usuario
     */
    public function leerUsuario()
    {
        return $_SESSION[SESION][N_USUARIO];
    }

    public function leerUsuarioUsuario()
    {
        return $this->leerUsuario()[N_USUARIO_USUARIO];
    }

    public function leerNombreUsuario()
    {
        return $this->leerUsuario()[N_NOMBRE_USUARIO];
    }

    public function leerContrasenaUsuario()
    {
        return $this->leerUsuario()[N_CONTRASENA_USUARIO];
    }

    public function leerNivelUsuario()
    {
        return $this->leerUsuario()[N_NIVEL_USUARIO];
    }

    public function leerIdUsuario()
    {
        return $this->leerUsuario()[N_ID_USUARIO];
    }

    public function agregarUsuario($id, $usuario, $contrasena, $nombre, $nivel)
    {
        $_SESSION[SESION][N_USUARIO][N_ID_USUARIO] = $id;
        $_SESSION[SESION][N_USUARIO][N_USUARIO_USUARIO] = $usuario;
        $_SESSION[SESION][N_USUARIO][N_CONTRASENA_USUARIO] = $contrasena;
        $_SESSION[SESION][N_USUARIO][N_NOMBRE_USUARIO] = $nombre;
        $_SESSION[SESION][N_USUARIO][N_NIVEL_USUARIO] = $nivel;
    }

    public function eliminarUsuario($id)
    {
        unset($_SESSION[SESION][N_USUARIO]);
    }
}
