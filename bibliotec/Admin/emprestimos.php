<?php
session_start();
include '../includes/conexao.php';
include '../includes/auth.php';
verificarAdmin();

// Processar ações
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['realizar_emprestimo'])) {
        $id_usuario = $_POST['id_usuario'];
        $id_livro = $_POST['id_livro'];
        $data_entrega_prevista = $_POST['data_entrega_prevista'];
        
        $stmt = $pdo->prepare("INSERT INTO EMPRESTIMO (id_usuario, id_livro, data_entrega_prevista) VALUES (?, ?, ?)");
        if ($stmt->execute([$id_usuario, $id_livro, $data_entrega_prevista])) {
            $_SESSION['sucesso'] = "Empréstimo realizado com sucesso!";
        } else {
            $_SESSION['erro'] = "Erro ao realizar empréstimo!";
        }
    }
    
    if (isset($_POST['registrar_devolucao'])) {
        $id_emprestimo = $_POST['id_emprestimo'];
        
        // Aqui você poderia atualizar a data_devolucao_real
        $stmt = $pdo->prepare("UPDATE EMPRESTIMO SET data_devolucao_real = NOW() WHERE id_emprestimo = ?");
        if ($stmt->execute([$id_emprestimo])) {
            $_SESSION['sucesso'] = "Devolução registrada com sucesso!";
        } else {
            $_SESSION['erro'] = "Erro ao registrar devolução!";
        }
    }
    
    header("Location: emprestimos.php");
    exit;
}

// Buscar empréstimos
$emprestimos = $pdo->query("
    SELECT e.*, u.nome as usuario_nome, l.titulo as livro_titulo 
    FROM EMPRESTIMO e 
    JOIN USUARIO u ON e.id_usuario = u.id_usuario 
    JOIN LIVROS l ON e.id_livro = l.id_livro 
    ORDER BY e.data_emprestimo DESC
")->fetchAll();

// Buscar usuários e livros para o formulário
$usuarios = $pdo->query("SELECT id_usuario, nome FROM USUARIO WHERE tipo = 'usuario' ORDER BY nome")->fetchAll();
$livros = $pdo->query("SELECT id_livro, titulo FROM LIVROS ORDER BY titulo")->fetchAll();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Gerenciar Empréstimos - Bibliotec</title>
    <link rel="stylesheet" href="../assets/css/estilo.css">
    <style>
        .admin-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }

        .form-container {
            background: var(--surface);
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0 2px 8px var(--shadow);
            margin-bottom: 2rem;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 1rem;
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

        .status-ativo {
            background: var(--success);
            color: white;
            padding: 0.25rem 0.5rem;
            border-radius: 4px;
            font-size: 0.8rem;
            font-weight: 600;
        }

        .status-devolvido {
            background: var(--secondary-main);
            color: white;
            padding: 0.25rem 0.5rem;
            border-radius: 4px;
            font-size: 0.8rem;
            font-weight: 600;
        }

        .status-atrasado {
            background: var(--error);
            color: white;
            padding: 0.25rem 0.5rem;
            border-radius: 4px;
            font-size: 0.8rem;
            font-weight: 600;
        }

        .btn-success {
            background: var(--success);
            color: white;
        }

        .btn-success:hover {
            background: #2e7d32;
        }
    </style>
</head>
<body>
    <?php include '../includes/header.php'; ?>
    
    <div class="container">
        <div class="admin-actions">
             <h1>Gerenciar Emprestimos</h1>
         <div style="display: flex; gap: 1rem;">
             <a href="../index.php" class="btn btn-outline">
               <i class="fas fa-globe"></i> Site Principal
             </a>
             <a href="dashboard.php" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Voltar ao Dashboard
             </a>
          </div>
        </div>

        <!-- Formulário de Novo Empréstimo -->
        <div class="form-container">
            <h2>Realizar Novo Empréstimo</h2>
            <form method="POST">
                <input type="hidden" name="realizar_emprestimo" value="1">
                
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Usuário *</label>
                        <select name="id_usuario" class="form-control" required>
                            <option value="">Selecione um usuário</option>
                            <?php foreach($usuarios as $usuario): ?>
                                <option value="<?= $usuario['id_usuario'] ?>"><?= htmlspecialchars($usuario['nome']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Livro *</label>
                        <select name="id_livro" class="form-control" required>
                            <option value="">Selecione um livro</option>
                            <?php foreach($livros as $livro): ?>
                                <option value="<?= $livro['id_livro'] ?>"><?= htmlspecialchars($livro['titulo']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Data de Devolução Prevista *</label>
                        <input type="date" name="data_entrega_prevista" class="form-control" required
                               min="<?= date('Y-m-d') ?>">
                    </div>
                </div>
                
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-handshake"></i> Realizar Empréstimo
                </button>
            </form>
        </div>

        <!-- Lista de Empréstimos -->
        <div class="table-container">
            <h2>Histórico de Empréstimos</h2>
            
            <?php if(empty($emprestimos)): ?>
                <div style="text-align: center; padding: 3rem; color: var(--text-muted);">
                    <i class="fas fa-exchange-alt" style="font-size: 3rem; margin-bottom: 1rem;"></i>
                    <p>Nenhum empréstimo registrado ainda.</p>
                </div>
            <?php else: ?>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Usuário</th>
                            <th>Livro</th>
                            <th>Data Empréstimo</th>
                            <th>Devolução Prevista</th>
                            <th>Status</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($emprestimos as $emp): 
                            $status = 'ativo';
                            if ($emp['data_devolucao_real']) {
                                $status = 'devolvido';
                            } elseif (strtotime($emp['data_entrega_prevista']) < time()) {
                                $status = 'atrasado';
                            }
                        ?>
                        <tr>
                            <td><?= $emp['id_emprestimo'] ?></td>
                            <td><strong><?= htmlspecialchars($emp['usuario_nome']) ?></strong></td>
                            <td><?= htmlspecialchars($emp['livro_titulo']) ?></td>
                            <td><?= date('d/m/Y', strtotime($emp['data_emprestimo'])) ?></td>
                            <td><?= date('d/m/Y', strtotime($emp['data_entrega_prevista'])) ?></td>
                            <td>
                                <?php if($status == 'ativo'): ?>
                                    <span class="status-ativo">Ativo</span>
                                <?php elseif($status == 'devolvido'): ?>
                                    <span class="status-devolvido">Devolvido</span>
                                <?php else: ?>
                                    <span class="status-atrasado">Atrasado</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if($status == 'ativo'): ?>
                                    <form method="POST" style="display: inline;">
                                        <input type="hidden" name="registrar_devolucao" value="1">
                                        <input type="hidden" name="id_emprestimo" value="<?= $emp['id_emprestimo'] ?>">
                                        <button type="submit" class="btn btn-success btn-small">
                                            <i class="fas fa-check"></i> Registrar Devolução
                                        </button>
                                    </form>
                                <?php else: ?>
                                    <button class="btn btn-secondary btn-small" disabled>
                                        <i class="fas fa-check"></i> Finalizado
                                    </button>
                                <?php endif; ?>
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
        // Configurar data mínima para o campo de data
        const dataInput = document.querySelector('input[name="data_entrega_prevista"]');
        if (dataInput) {
            const hoje = new Date().toISOString().split('T')[0];
            dataInput.min = hoje;
        }
    </script>
</body>
</html>