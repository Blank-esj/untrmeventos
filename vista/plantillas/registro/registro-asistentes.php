<h3 class="box-title text-center">Ingrese sus datos</h3>
<div id="datos_usuario" class="clearfix">
    <div class="campo">
        <label for="nombre">Nombres</label>
        <input class="form-control" required type="text" id="nombre" name="nombre" placeholder="Escribe tu nombre">
    </div>
    <!--.Apellido Paterno-->
    <div class="campo">
        <label for="apellido">Apellido Paterno</label>
        <input class="form-control" required type="text" id="apellidopa" name="apellidopa" placeholder="Escribe tu apellido paterno">
    </div>
    <!--.Apellido Materno-->
    <div class="campo">
        <label for="apellido">Apellido Materno</label>
        <input class="form-control" required type="text" id="apellidoma" name="apellidoma" placeholder="Escribe tu apellido materno">
    </div>
    <!--.Email-->
    <div class="campo">
        <label for="email">Email</label>
        <input class="form-control" required type="email" id="email" name="email" placeholder="Escribe tu email">
    </div>
    <!--.Teléfono-->
    <div class="campo">
        <label for="telefono">Teléfono</label>
        <input class="form-control" required type="text" id="telefono" name="telefono" placeholder="Escribe tu Teléfono">
    </div>
    <!--.Documento de Identidad-->
    <div class="campo">
        <label for="doc_identidad">Documento de Identidad</label>
        <input class="form-control" required type="text" id="doc_identidad" name="doc_identidad" placeholder="Escribe tu documento de identidad">
    </div>

    <!--.Regalos -->
    <div class="campo">
        <label for="regalo">Seleccione un regalo</label> <br>
        <select id="regalo" name="regalo" class="form-control m-6">
            <option value="">-- Seleccione un regalo --</option>
            <?php
            try {
                $sql = "SELECT * FROM regalo WHERE stock > 0";
                $resul = $conn->query($sql);
            } catch (Exception $e) {
                $error = $e->getMessage();
                echo $error;
            }

            while ($regalo = $resul->fetch_assoc()) {
            ?>
                <option value="<?php echo $regalo['idregalo'] ?>"><?php echo $regalo['nombre_regalo'] ?></option>
            <?php
            }
            ?>
        </select>
    </div>
    <!--.Regalos-->

    <!--.campo-->
    <div id="error"></div>
</div>