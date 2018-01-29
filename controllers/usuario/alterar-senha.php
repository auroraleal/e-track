<?php
session_start();
include '../../utils/bd.php';
include '../../utils/valida_login.php';

$stmt = $conn->prepare("UPDATE usuario SET senha = :senha
WHERE id = :id");

$senha = md5($_POST['senha']);

$stmt->bindParam(':id', $_SESSION['id']);
$stmt->bindParam(':senha', $senha);

try
{
	$stmt->execute();
	$_SESSION['msg'] = "Senha alterada com sucesso";
	header("Location: ../../pages/usuarios/alterar-senha.php");
}
catch(PDOException $e)
{
	$_SESSION['erro'] = "Erro: " . $e->getMessage();
}

?>