<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header" style="text-align: center">Opções</li>
        <?php if ($_SESSION['perfil'] == 'Cliente' || $_SESSION['perfil'] == 'Administrador') { ?>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-archive"></i> <span>Carga</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="../../pages/carga/novo.php"><i class="fa fa-edit"></i> Cadastrar</a></li>
            <li><a href="../../pages/carga/listar.php"><i class="fa fa-list"></i> Listar</a></li>
         </ul>
        </li>
        <?php } ?>
        <?php if ($_SESSION['perfil'] == 'Operador Triagem' || 
                  $_SESSION['perfil'] == 'Operador ETC' || 
                  $_SESSION['perfil'] == 'Administrador') { ?>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-truck"></i> <span>Operador</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
          <li><a href="../../pages/operador/pesquisar.php"><i class="fa fa-search"></i> Pesquisar</a></li>
            <li><a href="../../pages/operador/listar.php"><i class="fa fa-list"></i> Listar</a></li>
          </ul>
        </li>
        <?php } ?>
        <?php if ($_SESSION['perfil'] == 'Administrador') { ?>
          <li class="treeview">
            <a href="#">
              <i class="fa fa-address-card"></i> <span>Clientes</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">          
              <li><a href="../../pages/cliente/novo.php"><i class="fa fa-plus"></i> Cadastrar</a></li>
              <li><a href="../../pages/cliente/listar.php"><i class="fa fa-address-book"></i> Listar</a></li>
            
         </ul>
        </li>
        <?php } ?>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-user"></i> <span>Usuários</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
          <?php if ($_SESSION['perfil'] == 'Administrador') { ?>
            <li><a href="../../pages/usuarios/novo.php"><i class="fa  fa-user-plus "></i> Cadastrar</a></li>
            <li><a href="../../pages/usuarios/listar.php"><i class="fa fa-users"></i> Listar</a></li>
          <?php } ?>
            <li><a href="../../pages/usuarios/alterar-senha.php"><i class="fa fa-key"></i> Alterar Senha</a></li>
         </ul>
        </li>
    </section>
    <!-- /.sidebar -->
  </aside>