<?php
// Verificar se usuário está logado
function verificarLogin() {
    if (!isset($_SESSION['usuario_id'])) {
        $_SESSION['erro'] = "Você precisa estar logado para acessar esta página.";
        header("Location: login.php");
        exit;
    }
}

function verificarAdmin() {
    verificarLogin();
    if ($_SESSION['usuario_tipo'] !== 'admin') {
        $_SESSION['erro'] = "Acesso restrito a administradores.";
        header("Location: index.php");
        exit;
    }
}

function verificarCredenciais($email, $senha) {
    global $pdo;
    
    try {
        $stmt = $pdo->prepare("SELECT * FROM USUARIO WHERE email = ?");
        $stmt->execute([$email]);
        $usuario = $stmt->fetch();
        
        if ($usuario && password_verify($senha, $usuario['senha'])) {
            return $usuario;
        }
        
        return false;
    } catch (PDOException $e) {
        error_log("Erro ao verificar credenciais: " . $e->getMessage());
        return false;
    }
}
?>