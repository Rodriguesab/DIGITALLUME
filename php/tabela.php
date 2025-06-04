<?php
require_once 'classe_tabacervo.php'; // para executar a classe
$p = new tabacervo ("crudpdo","localhost","root","");  // instanciando
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="utf-8">
<title>tabela de acervo crud-pdo</title>
</head>
<body>

<?php
// 5. do roteiro:
if(isset($_POST['nome'])) // se a pessoa clicou em cadastrar ou editar
{
	// --------- abaixo, acréscimo do 10 do roteiro: --------
	if(isset($_GET['id_up']) && !empty($_GET['id_up'])) // se existe e não está vazia
	{
		$id_upd = addslashes($_GET['id_up']);
		$nome = addslashes($_POST['nome']);
		$cpf = addslashes($_POST['cpf']);
		$email = addslashes($_POST['email']);
        $telefone = addslashes($_POST['telefone']);
		if(!empty($nome) && !empty($telefone) && !empty($email))
		{
			// agora acessar a função atualizarDados)
			$p->atualizarDados($id_upd, $nome, $cpf, $email,$telefone);
			HEADER("Location: tabela.php");
		}
		else
		{
			echo "Preencha todos os campos";
		}
	}
	else
	{
		// abaixo, copiado do cadastrar mais abaixo.
		$nome = addslashes($_POST['nome']);
		$cpf = addslashes($_POST['cpf']);
		$email = addslashes($_POST['email']);
        $telefone = addslashes($_POST['telefone']);
		if(!empty($nome) && !empty($cpf) && !empty($email) && !empty($telefone))
		{
			// agora acessar a função de cadastrar (método cadastrarPessoa)
			if(!$p->cadastrarPessoa($nome, $cpf, $email, $telefone)) 
			// se após tentar fazer o cadastro, o retorno for false:
			{
				echo "Email já cadastrado!";
			}
		
		}
		else
		{
			echo "Preencha todos os campos";
		}
	}
}
// aqui o número 9 do roteiro, segunda parte.
if(isset($_GET['id_up'])) // s  e a pessoa clicou no botão editar
	{
		$id_update = addslashes($_GET['id_up']);
		$res = $p->buscarDadosPessoa($id_update);
		// após aqui, modificar os values abaixo e no value do botão:
	}
		
?>
<div class="container">
    <table>
        <caption>Lista de Alunos</caption>
        <thead>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>E-mail</th>
            <th>CPF</th>
            <th>Telefone</th>
            <th>Ações</th>
         </tr>
        </thead>

    
    