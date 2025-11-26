<?php
session_start();
include 'includes/conexao.php';
include 'includes/auth.php';
verificarAdmin();

if (!isset($_GET['id'])) {
    http_response_code(400);
    echo json_encode(['error' => 'ID do autor não fornecido']);
    exit;
}

$id_autor = $_GET['id'];

try {
    $stmt = $pdo->prepare("SELECT * FROM AUTORES WHERE id_autor = ?");
    $stmt->execute([$id_autor]);
    $autor = $stmt->fetch();
    
    if (!$autor) {
        http_response_code(404);
        echo json_encode(['error' => 'Autor não encontrado']);
        exit;
    }
    
    header('Content-Type: application/json');
    echo json_encode($autor);
    
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Erro ao buscar autor: ' . $e->getMessage()]);
}