<?php 
session_start();
include '../../utils/bd.php';
include '../../utils/valida_login.php'; 
?>

<!DOCTYPE html>
<html>
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

<body class="hold-transition skin-blue-light sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
  <?php include ('../../layout/menu-superior.php') ?>

  <!-- =============================================== -->

  <!-- Left side column. contains the sidebar -->
  <?php include ('../../layout/menu-lateral.php') ?>


  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
<center>
    <!-- Main content -->
    <section class="content">
    <div class="col-xs-12">
              <?php if (isset($_SESSION['msg'])) { ?>
              <div class="alert alert-info">
                <strong>Info:</strong> 
                <?php echo $_SESSION['msg']; unset($_SESSION['msg']);?>
              </div>
              <?php } ?>
            </div>
            
    	<div style="margin-top: 50px" class="row">
	        <!-- left column -->

    	<div style="margin-left: 100px" class="col-md-10">
          <!-- general form elements -->
            
   			<div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Pesquisar Carga</h3>
            </div>
            <!-- /.box-header -->
            <form role="form" action="visualizar.php" method="post">
            <div class="box-body">
              
            <div class="col-md-offset-4 col-md-4">
              <div class="form-group">
                      <label>Placa</label>
                      <input type="text" name="placa" class="form-control" placeholder="Digite o número da placa">
                  </div>
            </div>
</div>
            <div class="box-footer">
              <button type="submit" class="btn btn-primary" style="margin-left: 15px">Pesquisar</button>
            </div>

</form>
</div>
</div>
</div>
    </section>
</center>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <?php include ('../../layout/footer.html');?>
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
