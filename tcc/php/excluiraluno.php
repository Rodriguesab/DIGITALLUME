
<?php
$host = 'localhost';
$dbname = 'lumedigital';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        $stmt = $pdo->prepare("DELETE FROM alunos WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            header("Location: tabelaleitores.php"); // Altere para a página onde está a tabela
            exit;
        } else {
            echo "Erro ao excluir aluno.";
        }
    } else {
        echo "ID não fornecido.";
    }
} catch (PDOException $e) {
    echo "Erro: " . $e->getMessage();
}

$host = 'localhost';
$dbname = 'lumedigital';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        $stmt = $pdo->prepare("SELECT * FROM alunos WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $aluno = $stmt->fetch(PDO::FETCH_ASSOC);
    } else {
        die("ID não fornecido.");
    }
} catch (PDOException $e) {
    die("Erro: " . $e->getMessage());
}

$host = 'localhost';
$dbname = 'lumedigital';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        $stmt = $pdo->prepare("SELECT * FROM alunos WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $aluno = $stmt->fetch(PDO::FETCH_ASSOC);
    } else {
        die("ID não fornecido.");
    }
} catch (PDOException $e) {
    die("Erro: " . $e->getMessage());
}

// Atualização ao enviar o formulário
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['salvar'])) {
    try {
        $id = $_POST['id'];
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $cpf = $_POST['cpf'];
        $telefone = $_POST['telefone'];

        $stmt = $pdo->prepare("UPDATE alunos SET nome = :nome, email = :email, cpf = :cpf, telefone = :telefone WHERE id = :id");

        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':cpf', $cpf);
        $stmt->bindParam(':telefone', $telefone);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            header("Location: sua_pagina_principal.php"); // Volta para a tabela
            exit;
        } else {
            echo "Erro ao atualizar aluno.";
        }
    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage();
    }
}
?>
