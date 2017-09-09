<?php
	if (!empty($_GET['user'])) {
		require_once('class/class.user.php');
		$login = new login();
		$login->protege($_SESSION['token']);
		$usuario = new usuario();
		$id = $usuario->pesquisa($_GET['user']);
	}else{header("Location: index.php");}
?>