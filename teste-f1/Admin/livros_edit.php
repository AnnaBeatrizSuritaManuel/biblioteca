<?php
session_start();
include '../includes/conexao.php';
include '../includes/auth.php';
verificarAdmin();

$id = $_GET['id'];
$livro = $pdo->prepare("SELECT * FROM LIVROS WHERE id_livro = ?");
$livro->execute([$id]);
$livro = $livro->fetch();

if (!$livro) {
    die("Livro não encontrado!");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $titulo = $_POST['titulo'];
    $autor = $_POST['autor'];
    $genero = $_POST['genero'];
    $ano = $_POST['ano'];
    $quantidade = $_POST['quantidade'];
    $cor = $_POST['cor'];

    $stmt = $pdo->prepare("UPDATE LIVROS SET titulo=?, autor=?, genero=?, ano_publicacao=?, quantidade=?, cor=? WHERE id_livro=?");
    $stmt->execute([$titulo, $autor, $genero, $ano, $quantidade, $cor, $id]);

    header("Location: livros.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Editar Livro</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../assets/css/estilo.css">
</head>
<body>

<div class="container">
    <h1>Editar Livro</h1>

    <form method="POST">
        <label>Título:</label>
        <input type="text" name="titulo" value="<?= $livro['titulo'] ?>" required>

        <label>Autor:</label>
        <input type="text" name="autor" value="<?= $livro['autor'] ?>" required>

        <label>Gênero:</label>
        <input type="text" name="genero" value="<?= $livro['genero'] ?>" required>

        <label>Ano Publicação:</label>
        <input type="number" name="ano" value="<?= $livro['ano_publicacao'] ?>">

        <label>Quantidade:</label>
        <input type="number" name="quantidade" value="<?= $livro['quantidade'] ?>">

        <label>Cor:</label>
        <input type="color" name="cor" value="<?= $livro['cor'] ?>">

        <button type="submit" class="btn btn-primary">Salvar</button>
    </form>
</div>

</body>
</html>
