<?php
session_start();
include 'includes/conexao.php';

$erro = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $senha = $_POST['password'] ?? '';
    
    if (empty($email) || empty($senha)) {
        $erro = "Preencha todos os campos!";
    } else {
        // Buscar usuário no banco
        $stmt = $pdo->prepare("SELECT * FROM USUARIO WHERE email = ?");
        $stmt->execute([$email]);
        $usuario = $stmt->fetch();
        
        if ($usuario && password_verify($senha, $usuario['senha'])) {
            // Login bem-sucedido
            $_SESSION['usuario_id'] = $usuario['id_usuario'];
            $_SESSION['usuario_nome'] = $usuario['nome'];
            $_SESSION['usuario_email'] = $usuario['email'];
            $_SESSION['usuario_tipo'] = $usuario['tipo'];
            
            // Redirecionar baseado no tipo de usuário
            if ($usuario['tipo'] === 'admin') {
                header("Location: admin/dashboard.php");
            } else {
                header("Location: logado.php");
            }
            exit;
        } else {
            $erro = "Email ou senha incorretos!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> bibliotec - Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/estilo.css">
</head>

<body>
    <?php include 'includes/header.php'; ?>

    <main>
        <div class="container">
            <div class="login-container">
                <div class="login-card">
                    <div class="login-header">
                        <h2 class="login-title">Acesse sua conta</h2>
                        <p class="login-subtitle">Entre para explorar nossa biblioteca</p>
                    </div>

                    <?php if($erro): ?>
                        <div class="alert alert-erro"><?= $erro ?></div>
                    <?php endif; ?>

                    <form method="POST" id="loginForm">
                        <div class="form-group">
                            <label class="form-label">E-mail</label>
                            <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" required>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Senha</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>

                        <button type="submit" class="btn btn-primary" style="width: 100%;">
                            <i class="fas fa-sign-in-alt"></i> Entrar
                        </button>
                    </form>

                    <div class="text-center mt-3">
                        <p style="color: var(--text-secondary);">
                            Não tem uma conta?
                            <a href="cadastro.php" style="color: var(--primary-main);">Cadastre-se</a>
                        </p>

                        <p style="color: var(--text-secondary); margin-top: 0.5rem;">
                            <a href="loginadm.php" style="color: var(--primary-main); font-weight: 600;">
                                Entrar como administrador
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <?php include 'includes/footer.php'; ?>
</body>
</html>