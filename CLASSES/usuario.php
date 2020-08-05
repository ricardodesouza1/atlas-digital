<?php

Class Usuario
{
	private $pdo;
	private $msgErro = "";

	public function conectar($nome, $host, $usuario, $senha){	

		global $pdo;
		global $msgErro;
		try {
			$pdo = new PDO("mysql:dbname=".$nome.";host=".$host,$usuario,$senha);
		} catch (PDOException $e) {
			$msgErro = $e->getMessage();
		}
		
	}

	public function cadastrar($nome, $telefone, $email, $senha){

		global $pdo;
		// verificar se email já existe
		$sql = $pdo->prepare("SELECT id_usuario FROM usuarios WHERE email = :e");
		$sql->bindValue(":e", $email);
		$sql->execute();
		if($sql->rowCount() > 0)
		{
			return false; // já cadastrado
		}else{

		//caso não exista, cadastro
			$sql = $pdo->prepare("INSERT INTO usuarios (nome, telefone, email, senha) VALUES (:n, :t, :e, :s)");

			$sql->bindValue(":n", $nome);
			$sql->bindValue(":t", $telefone);
			$sql->bindValue(":e", $email);
			$sql->bindValue(":s", md5($senha));
			$sql->execute();
			return true;
		}
	}

	/*public function imagem($codigo){
		global $pdo;

		$sql = $pdo->prepare("SELECT * FROM mapas");
		$sql->bindValue

	}*/
	//upload de arquivo
	public function upload($arquivo, $nome){
		global $pdo;

		$sql = $pdo->prepare("INSERT INTO mapas (arquivo, data, nome) VALUES (:a, NOW(), :n)");
		$sql->bindValue(":a", $arquivo);
		$sql->bindValue(":n", $nome);
		$sql->execute();

		return true;


	}
	// Excluir dados do banco 
	public function excluirBanco($codigo){
		global $pdo;
		$sql = $pdo->prepare("DELETE FROM mapas WHERE codigo = :codigo");
		$sql->bindValue(":codigo",$codigo);
		$sql->execute();
	}
	//buscar dados do banco
	public function buscarDadosMapa($codigo){
		global $pdo;
		$sql = $pdo->prepare("SELECT * FROM mapas WHERE codigo = :codigo");
		$sql->bindValue(":codigo",$codigo);
		$sql->execute();
		$resultado = $sql->fetch();
		return $resultado;

	}
	// ATUALIZAR DADOS BANCO
	public function atualizarMapas(){

	}


	public function logar($email, $senha){

		global $pdo;
		//verificação de email e senha se estão cadastrados
			$sql = $pdo->prepare("SELECT id_usuario FROM usuarios WHERE email = :e AND senha = :s");
			$sql->bindValue(":e", $email);
			$sql->bindValue(":s", md5($senha));
			$sql->execute();

			if($sql->rowCount() > 0){
				// usuário pode acessar o sistema
				$dado = $sql->fetch();
				session_start();
				$_SESSION['id_usuario'] = $dado['id_usuario'];
				return true; // logado com sucesso
			}else{
				return false; // não foi possível logar
			}
		
	}
}







?>