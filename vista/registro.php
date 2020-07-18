<?php include_once 'plantillas/header-evento.php'; ?>
<?php include_once '../controlador/debug_to_console.php'; ?>
<section class="seccion container-fluid">
  <h2>Registro de Asistentes</h2>
  <form id="registro" class="registro" action="pagar.php" method="POST">
    <!--#datos_usuario-->

    <div id="paquetes" class="paquetes">
      <h3>Elije un plan</h3>
      <ul class="lista-precios clearfix">
        <div id="planes" class="card-columns">

          <?php
          try {
            require_once('../controlador/bd_conexion.php');
            $sql = "SELECT * FROM plan ORDER BY precio ASC;";
            $resultado = $conn->query($sql);
          } catch (Exception $e) {
            $error = $e->getMessage();
            echo $error;
          }

          while ($plan = $resultado->fetch_assoc()) {
          ?>

            <li>
              <div style="cursor: pointer;" class="tabla-precio card  p-3 mb-5 rounded">
                <h3><?php echo $plan['nombre']; ?></h3>
                <p><?php echo $plan['descripcion']; ?></p>
                <p class="numero">S/ <?php echo $plan['precio']; ?></p>
                <ul>

                  <?php
                  try {
                    $sql = "SELECT nombre FROM plan_beneficio pb, beneficio b WHERE pb.idplan = " . $plan['idplan'] . " AND pb.idbeneficio = b.idbeneficio ORDER BY nombre ASC;";
                    $resul = $conn->query($sql);
                  } catch (Exception $e) {
                    $error = $e->getMessage();
                    echo $error;
                  }

                  while ($beneficio = $resul->fetch_assoc()) {
                  ?>
                    <li>
                      <?php echo $beneficio['nombre']; ?>
                    </li>
                  <?php
                  }
                  ?>
                </ul>
              </div>
            </li>
          <?php
          }
          ?>
        </div>
      </ul>
      <!--.lista-precios-->
    </div>

    <h3>Ingrese sus datos</h3>
    <div id="datos_usuario" class="registro caja clearfix">
      <div class="campo">
        <label for="nombre">Nombres:</label>
        <input class="form-control" required type="text" id="nombre" name="nombre" placeholder="Escribe tu nombre">
      </div>
      <!--.Apellido Paterno-->
      <div class="campo">
        <label for="apellido">Apellido Paterno:</label>
        <input class="form-control" required type="text" id="apellidopa" name="apellidopa" placeholder="Escribe tu apellido paterno">
      </div>
      <!--.Apellido Materno-->
      <div class="campo">
        <label for="apellido">Apellido Materno:</label>
        <input class="form-control" required type="text" id="apellidoma" name="apellidoma" placeholder="Escribe tu apellido materno">
      </div>
      <!--.Email-->
      <div class="campo">
        <label for="email">Email:</label>
        <input class="form-control" required type="email" id="email" name="email" placeholder="Escribe tu email">
      </div>
      <!--.Teléfono-->
      <div class="campo">
        <label for="telefono">Teléfono:</label>
        <input class="form-control" type="number" id="telefono" name="telefono" placeholder="Escribe tu Teléfono">
      </div>
      <!--.Documento de Identidad-->
      <div class="campo">
        <label for="doc_identidad">Documento de Identidad:</label>
        <input class="form-control" type="text" id="doc_identidad" name="doc_identidad" placeholder="Escribe tu documento de identidad">
      </div>
      <!--.campo-->
      <div id="error"></div>
    </div>

    <div id="resumen" class="resumen">
      <h3>Pago y Extras</h3>
      <div class="caja clearfix">
        <div class="extras">
          <!-- Articulos -->
          <?php
          try {
            $sql = "SELECT * FROM articulo WHERE stock > 0";
            $resul = $conn->query($sql);
          } catch (Exception $e) {
            $error = $e->getMessage();
            echo $error;
          }

          while ($articulo = $resul->fetch_assoc()) {
          ?>
            <div class="orden">
              <label for="<?php echo $articulo['idarticulo'] ?>"><?php echo $articulo['nombre_articulo'] . ' S/ ' . $articulo['precio'] . ', ' ?><small><?php echo $articulo['descripcion'] ?></small></label>
              <input type="number" class="form-control" min="0" id="<?php echo $articulo['idarticulo'] ?>" size="3" placeholder="0">
            </div>
          <?php
          }
          ?>

          <!--.Regalos -->
          <div class="orden">
            <label for="regalo">Seleccione un regalo</label> <br>
            <select id="regalo" name="regalo" required class="form-control seleccionar">
              <option value="">-- Seleccione un regalo --</option>
              <?php
              try {
                $sql = "SELECT * FROM regalo WHERE stock > 0";
                $resul = $conn->query($sql);
              } catch (Exception $e) {
                $error = $e->getMessage();
                echo $error;
              }

              while ($regalo = $resul->fetch_assoc()) {
              ?>
                <option value="<?php echo $regalo['idregalo'] ?>"><?php echo $regalo['nombre_regalo'] ?></option>
              <?php
              }
              ?>
            </select>
          </div>
          <!--.Regalos-->

          <input type="button" id="calcular" class="button rounded" value="Calcular">
        </div>
        <!--.extras-->
        <div class="total">
          <p>Resumen:</p>
          <div id="lista-productos">
          </div>
          <!--#lista-productos-->
          <p>Total:</p>
          <div id="suma-total">
          </div>
          <!--#suma-total-->
          <input class="form-control" type="hidden" name="total_pedido" id="total_pedido">
          <input class="form-control" type="hidden" name="total_descuento" id="total_descuento" value="total_descuento">
          <input id="btnRegistro" type="submit" name="submit" class="button rounded" value="Pagar">
        </div>
        <!--.total-->
      </div>
      <!--.caja-->
    </div>
    <!--#resumen-->
  </form>
  <!--#registro-->
</section>
<!--.seccion contenedor-->
<?php include_once 'plantillas/footer-evento.php'; ?>