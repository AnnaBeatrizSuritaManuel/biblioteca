<?php
session_start();
include 'includes/conexao.php';

$erro = '';

$codigo_admin = 'admin123';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $senha = $_POST['senha'] ?? '';
    $codigo = trim($_POST['codigo'] ?? '');
    
    if (empty($email) || empty($senha) || empty($codigo)) {
        $erro = "Preencha todos os campos!";
    } elseif ($codigo !== $codigo_admin) {
        $erro = "Código de administrador incorreto!";
    } else {
        // Buscar usuário no banco
        $stmt = $pdo->prepare("SELECT * FROM USUARIO WHERE email = ? AND tipo = 'admin'");
        $stmt->execute([$email]);
        $usuario = $stmt->fetch();
        
        if ($usuario && password_verify($senha, $usuario['senha'])) {
            // Login bem-sucedido
            $_SESSION['usuario_id'] = $usuario['id_usuario'];
            $_SESSION['usuario_nome'] = $usuario['nome'];
            $_SESSION['usuario_email'] = $usuario['email'];
            $_SESSION['usuario_tipo'] = $usuario['tipo'];
            
            header("Location: admin/dashboard.php");
            exit;
        } else {
            $erro = "Credenciais de administrador incorretas!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Área Administrativa - Bibliotec</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/estilo.css">
    <style>
        .admin-login-container {
            max-width: 400px;
            margin: 100px auto;
            padding: 0 20px;
        }

        .admin-card {
            background: var(--surface);
            padding: 2.5rem;
            border-radius: 12px;
            box-shadow: 0 8px 32px rgba(0,0,0,0.1);
            border: 2px solid var(--primary-main);
            position: relative;
        }

        .admin-card::before {
            content: '🔒';
            position: absolute;
            top: -20px;
            left: 50%;
            transform: translateX(-50%);
            background: var(--primary-main);
            color: white;
            padding: 10px;
            border-radius: 50%;
            font-size: 1.5rem;
        }

        .admin-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .admin-title {
            font-size: 1.5rem;
            color: var(--primary-dark);
            margin-bottom: 0.5rem;
        }

        .admin-subtitle {
            color: var(--text-secondary);
            font-size: 0.9rem;
        }

        .security-notice {
            background: var(--background);
            border-left: 4px solid var(--warning);
            padding: 1rem;
            border-radius: 4px;
            margin-bottom: 1.5rem;
            font-size: 0.85rem;
        }

        .security-notice i {
            color: var(--warning);
            margin-right: 0.5rem;
        }
    </style>
</head>
<body>
    <div class="app-container">
        <header class="navbar">
            <div class="nav-container">
                <a href="index.php" class="logo">
                    <span class="logo-icon">📚</span>
                    Bibliotec
                </a>
                
                <nav class="nav-links">
                    <a href="index.php">Início</a>
                    <a href="categorias.php">Categorias</a>
                    <a href="sobre.php">Sobre</a>
                    <a href="login.php" class="btn btn-secondary">Entrar</a>
                </nav>
                
                <button class="btn btn-ghost mobile-menu-btn">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
        </header>

        <main>
            <div class="container">
                <div class="admin-login-container">
                    <div class="admin-card">
                        <div class="admin-header">
                            <h2 class="admin-title">Área Administrativa</h2>
                            <p class="admin-subtitle">Acesso restrito a administradores</p>
                        </div>

                        <?php if($erro): ?>
                            <div class="alert alert-erro"><?= $erro ?></div>
                        <?php endif; ?>

                        <div class="security-notice">
                            <i class="fas fa-shield-alt"></i>
                            <strong>Acesso Restrito:</strong> Esta área é exclusiva para administradores do sistema.
                        </div>

                        <form method="POST" id="adminLoginForm">
                            <div class="form-group">
                                <label for="email" class="form-label">E-mail Administrativo</label>
                                <input type="email" id="email" name="email" class="form-control" 
                                       placeholder="admin@biblioteca.com" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" required>
                            </div>

                            <div class="form-group">
                                <label for="senha" class="form-label">Senha</label>
                                <input type="password" id="senha" name="senha" class="form-control" 
                                       placeholder="Sua senha" required>
                            </div>

                            <div class="form-group">
                                <label for="codigo" class="form-label">Código de Administrador</label>
                                <input type="password" id="codigo" name="codigo" class="form-control" 
                                       placeholder="Código secreto" required>
                                <small class="text-muted">Código fornecido apenas para administradores autorizados</small>
                            </div>

                            <button type="submit" class="btn btn-primary" style="width: 100%;">
                                <i class="fas fa-sign-in-alt"></i>
                                Acessar Painel
                            </button>
                        </form>

                        <div style="text-align: center; margin-top: 1.5rem;">
                            <p style="color: var(--text-secondary); font-size: 0.9rem;">
                                <a href="login.php" style="color: var(--primary-main);">
                                    <i class="fas fa-arrow-left"></i>
                                    Voltar ao login normal
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <footer class="footer">
            <div class="container">
                <div class="footer-bottom">
                    <p>&copy; 2025 Bibliotec. Todos os direitos reservados.</p>
                </div>
            </div>
        </footer>
    </div>

    <script>
        document.querySelector('.mobile-menu-btn').addEventListener('click', function() {
            const navLinks = document.querySelector('.nav-links');
            navLinks.style.display = navLinks.style.display === 'flex' ? 'none' : 'flex';
        });

        // Validação do formulário
        document.getElementById('adminLoginForm').addEventListener('submit', function(e) {
            const codigo = document.getElementById('codigo').value;
            if (codigo.length < 3) {
                e.preventDefault();
                alert('Por favor, insira um código válido.');
                return false;
            }
        });
    </script>
</body>
</html>