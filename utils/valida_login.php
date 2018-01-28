<?php

if (!isset($_SESSION['email']) && !isset($_SESSION['perfil'])) {
	header('Location: /e-conv/pages/login.php');
}

?>