<?php
session_start();
include '../../utils/bd.php';
include '../../utils/valida_login.php';


$stmt = $conn->prepare("INSERT INTO usuario(nome, email, perfil_id, senha) values(:nome, :email, :perfil, :senha)");

$senha = md5($_POST['senha']);

$stmt->bindParam(':nome', $_POST['nome']);
$stmt->bindParam(':email', $_POST['email']);
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