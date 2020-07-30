<section class="seccion contenedor">
  <h2>Calendario de Eventos</h2>
  <?php
  try {
    require_once('controlador/util/bd_conexion.php');
    /** Traemos todos los eventos */
    $sql = "SELECT * FROM v_detalle_evento ORDER BY fecha_evento ASC; ";
    /** Y lo guardamos en la variable resultado */
    $resultado = $conn->query($sql);
  } catch (Exception $e) {
    $error = $e->getMessage();
    echo $error;
  }
  ?>
  <div class="calendario">
    <?php
    //$calendario = array ();
    /** iteramos en cada evento */
    while ($eventos = $resultado->fetch_all(MYSQLI_ASSOC)) { ?>
      <?php $fechaAnterior = "" ?>
      <?php $fecha = "" ?>
      <?php foreach ($eventos as $evento) : ?>
        <?php $fecha =  $evento['fecha_evento']; ?>
        <?php $dia_actual = $evento['fecha_evento']; ?>
        <?php if ($fecha != $fechaAnterior) : ?>
          <h3>
            <i class="fa fa-calendar" aria-hidden="true"></i>
            <?php echo $evento['fecha_evento']; ?>
          </h3>
        <?php endif; ?>
        <div class="dia">
          <p class="titulo"> <?php echo utf8_decode(utf8_encode($evento['nombre_evento'])); ?></p>
          <p class="hora">
            <i class="fa fa-clock" aria-hidden="true"></i>
            <?php echo $evento['fecha_evento'] . " " . $evento['hora_evento'] . "hrs"; ?>
          </p>
          <p>
            <?php echo '<i class="fa ' . $evento['icono'] . '" aria-hidden="true"></i> ' . $evento['cat_evento']; ?>
          </p>
          <p>
            <i class="fa fa-user" aria-hidden="true"></i>
            <?php echo $evento['nombres'] . " " . $evento['apellidopa'] . " " . $evento['apellidoma']; ?>
          </p>
        </div>
        <?php $fechaAnterior = $fecha ?>
      <?php endforeach; ?>
      <!--fin foreach eventos-->
  </div>
<?php } ?>
<?php $conn->close(); ?>
</section>
<!--.seccion-->