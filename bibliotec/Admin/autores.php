<?php
session_start();
include '../includes/conexao.php';
include '../includes/auth.php';
verificarAdmin();

// Processar ações do CRUD
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['cadastrar_autor'])) {
        $nome = trim($_POST['nome']);
        $nacionalidade = trim($_POST['nacionalidade']);
        $biografia = trim($_POST['biografia']);
        $data_nascimento = $_POST['data_nascimento'] ?: null;
        
        $stmt = $pdo->prepare("INSERT INTO AUTORES (nome, nacionalidade, biografia, data_nascimento) VALUES (?, ?, ?, ?)");
        if ($stmt->execute([$nome, $nacionalidade, $biografia, $data_nascimento])) {
            $_SESSION['sucesso'] = "Autor cadastrado com sucesso!";
        } else {
            $_SESSION['erro'] = "Erro ao cadastrar autor!";
        }
    }
    
    // Editar autor
    if (isset($_POST['editar_autor'])) {
        $id_autor = $_POST['id_autor'];
        $nome = trim($_POST['nome']);
        $nacionalidade = trim($_POST['nacionalidade']);
        $biografia = trim($_POST['biografia']);
        $data_nascimento = $_POST['data_nascimento'] ?: null;
        
        $stmt = $pdo->prepare("UPDATE AUTORES SET nome = ?, nacionalidade = ?, biografia = ?, data_nascimento = ? WHERE id_autor = ?");
        if ($stmt->execute([$nome, $nacionalidade, $biografia, $data_nascimento, $id_autor])) {
            $_SESSION['sucesso'] = "Autor atualizado com sucesso!";
        } else {
            $_SESSION['erro'] = "Erro ao atualizar autor!";
        }
    }
    
    if (isset($_POST['excluir_autor'])) {
        $id_autor = $_POST['id_autor'];
        $stmt = $pdo->prepare("DELETE FROM AUTORES WHERE id_autor = ?");
        if ($stmt->execute([$id_autor])) {
            $_SESSION['sucesso'] = "Autor excluído com sucesso!";
        } else {
            $_SESSION['erro'] = "Erro ao excluir autor!";
        }
    }
    
    header("Location: autores.php");
    exit;
}

// Buscar todos os autores
$autores = $pdo->query("SELECT * FROM AUTORES ORDER BY nome")->fetchAll();

// Buscar estatísticas
$total_autores = count($autores);
$autores_com_livros = $pdo->query("
    SELECT COUNT(DISTINCT e.id_autor) 
    FROM ESCRITO e 
    JOIN AUTORES a ON e.id_autor = a.id_autor
")->fetchColumn();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Gerenciar Autores - Bibliotec</title>
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

        .form-container {
            background: var(--surface);
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0 2px 8px var(--shadow);
            margin-bottom: 2rem;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
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

        .autor-avatar {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, var(--primary-main) 0%, var(--primary-dark) 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            font-size: 1.2rem;
        }

        .actions-cell {
            display: flex;
            gap: 0.5rem;
        }

        .btn-danger {
            background: var(--error);
            color: white;
        }

        .btn-danger:hover {
            background: #c53030;
        }

        .biografia-truncada {
            max-width: 300px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            cursor: pointer;
        }

        .biografia-completa {
            max-width: 500px;
            white-space: normal;
        }

        .nacionalidade-badge {
            background: var(--secondary-light);
            color: var(--secondary-dark);
            padding: 0.25rem 0.5rem;
            border-radius: 12px;
            font-size: 0.8rem;
            font-weight: 600;
        }
    </style>
</head>
<body>
    <?php include '../includes/header.php'; ?>
    
    <div class="container">
        <div class="admin-actions">
            <h1>Gerenciar Autores</h1>
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
                <div class="stat-number"><?= $total_autores ?></div>
                <div>Total de Autores</div>
            </div>
            <div class="stat-card">
                <div class="stat-number"><?= $autores_com_livros ?></div>
                <div>Autores com Livros</div>
            </div>
            <div class="stat-card">
                <div class="stat-number"><?= $total_autores - $autores_com_livros ?></div>
                <div>Autores sem Livros</div>
            </div>
        </div>

        <!-- Formulário de Cadastro -->
        <div class="form-container">
            <h2>Cadastrar Novo Autor</h2>
            <form method="POST">
                <input type="hidden" name="cadastrar_autor" value="1">
                
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Nome do Autor *</label>
                        <input type="text" name="nome" class="form-control" placeholder="Ex: Stephen King" required>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Nacionalidade</label>
                        <input type="text" name="nacionalidade" class="form-control" placeholder="Ex: Brasileiro">
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Data de Nascimento</label>
                        <input type="date" name="data_nascimento" class="form-control">
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Biografia</label>
                        <textarea name="biografia" class="form-control" rows="4" placeholder="Breve biografia do autor..."></textarea>
                    </div>
                </div>
                
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-user-plus"></i> Cadastrar Autor
                </button>
            </form>
        </div>

        <!-- Lista de Autores -->
        <div class="table-container">
            <h2>Autores Cadastrados (<?= count($autores) ?>)</h2>
            
            <?php if(empty($autores)): ?>
                <div style="text-align: center; padding: 3rem; color: var(--text-muted);">
                    <i class="fas fa-user-edit" style="font-size: 3rem; margin-bottom: 1rem;"></i>
                    <p>Nenhum autor cadastrado ainda.</p>
                    <p>Cadastre o primeiro autor usando o formulário acima.</p>
                </div>
            <?php else: ?>
                <table>
                    <thead>
                        <tr>
                            <th>Avatar</th>
                            <th>Nome</th>
                            <th>Nacionalidade</th>
                            <th>Data Nasc.</th>
                            <th>Biografia</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($autores as $autor): 
                            $iniciais = substr($autor['nome'], 0, 2);
                            $data_nascimento = $autor['data_nascimento'] ? date('d/m/Y', strtotime($autor['data_nascimento'])) : '-';
                        ?>
                        <tr>
                            <td>
                                <div class="autor-avatar">
                                    <?= strtoupper($iniciais) ?>
                                </div>
                            </td>
                            <td>
                                <strong><?= htmlspecialchars($autor['nome']) ?></strong>
                            </td>
                            <td>
                                <?php if($autor['nacionalidade']): ?>
                                    <span class="nacionalidade-badge"><?= htmlspecialchars($autor['nacionalidade']) ?></span>
                                <?php else: ?>
                                    -
                                <?php endif; ?>
                            </td>
                            <td><?= $data_nascimento ?></td>
                            <td>
                                <div class="biografia-truncada" 
                                     data-biografia="<?= htmlspecialchars($autor['biografia'] ?? '') ?>"
                                     onclick="toggleBiografia(this)">
                                    <?= $autor['biografia'] ? htmlspecialchars(substr($autor['biografia'], 0, 50)) . '...' : '-' ?>
                                </div>
                            </td>
                            <td class="actions-cell">
                                <button class="btn btn-small btn-secondary" onclick="editarAutor(<?= $autor['id_autor'] ?>)">
                                    <i class="fas fa-edit"></i> Editar
                                </button>
                                <form method="POST" style="display: inline;">
                                    <input type="hidden" name="excluir_autor" value="1">
                                    <input type="hidden" name="id_autor" value="<?= $autor['id_autor'] ?>">
                                    <button type="submit" class="btn btn-small btn-danger" 
                                            onclick="return confirm('Tem certeza que deseja excluir o autor <?= htmlspecialchars($autor['nome']) ?>?')">
                                        <i class="fas fa-trash"></i> Excluir
                                    </button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
    </div>
    
    <?php include '../includes/footer.php'; ?>

    <!-- Modal de Edição de Autor -->
    <div id="editAutorModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Editar Autor</h3>
                <button class="modal-close" onclick="closeEditModal()">&times;</button>
            </div>
            <div class="modal-body">
                <form id="editAutorForm" method="POST">
                    <input type="hidden" name="editar_autor" value="1">
                    <input type="hidden" name="id_autor" id="edit_id_autor">
                    
                    <div class="form-group">
                        <label class="form-label">Nome *</label>
                        <input type="text" name="nome" id="edit_nome" class="form-control" required>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Nacionalidade</label>
                        <input type="text" name="nacionalidade" id="edit_nacionalidade" class="form-control">
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Data de Nascimento</label>
                        <input type="date" name="data_nascimento" id="edit_data_nascimento" class="form-control">
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Biografia</label>
                        <textarea name="biografia" id="edit_biografia" class="form-control" rows="6" 
                                  placeholder="Descreva a biografia do autor..."></textarea>
                    </div>
                    
                    <div style="display: flex; gap: 1rem; justify-content: flex-end;">
                        <button type="button" class="btn btn-outline" onclick="closeEditModal()">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function toggleBiografia(element) {
            const biografiaCompleta = element.getAttribute('data-biografia');
            if (element.classList.contains('biografia-completa')) {
                element.classList.remove('biografia-completa');
                element.classList.add('biografia-truncada');
                element.textContent = biografiaCompleta ? biografiaCompleta.substring(0, 50) + '...' : '-';
            } else {
                element.classList.remove('biografia-truncada');
                element.classList.add('biografia-completa');
                element.textContent = biografiaCompleta || '-';
            }
        }

        async function editarAutor(autorId) {
            try {
                const response = await fetch(`get_autor.php?id=${autorId}`);
                const autor = await response.json();
                
                document.getElementById('edit_id_autor').value = autor.id_autor;
                document.getElementById('edit_nome').value = autor.nome;
                document.getElementById('edit_nacionalidade').value = autor.nacionalidade || '';
                document.getElementById('edit_data_nascimento').value = autor.data_nascimento || '';
                document.getElementById('edit_biografia').value = autor.biografia || '';
                
                document.getElementById('editAutorModal').classList.add('active');
            } catch (error) {
                console.error('Erro ao carregar autor:', error);
                alert('Erro ao carregar dados do autor');
            }
        }

        function closeEditModal() {
            document.getElementById('editAutorModal').classList.remove('active');
        }

        // Validação do formulário de edição
        document.getElementById('editAutorForm').addEventListener('submit', function(e) {
            const nome = document.getElementById('edit_nome').value.trim();
            
            if (!nome) {
                e.preventDefault();
                alert('Por favor, preencha pelo menos o nome do autor.');
                return false;
            }
        });

        // Validação do formulário de cadastro
        document.querySelector('form[action=""]').addEventListener('submit', function(e) {
            const nome = document.querySelector('input[name="nome"]').value.trim();
            
            if (!nome) {
                e.preventDefault();
                alert('Por favor, preencha pelo menos o nome do autor.');
                return false;
            }
        });

        // Mostrar biografia completa ao passar o mouse
        document.querySelectorAll('.biografia-truncada').forEach(element => {
            element.addEventListener('mouseenter', function() {
                const fullText = this.getAttribute('data-biografia');
                if (fullText && fullText !== '-') {
                    this.setAttribute('data-original-text', this.textContent);
                    this.textContent = fullText;
                    this.classList.add('biografia-completa');
                    this.classList.remove('biografia-truncada');
                }
            });
            
            element.addEventListener('mouseleave', function() {
                const originalText = this.getAttribute('data-original-text');
                if (originalText) {
                    this.textContent = originalText;
                    this.classList.remove('biografia-completa');
                    this.classList.add('biografia-truncada');
                }
            });
        });

        // Fechar modal ao clicar fora
        document.getElementById('editAutorModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeEditModal();
            }
        });
    </script>
</body>
</html>