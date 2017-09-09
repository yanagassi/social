<?php

if (!empty($_GET['quest'])){
	require_once("../class/class.response.php");
	require_once('../class/class.user.php');
	$response = new response;
	$prote = new login;
	$prote->protege($_SESSION['token']);
	$response->deleta($_GET['quest']);
	echo "<body onload='window.history.back();'>";
}

?>

