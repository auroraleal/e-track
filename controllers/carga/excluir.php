<?php
session_start();
include '../../utils/bd.php';

$id = $_POST['idcarga'];
$stmt = $conn->prepare("SELECT * FROM carga WHERE idcarga = $id");
$stmt->execute();
$results = $stmt->fetch(PDO::FETCH_ASSOC);

$stmtAlterar = $conn->prepare("INSERT INTO 
alteracao_carga (dados, justificativa, operacao, usuario_id, carga_id) 
VALUES (:dados, :justificativa, :operacao, :usuario_id, :carga_id) ");

$stmtAlterar->bindParam(':dados', json_encode($results));
$stmtAlterar->bindParam(':justificativa', $_POST['justificativa']);
$stmtAlterar->bindParam(':operacao', $_POST['operacao']);
$stmtAlterar->bindParam(':usuario_id', $_SESSION['id']);
$stmtAlterar->bindParam(':carga_id', $id);

try
{
	$stmtAlterar->execute();

	$stmtExcluir = $conn->prepare("UPDATE carga SET visivel = false
	WHERE idcarga = $id");
	$stmtExcluir->execute();
	
	$_SESSION['msg'] = "Carga excluída com sucesso";

	header("Location: ../../pages/carga/listar.php");
}
catch(PDOException $e)
{
	$_SESSION['erro'] = "Erro: " . $e->getMessage();
}

?>