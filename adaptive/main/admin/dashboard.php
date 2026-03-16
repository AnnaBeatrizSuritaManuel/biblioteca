<?php
$page_title = 'Painel de Admin';
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../config/auth.php';

if (!isAdmin()) {
    header('Location: ../index.php');
    exit;
}

// Estatísticas
$users_count = $conn->query("SELECT COUNT(*) as count FROM users")->fetch_assoc()['count'];
$workouts_count = $conn->query("SELECT COUNT(*) as count FROM workouts")->fetch_assoc()['count'];
$messages_count = $conn->query("SELECT COUNT(*) as count FROM contact_messages WHERE status = 'new'")->fetch_assoc()['count'];
$gyms_count = $conn->query("SELECT COUNT(*) as count FROM gyms")->fetch_assoc()['count'];

// Processar ações de admin
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['create_admin'])) {
        $admin_email = $_POST['admin_email'] ?? '';
        $admin_password = $_POST['admin_password'] ?? '';
        $secret_key = $_POST['secret_key'] ?? '';

        $result = createAdminUser($admin_email, $admin_password, $secret_key);
        $message = $result['message'];
        $is_success = $result['success'];
    }

    if (isset($_POST['ban_user'])) {
        $user_id = (int)$_POST['user_id'];
        $conn->query("UPDATE users SET status = 'banned' WHERE id = $user_id");
        $message = 'Usuário banido com sucesso!';
        $is_success = true;
    }

    if (isset($_POST['delete_message'])) {
        $msg_id = (int)$_POST['message_id'];
        $conn->query("DELETE FROM contact_messages WHERE id = $msg_id");
        $message = 'Mensagem deletada!';
        $is_success = true;
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
        .admin-container {
            min-height: calc(100vh - 80px);
            padding: 3rem 0;
            animation: fadeIn 0.6s ease-in;
        }

        .admin-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }

        .admin-header h1 {
            color: var(--accent-bright);
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .admin-badge {
            background: linear-gradient(135deg, #ff6b6b 0%, #ff8787 100%);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 2rem;
            font-size: 0.85rem;
            font-weight: 600;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            margin-bottom: 3rem;
        }

        .stat-box {
            background: rgba(0, 212, 255, 0.05);
            border: 2px solid rgba(0, 212, 255, 0.2);
            border-radius: 1rem;
            padding: 2rem;
            text-align: center;
            transition: var(--transition);
            animation: slideUp 0.6s ease-out;
        }

        .stat-box:hover {
            border-color: var(--accent-bright);
            background: rgba(0, 212, 255, 0.1);
            transform: translateY(-5px);
        }

        .stat-icon {
            font-size: 2.5rem;
            color: var(--accent-bright);
            margin-bottom: 1rem;
        }

        .stat-number {
            font-size: 2rem;
            color: var(--accent-bright);
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .stat-label {
            color: var(--gray);
        }

        .admin-section {
            background: rgba(0, 212, 255, 0.05);
            border: 2px solid rgba(0, 212, 255, 0.2);
            border-radius: 1rem;
            padding: 2rem;
            margin-bottom: 2rem;
            animation: slideUp 0.6s ease-out;
        }

        .admin-section h3 {
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

        .form-group input,
        .form-group select {
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

        .form-group input:focus,
        .form-group select:focus {
            outline: none;
            border-color: var(--accent-bright);
            box-shadow: 0 0 1rem rgba(0, 212, 255, 0.3);
        }

        .btn-submit {
            padding: 0.75rem 1.5rem;
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

        .btn-danger {
            background: rgba(255, 0, 0, 0.2);
            color: #ff6b6b;
            border: 1px solid rgba(255, 0, 0, 0.3);
            padding: 0.5rem 1rem;
            border-radius: 0.4rem;
            cursor: pointer;
            transition: var(--transition);
        }

        .btn-danger:hover {
            background: rgba(255, 0, 0, 0.3);
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1rem;
        }

        .table th {
            background: rgba(0, 212, 255, 0.1);
            color: var(--accent-bright);
            padding: 1rem;
            text-align: left;
            border-bottom: 2px solid rgba(0, 212, 255, 0.2);
        }

        .table td {
            padding: 1rem;
            border-bottom: 1px solid rgba(0, 212, 255, 0.1);
            color: var(--ice);
        }

        .table tr:hover {
            background: rgba(0, 212, 255, 0.05);
        }

        .alert {
            padding: 1rem;
            border-radius: 0.5rem;
            margin-bottom: 1.5rem;
        }

        .alert-success {
            background: rgba(0, 255, 0, 0.1);
            border: 1px solid rgba(0, 255, 0, 0.3);
            color: #51cf66;
        }

        .alert-error {
            background: rgba(255, 0, 0, 0.1);
            border: 1px solid rgba(255, 0, 0, 0.3);
            color: #ff6b6b;
        }

        .secret-warning {
            background: rgba(255, 165, 0, 0.1);
            border: 2px solid rgba(255, 165, 0, 0.3);
            border-radius: 0.75rem;
            padding: 1rem;
            color: #ffa500;
            margin-bottom: 1rem;
            font-size: 0.9rem;
        }

        @media (max-width: 768px) {
            .stats-grid {
                grid-template-columns: 1fr;
            }

            .admin-header {
                flex-direction: column;
                text-align: center;
            }
        }
    </style>
</head>
<body>
    <?php include '../includes/header.php'; ?>

    <div class="admin-container">
        <div class="container">
            <div class="admin-header">
                <h1>
                    <i class="fas fa-crown"></i> Painel de Administração
                </h1>
                <span class="admin-badge">
                    <i class="fas fa-shield-alt"></i> Admin
                </span>
            </div>

            <?php if (isset($message)): ?>
                <div class="alert <?php echo $is_success ? 'alert-success' : 'alert-error'; ?>">
                    <i class="fas fa-<?php echo $is_success ? 'check-circle' : 'exclamation-circle'; ?>"></i> 
                    <?php echo $message; ?>
                </div>
            <?php endif; ?>

            <!-- Estatísticas -->
            <div class="stats-grid">
                <div class="stat-box">
                    <div class="stat-icon"><i class="fas fa-users"></i></div>
                    <div class="stat-number"><?php echo $users_count; ?></div>
                    <div class="stat-label">Usuários Registrados</div>
                </div>

                <div class="stat-box">
                    <div class="stat-icon"><i class="fas fa-dumbbell"></i></div>
                    <div class="stat-number"><?php echo $workouts_count; ?></div>
                    <div class="stat-label">Treinos Agendados</div>
                </div>

                <div class="stat-box">
                    <div class="stat-icon"><i class="fas fa-envelope"></i></div>
                    <div class="stat-number"><?php echo $messages_count; ?></div>
                    <div class="stat-label">Mensagens Novas</div>
                </div>

                <div class="stat-box">
                    <div class="stat-icon"><i class="fas fa-map-marker-alt"></i></div>
                    <div class="stat-number"><?php echo $gyms_count; ?></div>
                    <div class="stat-label">Academias Cadastradas</div>
                </div>
            </div>

            <!-- Criar Admin Secreto -->
            <div class="admin-section">
                <h3><i class="fas fa-user-secret"></i> Funções Secretas - Criar Novo Admin</h3>
                
                <div class="secret-warning">
                    <i class="fas fa-lock"></i> <strong>Atenção:</strong> Esta é uma função secreta. Use a chave secreta correta para criar um novo administrador.
                </div>

                <form method="POST">
                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1rem;">
                        <div class="form-group">
                            <label for="admin_email">Email do Novo Admin</label>
                            <input type="email" id="admin_email" name="admin_email" placeholder="admin@fitzone.com" required>
                        </div>

                        <div class="form-group">
                            <label for="admin_password">Senha</label>
                            <input type="password" id="admin_password" name="admin_password" placeholder="Senha segura" required>
                        </div>

                        <div class="form-group">
                            <label for="secret_key">Chave Secreta</label>
                            <input type="password" id="secret_key" name="secret_key" placeholder="Digite a chave secreta" required>
                        </div>
                    </div>

                    <button type="submit" name="create_admin" class="btn-submit">
                        <i class="fas fa-user-plus"></i> Criar Admin
                    </button>
                </form>

                <div style="margin-top: 1rem; padding: 1rem; background: rgba(0, 0, 0, 0.3); border-radius: 0.5rem; color: var(--gray); font-size: 0.9rem;">
                    <strong>Chave Secreta:</strong> FITZONE_ADMIN_2024
                </div>
            </div>

            <!-- Gerenciar Usuários -->
            <div class="admin-section">
                <h3><i class="fas fa-users-cog"></i> Gerenciar Usuários</h3>
                
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Email</th>
                            <th>Telefone</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $users = $conn->query("SELECT * FROM users LIMIT 10");
                        while ($user = $users->fetch_assoc()):
                        ?>
                            <tr>
                                <td><?php echo htmlspecialchars($user['name']); ?></td>
                                <td><?php echo htmlspecialchars($user['email']); ?></td>
                                <td><?php echo htmlspecialchars($user['phone'] ?? '-'); ?></td>
                                <td><span style="color: var(--accent-bright);"><?php echo ucfirst($user['role']); ?></span></td>
                                <td>
                                    <span style="padding: 0.25rem 0.75rem; border-radius: 2rem; background: <?php echo $user['status'] === 'active' ? 'rgba(0, 255, 0, 0.2)' : 'rgba(255, 0, 0, 0.2)'; ?>; color: <?php echo $user['status'] === 'active' ? '#51cf66' : '#ff6b6b'; ?>;">
                                        <?php echo ucfirst($user['status']); ?>
                                    </span>
                                </td>
                                <td>
                                    <?php if ($user['status'] !== 'banned'): ?>
                                        <form method="POST" style="display: inline;">
                                            <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
                                            <button type="submit" name="ban_user" class="btn-danger" onclick="return confirm('Banir este usuário?')">
                                                <i class="fas fa-ban"></i> Banir
                                            </button>
                                        </form>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>

            <!-- Mensagens de Contato -->
            <div class="admin-section">
                <h3><i class="fas fa-envelope"></i> Mensagens de Contato</h3>
                
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Email</th>
                            <th>Assunto</th>
                            <th>Status</th>
                            <th>Data</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $messages = $conn->query("SELECT * FROM contact_messages ORDER BY created_at DESC LIMIT 10");
                        while ($msg = $messages->fetch_assoc()):
                        ?>
                            <tr>
                                <td><?php echo htmlspecialchars($msg['name']); ?></td>
                                <td><?php echo htmlspecialchars($msg['email']); ?></td>
                                <td><?php echo htmlspecialchars(substr($msg['subject'], 0, 30)); ?></td>
                                <td>
                                    <span style="padding: 0.25rem 0.75rem; border-radius: 2rem; background: <?php echo $msg['status'] === 'new' ? 'rgba(255, 165, 0, 0.2)' : 'rgba(0, 255, 0, 0.2)'; ?>; color: <?php echo $msg['status'] === 'new' ? '#ffa500' : '#51cf66'; ?>;">
                                        <?php echo ucfirst($msg['status']); ?>
                                    </span>
                                </td>
                                <td><?php echo date('d/m/Y H:i', strtotime($msg['created_at'])); ?></td>
                                <td>
                                    <form method="POST" style="display: inline;">
                                        <input type="hidden" name="message_id" value="<?php echo $msg['id']; ?>">
                                        <button type="submit" name="delete_message" class="btn-danger" onclick="return confirm('Deletar mensagem?')">
                                            <i class="fas fa-trash"></i> Deletar
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
