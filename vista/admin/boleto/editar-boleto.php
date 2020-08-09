<?php
$id = openssl_decrypt($_POST['id'], COD, KEY);
if (!filter_var($id, FILTER_VALIDATE_INT)) {
  die("Error");
}
include_once 'modelo/modelo-boleto.php';
include_once 'modelo/modelo-persona.php';

$boleto = (new BoletoModelo())->leerTabla((int)$id)[0];
$persona = (new PersonaModelo())->leer($boleto['idpersona'])[0];
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Editar Boleto
      <small>Llena el formulario para editar un Boleto manualmente.</small>
    </h1>
  </section>

  <div class="row">
    <div class="container-fluid">
      <section class="content">
        <!-- Main content -->
        <div class="box">
          <!-- Default box -->
          <div class="box-header with-border">
            <h3 class="box-title">Editar Boleto</h3>
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
                          <option <?php echo $boleto['idventa'] == $venta['idventa'] ? "selected" : "" ?> value="<?php echo openssl_encrypt($venta['idventa'], COD, KEY) ?>"> <?php echo $venta['nombres']; ?> &nbsp <?php echo $venta['apellidos']; ?> &nbsp <?php echo "inicio: ($ " . $venta['total_paypal'] . ")"; ?> &nbsp <?php echo "ahora: ($ " . $venta['total'] . ")"; ?> </option>
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
                        <option <?php echo $boleto['idplan'] == $plan['idplan'] ? "selected" : "" ?> value="<?php echo openssl_encrypt($plan['idplan'], COD, KEY) ?>"> <?php echo $plan['nombre']; ?> &nbsp <?php echo "($ " . $plan['precio'] . ")"; ?> </option>
                      <?php } ?>
                    </select>
                  </div>

                  <!-- Nombres -->
                  <div class="form-group col-md-6">
                    <label for="nombre_registrado">Nombres</label>
                    <input required type="text" class="form-control m6" id="nombre" name="nombre" placeholder="Nombre" value="<?php echo $persona['nombres'] ?>">
                  </div>
                  <!-- Apellido Paterno -->
                  <div class="form-group col-md-6">
                    <label for="apellidopa">Apellido Paterno</label>
                    <input required type="text" class="form-control m6" id="apellidopa" name="apellidopa" placeholder="Apellido paterno" value="<?php echo $persona['apellidopa'] ?>">
                  </div>

                  <!-- Apellido Materno -->
                  <div class="form-group col-md-6">
                    <label for="apellidoma">Apellido Materno</label>
                    <input required type="text" class="form-control m6" id="apellidoma" name="apellidoma" placeholder="Apellido materno" value="<?php echo $persona['apellidoma'] ?>">
                  </div>

                  <!-- Email -->
                  <div class="form-group col-md-6">
                    <label for="email">Email</label>
                    <input type="email" class="form-control m6" id="email" name="email" placeholder="Email" value="<?php echo $persona['email'] ?>">
                  </div>

                  <!-- Teléfono -->
                  <div class="form-group col-md-6">
                    <label for="telefono">Teléfono</label>
                    <input type="text" class="form-control m6" id="telefono" name="telefono" placeholder="Teléfono" value="<?php echo $persona['telefono'] ?>">
                  </div>

                  <!-- Documento de Identidad -->
                  <div class="form-group col-md-6">
                    <label for="doc_identidad">Documento de Identidad</label>
                    <input data-toggle="tooltip" data-placement="top" title="Tooltip on top" type="text" class="form-control m6" id="doc_identidad" name="doc_identidad" placeholder="Documento de Identidad" value="<?php echo $persona['doc_identidad'] ?>">
                  </div>

                  <!--.Regalos -->
                  <div class="form-group col-md-6">
                    <label for="regalo">Seleccione un regalo</label> <br>
                    <select id="regalo" name="regalo" class="form-control m-6">
                      <option value="">-- Seleccione un regalo --</option>
                      <?php
                      include_once 'modelo/modelo-regalo.php';
                      foreach ((new RegaloModelo())->leerRegalos() as $regalo) { ?>
                        <option <?php echo $boleto['idregalo'] == $regalo['idregalo'] ? "selected" : "" ?> value="<?php echo openssl_encrypt($regalo['idregalo'], COD, KEY) ?>"><?php echo $regalo['nombre_regalo'] ?></option>
                      <?php } ?>
                    </select>
                  </div>

                  <div id="error"></div>
                </div>

              </div> <!-- /.box-body -->

              <div class="box-footer">
                <input type="hidden" name="idboleto" value="<?php echo $_POST['id'] ?>">
                <button type="submit" name="dashboard" value="boleto-editar1" class="btn btn-primary">Actualizar</button>
              </div>

            </form>
          </div> <!-- /.box-body -->
        </div> <!-- /.box -->
      </section> <!-- /.content -->
    </div>
  </div>
</div> <!-- /.content-wrapper -->