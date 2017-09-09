<?php
	session_start();
	if (!empty($_SESSION['token'])) {
		require_once("class/class.user.php");
		include_once('views/home.php');
	}else{
		session_destroy();
		include_once('views/login.html');
	}
?>