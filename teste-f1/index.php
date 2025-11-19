<?php
session_start();
include 'includes/conexao.php';

$livros_destaque = $pdo->query("
    SELECT LIVROS.*, 
           GROUP_CONCAT(AUTORES.nome SEPARATOR ', ') AS autores
    FROM LIVROS
    LEFT JOIN ESCRITO ON ESCRITO.id_livro = LIVROS.id_livro
    LEFT JOIN AUTORES ON AUTORES.id_autor = ESCRITO.id_autor
    GROUP BY LIVROS.id_livro
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

    <link rel="stylesheet" href="assets/css/estilo.css">

    <!-- CSS inline APENAS para ajustes necessários -->
    <style>
        .hero {
            padding: 6rem 2rem;
            text-align: center;
            background: linear-gradient(135deg, var(--blue-700), #000);
            color: white;
        }
        .hero-title {
            font-size: 3rem;
            margin-bottom: .7rem;
            font-weight: 700;
        }
        .hero-subtitle {
            font-size: 1.2rem;
            max-width: 700px;
            margin: 0 auto 2rem auto;
            opacity: .9;
        }
        .livro-img {
            width: 100%;
            height: 260px;
            object-fit: cover;
            border-radius: 10px;
            background: #222;
        }
    </style>
</head>

<body>

<?php include 'includes/header.php'; ?>

<main>

    <!-- HERO -->
    <section class="hero">
        <h1 class="hero-title">Descubra Mundos Extraordinários</h1>
        <p class="hero-subtitle">Explore livros de terror, suspense e fantasia selecionados especialmente para você.</p>
        <a href="categorias.php" class="btn btn-primary"><i class="fas fa-search"></i> Explorar Catálogo</a>
    </section>

    <!-- LIVROS EM DESTAQUE -->
    <section class="section">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Livros em Destaque</h2>
                <p class="section-subtitle">Seleção especial dos nossos títulos mais populares</p>
            </div>

            <?php if(empty($livros_destaque)): ?>
                <div class="text-center" style="padding: 3rem;">
                    <i class="fas fa-book" style="font-size: 3rem; color: gray;"></i>
                    <p>Nenhum livro cadastrado ainda.</p>

                    <?php if(isset($_SESSION['usuario_tipo']) && $_SESSION['usuario_tipo']=='admin'): ?>
                        <a href="admin/livros.php" class="btn btn-primary">Cadastrar Primeiro Livro</a>
                    <?php endif; ?>
                </div>
            <?php else: ?>

            <div class="grid grid-3">
                <?php foreach($livros_destaque as $livro): ?>
                <div class="card">

                    <!-- Imagem -->
                    <?php 
                    $img = $livro['imagem_url'] ?: "assets/img/placeholder.svg";
                    ?>
                    <img src="<?= $img ?>" class="livro-img"
                         alt="<?= htmlspecialchars($livro['titulo']) ?>">

                    <div class="card-body">
                        <h3 class="card-title"><?= htmlspecialchars($livro['titulo']) ?></h3>
                        <p class="card-text"><?= $livro['autores'] ?: "Autor desconhecido" ?></p>

                        <span class="badge badge-primary"><?= $livro['genero'] ?></span>
                        <small>• <?= $livro['ano_publicado'] ?></small>

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


    <!-- CATEGORIAS -->
    <section class="section" style="background: var(--background);">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Nossas Categorias</h2>
                <p class="section-subtitle">Explore por gêneros literários</p>
            </div>

            <div class="grid grid-3">
                <div class="card text-center">
                    <div style="font-size:3rem;">👻</div>
                    <h3>Terror</h3>
                    <p>Livros que provocam medo e tensão.</p>
                    <a href="terror.php" class="btn btn-primary">Explorar</a>
                </div>

                <div class="card text-center">
                    <div style="font-size:3rem;">🕵️</div>
                    <h3>Suspense</h3>
                    <p>Histórias cheias de mistério e reviravoltas.</p>
                    <a href="suspense.php" class="btn btn-primary">Explorar</a>
                </div>

                <div class="card text-center">
                    <div style="font-size:3rem;">✨</div>
                    <h3>Fantasia</h3>
                    <p>Aventuras épicas e mundos mágicos.</p>
                    <a href="fantasia.php" class="btn btn-primary">Explorar</a>
                </div>
            </div>

        </div>
    </section>

</main>

<?php include 'includes/footer.php'; ?>


<!-- MODAL -->
<div id="bookModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title">Detalhes do Livro</h3>
            <button class="modal-close" onclick="closeBookModal()">&times;</button>
        </div>
        <div id="modalBookContent" class="modal-body"></div>
    </div>
</div>


<script>
function openBookModal(id){
    document.getElementById('modalBookContent').innerHTML = `
        <div style="text-align:center;padding:2rem;">
            <i class="fas fa-book" style="font-size:4rem;color:var(--primary-main);"></i>
            <h4>Carregando dados do livro...</h4>
            <p>ID: ${id}</p>
        </div>
    `;
    document.getElementById('bookModal').classList.add('active');
}

function closeBookModal(){
    document.getElementById('bookModal').classList.remove('active');
}

document.getElementById('bookModal').addEventListener('click', e=>{
    if(e.target===e.currentTarget) closeBookModal();
});
</script>

</body>
</html>
