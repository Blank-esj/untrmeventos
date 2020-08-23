<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Crear Boletos
      <small>Aquí podrás agregar un nuevo boleto.</small>
    </h1>
  </section>

  <div class="row">
    <div class="col-md-12">
      <section class="content">
        <!-- Main content -->
        <div class="box">
          <!-- Default box -->
          <div class="box-header with-border">
            <h3 class="box-title">Crear Boleto</h3>
          </div>

          <!-- form start -->
          <form method="post" action="dashboard">
            <div class="box-body">

              <!--.Venta -->
              <div class="form-group col-md-6">
                <label for="venta">Venta:</label> <br>
                <select id="venta" name="venta" class="form-control">
                  <option value="">-- Seleccione --</option>
                  <?php
                  include_once 'modelo/modelo-venta.php';
                  foreach ((new VentaModelo)->leerTodos() as $venta) {
                    if ($venta['estado'] == 'completo') { ?>
                      <option value="<?php echo $venta['idventa'] ?>"> <?php echo $venta['nombres']; ?> &nbsp <?php echo $venta['apellidos']; ?> &nbsp <?php echo "inicio: ($ " . $venta['total_paypal'] . ")"; ?> &nbsp <?php echo "ahora: ($ " . $venta['total'] . ")"; ?> </option>
                  <?php }
                  } ?>
                </select>
              </div>

              <!--.Planes -->
              <div class="form-group col-md-6">
                <label for="plan">Plan: </label> <br>
                <select required id="plan" name="plan" class="form-control">
                  <option value="">-- Seleccione --</option>
                  <?php
                  include_once 'modelo/modelo-plan.php';
                  foreach ((new PlanModelo)->leerOrdenadoPrecio() as $plan) { ?>
                    <option value="<?php echo $plan['idplan'] ?>"> <?php echo $plan['nombre']; ?> &nbsp <?php echo "($ " . $plan['precio'] . ")"; ?> </option>
                  <?php } ?>
                </select>
              </div>

              <!-- Nombres -->
              <div class="form-group col-md-6">
                <label for="nombre_registrado">Nombres: </label>
                <input required type="text" class="form-control m6" id="nombre" name="nombre" placeholder="Ingrese el nombre (es)">
              </div>
              <!-- Apellido Paterno -->
              <div class="form-group col-md-6">
                <label for="apellidopa">Apellido Paterno: </label>
                <input required type="text" class="form-control m6" id="apellidopa" name="apellidopa" placeholder="Ingrese el apellido paterno">
              </div>

              <!-- Apellido Materno -->
              <div class="form-group col-md-6">
                <label for="apellidoma">Apellido Materno: </label>
                <input required type="text" class="form-control m6" id="apellidoma" name="apellidoma" placeholder="Ingrese el apellido materno">
              </div>

              <!-- Email -->
              <div class="form-group col-md-6">
                <label for="email">Email: </label>
                <input type="email" class="form-control m6" id="email" name="email" placeholder="Ingrese un email">
              </div>

              <!-- Teléfono -->
              <div class="form-group col-md-6">
                <label for="telefono">Teléfono: </label>
                <input type="text" class="form-control m6" id="telefono" name="telefono" placeholder="Ingrese un teléfono">
              </div>

              <!-- Documento de Identidad -->
              <div class="form-group col-md-6">
                <label for="doc_identidad">Documento de Identidad: </label>
                <input data-toggle="tooltip" data-placement="top" type="text" class="form-control m6" id="doc_identidad" name="doc_identidad" placeholder="Ingrese un documento de identidad">
              </div>

              <!--.Regalos -->
              <div class="form-group col-md-6">
                <label for="regalo">Regalo: </label> <br>
                <select id="regalo" name="regalo" class="form-control">
                  <option value="">-- Seleccione --</option>
                  <?php
                  include_once 'modelo/modelo-regalo.php';
                  foreach ((new RegaloModelo())->leerRegalos() as $regalo) { ?>
                    <option value="<?php echo $regalo['idregalo'] ?>"><?php echo $regalo['nombre_regalo'] ?></option>
                  <?php } ?>
                </select>
              </div>

              <div id="error"></div>


            </div> <!-- /.box-body -->

            <div class="box-footer">
              <button type="submit" name="dashboard" value="boleto-crear" class="btn btn-primary">Agregar</button>
            </div>

          </form>

        </div> <!-- /.box -->
      </section> <!-- /.content -->
    </div>
  </div>
</div> <!-- /.content-wrapper -->