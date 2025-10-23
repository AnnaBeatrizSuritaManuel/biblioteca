<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>bibliotec - Categorias</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        /* Mesmo CSS do index.php */
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

        .btn-secondary {
            background-color: transparent;
            color: var(--primary-main);
            border: 1px solid var(--border);
        }

        .btn-secondary:hover {
            background-color: var(--background);
            border-color: var(--primary-main);
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

        .grid-3 { grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); }

        .card {
            background-color: var(--surface);
            border-radius: 12px;
            box-shadow: 0 2px 8px var(--shadow);
            overflow: hidden;
            transition: all 0.3s ease;
            text-align: center;
            padding: 2rem;
        }

        .card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 24px var(--shadow-hover);
        }

        .category-icon {
            font-size: 3rem;
            margin-bottom: 1rem;
            color: var(--primary-main);
        }

        .card-title {
            font-size: 1.5rem;
            margin-bottom: 1rem;
        }

        .card-text {
            color: var(--text-secondary);
            margin-bottom: 1.5rem;
        }

        .card-actions {
            display: flex;
            gap: 1rem;
            justify-content: center;
        }

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

        .footer-bottom {
            text-align: center;
            padding-top: 2rem;
            margin-top: 2rem;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            color: rgba(255, 255, 255, 0.7);
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
                    <a href="categorias.php" class="active">Categorias</a>
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
                        <h2 class="section-title">Nossas Categorias</h2>
                        <p class="section-subtitle">Explore nossa coleção organizada por gêneros literários</p>
                    </div>
                    
                    <div class="grid grid-3">
                        <!-- Categoria Terror -->
                        <div class="card">
                            <div class="category-icon">👻</div>
                            <h3 class="card-title">Terror</h3>
                            <p class="card-text">Livros que provocam medo e suspense, do sobrenatural ao psicológico.</p>
                            <div class="card-actions">
                                <a href="terror.php" class="btn btn-primary">Explorar</a>
                                <button class="btn btn-secondary" onclick="openCategoryModal('terror')">Saiba Mais</button>
                            </div>
                        </div>
                        
                        <!-- Categoria Suspense -->
                        <div class="card">
                            <div class="category-icon">🕵️</div>
                            <h3 class="card-title">Suspense</h3>
                            <p class="card-text">Narrativas cheias de tensão, mistério e reviravoltas inesperadas.</p>
                            <div class="card-actions">
                                <a href="suspense.php" class="btn btn-primary">Explorar</a>
                                <button class="btn btn-secondary" onclick="openCategoryModal('suspense')">Saiba Mais</button>
                            </div>
                        </div>
                        
                        <!-- Categoria Fantasia -->
                        <div class="card">
                            <div class="category-icon">✨</div>
                            <h3 class="card-title">Fantasia</h3>
                            <p class="card-text">Mundos mágicos, criaturas fantásticas e aventuras épicas.</p>
                            <div class="card-actions">
                                <a href="fantasia.php" class="btn btn-primary">Explorar</a>
                                <button class="btn btn-secondary" onclick="openCategoryModal('fantasia')">Saiba Mais</button>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>

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

    <!-- Modal de Informações da Categoria -->
    <div id="categoryModal" class="modal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.5); z-index: 2000; align-items: center; justify-content: center;">
        <div class="modal-content" style="background: white; padding: 2rem; border-radius: 12px; max-width: 500px; width: 90%;">
            <div style="display: flex; justify-content: between; align-items: center; margin-bottom: 1rem;">
                <h3 id="modalCategoryTitle">Categoria</h3>
                <button onclick="closeCategoryModal()" style="background: none; border: none; font-size: 1.5rem; cursor: pointer;">&times;</button>
            </div>
            <div id="modalCategoryContent">
                <!-- Conteúdo carregado via JavaScript -->
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
                    `
                }
            };

            const cat = categories[category];
            if (cat) {
                document.getElementById('modalCategoryTitle').textContent = cat.title;
                document.getElementById('modalCategoryContent').innerHTML = cat.content;
                document.getElementById('categoryModal').style.display = 'flex';
            }
        }

        function closeCategoryModal() {
            document.getElementById('categoryModal').style.display = 'none';
        }

        // Menu mobile
        document.querySelector('.mobile-menu-btn').addEventListener('click', function() {
            const navLinks = document.querySelector('.nav-links');
            navLinks.style.display = navLinks.style.display === 'flex' ? 'none' : 'flex';
        });
    </script>
</body>
</html>