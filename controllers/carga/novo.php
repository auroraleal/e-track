<?php
session_start();
include '../../utils/bd.php';
include '../../utils/valida_login.php';

try
{
$stmt = $conn->prepare("INSERT INTO carga(cliente_id, nota_fiscal, ct_e,
link_ct_e,
placa,
cnpj_transportadora,
data_carregamento,
produto,
quantidade_carregada)
VALUES
(:cliente_id, :nota_fiscal, :ct_e, :link_ct_e, :placa, 
:cnpj_transportadora, :data_carregamento,
:produto, :quantidade_carregada)");

$data_carregamento = date("Y-m-d", strtotime($_POST['data_carregamento']));

$stmt->bindParam(':cliente_id', $_SESSION['cliente_id']);
$stmt->bindParam(':nota_fiscal', $_POST['nota_fiscal']);
$stmt->bindParam(':ct_e', $_POST['ct_e']);
$stmt->bindParam(':link_ct_e', $_POST['link_ct_e']);
$stmt->bindParam(':placa', $_POST['placa']);
$stmt->bindParam(':cnpj_transportadora', $_POST['cnpj_transportadora']);
$stmt->bindParam(':data_carregamento', $data_carregamento);
$stmt->bindParam(':produto', $_POST['produto']);
$stmt->bindParam(':quantidade_carregada', $_POST['quantidade_carregada']);


	$stmt->execute();
	$_SESSION['msg'] = "Carga cadastrada com sucesso";

	header("Location: ../../pages/carga/listar.php");
}
catch(Exception $e)
{
	die($stmt->errorInfo());
	$_SESSION['erro'] = "Erro: " . $e->getMessage();
}

?>