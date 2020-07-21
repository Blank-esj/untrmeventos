<?php include_once 'controlador/debug_to_console.php'; ?>
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
            require_once('controlador/bd_conexion.php');
            $sql = "SELECT * FROM plan ORDER BY precio ASC;";
            $resultado = $conn->query($sql);
          } catch (Exception $e) {
            $error = $e->getMessage();
            echo $error;
          }

          while ($plan = $resultado->fetch_assoc()) {
          ?>

            <li>
              <div id="<?php echo $plan['idplan'] ?>" style="cursor: pointer;" class="tabla-precio card  p-3 mb-5 rounded">
                <!-- Nombre del Plan -->
                <h3 class="nombre-plan-<?php echo $plan['idplan'] ?>"><?php echo $plan['nombre']; ?></h3>

                <p><?php echo $plan['descripcion']; ?></p>

                <!-- Precio del Plan -->
                <p class="numero">
                  S/
                  <span class="precio-plan-<?php echo $plan['idplan'] ?>">
                    <?php echo $plan['precio']; ?>
                  </span>
                </p>
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
        <input class="form-control" type="text" id="telefono" name="telefono" placeholder="Escribe tu Teléfono">
      </div>
      <!--.Documento de Identidad-->
      <div class="campo">
        <label for="doc_identidad">Documento de Identidad:</label>
        <input class="form-control" type="text" id="doc_identidad" name="doc_identidad" placeholder="Escribe tu documento de identidad">
      </div>
      <!--.Comentario-->
      <div class="campo">
        <label for="descripcion">Comentario:</label>
        <input class="form-control" type="text" id="descripcion" name="descripcion" placeholder="Comentario">
      </div>
      <!--.campo-->
      <div id="error"></div>
    </div>

    <div id="resumen" class="resumen ">
      <div class="box-header with-border">
        <h3 class="box-title">Pagos y Extras</h3>
      </div>
      <br>
      <div class="caja clearfix row">
        <div class="extras col-md-4">
          <div id="articulos" class="card">
            <div class="card-header">
              Articulos
            </div>
            <!-- Articulos -->
            <div class="card-body">
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
                  <label for="<?php echo $articulo['idarticulo'] ?>">
                    <small class="nombre-articulo"> <?php echo $articulo['nombre_articulo'] ?> </small>
                    <small>S/</small>
                    <small class="precio-articulo"> <?php echo $articulo['precio'] ?> </small>
                    <small><?php echo $articulo['descripcion'] ?></small>
                  </label>
                  <input type="number" class="form-control m6 cantidad-articulo" min="0" id="<?php echo $articulo['idarticulo'] ?>" size="3" placeholder="0">
                </div>
              <?php
              }
              ?>
            </div>
          </div>

          <!--.Regalos -->
          <div class="card orden">
            <div class="card-header">
              Regalo
            </div>
            <div class="card-body">
              <label for="regalo">Seleccione un regalo</label> <br>
              <select id="regalo" name="regalo" class="form-control m-6">
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
          </div>
          <!--.Regalos-->
          <br>
          <input type="button" id="calcular" class="button rounded" value="Calcular">
        </div>
        <!--.extras-->

        <div class="total col-md-8">
          <div class="card">
            <div class="card-header">
              Resumen
            </div>
            <div class="card-body">
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">Cantidad</th>
                    <th scope="col">Pedido</th>
                    <th scope="col">Subtotal</th>
                  </tr>
                </thead>
                <tbody id="fila-resumen-articulo">
                </tbody>
              </table>

            </div>
            <div class="box-footer">
              <button type="button" class="button rounded" id="btnRegistro" value="pagar">Agregar</button>
            </div>
          </div>
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