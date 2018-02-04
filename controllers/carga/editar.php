<?php
session_start();
include '../../utils/bd.php';

$stmt = $conn->prepare("SELECT * FROM carga WHERE idcarga = :idcarga");
$stmt->bindParam(':idcarga', $_POST['idcarga']);
$stmt->execute();
$results = $stmt->fetch(PDO::FETCH_ASSOC);

$stmtAlterar = $conn->prepare("INSERT INTO 
alteracao_carga (dados, justificativa, operacao, usuario_id, carga_id) 
VALUES (:dados, :justificativa, :operacao, :usuario_id, :carga_id) ");

$stmtAlterar->bindParam(':dados', json_encode($results));
$stmtAlterar->bindParam(':justificativa', $_POST['justificativa']);
$stmtAlterar->bindParam(':operacao', $_POST['operacao']);
$stmtAlterar->bindParam(':usuario_id', $_SESSION['id']);
$stmtAlterar->bindParam(':carga_id', $_POST['idcarga']);

try
{
	$stmtAlterar->execute();
	
	$query_editar = "UPDATE carga
	SET
	cliente_id = :cliente_id,
	nota_fiscal = :nota_fiscal,
	ct_e = :ct_e,
	link_ct_e = :link_ct_e,
	placa = :placa,
	cnpj_transportadora = :cnpj_transportadora,
	produto = :produto,
	quantidade_carregada = :quantidade_carregada
	WHERE idcarga = :idcarga";
	
	$stmtEditar = $conn->prepare($query_editar);

	$quantidade_carregada = str_replace(',','.', str_replace('.','', $_POST['quantidade_carregada']));
	
	if (!isset($_SESSION['cliente_id'])) {
		$cliente_id = $_POST['cliente'];
	} else {
		$cliente_id = $_SESSION['cliente_id'];
	}

	$stmtEditar->bindParam(':cliente_id', $cliente_id);
	$stmtEditar->bindParam(':nota_fiscal', $_POST['nota_fiscal']);
	$stmtEditar->bindParam(':ct_e', $_POST['ct_e']);
	$stmtEditar->bindParam(':link_ct_e', $_POST['link_ct_e']);
	$stmtEditar->bindParam(':placa', $_POST['placa']);
	$stmtEditar->bindParam(':cnpj_transportadora', $_POST['cnpj_transportadora']);
	$stmtEditar->bindParam(':produto', $_POST['produto']);
	$stmtEditar->bindParam(':quantidade_carregada', $quantidade_carregada);
	$stmtEditar->bindParam(':idcarga', $_POST['idcarga']);
	$stmtEditar->execute();

	$_SESSION['msg'] = "Carga editada com sucesso";

	header("Location: ../../pages/carga/listar.php");
}
catch(PDOException $e)
{
	$_SESSION['erro'] = "Erro: " . $e->getMessage();
}

?>