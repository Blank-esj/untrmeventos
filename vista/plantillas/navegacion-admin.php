<?php
$sesion = new Sesion();
?>
<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="info">
        <p><?php echo $sesion->leerNombreUsuario(); ?></p>
        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>
    <!-- search form -->
    <form action="#" method="get" class="sidebar-form">
      <div class="input-group">
        <input type="text" name="q" class="form-control" placeholder="Buscar...">
        <span class="input-group-btn">
          <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
          </button>
        </span>
      </div>
    </form>
    <!-- /.search form -->
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu" data-widget="tree">
      <li class="header"><a href="dashboard?dashboard=area-admin">MENU DE ADMINISTRACION</a></li>

      <li class="treeview">
        <a href="#">
          <i class="fas fa-tachometer-alt" aria-hidden="true"></i>
          <span>Dashboard</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="dashboard?dashboard=dashboard"><i class="fas fa-chart-line" aria-hidden="true"></i> Dashboard </a></li>
        </ul>
      </li>

      <li class="treeview">
        <a href="#">
          <i class="fa fa-book"></i>
          <span>Eventos</span>
        </a>
        <ul class="treeview-menu">
          <li class="treeview">
            <a href="#">
              <i class="fa fa-cubes"></i>
              <span>Categoria</span>
            </a>
            <ul class="treeview-menu">
              <li><a href="dashboard?dashboard=lista-categoria"><i class="fa fa-list-ul" aria-hidden="true"></i> Ver Todos</a></li>
              <li><a href="dashboard?dashboard=crear-categoria"><i class="fa fa-plus-circle" aria-hidden="true"></i> Agregar </a></li>
            </ul>
          </li>

          <li class="treeview">
            <a href="#">
              <i class="fa fa-calendar"></i>
              <span>Temas</span>
            </a>
            <ul class="treeview-menu">
              <li><a href="dashboard?dashboard=lista-evento"><i class="fa fa-list-ul" aria-hidden="true"></i> Ver Todos</a></li>
              <li><a href="dashboard?dashboard=crear-evento"><i class="fa fa-plus-circle" aria-hidden="true"></i> Agregar </a></li>
            </ul>
          </li>
        </ul>
      </li>

      <li class="treeview">
        <a href="#">
          <i class="fa fa-sitemap"></i>
          <span>Planes</span>
        </a>
        <ul class="treeview-menu">
          <li><a href="dashboard?dashboard=lista-plan"><i class="fa fa-list-ul" aria-hidden="true"></i> Ver Todos</a></li>
          <li><a href="dashboard?dashboard=crear-plan"><i class="fa fa-plus-circle" aria-hidden="true"></i> Agregar </a></li>
          <li class="treeview">
            <a href="#">
              <i class="fa fa-trophy"></i>
              <span>Beneficios</span>
            </a>
            <ul class="treeview-menu">
              <li><a href="dashboard?dashboard=lista-beneficio"><i class="fa fa-list-ul" aria-hidden="true"></i> Ver Todos</a></li>
              <li><a href="dashboard?dashboard=crear-beneficio"><i class="fa fa-plus-circle" aria-hidden="true"></i> Agregar </a></li>

            </ul>
          </li>
        </ul>
      </li>

      <li class="treeview">
        <a href="#">
          <i class="fa fa-user"></i>
          <span>Artículos</span>
        </a>
        <ul class="treeview-menu">
          <li><a href="dashboard?dashboard=lista-articulo"><i class="fa fa-list-ul"></i> Ver Todos</a></li>
          <li><a href="dashboard?dashboard=crear-articulo"><i class="fa fa-plus-circle"></i> Agregar </a></li>
        </ul>
      </li>

      <li class="treeview">
        <a href="#">
          <i class="fa fa-user-circle"></i>
          <span>Invitados</span>
        </a>
        <ul class="treeview-menu">
          <li><a href="dashboard?dashboard=lista-invitado"><i class="fa fa-list-ul" aria-hidden="true"></i> Ver Todos</a></li>
          <li><a href="dashboard?dashboard=crear-invitado"><i class="fa fa-plus-circle" aria-hidden="true"></i> Agregar </a></li>
          <li class="treeview">
            <a href="#">
              <i class="fa fa-certificate"></i>
              <span>Grado de Instrucción</span>
            </a>
            <ul class="treeview-menu">
              <li><a href="dashboard?dashboard=lista-grado"><i class="fa fa-list-ul" aria-hidden="true"></i> Ver Todos</a></li>
              <li><a href="dashboard?dashboard=crear-grado"><i class="fa fa-plus-circle" aria-hidden="true"></i> Agregar </a></li>

            </ul>
          </li>
        </ul>
      </li>

      <li class="treeview">
        <a href="#">
          <i class="fa fa-address-card"></i>
          <span>Asistentes</span>
        </a>
        <ul class="treeview-menu">
          <li><a href="dashboard?dashboard=lista-registrado"><i class="fa fa-list-ul" aria-hidden="true"></i> Ver Todos</a></li>
          <li><a href="dashboard?dashboard=crear-registrado"><i class="fa fa-plus-circle" aria-hidden="true"></i> Agregar </a></li>
          <li class="treeview">
            <a href="#">
              <i class="fa fa-gift"></i>
              <span>Regalos</span>
            </a>
            <ul class="treeview-menu">
              <li><a href="dashboard?dashboard=lista-regalo"><i class="fa fa-list-ul" aria-hidden="true"></i> Ver Todos</a></li>
              <li><a href="dashboard?dashboard=crear-regalo"><i class="fa fa-plus-circle" aria-hidden="true"></i> Agregar </a></li>
            </ul>
          </li>
        </ul>
      </li>

      <?php
      if ($sesion->leerNivelUsuario() == 1) :
      ?>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-user"></i>
            <span>Administradores</span>
          </a>
          <ul class="treeview-menu">
            <li><a href="dashboard?dashboard=lista-admin"><i class="fa fa-list-ul"></i> Ver Todos</a></li>
            <li><a href="dashboard?dashboard=crear-admin"><i class="fa fa-plus-circle"></i> Agregar </a></li>
          </ul>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fas fa-print"></i>
            <span>Reportes</span>
          </a>
          <ul class="treeview-menu">
            <li><a href="dashboard?dashboard=generar-reportes"><i class="far fa-file-pdf"></i> Generar</a></li>
          </ul>
        </li>
      <?php endif;
      ?>
    </ul>
  </section>
  <!-- /.sidebar -->
</aside>
<!-- =============================================== -->