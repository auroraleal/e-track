<header class="main-header">

    <!-- Logo -->
    <a href="#" class="logo">
    <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>TRACK</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>e-track</b></span>
    </a>

    <!-- menu-superior Navbar: style can be found in menu-superior.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Notifications: style can be found in dropdown.less -->
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-user"></i> 
              <?php echo '<b>' . $_SESSION['usuario'] . ' - ' . $_SESSION['perfil'] . '</b>';
                if (isset($_SESSION['nome_cliente'])) {
                  echo '<b>' . ': ' . $_SESSION['nome_cliente'] . '</b>';
                }
              ?>
          </a>
          </li>
          
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="../../controllers/LogoutController.php">
              <i class="fa fa-sign-out"></i> Sair
            </a>
          </li>
        </ul>
      </div>

    </nav>
  </header>