<?php
session_start();
include 'includes/conexao.php';

// DEFINIR O GÊNERO - ALTERAR PARA CADA CATEGORIA
$genero = 'comedia';

// Buscar livros da categoria
$livros_categoria = $pdo->prepare("
    SELECT * FROM LIVROS 
    WHERE genero LIKE ?
    ORDER BY titulo
");
$livros_categoria->execute(["%$genero%"]);
$livros = $livros_categoria->fetchAll();
?>
<!-- No loop, use: -->
<div class="grid grid-3">
    <?php foreach($livros as $livro): ?>
    <div class="card">
        <img src="<?= getImagemLivro($livro['imagem_url']) ?>" 
             alt="<?= htmlspecialchars($livro['titulo']) ?>" 
             class="card-img"
             onerror="this.src='data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjAwIiBoZWlnaHQ9IjMwMCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48cmVjdCB3aWR0aD0iMTAwJSIgaGVpZ2h0PSIxMDAlIiBmaWxsPSIjZjhjZTEzIi8+PHRleHQgeD0iNTAlIiB5PSI1MCUiIGZvbnQtZmFtaWx5PSJBcmlhbCIgZm9udC1zaXplPSIxOCIgZmlsbD0iIzJjMzgxMCIgdGV4dC1hbmNob3I9Im1pZGRsZSIgZG9taW5hbnQtYmFzZWxpbmU9Im1pZGRsZSI+PGtici8+PGtici8+PGtici8+PGtici8+PGtici8+PGtici8Pjx0c3BhbiB4PSI1ACUiIHk9IjUwJSI+8J+SuiBCb29rPC90c3Bhbj48L3RleHQ+PC9zdmc+'">
        <div class="card-body">
            <!-- resto do código -->
        </div>
    </div>
    <?php endforeach; ?>
</div>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comédia - Bibliotec</title>
    <link rel="stylesheet" href="assets/css/estilo.css">
</head>
<body>
    <?php include 'includes/header.php'; ?>

    <main>
        <section class="section">
            <div class="container">
                <div class="section-header">
                    <h2 class="section-title">Livros de Comédia</h2>
                    <p class="section-subtitle">Histórias hilárias, situações engraçadas e muito humor</p>
                </div>
                
                <?php if(empty($livros)): ?>
                    <div class="text-center" style="padding: 3rem;">
                        <i class="fas fa-laugh" style="font-size: 3rem; color: var(--text-muted); margin-bottom: 1rem;"></i>
                        <p style="color: var(--text-secondary);">Nenhum livro de comédia cadastrado ainda.</p>
                        <?php if(isset($_SESSION['usuario_tipo']) && $_SESSION['usuario_tipo'] == 'admin'): ?>
                            <a href="admin/livros.php" class="btn btn-primary mt-2">Cadastrar Livros de Comédia</a>
                        <?php endif; ?>
                    </div>
                <?php else: ?>
                    <div class="grid grid-3">
                        <?php foreach($livros as $livro): ?>
                              <div class="card">
                   <?php if($livro['imagem_url']): ?>
                 <img src="<?= $livro['imagem_url'] ?>" alt="<?= $livro['titulo'] ?>" class="card-img">
                   <?php else: ?>
                      <img src="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjAwIiBoZWlnaHQ9IjMwMCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48cmVjdCB3aWR0aD0iMTAwJSIgaGVpZ2h0PSIxMDAlIiBmaWxsPSIjZjhjZTEzIi8+PHRleHQgeD0iNTAlIiB5PSI1MCUiIGZvbnQtZmFtaWx5PSJBcmlhbCIgZm9udC1zaXplPSIxOCIgZmlsbD0iIzJjMzgxMCIgdGV4dC1hbmNob3I9Im1pZGRsZSIgZG9taW5hbnQtYmFzZWxpbmU9Im1pZGRsZSI+PGtici8+PGtici8+PGtici8+PGtici8+PGtici8+PGtici8Pjx0c3BhbiB4PSI1MCUiIHk9IjUwJSI+8J+SuiBCb29rPC90c3Bhbj48L3RleHQ+PC9zdmc+" 
                      alt="Sem imagem" class="card-img">
                          <?php endif; ?>
                      <div class="card-body"></div>
                        <div class="card">
                            <img src="img/<?= $livro['titulo'] ?>.jpg" alt="<?= $livro['titulo'] ?>" class="card-img"
                                 onerror="this.src='data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjAwIiBoZWlnaHQ9IjMwMCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48cmVjdCB3aWR0aD0iMTAwJSIgaGVpZ2h0PSIxMDAlIiBmaWxsPSIjZmZjMTA3Ii8+PHRleHQgeD0iNTAlIiB5PSI1MCUiIGZvbnQtZmFtaWx5PSJBcmlhbCIgZm9udC1zaXplPSIxOCIgZmlsbD0iIzFhMWExYSIgdGV4dC1hbmNob3I9Im1pZGRsZSIgZG9taW5hbnQtYmFzZWxpbmU9Im1pZGRsZSI+PGtici8+PGtici8+PGtici8+PGtici8+PGtici8+PGtici8Pjx0c3BhbiB4PSI1MCUiIHk9IjUwJSI+8J+agCBDb23DqWRpYTwvdHNwYW4+PC90ZXh0Pjwvc3ZnPg=='">
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
                                        <button class="btn btn-outline btn-small cart-btn" data-livro="<?= $livro['id_livro'] ?>">
                                            <i class="fas fa-cart-plus"></i>
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

        <!-- Sobre o Gênero -->
        <section class="section" style="background: var(--background);">
            <div class="container">
                <div class="grid grid-2">
                    <div>
                        <h3>Sobre o Gênero Comédia</h3>
                        <p>A comédia na literatura busca entreter através do humor, situações engraçadas e personagens cômicos. Pode variar da sátira social ao humor absurdo, sempre com o objetivo de fazer o leitor rir.</p>
                        <p><strong>Características principais:</strong></p>
                        <ul>
                            <li>Humor e situações engraçadas</li>
                            <li>Diálogos espirituosos e inteligentes</li>
                            <li>Personagens excêntricos e caricatos</li>
                            <li>Final feliz e resolvido</li>
                        </ul>
                    </div>
                    <div>
                        <h3>Autores Humorísticos</h3>
                        <div class="card">
                            <div class="card-body">
                                <h4>Mark Twain</h4>
                                <p>Mestre do humor americano, autor de "As Aventuras de Tom Sawyer".</p>
                            </div>
                        </div>
                        <div class="card mt-2">
                            <div class="card-body">
                                <h4>Douglas Adams</h4>
                                <p>Criador da série "O Guia do Mochileiro das Galáxias".</p>
                            </div>
                        </div>
                        <div class="card mt-2">
                            <div class="card-body">
                                <h4>Terry Pratchett</h4>
                                <p>Autor da aclamada série "Discworld" (Mundo Disco).</p>
                            </div>
                        </div>
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
                <div style="text-align: center; padding: 1rem;">
                    <i class="fas fa-laugh" style="font-size: 4rem; color: var(--primary-main); margin-bottom: 1rem;"></i>
                    <h4>Detalhes do Livro de Comédia</h4>
                    <p>ID do livro: ${livroId}</p>
                    <p>Em uma implementação completa, aqui viriam os detalhes completos do livro buscados do banco de dados.</p>
                    <div class="grid grid-2" style="margin: 1.5rem 0;">
                        <div class="text-left">
                            <p><strong>Autor:</strong> A ser carregado</p>
                            <p><strong>Ano:</strong> A ser carregado</p>
                            <p><strong>Páginas:</strong> A ser carregado</p>
                        </div>
                        <div class="text-left">
                            <p><strong>Editora:</strong> A ser carregado</p>
                            <p><strong>Gênero:</strong> Comédia</p>
                            <p><strong>Preço:</strong> R$ 39,90</p>
                        </div>
                    </div>
                    <div style="margin-top: 1.5rem;">
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
                    alert('Livro adicionado aos favoritos!');
                } else {
                    icon.classList.remove('fas');
                    icon.classList.add('far');
                    this.style.color = '';
                    console.log(`Remover livro ${livroId} dos favoritos`);
                    alert('Livro removido dos favoritos!');
                }
            });
        });

        // Adicionar ao carrinho
        document.querySelectorAll('.cart-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const livroId = this.getAttribute('data-livro');
                console.log(`Adicionar livro ${livroId} ao carrinho`);
                alert('Livro adicionado ao carrinho!');
            });
        });

        // Menu mobile
        document.querySelector('.mobile-menu-btn')?.addEventListener('click', function() {
            const navLinks = document.querySelector('.nav-links');
            navLinks.style.display = navLinks.style.display === 'flex' ? 'none' : 'flex';
        });
    </script>
</body>
</html>