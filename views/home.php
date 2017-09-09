<?php
	$dado = new dados();
	$login = new login();
	$login->protege($_SESSION['token']);
	$perguntas = new perguntas();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Home - <?php echo $dado->getData('nome'); ?></title>
	<link rel="stylesheet" type="text/css" href="css/css.home.css">
</head>
<body>
	<div class="topo">
		<img id="user-topo-foto" src="server-images/<?php echo $dado->getData('foto'); ?>">
		<a id="user-topo-name" href=""><?php echo $dado->getData('nome'); ?></a>
		<form action="pesquisa.php" method="GET">
			<input id="user-topo-pesquisa" type="text" name="user">
		</form>
		<a id='sair' href="forms/sair.php">Sair</a>
	</div>	
	<div class="centro">
	<p style="font-size: 20px; margin-left: 5%;">Não respondidas:</p>
	<hr>
		<?php $perguntas-> nao_respondidas($_SESSION['token']);?>
	</div>
</body>
</html>