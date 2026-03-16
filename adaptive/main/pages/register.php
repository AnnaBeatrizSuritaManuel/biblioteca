<?php
$page_title = 'Cadastro';
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../config/auth.php';

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';
    $phone = $_POST['phone'] ?? '';

    if (strlen($password) < 6) {
        $error = 'Senha deve ter no mínimo 6 caracteres!';
    } elseif ($password !== $confirm_password) {
        $error = 'Senhas não conferem!';
    } else {
        $result = register($name, $email, $password, $phone);
        if ($result['success']) {
            $success = 'Cadastro realizado com sucesso! Faça login agora.';
            // Redirecionar após 2 segundos
            header('Refresh: 2; url=login.php');
        } else {
            $error = $result['message'];
        }
    }
}

if (isLoggedIn()) {
    header('Location: profile.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro - FitZone</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
        .auth-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #0F1419 0%, #001A4D 100%);
            padding: 2rem;
            animation: fadeIn 0.6s ease-in;
        }

        .auth-form {
            background: rgba(0, 212, 255, 0.05);
            border: 2px solid rgba(0, 212, 255, 0.2);
            border-radius: 1rem;
            padding: 2.5rem;
            width: 100%;
            max-width: 450px;
            backdrop-filter: blur(10px);
            animation: slideUp 0.6s ease-out;
        }

        .auth-form h2 {
            color: var(--accent-bright);
            margin-bottom: 0.5rem;
            font-size: 1.8rem;
        }

        .auth-form p {
            color: var(--gray);
            margin-bottom: 2rem;
            font-size: 0.9rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            color: var(--ice);
            margin-bottom: 0.5rem;
            font-weight: 500;
        }

        .form-group input {
            width: 100%;
            padding: 1rem;
            border: 2px solid rgba(0, 212, 255, 0.2);
            border-radius: 0.5rem;
            background: rgba(0, 0, 0, 0.3);
            color: var(--ice);
            font-family: var(--font-inter);
            transition: var(--transition);
            box-sizing: border-box;
        }

        .form-group input:focus {
            outline: none;
            border-color: var(--accent-bright);
            box-shadow: 0 0 1rem rgba(0, 212, 255, 0.3);
        }

        .form-group input::placeholder {
            color: rgba(232, 247, 255, 0.5);
        }

        .btn-submit {
            width: 100%;
            padding: 1rem;
            background: linear-gradient(135deg, #00D4FF 0%, #00FFFF 100%);
            color: #0F1419;
            border: none;
            border-radius: 0.5rem;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            margin-top: 1rem;
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(0, 212, 255, 0.4);
        }

        .auth-link {
            text-align: center;
            margin-top: 1.5rem;
            color: var(--gray);
        }

        .auth-link a {
            color: var(--accent-bright);
            text-decoration: none;
            font-weight: 600;
            transition: var(--transition);
        }

        .auth-link a:hover {
            color: var(--accent);
        }

        .alert {
            padding: 1rem;
            border-radius: 0.5rem;
            margin-bottom: 1.5rem;
            animation: slideDown 0.4s ease-out;
        }

        .alert-error {
            background: rgba(255, 0, 0, 0.1);
            border: 1px solid rgba(255, 0, 0, 0.3);
            color: #ff6b6b;
        }

        .alert-success {
            background: rgba(0, 255, 0, 0.1);
            border: 1px solid rgba(0, 255, 0, 0.3);
            color: #51cf66;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>
    <div class="auth-container">
        <div class="auth-form">
            <h2><i class="fas fa-user-plus"></i> Cadastro</h2>
            <p>Junte-se à comunidade FitZone</p>

            <?php if ($error): ?>
                <div class="alert alert-error">
                    <i class="fas fa-exclamation-circle"></i> <?php echo $error; ?>
                </div>
            <?php endif; ?>

            <?php if ($success): ?>
                <div class="alert alert-success">
                    <i class="fas fa-check-circle"></i> <?php echo $success; ?>
                </div>
            <?php endif; ?>

            <form method="POST">
                <div class="form-group">
                    <label for="name">Nome Completo</label>
                    <input type="text" id="name" name="name" placeholder="Seu nome" required>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="seu@email.com" required>
                </div>

                <div class="form-group">
                    <label for="phone">Telefone (Opcional)</label>
                    <input type="tel" id="phone" name="phone" placeholder="(11) 99999-9999">
                </div>

                <div class="form-group">
                    <label for="password">Senha</label>
                    <input type="password" id="password" name="password" placeholder="Mínimo 6 caracteres" required>
                </div>

                <div class="form-group">
                    <label for="confirm_password">Confirmar Senha</label>
                    <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirme sua senha" required>
                </div>

                <button type="submit" class="btn-submit">
                    <i class="fas fa-user-check"></i> Cadastrar
                </button>
            </form>

            <div class="auth-link">
                Já tem conta? <a href="login.php">Faça login aqui</a>
            </div>

            <div class="auth-link" style="margin-top: 1rem; font-size: 0.85rem;">
                <a href="../index.php">← Voltar para Home</a>
            </div>
        </div>
    </div>
</body>
</html>
