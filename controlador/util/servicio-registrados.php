<?php
// Modificado: 30/07/2020 15:36
// Este archivo se llama con los ".." porque es llamado por un archivo js
include_once '../global/config.php';
$conn = new mysqli(SERVIDOR, USUARIO, CONTRASENA, BASEDATOS);

$sql = "SELECT b.fecha_creacion, COUNT(*) AS resultado 
        FROM boleto b, venta v
        WHERE v.idventa = b.idventa
        AND v.estado = 'completo'
        GROUP BY DATE (b.fecha_creacion) 
        ORDER BY b.fecha_creacion;";
$resultado = $conn->query($sql);

$arreglo_registros = array();
while ($registro_dia = $resultado->fetch_assoc()) {
  $fecha = $registro_dia['fecha_creacion'];
  $registro['fecha'] = date('Y-m-d', strtotime($fecha));
  $registro['cantidad'] = $registro_dia['resultado'];

  $arreglo_registros[] = $registro;
}
echo json_encode($arreglo_registros);
