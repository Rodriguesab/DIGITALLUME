<?php
class pessoa
{
	private $pdo; // variável a ser usada nos métodos.
	public function __construct($dbname, $host, $user, $senha)
	{
    	try
    	{
        	$this->pdo = new PDO("mysql:dbname=".$dbname.";host=".$host,$user,$senha);
    	}
    	catch (PDOException $e)
    	{
        	echo "Erro com banco de dados: ".$e->getMessage();
        	exit();
    	}
    	catch (Exception $e)
    	{
        	echo "Erro genérico: ".$e->getMessage();
    	}
	}

	public function buscarDados()
	{
    	$res = array(); // para evitar erros caso nao retorne nada.
    	$cmd = $this->pdo->query("SELECT * FROM crud ORDER BY ID DESC");
    	$res = $cmd->fetchAll(PDO::FETCH_ASSOC);  // trazer apenas os valores das colunas
    	return $res;  // retornando para quem chamar o método.
	}


	public function cadastrarPessoa($nome, $telefone, $email)
	{
		// antes de cadastrar, verificar se já está cadastrada:
		$cmd = $this->pdo->prepare("SELECT id FROM crud WHERE email = :e");
		$cmd->bindValue(":e", $email);
		$cmd->execute();
		if($cmd->rowCount() > 0)
		{
			return false;
		}
		else
		{
			$cmd = $this->pdo->prepare("INSERT INTO crud (nome, telefone, email) VALUES (:n, :t, :e)");
			$cmd->bindValue(":n", $nome);
			$cmd->bindValue(":t", $telefone);
			$cmd->bindValue(":e", $email);
			$cmd->execute();
			return true;
		}
	}
		public function excluirPessoa($id)
		{
			$cmd = $this->pdo->prepare("DELETE FROM crud WHERE id = :i");
			$cmd->bindValue(":i",$id);
			$cmd->execute();
		}
		public function buscarDadosPessoa($id)
		{
			$res = array();  // para caso não venha nada do banco a variavel ser um array vazio e não dar erro
			$cmd = $this->pdo->prepare("SELECT * FROM crud WHERE id = :i");
			$cmd->bindValue(":i",$id);
			$cmd->execute();
			$res = $cmd->fetch(PDO::FETCH_ASSOC); // fech pq é uma só pessoa
			return $res; // para retornar os dados nessa variavel
		}
		public function atualizarDados($id, $nome, $telefone, $email)
		// colocamos acima o $id também, não para alterá-lo, mas para usá-lo no filtro.
		{
			/* //antes, verificar se o usuario já está cadastrado:
			$cmd = $this->pdo->prepare("SELECT id FROM alunos WHERE email = :e");
			$cmd->bindValue(":e", $email);
			$cmd->execute();
			if($cmd->rowCount() > 0)
			{
			return false;
			}
			else
			{  */
				$cmd = $this->pdo->prepare("UPDATE crud SET nome = :n, telefone = :t, email = :e WHERE id = :i");
				$cmd->bindValue(":n",$nome);
				$cmd->bindValue(":t",$telefone);
				$cmd->bindValue(":e",$email);
				$cmd->bindValue(":i",$id);
				$cmd->execute();
				// return true;
			//}
		}
	}


		


