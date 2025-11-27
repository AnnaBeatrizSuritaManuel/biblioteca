<?php
session_start();
include 'includes/conexao.php';
// REMOVER: include 'includes/function.php'; // Não é necessário aqui

// Este arquivo só mostra as categorias, não precisa buscar livros
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categorias - Bibliotec</title>
    <link rel="stylesheet" href="assets/css/estilo.css">
</head>
<body>
    <?php include 'includes/header.php'; ?>

    <main>
        <section class="section">
            <div class="container">
                <div class="section-header">
                    <h2 class="section-title">Nossas Categorias</h2>
                    <p class="section-subtitle">Explore nossa coleção organizada por gêneros literários</p>
                </div>
                
                <div class="grid grid-3">
                    <!-- Categoria Terror -->
                    <div class="card text-center">
                        <div style="font-size: 3rem; margin-bottom: 1rem;">👻</div>
                        <h3 class="card-title">Terror</h3>
                        <p class="card-text">Livros que provocam medo e suspense, do sobrenatural ao psicológico.</p>
                        <div class="card-actions" style="justify-content: center;">
                            <a href="terror.php" class="btn btn-primary">Explorar</a>
                            <button class="btn btn-outline" onclick="openCategoryModal('terror')">Saiba Mais</button>
                        </div>
                    </div>
                    
                    <!-- Categoria Suspense -->
                    <div class="card text-center">
                        <div style="font-size: 3rem; margin-bottom: 1rem;">🕵️</div>
                        <h3 class="card-title">Suspense</h3>
                        <p class="card-text">Narrativas cheias de tensão, mistério e reviravoltas inesperadas.</p>
                        <div class="card-actions" style="justify-content: center;">
                            <a href="suspense.php" class="btn btn-primary">Explorar</a>
                            <button class="btn btn-outline" onclick="openCategoryModal('suspense')">Saiba Mais</button>
                        </div>
                    </div>
                    
                    <!-- Categoria Fantasia -->
                    <div class="card text-center">
                        <div style="font-size: 3rem; margin-bottom: 1rem;">✨</div>
                        <h3 class="card-title">Fantasia</h3>
                        <p class="card-text">Mundos mágicos, criaturas fantásticas e aventuras épicas.</p>
                        <div class="card-actions" style="justify-content: center;">
                            <a href="fantasia.php" class="btn btn-primary">Explorar</a>
                            <button class="btn btn-outline" onclick="openCategoryModal('fantasia')">Saiba Mais</button>
                        </div>
                    </div>

                    <!-- Categoria Ficção Científica -->
                    <div class="card text-center">
                        <div style="font-size: 3rem; margin-bottom: 1rem;">🚀</div>
                        <h3 class="card-title">Ficção Científica</h3>
                        <p class="card-text">Futuros distantes, tecnologia avançada e exploração espacial.</p>
                        <div class="card-actions" style="justify-content: center;">
                            <a href="ficcao.php" class="btn btn-primary">Explorar</a>
                            <button class="btn btn-outline" onclick="openCategoryModal('ficcao')">Saiba Mais</button>
                        </div>
                    </div>

                    <!-- Categoria Romance -->
                    <div class="card text-center">
                        <div style="font-size: 3rem; margin-bottom: 1rem;">💖</div>
                        <h3 class="card-title">Romance</h3>
                        <p class="card-text">Histórias de amor, paixão e relacionamentos emocionantes.</p>
                        <div class="card-actions" style="justify-content: center;">
                            <a href="romance.php" class="btn btn-primary">Explorar</a>
                            <button class="btn btn-outline" onclick="openCategoryModal('romance')">Saiba Mais</button>
                        </div>
                    </div>

                    <!-- Categoria Comédia -->
                    <div class="card text-center">
                        <div style="font-size: 3rem; margin-bottom: 1rem;">😂</div>
                        <h3 class="card-title">Comédia</h3>
                        <p class="card-text">Histórias hilárias, situações engraçadas e muito humor.</p>
                        <div class="card-actions" style="justify-content: center;">
                            <a href="comedia.php" class="btn btn-primary">Explorar</a>
                            <button class="btn btn-outline" onclick="openCategoryModal('comedia')">Saiba Mais</button>
                        </div>
                    </div>

                    <!-- Categoria Aventura -->
                    <div class="card text-center">
                        <div style="font-size: 3rem; margin-bottom: 1rem;">🏔️</div>
                        <h3 class="card-title">Aventura</h3>
                        <p class="card-text">Jornadas emocionantes, explorações e descobertas incríveis.</p>
                        <div class="card-actions" style="justify-content: center;">
                            <a href="aventura.php" class="btn btn-primary">Explorar</a>
                            <button class="btn btn-outline" onclick="openCategoryModal('aventura')">Saiba Mais</button>
                        </div>
                    </div>

                    <!-- Categoria Drama -->
                    <div class="card text-center">
                        <div style="font-size: 3rem; margin-bottom: 1rem;">🎭</div>
                        <h3 class="card-title">Drama</h3>
                        <p class="card-text">Histórias emocionantes sobre conflitos humanos e superação.</p>
                        <div class="card-actions" style="justify-content: center;">
                            <a href="drama.php" class="btn btn-primary">Explorar</a>
                            <button class="btn btn-outline" onclick="openCategoryModal('drama')">Saiba Mais</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <?php include 'includes/footer.php'; ?>

    <!-- Modal de Informações da Categoria -->
    <div id="categoryModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="modalCategoryTitle">Categoria</h3>
                <button class="modal-close" onclick="closeCategoryModal()">&times;</button>
            </div>
            <div class="modal-body">
                <div id="modalCategoryContent">
                    <!-- Conteúdo carregado via JavaScript -->
                </div>
            </div>
        </div>
    </div>

    <script>
        function openCategoryModal(category) {
            const categories = {
                terror: {
                    title: "Terror",
                    content: `
                        <p>O gênero de terror surgiu no final do século XVIII, influenciado pelas mudanças sociais e culturais da época. 
                        Explora temas como o sobrenatural, a morte e os limites da razão.</p>
                        <p><strong>Principais características:</strong></p>
                        <ul style="margin-left: 1.5rem; margin-bottom: 1rem;">
                            <li>Elementos sobrenaturais e paranormais</li>
                            <li>Suspense psicológico</li>
                            <li>Ambientação atmosférica e sombria</li>
                            <li>Exploração de medos humanos universais</li>
                        </ul>
                        <p><strong>Autores clássicos:</strong> Stephen King, H.P. Lovecraft, Edgar Allan Poe</p>
                        <div style="margin-top: 1.5rem;">
                            <a href="terror.php" class="btn btn-primary">Explorar Livros de Terror</a>
                        </div>
                    `
                },
                suspense: {
                    title: "Suspense",
                    content: `
                        <p>O gênero de suspense ganhou força no século XIX com escritores como Edgar Allan Poe e Arthur Conan Doyle. 
                        Caracteriza-se por narrativas que mantêm o leitor em tensão constante.</p>
                        <p><strong>Principais características:</strong></p>
                        <ul style="margin-left: 1.5rem; margin-bottom: 1rem;">
                            <li>Narrativas com tensão crescente</li>
                            <li>Reviravoltas inesperadas</li>
                            <li>Mistérios a serem desvendados</li>
                            <li>Ambiente de incerteza e expectativa</li>
                        </ul>
                        <p><strong>Autores notáveis:</strong> Agatha Christie, Gillian Flynn, Paula Hawkins</p>
                        <div style="margin-top: 1.5rem;">
                            <a href="suspense.php" class="btn btn-primary">Explorar Livros de Suspense</a>
                        </div>
                    `
                },
                fantasia: {
                    title: "Fantasia",
                    content: `
                        <p>A fantasia como gênero literário moderno consolidou-se com autores como J.R.R. Tolkien e C.S. Lewis. 
                        Cria universos alternativos com regras próprias e elementos mágicos.</p>
                        <p><strong>Principais características:</strong></p>
                        <ul style="margin-left: 1.5rem; margin-bottom: 1rem;">
                            <li>Mundos imaginários e sistemas de magia</li>
                            <li>Criaturas fantásticas e mitológicas</li>
                            <li>Jornadas épicas e missões heroicas</li>
                            <li>Batalha entre o bem e o mal</li>
                        </ul>
                        <p><strong>Autores renomados:</strong> J.R.R. Tolkien, J.K. Rowling, George R.R. Martin</p>
                        <div style="margin-top: 1.5rem;">
                            <a href="fantasia.php" class="btn btn-primary">Explorar Livros de Fantasia</a>
                        </div>
                    `
                },
                ficcao: {
                    title: "Ficção Científica",
                    content: `
                        <p>A ficção científica explora possibilidades futuras baseadas em avanços científicos e tecnológicos. 
                        Surgiu no século XIX e ganhou popularidade no século XX.</p>
                        <p><strong>Principais características:</strong></p>
                        <ul style="margin-left: 1.5rem; margin-bottom: 1rem;">
                            <li>Tecnologia avançada e futurista</li>
                            <li>Exploração espacial e alienígenas</li>
                            <li>Distopias e sociedades futuristas</li>
                            <li>Viagem no tempo e realidades alternativas</li>
                        </ul>
                        <p><strong>Autores famosos:</strong> Isaac Asimov, Philip K. Dick, Frank Herbert</p>
                        <div style="margin-top: 1.5rem;">
                            <a href="ficcao.php" class="btn btn-primary">Explorar Livros de Ficção Científica</a>
                        </div>
                    `
                },
                romance: {
                    title: "Romance",
                    content: `
                        <p>O romance é um dos gêneros mais populares da literatura, focando em relacionamentos amorosos 
                        e desenvolvimento emocional dos personagens.</p>
                        <p><strong>Principais características:</strong></p>
                        <ul style="margin-left: 1.5rem; margin-bottom: 1rem;">
                            <li>Histórias de amor e paixão</li>
                            <li>Desenvolvimento de relacionamentos</li>
                            <li>Conflitos emocionais</li>
                            <li>Final feliz (na maioria dos casos)</li>
                        </ul>
                        <p><strong>Autores destacados:</strong> Jane Austen, Nicholas Sparks, Colleen Hoover</p>
                        <div style="margin-top: 1.5rem;">
                            <a href="romance.php" class="btn btn-primary">Explorar Livros de Romance</a>
                        </div>
                    `
                },
                comedia: {
                    title: "Comédia",
                    content: `
                        <p>A comédia na literatura busca entreter através do humor, situações engraçadas e personagens cômicos. 
                        Pode variar da sátira social ao humor absurdo.</p>
                        <p><strong>Principais características:</strong></p>
                        <ul style="margin-left: 1.5rem; margin-bottom: 1rem;">
                            <li>Humor e situações engraçadas</li>
                            <li>Diálogos espirituosos</li>
                            <li>Personagens excêntricos</li>
                            <li>Final feliz e resolvido</li>
                        </ul>
                        <p><strong>Autores humorísticos:</strong> Mark Twain, Douglas Adams, Terry Pratchett</p>
                        <div style="margin-top: 1.5rem;">
                            <a href="comedia.php" class="btn btn-primary">Explorar Livros de Comédia</a>
                        </div>
                    `
                },
                aventura: {
                    title: "Aventura",
                    content: `
                        <p>O gênero de aventura transporta o leitor para jornadas emocionantes, explorações de lugares desconhecidos 
                        e enfrentamento de desafios extraordinários.</p>
                        <p><strong>Principais características:</strong></p>
                        <ul style="margin-left: 1.5rem; margin-bottom: 1rem;">
                            <li>Jornadas e expedições emocionantes</li>
                            <li>Descoberta de lugares desconhecidos</li>
                            <li>Superação de obstáculos e perigos</li>
                            <li>Elementos de ação e exploração</li>
                        </ul>
                        <p><strong>Autores notáveis:</strong> Jules Verne, Robert Louis Stevenson, Jack London</p>
                        <div style="margin-top: 1.5rem;">
                            <a href="aventura.php" class="btn btn-primary">Explorar Livros de Aventura</a>
                        </div>
                    `
                },
                drama: {
                    title: "Drama",
                    content: `
                        <p>O drama na literatura explora conflitos humanos profundos, relações sociais complexas 
                        e as emoções mais intensas da experiência humana.</p>
                        <p><strong>Principais características:</strong></p>
                        <ul style="margin-left: 1.5rem; margin-bottom: 1rem;">
                            <li>Conflitos emocionais intensos</li>
                            <li>Desenvolvimento psicológico dos personagens</li>
                            <li>Exploração de relações humanas complexas</li>
                            <li>Temas sociais e existenciais</li>
                        </ul>
                        <p><strong>Autores destacados:</strong> William Shakespeare, Fiódor Dostoiévski, Tennessee Williams</p>
                        <div style="margin-top: 1.5rem;">
                            <a href="drama.php" class="btn btn-primary">Explorar Livros de Drama</a>
                        </div>
                    `
                }
            };

            const cat = categories[category];
            if (cat) {
                document.getElementById('modalCategoryTitle').textContent = cat.title;
                document.getElementById('modalCategoryContent').innerHTML = cat.content;
                document.getElementById('categoryModal').classList.add('active');
            }
        }

        function closeCategoryModal() {
            document.getElementById('categoryModal').classList.remove('active');
        }

        // Fechar modal ao clicar fora
        document.getElementById('categoryModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeCategoryModal();
            }
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