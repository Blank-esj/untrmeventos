<?php

/**
 * Este archivo es el modal (ventana emergente) sirve para vizualizar un resumen del carrito de compra
 */
?>

<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#staticBackdropResumen">
    Ver Resumen
</button>

<!-- Modal -->
<div class="modal-dialog modal-dialog-scrollable modal-sm" style="margin: 0;">
    <div class="modal fade" id="staticBackdropResumen" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropResumenLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropResumenLabel">Resumen</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <ul class="nav nav-tabs justify-content-end" id="tabResumen" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" id="tab-resumen-planes" data-toggle="pill" href="#pill-resumen-planes" role="tab" aria-controls="pill-resumen-planes" aria-selected="true">
                                <i class="material-icons">psychology</i>
                                Planes
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="tab-resumen-extras" data-toggle="pill" href="#pills-resumen-extras" role="tab" aria-controls="pills-resumen-extras" aria-selected="false">
                                <i class="material-icons">shopping_bag</i>
                                Extras
                            </a>
                        </li>
                    </ul>

                    <div class="tab-content" id="tabResumen">
                        <div class="tab-pane fade show active container-fluid" id="pill-resumen-planes" role="tabpanel" aria-labelledby="tab-resumen-planes">

                            <?php
                            /**
                             * Esta parte es de los cards de los planes y los asistentes a cada plan
                             */
                            ?>

                            <?php
                            // Card para mostrar los card con los planes seleccionados
                            // Pregunta si existe algún plan en la sesión
                            //$sesion = new Sesion();
                            if ($sesion->existePlanes()) {
                                foreach ($sesion->leerPlanes() as $idPlan => $arrayPlan) { ?>

                                    <!-- Cards de los planes -->
                                    <div class="card border-0" style="margin-top: .2rem;">
                                        <div class="card-body">
                                            <h5 class="card-title">
                                                <?php echo $sesion->leerNombrePlan($idPlan) ?>
                                                <span class="badge badge-primary">
                                                    <?php echo count($arrayPlan[N_ASISTENTES_PLAN]) ?>
                                                </span>
                                            </h5>
                                            <h6 class="card-subtitle mb-2 text-muted">$ <?php echo $sesion->leerPrecioPlan($idPlan) ?></h6>
                                        </div>

                                        <!-- Asistentes -->
                                        <?php
                                        if ($sesion->existeAsistentesPlan($idPlan)) {

                                            $regalos = $regalo->arrayNombres($conexion); // traemos una array ordenado en clave (idregalo) y valor (nombre_regalo)

                                            foreach ($sesion->leerAsistentesPlan($idPlan) as $indice => $arrayAsistente) { ?>

                                                <?php if ($arrayAsistente[N_DOC_IDENTIDAD_ASISTENTE] != "" || $arrayAsistente[N_DOC_IDENTIDAD_ASISTENTE] != null) { ?>

                                                    <a class="btn btn-light text-left" data-toggle="collapse" href="#coll-<?php echo $idPlan . "-" . $indice ?>" role="button" aria-expanded="false" aria-controls="coll-<?php echo $idPlan . "-" . $indice ?>">
                                                        <?php echo $arrayAsistente[N_NOMBRE_ASISTENTE] . " " . $arrayAsistente[N_APELLIDOPA_ASISTENTE] . " " . $arrayAsistente[N_APELLIDOMA_ASISTENTE] ?>
                                                    </a>

                                                    <div class="collapse" id="coll-<?php echo $idPlan . "-" . $indice ?>">
                                                        <ul class="list-group list-group-flush">

                                                            <li class="list-group-item text-muted align-middle">
                                                                <i class="material-icons" style="color: #fe4918;">contact_mail</i>
                                                                <?php echo $arrayAsistente[N_EMAIL_ASISTENTE] ?>
                                                            </li>

                                                            <li class="list-group-item text-muted">
                                                                <i class="material-icons" style="color: #fe4918;">contact_phone</i>
                                                                <?php echo $arrayAsistente[N_TELEFONO_ASISTENTE] ?>
                                                            </li>

                                                            <li class="list-group-item text-muted align-middle">
                                                                <i class="material-icons" style="color: #fe4918;">perm_identity</i>
                                                                <?php echo $arrayAsistente[N_DOC_IDENTIDAD_ASISTENTE] ?>
                                                            </li>

                                                            <li class="list-group-item text-muted">
                                                                <i class="material-icons" style="color: #fe4918;">redeem</i>
                                                                <?php echo $regalos[(int)$arrayAsistente[N_REGALO_ASISTENTE][N_ID_REGALO]]; ?>
                                                            </li>

                                                        </ul>
                                                    </div>

                                                <?php } ?>

                                            <?php }
                                        } else { ?>
                                            <div class="alert alert-info" role="alert">
                                                No hay asistentes en <strong> <?php echo $sesion->leerNombrePlan($idPlan) ?> </strong>
                                            </div>
                                        <?php } ?>
                                    </div>

                                <?php }
                            } else { ?>
                                <div class="jumbotron jumbotron-fluid">
                                    <h1 class="display-4 text-center">Aún no seleccionas ningún plan</h1>
                                    <hr class="my-4">
                                    <p>Descubre nuevos conocimientos con la FISME</p>
                                </div>
                            <?php } ?>

                        </div>

                        <div class="tab-pane fade container-fluid" id="pills-resumen-extras" role="tabpanel" aria-labelledby="tab-resumen-extras">


                            <?php
                            /**
                             * Esta sección de para mostrar los articulos o extras pedidos
                             */
                            ?>

                            <?php
                            // Card para mostrar los card con los extras seleccionados
                            // Pregunta si existe algún extra en la sesión
                            if ($sesion->existeArticulos()) {
                                foreach ($sesion->leerArticulos() as $idArticulo => $arrayArticulo) { ?>

                                    <!-- Cards de los planes -->
                                    <div class="card border-0" style="margin-top: .2rem;">
                                        <div class="card-body">
                                            <h5 class="card-title">
                                                <?php echo $sesion->leerNombreArticulo($idArticulo) ?>
                                                <span class="badge badge-primary">
                                                    <?php echo $sesion->leerCantidadArticulo($idArticulo) ?>
                                                </span>
                                            </h5>
                                            <h6 class="card-subtitle mb-2 text-muted">$ <?php echo $sesion->leerPrecioArticulo($idArticulo) ?></h6>
                                        </div>
                                    </div>

                                <?php }
                            } else { ?>
                                <div class="jumbotron jumbotron-fluid">
                                    <h1 class="display-4 text-center">No tienes ningún extra</h1>
                                    <hr class="my-4">
                                    <p>Descubre nuevos conocimientos con la FISME</p>
                                </div>
                            <?php } ?>

                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Ok</button>
                </div>
            </div>
        </div>
    </div>
</div>