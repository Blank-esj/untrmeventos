<?php include_once 'includes/templates/header.php'; ?>
  <section class="seccion contenedor">
    <h2>Calendario de Eventos</h2>
    <?php
      try{
      require_once('includes/funciones/bd_conexion.php');
      $sql = "SELECT id_evento, nombre_evento, fecha_evento, hora_evento, cat_evento, icono, nombre_invitado, apellidopa_invitado, apellidoma_invitado ";
      $sql .= "FROM evento ";
      $sql .= "INNER JOIN categoria_evento ";
      $sql .= "ON evento.id_cat_evento = categoria_evento.id_categoria ";
      $sql .= "INNER JOIN invitado ";
      $sql .= "ON evento.id_inv = invitado.id_invitado ";
      $sql .= "ORDER BY fecha_evento ";
      $resultado = $conn->query($sql);
      } catch (Exception $e) {
        $error = $e->getMessage();
      }
    ?>
  <div class="calendario">
    <?php
      //$calendario = array ();
      while($eventos = $resultado->fetch_all(MYSQLI_ASSOC)) { ?>
        <?php $dias = array(); ?>
        <?php foreach ($eventos as $evento) {
          $dias[] = $evento['fecha_evento'];
        } ?>
        <?php $dias = array_values(array_unique($dias)) ?>
        <?php $contador = 0; ?>
        <?php foreach($eventos as $evento): ?>
        <?php $dia_actual = $evento['fecha_evento']; ?>
        <?php if($dia_actual == $dias[$contador]): ?>
          <h3>
          <i class="fa fa-calendar" aria-hidden="true"></i>
          <?php echo $evento['fecha_evento']; ?>
          </h3>
          <?php $contador++; ?>
        <?php endif; ?>
          <div class = "dia">
            <p class = "titulo"> <?php echo utf8_decode(utf8_encode($evento['nombre_evento'])); ?></p>
            <p class = "hora"> 
              <i class = "fa fa-clock" aria-hidden = "true"></i>
              <?php echo $evento['fecha_evento'] . " " . $evento['hora_evento'] . "hrs"; ?>
            </p>
            <p>
              <?php $categoria_evento = $evento['cat_evento']; ?>
              <?php
                switch ($categoria_evento) {
                  case 'Talleres':
                    echo '<i class="fa fa-code" aria-hidden="true"></i> Taller';
                  break;
                  case 'Conferencias':
                    echo '<i class="fa fa-comment" aria-hidden="true"></i> Conferencias';
                  break;
                  case 'Seminario':
                    echo '<i class="fa fa-university" aria-hidden="true"></i> Seminarios';
                  break;
                  default:
                    echo "";
                  break;
                }
              ?>
            </p>
            <p> 
              <i class = "fa fa-user" aria-hidden = "true"></i>
                <?php echo $evento['nombre_invitado'] . " " . $evento['apellidopa_invitado'] . " " . $evento['apellidoma_invitado']; ?>
            </p>
          </div>
        <?php endforeach; ?> <!--fin foreach eventos-->
  </div>
  <?php }?>
  <?php $conn->close(); ?>
  </section> <!--.seccion-->
<?php include_once 'includes/templates/footer.php'; ?>