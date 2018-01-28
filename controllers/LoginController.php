
<?php
session_start();
include '../utils/bd.php';
include '../../utils/valida_login.php';


$stmt = $conn->prepare("SELECT u.email, p.nome as perfil FROM usuario u INNER JOIN perfil p ON u.perfil_id = p.id WHERE u.email = :email AND u.senha = :senha ");

$senha = md5($_POST['senha']);

$stmt->bindParam(':email', $_POST['email']);
$stmt->bindParam(':senha', $senha);
$stmt->execute();

$results = $stmt->fetch(PDO::FETCH_ASSOC);

if (empty($results)) {
	$_SESSION['erro'] = "Usuário inexistente";
	header("Location: ../pages/login.php");
} else {
	$_SESSION['email'] = $results['email'];
	$_SESSION['perfil'] = $results['perfil'];

	header("Location: ../pages/index.php");
}


?>