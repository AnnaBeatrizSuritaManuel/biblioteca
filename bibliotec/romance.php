<?php
session_start();
include 'includes/conexao.php';
include 'includes/function.php'; 

// DEFINIR O GÊNERO - ALTERAR PARA CADA CATEGORIA
$genero = 'romance'; 

// Buscar livros da categoria
$livros_categoria = $pdo->prepare("
    SELECT * FROM LIVROS 
    WHERE genero LIKE ?
    ORDER BY titulo
");
$livros_categoria->execute(["%$genero%"]);
$livros = $livros_categoria->fetchAll();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Romance - Bibliotec</title>
    <link rel="stylesheet" href="assets/css/estilo.css">
</head>
<body>
    <?php include 'includes/header.php'; ?>

    <main>
        <section class="section">
            <div class="container">
                <div class="section-header">
                    <h2 class="section-title">Livros de Romance</h2>
                    <p class="section-subtitle">Histórias de amor, paixão e relacionamentos emocionantes</p>
                </div>
                
                <?php if(empty($livros)): ?>
                    <div class="text-center" style="padding: 3rem;">
                        <i class="fas fa-heart" style="font-size: 3rem; color: var(--text-muted); margin-bottom: 1rem;"></i>
                        <p style="color: var(--text-secondary);">Nenhum livro de romance cadastrado ainda.</p>
                        <?php if(isset($_SESSION['usuario_tipo']) && $_SESSION['usuario_tipo'] == 'admin'): ?>
                            <a href="admin/livros.php" class="btn btn-primary mt-2">Cadastrar Livros de Romance</a>
                        <?php endif; ?>
                    </div>
<?php else: ?>
    <div class="grid grid-3">
        <?php foreach($livros as $livro): ?>
            <div class="card">
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
                        <h3>Sobre o Gênero Romance</h3>
                        <p>O romance é um dos gêneros mais populares da literatura, focando em relacionamentos amorosos e desenvolvimento emocional dos personagens. Pode variar de histórias leves e divertidas a dramas intensos.</p>
                        <p><strong>Características principais:</strong></p>
                        <ul>
                            <li>Histórias de amor e paixão</li>
                            <li>Desenvolvimento de relacionamentos</li>
                            <li>Conflitos emocionais e superação</li>
                            <li>Final feliz (na maioria dos casos)</li>
                        </ul>
                    </div>
                    <div>
                        <h3>Autores Destacados</h3>
                        <div class="card">
                            <div class="card-body">
                                <h4>Jane Austen</h4>
                                <p>Autora clássica de "Orgulho e Preconceito" e "Razão e Sensibilidade".</p>
                            </div>
                        </div>
                        <div class="card mt-2">
                            <div class="card-body">
                                <h4>Nicholas Sparks</h4>
                                <p>Mestre do romance contemporâneo, autor de "Diário de uma Paixão".</p>
                            </div>
                        </div>
                        <div class="card mt-2">
                            <div class="card-body">
                                <h4>Colleen Hoover</h4>
                                <p>Fenômeno do BookTok, autora de "É Assim que Acaba" e outras obras.</p>
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

                </div>
            </div>
        </div>
    </div>

    <script>
        function openBookModal(livroId) {
            const modalContent = `
                <div style="text-align: center; padding: 1rem;">
                    <i class="fas fa-heart" style="font-size: 4rem; color: var(--primary-main); margin-bottom: 1rem;"></i>
                    <h4>Detalhes do Livro de Romance</h4>
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
                            <p><strong>Gênero:</strong> Romance</p>
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

        document.getElementById('bookModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeBookModal();
            }
        });

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

        document.querySelectorAll('.cart-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const livroId = this.getAttribute('data-livro');
                console.log(`Adicionar livro ${livroId} ao carrinho`);
                alert('Livro adicionado ao carrinho!');
            });
        });

        document.querySelector('.mobile-menu-btn')?.addEventListener('click', function() {
            const navLinks = document.querySelector('.nav-links');
            navLinks.style.display = navLinks.style.display === 'flex' ? 'none' : 'flex';
        });
    </script>
</body>
</html>