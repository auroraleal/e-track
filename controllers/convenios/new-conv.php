<?php
session_start();
include '../../utils/bd.php';
include '../../utils/valida_login.php';


$stmt = $conn->prepare("INSERT INTO convenios (ano, numero, orgao_id, secretaria_id, valor_global, inicio, termino, numero_sincov, status_id, tipo_convenio_id, valor_contrapartida,objeto, valor_repasse, origem, repasse, contrapartida, situacao, empenhado_id, acao_id, termo_convenio_id ) values(:ano, :numero, :orgao_id, :secretaria_id, :valor_global, :inicio, :termino, :numero_sincov, :status_id, :tipo_convenio_id, :valor_contrapartida, :objeto, :valor_repasse, :origem, :repasse, :contrapartida, :situacao, :empenhado_id, :acao_id, :termo_convenio_id)");

$inicio = date("Y-m-d", strtotime($_POST['inicio']));
$termino = date("Y-m-d", strtotime($_POST['termino']));

$stmt->bindParam(':ano', $_POST['ano']);
$stmt->bindParam(':numero', $_POST['num_convenio']);
$stmt->bindParam(':orgao_id', $_POST['orgao']);
$stmt->bindParam(':secretaria_id', $_POST['secretaria']);
$stmt->bindParam(':valor_global', $_POST['valor_global']);
$stmt->bindParam(':inicio', $inicio);
$stmt->bindParam(':termino', $termino);
$stmt->bindParam(':numero_sincov', $_POST['numero_sincov']);
$stmt->bindParam(':status_id', $_POST['status']);
$stmt->bindParam(':tipo_convenio_id', $_POST['tipo_convenio_id']);
$stmt->bindParam(':valor_contrapartida', $_POST['valor_contrapartida']);
$stmt->bindParam(':objeto', $_POST['objeto']);
$stmt->bindParam(':valor_repasse', $_POST['valor_repasse']);
$stmt->bindParam(':origem', $_POST['origem']);
$stmt->bindParam(':repasse', $_POST['repasse']);
$stmt->bindParam(':contrapartida', $_POST['contrapartida']);
$stmt->bindParam(':situacao', $_POST['situacao']);
$stmt->bindParam(':empenhado_id', $_POST['empenhado']);
$stmt->bindParam(':acao_id', $_POST['acao']);
$stmt->bindParam(':termo_convenio_id', $_POST['termo']);




try
{
	
	$stmt->execute();
	$_SESSION['msg'] = "Convenio cadastrado com sucesso";

	header("Location: ../../pages/convenios/listar.php");
}
catch(PDOException $e)
{
	$_SESSION['erro'] = "Erro: " . $e->getMessage();
}

?>