<?php

date_default_timezone_set('America/Belem');

try {
 $conn = new PDO( 'mysql:host=' . 'localhost' . ';dbname=' . 'e_track', 'root', '', array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
	// $conn = new PDO( 'mysql:host=' . 'bd.cianport.com.br' . ';dbname=' . 'bdetrack', '5mvd38cvt6', '>WybXBdg2cmTJ{2LVB?Y', array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
} catch ( PDOException $e ) {
    echo 'Erro ao conectar com o MySQL: ' . $e->getMessage();
}

?>
