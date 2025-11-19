<?php
session_start();
include 'includes/conexao.php';

// Buscar livros em destaque
try {
    $livros_destaque = $pdo->query("
        SELECT 
            l.*, 
            GROUP_CONCAT(a.nome ORDER BY a.nome SEPARATOR ', ') AS autores,
            COALESCE(COUNT(f.id_livro), 0) AS total_favoritos
        FROM LIVROS l
        LEFT JOIN ESCRITO e ON e.id_livro = l.id_livro
        LEFT JOIN AUTORES a ON a.id_autor = e.id_autor
        LEFT JOIN FAVORITOS f ON f.id_livro = l.id_livro
        GROUP BY l.id_livro
        ORDER BY l.total_favoritos DESC, l.id_livro DESC
        LIMIT 8
    ")->fetchAll();
} catch (Exception $e) {
    error_log($e->getMessage());
    $livros_destaque = [];
}

// Buscar estatísticas
try {
    $total_livros = $pdo->query("SELECT COUNT(*) FROM LIVROS")->fetchColumn();
    $total_autores = $pdo->query("SELECT COUNT(*) FROM AUTORES")->fetchColumn();
    $total_generos = $pdo->query("SELECT COUNT(DISTINCT genero) FROM LIVROS")->fetchColumn();
} catch (Exception $e) {
    error_log($e->getMessage());
    $total_livros = 0;
    $total_autores = 0;
    $total_generos = 3;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Bibliotec - Sua biblioteca digital especializada em terror, suspense e fantasia. Leia online ou baixe gratuitamente os melhores títulos.">
    <meta name="author" content="Seu Nome - TCC 2025">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:title" content="Bibliotec - Biblioteca Digital de Terror, Suspense e Fantasia">
    <meta property="og:description" content="Explore centenas de livros digitais gratuitos nos gêneros mais emocionantes da literatura.">
    <meta property="og:image" content="assets/img/og-image.jpg">
    <meta property="og:url" content="https://seusite.com">
    <meta property="og:site_name" content="Bibliotec">

    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Bibliotec - Biblioteca Digital">
    <meta name="twitter:description" content="Terror, suspense e fantasia em um só lugar. Leia agora!">
    <meta name="twitter:image" content="assets/img/og-image.jpg">

    <title>Bibliotec - Biblioteca Digital de Terror, Suspense e Fantasia</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/estilo.css">
    <link rel="stylesheet" href="assets/css/modal.css">

    <style>
        :root {
            --primary: #6366f1;
            --primary-dark: #4f46e5;
            --text: #e2e8f0;
            --background: #0f172a;
            --card-bg: #1e293b;
        }

        body { 
            font-family: 'Inter', sans-serif; 
            background: var(--background); 
            color: var(--text); 
            line-height: 1.6; 
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1rem;
        }

        .grid {
            display: grid;
            gap: 2rem;
        }

        .grid-4 {
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        }

        .grid-3 {
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        }

        .text-center {
            text-align: center;
        }

        .hero {
            position: relative;
            min-height: 90vh;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            background: linear-gradient(135deg, #1e1b4b 0%, #000000 100%);
            color: white;
            overflow: hidden;
        }

        .hero::before {
            content: '';
            position: absolute;
            inset: 0;
            background: rgba(0,0,0,0.6);
            z-index: 1;
        }

        .hero-content {
            position: relative;
            z-index: 2;
            max-width: 900px;
            padding: 2rem;
            animation: fadeUp 1s ease-out;
        }

        .hero-title {
            font-family: 'Playfair Display', serif;
            font-size: clamp(2.5rem, 8vw, 5rem);
            font-weight: 700;
            margin-bottom: 1rem;
            background: linear-gradient(90deg, #fff, #c7d2fe);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            line-height: 1.1;
        }

        .hero-subtitle {
            font-size: 1.3rem;
            margin-bottom: 2.5rem;
            opacity: 0.95;
            max-width: 700px;
            margin-left: auto;
            margin-right: auto;
        }

        .btn {
            display: inline-block;
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-align: center;
        }

        .btn-cta {
            background: var(--primary);
            color: white;
            padding: 1rem 2.5rem;
            font-size: 1.1rem;
            font-weight: 600;
            border-radius: 50px;
            transition: all 0.3s ease;
            box-shadow: 0 10px 30px rgba(99, 102, 241, 0.4);
        }

        .btn-cta:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(99, 102, 241, 0.6);
            background: var(--primary-dark);
        }

        .btn-primary {
            background: var(--primary);
            color: white;
        }

        .btn-outline {
            background: transparent;
            color: var(--text);
            border: 2px solid var(--primary);
        }

        .btn-small {
            padding: 0.5rem 1rem;
            font-size: 0.9rem;
        }

        .flex-grow {
            flex: 1;
        }

        .section { 
            padding: 5rem 0; 
        }

        .section-header { 
            text-align: center; 
            margin-bottom: 4rem; 
        }

        .section-title {
            font-family: 'Playfair Display', serif;
            font-size: 2.8rem;
            margin-bottom: 1rem;
            color: #e0e7ff;
        }

        .section-subtitle {
            font-size: 1.1rem;
            color: #94a3b8;
            max-width: 600px;
            margin: 0 auto;
        }

        .card {
            background: var(--card-bg);
            border-radius: 16px;
            overflow: hidden;
            transition: all 0.4s ease;
            box-shadow: 0 4px 20px rgba(0,0,0,0.3);
        }

        .card:hover {
            transform: translateY(-12px);
            box-shadow: 0 20px 40px rgba(99, 102, 241, 0.2);
        }

        .livro-img {
            width: 100%;
            height: 320px;
            object-fit: cover;
            background: #333;
        }

        .card-body { 
            padding: 1.5rem; 
        }

        .card-title {
            font-size: 1.4rem;
            margin: 0 0 0.5rem 0;
            color: #eef2ff;
            font-weight: 600;
        }

        .card-text {
            margin-bottom: 1rem;
        }

        .text-muted {
            color: #94a3b8;
        }

        .favorite-count {
            font-size: 0.85rem;
            color: #94a3b8;
            margin-top: 0.5rem;
        }

        .badge {
            background: var(--primary);
            color: white;
            padding: 0.4rem 0.9rem;
            border-radius: 50px;
            font-size: 0.8rem;
            font-weight: 500;
            display: inline-block;
        }

        .stats-bar {
            background: rgba(99, 102, 241, 0.1);
            padding: 3rem 0;
            text-align: center;
            margin: 4rem 0;
        }

        .stat-number {
            font-size: 3rem;
            font-weight: 700;
            color: var(--primary);
            font-family: 'Playfair Display', serif;
        }

        .card-actions {
            display: flex;
            gap: 0.75rem;
            margin-top: 1.5rem;
        }

        @keyframes fadeUp {
            from { 
                opacity: 0; 
                transform: translateY(40px); 
            }
            to { 
                opacity: 1; 
                transform: translateY(0); 
            }
        }

        @media (max-width: 768px) {
            .grid-3, .grid-4 { 
                grid-template-columns: 1fr; 
            }
            .hero { 
                min-height: 80vh; 
            }
            .section {
                padding: 3rem 0;
            }
        }
    </style>
</head>
<body>

<?php include 'includes/header.php'; ?>

<main>

    <!-- HERO PRINCIPAL -->
    <section class="hero" aria-labelledby="hero-title">
        <div class="hero-content">
            <h1 id="hero-title" class="hero-title">Descubra Mundos<br>Extraordinários</h1>
            <p class="hero-subtitle">
                A maior biblioteca digital brasileira especializada em <strong>terror psicológico</strong>, 
                <strong>suspense investigativo</strong> e <strong>fantasia épica</strong>.
            </p>
            <a href="catalogo.php" class="btn btn-cta">
                <i class="fas fa-book-open"></i> Explorar Catálogo Completo
            </a>
        </div>
    </section>

    <!-- ESTATÍSTICAS -->
    <section class="stats-bar">
        <div class="container grid grid-4">
            <div>
                <div class="stat-number"><?= $total_livros ?></div>
                <p>Livros Disponíveis</p>
            </div>
            <div>
                <div class="stat-number"><?= $total_generos ?></div>
                <p>Gêneros Principais</p>
            </div>
            <div>
                <div class="stat-number"><?= $total_autores ?></div>
                <p>Autores Cadastrados</p>
            </div>
            <div>
                <div class="stat-number">24/7</div>
                <p>Acesso Ilimitado</p>
            </div>
        </div>
    </section>

    <!-- LIVROS EM DESTAQUE -->
    <section class="section" id="destaques">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Livros em Destaque</h2>
                <p class="section-subtitle">Os títulos mais populares e bem avaliados da comunidade</p>
            </div>

            <?php if (empty($livros_destaque)): ?>
                <div class="text-center" style="padding: 4rem;">
                    <i class="fas fa-book-open" style="font-size: 4rem; color: #475569; margin-bottom: 1rem;"></i>
                    <h3>Nenhum livro cadastrado ainda</h3>
                    <p>O acervo está sendo construído. Volte em breve!</p>
                    <?php if (isset($_SESSION['usuario_tipo']) && $_SESSION['usuario_tipo'] === 'admin'): ?>
                        <a href="admin/livros.php" class="btn btn-primary" style="margin-top: 1rem;">
                            <i class="fas fa-plus"></i> Cadastrar Primeiro Livro
                        </a>
                    <?php endif; ?>
                </div>
            <?php else: ?>
                <div class="grid grid-4">
                    <?php foreach ($livros_destaque as $livro): ?>
                        <article class="card" aria-labelledby="livro-<?= $livro['id_livro'] ?>">
                            <img 
                                src="<?= htmlspecialchars($livro['imagem_url'] ?: 'assets/img/placeholder.jpg') ?>" 
                                alt="Capa do livro <?= htmlspecialchars($livro['titulo']) ?>" 
                                class="livro-img"
                                loading="lazy"
                                onerror="this.src='assets/img/placeholder.jpg'">

                            <div class="card-body">
                                <h3 id="livro-<?= $livro['id_livro'] ?>" class="card-title">
                                    <?= htmlspecialchars($livro['titulo']) ?>
                                </h3>
                                <p class="card-text text-muted">
                                    por <?= $livro['autores'] ? htmlspecialchars($livro['autores']) : 'Autor desconhecido' ?>
                                </p>

                                <div style="margin: 1rem 0;">
                                    <span class="badge"><?= htmlspecialchars($livro['genero']) ?></span>
                                    <small class="text-muted" style="margin-left: 0.5rem;">• <?= $livro['ano_publicado'] ?></small>
                                </div>

                                <?php if ($livro['total_favoritos'] > 0): ?>
                                    <div class="favorite-count">
                                        <i class="fas fa-heart" style="color:#f43f5e;"></i>
                                        <?= $livro['total_favoritos'] ?> pessoa<?= $livro['total_favoritos'] > 1 ? 's' : '' ?> favoritaram
                                    </div>
                                <?php endif; ?>

                                <div class="card-actions">
                                    <button class="btn btn-primary btn-small flex-grow" onclick="openBookModal(<?= $livro['id_livro'] ?>)">
                                        Ver Detalhes
                                    </button>

                                    <?php if (isset($_SESSION['usuario_id'])): ?>
                                        <button class="btn btn-outline btn-small favorite-btn" 
                                                data-livro="<?= $livro['id_livro'] ?>" 
                                                title="Adicionar aos favoritos"
                                                onclick="toggleFavorito(<?= $livro['id_livro'] ?>, this)">
                                            <i class="far fa-heart"></i>
                                        </button>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </article>
                    <?php endforeach; ?>
                </div>

                <div class="text-center" style="margin-top: 3rem;">
                    <a href="catalogo.php" class="btn btn-outline" style="padding: 1rem 2rem; font-size:1.1rem;">
                        Ver Todos os Livros →
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <!-- CATEGORIAS -->
    <section class="section" style="background: #0b1120;">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Explore por Gênero</h2>
                <p class="section-subtitle">Navegue pelas categorias mais populares da Bibliotec</p>
            </div>

            <div class="grid grid-3">
                <a href="catalogo.php?genero=terror" class="card text-center" style="text-decoration:none; color:inherit; padding: 2rem;">
                    <div style="font-size:5rem; margin-bottom:1rem; color: #dc2626;">👻</div>
                    <h3>Terror & Horror</h3>
                    <p class="text-muted">Histórias que gelam a espinha e desafiam a sanidade.</p>
                </a>

                <a href="catalogo.php?genero=suspense" class="card text-center" style="text-decoration:none; color:inherit; padding: 2rem;">
                    <div style="font-size:5rem; margin-bottom:1rem; color: #2563eb;">🕵️</div>
                    <h3>Suspense & Mistério</h3>
                    <p class="text-muted">Enigmas, investigações e reviravoltas imprevisíveis.</p>
                </a>

                <a href="catalogo.php?genero=fantasia" class="card text-center" style="text-decoration:none; color:inherit; padding: 2rem;">
                    <div style="font-size:5rem; margin-bottom:1rem; color: #7c3aed;">✨</div>
                    <h3>Fantasia Épica</h3>
                    <p class="text-muted">Mundos mágicos, dragões e profecias ancestrais.</p>
                </a>
            </div>
        </div>
    </section>

</main>

<?php include 'includes/footer.php'; ?>

<!-- Modal de Detalhes do Livro -->
<div id="bookModal" class="modal" role="dialog" aria-modal="true" aria-labelledby="modal-title">
    <div class="modal-content" style="max-width: 900px; margin: 2rem auto; background: var(--card-bg); border-radius: 16px;">
        <div class="modal-header" style="padding: 1.5rem 2rem; border-bottom: 1px solid #334155; display: flex; justify-content: between; align-items: center;">
            <h3 id="modal-title" class="modal-title" style="margin: 0; font-size: 1.5rem;">Carregando...</h3>
            <button class="modal-close" onclick="closeBookModal()" aria-label="Fechar modal" style="background: none; border: none; color: var(--text); font-size: 1.5rem; cursor: pointer;">×</button>
        </div>
        <div id="modalBookContent" class="modal-body" style="padding: 2rem;">
            <div style="text-align:center; padding:4rem 2rem;">
                <i class="fas fa-spinner fa-spin" style="font-size:3rem; color:var(--primary);"></i>
                <p style="margin-top:1rem;">Carregando detalhes do livro...</p>
            </div>
        </div>
    </div>
</div>

<script>
// Funções do Modal
function openBookModal(id) {
    fetch(`ajax/livro_detalhes.php?id=${id}`)
        .then(response => {
            if (!response.ok) throw new Error('Erro na requisição');
            return response.text();
        })
        .then(html => {
            document.getElementById('modalBookContent').innerHTML = html;
            document.getElementById('modal-title').textContent = 'Detalhes do Livro';
        })
        .catch(error => {
            console.error('Erro:', error);
            document.getElementById('modalBookContent').innerHTML = 
                '<p style="text-align:center;padding:2rem;color:#ef4444;">Erro ao carregar os detalhes do livro.</p>';
        });

    document.getElementById('bookModal').style.display = 'flex';
    document.body.style.overflow = 'hidden';
}

function closeBookModal() {
    document.getElementById('bookModal').style.display = 'none';
    document.body.style.overflow = 'auto';
}

// Função para favoritar livros
function toggleFavorito(livroId, button) {
    if (!<?= isset($_SESSION['usuario_id']) ? 'true' : 'false' ?>) {
        alert('Você precisa estar logado para favoritar livros.');
        return;
    }

    const formData = new FormData();
    formData.append('livro_id', livroId);

    fetch('ajax/toggle_favorito.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            const icon = button.querySelector('i');
            if (data.favoritado) {
                icon.className = 'fas fa-heart';
                icon.style.color = '#f43f5e';
            } else {
                icon.className = 'far fa-heart';
                icon.style.color = '';
            }
            // Recarregar a página para atualizar contadores
            location.reload();
        } else {
            alert('Erro ao favoritar: ' + (data.message || 'Erro desconhecido'));
        }
    })
    .catch(error => {
        console.error('Erro:', error);
        alert('Erro ao comunicar com o servidor.');
    });
}

// Fechar modal ao clicar fora
document.getElementById('bookModal').addEventListener('click', function(e) {
    if (e.target === this) closeBookModal();
});

// Fechar modal com ESC
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') closeBookModal();
});

// Estilo do modal
document.addEventListener('DOMContentLoaded', function() {
    const modalStyle = document.createElement('style');
    modalStyle.textContent = `
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.8);
            z-index: 1000;
            align-items: center;
            justify-content: center;
            padding: 1rem;
        }
        
        .modal.active {
            display: flex;
        }
    `;
    document.head.appendChild(modalStyle);
});
</script>

</body>
</html>