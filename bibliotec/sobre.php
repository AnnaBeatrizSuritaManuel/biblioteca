<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>bibliotec - Sobre</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
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

        .about-hero {
            background: linear-gradient(135deg, var(--primary-dark) 0%, var(--primary-main) 100%);
            color: white;
            padding: 4rem 0;
            text-align: center;
        }

        .about-hero h1 {
            font-size: 3rem;
            margin-bottom: 1rem;
            color: white;
        }

        .about-hero p {
            font-size: 1.25rem;
            opacity: 0.9;
            max-width: 600px;
            margin: 0 auto;
        }

        .about-content {
            max-width: 800px;
            margin: 0 auto;
        }

        .about-text {
            font-size: 1.1rem;
            line-height: 1.8;
            margin-bottom: 2rem;
            color: var(--text-secondary);
        }

        .info-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin: 3rem 0;
        }

        .info-card {
            background: var(--surface);
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0 2px 8px var(--shadow);
            border-left: 4px solid var(--primary-main);
        }

        .info-card h3 {
            color: var(--primary-main);
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .info-card p {
            color: var(--text-secondary);
            line-height: 1.6;
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

        @media (max-width: 768px) {
            .nav-links {
                display: none;
            }

            .mobile-menu-btn {
                display: block;
            }

            .about-hero h1 {
                font-size: 2.25rem;
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
                    <a href="sobre.php" class="active">Sobre</a>
                    <a href="login.php" class="btn btn-secondary">Entrar</a>
                </nav>
                
                <button class="btn btn-ghost mobile-menu-btn">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
        </header>

        <main>
            <section class="about-hero">
                <div class="container">
                    <h1>Sobre a Bibliotec</h1>
                    <p>Conheça mais sobre nossa missão, história e paixão por literatura</p>
                </div>
            </section>

            <section class="section">
                <div class="container">
                    <div class="about-content">
                        <div class="about-text">
                            <p>A Bibliotec nasceu da paixão por histórias que mexem com a imaginação, o medo e o mistério. Fundada em 2025, nossa livraria online é dedicada exclusivamente aos gêneros fantasia, suspense e terror, trazendo uma seleção feita especialmente para quem ama se perder em mundos mágicos, sentir o frio na espinha ou desvendar segredos sombrios.</p>
                            
                            <p>Mais do que uma loja, somos um espaço criado para alimentar a curiosidade e o gosto pela leitura. Aqui, você encontra desde clássicos consagrados até os lançamentos mais aguardados, sempre com foco na qualidade e no poder que uma boa história tem de transformar o leitor.</p>
                        </div>

                        <div class="info-cards">
                            <div class="info-card">
                                <h3><i class="fas fa-briefcase"></i> Sobre o Trabalho</h3>
                                <p>Este site é um trabalho da disciplina SW, feito para aprendermos a criar um sistema de login usando PHP. Ele funciona como uma livraria simples, focada nos gêneros terror, suspense e fantasia, unindo a prática de programação com um projeto literário.</p>
                            </div>

                            <div class="info-card">
                                <h3><i class="fas fa-user"></i> Sobre Nós</h3>
                                <p>nós somos um grupo de estudantes da etec MCM e este site é um trabalho da matéria sw-1 regida pelo professor Anderson Vanin em 2025, feito pelo alunos do 2f: Kevin, Angelo, Anna Beatriz, Arthur e Isabele</p>
                            </div>
                        </div>

                        <div style="text-align: center; margin-top: 3rem;">
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

        <footer class="footer">
            <div class="container">
                <div class="footer-bottom">
                    <p>&copy; 2025 bibliotec. Todos os direitos reservados.</p>
                </div>
            </div>
        </footer>
    </div>

    <script>
        document.querySelector('.mobile-menu-btn').addEventListener('click', function() {
            const navLinks = document.querySelector('.nav-links');
            navLinks.style.display = navLinks.style.display === 'flex' ? 'none' : 'flex';
        });
    </script>
</body>
</html>