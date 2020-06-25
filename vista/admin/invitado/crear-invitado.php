<?php
include_once '../../plantillas/cabecera-admin.php';
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Crear Invitados
      <small>Llena el formulario para crear un Invitado.</small>
    </h1>
  </section>
  <div class="row">
    <div class="col-md-8">
      <section class="content">
        <!-- Main content -->
        <div class="box">
          <!-- Default box -->
          <div class="box-header with-border">
            <h3 class="box-title">Crear Invitado</h3>
          </div>
          <div class="box-body">
            <!-- form start -->
            <form role="form" name="guardar-registro" id="guardar-registro-archivo" method="post" action="../../../modelo/modelo-invitado.php" enctype="multipart/form-data">
              <div class="box-body">
                <div class="form-group">
                  <label for="nombre_invitado">Nombres: </label>
                  <input type="text" class="form-control" id="nombre_invitado" name="nombre_invitado" placeholder="Ingresar nombres del invitado">
                </div>
                <div class="form-group">
                  <label for="apellidopa_invitado">Apellido Paterno: </label>
                  <input type="text" class="form-control" id="apellidopa_invitado" name="apellidopa_invitado" placeholder="Ingresar apellido paterno">
                </div>
                <div class="form-group">
                  <label for="apellidoma_invitado">Apellido Materno: </label>
                  <input type="text" class="form-control" id="apellidoma_invitado" name="apellidoma_invitado" placeholder="Ingresar apellido materno">
                </div>
                <div class="form-group">
                  <label for="biografia_invitado">Biografía: </label>
                  <textarea class="form-control" name="biografia_invitado" id="biografia_invitado" rows="8" placeholder="Presentación profesional"></textarea>
                </div>
                <div class="form-group">
                  <label for="imagen_invitado">Imagen:</label>
                  <input type="file" id="imagen_invitado" name="archivo_imagen">
                  <p class="help-block">Agregar la imagen del invitado aquí.</p>
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

<?php
include_once '../../plantillas/footer-admin.php';
?>