<?php
	if (!empty($_POST['email']) && !empty($_POST['pass'])) {
		require_once('../class/class.user.php');
		$email = $_POST['email'];
		$pass = $_POST['pass'];
		$login = new login();
		$login->aprova($email, $pass);
	}

?>