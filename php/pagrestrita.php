<?php
$codigoCorreto = '123'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $codigoDigitado = $_POST['codigo'];

    if ($codigoDigitado === $codigoCorreto) {
        header("Location: cad2.html");
        exit;
    } else {
        echo "<script>alert('Código incorreto. Tente novamente.'); window.location.href='restrita.html';</script>";
        exit;
    }
} else {
    echo "Acesso inválido.";
    exit;
}
