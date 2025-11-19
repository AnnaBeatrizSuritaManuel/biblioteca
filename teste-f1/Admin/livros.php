<?php
session_start();
include '../includes/conexao.php';
include '../includes/auth.php';
verificarAdmin();

$livros = $pdo->query("SELECT * FROM LIVROS ORDER BY titulo ASC")->fetchAll();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Gerenciar Livros - Admin</title>
    <link rel="stylesheet" href="../assets/css/estilo.css">
</head>
<body>

<?php include '../includes/header.php'; ?>

<div class="container">
    <h1>Gerenciar Livros</h1>

    <a href="livros_add.php" class="btn btn-primary">Adicionar Novo Livro</a>

    <table class="table">
        <thead>
            <tr>
                <th>Título</th>
                <th>Autor</th>
                <th>Gênero</th>
                <th>Ano</th>
                <th>Qtd</th>
                <th>Ações</th>
            </tr>
        </thead>

        <tbody>
        <?php foreach ($livros as $l): ?>
            <tr>
                <td><?= htmlspecialchars($l['titulo']) ?></td>
                <td><?= htmlspecialchars($l['autor']) ?></td>
                <td><?= htmlspecialchars($l['genero']) ?></td>
                <td><?= $l['ano_publicacao'] ?></td>
                <td><?= $l['quantidade'] ?></td>
                <td>
                    <a href="livros_edit.php?id=<?= $l['id_livro'] ?>" class="btn btn-warning">Editar</a>
                    <a href="livros_delete.php?id=<?= $l['id_livro'] ?>" class="btn btn-danger" onclick="return confirm('Você tem certeza?')">Excluir</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>

    </table>
</div>

<?php include '../includes/footer.php'; ?>

</body>
</html>
