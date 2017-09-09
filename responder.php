<?php
	if (!empty($_GET['quest'])) {
		require_once("class/class.user.php");
		$login = new login();
		$login->protege($_SESSION['token']);
		include_once('views/resposta.php');
	}
	else{header('Location: index.php');}
?>