<?php 
	require_once('class/class.response.php');
	$response = new response();
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Responder: <?php echo $response->getPerg($_GET['quest'], 'pergunta'); ?></title>
</head>
<body>
	<div class="">
		<form action="forms/responder.php?quest=<?php echo $_GET['quest'] ?>" method="POST">
			<p><?php echo $response->getPerg($_GET['quest'], 'pergunta');  ?></p>
			<textarea name="resposta"></textarea>
			<input type="submit" value="Responder" name="">
		</form>
	</div>
</body>
</html>