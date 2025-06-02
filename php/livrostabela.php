<?php
$host = 'localhost';
$dbname = 'lumedigital';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro na conexão: " . $e->getMessage());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['salvar'])) {
    $id = $_POST['id'];
    $codigo_livro = $_POST['codigo_livro'];
    $nome = $_POST['nome'];
    $autor = $_POST['autor'];
    $idioma = $_POST['idioma'];
    $unidade = $_POST['unidade'];
    $descricao = $_POST['descricao'];
    $imagem = $_POST['imagem'];

    $sql = "UPDATE livros SET codigo_livro = :codigo_livro, nome = :nome, autor = :autor, idioma = :idioma, unidade = :unidade, descricao = :descricao, imagem = :imagem WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':codigo_livro' => $codigo_livro,
        ':nome' => $nome,
        ':autor' => $autor,
        ':idioma' => $idioma,
        ':unidade' => $unidade,
        ':descricao' => $descricao,
        ':imagem' => $imagem,
        ':id' => $id
    ]);
    header("Location: livros.php");
    exit;
}
if (isset($_GET['excluir'])) {
    $id = $_GET['excluir'];
    $stmt = $pdo->prepare("DELETE FROM livros WHERE id = :id");
    $stmt->execute([':id' => $id]);
    header("Location: livros.php");
    exit;
}
$stmt = $pdo->prepare("SELECT * FROM livros");
$stmt->execute();
$livros = $stmt->fetchAll(PDO::FETCH_ASSOC);

$editando = null;
if (isset($_GET['editar'])) {
    $id = $_GET['editar'];
    $stmt = $pdo->prepare("SELECT * FROM livros WHERE id = :id");
    $stmt->execute([':id' => $id]);
    $editando = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <title>Gerenciar Livros</title>
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
            width: 1000px;
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
        <caption>Lista de Livros</caption>
        <thead>
        <tr>
            <th>ID</th>
            <th>Código do Livro</th>
            <th>Nome</th>
            <th>Autor</th>
            <th>Idioma</th>
            <th>Unidade</th>
            <th>Descrição</th>
            <th>Imagem</th>
            <th>Ações</th>
        </tr>
        </thead>
        <tbody>
        <?php if (count($livros) > 0): ?>
            <?php foreach ($livros as $livro): ?>
                <tr>
                    <td><?= $livro['id'] ?></td>
                    <td><?= htmlspecialchars($livro['codigo_livro']) ?></td>
                    <td><?= htmlspecialchars($livro['nome']) ?></td>
                    <td><?= htmlspecialchars($livro['autor']) ?></td>
                    <td><?= htmlspecialchars($livro['idioma']) ?></td>
                    <td><?= htmlspecialchars($livro['unidade']) ?></td>
                    <td><?= htmlspecialchars($livro['descricao']) ?></td>
                    <td><?= htmlspecialchars($livro['imagem']) ?></td>
                    <td>
                        <a href="livros.php?editar=<?= $livro['id'] ?>">Editar</a> |
                        <a href="livros.php?excluir=<?= $livro['id'] ?>" onclick="return confirm('Tem certeza que deseja excluir este livro?')">Excluir</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="9">Nenhum livro encontrado.</td></tr>
        <?php endif; ?>
        </tbody>
    </table>
    <div style="margin-top: 20px; text-align: right;">
        <a href="form_livro.php">
            <button>Adicionar Novos Livros</button>
        </a>
    </div>

    <?php if ($editando): ?>
        <h3>Editar Livro (ID <?= $editando['id'] ?>)</h3>
        <form method="post" action="livros.php">
            <input type="hidden" name="id" value="<?= $editando['id'] ?>" />
            <label>Código do Livro:</label><br />
            <input type="text" name="codigo_livro" value="<?= htmlspecialchars($editando['codigo_livro']) ?>" required /><br />

            <label>Nome:</label><br />
            <input type="text" name="nome" value="<?= htmlspecialchars($editando['nome']) ?>" required /><br />

            <label>Autor:</label><br />
            <input type="text" name="autor" value="<?= htmlspecialchars($editando['autor']) ?>" required /><br />

            <label>Idioma:</label><br />
            <input type="text" name="idioma" value="<?= htmlspecialchars($editando['idioma']) ?>" required /><br />

            <label>Unidade:</label><br />
            <input type="text" name="unidade" value="<?= htmlspecialchars($editando['unidade']) ?>" required /><br />

            <label>Descrição:</label><br />
            <input type="text" name="descricao" value="<?= htmlspecialchars($editando['descricao']) ?>" required /><br />

            <label>Imagem:</label><br />
            <input type="text" name="imagem" value="<?= htmlspecialchars($editando['imagem']) ?>" required /><br />

            <button type="submit" name="salvar">Salvar Alterações</button>
        </form>
    <?php endif; ?>
</div>
</body>
</html>