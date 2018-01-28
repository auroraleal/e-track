<?php
session_start();
include '../../utils/bd.php';

$id = $_GET['id'];
$stmt = $conn->prepare("DELETE FROM convenios WHERE id = $id");

try
{
	$stmt->execute();
	$_SESSION['msg'] = "convênio excluído com sucesso";

	header("Location: ../../pages/convenios/listar.php");
}
catch(PDOException $e)
{
	$_SESSION['erro'] = "Erro: " . $e->getMessage();
}

?>