<?php
if (isset($_GET['paymentToken']) && isset($_GET['paymentID'])) {
  include_once 'controlador/global/config.php';
  include_once 'controlador/bd_conexion_pdo.php';
  include_once 'modelo/venta.php';
  include_once 'plantillas/registro/registro-pago-verificador.php';
} elseif (procederPagar()) {
  include_once 'plantillas/registro/registro-pago-proceder.php'; // Proceder el pago
} else {
  include_once 'plantillas/registro/registro-inicio.php'; // Página de inicio de Registro
}

function procederPagar()
{
  if (!$_POST) return false; // Si no se ha solicitado datos por POST

  // Si en el array de POST no hay ninguno que tenga por clave 'registrarAsistente'
  if (!isset($_POST['registrarAsistente'])) return false;

  // Si se está solicitando datos por POST para registrar el asistente
  // pero no es para proceder a pagar vamos a inicio
  // Sino iremos a la página para proceder con el pago
  return ($_POST['registrarAsistente'] == 'procederPagar') ? true : false;
}
