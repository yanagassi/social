<?php
	require_once("../class/class.user.php");
	$login = new login();
	$login->protege($_SESSION['token']);
	$login->sair();
?>