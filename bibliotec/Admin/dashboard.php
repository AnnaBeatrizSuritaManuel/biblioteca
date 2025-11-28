<?php
session_start();
include '../includes/conexao.php';
include '../includes/auth.php';
verificarAdmin();

// Buscar estatísticas
$total_livros = $pdo->query("SELECT COUNT(*) FROM LIVROS")->fetchColumn();
$total_usuarios = $pdo->query("SELECT COUNT(*) FROM USUARIO WHERE tipo = 'usuario'")->fetchColumn();
$total_emprestimos = $pdo->query("SELECT COUNT(*) FROM EMPRESTIMO")->fetchColumn();
$total_autores = $pdo->query("SELECT COUNT(*) FROM AUTORES")->fetchColumn();

// Livros mais populares 
$livros_populares = $pdo->query("
    SELECT l.*, COUNT(e.id_emprestimo) as total_emprestimos 
    FROM LIVROS l 
    LEFT JOIN EMPRESTIMO e ON l.id_livro = e.id_livro 
    GROUP BY l.id_livro 
    ORDER BY total_emprestimos DESC 
    LIMIT 5
")->fetchAll();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - Bibliotec</title>
    <link rel="stylesheet" href="../assets/css/estilo.css">
    <style>
        .admin-header {
            background: linear-gradient(135deg, var(--primary-dark) 0%, var(--primary-main) 100%);
            color: white;
            padding: 2rem 0;
            margin-bottom: 2rem;
        }

        .admin-welcome {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.5rem;
            margin: 2rem 0;
        }

        .stat-card {
            background: var(--surface);
            padding: 1.5rem;
            border-radius: 12px;
            box-shadow: 0 2px 8px var(--shadow);
            text-align: center;
            border-left: 4px solid var(--primary-main);
        }

        .stat-number {
            font-size: 2.5rem;
            font-weight: bold;
            color: var(--primary-main);
            margin: 0.5rem 0;
        }

        .stat-label {
            color: var(--text-secondary);
            font-size: 0.9rem;
        }

        .admin-links {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin: 2rem 0;
        }

        .admin-link-card {
            background: var(--surface);
            padding: 1.5rem;
            border-radius: 12px;
            box-shadow: 0 2px 8px var(--shadow);
            text-align: center;
            text-decoration: none;
            color: var(--text-primary);
            transition: all 0.3s ease;
            border: 2px solid transparent;
        }

        .admin-link-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 24px var(--shadow-hover);
            border-color: var(--primary-main);
        }

        .admin-link-icon {
            font-size: 2.5rem;
            color: var(--primary-main);
            margin-bottom: 1rem;
        }

        .recent-activity {
            background: var(--surface);
            padding: 1.5rem;
            border-radius: 12px;
            box-shadow: 0 2px 8px var(--shadow);
            margin-top: 2rem;
        }

        .activity-item {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1rem;
            border-bottom: 1px solid var(--border);
        }

        .activity-item:last-child {
            border-bottom: none;
        }

        .activity-icon {
            width: 40px;
            height: 40px;
            background: var(--primary-light);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary-dark);
        }
    </style>
</head>
<body>
    <?php include '../includes/header.php'; ?>
    
    <div class="admin-header">
        <div class="container">
            <div class="admin-welcome">
              <div class="admin-actions">
                <div>
                  <h1>Dashboard Administrativo</h1>
                  <p>Bem-vindo, <?= $_SESSION['usuario_nome'] ?>! Aqui você gerencia todo o sistema.</p>
               </div>
                <div style="display: flex; gap: 1rem;">
                 <a href="../index.php" class="btn btn-secondary">
                   <i class="fas fa-globe"></i> Voltar ao Site
                 </a>
                  <a href="../logout.php" class="btn btn-outline">
                   <i class="fas fa-sign-out-alt"></i> Sair
                 </a>
              </div>
              </div>
                 <div style="text-align: right;">
                     <p><strong>Último acesso:</strong> <?= date('d/m/Y H:i') ?></p>
                     <p><strong>Nível:</strong> Administrador</p>
                 </div>
            </div>
        </div>
    </div>
    <div class="container">
        <!-- Estatísticas -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-number"><?= $total_livros ?></div>
                <div class="stat-label">Total de Livros</div>
            </div>
            
            <div class="stat-card">
                <div class="stat-number"><?= $total_usuarios ?></div>
                <div class="stat-label">Usuários Cadastrados</div>
            </div>
            
            <div class="stat-card">
                <div class="stat-number"><?= $total_emprestimos ?></div>
                <div class="stat-label">Empréstimos</div>
            </div>
            
            <div class="stat-card">
                <div class="stat-number"><?= $total_autores ?></div>
                <div class="stat-label">Autores</div>
            </div>
        </div>

        <!-- Links Rápidos -->
        <h2>Gerenciamento Rápido</h2>
        <div class="admin-links">
            <a href="livros.php" class="admin-link-card">
                <div class="admin-link-icon">📚</div>
                <h3>Gerenciar Livros</h3>
                <p>Adicionar, editar ou remover livros do acervo</p>
            </a>
            
            <a href="usuarios.php" class="admin-link-card">
                <div class="admin-link-icon">👥</div>
                <h3>Gerenciar Usuários</h3>
                <p>Visualizar e gerenciar usuários do sistema</p>
            </a>
            
            <a href="emprestimos.php" class="admin-link-card">
                <div class="admin-link-icon">🔄</div>
                <h3>Gerenciar Empréstimos</h3>
                <p>Controlar empréstimos e devoluções</p>
            </a>
            
            <a href="autores.php" class="admin-link-card">
                <div class="admin-link-icon">✍️</div>
                <h3>Gerenciar Autores</h3>
                <p>Administrar autores cadastrados</p>
            </a>
        </div>

        <!-- Livros Populares -->
        <div class="recent-activity">
            <h3>Livros Mais Emprestados</h3>
            <?php if(empty($livros_populares)): ?>
                <p style="text-align: center; color: var(--text-muted); padding: 2rem;">
                    Nenhum empréstimo registrado ainda.
                </p>
            <?php else: ?>
                <?php foreach($livros_populares as $livro): ?>
                <div class="activity-item">
                    <div class="activity-icon">📖</div>
                    <div style="flex: 1;">
                        <strong><?= htmlspecialchars($livro['titulo']) ?></strong>
                        <p style="margin: 0; color: var(--text-secondary);">
                            <?= htmlspecialchars($livro['autor']) ?> • 
                            <?= $livro['total_emprestimos'] ?> empréstimos
                        </p>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
    
    <?php include '../includes/footer.php'; ?>
</body>
</html>