<?php
session_start();
include '../../utils/bd.php';
include '../../utils/valida_login.php';

$stmt = $conn->prepare("INSERT INTO usuario(nome, email, cliente_id, perfil_id, senha) values(:nome, :email, :cliente, :perfil, :senha)");

$cliente = $_POST['cliente'] ? $_POST['cliente'] : null;

$stmt->bindParam(':nome', $_POST['nome']);
$stmt->bindParam(':email', $_POST['email']);
$stmt->bindParam(':cnpj', $_POST['cnpj']);

try
{
	$stmt->execute();
	$_SESSION['msg'] = "Usuário inserido com sucesso";

	header("Location: ../../pages/cliente/listar.php");
}
catch(PDOException $e)
{
	$_SESSION['erro'] = "Erro: " . $e->getMessage();
}

?>