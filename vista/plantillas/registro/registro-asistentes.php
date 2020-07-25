<h3 class="box-title text-center">Ingrese sus datos</h3>
<div id="datos_usuario" class="clearfix">

    <?php foreach ($sesion->leerPlanes() as $idPlan => $arrayPlan) { ?>

        <div class="card border-0">
            <div class="card-body">
                <h5 class="card-title"><?php echo $sesion->leerNombrePlan($idPlan) ?></h5>

                <div class="row row-cols-1 row-cols-md-2">

                    <?php foreach ($arrayPlan[N_ASISTENTES_PLAN] as $indice => $arrayAsistente) { ?>

                        <div class="col mb-4">
                            <div class="card">
                                <form action="" method="post">

                                    <div class="card-header">
                                        <?php echo $arrayAsistente[N_NOMBRE_ASISTENTE] ?>

                                        <button class="btn btn-outline-light text-right" type="submit" name="registrarAsistente" value="actualizarAsistente" data-toggle="tooltip" data-placement="bottom" title="Actualizar Asistente">
                                            <i class="material-icons" style="color: #fe4918;">update</i>
                                        </button>
                                        <!--
                                    <form action="" method="post">

                                        
                                        <input type="hidden" name="indice" value="<?php //openssl_encrypt($indice, COD, KEY) 
                                                                                    ?>">
                                        <input type="hidden" name="id" value="<?php //openssl_encrypt($idPlan, COD, KEY) 
                                                                                ?>">

                                        <button class="btn btn-outline-light" type="submit" name="registrarAsistente" value="borrarAsistente" data-toggle="tooltip" data-placement="bottom" title="Borrar Asistente">
                                            <i class="material-icons" style="color: #fe4918;">delete</i>

                                        </button>
                                    </form>
                                        -->
                                    </div>

                                    <div class="card-body">
                                        <div class="campo">
                                            <label for="nombre">Nombres</label>
                                            <input required class="form-control nombre" type="text" name="nombre" placeholder="Escribe tu nombre" value="<?php echo $arrayAsistente[N_NOMBRE_ASISTENTE] ?>">
                                        </div>
                                        <!--.Apellido Paterno-->
                                        <div class="campo">
                                            <label for="apellido">Apellido Paterno</label>
                                            <input class="form-control apellidopa" required type="text" name="apellidopa" placeholder="Escribe tu apellido paterno" value="<?php echo $arrayAsistente[N_APELLIDOPA_ASISTENTE] ?>">
                                        </div>
                                        <!--.Apellido Materno-->
                                        <div class="campo">
                                            <label for="apellido">Apellido Materno</label>
                                            <input class="form-control apellidoma" required type="text" name="apellidoma" placeholder="Escribe tu apellido materno" value="<?php echo $arrayAsistente[N_APELLIDOMA_ASISTENTE] ?>">
                                        </div>
                                        <!--.Email-->
                                        <div class="campo">
                                            <label for="email">Email</label>
                                            <input class="form-control email" required type="email" name="email" placeholder="Escribe tu email" value="<?php echo $arrayAsistente[N_EMAIL_ASISTENTE] ?>">
                                        </div>
                                        <!--.Teléfono-->
                                        <div class="campo">
                                            <label for="telefono">Teléfono</label>
                                            <input class="form-control telefono" required type="text" name="telefono" placeholder="Escribe tu Teléfono" value="<?php echo $arrayAsistente[N_TELEFONO_ASISTENTE] ?>">
                                        </div>
                                        <!--.Documento de Identidad-->
                                        <div class="campo">
                                            <label for="doc_identidad">Documento de Identidad</label>
                                            <input class="form-control doc_identidad" required type="text" name="doc_identidad" placeholder="Escribe tu documento de identidad" value="<?php echo $arrayAsistente[N_DOC_IDENTIDAD_ASISTENTE] ?>">
                                        </div>

                                        <!--.Regalos -->
                                        <div class="campo">
                                            <label for="regalo">Seleccione un regalo</label> <br>
                                            <select name="idregalo" class="form-control m-6">
                                                <option value=" ">-- Seleccione un regalo --</option>
                                                <?php
                                                try {
                                                    $sql = "SELECT * FROM regalo WHERE stock > 0";
                                                    $resul = $conn->query($sql);
                                                } catch (Exception $e) {
                                                    $error = $e->getMessage();
                                                    echo $error;
                                                }

                                                while ($regalo = $resul->fetch_assoc()) { ?>

                                                    <option <?php echo ($sesion->leerIdRegalo($idPlan, $indice) == $regalo['idregalo']) ? "selected" : "" ?> value="<?php echo openssl_encrypt($regalo['idregalo'], COD, KEY) ?>">
                                                        <?php echo $regalo['nombre_regalo'] ?>
                                                    </option>

                                                <?php } ?>
                                            </select>
                                        </div>

                                        <input type="hidden" name="indice" value="<?php echo openssl_encrypt($indice, COD, KEY) ?>">
                                        <input type="hidden" name="id" value="<?php echo openssl_encrypt($idPlan, COD, KEY) ?>">
                                        <!--.Regalos-->

                                        <!--.campo-->
                                        <div id="error"></div>

                                    </div>

                                </form>
                            </div>
                        </div>

                    <?php } ?>
                </div>
            </div>
        </div>

    <?php } ?>

</div>