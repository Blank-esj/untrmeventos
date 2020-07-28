<?php
// Modificado: 16/07/2020 13:17
//include_once 'sesiones.php';
include_once 'funciones-admin.php';

$sql = "SELECT DAY(fecha_creacion) fecha_registro, COUNT(*) AS resultado FROM boleto GROUP BY DATE(fecha_registro) ORDER BY fecha_registro;";
$resultado = $conn->query($sql);

$arreglo_registros = array();
while ($registro_dia = $resultado->fetch_assoc()) {
  $fecha = $registro_dia['fecha_registro'];
  $registro['fecha'] = date('Y-m-d', strtotime($fecha));
  $registro['cantidad'] = $registro_dia['resultado'];

  $arreglo_registros[] = $registro;
}
echo json_encode($arreglo_registros);
