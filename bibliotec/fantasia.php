<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>bibliotec - Fantasia</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        /* Mesmo CSS das outras páginas */
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
        }

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

        .grid {
            display: grid;
            gap: 2rem;
        }

        .grid-3 { grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); }

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

        .footer {
            background-color: var(--primary-dark);
            color: white;
            padding: 3rem 0;
            margin-top: auto;
        }

        .footer-bottom {
            text-align: center;
            padding-top: 2rem;
            margin-top: 2rem;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            color: rgba(255, 255, 255, 0.7);
        }

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
            max-width: 600px;
            width: 100%;
            max-height: 90vh;
            overflow-y: auto;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
        }

        .modal-header {
            padding: 1.5rem;
            border-bottom: 1px solid var(--border);
            display: flex;
            justify-content: space-between;
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

        @media (max-width: 768px) {
            .nav-links {
                display: none;
            }

            .mobile-menu-btn {
                display: block;
            }
        }
    </style>
</head>
<body>
    <div class="app-container">
        <header class="navbar">
            <div class="nav-container">
                <a href="index.php" class="logo">
                    <span class="logo-icon">📚</span>
                    bibliotec
                </a>
                
                <nav class="nav-links">
                    <a href="index.php">Início</a>
                    <a href="categorias.php">Categorias</a>
                    <a href="sobre.php">Sobre</a>
                    <a href="login.php" class="btn btn-secondary">Entrar</a>
                </nav>
                
                <button class="btn btn-ghost mobile-menu-btn">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
        </header>

        <main>
            <section class="section">
                <div class="container">
                    <div class="section-header">
                        <h2 class="section-title">Livros de Fantasia</h2>
                        <p class="section-subtitle">Mundos mágicos, criaturas fantásticas e aventuras épicas te aguardam</p>
                    </div>
                    
                    <div class="grid grid-3">
                        <!-- Livro 1 -->
                        <div class="card">
                            <img src="img/senhor_dos_aneis.jpg" alt="O Senhor dos Anéis" class="card-img">
                            <div class="card-body">
                                <h3 class="card-title">O Senhor dos Anéis</h3>
                                <p class="card-text">J.R.R. Tolkien</p>
                                <p class="card-text">Fantasia Épica • 1954</p>
                                <div class="mt-3">
                                    <button class="btn btn-primary" onclick="openBookModal('fantasia1')">Ver Detalhes</button>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Livro 2 -->
                        <div class="card">
                            <img src="img/narnia.jpg" alt="As Crônicas de Nárnia" class="card-img">
                            <div class="card-body">
                                <h3 class="card-title">As Crônicas de Nárnia</h3>
                                <p class="card-text">C.S. Lewis</p>
                                <p class="card-text">Fantasia Clássica • 1950</p>
                                <div class="mt-3">
                                    <button class="btn btn-primary" onclick="openBookModal('fantasia2')">Ver Detalhes</button>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Livro 3 -->
                        <div class="card">
                            <img src="img/spiderwick.jpg" alt="As Crônicas de Spiderwick" class="card-img">
                            <div class="card-body">
                                <h3 class="card-title">As Crônicas de Spiderwick</h3>
                                <p class="card-text">Holly Black & Tony DiTerlizzi</p>
                                <p class="card-text">Fantasia Infantil • 2003</p>
                                <div class="mt-3">
                                    <button class="btn btn-primary" onclick="openBookModal('fantasia3')">Ver Detalhes</button>
                                </div>
                            </div>
                        </div>

                        <!-- Livro 4 -->
                        <div class="card">
                            <img src="img/harry_potter.jpg" alt="Harry Potter e a Pedra Filosofal" class="card-img">
                            <div class="card-body">
                                <h3 class="card-title">Harry Potter e a Pedra Filosofal</h3>
                                <p class="card-text">J.K. Rowling</p>
                                <p class="card-text">Fantasia Juvenil • 1997</p>
                                <div class="mt-3">
                                    <button class="btn btn-primary" onclick="openBookModal('fantasia4')">Ver Detalhes</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>

        <footer class="footer">
            <div class="container">
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
        function openBookModal(bookId) {
            const books = {
                fantasia1: {
                    title: "O Senhor dos Anéis",
                    author: "J.R.R. Tolkien",
                    description: "Uma das obras mais influentes da fantasia. Conta a jornada de Frodo Bolseiro para destruir o Um Anel, enfrentando perigos e batalhas numa terra mágica chamada Terra Média.",
                    genre: "Fantasia Épica",
                    year: "1954",
                    price: "R$ 59,90",
                    pages: "1216 páginas"
                },
                fantasia2: {
                    title: "As Crônicas de Nárnia",
                    author: "C.S. Lewis",
                    description: "Uma série encantadora que mistura aventura e moralidade. Crianças descobrem um mundo mágico chamado Nárnia, vivendo aventuras épicas repletas de magia, batalhas e criaturas fantásticas.",
                    genre: "Fantasia Clássica",
                    year: "1950",
                    price: "R$ 45,90",
                    pages: "768 páginas"
                },
                fantasia3: {
                    title: "As Crônicas de Spiderwick",
                    author: "Holly Black & Tony DiTerlizzi",
                    description: "Uma série fantástica sobre três irmãos que descobrem um mundo secreto habitado por fadas, duendes e criaturas mágicas, enquanto enfrentam mistérios e perigos.",
                    genre: "Fantasia Infantil",
                    year: "2003",
                    price: "R$ 32,90",
                    pages: "144 páginas"
                },
                fantasia4: {
                    title: "Harry Potter e a Pedra Filosofal",
                    author: "J.K. Rowling",
                    description: "Primeiro livro da série Harry Potter. Harry descobre que é um bruxo e ingressa na Escola de Magia de Hogwarts, onde aprende magia, faz amigos e enfrenta seu destino.",
                    genre: "Fantasia Juvenil",
                    year: "1997",
                    price: "R$ 39,90",
                    pages: "264 páginas"
                }
            };
            
            const book = books[bookId];
            if (book) {
                document.getElementById('modalBookTitle').textContent = book.title;
                document.getElementById('modalBookContent').innerHTML = `
                    <div style="display: grid; grid-template-columns: 1fr 2fr; gap: 2rem; margin-bottom: 1.5rem;">
                        <div>
                            <img src="img/${book.title.toLowerCase().replace(/ /g, '_')}.jpg" alt="${book.title}" style="width: 100%; border-radius: 8px;">
                        </div>
                        <div>
                            <h4>${book.title}</h4>
                            <p><strong>Autor:</strong> ${book.author}</p>
                            <p><strong>Gênero:</strong> ${book.genre}</p>
                            <p><strong>Ano:</strong> ${book.year}</p>
                            <p><strong>Páginas:</strong> ${book.pages}</p>
                            <p><strong>Preço:</strong> ${book.price}</p>
                        </div>
                    </div>
                    <div>
                        <h5>Sinopse</h5>
                        <p>${book.description}</p>
                    </div>
                    <div style="margin-top: 1.5rem;">
                        <button class="btn btn-primary" style="width: 100%;">
                            <i class="fas fa-shopping-cart"></i>
                            Adicionar ao Carrinho
                        </button>
                    </div>
                `;
                document.getElementById('bookModal').classList.add('active');
            }
        }

        function closeBookModal() {
            document.getElementById('bookModal').classList.remove('active');
        }

        document.getElementById('bookModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeBookModal();
            }
        });

        document.querySelector('.mobile-menu-btn').addEventListener('click', function() {
            const navLinks = document.querySelector('.nav-links');
            navLinks.style.display = navLinks.style.display === 'flex' ? 'none' : 'flex';
        });
    </script>
</body>
</html>