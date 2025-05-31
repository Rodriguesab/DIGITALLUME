<?php
// Configuração do banco
$host = 'localhost';
$dbname = 'lumedigital';
$user = 'root';
$pass = '';

try {
    // Conexão PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro na conexão: " . $e->getMessage());
}

// Processa atualização (edição)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['salvar'])) {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $cpf = $_POST['cpf'];
    $telefone = $_POST['telefone'];

    $sql = "UPDATE alunos SET nome = :nome, email = :email, cpf = :cpf, telefone = :telefone WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':nome' => $nome,
        ':email' => $email,
        ':cpf' => $cpf,
        ':telefone' => $telefone,
        ':id' => $id
    ]);
    header("Location: alunos.php");
    exit;
}

// Processa exclusão
if (isset($_GET['excluir'])) {
    $id = $_GET['excluir'];
    $stmt = $pdo->prepare("DELETE FROM alunos WHERE id = :id");
    $stmt->execute([':id' => $id]);
    header("Location: alunos.php");
    exit;
}

// Consulta todos os alunos
$stmt = $pdo->prepare("SELECT * FROM alunos");
$stmt->execute();
$alunos = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Se estiver editando, pega os dados do aluno
$editando = null;
if (isset($_GET['editar'])) {
    $id = $_GET['editar'];
    $stmt = $pdo->prepare("SELECT * FROM alunos WHERE id = :id");
    $stmt->execute([':id' => $id]);
    $editando = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <title>Gerenciar Alunos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #dab3e9;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            padding: 30px;
            margin: 0;
        }
        .container {
            background: #ab97d1;
            padding: 20px;
            border-radius: 8px;
            width: 850px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background-color: white;
        }
        caption {
            font-size: 1.6em;
            margin-bottom: 10px;
            color: #4a2975;
        }
        th, td {
            padding: 8px;
            border: 1px solid #888;
            text-align: center;
        }
        th {
            background-color: #a879c7;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        a {
            color: #5a267a;
            text-decoration: none;
            font-weight: bold;
        }
        a:hover {
            color: #ca45c4;
        }
        form {
            margin-top: 20px;
            background: #e9d7f7;
            padding: 15px;
            border-radius: 6px;
        }
        input[type="text"], input[type="email"] {
            padding: 8px;
            margin: 5px 10px 15px 0;
            width: 220px;
            border: 1px solid #666;
            border-radius: 4px;
        }
        button {
            background-color: #a879c7;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 4px;
        }
        button:hover {
            background-color: #ca45c4;
        }
    </style>
</head>
<body>
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
        <tbody>
        <?php if (count($alunos) > 0): ?>
            <?php foreach ($alunos as $aluno): ?>
                <tr>
                    <td><?= $aluno['id'] ?></td>
                    <td><?= htmlspecialchars($aluno['nome']) ?></td>
                    <td><?= htmlspecialchars($aluno['email']) ?></td>
                    <td><?= htmlspecialchars($aluno['cpf']) ?></td>
                    <td><?= htmlspecialchars($aluno['telefone']) ?></td>
                    <td>
                        <a href="alunos.php?editar=<?= $aluno['id'] ?>">Editar</a> |
                        <a href="alunos.php?excluir=<?= $aluno['id'] ?>" onclick="return confirm('Tem certeza que deseja excluir este aluno?')">Excluir</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="6">Nenhum aluno encontrado.</td></tr>
        <?php endif; ?>
        </tbody>
    </table>

    <?php if ($editando): ?>
        <h3>Editar Aluno (ID <?= $editando['id'] ?>)</h3>
        <form method="post" action="alunos.php">
            <input type="hidden" name="id" value="<?= $editando['id'] ?>" />
            <label>Nome:</label><br />
            <input type="text" name="nome" value="<?= htmlspecialchars($editando['nome']) ?>" required /><br />

            <label>E-mail:</label><br />
            <input type="email" name="email" value="<?= htmlspecialchars($editando['email']) ?>" required /><br />

            <label>CPF:</label><br />
            <input type="text" name="cpf" value="<?= htmlspecialchars($editando['cpf']) ?>" required /><br />

            <label>Telefone:</label><br />
            <input type="text" name="telefone" value="<?= htmlspecialchars($editando['telefone']) ?>" required /><br />

            <button type="submit" name="salvar">Salvar Alterações</button>
        </form>
    <?php endif; ?>
</div>
</body>
</html>