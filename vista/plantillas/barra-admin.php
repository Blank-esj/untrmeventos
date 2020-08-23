<body class="hold-transition skin-blue sidebar-mini">
  <!-- Site wrapper -->
  <div class="wrapper">

    <header class="main-header">
      <!-- Logo -->
      <a href="home" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>U</b>-E</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>UNTRM</b> - Eventos</span>
      </a>
      <!-- Header Navbar: style can be found in header.less -->
      <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </a>
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <li class="dropdown user user-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <span class="hidden-xs">Hola: <?php echo $sesion->leerNombreUsuario(); ?></span>
              </a>
              <ul class="dropdown-menu">
                <!-- Menu Footer-->
                <li class="user-footer">
                  <div class="pull-left">
                    <form action="dashboard" method="post" style="display: inline;">
                      <input type="hidden" name="id" value="<?php echo openssl_encrypt($sesion->leerIdUsuario(), COD, KEY) ?>">
                      <button type="submit" name="dashboard" value="administrador-editar0" class="btn btn-warning">
                        Ajustes
                      </button>
                    </form>
                  </div>
                  <div class="pull-right">
                    <form action="home" method="post" style="display: inline;">
                      <button type="submit" name="cerrar" value="true" class="btn btn-warning">
                        Salir
                      </button>
                    </form>
                  </div>
                </li>
              </ul>
            </li>
          </ul>
        </div>
      </nav>
    </header>
    <!-- =============================================== -->