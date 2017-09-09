<?php
	require_once('class/class.user.php');
	$usuario = new usuario();
	$login= new login();
	$dado = new dados();
	$login->protege($_SESSION['token']);
	$link =($_GET['user']);
?>
<!DOCTYPE html>
<html>
<head>
	<title><?php echo $usuario->getData($link,'nome');?></title>
	<link rel="stylesheet" type="text/css" href="css/css.home.css">
	<link rel="stylesheet" type="text/css" href="css/css.usuario.css">
</head>
<body>
	<div class="topo">
		<img id="user-topo-foto" src="server-images/<?php echo $dado->getData('foto'); ?>">
		<a id="user-topo-name" href="../index.php"><?php echo $dado->getData('nome'); ?></a>
		<form action="pesquisa.php" method="GET">
			<input id="user-topo-pesquisa" type="text" name="user">
		</form>
		<a id='sair' href="forms/sair.php">Sair</a>
	</div>	
	<div class="user-center">
		<content class="user-dados">
			<img id="user-dados-foto" src="../server-images/<?php echo $usuario->getData($link,'foto'); ?>">
			<a id="user-dados-nome"><?php echo $usuario->getData($link,'nome'); ?></a>
		</content>
		<hr>
		<div class="user-ask">
			<form action="forms/enviar-pergunta.php?user=<?php echo $_GET['user'] ?>" method="post">
				<textarea id="user-ask-textarea" name="pergunta"></textarea>
				<input id="user-ask-buton" type="submit" value="Enviar">
			</form>
		</div>
		<hr>
		<content class="user-quests">
			<?php $usuario->pegaRespondidas($link)?>			
		</content>
	</div>
</body>
</html>