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
	        <!-- left column -->

    	<div style="margin-left: 200px" class="col-md-8">
          <!-- general form elements -->
            
   			<div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Cadastrar Nova Carga</h3>
            </div>
            <!-- /.box-menu-superior -->
            <div class="box-body">
              <form role="form" action="../../controllers/carga/novo.php" method="post">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Nota Fiscal</label>
                        <input type="text" class="form-control" name="nota_fiscal">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>CT-e</label>
                        <input type="text" class="form-control" name="ct_e">
                    </div>
                </div>  
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Link CT-e</label>
                        <input type="text" class="form-control" name="link_ct_e">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Placa</label>
                        <input type="text" class="form-control" name="placa">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>CNPJ da Transportadora</label>
                        <input type="text" class="form-control cnpj" name="cnpj_transportadora">
                    </div>
                </div> 
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Data Carregamento</label>
                        <input type="text" class="form-control date" name="data_carregamento">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                    <label>Produto</label>
                    <select class="form-control" name="produto">
                    <option value="">Selecione</option>
                    <option value="MILHO">MILHO</option>
                    <option value="SOJA">SOJA</option>
                    </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Quantidade Carregada (KG)</label>
                        <input type="text" class="form-control money" name="quantidade_carregada">
                    </div>
                </div>
                <?php if ($_SESSION['perfil'] == 'Administrador') { ?>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Cliente</label>
                            <select class="form-control" name="cliente">
                                <option value="">Selecione</option>
                            <?php
                                foreach($conn->query('SELECT * FROM cliente') as $row) {
                                    echo '<option value="'.$row['idcliente'].'">'.$row['nome'].'</option>';
                                }       
                            ?>
                            </select>
                        </div>
                    </div>
                <?php } ?>

</div>
            <div class="box-footer">
              <button type="submit" class="btn btn-primary" style="margin-left: 15px">Cadastrar</button>
            </div>

</form>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <?php include ('../../layout/footer.html');?>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="../../assets/js/jquery.min.js"></script>
<script src="../../assets/js/jquery.mask.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="../../assets/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="../../assets/js/adminlte.min.js"></script>
<script>
$(document).ready(function(){
  $('.date').mask('00/00/0000');
  $('.cnpj').mask('00.000.000/0000-00', {reverse: true});
  $('.money').mask('000.000.000.000.000,00', {reverse: true});
});
</script>
</body>
</html>
