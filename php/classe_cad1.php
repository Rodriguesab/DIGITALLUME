<?php
$name = $_POST['name'];
$email = $_POST['email'];
$date_birth = $_POST['birth'];
$cpf = $_POST['cpf'];
$s_phone = $_POST['phone'];
$senha = $_POST['senha'];



try {
    // Conexão com o banco usando PDO
    $pdo = new PDO("mysql:host=localhost;dbname=lumedigital", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "INSERT INTO alunos (nome, email, data_nascimento, cpf, telefone, senha) 
            VALUES (:nome, :email, :data_nascimento, :cpf, :telefone, :senha)";

    // Prepara a query
    $stmt = $pdo->prepare($sql);

    // Associa os parâmetros
    $stmt->bindParam(':nome', $name);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':data_nascimento', $date_birth);
    $stmt->bindParam(':cpf', $cpf);
    $stmt->bindParam(':telefone', $s_phone);
    $stmt->bindParam(':senha', $senha);

    // Executa a query
    if ($stmt->execute()) {
        echo "REGISTRO INCLUÍDO COM SUCESSO. <br />";
    } else {
        echo "Erro ao inserir registro.";
    }

} catch (PDOException $e) {
    echo "Erro na conexão ou na inserção: " . $e->getMessage();
}

// Fecha a conexão (opcional, pois é automática ao fim do script)
$pdo = null;
?>

