<?php
class Livro
{
    private $pdo;

    public function __construct()
    {
        $dbname = 'lumedigital';
        $host = 'localhost';       



        $user = 'seu_usuario';     
        $senha = '';      

        try {
            $this->pdo = new PDO("mysql:dbname=$dbname;host=$host", $user, $senha);
        } catch (PDOException $e) {
            echo "Erro com banco de dados: " . $e->getMessage();
            exit();
        } catch (Exception $e) {
            echo "Erro genérico: " . $e->getMessage();
        }
    }

    // Método para cadastrar livro
    public function cadastrarLivro($codigo, $nome, $autor, $unidade, $idioma, $descricao, $imagem)
    {
        $stmt = $this->pdo->prepare("INSERT INTO livros (codigo, nome, autor, unidade, idioma, descricao, imagem) 
            VALUES (:codigo, :nome, :autor, :unidade, :idioma, :descricao, :imagem)");

        $stmt->bindValue(":codigo", $codigo);
        $stmt->bindValue(":nome", $nome);
        $stmt->bindValue(":autor", $autor);
        $stmt->bindValue(":unidade", $unidade);
        $stmt->bindValue(":idioma", $idioma);
        $stmt->bindValue(":descricao", $descricao);
        $stmt->bindValue(":imagem", $imagem);
        $stmt->execute();

        return true;
    }

    // Método para buscar capa do livro
    public function buscaCapa($imagem)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM livros WHERE imagem = :imagem");
        $stmt->bindValue(":imagem", $imagem);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            return false;
        }
    }

    // Método para atualizar dados do livro
    public function atualizarLivro($codigo, $nome, $autor, $unidade, $idioma, $descricao, $imagem)
    {
        $stmt = $this->pdo->prepare("UPDATE livros SET nome = :nome, autor = :autor, unidade = :unidade, idioma = :idioma, descricao = :descricao, imagem = :imagem WHERE codigo = :codigo");

        $stmt->bindValue(":codigo", $codigo);
        $stmt->bindValue(":nome", $nome);
        $stmt->bindValue(":autor", $autor);
        $stmt->bindValue(":unidade", $unidade);
        $stmt->bindValue(":idioma", $idioma);
        $stmt->bindValue(":descricao", $descricao);
        $stmt->bindValue(":imagem", $imagem);
        $stmt->execute();

        return true;
    }

    // Método para excluir a imagem do livro
    public function excluiFoto($codigo)
    {
        $cmd = $this->pdo->prepare("UPDATE livros SET imagem = '' WHERE codigo = :codigo");
        $cmd->bindValue(":codigo", $codigo);
        $cmd->execute();
    }
}
?>
