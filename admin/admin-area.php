<?php
  include_once 'funciones/sesiones.php';
  include_once 'funciones/funciones.php';
  include_once 'templates/header.php';
  include_once 'templates/barra.php';
  include_once 'templates/navegacion.php';
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    
    <section class="content-header"> <!-- Content Header (Page header) -->
      <h1>
        Bienvenido(a) al panel de administración
        <small>Selecciona una de las opciones de la izquierda.</small>
      </h1>
    </section> <!-- .content-header -->
    
    <section class="content"> <!-- Main content -->
      <div class="box"> <!-- Default box -->
        <div class="box-header with-border">
          <h3 class="box-title">Administrador de Eventos El acceso sólo está permitido a personal autorizado.</h3>
        </div>
        <div class="box-body">
          <img src="img/admin_fisme.jpg">
        </div> <!-- /.box-body -->
        <div class="box-footer">
          FISME - Bagua
        </div> <!-- /.box-footer-->
      </div> <!-- /.box -->
    </section> <!-- /.content -->

  </div> <!-- /.content-wrapper -->
  
<?php
  include_once 'templates/footer.php';
?>