<?php
session_start();
include 'includes/conexao.php';

$erro = '';
$sucesso = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = trim($_POST['nome'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $senha = $_POST['password'] ?? '';
    $telefone = trim($_POST['telefone'] ?? '');
    
    // Validar dados
    if (empty($nome) || empty($email) || empty($senha)) {
        $erro = "Preencha todos os campos obrigatórios!";
    } elseif (strlen($senha) < 6) {
        $erro = "A senha deve ter no mínimo 6 caracteres!";
    } else {
        try {
            // Verificar se email já existe
            $stmt = $pdo->prepare("SELECT id_usuario FROM USUARIO WHERE email = ?");
            $stmt->execute([$email]);
            
            if ($stmt->rowCount() > 0) {
                $erro = "Este email já está cadastrado!";
            } else {
                // Inserir novo usuário
                $senha_hash = password_hash($senha, PASSWORD_DEFAULT);
                
                $stmt = $pdo->prepare("INSERT INTO USUARIO (nome, email, senha, telefone, tipo) VALUES (?, ?, ?, ?, 'usuario')");
                $stmt->execute([$nome, $email, $senha_hash, $telefone]);
                
                $sucesso = "Cadastro realizado com sucesso!";
                
                // Redirecionar para login após 2 segundos
                header("refresh:2;url=login.php");
            }
        } catch(PDOException $e) {
            $erro = "Erro ao cadastrar: " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title> Bibliotec - Cadastro</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link rel="stylesheet" href="assets/css/estilo.css">
</head>

<body>
    <?php include 'includes/header.php'; ?>

    <main>
        <div class="container">
            <div class="card" style="max-width: 450px; margin: 2rem auto;">
                <div class="card-body">
                    <h1 class="text-center">Crie sua conta</h1>
                    <p class="text-center text-muted">Cadastre-se para começar a explorar</p>

                    <?php if($erro): ?>
                        <div class="alert alert-erro"><?= $erro ?></div>
                    <?php endif; ?>
                    
                    <?php if($sucesso): ?>
                        <div class="alert alert-sucesso"><?= $sucesso ?></div>
                    <?php endif; ?>

                    <form method="POST" id="cadForm">
                        <div class="form-group">
                            <label class="form-label">Nome completo *</label>
                            <input type="text" name="nome" class="form-control" value="<?= htmlspecialchars($_POST['nome'] ?? '') ?>" required>
                        </div>

                        <div class="form-group">
                            <label class="form-label">E-mail *</label>
                            <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" required>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Telefone</label>
                            <input type="tel" name="telefone" class="form-control" value="<?= htmlspecialchars($_POST['telefone'] ?? '') ?>">
                        </div>

                        <div class="form-group">
                            <label class="form-label">Senha *</label>
                            <input type="password" name="password" class="form-control" required>
                            <small class="text-muted">Mínimo 6 caracteres</small>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Confirmar senha *</label>
                            <input type="password" name="password2" class="form-control" required>
                        </div>

                        <button type="submit" class="btn btn-primary" style="width: 100%;">Cadastrar</button>

                        <p class="text-center mt-3">
                            Já tem conta? <a href="login.php">Entrar</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <?php include 'includes/footer.php'; ?>

    <script>
        const form = document.getElementById('cadForm');

        form.addEventListener('submit', (e) => {
            const pass = document.querySelector('input[name="password"]').value;
            const pass2 = document.querySelector('input[name="password2"]').value;

            if (pass.length < 6) {
                e.preventDefault();
                alert('A senha deve ter no mínimo 6 caracteres.');
                return;
            }

            if (pass !== pass2) {
                e.preventDefault();
                alert('As senhas não coincidem.');
                return;
            }
        });
    </script>
</body>
</html>