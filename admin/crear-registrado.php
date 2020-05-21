<?php
        include_once 'funciones/sesiones.php';
        include_once 'templates/header.php';
        include_once 'funciones/funciones.php';
        include_once 'templates/barra.php';
        include_once 'templates/navegacion.php';    
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
        <section class="content"> <!-- Main content -->
          <div class="box"> <!-- Default box -->
            <div class="box-header with-border">
              <h3 class="box-title">Crear Participante</h3>
            </div>
            <div class="box-body">
              <!-- form start -->
              <form role="form" name="guardar-registro" id="guardar-registro" method="post" action="modelo-registrado.php">
                <div class="box-body">
                  <div class="form-group">
                    <label for="nombre_registrado">Nombres:</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre">
                  </div>
                  <div class="form-group">
                    <label for="apellidopa">Apellido Paterno:</label>
                    <input type="text" class="form-control" id="apellidopa" name="apellidopa" placeholder="Apellido paterno">
                  </div>
                  <div class="form-group">
                    <label for="apellidoma">Apellido Materno:</label>
                    <input type="text" class="form-control" id="apellidoma" name="apellidoma" placeholder="Apellido materno">
                  </div>
                  <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                  </div>               
                  <div class="form-group">
                    <div id="paquetes" class="paquetes">
                      <div class="box-header with-border">
                        <h3 class="box-title">Elige el número de boletos</h3>
                      </div>
                      <ul class="lista-precios clearfix row">
                        <li class="col-md-4">
                          <div class="tabla-precio text-center">
                            <h3>Pase por día (viernes)</h3>
                            <p class="numero">S/ 20</p>
                            <ul>
                              <li>Material de trabajo</li>
                              <li>No Certificado</li>
                              <li>Regalo</li>
                            </ul>
                            <div class="orden">
                              <label for="pase_dia">Boletos deseados:</label>
                              <input type="number" class="form-control" min="0" id="pase_dia" size="3" name="boletos[un_dia][cantidad]" placeholder="0">
                              <input type="hidden" value="20" name="boletos[un_dia][precio]">
                            </div>
                          </div>
                        </li>
                        <li class="col-md-4">
                          <div class="tabla-precio text-center">
                            <h3>Todos los días</h3>
                            <p class="numero">S/ 60</p>
                            <ul>
                              <li>Material de trabajo</li>
                              <li>Certificado</li>
                              <li>Regalo</li>
                            </ul>
                            <div class="orden">
                              <label for="pase_completo">Boletos deseados:</label>
                              <input type="number" class="form-control" min="0" id="pase_completo" size="3" name="boletos[completo][cantidad]" placeholder="0">
                              <input type="hidden" value="60" name="boletos[completo][precio]">
                            </div>
                          </div>
                        </li>             
                        <li class="col-md-4">
                          <div class="tabla-precio text-center">
                            <h3>Pase por 2 días (viernes y sábado)</h3>
                            <p class="numero">S/ 40</p>
                            <ul>
                              <li>Material de trabajo</li>
                              <li>No Certificado</li>
                              <li>Regalo</li>
                            </ul>
                            <div class="orden">
                              <label for="pase_dosdias">Boletos deseados:</label>
                              <input type="number" class="form-control" min="0" id="pase_dosdias" size="3" name="boletos[2dias][cantidad]" placeholder="0">
                              <input type="hidden" value="40" name="boletos[2dias][precio]">
                            </div>
                          </div>
                        </li> 
                      </ul>
                    </div><!--#paquetes-->
                  </div> <!--.form-group-->
            
                  <div class="form-group">
                    <div class="box-header with-border">
                      <h3 class="box-title">Elige los talleres</h3>
                    </div>
                    <div id="eventos" class="eventos clearfix">
                      <div class="caja ">
                        <?php
                          try {
                            $sql = "SELECT evento.*, categoria_evento.cat_evento, invitado.nombre_invitado, invitado.apellidopa_invitado ";
                            $sql .= " FROM evento ";
                            $sql .= " JOIN categoria_evento ";
                            $sql .= " ON evento.id_cat_evento = categoria_evento.id_categoria ";
                            $sql .= " JOIN invitado ";
                            $sql .= " ON evento.id_inv = invitado.id_invitado ";
                            $sql .= " ORDER BY evento.fecha_evento, evento.id_cat_evento, evento.hora_evento ";
                            //echo $sql;
                            $resultado = $conn->query($sql);
                          } catch (Exception $e) {
                            echo $e->getMessage();
                          }
                            
                          $eventos_dias = array();
                          while($evento = $resultado->fetch_assoc()) {
                                
                            $fecha = $evento['fecha_evento'];
                            setlocale(LC_ALL, 'Spanish');
                            $dia_semana = utf8_encode(strftime("%A", strtotime($fecha)));
                            $categoria = $evento['cat_evento'];
                            $dia = array(
                              'nombre_evento' => $evento['nombre_evento'],
                              'hora' => $evento['hora_evento'],
                              'id' => $evento['id_evento'],
                              'nombre_invitado' => $evento['nombre_invitado'],
                              'apellido_invitado' => $evento['apellidopa_invitado']
                            );

                            $eventos_dias[$dia_semana]['eventos'][$categoria][] = $dia;
                          }
                        ?>
                                                     
                        <?php foreach($eventos_dias as $dia => $eventos) { ?>
                          <div id="<?php echo str_replace('á', 'a', $dia); ?>" class="contenido-dia clearfix row">
                            <h4 class="text-center nombre_dia"><?php echo $dia; ?></h4>
                                
                            <?php foreach($eventos['eventos'] as $tipo => $evento_dia): ?>  
                              <div class="col-md-4">
                                <p><?php echo $tipo; ?></p>
                                        
                                <?php foreach($evento_dia as $evento) { ?>
                                    <label>
                                      <input type="checkbox" class="minimal" name="registro_evento[]" id="<?php echo $evento['id']; ?>" value="<?php echo $evento['id']; ?>">
                                      <time><?php echo $evento['hora']; ?></time> <?php echo $evento['nombre_evento']; ?>
                                      <br>
                                      <span class="autor"><?php echo $evento['nombre_invitado'] . " "  . $evento['apellido_invitado']; ?></span>
                                    </label>
                                <?php } //foreach ?>
                              </div>
                            <?php endforeach; ?>
                          </div> <!--.contenido-dia -->
                        <?php  } ?>
                      </div><!--.caja-->
                    </div> <!--#eventos-->
                
                    <div id="resumen" class="resumen ">
                      <div class="box-header with-border">
                        <h3 class="box-title">Pagos y Extras</h3>
                      </div>
                      <br>
                      <div class="caja clearfix row">
                        <div class="extras col-md-6">
                          <div class="orden">
                            <label for="camisa_evento">Camisa del evento $10 <small>(promocion 7% dto.)</small></label>
                            <input type="number" class="form-control" min="0" id="camisa_evento" name="pedido_extra[camisas][cantidad]" size="3" placeholder="0">
                            <input type="hidden" value="10" name="pedido_extra[camisas][precio]">
                          </div> <!--.orden-->
                          <div class="orden">
                            <label for="etiquetas">Paquete de 10 etiquetas $2 <small>(HTML5, CSS3, JavaScript, Chrome)</small></label>
                            <input type="number" class="form-control" min="0" id="etiquetas" name="pedido_extra[etiquetas][cantidad]" size="3" placeholder="0">
                            <input type="hidden" value="2" name="pedido_extra[etiquetas][precio]">
                          </div> <!--.orden-->
                          <div class="orden">
                            <label for="regalo">Seleccione un regalo</label> <br>
                            <select id="regalo" name="regalo" required class="form-control seleccionar">
                              <option value="">-- Seleccione un regalo --</option>
                              <option value="2">Etiquetas</option>
                              <option value="1">Pulsera</option>
                              <option value="3">Plumas</option>
                            </select>
                          </div><!--.orden-->
                          <br>
                          <input type="button" id="calcular" class="btn btn-success" value="Calcular">
                        </div> <!--.extras-->
                                                      
                        <div class="total col-md-6">
                          <p>Resumen:</p>
                          <div id="lista-productos">
                          </div>
                          <p>Total:</p>
                          <div id="suma-total"> 
                          </div>
                          <input type="hidden" name="total_pedido" id="total_pedido">
                          <input type="hidden" name="total_descuento" id="total_descuento" value="total_descuento">
                        </div> <!--.total-->
                      </div><!--.caja-->
                    </div> <!--#resumen-->
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
  include_once 'templates/footer.php';
?>