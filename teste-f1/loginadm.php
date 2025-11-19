<?php
session_start();

// Código secreto fixo para o admin
$codigo_admin = "admin123"; 

$erro = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $codigo = trim($_POST['codigo'] ?? '');

    if (empty($codigo)) {
        $erro = "Digite o código de administrador!";
    } 
    elseif ($codigo !== $codigo_admin) {
        $erro = "Código incorreto!";
    } 
    else {
        // Login bem-sucedido como admin SEM precisar de e-mail ou senha
        $_SESSION['usuario_id'] = 0; 
        $_SESSION['usuario_nome'] = "Administrador";
        $_SESSION['usuario_email'] = "admin@bibliotec.com";
        $_SESSION['usuario_tipo'] = "admin";

        header("Location: admin/dashboard.php");
        exit;
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
    <link rel="stylesheet" href="assets/css/estilo.css">
</head>
<body>
    <div class="app-container">
        <main>
            <div class="container">
                <div style="max-width: 400px; margin: 100px auto;">
                    <div class="admin-card">

                        <h2 class="admin-title" style="text-align:center;">Área Administrativa</h2>
                        <p style="text-align:center;color:gray;">Acesso exclusivo</p>

                        <?php if ($erro): ?>
                            <div class="alert alert-erro"><?= $erro ?></div>
                        <?php endif; ?>

                        <form method="POST">
                            <div class="form-group">
                                <label class="form-label">Código de Administrador</label>
                                <input type="password" name="codigo" class="form-control"
                                       placeholder="Digite o código" required>
                            </div>

                            <button type="submit" class="btn btn-primary" style="width:100%;margin-top:10px;">
                                Entrar como Admin
                            </button>
                        </form>

                        <div style="text-align:center;margin-top:1.5rem;">
                            <a href="login.php" style="color: var(--primary-main);">
                                Voltar ao login normal
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
