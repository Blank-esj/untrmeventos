<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <section class="content-header">
    <!-- Content Header (Page header) -->
    <h1>
      Crear Categorías
      <small>Aquí podrás agregar una nueva categoría.</small>
    </h1>
  </section>

  <div class="row">
    <div class="col-md-12">
      <section class="content">
        <!-- Main content -->
        <div class="box">

          <!-- Default box -->
          <div class="box-header with-border">
            <h3 class="box-title">Crear Categoría</h3>
          </div>

          <!-- form start -->
          <form method="post" action="dashboard">
            <div class="box-body">

              <!-- Nombre -->
              <div class="form-group col-md-6">
                <label for="usuario">Nombre: </label>
                <input type="text" class="form-control" id="nombre_categoria" name="nombre_categoria" placeholder="Ingrese el nombre">
              </div>

              <!-- Ícono -->
              <div class="form-group col-md-6">
                <label for="">Ícono: </label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calenda"></i>
                  </div>
                  <input type="text" class="form-control pull-right" id="icono" name="icono" placeholder="fa-icon">
                </div>
              </div>

            </div> <!-- /.box-body -->
            <div class="box-footer">
              <input type="hidden" name="dashboard" value="categoria-evento-crear">
              <button type="submit" class="btn btn-primary" id="crear_registro">Agregar</button>
            </div>

          </form>

        </div> <!-- /.box -->
      </section> <!-- /.content -->
    </div>
  </div>
</div> <!-- /.content-wrapper -->