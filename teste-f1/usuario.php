<?php
session_start();
include 'includes/conexao.php';

// Verificar se usuário está logado
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit;
}

$usuario_id = $_SESSION['usuario_id'];

// Buscar dados do usuário
$stmt_usuario = $pdo->prepare("SELECT * FROM USUARIO WHERE id_usuario = ?");
$stmt_usuario->execute([$usuario_id]);
$usuario = $stmt_usuario->fetch();

// Buscar livros favoritos
$stmt_favoritos = $pdo->prepare("
    SELECT l.* FROM LIVROS l
    JOIN favoritos f ON l.id_livro = f.id_livro
    WHERE f.id_usuario = ?
    ORDER BY f.data_favoritado DESC
");
$stmt_favoritos->execute([$usuario_id]);
$favoritos = $stmt_favoritos->fetchAll();

// Buscar carrinho
$stmt_carrinho = $pdo->prepare("
    SELECT l.*, c.quantidade, c.id_item FROM LIVROS l
    JOIN carrinho c ON l.id_livro = c.id_livro
    WHERE c.id_usuario = ?
    ORDER BY c.data_adicionado DESC
");
$stmt_carrinho->execute([$usuario_id]);
$carrinho = $stmt_carrinho->fetchAll();

// Buscar histórico de empréstimos
$stmt_emprestimos = $pdo->prepare("
    SELECT e.*, l.titulo, l.autor FROM EMPRESTIMO e
    JOIN LIVROS l ON e.id_livro = l.id_livro
    WHERE e.id_usuario = ?
    ORDER BY e.data_emprestimo DESC
");
$stmt_emprestimos->execute([$usuario_id]);
$emprestimos = $stmt_emprestimos->fetchAll();

// Processar atualização do perfil
if ($_POST && isset($_POST['atualizar_perfil'])) {
    $nome = trim($_POST['nome']);
    $telefone = trim($_POST['telefone']);
    $biografia = trim($_POST['biografia']);
    
    $stmt_update = $pdo->prepare("UPDATE USUARIO SET nome = ?, telefone = ?, biografia = ? WHERE id_usuario = ?");
    $stmt_update->execute([$nome, $telefone, $biografia, $usuario_id]);
    
    $_SESSION['sucesso'] = "Perfil atualizado com sucesso!";
    header("Location: usuario.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meu Perfil - bibliotec</title>
    <link rel="stylesheet" href="assets/css/estilo.css">
    <style>
        .profile-avatar {
            width: 100px;
            height: 100px;
            background: linear-gradient(135deg, var(--primary-main) 0%, var(--primary-dark) 100%);
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.5rem;
            color: white;
            font-size: 2.5rem;
        }

        .profile-grid {
            display: grid;
            grid-template-columns: 280px 1fr;
            gap: 2rem;
            margin-top: 2rem;
        }

        .sidebar {
            background: var(--surface);
            border-radius: 12px;
            padding: 2rem;
            box-shadow: 0 2px 8px var(--shadow);
            height: fit-content;
        }

        .nav-pills {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .nav-pill {
            padding: 1rem;
            border-radius: 8px;
            color: var(--text-primary);
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 0.75rem;
            transition: all 0.3s ease;
            border: none;
            background: none;
            width: 100%;
            text-align: left;
            font-family: inherit;
            font-size: inherit;
            cursor: pointer;
        }

        .nav-pill:hover {
            background-color: var(--background);
        }

        .nav-pill.active {
            background-color: var(--primary-main);
            color: white;
        }

        .content-area {
            background: var(--surface);
            border-radius: 12px;
            padding: 2rem;
            box-shadow: 0 2px 8px var(--shadow);
        }

        .tab-content {
            display: none;
        }

        .tab-content.active {
            display: block;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .info-item {
            padding: 1rem;
            background: var(--background);
            border-radius: 8px;
            border-left: 4px solid var(--primary-main);
        }

        .info-label {
            font-weight: 600;
            color: var(--primary-main);
            margin-bottom: 0.25rem;
            font-size: 0.9rem;
        }

        .info-value {
            color: var(--text-primary);
        }

        .carrinho-item {
            display: grid;
            grid-template-columns: 80px 1fr auto auto;
            gap: 1rem;
            align-items: center;
            padding: 1rem;
            border-bottom: 1px solid var(--border);
        }

        .carrinho-img {
            width: 80px;
            height: 100px;
            object-fit: cover;
            border-radius: 4px;
        }

        .carrinho-controles {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .quantidade-input {
            width: 60px;
            padding: 0.5rem;
            border: 1px solid var(--border);
            border-radius: 4px;
            text-align: center;
        }

        .carrinho-total {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1.5rem;
            background: var(--background);
            border-radius: 8px;
            margin-top: 2rem;
        }

        .badge {
            background: var(--primary-light);
            color: var(--primary-dark);
            padding: 0.25rem 0.5rem;
            border-radius: 12px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        @media (max-width: 768px) {
            .profile-grid {
                grid-template-columns: 1fr;
            }
            
            .carrinho-item {
                grid-template-columns: 1fr;
                text-align: center;
            }
        }
    </style>
</head>
<body>
    <?php include 'includes/header.php'; ?>

    <main>
        <section class="section">
            <div class="container">
                <!-- Cabeçalho do Perfil -->
                <div class="profile-header text-center">
                    <div class="profile-avatar">
                        <i class="fas fa-user"></i>
                    </div>
                    <h1 class="profile-name"><?= htmlspecialchars($usuario['nome']) ?></h1>
                    <p class="profile-info">
                        <?= htmlspecialchars($usuario['email']) ?> • 
                        Membro desde: <?= date('d/m/Y', strtotime($usuario['data_cadastro'])) ?>
                    </p>
                </div>

                <div class="profile-grid">
                    <!-- Menu Lateral -->
                    <div class="sidebar">
                        <nav class="nav-pills">
                            <button class="nav-pill active" data-tab="dados">
                                <span style="display: flex; align-items: center; gap: 0.75rem;">
                                    <i class="fas fa-user"></i> Dados Pessoais
                                </span>
                            </button>
                            
                            <button class="nav-pill" data-tab="favoritos">
                                <span style="display: flex; align-items: center; gap: 0.75rem;">
                                    <i class="fas fa-heart"></i> Favoritos
                                </span>
                                <span class="badge"><?= count($favoritos) ?></span>
                            </button>
                            
                            <button class="nav-pill" data-tab="carrinho">
                                <span style="display: flex; align-items: center; gap: 0.75rem;">
                                    <i class="fas fa-shopping-cart"></i> Carrinho
                                </span>
                                <span class="badge"><?= count($carrinho) ?></span>
                            </button>
                            
                            <button class="nav-pill" data-tab="historico">
                                <span style="display: flex; align-items: center; gap: 0.75rem;">
                                    <i class="fas fa-history"></i> Histórico
                                </span>
                            </button>
                            
                            <button class="nav-pill" data-tab="config">
                                <span style="display: flex; align-items: center; gap: 0.75rem;">
                                    <i class="fas fa-cog"></i> Configurações
                                </span>
                            </button>
                        </nav>
                    </div>

                    <!-- Conteúdo das Abas -->
                    <div class="content-area">
                        <!-- Dados Pessoais -->
                        <div id="dados" class="tab-content active">
                            <h2>Dados Pessoais</h2>
                            <div class="info-grid">
                                <div class="info-item">
                                    <div class="info-label">Nome Completo</div>
                                    <div class="info-value"><?= htmlspecialchars($usuario['nome']) ?></div>
                                </div>
                                <div class="info-item">
                                    <div class="info-label">E-mail</div>
                                    <div class="info-value"><?= htmlspecialchars($usuario['email']) ?></div>
                                </div>
                                <div class="info-item">
                                    <div class="info-label">Telefone</div>
                                    <div class="info-value"><?= htmlspecialchars($usuario['telefone'] ?? 'Não informado') ?></div>
                                </div>
                                <div class="info-item">
                                    <div class="info-label">Tipo de Conta</div>
                                    <div class="info-value"><?= $usuario['tipo'] == 'admin' ? 'Administrador' : 'Usuário' ?></div>
                                </div>
                            </div>
                            
                            <?php if(!empty($usuario['biografia'])): ?>
                            <div class="info-item">
                                <div class="info-label">Biografia</div>
                                <div class="info-value"><?= htmlspecialchars($usuario['biografia']) ?></div>
                            </div>
                            <?php endif; ?>
                        </div>

                        <!-- Favoritos -->
                        <div id="favoritos" class="tab-content">
                            <h2>Meus Favoritos</h2>
                            <?php if(empty($favoritos)): ?>
                                <div class="text-center" style="padding: 3rem;">
                                    <i class="fas fa-heart" style="font-size: 3rem; color: var(--text-muted); margin-bottom: 1rem;"></i>
                                    <p style="color: var(--text-secondary);">Nenhum livro favoritado ainda.</p>
                                    <a href="categorias.php" class="btn btn-primary mt-2">Explorar Livros</a>
                                </div>
                            <?php else: ?>
                                <div class="grid grid-3">
                                    <?php foreach($favoritos as $livro): ?>
                                    <div class="card">
                                        <img src="img/<?= $livro['titulo'] ?>.jpg" alt="<?= $livro['titulo'] ?>" class="card-img" 
                                             onerror="this.src='data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjAwIiBoZWlnaHQ9IjMwMCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48cmVjdCB3aWR0aD0iMTAwJSIgaGVpZ2h0PSIxMDAlIiBmaWxsPSIjZjhjZTEzIi8+PHRleHQgeD0iNTAlIiB5PSI1MCUiIGZvbnQtZmFtaWx5PSJBcmlhbCIgZm9udC1zaXplPSIxOCIgZmlsbD0iIzJjMzgxMCIgdGV4dC1hbmNob3I9Im1pZGRsZSIgZG9taW5hbnQtYmFzZWxpbmU9Im1pZGRsZSI+PGtici8+PGtici8+PGtici8+PGtici8+PGtici8+PGtici8Pjx0c3BhbiB4PSI1MCUiIHk9IjUwJSI+8J+SuiBCb29rPC90c3Bhbj48L3RleHQ+PC9zdmc+'">
                                        <div class="card-body">
                                            <h3 class="card-title"><?= htmlspecialchars($livro['titulo']) ?></h3>
                                            <p class="card-text"><?= htmlspecialchars($livro['autor']) ?></p>
                                            <p class="card-text"><small><?= htmlspecialchars($livro['genero']) ?> • <?= $livro['ano_publicado'] ?></small></p>
                                            <div class="card-actions">
                                                <button class="btn btn-primary btn-small" onclick="openBookModal(<?= $livro['id_livro'] ?>)">
                                                    Ver Detalhes
                                                </button>
                                                <button class="btn btn-outline btn-small remove-favorito" data-livro="<?= $livro['id_livro'] ?>">
                                                    <i class="fas fa-heart-broken"></i> Remover
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    <!-- Em usuario.php, nas seções de favoritos e carrinho -->
                     <?php if($item['imagem_url']): ?>
                         <img src="<?= $item['imagem_url'] ?>" alt="<?= $item['titulo'] ?>" class="carrinho-img">
                       <?php else: ?>
                        <div class="carrinho-img" style="background: var(--background); display: flex; align-items: center; justify-content: center;">
                         <i class="fas fa-book" style="color: var(--text-muted);"></i>
                       </div>
                   <?php endif; ?>

                        <!-- Carrinho -->
                        <div id="carrinho" class="tab-content">
                            <h2>Meu Carrinho</h2>
                            <?php if(empty($carrinho)): ?>
                                <div class="text-center" style="padding: 3rem;">
                                    <i class="fas fa-shopping-cart" style="font-size: 3rem; color: var(--text-muted); margin-bottom: 1rem;"></i>
                                    <p style="color: var(--text-secondary);">Carrinho vazio.</p>
                                    <a href="categorias.php" class="btn btn-primary mt-2">Continuar Comprando</a>
                                </div>
                            <?php else: ?>
                                <div class="carrinho-lista">
                                    <?php 
                                    $total = 0;
                                    foreach($carrinho as $item): 
                                        $preco = 39.90;
                                        $subtotal = $item['quantidade'] * $preco;
                                        $total += $subtotal;
                                    ?>
                                    <div class="carrinho-item">
                                        <img src="img/<?= $item['titulo'] ?>.jpg" alt="<?= $item['titulo'] ?>" class="carrinho-img"
                                             onerror="this.src='data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iODAiIGhlaWdodD0iMTAwIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciPjxyZWN0IHdpZHRoPSIxMDAlIiBoZWlnaHQ9IjEwMCUiIGZpbGw9IiNmOGNlMTMiLz48dGV4dCB4PSI1MCUiIHk9IjUwJSIgZm9udC1mYW1pbHk9IkFyaWFsIiBmb250LXNpemU9IjEyIiBmaWxsPSIjMmMzODEwIiB0ZXh0LWFuY2hvcj0ibWlkZGxlIiBkb21pbmFudC1iYXNlbGluZT0ibWlkZGxlIj48dHNwYW4geD0iNTAlIiB5PSI1MCUiPsKeSuiBCb29rPC90c3Bhbj48L3RleHQ+PC9zdmc+'">
                                        <div class="carrinho-info">
                                            <h4><?= htmlspecialchars($item['titulo']) ?></h4>
                                            <p><?= htmlspecialchars($item['autor']) ?></p>
                                            <small><?= htmlspecialchars($item['genero']) ?></small>
                                        </div>
                                        <div class="carrinho-controles">
                                            <input type="number" value="<?= $item['quantidade'] ?>" min="1" class="quantidade-input" 
                                                   data-item="<?= $item['id_item'] ?>">
                                            <span class="precio" style="font-weight: 600;">R$ <?= number_format($subtotal, 2) ?></span>
                                        </div>
                                        <button class="btn btn-outline btn-small remover-carrinho" data-item="<?= $item['id_item'] ?>">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                    <?php endforeach; ?>
                                    
                                    <div class="carrinho-total">
                                        <strong style="font-size: 1.2rem;">Total: R$ <?= number_format($total, 2) ?></strong>
                                        <button class="btn btn-primary">Finalizar Compra</button>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div id="historico" class="tab-content">
                            <h2>Histórico de Empréstimos</h2>
                            <?php if(empty($emprestimos)): ?>
                                <div class="text-center" style="padding: 3rem;">
                                    <i class="fas fa-history" style="font-size: 3rem; color: var(--text-muted); margin-bottom: 1rem;"></i>
                                    <p style="color: var(--text-secondary);">Nenhum empréstimo registrado.</p>
                                </div>
                            <?php else: ?>
                                <div class="info-grid">
                                    <?php foreach($emprestimos as $emp): ?>
                                    <div class="info-item">
                                        <div class="info-label"><?= htmlspecialchars($emp['titulo']) ?></div>
                                        <div class="info-value"><?= htmlspecialchars($emp['autor']) ?></div>
                                        <div style="margin-top: 0.5rem;">
                                            <small>
                                                Emprestado em: <?= date('d/m/Y', strtotime($emp['data_emprestimo'])) ?><br>
                                                Devolução: <?= date('d/m/Y', strtotime($emp['data_entrega_prevista'])) ?>
                                            </small>
                                        </div>
                                    </div>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div id="config" class="tab-content">
                            <h2>Editar Perfil</h2>
                            <form method="POST">
                                <input type="hidden" name="atualizar_perfil" value="1">
                                
                                <div class="form-group">
                                    <label class="form-label">Nome Completo</label>
                                    <input type="text" name="nome" class="form-control" value="<?= htmlspecialchars($usuario['nome']) ?>" required>
                                </div>
                                
                                <div class="form-group">
                                    <label class="form-label">Telefone</label>
                                    <input type="tel" name="telefone" class="form-control" value="<?= htmlspecialchars($usuario['telefone'] ?? '') ?>">
                                </div>
                                
                                <div class="form-group">
                                    <label class="form-label">Biografia</label>
                                    <textarea name="biografia" class="form-control" rows="4" placeholder="Conte um pouco sobre você..."><?= htmlspecialchars($usuario['biografia'] ?? '') ?></textarea>
                                </div>
                                
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i> Salvar Alterações
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <?php include 'includes/footer.php'; ?>

    <script>
        document.querySelectorAll('.nav-pill').forEach(pill => {
            pill.addEventListener('click', function() {

                document.querySelectorAll('.nav-pill').forEach(p => p.classList.remove('active'));
                document.querySelectorAll('.tab-content').forEach(tab => tab.classList.remove('active'));
                
                this.classList.add('active');
                const tabId = this.getAttribute('data-tab');
                document.getElementById(tabId).classList.add('active');
            });
        });

        document.querySelectorAll('.quantidade-input').forEach(input => {
            input.addEventListener('change', function() {
                const itemId = this.getAttribute('data-item');
                const quantidade = this.value;
                
                console.log(`Atualizar item ${itemId} para quantidade ${quantidade}`);
            });
        });

        document.querySelectorAll('.remover-carrinho').forEach(btn => {
            btn.addEventListener('click', function() {
                const itemId = this.getAttribute('data-item');
                if (confirm('Tem certeza que deseja remover este item do carrinho?')) {
                    this.closest('.carrinho-item').remove();
                    console.log(`Remover item ${itemId} do carrinho`);
                }
            });
        });

        document.querySelectorAll('.remove-favorito').forEach(btn => {
            btn.addEventListener('click', function() {
                const livroId = this.getAttribute('data-livro');
                if (confirm('Tem certeza que deseja remover dos favoritos?')) {
                    this.closest('.card').remove();
                    console.log(`Remover livro ${livroId} dos favoritos`);
                }
            });
        });

        function openBookModal(livroId) {
            alert(`Abrindo detalhes do livro ID: ${livroId}`);
        }

        document.querySelector('.mobile-menu-btn')?.addEventListener('click', function() {
            const navLinks = document.querySelector('.nav-links');
            navLinks.style.display = navLinks.style.display === 'flex' ? 'none' : 'flex';
        });
    </script>
</body>
</html>