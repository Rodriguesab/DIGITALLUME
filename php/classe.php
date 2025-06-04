<?php
class estudante
{
	private $pdo; // variável a ser usada nos métodos.
	public function __construct($dbname, $host, $user, $senha)
	{
		try
		{
			$this->pdo = new PDO("mysql:dbname=".$dbname.";host=".$host,$user,$senha);
			// $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // $this->pdo->setAttribute(PDO::ATTR_CASE, PDO::CASE_LOWER); // Tudo em minúsculo

		}
		catch (PDOException $e)
		{
			echo "Erro com banco de dados: ".$e->getMessge();
			exit();
		}
		catch (Exception $e)
		{
			echo "Erro genérico: ".$e->getMessage();
		}
	}
	
public function cadastrarUsuario($nom, $email, $data_n, $cpf, $usu, $s_phone, $sen)
{
		// antes de cadastrar, verificar se já está cadastrada:
		$cmd = $this->pdo->prepare("SELECT * FROM alunos WHERE campo_usu = :e or cpf = :c");
		$cmd->bindValue(":e", $usu);
		$cmd->bindValue(":c", $cpf);
		$cmd->execute();
		if($cmd->rowCount() > 0)
		{
			return false;
		}
		else
		{
			$cmd = $this->pdo->prepare("INSERT INTO aluno (nome, email , data_nascimento, cpf, telefone campo_usu, senha) VALUES (:n, :m, :d, :c, :u, :h)");
			$cmd->bindValue(":n", $nom);
			$cmd->bindValue(":m", $email);
			$cmd->bindValue(":d", $data_n);
			$cmd->bindValue(":c", $cpf);
			$cmd->bindValue(":p", $s_phone);
			$cmd->bindValue(":u", $usu);
			// $cmd->bindValue(":h", $sen);
			$cmd->bindValue(":h", password_hash($sen, PASSWORD_DEFAULT));
			$cmd->execute();
			return true;
		}
}

public function alterarUsuario($id_usu, $nom, $email, $dt_n, $cp, $tel, $usu, $senh)
{
	// colocamos acima o $id também, não para alterá-lo, mas para usá-lo no filtro.
	$cmd = $this->pdo->prepare("UPDATE tb_usuario SET nome = :n, sexo = :s, data_nasc = :d, cpf = :c, campo_usuario = :u, campo_senha = :h WHERE id = :i");
	$cmd->bindValue(":n", $nom);
	$cmd->bindValue(":s", $sex);
	$cmd->bindValue(":d", $dt_n);
	$cmd->bindValue(":c", $cp);
	$cmd->bindValue(":p", $tel);
	$cmd->bindValue(":u", $usu);
	$cmd->bindValue(":h", $senh);
	
		
	$cmd->bindValue(":i", $id_usu);
	$cmd->execute();
	return;
		
}

public function excluirUsuario($email_usu)
{
	$cmd = $this->pdo->prepare("DELETE FROM aluno WHERE campo_usu = :e");
	$cmd->bindValue(":e",$email_usu);
	$cmd->execute();
	return;
}

public function pesquisarUsuarioLogin($ema, $sen) 
{
	$res = array();  // para caso não venha nada do banco a variavel ser um array vazio e não dar erro
	$cmd = $this->pdo->prepare("SELECT * FROM aluno WHERE campo_usu = :e");
	$cmd->bindValue(":e",$ema);
	// $cmd->bindValue(":s",$sen);
	$cmd->execute();
	
	if ($cmd->errorCode() != '00000')  // verificar erro de conexão
	{
        $error = $cmd->errorInfo();
        echo 'Erro na consulta SQL: ' . $error[2];  // Exibe o erro se houver
    }
	
	if ($cmd->rowCount() == 1) 
	{
	
        $dados = $cmd->fetch(PDO::FETCH_ASSOC);
        if (password_verify($sen, $dados['SENHA'])) 
		{
            return true;
        }
		else
		{
			return false;
		}
	}
	/*
	//outra forma:
	$dados = $cmd->fetch(PDO::FETCH_ASSOC); // retorna vazio se não encontrar
	if ($dados && password_verify($sen, $dados['CAMPO_SENHA'])) 
	{
		return true;
	} 
	else 
	{
		return false;
	}*/ 
 
}
public function pesquisar_Para_Alterar_Usuario($email_usu) 
{
	$cmd = $this->pdo->prepare("SELECT * FROM tb_usuario WHERE campo_usuario = :e");
	$cmd->bindValue(":e",$email_usu);
	$cmd->execute();
	$res = $cmd->fetch(PDO::FETCH_ASSOC);
	return $res;
}	
}




class adminitrador 
{
	private $pdo; // variável a ser usada nos métodos.
	public function __construct($dbname, $host, $user, $senha)
	{
		try
		{
			$this->pdo = new PDO("mysql:dbname=".$dbname.";host=".$host,$user,$senha);
			// $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // $this->pdo->setAttribute(PDO::ATTR_CASE, PDO::CASE_LOWER); // Tudo em minúsculo

		}
		catch (PDOException $e)
		{
			echo "Erro com banco de dados: ".$e->getMessge();
			exit();
		}
		catch (Exception $e)
		{
			echo "Erro genérico: ".$e->getMessage();
		}
	}
	
public function cadastrarUsuario($nom, $email, $data_n, $cp, $phone, $usu, $sen, $cod)
{
		// antes de cadastrar, verificar se já está cadastrada:
		$cmd = $this->pdo->prepare("SELECT * FROM bibliotecarios WHERE campo_usu = :e or cpf = :c");
		$cmd->bindValue(":e", $usu);
		$cmd->bindValue(":c", $cp);
		$cmd->execute();
		if($cmd->rowCount() > 0)
		{
			return false;
		}
		else
		{
			$cmd = $this->pdo->prepare("INSERT INTO bibliotecarios (nome, email, data_nascimento, cpf, campo_usu, telefone,senha, codigo_institucional) VALUES (:n, :m, :d, :c, :u, :p :s, :g)");
			$cmd->bindValue(":n", $nom);
			$cmd->bindValue(":m", $email);
			$cmd->bindValue(":d", $data_n);
			$cmd->bindValue(":c", $cp);
			$cmd->bindValue(":p", $phone);
			$cmd->bindValue(":u", $usu);
			$cmd->bindValue(":g", $cod);
			// $cmd->bindValue(":h", $sen);
			$cmd->bindValue(":h", password_hash($sen, PASSWORD_DEFAULT));
			$cmd->execute();
			return true;
		}
}

public function alterarUsuario($id_usu, $nom, $email, $dt_n, $cp, $phone, $usu, $sen, $cod)
{
	// colocamos acima o $id também, não para alterá-lo, mas para usá-lo no filtro.
	$cmd = $this->pdo->prepare("UPDATE bibliotecarios SET nome = :n, email = :s, data_nascimento = :d, cpf = :c, telefone = :c campo_usu = :u, senha = :h codigo_institucional = :g WHERE id = :i");
	$cmd->bindValue(":n", $nom);
	$cmd->bindValue(":s", $email);
	$cmd->bindValue(":d", $dt_n);
	$cmd->bindValue(":c", $cp);
	$cmd->bindValue(":p", $phone);
	$cmd->bindValue(":u", $usu);
	$cmd->bindValue(":h", $senh);
	$cmd->bindValue(":g", $cod);
	
		
	$cmd->bindValue(":i", $id_usu);
	$cmd->execute();
	return;
		
}

public function excluirUsuario($email_usu)
{
	$cmd = $this->pdo->prepare("DELETE FROM bibliotecarios WHERE campo_usu = :e");
	$cmd->bindValue(":e",$email_usu);
	$cmd->execute();
	return;
}

public function pesquisarUsuarioLogin($ema, $sen) 
{
	$res = array();  // para caso não venha nada do banco a variavel ser um array vazio e não dar erro
	$cmd = $this->pdo->prepare("SELECT * FROM bibliotecarios WHERE campo_usu = :e");
	$cmd->bindValue(":e",$ema);
	// $cmd->bindValue(":s",$sen);
	$cmd->execute();
	
	if ($cmd->errorCode() != '00000')  // verificar erro de conexão
	{
        $error = $cmd->errorInfo();
        echo 'Erro na consulta SQL: ' . $error[2];  // Exibe o erro se houver
    }
	
	if ($cmd->rowCount() == 1) 
	{
	
        $dados = $cmd->fetch(PDO::FETCH_ASSOC);
        if (password_verify($sen, $dados['SENHA'])) 
		{
            return true;
        }
		else
		{
			return false;
		}
	}
	/*
	//outra forma:
	$dados = $cmd->fetch(PDO::FETCH_ASSOC); // retorna vazio se não encontrar
	if ($dados && password_verify($sen, $dados['CAMPO_SENHA'])) 
	{
		return true;
	} 
	else 
	{
		return false;
	}*/ 
 
}
public function pesquisar_Para_Alterar_Usuario($email_usu) 
{
	$cmd = $this->pdo->prepare("SELECT * FROM bibliotecarios WHERE campo_usu = :e");
	$cmd->bindValue(":e",$email_usu);
	$cmd->execute();
	$res = $cmd->fetch(PDO::FETCH_ASSOC);
	return $res;
}
}