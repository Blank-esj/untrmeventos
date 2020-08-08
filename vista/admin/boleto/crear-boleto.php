<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Crear Boleto
      <small>Llena el formulario para crear un Boleto manualmente.</small>
    </h1>
  </section>

  <div class="row">
    <div class="container-fluid">
      <section class="content">
        <!-- Main content -->
        <div class="box">
          <!-- Default box -->
          <div class="box-header with-border">
            <h3 class="box-title">Crear Boleto</h3>
          </div>
          <div class="box-body">
            <!-- form start -->
            <form method="post" action="dashboard">
              <div class="box-body">
                <div class="row">

                  <!--.Venta -->
                  <div class="form-group col-md-6">
                    <label for="venta">Puede seleccionar una venta</label> <br>
                    <select id="venta" name="venta" class="form-control m-6">
                      <option value="">-- Seleccione una venta --</option>
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
                    <label for="plan">Seleccione un plan</label> <br>
                    <select required id="plan" name="plan" class="form-control m-6">
                      <option value="">-- Seleccione un plan --</option>
                      <?php
                      include_once 'modelo/modelo-plan.php';
                      foreach ((new PlanModelo)->leerOrdenadoPrecio() as $plan) { ?>
                        <option value="<?php echo $plan['idplan'] ?>"> <?php echo $plan['nombre']; ?> &nbsp <?php echo "($ " . $plan['precio'] . ")"; ?> </option>
                      <?php } ?>
                    </select>
                  </div>

                  <!-- Nombres -->
                  <div class="form-group col-md-6">
                    <label for="nombre_registrado">Nombres</label>
                    <input required type="text" class="form-control m6" id="nombre" name="nombre" placeholder="Nombre">
                  </div>
                  <!-- Apellido Paterno -->
                  <div class="form-group col-md-6">
                    <label for="apellidopa">Apellido Paterno</label>
                    <input required type="text" class="form-control m6" id="apellidopa" name="apellidopa" placeholder="Apellido paterno">
                  </div>

                  <!-- Apellido Materno -->
                  <div class="form-group col-md-6">
                    <label for="apellidoma">Apellido Materno</label>
                    <input required type="text" class="form-control m6" id="apellidoma" name="apellidoma" placeholder="Apellido materno">
                  </div>

                  <!-- Email -->
                  <div class="form-group col-md-6">
                    <label for="email">Email</label>
                    <input type="email" class="form-control m6" id="email" name="email" placeholder="Email">
                  </div>

                  <!-- Teléfono -->
                  <div class="form-group col-md-6">
                    <label for="telefono">Teléfono</label>
                    <input type="text" class="form-control m6" id="telefono" name="telefono" placeholder="Teléfono">
                  </div>

                  <!-- Documento de Identidad -->
                  <div class="form-group col-md-6">
                    <label for="doc_identidad">Documento de Identidad</label>
                    <input data-toggle="tooltip" data-placement="top" title="Tooltip on top" type="text" class="form-control m6" id="doc_identidad" name="doc_identidad" placeholder="Documento de Identidad">
                  </div>

                  <!--.Regalos -->
                  <div class="form-group col-md-6">
                    <label for="regalo">Seleccione un regalo</label> <br>
                    <select id="regalo" name="regalo" class="form-control m-6">
                      <option value="">-- Seleccione un regalo --</option>
                      <?php
                      include_once 'modelo/modelo-regalo.php';
                      foreach ((new RegaloModelo())->leerRegalos() as $regalo) { ?>
                        <option value="<?php echo $regalo['idregalo'] ?>"><?php echo $regalo['nombre_regalo'] ?></option>
                      <?php } ?>
                    </select>
                  </div>

                  <div id="error"></div>
                </div>

              </div> <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" name="dashboard" value="boleto-crear" class="btn btn-primary">Agregar</button>
              </div>

            </form>
          </div> <!-- /.box-body -->
        </div> <!-- /.box -->
      </section> <!-- /.content -->
    </div>
  </div>
</div> <!-- /.content-wrapper -->