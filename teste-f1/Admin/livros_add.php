<?php
session_start();
include '../includes/conexao.php';
include '../includes/auth.php';
verificarAdmin();

$erro = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = trim($_POST['titulo']);
    $autor = trim($_POST['autor']);
    $genero = trim($_POST['genero']);
    $ano = $_POST['ano'];
    $quantidade = $_POST['quantidade'];
    $cor = $_POST['cor'];

    if ($titulo === '' || $autor === '' || $genero === '') {
        $erro = "Preencha todos os campos obrigatórios!";
    } else {
        $stmt = $pdo->prepare("INSERT INTO LIVROS (titulo, autor, genero, ano_publicacao, quantidade, cor)
                               VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([$titulo, $autor, $genero, $ano, $quantidade, $cor]);

        header("Location: livros.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Adicionar Livro</title>
    <link rel="stylesheet" href="../assets/css/estilo.css">
</head>
<body>

<div class="container">
    <h1>Adicionar Livro</h1>

    <?php if($erro): ?>
        <div class="alert alert-erro"><?= $erro ?></div>
    <?php endif; ?>

    <form method="POST">

        <label>Título:</label>
        <input type="text" name="titulo" required>

        <label>Autor:</label>
        <input type="text" name="autor" required>

        <label>Gênero:</label>
        <input type="text" name="genero" required>

        <label>Ano Publicação:</label>
        <input type="number" name="ano">

        <label>Quantidade:</label>
        <input type="number" name="quantidade" value="1">

        <label>Cor (para identificar no CSS):</label>
        <input type="color" name="cor" value="#000000">

        <button type="submit" class="btn btn-primary">Salvar</button>
    </form>
</div>

</body>
</html>
