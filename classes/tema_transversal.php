<?php
	class Tema_Transversal
	{
		private $pdo;
		public $msgErro = "";
		public function conectar($nome, $host, $usuario, $senha)
		{
			global $pdo;
			global $msgErro;
			try
			{
				$pdo = new PDO("mysql:dbname=".$nome.";host=".$host, $usuario, $senha);
			} catch(PDOException $e) {
				$msgErro = $e->getMessage();
			}

		}

		public function cadastrar($nome, $descricao)
		{
			global $pdo;
			$sql = $pdo->prepare("SELECT id FROM temas_transversais WHERE nome = :n");
			$sql->bindValue(":n", $nome);
			$sql->execute();

			if($sql->rowCount() > 0)
			{
				return false;
			}
			else
			{
				$sql = $pdo->prepare("INSERT INTO temas_transversais (nome, descricao) VALUES (:n, :d)");
				$sql->bindValue(":n", $nome);
                $sql->bindValue(":d", $descricao);
				
				$sql->execute();
				return true;			
			}
		}
	}
?>