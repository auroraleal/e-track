<?php
session_start();
include '../../utils/bd.php';
include '../../utils/valida_login.php';

$stmt = $conn->prepare("SELECT * FROM cliente");
$stmt->execute();
?>

<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>e-track</title>
<!-- Tell the browser to be responsive to screen width -->
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="/e-track/assets/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="/e-track/assets/css/font-awesome/css/font-awesome.min.css"
  <!-- Theme style -->
  <link rel="stylesheet" href="/e-track/assets/css/AdminLTE.min.css">
<!-- AdminLTE Skins. Choose a skin from the css/skins
     folder instead of downloading all of them to reduce the load. -->
<link rel="stylesheet" href="/e-track/assets/css/skin-blue-light.min.css">

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

<!-- Google Font -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body class="hold-transition skin-blue-light sidebar-mini sidebar-collapse">
<!-- Site wrapper -->
<div class="wrapper">
  <?php include ('../../layout/menu-superior.php') ?>

  <!-- =============================================== -->

  <!-- Left side column. contains the sidebar -->
  <?php include ('../../layout/menu-lateral.php') ?>


  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <?php if (isset($_SESSION['msg'])) { ?>
    <div class="alert alert-info">
      <strong>Info:</strong> 
      <?php echo $_SESSION['msg']; unset($_SESSION['msg']);?>
    </div>
  <?php } ?>

        </div>
        <div class="col-xs-12">
          <a href="novo.php" class="btn btn-primary" style="margin-bottom: 20px; margin-top: 20px"><i class= "fa fa-plus-square"></i> </a>
        </div>
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title"><b>Lista de Clientes</b></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th style="text-align: center">Nome</th>
                  <th style="text-align: center">Email</th>
                  <th style="text-align: center">CNPJ</th>
                  <th style="text-align: center">Opções</th>
                </tr>
                </thead>
                <tbody>
                  <?php
                  
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
                    {
                      $id = $row['idcliente'];
                      echo '<tr>';
                        echo "<td align='center'>" . $row['nome'] . '</td>';
                        echo "<td align='center'>" . $row['email'] . '</td>';
                        echo "<td align='center'>" . $row['cnpj'] . '</td>';
                        
                    ?>
                    <td align='center'><a onclick="return confirm('Deseja realmente excluir?');" href='../../controllers/cliente/excluir.php?id=<?=$id?>' class='btn btn-danger'><i class='fa fa-trash'></i></a>

                    <?php 
                      echo "&nbsp;&nbsp<a href='editar.php?id=$id' title='Editar Cliente' class='btn btn-primary'><i class='fa fa-edit'></i></a>"  . '</td>';
                      echo '</tr>';
                  } ?>
                </tbody>
              </table>

            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <?php include ('/e-track/layout/footer.html');?>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="../../assets/js/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="../../assets/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="../../assets/js/adminlte.min.js"></script>
</body>
</html>
