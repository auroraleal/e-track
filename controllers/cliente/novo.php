<?php
session_start();
include '../../utils/bd.php';
include '../../utils/valida_login.php';

$stmt = $conn->prepare("INSERT INTO cliente(nome, email, cnpj) values(:nome, :email, :cnpj)");

$stmt->bindParam(':nome', $_POST['nome']);
$stmt->bindParam(':email', $_POST['email']);
$stmt->bindParam(':cnpj', $_POST['cnpj']);

try
{
	$stmt->execute();
	$_SESSION['msg'] = "CLiente  inserido com sucesso";

	header("Location: ../../pages/cliente/listar.php");
}
catch(PDOException $e)
{
	$_SESSION['erro'] = "Erro: " . $e->getMessage();
}

?>