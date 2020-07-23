<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#staticBackdrop">
    Ver Resumen
</button>

<!-- Modal -->
<div class="modal-dialog modal-dialog-scrollable modal-sm">
    <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Resumen</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <?php
                    // Card para mostrar los card con los planes seleccionados
                    // Pregunta si existe algún plan en la sesión
                    if ($sesion->leerPlanes() !== null) {
                        foreach ($sesion->leerPlanes() as $idPlan => $arrayPlan) { ?>

                            <!-- Cards de los planes -->
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $sesion->leerNombrePlan($idPlan) ?></h5>
                                    <h6 class="card-subtitle mb-2 text-muted">$ <?php echo $sesion->leerPrecioPlan($idPlan) ?></h6>
                                </div>

                                <!-- Asistentes -->
                                <?php if ($sesion->leerAsistentesPlan($idPlan) !== null) {
                                    foreach ($sesion->leerAsistentesPlan($idPlan) as $doc_identidad => $arrayAsistente) { ?>
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
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Ok</button>
                </div>
            </div>
        </div>
    </div>
</div>