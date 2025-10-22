<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>bibliotec - Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;600;700&display=swap" rel="stylesheet">
    
    <style>
        /* Cores principais - #8C2C2C como primária e #361A1A como secundária */
        :root {
            --global-primary: #8C2C2C;
            --global-secondary: #361A1A;
            --global-accent: #8C2C2C;
            --global-light: #E6CECE;
            --global-background: #F5F5F5;
            --global-dark: #2C1818;
            --shadow-light: rgba(140, 44, 44, 0.1);
        }

        /* Configurações gerais */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Quicksand', sans-serif;
            line-height: 1.6;
            background-color: var(--global-background);
            color: var(--global-dark);
        }

        h1, h2, h3 {
            font-weight: 700;
            color: var(--global-primary);
        }

        a {
            text-decoration: none;
            color: var(--global-primary);
            transition: color 0.3s;
        }

        /* Espaço para o menu fixo */
        main {
            padding-top: 80px;
            min-height: calc(100vh - 80px - 60px);
        }

        /* Estilo dos botões */
        .btn-primary {
            display: inline-block;
            padding: 12px 24px;
            border-radius: 30px;
            font-weight: 600;
            text-align: center;
            transition: all 0.3s ease;
            cursor: pointer;
            background-color: var(--global-primary);
            color: var(--global-light);
            border: 2px solid var(--global-primary);
            font-family: 'Quicksand', sans-serif;
        }

        .btn-primary:hover {
            background-color: #7a2626;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(140, 44, 44, 0.3);
        }

        /* Menu de navegação */
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 5%;
            background-color: var(--global-light);
            box-shadow: 0 2px 20px var(--shadow-light);
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
            border-bottom: 3px solid var(--global-primary);
        }

        .logo {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--global-primary);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .logo-icon {
            color: var(--global-secondary);
            font-size: 2rem;
        }

        .nav-links a {
            margin-left: 20px;
            font-weight: 600;
            font-size: 1rem;
            color: var(--global-dark);
            padding: 8px 0;
            position: relative;
        }

        .nav-links a.active, .nav-links a:hover {
            color: var(--global-primary);
        }

        .nav-links a:not(.btn-login):after {
            content: '';
            position: absolute;
            width: 0;
            height: 3px;
            background: var(--global-primary);
            bottom: -5px;
            left: 0;
            transition: width 0.3s;
        }

        .nav-links a:hover:not(.btn-login):after,
        .nav-links a.active:not(.btn-login):after {
            width: 100%;
        }

        /* Botão de login no menu */
        .btn-login {
            background-color: var(--global-primary);
            color: var(--global-light) !important;
            padding: 8px 20px;
            border-radius: 25px;
            margin-left: 20px;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .btn-login.active {
            box-shadow: 0 0 10px rgba(140, 44, 44, 0.5);
        }

        .btn-login:hover {
            background-color: var(--global-secondary);
            transform: translateY(-2px);
        }

        /* Menu para celular */
        .menu-toggle {
            display: none;
            background: none;
            border: none;
            cursor: pointer;
            padding: 10px;
        }

        .menu-toggle .bar {
            display: block;
            width: 25px;
            height: 3px;
            margin: 4px auto;
            background-color: var(--global-dark);
            transition: all 0.3s ease-in-out;
        }

        @media (max-width: 768px) {
            .nav-links {
                display: none;
                flex-direction: column;
                position: absolute;
                top: 70px;
                left: 0;
                width: 100%;
                background-color: var(--global-light);
                box-shadow: 0 5px 20px var(--shadow-light);
                padding: 10px 0;
            }

            .nav-links.open {
                display: flex;
            }

            .nav-links a {
                margin: 8px 0;
                padding: 12px 5%;
                font-size: 1.1rem;
                text-align: center;
                border-bottom: 1px solid rgba(140, 44, 44, 0.1);
                margin-left: 0;
            }

            .btn-login {
                margin: 10px auto;
                width: 80%;
            }

            .menu-toggle {
                display: block;
            }

            /* Animação do menu */
            .menu-toggle.open .bar:nth-child(1) {
                transform: translateY(7px) rotate(45deg);
            }

            .menu-toggle.open .bar:nth-child(2) {
                opacity: 0;
            }

            .menu-toggle.open .bar:nth-child(3) {
                transform: translateY(-7px) rotate(-45deg);
            }
        }

        /* Área de login */
        .login-container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: calc(100vh - 80px - 60px);
            padding: 40px 20px;
        }

        .login-box {
            background: var(--global-light);
            padding: 50px;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(140, 44, 44, 0.1);
            border: 3px solid var(--global-primary);
            width: 100%;
            max-width: 450px;
            text-align: center;
        }

        .login-box h2 {
            margin-bottom: 35px;
            color: var(--global-primary);
            font-size: 2.2rem;
        }

        .login-box label {
            display: block;
            text-align: left;
            margin-bottom: 8px;
            font-weight: 600;
            color: var(--global-primary);
        }

        .login-box input[type="text"],
        .login-box input[type="password"] {
            width: 100%;
            padding: 15px;
            margin-bottom: 25px;
            border: 2px solid #d4b8b8;
            border-radius: 10px;
            box-sizing: border-box;
            font-family: 'Quicksand', sans-serif;
            transition: all 0.3s ease;
            font-size: 1rem;
        }

        .login-box input[type="text"]:focus,
        .login-box input[type="password"]:focus {
            border-color: var(--global-primary);
            outline: none;
            box-shadow: 0 0 8px rgba(140, 44, 44, 0.3);
        }

        .login-box .btn-primary {
            width: 100%;
            margin-top: 15px;
            padding: 15px;
            font-size: 1.1rem;
        }

        /* Rodapé */
        footer {
            text-align: center;
            padding: 30px 20px;
            background-color: var(--global-primary);
            color: var(--global-light);
            font-size: 0.95rem;
        }
    </style>
</head>

<body>

    <header class="navbar">
        <div class="logo">
            <span class="logo-icon">📚</span>
            bibliotec
        </div>
        <nav class="nav-links">
            <a href="index.php">Home</a>
            <a href="categorias.php">Categorias</a>
            <a href="sobre.php">Sobre</a>
            <a href="login.php" class="btn-login active">Login</a>
        </nav>
        <button class="menu-toggle">
            <span class="bar"></span>
            <span class="bar"></span>
            <span class="bar"></span>
        </button>
    </header>

    <main>
        <div class="login-container">
            <div class="login-box">
                <h2>Acesso à Sua Conta</h2>
                <form id="loginForm" method="POST">
                    <label for="username">E-mail</label>
                    <input type="text" id="username" name="username" required>
                
                    <label for="password">Senha</label>
                    <input type="password" id="password" name="password" required>
                
                    <button type="button" id="loginButton" class="btn-primary">Entrar</button>
                </form>
            </div>
        </div>
    </main>

    <footer>
        <p>&copy; 2025 bibliotec. Todos os direitos reservados.</p>
    </footer>

    <script>
        // Menu para celular
        document.querySelector('.menu-toggle').addEventListener('click', function() {
            const navLinks = document.querySelector('.nav-links');
            this.classList.toggle('open');
            navLinks.classList.toggle('open');
        });

        // Login sem enviar formulário
        document.getElementById('loginButton').addEventListener('click', function() {
            const username = document.getElementById('username').value;
            const password = document.getElementById('password').value;
            
            // Validação básica
            if (!username || !password) {
                alert('Por favor, preencha todos os campos.');
                return;
            }
            
            // Redirecionar para a página logado.php
            window.location.href = 'logado.php';
        });

        // Permitir enviar com Enter (sem usar submit do formulário)
        document.getElementById('password').addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                document.getElementById('loginButton').click();
            }
        });
    </script>
</body>
</html>