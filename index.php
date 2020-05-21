<?php include_once 'includes/templates/header.php'; ?>
  <section class="seccion contenedor">
    <h2>Curso Taller - Objetivo</h2>
    <p>
      Capacitar a los participantes en el desarrollo de tesis en ingeniería, a fin de incrementar el número de graduados y titulados por tesis.
    </p>
  </section> <!--.seccion contenedor-->

  <section class="programa">
    <div class="contenedor-img">
      <img src="img/bg-talleres.jpg">
    </div> <!--.contenedor-img-->
    <div class="contenido-programa">
      <div class="contenedor">
        <div class="programa-evento">
          <h2>Contenido del Evento</h2>
            <?php
              try{
              require_once('includes/funciones/bd_conexion.php');
              $sql = "SELECT * FROM categoria_evento ";
              $resultado = $conn->query($sql);
              } catch (Exception $e) {
                $error = $e->getMessage();
              }
            ?>
          <nav class="menu-programa">
            <?php while($cat = $resultado->fetch_array(MYSQLI_ASSOC)) { ?>
              <?php $categoria = $cat['cat_evento']; ?>
                <a href="#<?php echo strtolower($categoria) ?>"> 
                <i class="fa <?php echo $cat['icono'] ?>" aria-hidden="true"></i> <?php echo $categoria ?>
                </a>
              <?php } ?>
          </nav> <!--.menu-programa-->
          <?php
            try{
            require_once('includes/funciones/bd_conexion.php');
            $sql = "SELECT id_evento, nombre_evento, fecha_evento, hora_evento, cat_evento, icono, nombre_invitado, apellidopa_invitado, apellidoma_invitado ";
            $sql .= "FROM evento ";
            $sql .= "INNER JOIN categoria_evento ";
            $sql .= "ON evento.id_cat_evento = categoria_evento.id_categoria ";
            $sql .= "INNER JOIN invitado ";
            $sql .= "ON evento.id_inv = invitado.id_invitado ";
            $sql .= "AND evento.id_cat_evento = 1 ";
            $sql .= "ORDER BY id_evento LIMIT 2;";
            $sql .= "SELECT id_evento, nombre_evento, fecha_evento, hora_evento, cat_evento, icono, nombre_invitado, apellidopa_invitado, apellidoma_invitado ";
            $sql .= "FROM evento ";
            $sql .= "INNER JOIN categoria_evento ";
            $sql .= "ON evento.id_cat_evento = categoria_evento.id_categoria ";
            $sql .= "INNER JOIN invitado ";
            $sql .= "ON evento.id_inv = invitado.id_invitado ";
            $sql .= "AND evento.id_cat_evento = 2 ";
            $sql .= "ORDER BY id_evento LIMIT 2;";
            $sql .= "SELECT id_evento, nombre_evento, fecha_evento, hora_evento, cat_evento, icono, nombre_invitado, apellidopa_invitado, apellidoma_invitado ";
            $sql .= "FROM evento ";
            $sql .= "INNER JOIN categoria_evento ";
            $sql .= "ON evento.id_cat_evento = categoria_evento.id_categoria ";
            $sql .= "INNER JOIN invitado ";
            $sql .= "ON evento.id_inv = invitado.id_invitado ";
            $sql .= "AND evento.id_cat_evento = 3 ";
            $sql .= "ORDER BY id_evento LIMIT 2;";
            } catch (Exception $e) {
              $error = $e->getMessage();
            }
          ?>
          <?php $conn->multi_query($sql); ?>
          <?php 
            do {
              $resultado = $conn->store_result();
              $row = $resultado->fetch_all(MYSQLI_ASSOC);
          ?>
              <?php $i = 0; ?>
              <?php foreach($row as $evento): ?>
                <?php if($i % 2 == 0) { ?>
                  <div id="<?php echo strtolower($evento['cat_evento']) ?>" class="info-curso ocultar clearfix">
                <?php } ?>
                  <div class="detalle-evento">
                    <h3><?php echo html_entity_decode($evento['nombre_evento']) ?></h3>
                    <p><i class="fas fa-clock" aria-hidden="true"></i> <?php echo $evento['hora_evento']; ?></p>
                    <p><i class="fas fa-calendar" aria-hidden="true"></i> <?php echo $evento['fecha_evento']; ?></p>
                    <p><i class="fas fa-user" aria-hidden="true"></i> <?php echo $evento['nombre_invitado'] . " " . $evento['apellidopa_invitado'] . " " . $evento['apellidoma_invitado']; ?></p>
                  </div> <!--.detalle-evento-->
                <?php if($i % 2 == 1): ?>
                  <a href="calendario.php" class="button float-right">Ver todos</a>
                  </div> <!--#talleres-->
                <?php endif; ?>
              <?php $i++; ?>
                <?php endforeach; ?>
              <?php $resultado->free(); ?>
          <?php } while ($conn->more_results() && $conn->next_result()); ?>  
        </div> <!--.programa-evento-->
      </div> <!--.contenedor-->
    </div> <!--.contenido-programa-->
  </section> <!--.programa-->

  <?php include_once 'includes/templates/invitados.php'; ?> <!--Llamada a template invitados--> 

  <div class="contador parallax">
    <div class="contenedor">
      <ul class="resumen-evento clearfix">
        <li><p class="numero">0</p> Invitados </li>
        <li><p class="numero">0</p> Talleres </li>
        <li><p class="numero">0</p> Dias </li>
      </ul><!--.resumen-evento-->
    </div> <!--.contenedor-->
  </div><!--.contador-->

  <section class="ubicacion seccion"> 
    <h2>Ubicación - UNTRM</h2>
    <div id= "mapa" class="mapa"> </div> <!--#mapa-->
  </section> <!--.precios seccion-->

  <div class="newsletter parallax">
    <div class="contenido">
      <p> Registrate al newsletter:</p>
      <h3>UNTRM-Eventos</h3>
      <a href="#mc_embed_signup" class="boton_newsletter button transparente">Registro</a>
    </div> <!--.contenido-->
  </div> <!--.newsletter-->

  <?php include_once 'includes/templates/footer.php'; ?>