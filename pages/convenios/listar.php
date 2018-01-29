<?php

session_start();
include '../../utils/bd.php';
include '../../utils/valida_login.php';


if (isset($_GET['dias-vencer'])) {
  $dias_vencer = $_GET['dias-vencer'];

  switch ($dias_vencer) {
    case "10":
      $stmt = $conn->prepare("SELECT c.id as id,c.origem as origem, c.ano as ano, 
      s.nome as nome, st.status as status FROM convenios c 
      INNER JOIN secretaria s ON c.secretaria_id= s.id 
      INNER JOIN status st ON c.status_id=st.id
      WHERE DATEDIFF(c.termino, CURDATE()) <= 10;");

      break;
    case "20":
      $stmt = $conn->prepare("SELECT c.id as id,c.origem as origem, c.ano as ano, 
      s.nome as nome, st.status as status FROM convenios c 
      INNER JOIN secretaria s ON c.secretaria_id= s.id 
      INNER JOIN status st ON c.status_id=st.id
      WHERE DATEDIFF(c.termino, CURDATE()) > 10 AND DATEDIFF(c.termino, CURDATE()) <= 20;");

      break;
    case "30":
      $stmt = $conn->prepare("SELECT c.id as id,c.origem as origem, c.ano as ano, 
      s.nome as nome, st.status as status FROM convenios c 
      INNER JOIN secretaria s ON c.secretaria_id= s.id 
      INNER JOIN status st ON c.status_id=st.id
      WHERE DATEDIFF(c.termino, CURDATE()) > 20 AND DATEDIFF(c.termino, CURDATE()) <= 30;");

      break;
    case ">30":
      $stmt = $conn->prepare("SELECT c.id as id,c.origem as origem, c.ano as ano, 
      s.nome as nome, st.status as status FROM convenios c 
      INNER JOIN secretaria s ON c.secretaria_id= s.id 
      INNER JOIN status st ON c.status_id=st.id
      WHERE DATEDIFF(c.termino, CURDATE()) > 30;");

      $dias_vencer = "mais de 30";
      break;

    default :
      break;
  } 
} else {
  $stmt = $conn->prepare("SELECT c.id as id,c.origem as origem, c.ano as ano, 
      s.nome as nome, st.status as status FROM convenios c 
      INNER JOIN secretaria s ON c.secretaria_id= s.id 
      INNER JOIN status st ON c.status_id=st.id;");
}

$stmt->execute();

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
            <!-- /.box-header -->
          <div class="col-xs-12">
            <div class="box">
              <div class="box-header">
                <h3 class="box-title"><b>Lista de Convênios</b></h3>
                <?php if (isset($dias_vencer)) { ?>
                  <h3 class="box-title"><b> - A vencer em <?php echo $dias_vencer ?> dias</b></h3>
                <?php } else { ?>
                  <h3 class="box-title"><b> - Todos</b></h3>
                <?php } ?>
                <p style="margin-top: 10px"><b>Total: <?php echo $stmt->rowCount(); ?> registro(s)</b></p>
              </div>
            
            <!-- /.box-header -->
            <div class="box-body">
              <table id="tabela" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th style="text-align: center">Secretaria</th>
                  <th style="text-align: center">Origem</th>
                  <th style="text-align: center">Ano</th>
                  <th style="text-align: center">Status</th>
                  <th style="text-align: center">Opções</th>
          
                </tr>
                </thead>
                <tbody>
                  <?php
                  
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
                    {
                      $id = $row['id'];
                      echo '<tr>';
                      echo "<td align='center'>" . $row['nome'] .'</td>';
                      echo "<td align='center'>" . $row['origem'] .'</td>';
                      echo "<td align='center'>" . $row['ano'] . '</td>';
                      echo "<td align='center'>" . $row['status'] .'</td>';

                      echo "<td align='center'>" . "<a href='../../controllers/convenios/excluir.php?id=$id' class='btn btn-danger'><i class='fa fa-trash'></i></a>"  . '';
                      echo "&nbsp&nbsp" . "<a href='visualizar.php?id=$id' class='btn btn-info'><i class='fa fa-eye'></i></a>"  . '';
                      echo "&nbsp&nbsp" . "<a href='editar.php?id=$id' class='btn btn-default'><i class='fa fa-edit'></i></a>"  . '</td>';
                      echo '</tr>';
                    }
                  ?>
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

  <?php include ('../../layout/footer.html');?>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="../../bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="../../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- DataTables -->
<script src="../../bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="../../bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="../../bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="../../bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>
<!-- page script -->
<script>
    $('#tabela').dataTable({
        oLanguage: {
            "sLengthMenu": "Mostrar _MENU_ registros por página",
            "sZeroRecords": "Nenhum registro encontrado",
            "sInfo": "Mostrando _START_ / _END_ de _TOTAL_ registro(s)",
            "sInfoEmpty": "Mostrando 0 / 0 de 0 registros",
            "sInfoFiltered": "(filtrado de _MAX_ registros)",
            "sSearch": "Pesquisar: ",
            "oPaginate": {
                "sFirst": "Início",
                "sPrevious": "Anterior",
                "sNext": "Próximo",
                "sLast": "Último"
            }
        }
    });    
</script>
</body>
</html>