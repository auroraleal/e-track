<header class="main-header">

    <!-- Logo -->
    <a href="/e-conv/pages/index.php" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>CONV</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>e-Convênios</b></span>
    </a>

    <!-- Header Navbar: style can be found in header.less -->
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
              <img src="/e-conv/imagens/user-gray.png" class="user-image" alt="User Image"/>              
              <span class="hidden-xs"><?php echo $_SESSION['email'] . ' - ' . $_SESSION['perfil']; ?></span>
            </a>
          </li>
          
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="/e-conv/controllers/LogoutController.php">
              <i class="fa fa-sign-out"></i> Sair
            </a>
          </li>
        </ul>
      </div>

    </nav>
  </header>