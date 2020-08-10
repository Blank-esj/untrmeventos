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

    <h2 class="page-header">Linea de tiempo de registro de asistentes</h2>
    <div class="row">
      <div class="box-body chart-responsive">
        <div class="chart" id="grafica-registros" style="height: 300px;"></div>
      </div>
    </div>

    <h2 class="page-header">Resumen de Registros</h2>
    <div class="row">
      <!-- Total Registrado -->
      <?php
      $sql = "SELECT v.estado, COUNT(b.idventa) total 
                FROM boleto b, venta v 
                WHERE b.idventa = v.idventa 
                GROUP BY v.estado;";
      $resultado = $conn->query($sql);
      while ($registrados = $resultado->fetch_assoc()) { ?>
        <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-<?php
                                    switch ($registrados['estado']) {
                                      case 'completo':
                                        echo "aqua";
                                        break;
                                      case 'aprobado':
                                        echo "yellow";
                                        break;
                                      default:
                                        echo "red";
                                        break;
                                    } ?>">
            <!-- small box -->
            <div class="inner">
              <h3><?php echo $registrados['total']; ?></h3>
              <p><?php echo $registrados['estado']; ?></p>
            </div>
            <div class="icon">
              <i class="fa fa-user"></i>
            </div>
            <a href="dashboard?dashboard=lista-boleto" class="small-box-footer">
              Más Información <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
      <?php } ?>

      <!-- Total Ganancias -->
      <div class="col-lg-3 col-xs-6">
        <?php
        $sql = "SELECT SUM(total) AS ganancias FROM v_venta WHERE estado = 'completo'";
        $resultado = $conn->query($sql);
        if ($resultado != false) {

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
            <a href="dashboard?dashboard=lista-boleto" class="small-box-footer">
              Más Información <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        <?php } ?>
      </div>

    </div>


    <h2 class="page-header">Planes más vendidos</h2>

    <!-- Planes más vendidos -->
    <div class="row">
      <?php
      try {
        $sql = "SELECT p.nombre, p.precio, COUNT(*) total 
                FROM boleto b, plan p, venta v
                WHERE b.idplan = p.idplan AND
                b.idventa = v.idventa AND
                v.estado = 'completo'
                GROUP BY p.idplan ORDER BY total DESC;";
        $resultado = $conn->query($sql); //Ejecuta consulta SQL
      } catch (Exception $e) {
        $error = $e->getMessage();
        echo $error;
      }
      $numero = 1;
      while ($plan = $resultado->fetch_assoc()) { ?>
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-blue">
            <div class="inner">
              <h3><?php echo $plan['total']; ?></h3>

              <p>
                <?php echo $plan['nombre']; ?>
                <span class="badge label-success">
                  <?php echo "$ " . $plan['precio']; ?>
                </span>
              </p>
            </div>
            <div class="icon">
              <i class="fa fa-university"></i>
            </div>
            <a href="dashboard?dashboard=lista-boleto" class="small-box-footer">
              Más Información <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
      <?php } ?>
    </div>


    <h2 class="page-header">Articulos más vendidos</h2>

    <!-- Total Articulo -->
    <div class="row">
      <?php
      try {
        $sql = "SELECT a.nombre_articulo, a.precio, sum(va.cantidad) total 
                FROM venta_articulo va, articulo a, venta v
                WHERE va.idarticulo = a.idarticulo AND
                va.idventa = v.idventa AND
                v.estado = 'completo'
                GROUP BY a.idarticulo
                ORDER BY total DESC;";
        $resultado = $conn->query($sql); //Ejecuta consulta SQL
      } catch (Exception $e) {
        $error = $e->getMessage();
        echo $error;
      }
      $numero = 1;
      while ($articulo = $resultado->fetch_assoc()) { ?>
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-olive">
            <div class="inner">
              <h3><?php echo number_format($articulo['total'], 0); ?></h3>

              <p>
                <?php echo $articulo['nombre_articulo']; ?>
                <span class="badge label-success">
                  <?php echo "$ " . $articulo['precio']; ?>
                </span>
              </p>
            </div>
            <div class="icon">
              <i class="fa fa-tags"></i>
            </div>
            <a href="dashboard?dashboard=lista-boleto" class="small-box-footer">
              Más Información <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
      <?php } ?>
    </div>


    <h2 class="page-header">Lo más regalado</h2>

    <!-- Total regalos -->
    <div class="row">
      <?php
      try {
        $sql = "SELECT r.nombre_regalo regalo, COUNT(*) total
                FROM boleto b, regalo r, venta v
                WHERE b.idregalo = r.idregalo
                AND b.idventa = v.idventa
                AND v.estado = 'completo'
                GROUP BY r.idregalo 
                ORDER BY total DESC;";
        $resultado = $conn->query($sql); //Ejecuta consulta SQL
      } catch (Exception $e) {
        $error = $e->getMessage();
        echo $error;
      }
      $numero = 1;
      while ($regalo = $resultado->fetch_assoc()) { ?>
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-maroon">
            <div class="inner">
              <h3><?php echo $regalo['total']; ?></h3>

              <p><?php echo $regalo['regalo']; ?></p>
            </div>
            <div class="icon">
              <i class="fa fa-gift"></i>
            </div>
            <a href="dashboard?dashboard=lista-boleto" class="small-box-footer">
              Más Información <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
      <?php } ?>
    </div>



    <h2 class="page-header">Resumen Invitados</h2>

    <!-- Resumen Invitados -->
    <div class="row">

      <!-- Edad Promedio -->
      <?php
      try {
        $sql = "SELECT ROUND(AVG(YEAR(CURDATE())-YEAR(nacimiento))) AS `edad_promedio` 
              FROM persona, invitado 
              WHERE persona.idpersona = invitado.idpersona;";
        $resultado = $conn->query($sql); //Ejecuta consulta SQL
      } catch (Exception $e) {
        $error = $e->getMessage();
        echo $error;
      }
      $numero = 1;
      while ($invitado = $resultado->fetch_assoc()) { ?>
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-orange">
            <div class="inner">
              <h3><?php echo $invitado['edad_promedio'] != null ? $invitado['edad_promedio'] : "-"; ?></h3>
              <p>Edad Promedio de Invitados</p>
            </div>
            <div class="icon">
              <i class="fa fa-users"></i>
            </div>
            <a href="dashboard?dashboard=lista-boleto" class="small-box-footer">
              Más Información <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
      <?php } ?>


      <!-- Grados Académicos -->
      <?php
      try {
        $sql = "SELECT grado, COUNT(*) total 
                FROM v_invitado i 
                WHERE ISNULL(i.grado) = FALSE 
                GROUP BY grado 
                ORDER BY total DESC;";
        $resultado = $conn->query($sql); //Ejecuta consulta SQL
      } catch (Exception $e) {
        $error = $e->getMessage();
        echo $error;
      }
      $numero = 1;
      while ($invitado = $resultado->fetch_assoc()) { ?>
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-orange">
            <div class="inner">
              <h3><?php echo $invitado['total'] != null ? $invitado['total'] : "-"; ?></h3>
              <p><strong>Grado:</strong> <?php echo $invitado['grado'] ?></p>
            </div>
            <div class="icon">
              <i class="fa fa-users"></i>
            </div>
            <a href="dashboard?dashboard=lista-boleto" class="small-box-footer">
              Más Información <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
      <?php } ?>


    </div>


  </section> <!-- /.content -->
</div> <!-- /.content-wrapper -->