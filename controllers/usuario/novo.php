<?php
session_start();
include '../../utils/bd.php';
include '../../utils/valida_login.php';

$stmt = $conn->prepare("INSERT INTO usuario(nome, email, cliente_id, perfil_id, senha) values(:nome, :email, :cliente, :perfil, :senha)");
$senha = md5($_POST['senha']);

$cliente = $_POST['cliente'] ? $_POST['cliente'] : null;

$stmt->bindParam(':nome', $_POST['nome']);
$stmt->bindParam(':email', $_POST['email']);
$stmt->bindParam(':cliente', $cliente);
$stmt->bindParam(':perfil', $_POST['perfil']);
$stmt->bindParam(':senha', $senha);

try
{
	$stmt->execute();
	$_SESSION['msg'] = "Usuário inserido com sucesso";

	header("Location: ../../pages/usuarios/listar.php");
}
catch(PDOException $e)
{
	$_SESSION['erro'] = "Erro: " . $e->getMessage();
}

?>