<?php
include 'modelo/modelo-registrado.php';
include 'controlador/bd_conexion.php';
//$sesion = new Sesion(); // Instanciamos la clase Sesion
?>

<section class="seccion container-fluid">
  <h2>Registro de Asistentes</h2>

  <ul class="nav nav-tabs justify-content-end" id="myTab" role="tablist">
    <li class="nav-item" role="presentation">
      <a class="nav-link active" id="tab-planes" data-toggle="pill" href="#pill-planes" role="tab" aria-controls="pill-planes" aria-selected="true">
        <i class="material-icons">psychology</i>
        Planes
      </a>
    </li>
    <li class="nav-item" role="presentation">
      <a class="nav-link" id="tab-asistentes" data-toggle="pill" href="#pills-asistentes" role="tab" aria-controls="pills-asistentes" aria-selected="false">
        <i class="material-icons">people</i>
        Asistente
      </a>
    </li>
    <li class="nav-item" role="presentation">
      <a class="nav-link" id="tab-extras" data-toggle="pill" href="#pills-extras" role="tab" aria-controls="pills-extras" aria-selected="false">
        <i class="material-icons">shopping_bag</i>
        Extra
      </a>
    </li>
    <li class="nav-item" role="presentation">
      <a class="nav-link" id="tab-pago" data-toggle="pill" href="#pills-pago" role="tab" aria-controls="pills-pago" aria-selected="false">
        <i class="material-icons">shopping_cart</i>
        Carrito
      </a>
    </li>
  </ul>
  <div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active container-fluid" id="pill-planes" role="tabpanel" aria-labelledby="tab-planes">
      <?php include_once 'plantillas/registro/registro-plan.php' ?>
    </div>
    <div class="tab-pane fade container-fluid" id="pills-asistentes" role="tabpanel" aria-labelledby="tab-asistentes">
      <?php include_once 'plantillas/registro/registro-extras.php' ?>
    </div>
    <div class="tab-pane fade container-fluid" id="pills-extras" role="tabpanel" aria-labelledby="tab-extras">
      <?php include_once 'plantillas/registro/registro-asistentes.php' ?>
    </div>
    <div class="tab-pane fade container-fluid" id="pills-pago" role="tabpanel" aria-labelledby="tab-pago">
      <?php include_once 'plantillas/registro/registro-pago.php' ?>
    </div>
  </div>

</section>