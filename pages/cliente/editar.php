<?php 
session_start();
include '../../utils/bd.php';
include '../../utils/valida_login.php';

$stmt = $conn->prepare("SELECT * FROM cliente
WHERE idcliente = :id ");

$stmt->bindParam(':id', $_REQUEST['id']);
$stmt->execute();

$result = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title> e-Track - CIANPORT </title>
<!-- Tell the browser to be responsive to screen width -->
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../assets/css/font-awesome/css/font-awesome.min.css"
  <!-- Theme style -->
  <link rel="stylesheet" href="../../assets/css/AdminLTE.min.css">
<!-- AdminLTE Skins. Choose a skin from the css/skins
     folder instead of downloading all of them to reduce the load. -->
<link rel="stylesheet" href="../../assets/css/skin-blue-light.min.css">

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

    <!-- Main content -->
    <section class="content">
    	<div class="row">
	        <!-- left column -->

    	<div style="margin-left: 100px" class="col-md-10">
          <!-- general form elements -->
            
   			<div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Editar Cliente</h3>
            </div>
            <!-- /.box-header -->
            <form role="form" action="../../controllers/cliente/editar.php" method="post">
            <input type="hidden" name="id" value="<?=$_REQUEST['id']?>"/>
            <div class="box-body">
              
            <div class="col-md-4">
              <div class="form-group">
                      <label>Nome</label>
                      <input type="text" name= "nome" class="form-control" placeholder="Digite o nome" value="<?=$result['nome']?>">
                  </div>
            </div>

            <div class="col-md-4">
              <div class="form-group">
                      <label>Email</label>
                      <input type="text" name= "email" class="form-control" placeholder="Digite o email" value="<?=$result['email']?>">
                  </div>
            </div>

            <div class="col-md-4">
              <div class="form-group">
                      <label>CNPJ</label>
                      <input type="text" name="cnpj" class="form-control cnpj" value="<?=$result['cnpj']?>">
                  </div>
            </div>

</div>
            <div class="box-footer">
              <button type="submit" class="btn btn-primary" style="margin-left: 15px">Salvar</button>
            </div>

</form>
</div>
</div>
</div>
    </section>
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
<script>
  $(document).ready(function () {
    $('.sidebar-menu').tree()
  })
</script>
</body>
</html>
