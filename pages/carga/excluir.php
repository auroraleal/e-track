<?php 
session_start();
include '../../utils/bd.php'; 
include '../../utils/valida_login.php';

$stmt = $conn->prepare("SELECT * FROM carga WHERE idcarga = :id");
$stmt->bindParam(':id', $_REQUEST['id']);

try
{
  $stmt->execute();
  
  if($stmt->rowCount() == 0) {
    $erro = "Nenhum carregamento encontrado para a placa especificada: " . $placa;
  } else {
    $results = $stmt->fetch(PDO::FETCH_ASSOC);
    $data_carregamento = date("d/m/Y", strtotime($results['data_carregamento']));
  
    if ($_SESSION['perfil'] == 'Operador Triagem') {
      if (!$results['entrada_triagem']) {
        $titulo = "Confirmar Entrada - Triagem";
        $operacao = "entrada_triagem";
      } else if (!$results['saida_triagem']) {
        $entrada_triagem = date("d/m/Y H:i:s", strtotime($results['entrada_triagem']));
        $titulo = "Confirmar Saída - Triagem";
        $operacao = "saida_triagem";
      } else {
        $entrada_triagem = date("d/m/Y H:i:s", strtotime($results['entrada_triagem']));
        $saida_triagem = date("d/m/Y H:i:s", strtotime($results['saida_triagem']));

        $erro = "Já existem lançamentos para este carregamento.";
      }

    } else if ($_SESSION['perfil'] == 'Operador ETC') {
      if (!$results['entrada_etc_itaituba']) {
        $titulo = "Confirmar Entrada - ETC Itaituba";
        $operacao = "entrada_etc_itaituba";
      } else if (!$results['saida_etc_itaituba']) {
        $titulo = "Confirmar Saída - ETC Itaituba";
        $operacao = "saida_etc_itaituba";
        $entrada_etc_itaituba = date("d/m/Y H:i:s", strtotime($results['entrada_etc_itaituba']));
      } else {
        $entrada_etc_itaituba = date("d/m/Y H:i:s", strtotime($results['entrada_etc_itaituba']));        
        $saida_etc_itaituba = date("d/m/Y H:i:s", strtotime($results['saida_etc_itaituba']));
        $erro = "Já existem lançamentos para este carregamento.";
      }
    } else {
      $erro = " ";
    }
  }
  if ($_SESSION['perfil'] == 'Administrador')  {
    if ($results['entrada_triagem']) {
      $entrada_triagem = date("d/m/Y H:i:s", strtotime($results['entrada_triagem']));      
    }
    
    if ($results['saida_triagem']) {
      $saida_triagem = date("d/m/Y H:i:s", strtotime($results['saida_triagem']));      
    }

    if ($results['entrada_etc_itaituba']) {
      $entrada_etc_itaituba = date("d/m/Y H:i:s", strtotime($results['entrada_etc_itaituba']));      
    }

    if ($results['saida_etc_itaituba']) {
      $saida_etc_itaituba = date("d/m/Y H:i:s", strtotime($results['saida_etc_itaituba']));      
    }
  }
}
catch(PDOException $e)
{
	$_SESSION['erro'] = "Erro: " . $e->getMessage();
}
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
  <link rel="stylesheet" href="/e-track/assets/css/dataTables.jqueryui.css">
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

    <!-- Main content -->
    <section class="content">
    	<div class="row">
      <!-- left column -->

    	<div style="margin-left: 100px" class="col-md-10">
          <!-- general form elements -->
            
   			<div class="box box-primary">            
            <div class="box-header with-border">
              <h3 class="box-title"><b>Excluir Carga</b></h3>
            </div>
            <!-- /.box-menu-superior -->
            <div class="box-body">
              <?php if ($erro && $_SESSION['perfil'] != 'Administrador') { ?>
                <center>
                  <p style="font-size: 20px; color: red"><?=$erro?></p>
                </center>
              <?php } ?>
              <form role="form" action="../../controllers/carga/excluir.php" method="post">
                <input type="hidden" name="idcarga" value="<?=$results['idcarga']?>"/>
                <input type="hidden" name="operacao" value="EXCLUIR"/>
                <div class="row">
                  <div class="col-md-6">
                    <p style="font-size: 20px">Nota Fiscal: <?=$results['nota_fiscal']?></p>
                  </div>
                  <div class="col-md-6">
                    <p style="font-size: 20px">CT-e: <?=$results['ct_e']?></p>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <p style="font-size: 20px">Link CT-e: <?=$results['link_ct_e']?></p>
                  </div>
                  <div class="col-md-6">
                    <p style="font-size: 20px">Placa: <?=$results['placa']?></p>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <p style="font-size: 20px">CNPJ da Transportadora: <?=$results['cnpj_transportadora']?></p>
                  </div>
                  <div class="col-md-6">
                    <p style="font-size: 20px">Data Carregamento: <?=$data_carregamento?></p>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <p style="font-size: 20px">Produto: <?=$results['produto']?></p>
                  </div>
                  <div class="col-md-6">
                    <p style="font-size: 20px">Quantidade Carregada (KG): <?=$results['quantidade_carregada']?></p>
                  </div>
                </div>
                <?php if ($_SESSION['perfil'] == 'Operador Triagem' ||
                          $_SESSION['perfil'] == 'Administrador') { ?>
                  <div class="row">
                    <div class="col-md-6">
                      <p style="font-size: 20px; color: red">Entrada Triagem: <?=$entrada_triagem?></p>
                    </div>
                    <div class="col-md-6">
                      <p style="font-size: 20px; color: red">Saída Triagem: <?=$saida_triagem?></p>
                    </div>
                  </div>
                <?php } ?>
                 <div class="row">
                    <div class="col-md-6">
                      <p style="font-size: 20px; color: red">Entrada ETC Itaituba: <?=$entrada_etc_itaituba?></p>
                    </div>
                    <div class="col-md-6">
                      <p style="font-size: 20px; color: red">Saída ETC Itaituba: <?=$saida_etc_itaituba?></p>
                    </div>
                  </div>
                <div class="row">                    
                  <div class="col-md-12">
                    <div class="form-group">
                        <label style="font-size: 20px">Justificativa</label>
                        <textarea class="form-control" name="justificativa"></textarea>
                    </div>
                  </div>
                </div>
</div>
<center>
            <div class="box-footer">
              <button onclick="return confirm('Deseja realmente excluir?')" type="submit" class="btn btn-danger" style="margin-left: 15px">Excluir</a> 
            </div>
  
  </center>
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
<!-- Bootstrap 3.3.7 -->
<script src="../../assets/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="../../assets/js/adminlte.min.js"></script>
</body>
</html>
 ?>