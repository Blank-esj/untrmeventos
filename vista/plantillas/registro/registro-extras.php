<?php

/**
 * Descripción
 * 
 */
?>

<h3 class="box-title text-center">Puedes elejir...</h3>
<div class="clearfix row">

    <div class="row row-cols-1 row-cols-md-6">

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
            <div class="col mb-2">
                <div class="card h-100 tabla-precio">
                    <img title="Camisa" alt="Camisa" class="card-img-top" src="https://www.dhresource.com/0x0/f2/albu/g7/M00/CA/73/rBVaSVuvjaKAR-lMAAHTwIMKsmw793.jpg" data-toggle="popover" data-trigger="hover" data-content="<?php echo $articulo['descripcion'] ?>">
                    <div class="card-body">

                        <h5 class="card-title">$ <?php echo $articulo['precio'] ?></h5>

                        <h6 class="card-subtitle mb-2 text-muted"><?php echo $articulo['nombre_articulo'] ?></h6>

                        <p class="card-text"><?php echo $articulo['descripcion'] ?></p>
                    </div>
                    <div class="card-footer">

                        <form action="" method="post">

                            <input type="hidden" name="id" value="<?php echo openssl_encrypt($articulo['idarticulo'], COD, KEY) ?>">
                            <input type="hidden" name="nombre" value="<?php echo openssl_encrypt($articulo['nombre_articulo'], COD, KEY) ?>">
                            <input type="hidden" name="precio" value="<?php echo openssl_encrypt($articulo['precio'], COD, KEY) ?>">
                            <input type="hidden" name="stock" value="<?php echo openssl_encrypt($articulo['stock'], COD, KEY) ?>">

                            <div class="text-center">
                                <?php
                                /**
                                 * Almacenamos la cantidad del articulo actual en la variable $cantidadArticuloSesion
                                 * Luego preguntamos si esta variable es nula o menor o igual a 0
                                 * Si es así mostramos un boton desactivado y común
                                 * Sino un botón acivo con su nombre y valor para que pueda realizar peticiones HTTP
                                 */
                                $cantidadArticuloSesion = $sesion->leerCantidadArticulo($articulo['idarticulo']);
                                if ($cantidadArticuloSesion === null || $cantidadArticuloSesion <= 0) { ?>
                                    <button class="btn btn-outline-light" type="button" disabled>
                                        <i class="material-icons" style="color: #fe4918;">remove_shopping_cart</i>
                                    </button>
                                <?php } else { ?>
                                    <button class="btn btn-outline-light" type="submit" name="registrarAsistente" value="disminuirUnArticulo">
                                        <i class="material-icons" style="color: #fe4918;">remove_shopping_cart</i>
                                        </button>
                                    <?php } ?>

                                    <span class="badge badge-light">
                                        <?php
                                        /**
                                         * Si la cantidad del articulo en la sesion es nula o menor o igual a 0 se mostrará 0
                                         * Sino se imprimirá el valor de la variable
                                         */

                                        echo ($cantidadArticuloSesion === null || $cantidadArticuloSesion <= 0) ? 0 : $cantidadArticuloSesion
                                        ?>
                                    </span>

                                    <?php
                                    /**
                                     * Preguntamos si la cantidad del articulo es menor que el stock actual del articulo
                                     * Si lo es mostrorá el botón para que pueda realizar la petición POST
                                     * Sino mostrará un boton simple y desactivado
                                     */
                                    if ($cantidadArticuloSesion < $articulo['stock']) { ?>
                                        <button class="btn btn-outline-light" type="submit" name="registrarAsistente" value="aumentarUnArticulo">
                                            <i class="material-icons" style="color: #fe4918;">add_shopping_cart</i>
                                        </button>
                                    <?php } else { ?>
                                        <button class="btn btn-outline-light" type="button" disabled>
                                            <i class="material-icons" style="color: #fe4918;">add_shopping_cart</i>
                                        </button>
                                    <?php } ?>

                            </div>
                        </form>

                    </div>
                </div>
            </div>
        <?php
        }
        ?>
    </div>
</div>