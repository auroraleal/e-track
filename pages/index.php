<?php 
session_start(); 
include '../utils/bd.php';
include '../utils/valida_login.php';

$result = $conn->query("SELECT COUNT(*) as total
FROM convenios c WHERE DATEDIFF(c.termino, CURDATE()) <= 10;");
$vencer_10_dias = $result->fetch(PDO::FETCH_ASSOC);

$result = $conn->query("SELECT COUNT(*) as total
FROM convenios c WHERE DATEDIFF(c.termino, CURDATE()) > 10 AND DATEDIFF(c.termino, CURDATE()) <= 20;");
$vencer_20_dias = $result->fetch(PDO::FETCH_ASSOC);

$result = $conn->query("SELECT COUNT(*) as total
FROM convenios c WHERE DATEDIFF(c.termino, CURDATE()) > 20 AND DATEDIFF(c.termino, CURDATE()) <= 30;");
$vencer_30_dias = $result->fetch(PDO::FETCH_ASSOC);

$result = $conn->query("SELECT COUNT(*) as total
FROM convenios c WHERE DATEDIFF(c.termino, CURDATE()) > 30;");
$vencer_mais_30_dias = $result->fetch(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>e-Convênios</title>
  <link href="/e-conv/imagens/favicon.ico" rel="shortcut icon" type="image/vnd.microsoft.icon" />

  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="../bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="../bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="../dist/css/skins/skin-green-light.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-green-light sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
  <?php include ('../layout/header.php') ?>

  <!-- =============================================== -->

  <!-- Left side column. contains the sidebar -->
  <?php include ('../layout/menu-lateral.php') ?>


  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <!-- Main content -->
    <section class="content">
        
    <div class="row" style="margin-top: 60px">

        <div class="col-md-offset-2 col-lg-4 ">
          <div class="small-box bg-aqua">
              <div class="inner">
                <h3><?=$vencer_mais_30_dias['total']?></h3>

                <p>Convênios a vencer em mais de 30 dias</p>
              </div>
              <div class="icon">
                <i class="fa fa-archive"></i>
              </div>
              <a href="convenios/listar.php?dias-vencer=>30" class="small-box-footer">Listar <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>

        <div class="col-lg-4 ">
          <div class="small-box bg-green">
              <div class="inner">
                <h3><?=$vencer_30_dias['total']?></h3>

                <p>Convênios a vencer em até 30 dias</p>
              </div>
              <div class="icon">
            <i class="fa fa-archive"></i>
            </div>
            <a href="convenios/listar.php?dias-vencer=30" class="small-box-footer">
              Listar <i class="fa fa-arrow-circle-right" ></i>
            </a>
          </div>
          </div>
        <!-- ./col -->
        
        <!-- ./col -->
        <!-- ./col -->
      </div>
      <div class="row">
      <div class="col-md-offset-2 col-lg-4 ">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?=$vencer_20_dias['total']?></h3>

              <p>Convênios a vencer em até 20 dias</p>
            </div>
            <div class="icon">
            <i class="fa fa-archive"></i>
            </div>
            <a href="convenios/listar.php?dias-vencer=20" class="small-box-footer">
            Listar <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-4">
        <div class="small-box bg-red">
            <div class="inner">
              <h3><?=$vencer_10_dias['total']?></h3>

              <p>Convênios a vencer em até 10 dias</p>
            </div>
            <div class="icon">
              <i class="fa fa-archive"></i>
            </div>
            <a href="convenios/listar.php?dias-vencer=10" class="small-box-footer">
            Listar <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-4 "></div>
        <!-- ./col -->

        <!-- ./col -->
      </div>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <?php include ('../layout/footer.html');?>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="../bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="../bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="../bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>
<script>
  $(document).ready(function () {
    $('.sidebar-menu').tree()
  })
</script>
</body>
</html>
