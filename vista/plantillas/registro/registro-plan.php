<?php

/**
 * Descripción
 * 0. El cliente solicita esta página
 * 1. PHP escribe los datos de los planes en las etiquetas correspondientes
 *    1.1. Agrega inputs ocultos "hidden" a la página, estos inputs tienen los valores encriptados, los inputs son los siguientes:
 *         - Id del plan
 *         - Nombre del plan
 *         - Precio del plan
 *    1.2. Agrega 1 botón para agregar este plan al carrito, éste tiene la dirección de la pagina y el valor
 * 2. La página construida es enviada al cliente que la ha solicitado
 * 3. El usuario hace click el el botón y éste envía por el método POST el formulario con los valores de los inputs ocultos y del botón
 * 4. El servidor Apache recibe el formulario y PHP hace lo siguiente:
 *    4.1. Evalúa según el valor del botón
 *    4.2. Desencripta el valor de los inputs
 *    4.3. Agrega el plan a la sesion actual
 * 5. Retorna la página al solicitante
 */
?>

<h3 class="text-center">Elije un plan</h3>
<ul class="lista-precios clearfix">
    <div id="planes" class="row row-cols-1 row-cols-md-4 ">

        <?php
        try {
            $sql = "SELECT * FROM plan ORDER BY precio ASC;";
            $resultado = $conn->query($sql);
        } catch (Exception $e) {
            $error = $e->getMessage();
            echo $error;
        }

        while ($plan = $resultado->fetch_assoc()) {
        ?>

            <li>
                <div class="col mb-4">
                    <div id="<?php echo $plan['idplan'] ?>" style="cursor: pointer;" class="tabla-precio card h-100 rounded card-registro">
                        <div class="card-body">
                            <!-- Nombre del Plan -->
                            <h3><?php echo $plan['nombre']; ?></h3>

                            <p><?php echo $plan['descripcion']; ?></p>

                            <!-- Precio del Plan -->
                            <p class="numero"> $ <?php echo $plan['precio']; ?></p>

                            <ul>

                                <?php
                                try {
                                    $sql = "SELECT nombre 
                                    FROM plan_beneficio pb, beneficio b 
                                    WHERE pb.idplan = " . $plan['idplan'] .
                                        " AND pb.idbeneficio = b.idbeneficio 
                                    ORDER BY nombre ASC;";

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

                            <form action="" method="post">

                                <input type="hidden" name="id" value="<?php echo openssl_encrypt($plan['idplan'], COD, KEY) ?>">
                                <input type="hidden" name="nombre" value="<?php echo openssl_encrypt($plan['nombre'], COD, KEY) ?>">
                                <input type="hidden" name="precio" value="<?php echo openssl_encrypt($plan['precio'], COD, KEY) ?>">

                                <div class="text-center">
                                    <button class="btn btn-outline-light" type="submit" name="registrarAsistente" value="seleccionaPlan" data-toggle="tooltip" data-placement="bottom" title="Añadir un Asistente">
                                        <i class="material-icons" style="color: #fe4918;">add_shopping_cart</i>
                                    </button>
                                </div>
                            </form>


                        </div>
                    </div>
                </div>
            </li>
        <?php
        }
        $resul->close();
        $resultado->close();
        ?>
    </div>
</ul>