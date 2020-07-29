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
            <!-- form start -->
            <form role="form" id="guardar-registro" method="post" action="modelo/modelo-categoria.php">
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
                <input type="hidden" name="registro" value="nuevo">
                <button type="submit" class="btn btn-primary" id="crear_registro">Agregar</button>
              </div>

            </form>
          </div> <!-- /.box-body -->
        </div> <!-- /.box -->
      </section> <!-- /.content -->
    </div>
  </div>
</div> <!-- /.content-wrapper -->