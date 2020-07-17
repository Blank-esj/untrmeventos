<?php
include_once '../../plantillas/cabecera-admin.php';
include_once '../../../controlador/debug_to_console.php'
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Crear registro de Participante
      <small>Llena el formulario para crear un Participante manualmente.</small>
    </h1>
  </section>

  <div class="row">
    <div class="col-md-8">
      <section class="content">
        <!-- Main content -->
        <div class="box">
          <!-- Default box -->
          <div class="box-header with-border">
            <h3 class="box-title">Crear Participante</h3>
          </div>
          <div class="box-body">
            <!-- form start -->
            <form role="form" name="guardar-registro" id="guardar-registro" method="post" action="../../../modelo/modelo-registrado.php">
              <div class="box-body">
                <!-- Nombres -->
                <div class="form-group">
                  <label for="nombre_registrado">Nombres:</label>
                  <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre">
                </div>

                <!-- Apellido Paterno -->
                <div class="form-group">
                  <label for="apellidopa">Apellido Paterno:</label>
                  <input type="text" class="form-control" id="apellidopa" name="apellidopa" placeholder="Apellido paterno">
                </div>

                <!-- Apellido Materno -->
                <div class="form-group">
                  <label for="apellidoma">Apellido Materno:</label>
                  <input type="text" class="form-control" id="apellidoma" name="apellidoma" placeholder="Apellido materno">
                </div>

                <!-- Email -->
                <div class="form-group">
                  <label for="email">Email:</label>
                  <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                </div>

                <!-- Teléfono -->
                <div class="form-group">
                  <label for="telefono">Teléfono:</label>
                  <input type="text" class="form-control" id="telefono" name="telefono" placeholder="Teléfono">
                </div>

                <!-- Documento de Identidad -->
                <div class="form-group">
                  <label for="doc_identidad">Documento de Identidad:</label>
                  <input type="text" class="form-control" id="doc_identidad" name="doc_identidad" placeholder="Documento de Identidad">
                </div>

                <div class="form-group">
                  <div id="paquetes" class="paquetes">
                    <div class="box-header with-border">
                      <h3 class="box-title">Elige tu boleto</h3>
                    </div>
                    <ul class="lista-precios clearfix row">

                      <div class="card-columns">

                        <?php
                        try {
                          $sql = "SELECT * FROM plan ORDER BY precio ASC";
                          $resultado = $conn->query($sql);
                        } catch (Exception $e) {
                          $error = $e->getMessage();
                          echo $error;
                        }

                        while ($plan = $resultado->fetch_assoc()) {
                        ?>

                          <div class="card shadow mb-5 bg-white rounded">
                            <div class="card-header">
                              <h5 class="card-title"><?php echo $plan['nombre']; ?></h5>
                            </div>
                            <div class="card-body">
                              <p class="card-text"><?php echo $plan['descripcion']; ?></p>

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
                                <li style="font-size: 0.8rem; font-style: italic;">
                                  <?php echo $beneficio['nombre']; ?>
                                </li>
                              <?php
                              }
                              ?>
                            </div>
                            <div class="card-body">
                              <a href="#" class="btn btn-primary">S/ <?php echo $plan['precio']; ?></a>
                            </div>
                          </div>

                          <li class="col-md-4">
                            <div class="tabla-precio text-center">
                              <ul>


                              </ul>
                            </div>
                          </li>
                        <?php
                        }
                        ?>
                      </div>
                    </ul>
                  </div>
                  <!--#paquetes-->
                </div>
                <!--.form-group-->

                <div class="form-group">

                  <div id="resumen" class="resumen ">
                    <div class="box-header with-border">
                      <h3 class="box-title">Pagos y Extras</h3>
                    </div>
                    <br>
                    <div class="caja clearfix row">
                      <div class="extras col-md-6">
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

                        <!--.orden-->
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
                        <!--.orden-->
                        <br>
                        <input type="button" id="calcular" class="btn btn-success" value="Calcular">
                      </div>
                      <!--.extras-->

                      <div class="total col-md-6">
                        <p>Resumen:</p>
                        <div id="lista-productos">
                        </div>
                        <p>Total:</p>
                        <div id="suma-total">
                        </div>
                        <input type="hidden" name="total_pedido" id="total_pedido">
                        <input type="hidden" name="total_descuento" id="total_descuento" value="total_descuento">
                      </div>
                      <!--.total-->
                    </div>
                    <!--.caja-->
                  </div>
                  <!--#resumen-->
                </div>
              </div> <!-- /.box-body -->

              <div class="box-footer">
                <input type="hidden" name="registro" value="nuevo">
                <button type="submit" class="btn btn-primary" id="btnRegistro">Agregar</button>
              </div>
            </form>
          </div> <!-- /.box-body -->
        </div> <!-- /.box -->
      </section> <!-- /.content -->
    </div>
  </div>
</div> <!-- /.content-wrapper -->
<?php
include_once '../../plantillas/footer-admin.php';
?>