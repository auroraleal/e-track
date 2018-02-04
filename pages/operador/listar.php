<?php
session_start();
include '../../utils/bd.php';
include '../../utils/valida_login.php';

if (isset($_POST['pesquisar'])) {
  if (isset($_SESSION['client_id'])) {
    $client_id = $_SESSION['client_id'];
    $query = "SELECT * FROM carga WHERE visivel = true AND cliente_id = $client_id";
  } else if (isset($_POST['placa'])) {
    $placa = $_POST['placa'];
    $query = "SELECT * FROM carga WHERE visivel = true AND placa = '$placa'";
  } else {
    $query = "SELECT * FROM carga WHERE visivel = true";  
  }

  if (!empty($_POST['data_carregamento'])) {
    $query .= " AND data_carregamento = '" .  $_POST['data_carregamento'] . "'";
  }
  
  if (!empty($_POST['entrada_triagem'])) {
    $query .= " AND DATE(entrada_triagem) = '" .  $_POST['entrada_triagem'] . "'";
  }

  if (!empty($_POST['saida_triagem'])) {
    $query .= " AND DATE(saida_triagem) = '" .  $_POST['saida_triagem'] . "'";
  }

  if (!empty($_POST['entrada_etc_itaituba'])) {
    $query .= " AND DATE(entrada_etc_itaituba) = '" .  $_POST['entrada_etc_itaituba'] . "'";
  }

  if (!empty($_POST['saida_etc_itaituba'])) {
    $query .= " AND DATE(saida_etc_itaituba) = '" .  $_POST['saida_etc_itaituba'] . "'";
  }

  if ($_SESSION['perfil'] == 'Operador Triagem') {
    $query .= " ORDER BY entrada_triagem DESC";
  } else if ($_SESSION['perfil'] == 'Operador ETC') {
    $query .= " ORDER BY entrada_etc_itaituba DESC";
  }

  $stmt = $conn->prepare($query);
  $stmt->execute();

  if ($stmt->rowCount() == 0) {
    $erro = 'Não há resultados para esta consulta';
  }
}

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
  <link rel="stylesheet" href="../../assets/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="../../assets/css/buttons.dataTables.min.css">
  
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../assets/css/font-awesome/css/font-awesome.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../assets/css/AdminLTE.min.css">
<!-- AdminLTE Skins. Choose a skin from the css/skins
     folder instead of downloading all of them to reduce the load. -->
<link rel="stylesheet" href="../../assets/css/skin-blue-light.min.css">
<link rel="stylesheet" href="../../assets/css/dataTables.rowReorder.min.css">
<link rel="stylesheet" href="../../assets/css/responsive.dataTables.min.css">

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
              <?php if (isset($erro)) { ?>
              <div class="alert alert-error">
                <strong>Erro:</strong> 
                <?php echo $erro; ?>
              </div>
              <?php } ?>
            </div>            
            <!-- /.box-menu-superior -->
          <div style="margin-top: 50px" class="col-xs-12">
            <div class="box">
              <div class="box-header with-border">
                <center>
                  <h3 class="box-title"><b>Pesquisar Carregamento</b></h3>
                  <p><i style="color: red"><b>(Deixe os campos em branco para listar todos)</b></i></p>
                  <form role="form" action="" method="post">
                      <div class="box-body">
                        <div class="row">
                          <div class="col-md-offset-4 col-md-4">
                            <div class="form-group">
                              <label>Data de Carregamento</label>
                              <input type="date" name="data_carregamento" class="form-control">
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-offset-4 col-md-2">
                            <div class="form-group">
                              <label>Data de Entrada - Triagem</label>
                              <input type="date" name="entrada_triagem" class="form-control">
                            </div>
                          </div>
                          <div class="col-md-2">
                            <div class="form-group">
                              <label>Data de Saída - Triagem</label>
                              <input type="date" name="saida_triagem" class="form-control">
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-offset-4 col-md-2">
                            <div class="form-group">
                              <label>Data de Entrada - ETC Itaituba</label>
                              <input type="date" name="entrada_etc_itaituba" class="form-control">
                            </div>
                          </div>
                          <div class="col-md-2">
                            <div class="form-group">
                              <label>Data de Saída - ETC Itaituba</label>
                              <input type="date" name="saida_etc_itaituba" class="form-control">
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="box-footer">
                        <button name="pesquisar" type="submit" class="btn btn-primary" style="margin-left: 15px">Pesquisar</button>
                      </div>
                  </form>
                </center>
              </div>
            
            <!-- /.box-menu-superior -->
            <div class="box-body">
              <?php if (isset($_POST['pesquisar'])) { ?>
                <h3 class="box-title">Listagem de Cargas</h3>
                <p style="margin-top: 10px"><b>Total: <?php echo $stmt->rowCount(); ?> registro(s)</b></p>              
              <table id="tabela" class="table table-condensed table-striped">
                <thead>
                  <tr>
                    <th style="text-align: center">Código</th>
                    <th style="text-align: center">Nota Fiscal</th>
                    <th style="text-align: center">CT-e</th>
                    <th style="text-align: center">Link CT-e</th>
                    <th style="text-align: center">Placa</th>
                    <th style="text-align: center">Transportadora</th>
                    <th style="text-align: center">Data Carregamento</th>
                    <th style="text-align: center">Produto</th>
                    <th style="text-align: center">Quantidade (KG)</th>
                    <th style="text-align: center">Ent. Triagem</th>
                    <th style="text-align: center">Ordem Saída - Triagem</th>
                    <th style="text-align: center">Saída Triagem</th>
                    <th style="text-align: center">Ent. ETC Itaituba</th>
                    <th style="text-align: center">Ordem Saída - ETC Itaituba</th>
                    <th style="text-align: center">Saída ETC Itaituba</th>
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

                      $id = $row['idcarga'];

                      echo '<tr>';
                      echo "<td align='center'>" . $row['idcarga'] .'</td>';
                      echo "<td align='center'>" . $row['nota_fiscal'] .'</td>';
                      echo "<td align='center'>" . $row['ct_e'] .'</td>';
                      echo "<td align='center'>" . $row['link_ct_e'] . '</td>';
                      echo "<td align='center'>" . $row['placa'] .'</td>';
                      echo "<td align='center'>" . $row['cnpj_transportadora'] .'</td>';
                      echo "<td align='center'>" . $data_carregamento .'</td>';
                      echo "<td align='center'>" . $row['produto'] . '</td>';
                      echo "<td align='center'>" .  number_format((float)$row['quantidade_carregada'], 2, ',', '.') .'</td>';
                      echo "<td align='center' style='color: red'>" . $entrada_triagem .'</td>';
                      echo "<td align='center' style='color: red'>" . $row['ordem_saida_triagem'] .'</td>';
                      echo "<td align='center' style='color: red'>" . $saida_triagem .'</td>';
                      echo "<td align='center' style='color: red'>" . $entrada_etc_itaituba . '</td>';
                      echo "<td align='center' style='color: red'>" . $row['ordem_saida_etc_itaituba'] .'</td>';
                      echo "<td align='center' style='color: red'>" . $saida_etc_itaituba .'</td>';
                      
                      echo "<td><a href='visualizar.php?id=$id' title='visualizar' class='btn btn-primary'><i class='fa fa-eye'></i></a>"  . '</td>';
                      echo '</tr>';
                  } ?>
                </tbody>
              </table>
              <?php } ?>
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
<script src="../../assets/js/jquery.mask.min.js"></script>

<!-- Bootstrap 3.3.7 -->
<script src="../../assets/js/bootstrap.min.js"></script>
<!-- jQuery 3 -->
<script src="../../assets/js/jquery.dataTables.min.js"></script>
<script src="../../assets/js/dataTables.bootstrap.min.js"></script>
<script src="../../assets/js/adminlte.min.js"></script>

<script src="../../assets/js/dataTables.buttons.min.js"></script>
<script src="../../assets/js/jszip.min.js"></script>
<script src="../../assets/js/pdfmake.min.js"></script>
<script src="../../assets/js/vfs_fonts.js"></script>
<script src="../../assets/js/buttons.html5.min.js"></script>
<script src="../../assets/js/dataTables.rowReorder.min.js"></script>
<script src="../../assets/js/dataTables.responsive.min.js"></script>

<!-- page script -->
<script>
$(document).ready(function() {
    $('.date').mask('00/00/0000');

    $('#tabela').dataTable({
        rowReorder: {
            selector: 'td:nth-child(2)'
        },
        responsive: true,
        aaSorting: [],
        oLanguage: {
            "sLengthMenu": "Exibir _MENU_ registros por página",
            "sZeroRecords": "Nenhum registro encontrado",
            "sInfo": "Exibindo _START_ / _END_ de _TOTAL_ registro(s)",
            "sInfoEmpty": "Exibindo 0 / 0 de 0 registros",
            "sInfoFiltered": "(filtrado de _MAX_ registros)",
            "sSearch": "Filtrar: ",
            "oPaginate": {
                "sFirst": "Início",
                "sPrevious": "Anterior",
                "sNext": "Próximo",
                "sLast": "Último"
            }
        },
        dom: 'Bfrtip',
        buttons: [
          {
            extend:    'excelHtml5',
            exportOptions: {
              columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 11, 12, 14 ]
            },
            text:      '<i class="fa fa-file-excel-o"></i>',
            titleAttr: 'Exportar - Excel'
          },
          {
            extend:    'pdfHtml5',
            exportOptions: {
              columns: [ 0, 1, 2, 4, 5, 6, 7, 8, 9, 11, 12, 14 ]
            },
            orientation: 'landscape',
            text:      '<i class="fa fa-file-pdf-o"></i>',
            download: 'open',
            titleAttr: 'Exportar - PDF',
            customize: function ( doc ) {              
              doc.footer = (function(page, pages) {
                // Obtém a data/hora atual
                var data = new Date();

                // Guarda cada pedaço em uma variável
                var dia     = data.getDate();           // 1-31
                var mes     = data.getMonth();          // 0-11 (zero=janeiro)
                var ano4    = data.getFullYear();       // 4 dígitos
                var hora    = data.getHours();          // 0-23
                var min     = data.getMinutes();        // 0-59
                var seg     = data.getSeconds();        // 0-59

                // Formata a data e a hora (note o mês + 1)
                dia < 10 ? dia = '0' + dia : '';
                
                mes++;
                mes < 10 ? mes = '0' + mes : '';

                hora < 10 ? hora = '0' + hora : '';
                min < 10 ? min = '0' + min : '';
                seg < 10 ? seg = '0' + seg : '';

                var str_data = dia + '/' + mes + '/' + ano4 + ' - '+ hora + ':' + min + ':' + seg;

                return {
                  columns: [
                    'Emitido em: ' + str_data,
                    {
                      alignment: 'right',
                      text: [
                        { text: 'Página ' + page.toString(), italics: true },
                        ' de ',
                        { text: pages.toString(), italics: true }
                      ]
                    }
                  ],
                  margin: [10, 0]
                }
              });
              /*doc['styles'] = {
                userTable: {
                    margin: [0, 15, 0, 15]
                },
                tableHeader: {
                    bold:!0,
                    fontSize:11,
                    color:'white',
                    fillColor:'#3c8dbc',
                    alignment:'center'
                }
              };*/
              doc['styles'] = {
                userTable: {
                    margin: [0, 15, 0, 15]
                },
                tableHeader: {
                    bold:!0,
                    fontSize:11,
                    color:'white',
                    fillColor:'#090a32',
                    alignment:'center'
                }
              };
              doc.content.splice( 1, 0, {
                margin: [ 0, 0, 0, 12 ],
                alignment: 'center',
                image : 'data:image/png;base64,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'
              });
            }            
          }
          /*{
            extend: 'colvis',
            text: 'Exibir/Ocultar colunas'
          },*/
        ],
        columnDefs: [ {
            visible: false
        } ]
    });
});
</script>
<script>
  $(document).ready(function () {
    $('.sidebar-menu').tree()
  })
</script>
</body>
</html>