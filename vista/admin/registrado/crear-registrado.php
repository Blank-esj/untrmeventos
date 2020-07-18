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
    <div class="container-fluid">
      <section class="content">
        <!-- Main content -->
        <div class="box">
          <!-- Default box -->
          <div class="box-header with-border">
            <h3 class="box-title">Crear Participante</h3>
          </div>
          <div class="box-body">
            <!-- form start -->
            <form role="form">
              <div class="box-body">
                <div class="row">
                  <!-- Nombres -->
                  <div class="form-group col-md-6">
                    <label for="nombre_registrado">Nombres:</label>
                    <input type="text" class="form-control m6" id="nombre" name="nombre" placeholder="Nombre">
                  </div>
                  <!-- Apellido Paterno -->
                  <div class="form-group col-md-6">
                    <label for="apellidopa">Apellido Paterno:</label>
                    <input type="text" class="form-control m6" id="apellidopa" name="apellidopa" placeholder="Apellido paterno">
                  </div>

                  <!-- Apellido Materno -->
                  <div class="form-group col-md-6">
                    <label for="apellidoma">Apellido Materno:</label>
                    <input type="text" class="form-control m6" id="apellidoma" name="apellidoma" placeholder="Apellido materno">
                  </div>

                  <!-- Email -->
                  <div class="form-group col-md-6">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control m6" id="email" name="email" placeholder="Email">
                  </div>

                  <!-- Teléfono -->
                  <div class="form-group col-md-6">
                    <label for="telefono">Teléfono:</label>
                    <input type="text" class="form-control m6" id="telefono" name="telefono" placeholder="Teléfono">
                  </div>

                  <!-- Documento de Identidad -->
                  <div class="form-group col-md-6">
                    <label for="doc_identidad">Documento de Identidad:</label>
                    <input data-toggle="tooltip" data-placement="top" title="Tooltip on top" type="text" class="form-control m6" id="doc_identidad" name="doc_identidad" placeholder="Documento de Identidad">
                  </div>

                  <!-- Comentario -->
                  <div class="form-group col-md-6">
                    <label for="descripcion">Comentario:</label>
                    <input data-toggle="tooltip" data-placement="top" title="Tooltip on top" type="text" class="form-control m6" id="descripcion" name="descripcion" placeholder="Comentario">
                  </div>
                  <div id="error"></div>
                </div>

                <div class="form-group">
                  <div id="paquetes" class="paquetes">
                    <div class="box-header with-border">
                      <h3 class="box-title">Elige tu boleto</h3>
                    </div>
                    <ul class="lista-precios clearfix row">

                      <div id="planes" class="card-columns">

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

                          <div id="<?php echo $plan['idplan'] ?>" class="card tabla-precio mb-5 rounded" style="cursor: pointer;">
                            <div class="card-header">
                              <h5 class="card-title nombre-plan-<?php echo $plan['idplan'] ?>"><?php echo $plan['nombre']; ?></h5>
                              <span class="badge badge-pill badge-primary">
                                S/ <span class="precio-plan-<?php echo $plan['idplan'] ?>"><?php echo $plan['precio']; ?></span>
                              </span>
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
                          </div>
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
                            <select id="regalo" name="regalo" required class="form-control m-6">
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
                        <input type="button" id="calcular" class="btn btn-success" value="Calcular">
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
                            <button type="submit" class="btn btn-primary" id="btnRegistro">Agregar</button>
                          </div>
                        </div>
                      </div>
                      <!--.total-->
                    </div>
                    <!--.caja-->
                  </div>
                  <!--#resumen-->
                </div>
              </div> <!-- /.box-body -->
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