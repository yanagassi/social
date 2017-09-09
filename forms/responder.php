<?php

	if (!empty($_POST['resposta']) && !empty($_GET['quest'])) {
		require_once("../class/class.response.php");
		$resp = new response;
		$resp->responder($_GET['quest'], $_POST['resposta']);
		header("Location: ../index.php");
	}else{
		header("Location: ../responder.php");
	}
?>