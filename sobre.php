<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sobre - Bibliotec</title>
    <link rel="stylesheet" href="assets/css/estilo.css">
</head>
<body>
    <?php include 'includes/header.php'; ?>

    <main>
        <section class="hero">
            <div class="container">
                <h1 class="hero-title">Sobre a Bibliotec</h1>
                <p class="hero-subtitle">Conheça mais sobre nossa missão, história e paixão por literatura</p>
            </div>
        </section>

        <section class="section">
            <div class="container">
                <div style="max-width: 800px; margin: 0 auto;">
                    <div class="about-text">
                        <p>A Bibliotec nasceu da paixão por histórias que mexem com a imaginação, o medo e o mistério. Fundada em 2025, nossa livraria online é dedicada exclusivamente aos gêneros fantasia, suspense e terror, trazendo uma seleção feita especialmente para quem ama se perder em mundos mágicos, sentir o frio na espinha ou desvendar segredos sombrios.</p>
                        
                        <p>Mais do que uma loja, somos um espaço criado para alimentar a curiosidade e o gosto pela leitura. Aqui, você encontra desde clássicos consagrados até os lançamentos mais aguardados, sempre com foco na qualidade e no poder que uma boa história tem de transformar o leitor.</p>
                    </div>

                    <div class="grid grid-2" style="margin: 3rem 0;">
                        <div class="card">
                            <div class="card-body">
                                <h3 style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 1rem;">
                                    <i class="fas fa-briefcase" style="color: var(--primary-main);"></i>
                                    Sobre o Trabalho
                                </h3>
                                <p>Este site é um trabalho da disciplina SW-I e IW-II, feito para aprendermos a criar um sistema completo usando PHP e MySQL. Ele funciona como uma biblioteca digital, focada nos gêneros terror, suspense e fantasia, unindo a prática de programação com um projeto literário.</p>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <h3 style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 1rem;">
                                    <i class="fas fa-users" style="color: var(--primary-main);"></i>
                                    Sobre Nós
                                </h3>
                                <p>Somos um grupo de estudantes da ETEC e este site é um trabalho da matéria SW-I regida pelo professor Anderson Vanin em 2025, feito pelos alunos do 2ºF:</p>
                                <ul style="margin-left: 1.5rem; margin-top: 0.5rem;">
                                    <li>Kevin Gabriel de Souza</li>
                                    <li>Ângelo Ivon Domingues Tenório de Almeida</li>
                                    <li>Anna Beatriz Surita Manuel</li>
                                    <li>Arthur André Prado da Silva</li>
                                    <li>Isabele Eduarda Oliveira Borges</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div style="text-align: center; margin-top: 3rem; padding: 2rem; background: var(--background); border-radius: 12px;">
                        <p style="font-size: 1.2rem; font-weight: 600; margin-bottom: 1.5rem;">
                            Junte-se a nós e venha ver os livros que temos disponíveis
                        </p>
                        <a href="categorias.php" class="btn btn-primary">
                            <i class="fas fa-search"></i>
                            Explorar Catálogo
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <?php include 'includes/footer.php'; ?>

    <script>
        // Menu mobile
        document.querySelector('.mobile-menu-btn')?.addEventListener('click', function() {
            const navLinks = document.querySelector('.nav-links');
            navLinks.style.display = navLinks.style.display === 'flex' ? 'none' : 'flex';
        });
    </script>
</body>
</html>