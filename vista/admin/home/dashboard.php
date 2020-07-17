<?php
// Modificado: 16/07/2020 16:24
include_once '../../plantillas/cabecera-admin.php';
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Dashboard
      <small>Información sobre el evento</small>
    </h1>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="box-body chart-responsive">
        <div class="chart" id="grafica-registros" style="height: 300px;"></div>
      </div>
    </div>
    <h2 class="page-header">Resumen de Registros</h2>
    <div class="row">
      <!-- Total Registrado -->
      <div class="col-lg-3 col-xs-6">
        <?php
        $sql = "SELECT COUNT(*) AS registros FROM persona p, boleto b WHERE b.idpersona = p.idpersona";
        $resultado = $conn->query($sql);
        $registrados = $resultado->fetch_assoc();
        ?>
        <div class="small-box bg-aqua">
          <!-- small box -->
          <div class="inner">
            <h3><?php echo $registrados['registros']; ?></h3>
            <p>Total Registrados</p>
          </div>
          <div class="icon">
            <i class="fa fa-user"></i>
          </div>
          <a href="../registrado/lista-registrado.php" class="small-box-footer">
            Más Información <i class="fa fa-arrow-circle-right"></i>
          </a>
        </div>
      </div>

      <!-- Edad Promedio de registrados -->
      <div class="col-lg-3 col-xs-6">
        <?php
        $sql = "SELECT ROUND(AVG(YEAR(CURDATE())-YEAR(nacimiento))) AS `edad_promedio` FROM persona, invitado WHERE persona.idpersona = invitado.idpersona; ";
        $resultado = $conn->query($sql);
        $registrados = $resultado->fetch_assoc();
        ?>
        <div class="small-box bg-aqua">
          <!-- small box -->
          <div class="inner">
            <h3><?php echo $registrados['edad_promedio']; ?></h3>
            <p>Edad Promedio de Invitados</p>
          </div>
          <div class="icon">
            <i class="fa fa-user"></i>
          </div>
          <a href="../registrado/lista-registrado.php" class="small-box-footer">
            Más Información <i class="fa fa-arrow-circle-right"></i>
          </a>
        </div>
      </div>

      <!-- Total Pagados -->
      <div class="col-lg-3 col-xs-6">
        <?php
        $sql = "SELECT COUNT(*) AS registros FROM persona p, boleto b WHERE p.idpersona = b.idpersona";
        $resultado = $conn->query($sql);
        $registrados = $resultado->fetch_assoc();

        ?>
        <!-- small box -->
        <div class="small-box bg-yellow">
          <div class="inner">
            <h3><?php echo $registrados['registros']; ?></h3>

            <p>Total Pagados</p>
          </div>
          <div class="icon">
            <i class="fa fa-users"></i>
          </div>
          <a href="../registrado/lista-registrado.php" class="small-box-footer">
            Más Información <i class="fa fa-arrow-circle-right"></i>
          </a>
        </div>
      </div>

      <!-- Total Ganancias -->
      <div class="col-lg-3 col-xs-6">
        <?php
        $sql = "SELECT SUM(total) AS ganancias FROM v_boleto";
        $resultado = $conn->query($sql);
        $registrados = $resultado->fetch_assoc();
        ?>
        <!-- small box -->
        <div class="small-box bg-green">
          <div class="inner">
            <h3>$<?php echo round($registrados['ganancias']); ?></h3>

            <p>Ganancias Totales</p>
          </div>
          <div class="icon">
            <i class="fas fa-dollar-sign"></i>
          </div>
          <a href="../registrado/lista-registrado.php" class="small-box-footer">
            Más Información <i class="fa fa-arrow-circle-right"></i>
          </a>
        </div>
      </div>
    </div>

    <h2 class="page-header">Regalos</h2>

    <!-- Total regalos -->
    <div class="row">
      <?php
      try {
        $sql = "SELECT r.nombre_regalo regalo, COUNT(*) total FROM v_boleto vb, boleto b, regalo r WHERE b.idregalo = r.idregalo AND b.idboleto = vb.idboleto GROUP BY r.idregalo ORDER BY total DESC;";
        $resultado = $conn->query($sql); //Ejecuta consulta SQL
      } catch (Exception $e) {
        $error = $e->getMessage();
        echo $error;
      }
      $numero = 1;
      while ($regalo = $resultado->fetch_assoc()) { ?>
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-teal">
            <div class="inner">
              <h3><?php echo $regalo['total']; ?></h3>

              <p><?php echo $regalo['regalo']; ?></p>
            </div>
            <div class="icon">
              <i class="fa fa-gift"></i>
            </div>
            <a href="../registrado/lista-registrado.php" class="small-box-footer">
              Más Información <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
      <?php } ?>
    </div>
  </section> <!-- /.content -->
</div> <!-- /.content-wrapper -->
<?php
include_once '../../plantillas/footer-admin.php';
?>