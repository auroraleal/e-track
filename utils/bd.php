<?php

try {
	$conn = new PDO( 'mysql:host=' . 'localhost' . ';dbname=' . 'convenios', 'root', '@Jeronimo2', array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
} catch ( PDOException $e ) {
    echo 'Erro ao conectar com o MySQL: ' . $e->getMessage();
}

?>