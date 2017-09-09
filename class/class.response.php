<?php
	class conn
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
	class response
	{
		
		function __construct()
		{
			$conexao = new conn;
			$this->conn = $conexao->conecta();
		}

		function getPerg($tiper, $quero)
		{
			$data = $this->conn->prepare("SELECT * FROM perguntas WHERE tiper=:tiper");
			$data->bindParam(":tiper", $tiper, PDO::PARAM_STR);
			$data->execute();
			foreach ($data as $row) {
				$response = $row[$quero];
			}
			return $response;
		}

		function responder($tiper, $resp)
		{
			$data = $this->conn->prepare("UPDATE perguntas SET resposta=:resp, status=1 WHERE tiper=:tiper");
			$data->bindParam(":resp", $resp, PDO::PARAM_STR);
			$data->bindParam(":tiper", $tiper, PDO::PARAM_STR);
			$data->execute();
		}

		function deleta($tiper)
		{
			$data = $this->conn->prepare("DELETE FROM perguntas where tiper=:tiper");
			$data->bindParam(':tiper', $tiper, PDO::PARAM_STR);
			$data->execute();

		}
		function getLink($token)
		{
			$data = $this->conn->prepare("SELECT * FROM users where token=:token");
			$data->bindParam(':token', $token, PDO::PARAM_STR);
			$data->execute();
			foreach ($data as $key) {
				$link = $key['link'];
				break;
			}
			return $link;
		}
	}

?>