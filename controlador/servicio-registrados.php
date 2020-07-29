<?php
// Modificado: 16/07/2020 13:17
//include_once 'sesiones.php';
include_once 'funciones-admin.php';

$sql = "SELECT fecha_creacion, COUNT(*) AS resultado FROM boleto GROUP BY DATE(fecha_creacion) ORDER BY fecha_creacion;";
$resultado = $conn->query($sql);

$arreglo_registros = array();
while ($registro_dia = $resultado->fetch_assoc()) {
  $fecha = $registro_dia['fecha_creacion'];
  $registro['fecha'] = date('Y-m-d', strtotime($fecha));
  $registro['cantidad'] = $registro_dia['resultado'];

  $arreglo_registros[] = $registro;
}
echo json_encode($arreglo_registros);
