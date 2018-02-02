<?php
session_start();
include '../../utils/bd.php';
include '../../utils/valida_login.php';

$stmt = $conn->prepare("UPDATE usuario SET nome = :nome, 
usuario = :usuario, cliente_id = :cliente, 
perfil_id = :perfil, senha = :senha
WHERE id = :id");

$id = $_POST['id'];
$stmtSenha = $conn->query("SELECT senha FROM usuario WHERE id = $id");
$resultSenha = $stmtSenha->fetch(PDO::FETCH_ASSOC);
if ($_POST['senha'] != $resultSenha['senha']) {
	$senha = md5($_POST['senha']);
} else {
	$senha = $_POST['senha'];
}

$cliente = $_POST['cliente'] ? $_POST['cliente'] : null;

$stmt->bindParam(':id', $_POST['id']);
$stmt->bindParam(':nome', $_POST['nome']);
$stmt->bindParam(':usuario', $_POST['usuario']);
$stmt->bindParam(':cliente', $cliente);
$stmt->bindParam(':perfil', $_POST['perfil']);
$stmt->bindParam(':senha', $senha);

try
{
	$stmt->execute();
	$_SESSION['msg'] = "Usuário atualizado com sucesso";

	header("Location: ../../pages/usuarios/listar.php");
}
catch(PDOException $e)
{
	$_SESSION['erro'] = "Erro: " . $e->getMessage();
}

?>