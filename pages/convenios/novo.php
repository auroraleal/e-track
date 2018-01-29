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
  <link href="/e-track/imagens/favicon.ico" rel="shortcut icon" type="image/vnd.microsoft.icon" />
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="../../bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="../../bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="../../dist/css/skins/skin-green-light.min.css">

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
  <?php include ('../../layout/header.php') ?>

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
            
   			<div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Cadastrar Novo convênio</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <form role="form" action="../../controllers/convenios/new-conv.php" method="post">
              	<div class="col-md-4">
    	        		<div class="form-group">
                		<label>Secretaria Responsável</label>
	                  <select class="form-control" name="secretaria">
                      <option value="">Selecione</option>
                      <?php
                          foreach($conn->query('SELECT * FROM convenios.secretaria') as $row) {
                              echo '<option value="'.$row['id'].'">'.$row['nome'].'</option>';
                          }       
                      ?>
	                    
	                  </select>
            	     </div>
		            </div>
		        <div class="col-md-2">
		        	<div class="form-group">
                  		<label>Ano</label>
                  		<input type="text" class="form-control" placeholder="Digite o Ano" name="ano">
                	</div>
		        </div>
		        <div class="col-md-4">
		        	<div class="form-group">
                  		<label>Orgão</label>
		                  <select class="form-control" name="orgao">
		                    <option value="">Selecione</option>
                      <?php
                          foreach($conn->query('SELECT * FROM convenios.orgao') as $row) {
                              echo '<option value="'.$row['id'].'">'.$row['nome'].'</option>';
                          }       
                      ?>
		                  </select>
                	</div>
		        </div>
                <!-- text input -->

                <div class="col-md-2">
                <div class="form-group">
                  <label>Numero orgão</label>
                  <input type="text" class="form-control" placeholder="" name="numero">
                </div>
            </div>

                <div class="col-md-2">
		        	<div class="form-group">
                  		<label>Início</label>
		                <input type="text" class="form-control" placeholder="" name="inicio">
                	</div>
		        </div>

		        <div class="col-md-2">
		        	<div class="form-group">
                  		<label>Término</label>
		                <input type="text" class="form-control" placeholder="" name="termino">
                	</div>
		        </div>

                <!-- textarea -->
                <div class="col-md-2">
                <div class="form-group">
                  <label>Status</label>
                   <select class="form-control" name="status">
		                     <option value="">Selecione</option>
                      <?php
                          foreach($conn->query('SELECT * FROM convenios.status') as $row) {
                              echo '<option value="'.$row['id'].'">'.$row['status'].'</option>';
                          }       
                      ?>
		                  </select>
               </div>
			</div>

				<div class="col-md-2">
                <div class="form-group">
                  <label>Origem</label>
                  <input type="text" class="form-control" placeholder="" name="origem">
                </div>
            </div>

            <div class="col-md-2">
                <div class="form-group">
                  <label>Tipos de convênios</label>
                  <select class="form-control" name="tipo_convenio_id">
		                     <option value="">Selecione</option>
                      <?php
                          foreach($conn->query('SELECT * FROM convenios.tipo_convenio') as $row) {
                              echo '<option value="'.$row['id'].'">'.$row['tipo'].'</option>';
                          }       
                      ?>
		                  </select>
            </div>
        </div>
        <div class="col-md-2">
                <div class="form-group">
                  <label>Numero SINCOV</label>
                  <input type="text" class="form-control" placeholder="" name="numero_sincov">
                </div>
            </div>

            <div class="col-md-2">
                <div class="form-group">
                  <label>Numero convênio</label>
                  <input type="text" class="form-control" placeholder="" name="num_convenio">
                </div>
            </div>

            <div class="col-md-2">
                <div class="form-group">
                  <label>Empenhado</label>
                  <select class="form-control" name="empenhado">
                        select class="form-control" name="empenhado">
                      <option value="">Selecione</option>
                      <?php
                          foreach($conn->query('SELECT * FROM convenios.empenhado') as $row) {
                              echo '<option value="'.$row['id'].'">'.$row['empenhado'].'</option>';
                          }       
                      ?>
                      </select> 
                </div>
            </div>

            <div class="col-md-2">
                <div class="form-group">
                  <label>Termo de Convênio</label>
                  <select class="form-control" name="termo">
                      <option value="">Selecione</option>
                      <?php
                          foreach($conn->query('SELECT * FROM convenios.termo_convenio') as $row) {
                              echo '<option value="'.$row['id'].'">'.$row['termo'].'</option>';
                          }       
                      ?>
                      </select> 
            </div>
          </div>

            <div class="col-md-2">
                <div class="form-group">
                  <label>Repasse</label>
                  <input type="text" class="form-control" placeholder="" name="repasse">
                </div>
            </div>

            <div class="col-md-2">
                <div class="form-group">
                  <label>Contrapartida</label>
                  <input type="text" class="form-control" placeholder="" name="contrapartida">
                </div>
            </div>

            <div class="col-md-2">
                <div class="form-group">
                  <label>Ação</label>
                 <select class="form-control" name="acao">
                        select class="form-control" name="acao">
                      <option value="">Selecione</option>
                      <?php
                          foreach($conn->query('SELECT * FROM convenios.acao') as $row) {
                              echo '<option value="'.$row['id'].'">'.$row['acao'].'</option>';
                          }       
                      ?>
                      </select> 
                </div>
            </div>


            <div class="col-md-12">
                <div class="form-group">
                  <label>Objeto</label>
                  <textarea class="form-control" rows="3" placeholder="texto" name="objeto"></textarea>
                </div>
            </div>

            <div class="col-md-2">
                <div class="form-group">
                  <label>Valor global</label>
                  <input type="text" class="form-control" placeholder="" name="valor_global">
                </div>
            </div>

            <div class="col-md-2">
                <div class="form-group">
                  <label>Valor Repasse</label>
                  <input type="text" class="form-control" placeholder="" name="valor_repasse">
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                  <label>Valor contrapartida</label>
                  <input type="text" class="form-control" placeholder="" name="valor_contrapartida">
                </div>
            </div>

				<div class="col-md-12">
                <div class="form-group">
                  <label>Situação</label>
                  <textarea class="form-control" rows="3" placeholder="texto" name="situacao"></textarea>
                </div>
            </div>
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
<script src="../../bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="../../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="../../bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="../../bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>
<script>
  $(document).ready(function () {
    $('.sidebar-menu').tree()
  })
</script>
</body>
</html>
