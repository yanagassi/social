<?php
	if (!empty($_GET['user'])) {
		require_once("class/class.user.php");
		$login = new login();
		$login->protege($_SESSION['token']);
		include_once("views/usuario.php");
	}
	else{header("Location: index.php");}
?>