<?php
session_start();
include '../../utils/bd.php';

$id = $_GET['id'];
$stmt = $conn->prepare("DELETE FROM cliente WHERE idcliente = $id");

try
{
	$stmt->execute();
	$_SESSION['msg'] = "Cliente excluído com sucesso";

	header("Location: ../../pages/cliente/listar.php");
}
catch(PDOException $e)
{
	$_SESSION['erro'] = "Erro: " . $e->getMessage();
}

?>