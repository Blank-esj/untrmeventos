<?php /**
 * Descripción
 * 
 */
?>

<h3 class="box-title text-center">Puedes elejir...</h3>
<div class="clearfix row">

    <div class="row row-cols-1 row-cols-md-4">

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
            <div class="col mb-3">
                <div class="card h-100">
                    <img title="Camisa" alt="Camisa" class="card-img-top" src="https://www.dhresource.com/0x0/f2/albu/g7/M00/CA/73/rBVaSVuvjaKAR-lMAAHTwIMKsmw793.jpg" data-toggle="popover" data-trigger="hover" data-content="<?php echo $articulo['descripcion'] ?>">
                    <div class="card-body">

                        <h5 class="card-title">$ <?php echo $articulo['precio'] ?></h5>

                        <h6 class="card-subtitle mb-2 text-muted"><?php echo $articulo['nombre_articulo'] ?></h6>

                        <p class="card-text"><?php echo $articulo['descripcion'] ?></p>

                        <form action="" method="post">

                            <input type="hidden" name="id" id="idarticulo" value="<?php echo openssl_encrypt($datosSesion['ID'], COD, KEY) ?>">
                            <input type="hidden" name="nombre" id="nombrearticulo" value="<?php echo openssl_encrypt($datosSesion['Nombre'], COD, KEY) ?>">
                            <input type="hidden" name="precio" id="precio" value="<?php echo openssl_encrypt($datosSesion['Precio'], COD, KEY) ?>">
                            <input type="hidden" name="cantidad" id="cantidad" value="<?php echo openssl_encrypt(1, COD, KEY) ?>">

                            <div class="text-center">
                                <button class="btn btn-outline-light" type="submit" name="btnRegistro" value="borrarUnArticulo">
                                    <i class="material-icons" style="color: #fe4918;">remove_shopping_cart</i>
                                </button>
                                <span class="badge badge-light"><?php echo $datosSesion['ARTICULOS'][$articulo['id']]['CANTIDAD'] ?></span>
                                <button class="btn btn-outline-light" type="submit" name="btnRegistro" value="agregarUnArticulo">
                                    <i class="material-icons" style="color: #fe4918;">add_shopping_cart</i>
                                </button>
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