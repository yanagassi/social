<?php
	if (!empty($_POST['pergunta']) && !empty($_GET['user'])) {
		require_once("../class/class.user.php");
		$pergunta = $_POST['pergunta'];
		$perguntas =  new perguntas();
		$link = $_GET['user']; 
		$perguntas->enviarPergunta($pergunta, $link);
	}
	else{ header("Location: index.php");}
?>