<?php
$page_title = 'Meu Perfil';
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../config/auth.php';

if (!isLoggedIn()) {
    header('Location: login.php');
    exit;
}

$user_id = $_SESSION['user_id'];
$user = getUserData($user_id);
$message = '';
$error = '';

// Processar atualização de perfil
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_profile'])) {
    $name = $_POST['name'] ?? '';
    $phone = $_POST['phone'] ?? '';

    if (updateProfile($user_id, $name, $phone)) {
        $_SESSION['user_name'] = $name;
        $message = 'Perfil atualizado com sucesso!';
        $user = getUserData($user_id);
    } else {
        $error = 'Erro ao atualizar perfil';
    }
}

// Processar mudança de senha
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['change_password'])) {
    $old_password = $_POST['old_password'] ?? '';
    $new_password = $_POST['new_password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';

    if ($new_password !== $confirm_password) {
        $error = 'Senhas não conferem!';
    } elseif (strlen($new_password) < 6) {
        $error = 'Senha deve ter no mínimo 6 caracteres!';
    } else {
        $result = changePassword($user_id, $old_password, $new_password);
        if ($result['success']) {
            $message = $result['message'];
        } else {
            $error = $result['message'];
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title; ?> - FitZone</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
        .profile-container {
            min-height: calc(100vh - 80px);
            padding: 3rem 0;
            animation: fadeIn 0.6s ease-in;
        }

        .profile-header {
            background: rgba(0, 212, 255, 0.05);
            border: 2px solid rgba(0, 212, 255, 0.2);
            border-radius: 1rem;
            padding: 2rem;
            margin-bottom: 2rem;
            display: flex;
            align-items: center;
            gap: 2rem;
            animation: slideUp 0.6s ease-out;
        }

        .profile-avatar {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--accent) 0%, var(--accent-bright) 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3rem;
            color: var(--dark);
            flex-shrink: 0;
        }

        .profile-info h2 {
            color: var(--accent-bright);
            margin-bottom: 0.5rem;
        }

        .profile-info p {
            color: var(--gray);
            margin-bottom: 0.25rem;
        }

        .profile-content {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 2rem;
        }

        .profile-form {
            background: rgba(0, 212, 255, 0.05);
            border: 2px solid rgba(0, 212, 255, 0.2);
            border-radius: 1rem;
            padding: 2rem;
            animation: slideUp 0.6s ease-out;
        }

        .profile-form h3 {
            color: var(--accent-bright);
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
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
            padding: 0.75rem;
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

        .btn-submit {
            width: 100%;
            padding: 1rem;
            background: linear-gradient(135deg, var(--accent) 0%, var(--accent-bright) 100%);
            color: var(--dark);
            border: none;
            border-radius: 0.5rem;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(0, 212, 255, 0.4);
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

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: rgba(0, 212, 255, 0.05);
            border: 2px solid rgba(0, 212, 255, 0.1);
            border-radius: 0.75rem;
            padding: 1rem;
            text-align: center;
        }

        .stat-card h4 {
            color: var(--accent-bright);
            margin-bottom: 0.5rem;
        }

        .stat-card p {
            color: var(--gray);
            font-size: 0.9rem;
        }

        @media (max-width: 768px) {
            .profile-header {
                flex-direction: column;
                text-align: center;
            }

            .profile-content {
                grid-template-columns: 1fr;
            }

            .stats-grid {
                grid-template-columns: 1fr;
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
    <?php include '../includes/header.php'; ?>

    <div class="profile-container">
        <div class="container">
            <div class="profile-header">
                <div class="profile-avatar">
                    <i class="fas fa-user"></i>
                </div>
                <div class="profile-info">
                    <h2><?php echo htmlspecialchars($user['name']); ?></h2>
                    <p><i class="fas fa-envelope"></i> <?php echo htmlspecialchars($user['email']); ?></p>
                    <p><i class="fas fa-phone"></i> <?php echo htmlspecialchars($user['phone'] ?? 'Não informado'); ?></p>
                    <p><i class="fas fa-user-tag"></i> Membro desde <?php echo date('d/m/Y', strtotime($user['created_at'])); ?></p>
                </div>
            </div>

            <?php if ($message): ?>
                <div class="alert alert-success">
                    <i class="fas fa-check-circle"></i> <?php echo $message; ?>
                </div>
            <?php endif; ?>

            <?php if ($error): ?>
                <div class="alert alert-error">
                    <i class="fas fa-exclamation-circle"></i> <?php echo $error; ?>
                </div>
            <?php endif; ?>

            <div class="profile-content">
                <div class="profile-form">
                    <h3><i class="fas fa-edit"></i> Editar Perfil</h3>
                    <form method="POST">
                        <div class="form-group">
                            <label for="name">Nome Completo</label>
                            <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($user['name']); ?>" required>
                        </div>

                        <div class="form-group">
                            <label for="email">Email (Não editável)</label>
                            <input type="email" id="email" value="<?php echo htmlspecialchars($user['email']); ?>" disabled>
                        </div>

                        <div class="form-group">
                            <label for="phone">Telefone</label>
                            <input type="tel" id="phone" name="phone" value="<?php echo htmlspecialchars($user['phone'] ?? ''); ?>" placeholder="(11) 99999-9999">
                        </div>

                        <button type="submit" name="update_profile" class="btn-submit">
                            <i class="fas fa-save"></i> Salvar Alterações
                        </button>
                    </form>
                </div>

                <div class="profile-form">
                    <h3><i class="fas fa-lock"></i> Alterar Senha</h3>
                    <form method="POST">
                        <div class="form-group">
                            <label for="old_password">Senha Atual</label>
                            <input type="password" id="old_password" name="old_password" placeholder="Digite sua senha atual" required>
                        </div>

                        <div class="form-group">
                            <label for="new_password">Nova Senha</label>
                            <input type="password" id="new_password" name="new_password" placeholder="Digite a nova senha" required>
                        </div>

                        <div class="form-group">
                            <label for="confirm_password">Confirmar Nova Senha</label>
                            <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirme a nova senha" required>
                        </div>

                        <button type="submit" name="change_password" class="btn-submit">
                            <i class="fas fa-key"></i> Alterar Senha
                        </button>
                    </form>
                </div>
            </div>

            <div style="margin-top: 2rem;">
                <div class="profile-form">
                    <h3><i class="fas fa-chart-bar"></i> Minhas Estatísticas</h3>
                    <div class="stats-grid">
                        <div class="stat-card">
                            <h4>Treinos Agendados</h4>
                            <p>0</p>
                        </div>
                        <div class="stat-card">
                            <h4>Treinos Completos</h4>
                            <p>0</p>
                        </div>
                        <div class="stat-card">
                            <h4>Plano Ativo</h4>
                            <p>Básico</p>
                        </div>
                        <div class="stat-card">
                            <h4>Dias Restantes</h4>
                            <p>30</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
