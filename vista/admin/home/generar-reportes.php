<?php
include_once '../../plantillas/cabecera-admin.php';
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <section class="content-header">
    <!-- Content Header (Page header) -->
    <h1>
      Reportes
      <small>Selecciona el Reporte que deseas generar.</small>
    </h1>
  </section>
  <div class="row">
    <div class="col-md-8">
      <section class="content">
        <!-- Main content -->
        <div class="box">
          <!-- Default box -->
          <div class="box-header with-border">
            <h3 class="box-title">Generar Reporte</h3>
          </div>
          <div class="box-body">
            <!-- form start -->
            <form role="form">
              <div class="box-body">
                <div class="form-group">
                  <i class="fa fa-user"></i>
                  <label class="gen-reportes">Reporte de Administradores.</label>
                  <button type="button" class="btn btn-primary" onclick="location.href='../../../controlador/reporte/reporte-administrador.php'">
                    <i class="fas fa-print"></i>
                  </button>
                </div>
                <div class="form-group">
                  <i class="fa fa-address-card"></i>
                  <label class="gen-reportes">Reporte de Registrados.</label>
                  <button type="button" class="btn btn-primary" onclick="location.href='../../../controlador/reporte/reporte-registrado.php'">
                    <i class="fas fa-print"></i>
                  </button>
                </div>
                <div class="form-group">
                  <i class="fa fa-user-circle"></i>
                  <label class="gen-reportes">Reporte de Invitados.</label>
                  <button type="button" class="btn btn-primary" onclick="location.href='../../../controlador/reporte/reporte-invitado.php'">
                    <i class="fas fa-print"></i>
                  </button>
                </div>
                <div class="form-group">
                  <i class="fa fa-calendar"></i>
                  <label class="gen-reportes">Reporte de Eventos.</label>
                  <button type="button" class="btn btn-primary" onclick="location.href='../../../controlador/reporte/reporte-evento.php'">
                    <i class="fas fa-print"></i>
                  </button>
                </div>
              </div> <!-- /.box-body -->
              <div class="box-footer">
                <span>*Si tiene alguna dificutad o consulta comunicarse con el desarrollador.</span>
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