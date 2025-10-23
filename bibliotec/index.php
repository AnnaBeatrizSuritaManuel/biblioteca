<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>bibliotec - Biblioteca Digital</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        /* Paleta de cores baseada na imagem - tons de cinza e azul escuro */
        :root {
            --primary-dark: #1a1a1a;
            --primary-main: #2C3E50;
            --primary-light: #34495E;
            --secondary-dark: #465c78;
            --secondary-main: #7f8c8d;
            --secondary-light: #95a5a6;
            --background: #f8f9fa;
            --surface: #ffffff;
            --text-primary: #2c3e50;
            --text-secondary: #5d6d7e;
            --text-muted: #7f8c8d;
            --border: #e0e0e0;
            --shadow: rgba(44, 62, 80, 0.1);
            --shadow-hover: rgba(44, 62, 80, 0.2);
            --success: #27ae60;
            --error: #e74c3c;
        }

        /* Reset e configurações gerais */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            line-height: 1.6;
            background-color: var(--background);
            color: var(--text-primary);
            font-weight: 400;
        }

        /* Layout */
        .app-container {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        main {
            flex: 1;
            padding-top: 80px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* Tipografia */
        h1, h2, h3, h4, h5, h6 {
            font-weight: 600;
            line-height: 1.3;
            color: var(--primary-dark);
        }

        h1 { font-size: 2.5rem; }
        h2 { font-size: 2rem; }
        h3 { font-size: 1.5rem; }
        h4 { font-size: 1.25rem; }

        p { margin-bottom: 1rem; }

        a {
            text-decoration: none;
            color: var(--primary-main);
            transition: color 0.3s ease;
        }

        a:hover {
            color: var(--primary-dark);
        }

        /* Componentes */
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 12px 24px;
            border-radius: 8px;
            font-weight: 500;
            font-size: 0.95rem;
            cursor: pointer;
            transition: all 0.3s ease;
            border: none;
            font-family: 'Inter', sans-serif;
            gap: 8px;
        }

        .btn-primary {
            background-color: var(--primary-main);
            color: white;
        }

        .btn-primary:hover {
            background-color: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px var(--shadow-hover);
        }

        .btn-secondary {
            background-color: transparent;
            color: var(--primary-main);
            border: 1px solid var(--border);
        }

        .btn-secondary:hover {
            background-color: var(--background);
            border-color: var(--primary-main);
        }

        .btn-ghost {
            background-color: transparent;
            color: var(--text-primary);
        }

        .btn-ghost:hover {
            background-color: var(--background);
        }

        /* Navegação */
        .navbar {
            position: fixed;
            top: 0;
            width: 100%;
            background-color: var(--surface);
            box-shadow: 0 2px 12px var(--shadow);
            z-index: 1000;
            padding: 0;
        }

        .nav-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 20px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 12px;
            font-weight: 700;
            font-size: 1.5rem;
            color: var(--primary-dark);
        }

        .logo-icon {
            color: var(--primary-main);
            font-size: 1.75rem;
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 2rem;
        }

        .nav-links a {
            color: var(--text-primary);
            font-weight: 500;
            position: relative;
            padding: 8px 0;
        }

        .nav-links a.active {
            color: var(--primary-main);
        }

        .nav-links a.active::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 2px;
            background-color: var(--primary-main);
        }

        .nav-links a:hover {
            color: var(--primary-main);
        }

        /* Cards */
        .card {
            background-color: var(--surface);
            border-radius: 12px;
            box-shadow: 0 2px 8px var(--shadow);
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 24px var(--shadow-hover);
        }

        .card-img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .card-body {
            padding: 1.5rem;
        }

        .card-title {
            font-size: 1.25rem;
            margin-bottom: 0.5rem;
        }

        .card-text {
            color: var(--text-secondary);
            font-size: 0.95rem;
            margin-bottom: 1rem;
        }

        /* Grids */
        .grid {
            display: grid;
            gap: 2rem;
        }

        .grid-2 { grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); }
        .grid-3 { grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); }
        .grid-4 { grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); }

        /* Seções */
        .section {
            padding: 4rem 0;
        }

        .section-header {
            text-align: center;
            margin-bottom: 3rem;
        }

        .section-title {
            font-size: 2.5rem;
            margin-bottom: 1rem;
        }

        .section-subtitle {
            color: var(--text-secondary);
            font-size: 1.1rem;
            max-width: 600px;
            margin: 0 auto;
        }

        /* Hero Section */
        .hero {
            background: linear-gradient(135deg, var(--primary-dark) 0%, var(--primary-main) 100%);
            color: white;
            padding: 6rem 0;
            text-align: center;
        }

        .hero-title {
            font-size: 3rem;
            margin-bottom: 1.5rem;
            color: white;
        }

        .hero-subtitle {
            font-size: 1.25rem;
            margin-bottom: 2.5rem;
            opacity: 0.9;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }

        /* Formulários */
        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: var(--text-primary);
        }

        .form-control {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid var(--border);
            border-radius: 8px;
            font-size: 1rem;
            font-family: 'Inter', sans-serif;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary-main);
            box-shadow: 0 0 0 3px rgba(44, 62, 80, 0.1);
        }

        /* Modal */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 2000;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .modal.active {
            display: flex;
        }

        .modal-content {
            background-color: var(--surface);
            border-radius: 12px;
            max-width: 500px;
            width: 100%;
            max-height: 90vh;
            overflow-y: auto;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
        }

        .modal-header {
            padding: 1.5rem;
            border-bottom: 1px solid var(--border);
            display: flex;
            justify-content: between;
            align-items: center;
        }

        .modal-title {
            margin: 0;
        }

        .modal-close {
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            color: var(--text-muted);
        }

        .modal-body {
            padding: 1.5rem;
        }

        /* Footer */
        .footer {
            background-color: var(--primary-dark);
            color: white;
            padding: 3rem 0;
            margin-top: auto;
        }

        .footer-content {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
        }

        .footer-section h4 {
            color: white;
            margin-bottom: 1rem;
        }

        .footer-section a {
            color: rgba(255, 255, 255, 0.8);
            display: block;
            margin-bottom: 0.5rem;
        }

        .footer-section a:hover {
            color: white;
        }

        .footer-bottom {
            text-align: center;
            padding-top: 2rem;
            margin-top: 2rem;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            color: rgba(255, 255, 255, 0.7);
        }

        /* Responsividade */
        @media (max-width: 768px) {
            .nav-links {
                display: none;
            }

            .mobile-menu-btn {
                display: block;
            }

            .hero-title {
                font-size: 2.25rem;
            }

            .section-title {
                font-size: 2rem;
            }
        }

        /* Utilitários */
        .text-center { text-align: center; }
        .text-left { text-align: left; }
        .text-right { text-align: right; }
        .mt-1 { margin-top: 0.5rem; }
        .mt-2 { margin-top: 1rem; }
        .mt-3 { margin-top: 1.5rem; }
        .mt-4 { margin-top: 2rem; }
        .mb-1 { margin-bottom: 0.5rem; }
        .mb-2 { margin-bottom: 1rem; }
        .mb-3 { margin-bottom: 1.5rem; }
        .mb-4 { margin-bottom: 2rem; }
        .p-1 { padding: 0.5rem; }
        .p-2 { padding: 1rem; }
        .p-3 { padding: 1.5rem; }
        .p-4 { padding: 2rem; }
    </style>
</head>
<body>
    <div class="app-container">
        <!-- Navegação -->
        <header class="navbar">
            <div class="nav-container">
                <a href="index.php" class="logo">
                    <span class="logo-icon">📚</span>
                    bibliotec
                </a>
                
                <nav class="nav-links">
                    <a href="index.php" class="active">Início</a>
                    <a href="categorias.php">Categorias</a>
                    <a href="sobre.php">Sobre</a>
                    <a href="login.php" class="btn btn-secondary">Entrar</a>
                </nav>
                
                <button class="btn btn-ghost mobile-menu-btn">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
        </header>

        <!-- Conteúdo Principal -->
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
                    
                    <div class="grid grid-3">
                        <!-- Card de Livro 1 -->
                        <div class="card">
                            <img src="img/o_exorcista.jpg" alt="O Exorcista" class="card-img">
                            <div class="card-body">
                                <h3 class="card-title">O Exorcista</h3>
                                <p class="card-text">William Peter Blatty</p>
                                <p class="card-text">Terror • 1971</p>
                                <div class="mt-3">
                                    <button class="btn btn-primary" onclick="openBookModal(1)">Ver Detalhes</button>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Card de Livro 2 -->
                        <div class="card">
                            <img src="img/a_garota_no_trem.jpg" alt="A Garota no Trem" class="card-img">
                            <div class="card-body">
                                <h3 class="card-title">A Garota no Trem</h3>
                                <p class="card-text">Paula Hawkins</p>
                                <p class="card-text">Suspense • 2015</p>
                                <div class="mt-3">
                                    <button class="btn btn-primary" onclick="openBookModal(2)">Ver Detalhes</button>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Card de Livro 3 -->
                        <div class="card">
                            <img src="img/senhor_dos_aneis.jpg" alt="O Senhor dos Anéis" class="card-img">
                            <div class="card-body">
                                <h3 class="card-title">O Senhor dos Anéis</h3>
                                <p class="card-text">J.R.R. Tolkien</p>
                                <p class="card-text">Fantasia • 1954</p>
                                <div class="mt-3">
                                    <button class="btn btn-primary" onclick="openBookModal(3)">Ver Detalhes</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>

        <!-- Footer -->
        <footer class="footer">
            <div class="container">
                <div class="footer-content">
                    <div class="footer-section">
                        <h4>bibliotec</h4>
                        <p>Sua biblioteca digital de terror, suspense e fantasia.</p>
                    </div>
                    
                    <div class="footer-section">
                        <h4>Links Rápidos</h4>
                        <a href="index.php">Início</a>
                        <a href="categorias.php">Categorias</a>
                        <a href="sobre.php">Sobre</a>
                        <a href="login.php">Login</a>
                    </div>
                    
                    <div class="footer-section">
                        <h4>Contato</h4>
                        <a href="mailto:contato@bibliotec.com">contato@bibliotec.com</a>
                        <a href="tel:+551199999999">(11) 9999-9999</a>
                    </div>
                </div>
                
                <div class="footer-bottom">
                    <p>&copy; 2025 bibliotec. Todos os direitos reservados.</p>
                </div>
            </div>
        </footer>
    </div>

    <!-- Modal de Detalhes do Livro -->
    <div id="bookModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="modalBookTitle">Detalhes do Livro</h3>
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
        function openBookModal(bookId) {
            // Simulação de dados - em produção, isso viria do banco de dados
            const books = {
                1: {
                    title: "O Exorcista",
                    author: "William Peter Blatty",
                    description: "Inspirado em um caso real, o livro conta a história de uma menina possuída por uma entidade demoníaca e dos esforços de dois padres para realizar um exorcismo. É uma narrativa intensa, explorando medo, fé e possessão.",
                    genre: "Terror Sobrenatural",
                    year: "1971",
                    price: "R$ 39,90"
                },
                2: {
                    title: "A Garota no Trem",
                    author: "Paula Hawkins",
                    description: "Rachel pega o trem todos os dias passando por casas e observa um casal aparentemente perfeito. Quando a mulher desaparece, ela se envolve numa trama complexa de mentiras, memória e perigo.",
                    genre: "Suspense Psicológico",
                    year: "2015",
                    price: "R$ 34,90"
                },
                3: {
                    title: "O Senhor dos Anéis",
                    author: "J.R.R. Tolkien",
                    description: "Uma das obras mais influentes da fantasia. Conta a jornada de Frodo Bolseiro para destruir o Um Anel, enfrentando perigos e batalhas numa terra mágica chamada Terra Média.",
                    genre: "Fantasia Épica",
                    year: "1954",
                    price: "R$ 59,90"
                }
            };
            
            const book = books[bookId];
            if (book) {
                document.getElementById('modalBookTitle').textContent = book.title;
                document.getElementById('modalBookContent').innerHTML = `
                    <div class="grid grid-2">
                        <div>
                            <img src="img/${book.title.toLowerCase().replace(/ /g, '_')}.jpg" alt="${book.title}" style="width: 100%; border-radius: 8px;">
                        </div>
                        <div>
                            <h4>${book.title}</h4>
                            <p><strong>Autor:</strong> ${book.author}</p>
                            <p><strong>Gênero:</strong> ${book.genre}</p>
                            <p><strong>Ano:</strong> ${book.year}</p>
                            <p><strong>Preço:</strong> ${book.price}</p>
                            <p class="mt-3">${book.description}</p>
                            <div class="mt-3">
                                <button class="btn btn-primary">
                                    <i class="fas fa-shopping-cart"></i>
                                    Adicionar ao Carrinho
                                </button>
                            </div>
                        </div>
                    </div>
                `;
                document.getElementById('bookModal').classList.add('active');
            }
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

        // Menu mobile
        document.querySelector('.mobile-menu-btn').addEventListener('click', function() {
            const navLinks = document.querySelector('.nav-links');
            navLinks.style.display = navLinks.style.display === 'flex' ? 'none' : 'flex';
        });
    </script>
</body>
</html>