<?php
$codigo_livro = $_POST['codigo_livro'] ?? '';
$nome = $_POST['name'] ?? '';
$autor = $_POST['autor'] ?? '';
$idioma = $_POST['idioma'] ?? '';
$descricao = $_POST['descricao'] ?? ''; 
$unidade = $_POST['unidade'] ?? '';      

$imagemNome = null;

if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] == 0) {
    $imagemTmp = $_FILES['imagem']['tmp_name'];
    $extensao = strtolower(pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION));

    if (!in_array($extensao, ['jpg', 'jpeg', 'png', 'gif'])) {
        header('Location: editar_usuario_f.php?log=erro6');
        exit();
    }

    $uploadDir = "../uploads/";
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true); 
    }

    $imagemNome = uniqid('img_') . '.' . $extensao;
    $destino = $uploadDir . $imagemNome;

    if (move_uploaded_file($imagemTmp, $destino)) {
        echo "Imagem enviada com sucesso!<br>";
        echo "<img src='$destino' width='150'><br>";
    } else {
        die("Erro ao mover a imagem para o destino.");
    }
} else {
    die("Erro: Nenhuma imagem enviada ou erro no upload.");
}

echo "Código do Livro: $codigo_livro <br>";
echo "Nome: $nome <br/>";
echo "Autor: $autor <br/>";
echo "Idioma: $idioma <br/>";
echo "Unidade: $unidade <br/>";
echo "Descrição: $descricao <br/>";

try {
    $pdo = new PDO('mysql:host=localhost;dbname=lumedigital;charset=utf8', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "INSERT INTO livros (codigo_livro, nome, autor, unidade, idioma, descricao, imagem)
            VALUES (:codigo_livro, :nome, :autor, :unidade, :idioma, :descricao, :imagem)";
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':codigo_livro' => $codigo_livro,
        ':nome' => $nome,
        ':autor' => $autor,
        ':unidade' => $unidade,
        ':idioma' => $idioma,
        ':descricao' => $descricao,
        ':imagem' => $imagemNome,
    ]);

    echo "Livro cadastrado com sucesso!";
} catch (PDOException $e) {
    echo "Erro ao cadastrar o livro: " . $e->getMessage();
}
?>
