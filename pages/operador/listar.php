<?php
session_start();
include '../../utils/bd.php';
include '../../utils/valida_login.php';

if (isset($_POST['pesquisar'])) {
  if (isset($_SESSION['client_id'])) {
    $client_id = $_SESSION['client_id'];
    $query = "SELECT * FROM carga WHERE visivel = true AND cliente_id = $client_id";
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
}

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>e-track - Listagem de Cargas</title>
<!-- Tell the browser to be responsive to screen width -->
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="../../assets/css/dataTables.jqueryui.css">
  <link rel="stylesheet" href="../../assets/css/buttons.dataTables.min.css">
  
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
            <div class="col-xs-12">
              <?php if (isset($_SESSION['msg'])) { ?>
              <div class="alert alert-info">
                <strong>Info:</strong> 
                <?php echo $_SESSION['msg']; unset($_SESSION['msg']);?>
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

                      $placa = $row['placa'];

                      echo '<tr>';
                      echo "<td align='center'>" . $row['idcarga'] .'</td>';
                      echo "<td align='center'>" . $row['nota_fiscal'] .'</td>';
                      echo "<td align='center'>" . $row['ct_e'] .'</td>';
                      echo "<td align='center'>" . $row['link_ct_e'] . '</td>';
                      echo "<td align='center'>" . $row['placa'] .'</td>';
                      echo "<td align='center'>" . $row['cnpj_transportadora'] .'</td>';
                      echo "<td align='center'>" . $data_carregamento .'</td>';
                      echo "<td align='center'>" . $row['produto'] . '</td>';
                      echo "<td align='center'>" . $row['quantidade_carregada'] .'</td>';
                      echo "<td align='center' style='color: red'>" . $entrada_triagem .'</td>';
                      echo "<td align='center' style='color: red'>" . $row['ordem_saida_triagem'] .'</td>';
                      echo "<td align='center' style='color: red'>" . $saida_triagem .'</td>';
                      echo "<td align='center' style='color: red'>" . $entrada_etc_itaituba . '</td>';
                      echo "<td align='center' style='color: red'>" . $row['ordem_saida_etc_itaituba'] .'</td>';
                      echo "<td align='center' style='color: red'>" . $saida_etc_itaituba .'</td>';
                      
                      echo "<td><a href='visualizar.php?placa=$placa' title='visualizar' class='btn btn-primary'><i class='fa fa-eye'></i></a>"  . '</td>';
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

<!-- page script -->
<script>
$(document).ready(function() {
    $('.date').mask('00/00/0000');

    $('#tabela').dataTable({
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
              columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 11, 12, 14 ]
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
</body>
</html>