<?php
session_start();
include '../../utils/bd.php';
include '../../utils/valida_login.php';

$operacao = $_POST['operacao'];

switch ($operacao) {
    case 'entrada_triagem' :
        $query = "UPDATE carga SET entrada_triagem = :dataAtual, ordem_saida_triagem = ordem_saida('triagem')
                  WHERE idcarga = :id";
        break;
    case 'saida_triagem' :
        $query = "UPDATE carga SET saida_triagem = :dataAtual WHERE idcarga = :id";
        break;
    case 'entrada_etc_itaituba' :
        $query = "UPDATE carga SET entrada_etc_itaituba = :dataAtual, ordem_saida_etc_itaituba = ordem_saida('etc_itaituba')
                  WHERE idcarga = :id";
        break;
    case 'saida_etc_itaituba' :
        $query = "UPDATE carga SET saida_etc_itaituba = :dataAtual WHERE idcarga = :id";
        break;
}

$tz = 'America/Belem';
$timestamp = time();
$dt = new DateTime("now", new DateTimeZone($tz));
$dt->setTimestamp($timestamp);

$stmt = $conn->prepare($query);
$dt = new DateTime();
$stmt->bindParam(':dataAtual', $dt->format('Y-m-d H:i:s'));
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