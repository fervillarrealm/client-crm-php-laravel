<header class="main-header">
    <!-- Logo -->
    <a href="{{ route('home') }}" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>CS</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Cs</b>Cloud</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="#" title="Ayuda" aria-expanded="false"><i class="fa fa-info-circle"></i></a>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" title="Sistema" aria-expanded="false"><i class="fa fa-gear"></i></a>
            <ul class="dropdown-menu">
              <li>
                <a href="#">Configuración del Sistema</a>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="{{ route('logout') }}"><i class="fa fa-power-off"></i></a>
          </li>
        </ul>
      </div>
    </nav>
  </header>