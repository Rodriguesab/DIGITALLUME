
<!DOCTYPE html>
<html>

<head>

<title>controle_cadastro</title>
<meta charset="utf-8">

</head>

<body>



<?php


if(!isset($_POST['cad_email'])) 
{ 
  HEADER('Location:../html/cad1.html');
} 

$v0 = $_POST['cad_nome'];
$v1 = $_POST['cad_email'];
$v2 = $_POST['cad_data'];
$v3 = $_POST['cad_cpf'];
$v4 = $_POST['cad_tel'];
$v5 = trim($_POST['cad_senha']);
// $senhaHash = password_hash($v5, PASSWORD_DEFAULT);

if(!empty($v0) || !empty($v3) || !empty($v4) || !empty($v5))
{
	require '../php/classe.php'; // para executar a classe
	$u = new Usuario("alunos","localhost","root","");  // instanciando

	// agora acessar a função de cadastrar (método cadastrarPessoa)
	if(!$u->cadastrarUsuario($v0, $v1, $v2, $v3, $v4, $v5))
	// ou if($p->cadastrarPessoa($v0, $v1, $v2, $v3, $v4, $v5)) == false
	// se após tentar fazer o cadastro, o retorno for false:
	{
		HEADER('Location:../html/cad1.php?ja_cadastrado'); // devolve com a mensagem ja cadastrado
		exit;
	}
	else
	{
		HEADER('Location:../html/leitor.html?sucesso');
		exit;
	}
}
else
{
	HEADER('Location:../html/cad1.html?branco=branc'); // devolve com campos em branco
	exit;
}
?>

