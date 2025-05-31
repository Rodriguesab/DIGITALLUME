<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aluno</title>
</head>
<body>

  <?php
session_start();

$cpf = $_POST['cpf'] ?? '';
$senha = $_POST['senha'] ?? '';

try {
    $pdo = new PDO('mysql:host=localhost;dbname=lumedigital;charset=utf8', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Procura o CPF no banco
    $sql = "SELECT * FROM alunos WHERE cpf = :cpf";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':cpf', $cpf);
    $stmt->execute();

    $aluno = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($aluno && password_verify($senha, $aluno['senha'])) {
        $_SESSION['cpf'] = $cpf;
        $_SESSION['nome'] = $aluno['nome']; 
        header('Location: painel_aluno.php');
        exit();
    } else {
        echo "<script>alert('CPF ou senha inválidos!'); window.location.href='login.php';</script>";
    }

} catch (PDOException $e) {
    echo "Erro ao conectar ao banco: " . $e->getMessage();
}
?>



</body>
</html>