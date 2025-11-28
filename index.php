<?php
session_start();
include 'includes/conexao.php';

// Buscar livros em destaque
$livros_destaque = $pdo->query("
    SELECT * FROM LIVROS 
    ORDER BY id_livro DESC 
    LIMIT 6
")->fetchAll();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bibliotec - Biblioteca Digital</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/estilo.css">
</head>
<body>
    <?php include 'includes/header.php'; ?>

    <main>
        <!-- Hero Section -->
        <section class="hero">
            <div class="container">
                <h1 class="hero-title">Descubra Mundos Extraordinários</h1>
                <p class="hero-subtitle">Explore nossa coleção curada de livros de terror, suspense e fantasia. Histórias que vão te transportar para universos inesquecíveis.</p>
                <a href="categorias.php" class="btn btn-primary">
                    <i class="fas fa-search"></i>
                    Explorar Catálogo
                </a>
            </div>
        </section>

        <!-- Livros em Destaque -->
        <section class="section">
            <div class="container">
                <div class="section-header">
                    <h2 class="section-title">Livros em Destaque</h2>
                    <p class="section-subtitle">Seleção especial dos nossos títulos mais populares</p>
                </div>
                
                <?php if(empty($livros_destaque)): ?>
                    <div class="text-center" style="padding: 3rem;">
                        <i class="fas fa-book" style="font-size: 3rem; color: var(--text-muted); margin-bottom: 1rem;"></i>
                        <p style="color: var(--text-secondary);">Nenhum livro cadastrado ainda.</p>
                        <?php if(isset($_SESSION['usuario_tipo']) && $_SESSION['usuario_tipo'] == 'admin'): ?>
                            <a href="admin/livros.php" class="btn btn-primary mt-2">Cadastrar Primeiro Livro</a>
                        <?php endif; ?>
                    </div>
                <?php else: ?>
                    <div class="grid grid-3">
                        <?php foreach($livros_destaque as $livro): ?>
                            <div class="card">
                                <?php if($livro['imagem_url']): ?>
                                    <img src="<?= $livro['imagem_url'] ?>" alt="<?= htmlspecialchars($livro['titulo']) ?>" class="card-img">
                                <?php else: ?>
                                    <img src="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjAwIiBoZWlnaHQ9IjMwMCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48cmVjdCB3aWR0aD0iMTAwJSIgaGVpZ2h0PSIxMDAlIiBmaWxsPSIjZjhjZTEzIi8+PHRleHQgeD0iNTAlIiB5PSI1MCUiIGZvbnQtZmFtaWx5PSJBcmlhbCIgZm9udC1zaXplPSIxOCIgZmlsbD0iIzJjMzgxMCIgdGV4dC1hbmNob3I9Im1pZGRsZSIgZG9taW5hbnQtYmFzZWxpbmU9Im1pZGRsZSI+PGtici8+PGtici8+PGtici8+PGtici8+PGtici8+PGtici8Pjx0c3BhbiB4PSI1MCUiIHk9IjUwJSI+8J+SuiBCb29rPC90c3Bhbj48L3RleHQ+PC9zdmc+" 
                                         alt="Sem imagem" class="card-img">
                                <?php endif; ?>
                                <div class="card-body">
                                    <h3 class="card-title"><?= htmlspecialchars($livro['titulo']) ?></h3>
                                    <p class="card-text"><?= htmlspecialchars($livro['autor']) ?></p>
                                    <p class="card-text">
                                        <span class="badge badge-primary"><?= htmlspecialchars($livro['genero']) ?></span>
                                        <small>• <?= $livro['ano_publicado'] ?></small>
                                    </p>
                                    <div class="card-actions">
                                        <button class="btn btn-primary btn-small" onclick="openBookModal(<?= $livro['id_livro'] ?>)">
                                            Ver Detalhes
                                        </button>
                                        <?php if(isset($_SESSION['usuario_id'])): ?>
                                            <button class="btn btn-outline btn-small favorite-btn" data-livro="<?= $livro['id_livro'] ?>">
                                                <i class="far fa-heart"></i>
                                            </button>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </section>

        <!-- Categorias -->
        <section class="section" style="background: var(--background);">
            <div class="container">
                <div class="section-header">
                    <h2 class="section-title">Nossas Categorias</h2>
                    <p class="section-subtitle">Explore por gêneros literários</p>
                </div>
                
                <div class="grid grid-3">
                    <div class="card text-center">
                        <div style="font-size: 3rem; margin-bottom: 1rem;">👻</div>
                        <h3 class="card-title">Terror</h3>
                        <p class="card-text">Livros que provocam medo e suspense, do sobrenatural ao psicológico.</p>
                        <a href="terror.php" class="btn btn-primary">Explorar</a>
                    </div>
                    
                    <div class="card text-center">
                        <div style="font-size: 3rem; margin-bottom: 1rem;">🕵️</div>
                        <h3 class="card-title">Suspense</h3>
                        <p class="card-text">Narrativas cheias de tensão, mistério e reviravoltas inesperadas.</p>
                        <a href="suspense.php" class="btn btn-primary">Explorar</a>
                    </div>
                    
                    <div class="card text-center">
                        <div style="font-size: 3rem; margin-bottom: 1rem;">✨</div>
                        <h3 class="card-title">Fantasia</h3>
                        <p class="card-text">Mundos mágicos, criaturas fantásticas e aventuras épicas.</p>
                        <a href="fantasia.php" class="btn btn-primary">Explorar</a>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <?php include 'includes/footer.php'; ?>

    <!-- Modal de Detalhes do Livro -->
    <div id="bookModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Detalhes do Livro</h3>
                <button class="modal-close" onclick="closeBookModal()">&times;</button>
            </div>
            <div class="modal-body">
                <div id="modalBookContent">
                    <!-- Conteúdo carregado via JavaScript -->
                </div>
            </div>
        </div>
    </div>

    <script>
        // Funções do Modal
        function openBookModal(livroId) {
            const modalContent = `
                <div style="text-align: center; padding: 2rem;">
                    <i class="fas fa-book" style="font-size: 4rem; color: var(--primary-main); margin-bottom: 1rem;"></i>
                    <h4>Detalhes do Livro</h4>
                    <p>ID do livro: ${livroId}</p>
                    <p>Em uma implementação completa, aqui viriam os detalhes do livro buscados do banco de dados.</p>
                    <div style="margin-top: 2rem;">
                        <button class="btn btn-primary">Adicionar ao Carrinho</button>
                        <button class="btn btn-outline" onclick="closeBookModal()">Fechar</button>
                    </div>
                </div>
            `;
            
            document.getElementById('modalBookContent').innerHTML = modalContent;
            document.getElementById('bookModal').classList.add('active');
        }

        function closeBookModal() {
            document.getElementById('bookModal').classList.remove('active');
        }

        // Fechar modal ao clicar fora
        document.getElementById('bookModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeBookModal();
            }
        });

        // Favoritar livro
        document.querySelectorAll('.favorite-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const livroId = this.getAttribute('data-livro');
                const icon = this.querySelector('i');
                
                if (icon.classList.contains('far')) {
                    icon.classList.remove('far');
                    icon.classList.add('fas');
                    this.style.color = 'var(--error)';
                    console.log(`Adicionar livro ${livroId} aos favoritos`);
                } else {
                    icon.classList.remove('fas');
                    icon.classList.add('far');
                    this.style.color = '';
                    console.log(`Remover livro ${livroId} dos favoritos`);
                }
            });
        });

        // Menu mobile
        document.querySelector('.mobile-menu-btn')?.addEventListener('click', function() {
            const navLinks = document.querySelector('.nav-links');
            if (navLinks.style.display === 'flex') {
                navLinks.style.display = 'none';
            } else {
                navLinks.style.display = 'flex';
            }
        });
    </script>
</body>
</html>