<?php
try {
  require_once('../controlador/bd_conexion.php');
  $sql = "SELECT * FROM invitado ";
  $resultado = $conn->query($sql);
} catch (Exception $e) {
  $error = $e->getMessage();
}
?>
<section class="invitados contenedor seccion">
  <h2>Invitados</h2>
  <ul class="lista-invitados clearfix">
    <?php while ($invitado = $resultado->fetch_assoc()) { ?>
      <li>
        <div class="invitado">
          <a class="invitado-info" href="#invitado<?php echo $invitado['id_invitado']; ?>">
            <img src="assets/img/invitados/<?php echo $invitado['url_imagen'] ?>" alt="imagen invitado">
            <p><?php echo $invitado['nombre_invitado'] . " " . $invitado['apellidopa_invitado'] . " " . $invitado['apellidoma_invitado']; ?></p>
          </a>
        </div>
        <!--.invitado-->
      </li>
      <div style="display:none;">
        <div class="invitado-info" id="invitado<?php echo $invitado['id_invitado']; ?>">
          <h2><?php echo $invitado['nombre_invitado'] . " " . $invitado['apellidopa_invitado'] . " " . $invitado['apellidoma_invitado']; ?></h2>
          <img src="assets/img/invitados/<?php echo $invitado['url_imagen'] ?>" alt="imagen invitado">
          <p><?php echo $invitado['descripcion'] ?></p>
        </div>
      </div>
    <?php } //while de fetch_assoc() 
    ?>
  </ul>
  <!--.lista-invitados-->
</section>
<!--.invitados contenedor seccion-->
<?php // $conn->close(); ?>