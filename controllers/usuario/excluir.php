<?php
session_start();
include '../../utils/bd.php';

$id = $_GET['id'];
$stmt = $conn->prepare("DELETE FROM usuario WHERE id = $id");

try
{
	$stmt->execute();
	$_SESSION['msg'] = "Usuário excluído com sucesso";

	header("Location: ../../pages/usuarios/listar.php");
}
catch(PDOException $e)
{
	$_SESSION['erro'] = "Erro: " . $e->getMessage();
}

?>