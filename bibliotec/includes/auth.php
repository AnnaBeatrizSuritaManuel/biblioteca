<?php
// Verificar se usuário está logado
function verificarLogin() {
    if (!isset($_SESSION['usuario_id'])) {
        header("Location: ../login.php");
        exit;
    }
}

function verificarAdmin() {
    verificarLogin();
    if ($_SESSION['usuario_tipo'] !== 'admin') {
        header("Location: ../index.php");
        exit;
    }
}

function verificarCredenciais($email, $senha) {
    global $pdo;
    
    $stmt = $pdo->prepare("SELECT * FROM USUARIO WHERE email = ?");
    $stmt->execute([$email]);
    $usuario = $stmt->fetch();
    
    if ($usuario && password_verify($senha, $usuario['senha'])) {
        return $usuario;
    }
    
    return false;
}
?>