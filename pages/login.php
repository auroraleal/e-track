<?php session_start(); ?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>e-track</title>

  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../assets/css/font-awesome/css/font-awesome.min.css"  

  <!-- Theme style -->
  <link rel="stylesheet" href="../assets/css/AdminLTE.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body class="hold-transition login-page">
<div class="login-box">
  <?php if (isset($_SESSION['erro'])) { ?>
    <div class="login-box-menu-superior alert alert-danger">
      <strong>Erro:</strong> 
      <?php echo $_SESSION['erro']; unset($_SESSION['erro']);?>
    </div>
  <?php } ?>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <img src="../imagens/logo.png"></img>
   <h2 style="text-align: center;">e-TRACK </h2>
    <hr/>

    <form action="../controllers/LoginController.php" method="post">
      <div class="form-group has-feedback">
        <input type="text" name="email" class="form-control" placeholder="Digite seu Email" >
        <i class="fa fa-envelope form-control-feedback"></i>
      </div>
      <div class="form-group has-feedback">
        <input type="password" name="senha" class="form-control" placeholder="Digite sua senha" >
        <i class="fa fa-lock form-control-feedback"></i>
      </div>
      <div class="row">
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Logar</button>
        </div>
        <div class="col-sm-offset-3 col-xs-4">
          <!--img src="../imagens/corumba_outsourcing.png"/-->
        </div>

        <!-- /.col -->
      </div>
    </form>
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="../bower_components/jquery/dist/jquery.min.js"></script>
</body>
</html>
