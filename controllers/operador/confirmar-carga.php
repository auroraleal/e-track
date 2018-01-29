<?php
session_start();
include '../../utils/bd.php';
include '../../utils/valida_login.php';

$operacao = $_POST['operacao'];

switch ($operacao) {
    case 'entrada_triagem' :
        $query = "UPDATE carga SET entrada_triagem = now() WHERE idcarga = :id";
        break;
    case 'saida_triagem' :
        $query = "UPDATE carga SET saida_triagem = now() WHERE idcarga = :id";
        break;
    case 'entrada_etc_itaituba' :
        $query = "UPDATE carga SET entrada_etc_itaituba = now() WHERE idcarga = :id";
        break;
    case 'saida_etc_itaituba' :
        $query = "UPDATE carga SET saida_etc_itaituba = now() WHERE idcarga = :id";
        break;
}

$stmt = $conn->prepare($query);
$stmt->bindParam(':id', $_POST['idcarga']);

try
{
	$stmt->execute();
	$_SESSION['msg'] = "Operação registrada com sucesso";

	header("Location: ../../pages/operador/pesquisar.php");
}
catch(PDOException $e)
{
    die($e->getMessage());
	$_SESSION['erro'] = "Erro: " . $e->getMessage();
}

?>