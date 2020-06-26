<?php include_once 'plantillas/header-evento.php'; ?>
<section class="seccion contenedor">
  <h2>Calendario de Eventos</h2>
  <?php
  try {
    require_once('../controlador/bd_conexion.php');
    /** Traemos todos los eventos */
    $sql = "SELECT id_evento, nombre_evento, fecha_evento, hora_evento, cat_evento, icono, nombre_invitado, apellidopa_invitado, apellidoma_invitado ";
    $sql .= "FROM evento ";
    $sql .= "INNER JOIN categoria_evento ";
    $sql .= "ON evento.id_cat_evento = categoria_evento.id_categoria ";
    $sql .= "INNER JOIN invitado ";
    $sql .= "ON evento.id_inv = invitado.id_invitado ";
    $sql .= "ORDER BY fecha_evento ";
    /** Y lo guardamos en la variable resultado */
    $resultado = $conn->query($sql);
  } catch (Exception $e) {
    $error = $e->getMessage();
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
        <?php $fecha =  $evento['fecha_evento'];?>
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
            <?php echo $evento['nombre_invitado'] . " " . $evento['apellidopa_invitado'] . " " . $evento['apellidoma_invitado']; ?>
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
<?php include_once 'plantillas/footer-evento.php'; ?>