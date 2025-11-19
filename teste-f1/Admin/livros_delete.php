<?php
session_start();
include '../includes/conexao.php';
include '../includes/auth.php';
verificarAdmin();

$id = $_GET['id'];

$stmt = $pdo->prepare("DELETE FROM LIVROS WHERE id_livro = ?");
$stmt->execute([$id]);

header("Location: livros.php");
exit;
?>
