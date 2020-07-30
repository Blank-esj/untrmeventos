<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <section class="content-header">
    <!-- Content Header (Page header) -->
    <h1>
      Crear Categorías de Eventos
      <small>Llena el formulario para crear Categorías.</small>
    </h1>
  </section>
  <div class="row">
    <div class="col-md-8">
      <section class="content">
        <!-- Main content -->
        <div class="box">

          <!-- Default box -->
          <div class="box-header with-border">
            <h3 class="box-title">Crear Categoría</h3>
          </div>
          <div class="box-body">

            <?php
            //Botón para mostrar algún mensaje
            if ($mensaje != "") { ?>
              <div class="alert alert-success alert-dismissible fade show" role="alert" style="color: #000000 !important;">
                <?php echo $mensaje ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            <?php } ?>

            <!-- form start -->
            <form method="post" action="dashboard">
              <div class="box-body">

                <!-- Nombre -->
                <div class="form-group">
                  <label for="usuario">Nombre: </label>
                  <input type="text" class="form-control" id="nombre_categoria" name="nombre_categoria" placeholder="Ingresar nombre de categoría">
                </div>

                <!-- Ícono -->
                <div class="form-group">
                  <label for="">Ícono: </label>
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="far fa-address-book"> </i>
                    </div>
                    <input type="text" class="form-control pull-right" id="icono" name="icono" placeholder="fa-icon">
                  </div>
                </div>

              </div> <!-- /.box-body -->
              <div class="box-footer">
                <input type="hidden" name="dashboard" value="<?php echo openssl_encrypt("cat-evento-crear", COD, KEY) ?>">
                <button type="submit" class="btn btn-primary" id="crear_registro">Agregar</button>
              </div>

            </form>
          </div> <!-- /.box-body -->
        </div> <!-- /.box -->
      </section> <!-- /.content -->
    </div>
  </div>
</div> <!-- /.content-wrapper -->