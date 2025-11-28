<?php
session_start();
include '../includes/conexao.php';
include '../includes/auth.php';
verificarAdmin();

// Buscar todos os usuários
$usuarios = $pdo->query("SELECT * FROM USUARIO ORDER BY nome")->fetchAll();

// Processar exclusão de usuário
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['excluir_usuario'])) {
    $id_usuario = $_POST['id_usuario'];
    
    // Não permitir excluir a si mesmo
    if ($id_usuario != $_SESSION['usuario_id']) {
        $stmt = $pdo->prepare("DELETE FROM USUARIO WHERE id_usuario = ?");
        if ($stmt->execute([$id_usuario])) {
            $_SESSION['sucesso'] = "Usuário excluído com sucesso!";
        } else {
            $_SESSION['erro'] = "Erro ao excluir usuário!";
        }
    } else {
        $_SESSION['erro'] = "Você não pode excluir sua própria conta!";
    }
    
    header("Location: usuarios.php");
    exit;
}

// Estatísticas
$total_usuarios = count($usuarios);
$total_admins = $pdo->query("SELECT COUNT(*) FROM USUARIO WHERE tipo = 'admin'")->fetchColumn();
$total_usuarios_comuns = $total_usuarios - $total_admins;
$novos_usuarios = $pdo->query("SELECT COUNT(*) FROM USUARIO WHERE data_cadastro >= DATE_SUB(NOW(), INTERVAL 7 DAY)")->fetchColumn();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Gerenciar Usuários - Bibliotec</title>
    <link rel="stylesheet" href="../assets/css/estilo.css">
    <style>
        .admin-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }

        .stats-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: var(--surface);
            padding: 1.5rem;
            border-radius: 8px;
            box-shadow: 0 2px 8px var(--shadow);
            text-align: center;
        }

        .stat-number {
            font-size: 2rem;
            font-weight: bold;
            color: var(--primary-main);
        }

        .stat-label {
            color: var(--text-secondary);
            font-size: 0.9rem;
        }

        .table-container {
            background: var(--surface);
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0 2px 8px var(--shadow);
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 1rem;
            text-align: left;
            border-bottom: 1px solid var(--border);
        }

        th {
            background: var(--background);
            font-weight: 600;
            color: var(--primary-dark);
        }

        .user-type-admin {
            background: var(--primary-light);
            color: var(--primary-dark);
            padding: 0.25rem 0.5rem;
            border-radius: 4px;
            font-size: 0.8rem;
            font-weight: 600;
        }

        .user-type-user {
            background: var(--secondary-light);
            color: var(--secondary-dark);
            padding: 0.25rem 0.5rem;
            border-radius: 4px;
            font-size: 0.8rem;
            font-weight: 600;
        }

        .btn-danger {
            background: var(--error);
            color: white;
        }

        .btn-danger:hover {
            background: #c53030;
        }

        .btn-small {
            padding: 0.5rem 0.75rem;
            font-size: 0.8rem;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, var(--primary-main) 0%, var(--primary-dark) 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>
    <?php include '../includes/header.php'; ?>
    
    <div class="container">
        <div class="admin-actions">
            <h1>Gerenciar Usuários</h1>
            <div style="display: flex; gap: 1rem;">
                <a href="../index.php" class="btn btn-outline">
                    <i class="fas fa-globe"></i> Site Principal
                </a>
                <a href="dashboard.php" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Voltar ao Dashboard
                </a>
            </div>
        </div>
        
        <div class="stats-cards">
            <div class="stat-card">
                <div class="stat-number"><?= $total_usuarios ?></div>
                <div class="stat-label">Total de Usuários</div>
            </div>
            <div class="stat-card">
                <div class="stat-number"><?= $total_admins ?></div>
                <div class="stat-label">Administradores</div>
            </div>
            <div class="stat-card">
                <div class="stat-number"><?= $total_usuarios_comuns ?></div>
                <div class="stat-label">Usuários Comuns</div>
            </div>
            <div class="stat-card">
                <div class="stat-number"><?= $novos_usuarios ?></div>
                <div class="stat-label">Novos (7 dias)</div>
            </div>
        </div>

        <!-- Lista de Usuários -->
        <div class="table-container">
            <h2>Usuários Cadastrados</h2>
            
            <?php if(empty($usuarios)): ?>
                <div style="text-align: center; padding: 3rem; color: var(--text-muted);">
                    <i class="fas fa-users" style="font-size: 3rem; margin-bottom: 1rem;"></i>
                    <p>Nenhum usuário cadastrado ainda.</p>
                </div>
            <?php else: ?>
                <table>
                    <thead>
                        <tr>
                            <th>Avatar</th>
                            <th>Nome</th>
                            <th>E-mail</th>
                            <th>Tipo</th>
                            <th>Telefone</th>
                            <th>Data Cadastro</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($usuarios as $usuario): 
                            $iniciais = substr($usuario['nome'], 0, 2);
                        ?>
                        <tr>
                            <td>
                                <div class="user-avatar">
                                    <?= strtoupper($iniciais) ?>
                                </div>
                            </td>
                            <td>
                                <strong><?= htmlspecialchars($usuario['nome']) ?></strong>
                                <?php if($usuario['id_usuario'] == $_SESSION['usuario_id']): ?>
                                    <br><small><em>(Você)</em></small>
                                <?php endif; ?>
                            </td>
                            <td><?= htmlspecialchars($usuario['email']) ?></td>
                            <td>
                                <?php if($usuario['tipo'] == 'admin'): ?>
                                    <span class="user-type-admin">Administrador</span>
                                <?php else: ?>
                                    <span class="user-type-user">Usuário</span>
                                <?php endif; ?>
                            </td>
                            <td><?= $usuario['telefone'] ?: '-' ?></td>
                            <td><?= date('d/m/Y', strtotime($usuario['data_cadastro'])) ?></td>
                            <td>
                                <div style="display: flex; gap: 0.5rem;">
                                    <button class="btn btn-small btn-secondary" onclick="verDetalhes(<?= $usuario['id_usuario'] ?>)">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <?php if($usuario['id_usuario'] != $_SESSION['usuario_id']): ?>
                                        <form method="POST" style="display: inline;">
                                            <input type="hidden" name="excluir_usuario" value="1">
                                            <input type="hidden" name="id_usuario" value="<?= $usuario['id_usuario'] ?>">
                                            <button type="submit" class="btn btn-small btn-danger" 
                                                    onclick="return confirm('Tem certeza que deseja excluir o usuário <?= htmlspecialchars($usuario['nome']) ?>?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    <?php else: ?>
                                        <button class="btn btn-small btn-secondary" disabled title="Não é possível excluir sua própria conta">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    <?php endif; ?>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
    </div>
    
    <?php include '../includes/footer.php'; ?>

    <script>
        function verDetalhes(usuarioId) {
            alert(`Detalhes do usuário ID: ${usuarioId}\nEm uma implementação completa, aqui abriria um modal com informações detalhadas.`);
        }
    </script>
</body>
</html>