<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>bibliotec - Login</title>
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
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .btn {
            padding: 12px 24px;
            border-radius: 8px;
            font-weight: 500;
            font-size: 0.95rem;
            cursor: pointer;
            border: none;
            transition: 0.3s;
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

        /* NAVBAR */
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
        }

        .nav-links a.active {
            color: var(--primary-main);
        }

        /* CARD MAIOR AQUI */
        .login-container {
            width: 100%;
            max-width: 500px; /* AQUI FICA MAIS LARGO */
            padding: 2rem;
        }

        .login-card {
            background: var(--surface);
            padding: 3rem; /* aumentado */
            border-radius: 12px;
            box-shadow: 0 4px 20px var(--shadow);
            border: 1px solid var(--border);
        }

        .login-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .login-title {
            font-size: 2rem;
            margin-bottom: 0.5rem;
            color: var(--primary-dark);
        }

        .login-subtitle {
            color: var(--text-secondary);
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            font-weight: 500;
        }

        .form-control {
            width: 100%;
            padding: 12px 16px;
            border-radius: 8px;
            border: 1px solid var(--border);
        }

        .footer {
            background-color: var(--primary-dark);
            color: white;
            padding: 3rem 0;
            margin-top: auto;
        }

        .footer-bottom {
            text-align: center;
            opacity: 0.7;
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
                    <a href="login.php" class="active btn btn-secondary">Entrar</a>
                </nav>

                <button class="btn btn-ghost mobile-menu-btn">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
        </header>

        <main>
            <div class="container">
                <div class="login-container">
                    <div class="login-card">
                        <div class="login-header">
                            <h2 class="login-title">Acesse sua conta</h2>
                            <p class="login-subtitle">Entre para explorar nossa biblioteca</p>
                        </div>

                        <form id="loginForm">
                            <div class="form-group">
                                <label class="form-label">E-mail</label>
                                <input type="email" id="email" class="form-control" placeholder="seu@email.com">
                            </div>

                            <div class="form-group">
                                <label class="form-label">Senha</label>
                                <input type="password" id="password" class="form-control" placeholder="Sua senha">
                            </div>

                            <button type="button" id="loginButton" class="btn btn-primary" style="width: 100%;">
                                <i class="fas fa-sign-in-alt"></i> Entrar
                            </button>
                        </form>

                        <div style="text-align: center; margin-top: 1.5rem;">
                            <p style="color: var(--text-secondary); font-size: 0.9rem;">
                                Não tem uma conta?
                                <a href="cadastro.php" style="color: var(--primary-main);">Cadastre-se</a>
                            </p>

                            <p style="color: var(--text-secondary); font-size: 0.9rem; margin-top: 0.5rem;">
                                <a href="loginadm.php" style="color: var(--primary-main); font-weight: 600;">
                                    Entrar como administrador
                                </a>
                            </p>
                        </div>

                    </div>
                </div>
            </div>
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
        document.getElementById('loginButton').addEventListener('click', function () {
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;

            if (!email || !password) {
                alert('Por favor, preencha todos os campos.');
                return;
            }

            window.location.href = 'logado.php';
        });
    </script>
</body>

</html>
