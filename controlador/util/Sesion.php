<?php
class Sesion
{
    public function __construct()
    {
        if (!session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    private function sesion()
    {
        return $_SESSION[SESION];
    }

    /**Leer todos los planes */
    public function leerPlanes()
    {
        return $this->sesion()['planes'];
    }

    /** Lee un plan pasandole su ID */
    public function leerPlan($idPlan): array
    {
        return $this->leerPlanes()[$idPlan];
    }

    /** lee el nombre de un plan pasandole su ID */
    public function leerNombrePlan($idPlan): string
    {
        return $this->leerPlan($idPlan)['nombre'];
    }

    /** lee el precio de un plan pasandole su ID */
    public function leerPrecioPlan($idPlan): string
    {
        return $this->leerPlan($idPlan)['precio'];
    }

    /** lee todos los asistentes de un plan pasandole su ID */
    public function leerAsistentesPlan($idPlan)
    {
        return $this->leerPlan($idPlan)['asistentes'];
    }

    /** lee el asistente de un plan pasandole su ID */
    public function leerAsistente($idPlan, $doc_identidad): array
    {
        return $this->leerAsistentesPlan($idPlan)[$doc_identidad];
    }

    /** lee el nombre de asistente de un plan pasandole su ID del plan y el documento de 
     * identidad del asistente
     */
    public function leerNombreAsistente($idPlan, $doc_identidad): string
    {
        return $this->leerAsistente($idPlan, $doc_identidad)['nombre'];
    }

    /** lee el Apellido Paterno de asistente de un plan pasandole su 
     * ID del plan y el documento de identidad del asistente
     */
    public function leerApellidoPaAsistente($idPlan, $doc_identidad): string
    {
        return $this->leerAsistente($idPlan, $doc_identidad)['apellidopa'];
    }

    /** lee el Apellido Materno de asistente de un plan pasandole su 
     * ID del plan y el documento de identidad del asistente
     */
    public function leerApellidoMaAsistente($idPlan, $doc_identidad): string
    {
        return $this->leerAsistente($idPlan, $doc_identidad)['apellidoma'];
    }

    /** lee el Email de asistente de un plan pasandole su 
     * ID del plan y el documento de identidad del asistente
     */
    public function leerEmailAsistente($idPlan, $doc_identidad): string
    {
        return $this->leerAsistente($idPlan, $doc_identidad)['email'];
    }

    /** lee el Telefono de asistente de un plan pasandole su 
     * ID del plan y el documento de identidad del asistente
     */
    public function leerTelefonoAsistente($idPlan, $doc_identidad): string
    {
        return $this->leerAsistente($idPlan, $doc_identidad)['telefono'];
    }

    /** lee el Telefono de asistente de un plan pasandole su 
     * ID del plan y el documento de identidad del asistente
     */
    public function leerRegaloAsistente($idPlan, $doc_identidad): array
    {
        return $this->leerAsistente($idPlan, $doc_identidad)['regalo'];
    }

    /** lee el Id de un regalo pasandole su 
     * ID del plan y el documento de identidad del asistente
     */
    public function leerIdRegalo($idPlan, $doc_identidad): array
    {
        return $this->leerRegaloAsistente($idPlan, $doc_identidad)['id'];
    }

    /** lee el Nombre de un regalo pasandole su 
     * ID del plan y el documento de identidad del asistente
     */
    public function leerNombreRegalo($idPlan, $doc_identidad): array
    {
        return $this->leerRegaloAsistente($idPlan, $doc_identidad)['id'];
    }

    /** lee todos los articulos
     */
    public function leerArticulos(): array
    {
        return $this->sesion()['articulos'];
    }

    /** lee un articulo pasandole su Id
     */
    public function leerArticulo($idArticulo): array
    {
        return $this->leerArticulos()[$idArticulo];
    }

    /** lee nombre de un articulo pasandole si Id
     */
    public function leerNombreArticulo($idArticulo): string
    {
        return $this->leerArticulo($idArticulo)['nombre'];
    }

    /** lee cantidad de un articulo pasandole si Id
     */
    public function leerCantidadArticulo($idArticulo): float
    {
        return $this->leerArticulo($idArticulo)['cantidad'];
    }

    /** lee precio de un articulo pasandole si Id
     */
    public function leerPrecioArticulo($idArticulo): float
    {
        return $this->leerArticulo($idArticulo)['precio'];
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
    public function agregarPlan($idPlan, $nombre, $precio, $asistentes = null)
    {
        $_SESSION[SESION]['planes'][$idPlan]['nombre'] = $nombre;
        $_SESSION[SESION]['planes'][$idPlan]['precio'] = $precio;
        $_SESSION[SESION]['planes'][$idPlan]['asistentes'] = $asistentes;
    }

    /** 
     * Agrega un asistente a un plan a la lista pasandole el id del plan y el documento de identidad del asistente
     * @param string $idPlan id del plan
     * @param string $doc_identidad Documento de identidad del asisitente
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
        $doc_identidad,
        $nombre,
        $apellidopa,
        $apellidoma,
        $email,
        $telefono,
        $regalo = null
    ) {
        $this->sesion()['planes'][$idPlan][$doc_identidad]['nombre'] = $nombre;
        $this->sesion()['planes'][$idPlan][$doc_identidad]['apellidopa'] = $apellidopa;
        $this->sesion()['planes'][$idPlan][$doc_identidad]['apellidoma'] = $apellidoma;
        $this->sesion()['planes'][$idPlan][$doc_identidad]['email'] = $email;
        $this->sesion()['planes'][$idPlan][$doc_identidad]['telefono'] = $telefono;
        $this->sesion()['planes'][$idPlan][$doc_identidad]['regalo'] = $regalo;
    }


    /** agrega un regalo al asistente pasandole el idPlan y documento de identidad del asistente
     * @param string $idPlan id del plan
     * @param string $doc_identidad Documento de identidad del asisitente
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
    public function agregarRegalo($idPlan, $doc_identidad, $id, $nombre)
    {
        $this->sesion()['planes'][$idPlan][$doc_identidad]['regalo']['id'] = $id;
        $this->sesion()['planes'][$idPlan][$doc_identidad]['regalo']['nombre'] = $nombre;
    }

    public function agregarArticulo()
    {
    }

    /**
     * Elimina un plan del array de planes
     * @param mixed $idPlan id del plan a elimnar
     */
    public function eliminarPlan($idPlan)
    {
        unset($this->leerPlanes()[$idPlan]);
    }

    /**
     * Elimina un asistente del array del plan según el idPlan que le pases por parámetro
     * @param mixed $idPlan id del plan a elimnar
     * @param mixed $doc_identidad documento de identidad del asistente
     */
    public function eliminarAsistente($idPlan, $doc_identidad)
    {
        unset($this->leerAsistentesPlan($idPlan)[$doc_identidad]);
    }

    /**
     * Elimina un regalo del array asistente del plan según el idPlan que le pases por parámetro
     * @param mixed $idPlan id del plan a elimnar
     * @param mixed $doc_identidad documento de identidad del asistente
     */
    public function eliminarRegalo($idPlan, $doc_identidad)
    {
        $this->leerAsistente($idPlan, $doc_identidad)['regalo'] = null;
    }

    /**
     * Elimina un articulo del array de sesión según el idArticulo que le pases por parámetro
     * @param mixed $idPlan id del plan a elimnar
     * @param mixed $doc_identidad documento de identidad del asistente
     */
    public function eliminarArticulo($idArticulo)
    {
        unset($this->leerArticulos()[$idArticulo]);
    }
}
