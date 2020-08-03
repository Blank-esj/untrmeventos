<?php

/**
 * Descripción
 * 
 */
?>

<h3 class="box-title text-center">Puedes elejir...</h3>
<div class="clearfix">
    <div class="container-fluid">

        <div class="row row-cols-1 row-cols-sm-3 row-cols-md-6 row-cols-lg-8 row-cols-lg-10">

            <?php
            try {
                $sql = "SELECT * FROM articulo WHERE stock > 0";
                $resul = $conn->query($sql);
            } catch (Exception $e) {
                $error = $e->getMessage();
                echo $error;
            }

            include_once 'controlador/global/config.php';

            while ($articulo = $resul->fetch_assoc()) {
            ?>
                <div class="col mb-3">

                    <div class="card h-100 tabla-precio" style="padding: 0;">

                        <img height="100px" title="<?php echo $articulo['nombre_articulo'] ?>" alt="<?php echo $articulo['nombre_articulo'] ?>" class="card-img-top" src="<?php echo DIR_IMG_ARTICULO . $articulo['url_imagen'] ?>" data-toggle="popover" data-trigger="hover" data-content="<?php echo $articulo['descripcion'] ?>">

                        <div class="card-body">

                            <h5 class="card-title text-left">$ <?php echo $articulo['precio'] ?></h5>

                            <h6 class="card-subtitle text-muted text-left"><?php echo $articulo['nombre_articulo'] ?></h6>

                            <div class="text-right">

                                <form action="" method="post">

                                    <input type="hidden" name="id" value="<?php echo openssl_encrypt($articulo['idarticulo'], COD, KEY) ?>">
                                    <input type="hidden" name="nombre" value="<?php echo openssl_encrypt($articulo['nombre_articulo'], COD, KEY) ?>">
                                    <input type="hidden" name="precio" value="<?php echo openssl_encrypt($articulo['precio'], COD, KEY) ?>">
                                    <input type="hidden" name="stock" value="<?php echo openssl_encrypt($articulo['stock'], COD, KEY) ?>">

                                    <?php
                                    /**
                                     * Almacenamos la cantidad del articulo actual en la variable $cantidadArticuloSesion
                                     * Luego preguntamos si esta variable es nula o menor o igual a 0
                                     * Si es así mostramos un boton desactivado y común
                                     * Sino un botón acivo con su nombre y valor para que pueda realizar peticiones HTTP
                                     */
                                    $cantidadArticuloSesion =
                                        $sesion->existeCantidadArticulo($articulo['idarticulo']) ?
                                        $sesion->leerCantidadArticulo($articulo['idarticulo']) : 0;

                                    if ($cantidadArticuloSesion === null || $cantidadArticuloSesion <= 0) { ?>
                                        <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="No puedo quitar más">
                                            <button class="btn" style="padding: 0px; border: 0; pointer-events: none;" type="button" disabled>
                                                <i class="material-icons" style="color: #fe4918; font-size: initial;">remove_shopping_cart</i>
                                            </button>
                                        </span>
                                    <?php } else { ?>
                                        <button class="btn" type="submit" style="padding: 0px; border: 0; " name="registrarAsistente" value="disminuirUnArticulo" data-toggle="tooltip" data-placement="bottom" title="Quitar del carrito">
                                            <i class="material-icons" style="color: #fe4918; font-size: initial;" style="color: #fe4918;">remove_shopping_cart</i>
                                        </button>
                                    <?php } ?>

                                    <span class=" text-nowrap badge badge-light">
                                        <?php echo $cantidadArticuloSesion; ?>
                                    </span>

                                    <?php
                                    /**
                                     * Preguntamos si la cantidad del articulo es menor que el stock actual del articulo
                                     * Si lo es mostrorá el botón para que pueda realizar la petición POST
                                     * Sino mostrará un boton simple y desactivado
                                     */
                                    if ($cantidadArticuloSesion < $articulo['stock']) { ?>
                                        <button class="btn" style="padding: 0px; border: 0;" type="submit" name="registrarAsistente" value="aumentarUnArticulo" data-toggle="tooltip" data-placement="bottom" title="Agrega al carrito">
                                            <i class="material-icons" style="color: #fe4918; font-size: initial;" style="color: #fe4918;">add_shopping_cart</i>
                                        </button>
                                    <?php } else { ?>
                                        <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="No hay stock">
                                            <button class="btn" style="padding: 0px; border: 0; pointer-events: none;" type="button" disabled>
                                                <i class="material-icons" style="color: #fe4918; font-size: initial;" style="color: #fe4918;">add_shopping_cart</i>
                                            </button>
                                        </span>
                                    <?php } ?>


                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
</div>