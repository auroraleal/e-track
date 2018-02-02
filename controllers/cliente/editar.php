<?php
session_start();
include '../../utils/bd.php';
include '../../utils/valida_login.php';

$stmt = $conn->prepare("UPDATE cliente SET nome = :nome, 
email = :email, cnpj = :cnpj 
WHERE idcliente = :id");

$id = $_POST['id'];

$stmt->bindParam(':id', $_POST['id']);
$stmt->bindParam(':nome', $_POST['nome']);
$stmt->bindParam(':email', $_POST['email']);
$stmt->bindParam(':cnpj', $_POST['cnpj']);

try
{
	$stmt->execute();
	$_SESSION['msg'] = "Cliente atualizado com sucesso";

	header("Location: ../../pages/cliente/listar.php");
}
catch(PDOException $e)
{
	$_SESSION['erro'] = "Erro: " . $e->getMessage();
}

?>