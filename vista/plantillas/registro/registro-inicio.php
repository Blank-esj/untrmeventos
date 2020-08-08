<?php
include_once 'controlador/util/bd_conexion_pdo.php';
include 'modelo/modelo-registrado.php';
?>

<section class="seccion container-fluid">
    <h2>Registro de Asistentes</h2>

    <ul class="nav nav-tabs justify-content-end" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link active" id="tab-planes" data-toggle="pill" href="#pill-planes" role="tab" aria-controls="pill-planes" aria-selected="true">
                <i class="material-icons">psychology</i>
                Planes
            </a>
        </li>

        <?php if ($sesion->existePlanes()) { ?>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="tab-asistentes" data-toggle="pill" href="#pills-asistentes" role="tab" aria-controls="pills-asistentes" aria-selected="false">
                    <i class="material-icons">people</i>
                    Asistente
                </a>
            </li>
        <?php } ?>

        <li class="nav-item" role="presentation">
            <a class="nav-link" id="tab-extras" data-toggle="pill" href="#pills-extras" role="tab" aria-controls="pills-extras" aria-selected="false">
                <i class="material-icons">shopping_bag</i>
                Extra
            </a>
        </li>

        <?php
        $totalPedidos = $sesion->cantidadTotal();
        if ($sesion->existeAsistentes() || $totalPedidos > 0) { ?>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="tab-pago" data-toggle="pill" href="#pills-pago" role="tab" aria-controls="pills-pago" aria-selected="false">
                    <i class="material-icons">shopping_cart</i>
                    Carrito
                    <span class="rounded-circle badge badge-success">
                        <?php echo $totalPedidos ?>
                    </span>
                </a>
            </li>
        <?php } ?>

    </ul>

    <?php
    //Botón para mostrar algún mensaje
    if ($mensaje != "") { ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?php echo $mensaje ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php }
    // Boton modal (emergente) para mostrar el resumen
    include 'registro-modal-resumen.php';
    ?>

    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active container-fluid" id="pill-planes" role="tabpanel" aria-labelledby="tab-planes">
            <?php include_once 'registro-plan.php' ?>
        </div>

        <?php
        if ($sesion->existePlanes()) { ?>
            <div class="tab-pane fade container-fluid" id="pills-asistentes" role="tabpanel" aria-labelledby="tab-asistentes">
                <?php include_once 'registro-asistentes.php' ?>
            </div>
        <?php } ?>

        <div class="tab-pane fade container-fluid" id="pills-extras" role="tabpanel" aria-labelledby="tab-extras">
            <?php include_once 'registro-extras.php' ?>
        </div>

        <?php if ($sesion->existeAsistentes() || $totalPedidos > 0) { ?>
            <div class="tab-pane fade container-fluid" id="pills-pago" role="tabpanel" aria-labelledby="tab-pago">
                <?php include_once 'registro-pago.php' ?>
            </div>
        <?php } ?>

    </div>

</section>