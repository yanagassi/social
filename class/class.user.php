<?php
	error_reporting(E_ALL ^E_NOTICE);
/**
* 
*/
class conexao
{
	function conecta(){
		$user = 'root';
		$pass = '';
		$conn = new PDO('mysql:host=localhost;dbname=banco', $user, $pass,array(PDO::MYSQL_ATTR_INIT_COMMAND =>"SET NAMES 'utf8'"));
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		return $conn;
	}
}
/**
* 
*/
class dados
{
	
	function __construct()
	{
		$conexao = new conexao();
		$conn = $conexao->conecta();
		$this->conn = $conn;
		$this->user = $_SESSION['token'];
	}

	function getData($dado)
	{
		$data = $this->conn->prepare("SELECT * FROM users WHERE token=:token");
		$data->bindParam(":token", $this->user, PDO::PARAM_STR);
		$data->execute();
		foreach ($data as $key) {
			$dado = $key[$dado];
			return $dado;
			break;
		}
	}
}
/**
* 
*/
class login
{
	
	function __construct()
	{
		$conexao = new conexao();
		$this->conn = $conexao->conecta();
		session_start();
	}

	function aprova($email,$pass)
	{
		$data = $this->conn->prepare("SELECT *FROM users WHERE email=:email");
		$data->bindParam(':email', $email, PDO::PARAM_STR);
		$data->execute();
		foreach ($data as $row) {
			$passDB = $row['senha'];
			break;
		}
		if($pass == $passDB)
		{
			$token = md5(uniqid(time()).$email.'/'.$pass);
			$data = $this->conn->prepare("UPDATE users SET token=:token where email=:email");
			$data->bindParam(':token', $token, PDO::PARAM_STR);
			$data->bindParam(':email', $email, PDO::PARAM_STR);
			$data->execute();
			$_SESSION['token'] = $token;
		}
		header("Location: ../index.php");
	}

	function protege($token)
	{
		$data= $this->conn->prepare("SELECT * FROM users WHERE token=:token");
		$data->bindParam(':token', $token, PDO::PARAM_STR);
		$data->execute();
		foreach ($data as $key) {
			$email = $key['email'];
			break;
		}
		if (empty($email)) {
			$_SESSION['token'] = '';
			session_destroy();
			header('Location: index.php');
		}
	}

	function sair()
	{
		$data = $this->conn->prepare("SELECT * FROM users WHERE token=:token");
		$token = md5(uniqid(time()).$email.'/'.$pass);
		$data = $this->conn->prepare("UPDATE users SET token=:token");
		$data->bindParam(':token', $token, PDO::PARAM_STR);
		$data->execute();
		session_destroy();
		header("Location: ../index.php");
	}
}

/**
* 
*/
class usuario
{
	
	function __construct()
	{
		$conexao = new conexao();
		$this->conn = $conexao->conecta();
	}

	function pesquisa($nome)
	{
		$usuario = new usuario();
		$data = $this->conn->prepare("SELECT * FROM users WHERE nome=:nome");
		$data->bindParam(":nome", $nome, PDO::PARAM_STR);
		$data->execute();
		$linhas= $data->rowCount();
		for($i = 0; $i<$linhas; $i++)
		{
			foreach ($data as $key) {
				$id = $key['id'];
				break;
			}
			$usuario->echoUsuarios($id);
		}
	}

	function echoUsuarios($id)
	{
		$data = $this->conn->prepare("SELECT * FROM users WHERE id=:id");
		$data->bindParam(":id", $id, PDO::PARAM_INT);
		$data->execute();
		foreach ($data as $row) {
			$nome = $row['nome'];
			$foto = $row['foto'];
			$link = $row['link'];
			print('<content><a href="usuario.php?user='.$link.'">');
			if(!empty($foto)){
				print('<img src="server-images/'.$foto.'">');
			}else{
				print('<img src="server-images/default.png">');
			}
			print('<a href="usuario.php?user='.$link.'">'.$nome.'</a>');
			print('</content></a>');
			break;
		}
	}

	function getData($link, $quero)
	{
		$data = $this->conn->prepare("SELECT * FROM users WHERE link=:link");
		$data->bindParam(":link", $link, PDO::PARAM_STR);
		$data->execute();
		foreach ($data as $row) {
			$dado = $row[$quero];
			break;
		}
		return $dado;
	}

	function pegaRespondidas($link)
	{
		$classUser = new usuario();
		$data = $this->conn->prepare("SELECT * FROM users WHERE link=:link");
		$data->bindParam(":link", $link, PDO::PARAM_STR);
		$data->execute();
		foreach ($data as $row) {
			$resp = $row['perguntas'];
			$nome = $row['nome'];
			$token = $row['token'];
			break;
		}
		$resp = explode(';', $resp);
		$resp = array_reverse($resp);
		$num = count($resp);

		for($i=0; $i< $num; $i++)
		{
			$id = $resp[$i];
			$data= $this->conn->prepare("SELECT * FROM perguntas WHERE id=:id");
			$data->bindParam(":id", $id, PDO::PARAM_INT);
			$data->execute();
			foreach ($data as $key) {
				$perg = $key['pergunta'];
				$resposta = $key['resposta'];
				$status = $key['status'];
				$data = $key['data'];
				$tiper = $key['tiper'];
				if ($status != 0 ) {
					$classUser-> falaPergunta($perg, $resposta, $nome, $data, $tiper,  $token);
				}
				break;
			}
		}
	}

	function falaPergunta($perg, $resposta, $nome, $data,$tiper,  $token)
	{
		$nome = explode(' ', $nome);
		print('<content id="user-quest-ask">');
		print('<p id="p-pergunta">Anonimo: '. $perg.'</p>');
		print('<p id="p-resposta">'. $nome[0].': '.$resposta.'</p>');
		print('<a id="a-data">'. $data.'</a>');
		if($_SESSION['token'] == $token){
			print('<a id="a-apagar" href="forms/apagar.php?quest='.$tiper.'">Apagar</a>');
		}
		print('</content>');
		print('<hr>');
	}
}

/**
* 
*/
class perguntas
{
	
	function __construct()
	{
		$conexao = new conexao();
		$this->conn = $conexao->conecta();
	}

	function enviarPergunta($pergunta, $link)
	{
		date_default_timezone_set('America/Sao_Paulo');
		$date = date('Y-m-d H:i');
		$tiper = md5(uniqid(time().random_int(0, 99999).random_int(0, 99999)));
		$data = $this->conn->prepare("INSERT INTO perguntas (id, pergunta, resposta, status, tiper, data) values (null, :pergunta, '',0, :tiper, :data)");
		$data->bindParam(":pergunta", $pergunta, PDO::PARAM_STR);
		$data->bindParam(":tiper", $tiper, PDO::PARAM_STR);
		$data->bindParam(":data", $date, PDO::PARAM_STR);
		$data->execute();
		$data = $this->conn->prepare("SELECT * FROM perguntas WHERE tiper=:tiper");
		$data->bindParam(":tiper", $tiper, PDO::PARAM_STR);
		$data->execute();
		foreach ($data as $key) {
			$id = $key['id'];
			break;
		}

		$data = $this->conn->prepare("SELECT * FROM users where link=:link");
		$data->bindParam(":link", $link, PDO::PARAM_STR);
		$data->execute();
		foreach ($data as $num) {
			$perg = $num['perguntas'];
			break;
		}
		$array = explode(";", $perg);
		array_push($array, $id);
		$array = implode(";", $array);
		$data =  $this->conn->prepare("UPDATE users SET perguntas=:perg where link=:link");
		$data->bindParam(":perg", $array, PDO::PARAM_STR);
		$data->bindParam(":link",$link,PDO::PARAM_STR);
		$data->execute();

		header("Location: ../usuario.php?user=".$link);
	}

	function nao_respondidas($token)
	{
		$data = $this->conn->prepare("SELECT * FROM users WHERE token=:token");
		$data->bindParam(":token", $token, PDO::PARAM_STR);
		$data->execute();
		foreach ($data as $key) {
			$perguntas = $key['perguntas'];
			break;
		}
		$array = explode(";", $perguntas);
		$num = count($array);
		for ($i=0; $i < $num ; $i++) { 
			$id = $array[$i];
			$data = $this->conn->prepare("SELECT * FROM perguntas where id=:id");
			$data->bindParam(":id", $id, PDO::PARAM_INT);
			$data->execute();
			foreach ($data as $key) {
				$status = $key['status'];
				$perg = $key['pergunta'];
				$tiper = $key['tiper'];
				$data = $key['data'];
				break;
			}

			if ($status == 0) {
				if(!empty($perg)){
					print('<content id="box-ask">');
					print('<p id="box-ask-a">'.$perg.'</p>');
					print('<a id="box-ask-responder" href="responder.php?quest='.$tiper.'">Responder</a>');
					print('<a id="box-ask-apagar" href="forms/apagar.php?quest='.$tiper.'">Apagar</a>');
					print('<a id="box-ask-data">'.$data.'</a>');
					print('</content>');
					print('<hr>');
				}
			}
		}
	}
}
?>
