<?php
session_start();
include '../../utils/bd.php';
include '../../utils/valida_login.php';

if (isset($_SESSION['client_id'])) {
  $client_id = $_SESSION['client_id'];
  $stmt = $conn->prepare("SELECT * FROM carga WHERE visivel = true AND cliente_id = $client_id;");
} else {
  $stmt = $conn->prepare("SELECT * FROM carga WHERE visivel = true");
}

$stmt->execute();
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
            <!-- /.box-menu-superior -->
          <div class="col-xs-12">
            <div class="box">
              <div class="box-header">
                <h3 class="box-title"><b>Lista de Cargas</b></h3>
                <p style="margin-top: 10px"><b>Total: <?php echo $stmt->rowCount(); ?> registro(s)</b></p>
              </div>
            
            <!-- /.box-menu-superior -->
            <div class="box-body">
              <table id="tabela" class="table table-condensed table-striped">
                <thead>
                <tr>
                  <th style="text-align: center">Nota Fiscal</th>
                  <th style="text-align: center">CT-e</th>
                  <th style="text-align: center">Link CT-e</th>
                  <th style="text-align: center">Placa</th>
                  <th style="text-align: center">Transportadora</th>
                  <th style="text-align: center">Data Carregamento</th>
                  <th style="text-align: center">Produto</th>
                  <th style="text-align: center">Quantidade</th>
                  <th style="text-align: center">Ent. Triagem</th>
                  <th style="text-align: center">Saida Triagem</th>
                  <th style="text-align: center">Ent. Itaituba</th>
                  <th style="text-align: center">Saida Itaituba</th>
                  <th style="text-align: center">Opções</th>
          
                </tr>
                </thead>
                <tbody>
                  <?php
                  
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
                    {
                      $id = $row['idcarga'];
                      $data_carregamento = date("d/m/Y", strtotime($row['data_carregamento']));

                      if (isset($row['entrada_triagem'])) {
                        $entrada_triagem = date("d/m/Y H:i:s", strtotime($row['entrada_triagem']));
                      } else {
                        $entrada_triagem = "-";
                      }
                      if (isset($row['saida_triagem'])) {
                        $saida_triagem = date("d/m/Y H:i:s", strtotime($row['saida_triagem']));
                      } else {
                        $saida_triagem = "-";
                      }

                      if (isset($row['entrada_etc_itaituba'])) {
                        $entrada_etc_itaituba = date("d/m/Y H:i:s", strtotime($row['entrada_etc_itaituba']));
                      } else {
                        $entrada_etc_itaituba = "-";
                      }
                      if (isset($row['saida_etc_itaituba'])) {
                        $saida_etc_itaituba = date("d/m/Y H:i:s", strtotime($row['saida_etc_itaituba']));
                      } else {
                        $saida_etc_itaituba = "-";
                      }

                      echo '<tr>';
                      echo "<td align='center'>" . $row['nota_fiscal'] .'</td>';
                      echo "<td align='center'>" . $row['ct_e'] .'</td>';
                      echo "<td align='center'>" . $row['link_ct_e'] . '</td>';
                      echo "<td align='center'>" . $row['placa'] .'</td>';
                      echo "<td align='center'>" . $row['cnpj_transportadora'] .'</td>';
                      echo "<td align='center'>" . $data_carregamento .'</td>';
                      echo "<td align='center'>" . $row['produto'] . '</td>';
                      echo "<td align='center'>" . $row['quantidade_carregada'] .' KG</td>';
                      echo "<td align='center' style='color: red'>" . $entrada_triagem .'</td>';
                      echo "<td align='center' style='color: red'>" . $saida_triagem .'</td>';
                      echo "<td align='center' style='color: red'>" . $entrada_etc_itaituba . '</td>';
                      echo "<td align='center' style='color: red'>" . $saida_etc_itaituba .'</td>';
                      
                    ?>
                    <td align='center'><a href='excluir.php?id=<?=$id?>' class='btn btn-danger'><i class='fa fa-trash'></i></a>
                    <br/><br/>
                    <?php 
                      echo "<a href='editar.php?id=$id' title='Alterar Senha' class='btn btn-primary'><i class='fa fa-edit'></i></a>"  . '</td>';
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

  <?php include ('../../layout/footer.html');?>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="../../assets/js/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="../../assets/js/bootstrap.min.js"></script>
<!-- jQuery 3 -->
<script src="../../assets/js/jquery.dataTables.min.js"></script>
<script src="../../assets/js/dataTables.bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="../../assets/js/adminlte.min.js"></script>
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