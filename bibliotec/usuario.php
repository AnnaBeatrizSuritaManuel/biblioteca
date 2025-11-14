<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>bibliotec - Meu Perfil</title>
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

        .profile-section {
            padding: 3rem 0;
        }

        .profile-header {
            text-align: center;
            margin-bottom: 3rem;
        }

        .profile-avatar {
            width: 100px;
            height: 100px;
            background: linear-gradient(135deg, var(--primary-main) 0%, var(--primary-dark) 100%);
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.5rem;
            color: white;
            font-size: 2.5rem;
        }

        .profile-name {
            font-size: 2rem;
            margin-bottom: 0.5rem;
            color: var(--primary-dark);
        }

        .profile-info {
            color: var(--text-secondary);
        }

        .profile-grid {
            display: grid;
            grid-template-columns: 300px 1fr;
            gap: 2rem;
        }

        .sidebar {
            background: var(--surface);
            border-radius: 12px;
            padding: 2rem;
            box-shadow: 0 2px 8px var(--shadow);
            height: fit-content;
        }

        .nav-pills {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .nav-pill {
            padding: 1rem;
            border-radius: 8px;
            color: var(--text-primary);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            transition: all 0.3s ease;
        }

        .nav-pill:hover {
            background-color: var(--background);
        }

        .nav-pill.active {
            background-color: var(--primary-main);
            color: white;
        }

        .content-area {
            background: var(--surface);
            border-radius: 12px;
            padding: 2rem;
            box-shadow: 0 2px 8px var(--shadow);
        }

        .tab-content {
            display: none;
        }

        .tab-content.active {
            display: block;
        }

        .section-title {
            font-size: 1.5rem;
            margin-bottom: 1.5rem;
            color: var(--primary-dark);
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .info-item {
            padding: 1rem;
            background: var(--background);
            border-radius: 8px;
        }

        .info-label {
            font-weight: 600;
            color: var(--primary-main);
            margin-bottom: 0.25rem;
        }

        .info-value {
            color: var(--text-primary);
        }

        .book-list {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .book-item {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1rem;
            background: var(--background);
            border-radius: 8px;
        }

        .book-cover {
            width: 60px;
            height: 80px;
            background: var(--primary-light);
            border-radius: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary-main);
            font-size: 1.5rem;
        }

        .book-info {
            flex: 1;
        }

        .book-title {
            font-weight: 600;
            margin-bottom: 0.25rem;
        }

        .book-meta {
            color: var(--text-secondary);
            font-size: 0.9rem;
        }

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

            .profile-grid {
                grid-template-columns: 1fr;
            }

            .sidebar {
                order: 2;
            }

            .content-area {
                order: 1;
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
                    <div style="display: flex; align-items: center; gap: 1rem;">
                        <span style="color: var(--text-secondary);">Olá, Lara!</span>
                        <a href="usuario.php" class="btn btn-secondary">
                            <i class="fas fa-user"></i>
                            Meu Perfil
                        </a>
                    </div>
                </nav>
                
                <button class="btn btn-ghost mobile-menu-btn">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
        </header>

        <main>
            <section class="profile-section">
                <div class="container">
                    <div class="profile-header">
                        <div class="profile-avatar">
                            <i class="fas fa-user"></i>
                        </div>
                        <h1 class="profile-name">Lara Santos</h1>
                        <p class="profile-info">leitora.lara.s@exemplo.com • Membro desde: 15/03/2025</p>
                    </div>

                    <div class="profile-grid">
                        <div class="sidebar">
                            <nav class="nav-pills">
                                <a href="#dados" class="nav-pill active" data-tab="dados">
                                    <i class="fas fa-user"></i>
                                    Dados Pessoais
                                </a>
                                <a href="#livros" class="nav-pill" data-tab="livros">
                                    <i class="fas fa-book"></i>
                                    Livros Lidos
                                </a>
                                <a href="#config" class="nav-pill" data-tab="config">
                                    <i class="fas fa-cog"></i>
                                    Configurações
                                </a>
                            </nav>
                        </div>

                        <div class="content-area">
                            <!-- Dados Pessoais -->
                            <div id="dados" class="tab-content active">
                                <h2 class="section-title">Dados Pessoais</h2>
                                <div class="info-grid">
                                    <div class="info-item">
                                        <div class="info-label">Nome Completo</div>
                                        <div class="info-value">Lara Santos</div>
                                    </div>
                                    <div class="info-item">
                                        <div class="info-label">E-mail</div>
                                        <div class="info-value">leitora.lara.s@exemplo.com</div>
                                    </div>
                                    <div class="info-item">
                                        <div class="info-label">Telefone</div>
                                        <div class="info-value">(11) 98765-4321</div>
                                    </div>
                                    <div class="info-item">
                                        <div class="info-label">Localização</div>
                                        <div class="info-value">Rio de Janeiro, RJ</div>
                                    </div>
                                </div>
                                <div class="info-item">
                                    <div class="info-label">Biografia</div>
                                    <div class="info-value">Amante de thrillers e tudo que me tire o sono. Sempre em busca da próxima história que vai me manter acordada até tarde.</div>
                                </div>
                            </div>

                            <!-- Livros Lidos -->
                            <div id="livros" class="tab-content">
                                <h2 class="section-title">Livros Lidos</h2>
                                <div class="book-list">
                                    <div class="book-item">
                                        <div class="book-cover">
                                            <i class="fas fa-book"></i>
                                        </div>
                                        <div class="book-info">
                                            <div class="book-title">O Iluminado</div>
                                            <div class="book-meta">Stephen King • Terror • 447 páginas</div>
                                        </div>
                                        <div style="color: var(--success);">
                                            <i class="fas fa-check-circle"></i>
                                        </div>
                                    </div>
                                    <div class="book-item">
                                        <div class="book-cover">
                                            <i class="fas fa-book"></i>
                                        </div>
                                        <div class="book-info">
                                            <div class="book-title">Garota Exemplar</div>
                                            <div class="book-meta">Gillian Flynn • Suspense • 432 páginas</div>
                                        </div>
                                        <div style="color: var(--success);">
                                            <i class="fas fa-check-circle"></i>
                                        </div>
                                    </div>
                                    <div class="book-item">
                                        <div class="book-cover">
                                            <i class="fas fa-book"></i>
                                        </div>
                                        <div class="book-info">
                                            <div class="book-title">O Silêncio dos Inocentes</div>
                                            <div class="book-meta">Thomas Harris • Suspense • 368 páginas</div>
                                        </div>
                                        <div style="color: var(--success);">
                                            <i class="fas fa-check-circle"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Configurações -->
                            <div id="config" class="tab-content">
                                <h2 class="section-title">Editar Perfil</h2>
                                <form>
                                    <div class="form-group">
                                        <label class="form-label">Nome Completo</label>
                                        <input type="text" class="form-control" value="Lara Santos">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">E-mail</label>
                                        <input type="email" class="form-control" value="leitora.lara.s@exemplo.com">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Telefone</label>
                                        <input type="tel" class="form-control" value="(11) 98765-4321">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Localização</label>
                                        <input type="text" class="form-control" value="Rio de Janeiro, RJ">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Biografia</label>
                                        <textarea class="form-control" rows="3">Amante de thrillers e tudo que me tire o sono. Sempre em busca da próxima história que vai me manter acordada até tarde.</textarea>
                                    </div>
                                    <button type="button" class="btn btn-primary">
                                        <i class="fas fa-save"></i>
                                        Salvar Alterações
                                    </button>
                                </form>
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

    <script>
        // Navegação entre abas
        document.querySelectorAll('.nav-pill').forEach(pill => {
            pill.addEventListener('click', function(e) {
                e.preventDefault();
                
                // Remove classe active de todas as abas
                document.querySelectorAll('.nav-pill').forEach(p => p.classList.remove('active'));
                document.querySelectorAll('.tab-content').forEach(tab => tab.classList.remove('active'));
                
                // Adiciona classe active na aba clicada
                this.classList.add('active');
                const tabId = this.getAttribute('data-tab');
                document.getElementById(tabId).classList.add('active');
            });
        });

        // Menu mobile
        document.querySelector('.mobile-menu-btn').addEventListener('click', function() {
            const navLinks = document.querySelector('.nav-links');
            navLinks.style.display = navLinks.style.display === 'flex' ? 'none' : 'flex';
        });

        // Simulação de salvamento
        document.querySelector('#config .btn-primary').addEventListener('click', function() {
            alert('Alterações salvas com sucesso!');
        });
    </script>
</body>
</html>