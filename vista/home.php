<section class="seccion contenedor">
    <h2>Curso Taller - Objetivo</h2>
    <p>
        Capacitar a los participantes en el desarrollo de tesis en ingeniería, a fin de incrementar el número de graduados y titulados por tesis.
    </p>
</section>
<!--.seccion contenedor-->

<section class="programa">
    <div class="contenedor-img">
        <img style="width: 100%;" src="vista/assets/img/bg-talleres.jpg">
    </div>
    <!--.contenedor-img-->
    <div class="contenido-programa">
        <div class="contenedor">
            <div class="programa-evento">
                <h2>Contenido del Evento</h2>
                <?php
                try {
                    require_once('controlador/util/bd_conexion.php');
                    $sql = "SELECT * FROM  v_detalle_evento; ";
                    $resultado = $conn->query($sql);
                } catch (Exception $e) {
                    $error = $e->getMessage();
                }
                ?>
                <nav class="menu-programa">
                    <?php while ($cat = $resultado->fetch_array(MYSQLI_ASSOC)) { ?>
                        <?php $categoria = $cat['cat_evento']; ?>
                        <a href="#<?php echo strtolower($categoria) ?>">
                            <i class="fa <?php echo $cat['icono'] ?>" aria-hidden="true"></i> <?php echo $categoria ?>
                        </a>
                    <?php } ?>
                </nav>
                <!--.menu-programa-->
                <?php
                try {
                    require_once('controlador/util/bd_conexion.php');
                    /** guardamos en la variable "row" todos los IDs de categoria*/
                    $sql = "SELECT id_categoria FROM categoria_evento ORDER BY id_categoria; ";
                    $resultado = $conn->query($sql);
                    $row = $resultado->fetch_all(MYSQLI_ASSOC);
                    $i = 0;
                    /** Iteramos todas las categorias que tengamos */
                    $sql = "";
                    foreach ($row as $categoria) :
                        $sql .= "SELECT id_evento, nombre_evento, fecha_evento, hora_evento, cat_evento, icono, CONCAT(nombres, ' ', apellidopa, ' ', apellidoma) AS nombre_invitado ";
                        $sql .= "FROM evento ";
                        $sql .= "INNER JOIN categoria_evento ";
                        $sql .= "ON evento.id_cat_evento = categoria_evento.id_categoria ";
                        $sql .= "INNER JOIN persona ";
                        $sql .= "ON evento.id_inv = persona.idpersona ";
                        $sql .= "AND evento.id_cat_evento = " . $categoria["id_categoria"] . " ";
                        $sql .= "ORDER BY id_evento LIMIT 2;";
                        $i++;
                    endforeach;
                } catch (Exception $e) {
                    $error = $e->getMessage();
                }
                ?>
                <?php $conn->multi_query($sql); ?>
                <?php
                /** 
                 * Iteramos en cada resultado de la consulta anterior con un do-while
                 * Luego iteramos con un foreach para añadir los dos primeros resultados
                 * Si es el primera iteración que agregue el elemento "div padre"
                 * Dentro del "div padre" agrega los datos el evento
                 * Al final del loop que cierre el "div padre"
                 */
                do {
                    $resultado = $conn->store_result();
                    if ($resultado !== false) {
                        $row = $resultado->fetch_all(MYSQLI_ASSOC);
                ?>
                        <?php $i = 0; ?>
                        <!-- 2 primeros detalles de este evento -->
                        <?php foreach ($row as $evento) : ?>
                            <?php if ($i == 0) { ?>
                                <div id="<?php echo strtolower($evento['cat_evento']) ?>" class="info-curso ocultar clearfix">
                                <?php } ?>
                                <div class="detalle-evento">
                                    <h3><?php echo html_entity_decode($evento['nombre_evento']) ?></h3>
                                    <p><i class="fas fa-clock" aria-hidden="true"></i> <?php echo $evento['hora_evento']; ?></p>
                                    <p><i class="fas fa-calendar" aria-hidden="true"></i> <?php echo $evento['fecha_evento']; ?></p>
                                    <p><i class="fas fa-user" aria-hidden="true"></i> <?php echo $evento['nombre_invitado']; ?></p>
                                    <!--.detalle-evento-->
                                    <?php if ($i == count($row) - 1) : ?>
                                </div>
                                <!-- boton ver todos -->
                                <a href="calendario" class="button float-right">Ver todos</a>
                            <?php endif; ?>
                                </div>
                                <!--#talleres-->
                                <?php $i++; ?>
                            <?php endforeach; ?>
                            <?php $resultado->free(); ?>
                    <?php }
                } while ($conn->more_results() && $conn->next_result()); ?>
            </div>
            <!--.programa-evento-->
        </div>
        <!--.contenedor-->
    </div>
    <!--.contenido-programa-->
</section>
<!--.programa-->

<?php include_once 'vista/plantillas/invitados-evento.php'; ?>
<!--Llamada a template invitados-->

<div class="contador parallax">
    <div class="contenedor">
        <ul class="resumen-evento clearfix">
            <!-- DIAS -->
            <li>
                <p class="numero">
                    <?php
                    try {
                        $sql = "SELECT fecha_evento FROM evento GROUP BY (fecha_evento);";
                        $resultado = $conn->query($sql);
                    } catch (Exception $e) {
                        $error = $e->getMessage();
                    }
                    $row = $resultado->fetch_all(MYSQLI_ASSOC);
                    ?>
                    <?php echo count($row) ?>
                </p> Dias
            </li>

            <!-- Invitados -->
            <li>
                <p class="numero">
                    <?php
                    try {
                        $sql = "SELECT count(*) AS cantidad FROM invitado";
                        $resultado = $conn->query($sql);
                    } catch (Exception $e) {
                        $error = $e->getMessage();
                    }
                    $row = $resultado->fetch_all(MYSQLI_ASSOC);
                    ?>
                    <?php echo $row[0]['cantidad'] ?>
                </p> Invitados
            </li>

            <!-- Eventos -->
            <?php
            try {
                $sql = "SELECT * FROM v_categoria_cantidad_evento;";
                $resultado = $conn->query($sql);
            } catch (Exception $e) {
                $error = $e->getMessage();
            }
            $row = $resultado->fetch_all(MYSQLI_ASSOC);
            ?>
            <?php foreach ($row as $catego) : ?>
                <?php if ($catego['categoria_evento'] > 0) : ?>
                    <li>
                        <p class="numero">
                            <?php echo $catego['cantidad'] ?>
                        </p> <?php echo $catego['categoria_evento'] ?>
                    </li>
                <?php endif; ?>
            <?php endforeach; ?>
            <?php $conn->close(); // Cerramos la conexion a la base de datos
            ?>
        </ul>
        <!--.resumen-evento-->
    </div>
    <!--.contenedor-->
</div>
<!--.contador-->

<section class="ubicacion seccion">
    <h2>Ubicación - UNTRM</h2>
    <div id="mapa" class="mapa"> </div>
    <!--#mapa-->
</section>
<!--.precios seccion-->

<div class="newsletter parallax">
    <div class="contenido">
        <p> Registrate al newsletter:</p>
        <h3>UNTRM-Evento</h3>
        <a href="#mc_embed_signup" class="boton_newsletter button transparente">Registro</a>
    </div>
    <!--.contenido-->
</div>
<!--.newsletter-->