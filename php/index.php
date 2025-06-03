<?php
require_once 'classe_pessoa.php'; // para executar a classe
$p = new crud("lumedigital","localhost","root","");  // instanciando
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="utf-8">
<title>PROJETO CRUD_PDO</title>


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
		$telefone = addslashes($_POST['telefone']);
		$email = addslashes($_POST['email']);
		if(!empty($nome) && !empty($telefone) && !empty($email))
		{
			// agora acessar a função atualizarDados)
			$p->atualizarDados($id_upd, $nome, $telefone, $email);
			HEADER("Location: index.php");
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
		$telefone = addslashes($_POST['telefone']);
		$email = addslashes($_POST['email']);
		if(!empty($nome) && !empty($telefone) && !empty($email))
		{
			// agora acessar a função de cadastrar (método cadastrarPessoa)
			if(!$p->cadastrarPessoa($nome, $telefone, $email)) 
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
if(isset($_GET['id_up'])) // se a pessoa clicou no botão editar
	{
		$id_update = addslashes($_GET['id_up']);
		$res = $p->buscarDadosPessoa($id_update);
		// após aqui, modificar os values abaixo e no value do botão:
	}
		
?>
 
<section id="um">
 <h2>CADASTRAR PESSOA</h2>
 <form method="post" action="">
 <table border="1">
	<tr>
	<td><label for="nome"> Nome: </label>
	<input type="text" id="nome" name="nome" size="40" maxlenght="40"
	value="<?php if(isset($res)){echo $res['nome'];}?>">
	</td>
	<td><label for="telefone"> Telefone: </label>
	<input type="text" id="telefone" name="telefone" size="15" maxlenght="15" 
	value="<?php if(isset($res)){echo $res['telefone'];}?>">
	</td>
	<td><label for="email"> Email: </label>
	<input type="email" id="email" name="email" size="50" maxlenght="50" 
	value="<?php if(isset($res)){echo $res['email'];}?>">
	</td>
    <td>
	<input type="submit" value="<?php if(isset($res)){echo 'Atualizar';}else{echo 'Cadastrar';}?>"> 
	</td>
    </form>
 	</TR>
	</TABLE>
</section>

<br/>
<br/>
<HR>
<br/>
<br/>
<section id="dois">
   <h1>VISUALIZAR / ALTERAR / EXCLUIR</h1> 
   <h2>
   <TABLE border=1>
   <TR>
    <TD>Nome</TD>
    <TD>Telefone</TD>
    <TD colspan="3">Email</TD>


   </TR>
<?php
  $dados = $p->buscarDados(); // chamando o método de classe_pessoa. E uma variavel para receber.
  if(count($dados) > 0) // testar se o array não está vazio
  {
	  for($i=0;$i < count($dados); $i++)
	  {
		  echo "<tr>";
		  foreach ($dados[$i] as $k => $v)
		  {
			  if($k != "id") // para pular o id, pois não o exibiremos
			  {
				  echo "<td>".$v."</td>";
			  }
		  }
		  ?>
		  <td><a href="index.php?id_up=<?php echo $linha[$i]['id'];?>">Editar</td><td>
		  <a href="index.php?id_del=<?php echo $linha[$i]['id'];?>">Excluir</td> 
		  <!-- recebendo o id da pessoa, acima -->
	      <?php
		  echo "</tr>";
	  }
  }
  else
  {
	  echo "Ainda não há pessoas cadastradas";
  }
  
?>
   <tr>
</TABLE></h2>
</section>

<?php
	if(isset($_GET['id_del']))
	{
		$id_pessoa = addslashes($_GET['id_del']);
		$p->excluirPessoa($id_crud); // o objeto p aciona o método excluirPessoa, passando o parâmetro id referente a pessoa da linha.
		header("Location: index.php"); // para atualizar a página
	}
?>
</body>
</html>