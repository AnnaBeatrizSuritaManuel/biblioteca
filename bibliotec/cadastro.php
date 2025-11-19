<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>bibliotec - Cadastro</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

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
            font-weight: 400;
        }

        /* NAVBAR */
        .navbar {
            position: fixed;
            top: 0;
            width: 100%;
            background-color: var(--surface);
            box-shadow: 0 2px 12px var(--shadow);
            z-index: 1000;
        }

        .nav-container {
            max-width: 1200px;
            margin: auto;
            padding: 1rem 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 40px;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 10px;
            position: absolute;
            left: 20px;
            font-weight: 700;
            font-size: 1.5rem;
            color: var(--primary-dark);
        }

        .logo-icon {
            font-size: 1.7rem;
            color: var(--primary-main);
        }

        .nav-links {
            display: flex;
            gap: 2.5rem;
            align-items: center;
        }

        .nav-links a {
            text-decoration: none;
            color: var(--text-primary);
            font-weight: 500;
            padding: 5px 0;
            transition: 0.3s;
        }

        .nav-links a:hover,
        .nav-links a.active {
            color: var(--primary-main);
        }

        /* Mobile Menu */
        .mobile-menu-btn {
            display: none;
            position: absolute;
            right: 20px;
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
        }

        @media (max-width: 768px) {
            .nav-links {
                display: none;
                flex-direction: column;
                background-color: white;
                position: absolute;
                top: 100%;
                left: 0;
                width: 100%;
                padding: 1rem 0;
                box-shadow: 0 4px 12px var(--shadow);
            }

            .nav-links.show {
                display: flex;
            }

            .mobile-menu-btn {
                display: block;
            }
        }

        /* CONTEÚDO */
        main {
            margin-top: 120px;
            display: flex;
            justify-content: center;
            padding: 20px;
        }

        .card {
            background: white;
            max-width: 450px;
            width: 100%;
            padding: 2.5rem;
            border-radius: 12px;
            box-shadow: 0 4px 20px var(--shadow);
            border: 1px solid var(--border);
        }

        .title {
            font-size: 2rem;
            font-weight: 700;
            text-align: center;
            margin-bottom: 5px;
        }

        .subtitle {
            color: var(--text-secondary);
            text-align: center;
            margin-bottom: 25px;
        }

        .form-group {
            margin-bottom: 1.3rem;
        }

        .form-label {
            font-weight: 500;
            margin-bottom: 5px;
            display: block;
        }

        .form-control {
            width: 100%;
            padding: 12px;
            border-radius: 8px;
            border: 1px solid var(--border);
            font-size: 1rem;
        }

        .btn {
            width: 100%;
            padding: 12px;
            background-color: var(--primary-main);
            color: white;
            font-weight: 600;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            transition: 0.3s;
        }

        .btn:hover {
            background-color: var(--primary-dark);
        }

        .helper {
            margin-top: 15px;
            text-align: center;
            font-size: 0.95rem;
        }

        .helper a {
            color: var(--primary-main);
            text-decoration: none;
            font-weight: 600;
        }

        .error {
            color: #c0392b;
            font-size: 0.9rem;
            margin-top: 4px;
        }

        .success {
            color: #2ecc71;
            text-align: center;
            margin-top: 10px;
            font-weight: 600;
        }

        /* FOOTER */
        .footer {
            background-color: var(--primary-dark);
            color: white;
            padding: 2rem 0;
            margin-top: 50px;
        }

        .footer-bottom {
            text-align: center;
            opacity: 0.8;
        }
    </style>
</head>

<body>
    <header class="navbar">
        <div class="nav-container">
            <a href="index.php" class="logo">
                <span class="logo-icon">📚</span> bibliotec
            </a>

            <nav class="nav-links" id="menu">
                <a href="index.php">Início</a>
                <a href="categorias.php">Categorias</a>
                <a href="sobre.php">Sobre</a>
                <a href="login.php" class="active">Entrar</a>
            </nav>

            <button class="mobile-menu-btn" id="menuBtn">
                <i class="fas fa-bars"></i>
            </button>
        </div>
    </header>

    <main>
        <div class="card">
            <h1 class="title">Crie sua conta</h1>
            <p class="subtitle">Cadastre-se para começar a explorar</p>

            <form id="cadForm" novalidate>
                <div class="form-group">
                    <label class="form-label">Nome completo</label>
                    <input type="text" id="nome" class="form-control">
                    <div class="error" id="err-nome"></div>
                </div>

                <div class="form-group">
                    <label class="form-label">E-mail</label>
                    <input type="email" id="email" class="form-control">
                    <div class="error" id="err-email"></div>
                </div>

                <div class="form-group">
                    <label class="form-label">Senha</label>
                    <input type="password" id="password" class="form-control">
                    <div class="error" id="err-password"></div>
                </div>

                <div class="form-group">
                    <label class="form-label">Confirmar senha</label>
                    <input type="password" id="password2" class="form-control">
                    <div class="error" id="err-password2"></div>
                </div>

                <button type="submit" class="btn">Cadastrar</button>

                <div id="successMsg" class="success"></div>

                <p class="helper">
                    Já tem conta? <a href="login.php">Entrar</a>
                </p>
            </form>
        </div>
    </main>

    <footer class="footer">
        <div class="footer-bottom">
            © 2025 bibliotec. Todos os direitos reservados.
        </div>
    </footer>

    <script>
        const menuBtn = document.getElementById('menuBtn');
        const menu = document.getElementById('menu');

        menuBtn.addEventListener('click', () => {
            menu.classList.toggle('show');
        });

        const form = document.getElementById('cadForm');

        form.addEventListener('submit', (e) => {
            e.preventDefault();

            let ok = true;

            const nome = document.getElementById('nome').value.trim();
            const email = document.getElementById('email').value.trim();
            const pass = document.getElementById('password').value;
            const pass2 = document.getElementById('password2').value;

            document.querySelectorAll('.error').forEach(e => e.textContent = '');
            document.getElementById('successMsg').textContent = '';

            if (!nome) {
                ok = false;
                document.getElementById('err-nome').textContent = 'Preencha seu nome.';
            }

            if (!email) {
                ok = false;
                document.getElementById('err-email').textContent = 'Preencha seu e-mail.';
            }

            if (pass.length < 6) {
                ok = false;
                document.getElementById('err-password').textContent = 'A senha deve ter no mínimo 6 caracteres.';
            }

            if (pass !== pass2) {
                ok = false;
                document.getElementById('err-password2').textContent = 'As senhas não coincidem.';
            }

            if (ok) {
                document.getElementById('successMsg').textContent = 'Cadastro realizado com sucesso!';
                setTimeout(() => {
                    window.location.href = 'login.php';
                }, 1200);
            }
        });
    </script>

</body>
</html>
