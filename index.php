<?php
session_start();
require_once 'controlador/util/plantilla-controlador.php';

$plantilla = new ControladorPlantilla();
$plantilla->ctrPlantilla();
