<?php
session_start();
include '../utils/bd.php';
include '../../utils/valida_login.php';

$stmt = $conn->prepare("SELECT u.id, u.email, p.nome as perfil, 
c.nome as nome_cliente,
c.idcliente as cliente_id 
FROM usuario u 
INNER JOIN perfil p ON u.perfil_id = p.id
LEFT JOIN cliente c ON u.cliente_id= c.idcliente
WHERE u.email = :email AND u.senha = :senha ");

$senha = md5($_POST['senha']);

$stmt->bindParam(':email', $_POST['email']);
$stmt->bindParam(':senha', $senha);
$stmt->execute();

$results = $stmt->fetch(PDO::FETCH_ASSOC);

if (empty($results)) {
	$_SESSION['erro'] = "Usuário inexistente";
	header("Location: ../pages/login.php");
} else {
	if (isset($results['cliente_id'])) {
		$_SESSION['cliente_id'] = $results['cliente_id'];		
	}

	$_SESSION['id'] = $results['id'];
	$_SESSION['email'] = $results['email'];
	$_SESSION['nome_cliente'] = $results['nome_cliente'];
	$_SESSION['perfil'] = $results['perfil'];

	switch ($results['perfil']) {
		case 'Administrador' :
			header("Location: ../pages/usuarios/listar.php");
			break;
		case 'Cliente' :
			header("Location: ../pages/carga/listar.php");
			break;
		case 'Operador Triagem' :
			header("Location: ../pages/operador/pesquisar.php");		
			break;
		case 'Operador ETC' :
			header("Location: ../pages/operador/pesquisar.php");
			break;		
	}
}

?>