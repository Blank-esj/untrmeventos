<?php include_once 'plantillas/header-evento.php'; ?>
  <section class="seccion contenedor">
    <h2>Registro de Usuarios</h2>
    <form id="registro" class="registro" action="pagar.php" method="POST">
      <div id="datos_usuario" class="registro caja clearfix">
        <div class="campo">
          <label for="nombre">Nombres:</label>
          <input type="text" id="nombre" name="nombre" placeholder="Tu nombre">
        </div> <!--.campo-->
        <div class="campo">
          <label for="apellido">Apellido Paterno:</label>
          <input type="text" id="apellidopa" name="apellidopa" placeholder="Tu apellido paterno">
        </div> <!--.campo-->
        <div class="campo">
          <label for="apellido">Apellido Materno:</label>
          <input type="text" id="apellidoma" name="apellidoma" placeholder="Tu apellido materno">
        </div> <!--.campo-->
        <div class="campo">
          <label for="email">Email:</label>
          <input type="email" id="email" name="email" placeholder="Tu email">
        </div> <!--.campo-->
        <div id="error"></div>
      </div> <!--#datos_usuario-->

      <div id="paquetes" class="paquetes">
          <h3>Elije el numero de boletos</h3>
          <ul class="lista-precios clearfix">

            <li>
              <div class="tabla-precio">
                <h3>Pase por día (viernes)</h3>
                <p class="numero">S/ 20</p>
                  <ul>
                    <li>Material de trabajo</li>
                    <li>No Certificado</li>
                    <li>Regalo</li>
                  </ul>
                  <div class="orden">
                      <label for="pase_dia">Boletos deseados:</label>
                      <input type="number" min="0" id="pase_dia" size="3" name="boletos[un_dia][cantidad]" placeholder="0">
                      <input type="hidden" value="20" name="boletos[un_dia][precio]">
                  </div>
              </div>
            </li> 
            
            <li>
              <div class="tabla-precio">
                <h3>Todos los dias</h3>
                <p class="numero"> S/ 60</p>
                <ul>
                  <li>Material de trabajo</li>
                  <li>Certificado</li>
                  <li>Regalo</li>
                </ul>
                <div class="orden">
                  <label for="pase_completo">Boletos deseados:</label>
                  <input type="number" min="0" id="pase_completo" size="3" name="boletos[completo][cantidad]" placeholder="0">
                  <input type="hidden" value="60" name="boletos[completo][precio]">
                </div><!--.orden-->
              </div> <!--.tabla-precio-->
            </li>
            
            <li>
              <div class="tabla-precio "> <!--no_visualizar--> <!--para volverlo a su normalidadhay que camvian no visualizar por tabla-precio -->
                <h3>Pase por 2 días (viernes y sábado)</h3>
                <p class="numero">S/ 40</p>
                <ul>
                  <li>Material de trabajo</li>
                  <li>No Certificado</li>
                  <li>Regalo</li>
                </ul>
                <div class="orden">
                    <label for="pase_dosdias">Boletos deseados:</label>
                    <input type="number" min="0" id="pase_dosdias" size="3" name="boletos[2dias][cantidad]" placeholder="0">
                    <input type="hidden" value="40" name="boletos[2dias][precio]">
                </div>
              </div>
            </li>
          </ul> <!--.lista-precios-->
      </div> <!--paquetes-->  

      <div id="eventos" class="eventos clearfix">
        <h3>Elige tus talleres</h3>
        <div class="caja">
          <?php
            try {
              require_once('../controlador/bd_conexion.php');
              $sql = "SELECT evento.*, categoria_evento.cat_evento, invitado.nombre_invitado, invitado.apellidopa_invitado, invitado.apellidoma_invitado FROM evento ";
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
                'apellidopa_invitado' => $evento['apellidopa_invitado'],
                'apellidoma_invitado' => $evento['apellidoma_invitado']
              );
              $eventos_dias[$dia_semana]['eventos'][$categoria][] = $dia;
            }
          ?>
          
          <?php foreach($eventos_dias as $dia => $evento) { ?>
            <div id="<?php echo str_replace('á', 'a', $dia); ?>" class="contenido-dia clearfix">
              <h4><?php echo $dia; ?></h4>
              <?php foreach($evento['eventos'] as $tipo => $evento_dia): ?>
              <div>
                <p><?php echo $tipo; ?></p>
                <?php foreach($evento_dia as $evento) {  ?>
                <label>
                  <input type="checkbox" name="registro[]" id="<?php echo $evento['id']; ?>" value="<?php echo $evento['id']; ?>">
                  <time> <?php echo $evento['hora']; ?> </time> <?php echo $evento['nombre_evento']; ?> 
                  <br>
                  <span class="autor"> <?php echo $evento['nombre_invitado'] . " "  . $evento['apellidopa_invitado'] . " "  . $evento['apellidoma_invitado']; ?> </span>
                </label>
                <?php } ?>
              </div>
          <?php endforeach; ?>
            </div> <!--.contenido-dia-->
          <?php } ?>
        </div><!--.caja-->
      </div> <!--#eventos-->

      <div id="resumen" class="resumen">
        <h3>Pago y Extras</h3>
        <div class="caja clearfix">
          <div class="extras">
            <div class="orden">
              <label for="camisa_evento">Camisa del evento S/ 10 <small>(promocion 7% dto.)</small></label>
              <input type="number" min="0" id="camisa_evento" size="3" name="pedido_extra[camisas][cantidad]" placeholder="0">
              <input type="hidden" value="10" name="pedido_extra[camisas][precio]">
            </div> <!--.orden-->
            <div class="orden">
              <label for="etiquetas">Paquete de 10 etiquetas S/ 2 <small>(HTML5, CSS3, JavaScript, Chrome)</small></label>
              <input type="number" min="0" id="etiquetas" size="3" name="pedido_extra[etiquetas][cantidad]" placeholder="0">
              <input type="hidden" value="2" name="pedido_extra[etiquetas][precio]">
            </div> <!--.orden-->
            <div class="orden">
              <label for="regalo">Seleccione un regalo</label> <br>
              <select id="regalo" name="regalo" required>
                <option value="">--Seleccione un regalo--</option>
                <option value="2">Etiquetas</option>
                <option value="1">Pulsera</option>
                <option value="3">Plumas</option>
              </select> <!--#regalo-->
            </div> <!--.orden-->
            <input type="button" id="calcular" class="button" value="Calcular">
          </div> <!--.extras-->
          <div class="total">
            <p>Resumen:</p>
            <div id="lista-productos">
            </div> <!--#lista-productos-->
            <p>Total:</p>
            <div id="suma-total">
            </div> <!--#suma-total-->
            <input type="hidden" name="total_pedido" id="total_pedido">
            <input type="hidden" name="total_descuento" id="total_descuento" value="total_descuento">
            <input id="btnRegistro" type="submit" name="submit" class="button" value="Pagar">
          </div> <!--.total-->
        </div> <!--.caja-->
      </div> <!--#resumen-->
    </form> <!--#registro-->
  </section> <!--.seccion contenedor-->      
<?php include_once 'plantillas/footer-evento.php'; ?>