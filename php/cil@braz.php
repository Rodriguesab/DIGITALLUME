
<?php
session_start();
define('CEO_ACCESS_PASSWORD', 'C2p10');

if (!isset($_SESSION['ceo_ok'])) {
    $error = '';

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ceo_pass'])) {
        if ($_POST['ceo_pass'] === CEO_ACCESS_PASSWORD) {
            $_SESSION['ceo_ok'] = true;

            header("Location: ../html/cad2.html ");
            exit;
        } else {
            $error = "Senha do CEO incorreta.";
        }
    }
    ?>
    <!DOCTYPE html>
    <html lang="pt-BR">
    <head>
        <meta charset="UTF-8">
        <title>Acesso do CEO</title>
        <link rel="stylesheet" href="../css/restrita.css">
    </head>
    <body>

        <?php if (!empty($error)) : ?>
            <p style="color: red;"><?php echo htmlspecialchars($error); ?></p>
        <?php endif; ?>
        <div class="container">
        <h2>Página Restrita</h2>
        <p>Digite o código de acesso:</p>
        <form method="POST" >
            <label>Senha do CEO:
                <input type="password" name="ceo_pass" required>
            </label>
            <button type="submit">Entrar</button>
        </form>
        </div>
    </body>
    </html>
    <?php
    exit;
}
