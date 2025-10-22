<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>bibliotec - Sobre Nós</title>
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

        /* Configura o <html> para a cor de fundo */
        html {
            height: 100%;
            background-color: var(--global-background);
        }

        /* <body> para o Sticky Footer */
        body {
            font-family: 'Quicksand', sans-serif;
            line-height: 1.6;
            color: var(--global-dark);
            
            /* Sticky Footer CSS */
            min-height: 100%; 
            display: flex;
            flex-direction: column;
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

        /* Garante que o conteúdo principal (main) ocupe o espaço */
        main {
            padding-top: 80px; 
            flex-grow: 1; 
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

        /* Botão de login */
        .btn-login {
            background-color: var(--global-primary);
            color: var(--global-light) !important;
            padding: 8px 20px;
            border-radius: 25px;
            margin-left: 20px;
            text-decoration: none;
            transition: all 0.3s ease;
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

        /* ESTILOS PARA O CARD GIGANTE - about-section */
        .about-section {
            /* Card Principal: Centralizado e Arredondado */
            margin: 60px auto; 
            max-width: 1000px;
            padding: 70px 5%; 
            background-color: var(--global-light);
            border-radius: 25px;
            box-shadow: 0 15px 40px rgba(140, 44, 44, 0.1);
            text-align: left;
            border: 3px solid var(--global-primary);
        }

        .about-section h2 {
            font-size: 2.8rem;
            color: var(--global-primary);
            margin-bottom: 40px;
            text-align: center;
        }

        .about-section p {
            font-size: 1.2rem;
            margin-bottom: 30px;
            color: var(--global-dark);
            line-height: 1.8;
        }

        /* Estilo para os cards internos (Sobre o Trabalho e Sobre Mim) */
        .mission-vision {
            display: flex;
            gap: 40px; 
            margin-top: 50px;
            flex-wrap: wrap;
            justify-content: center;
        }

        .mission-vision div {
            flex: 1;
            min-width: 320px;
            padding: 35px;
            
            /* Estilo dos cards internos */
            background: linear-gradient(135deg, #FFFFFF 0%, #F8F8F8 100%);
            box-shadow: 0 8px 25px rgba(140, 44, 44, 0.1);
            border-radius: 20px;
            border: 2px solid var(--global-primary);
        }

        .mission-vision h3 {
            font-size: 1.8rem;
            margin-bottom: 20px;
            color: var(--global-primary);
            text-align: center;
        }

        .mission-vision p {
            font-size: 1.1rem;
            line-height: 1.7;
        }

        /* Rodapé (Com Flexbox ajustado) */
        footer {
            text-align: center;
            padding: 30px 20px;
            background-color: var(--global-primary);
            color: var(--global-light);
            font-size: 0.95rem;
            margin-top: auto; /* Empurra o rodapé para a base do <body> */
            flex-shrink: 0; /* Impede o rodapé de encolher */
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
            <a href="sobre.php" class="active">Sobre</a>
            <a href="login.php" class="btn-login">Login</a>
        </nav>
        <button class="menu-toggle">
            <span class="bar"></span>
            <span class="bar"></span>
            <span class="bar"></span>
        </button>
    </header>

    <main>
        <section class="about-section">
            <h2>Um Pouco do Site</h2>

            <p>A Bibliotec nasceu da paixão por histórias que mexem com a imaginação, o medo e o mistério. Fundada em 2025, nossa livraria online é dedicada exclusivamente aos gêneros fantasia, suspense e terror, trazendo uma seleção feita especialmente para quem ama se perder em mundos mágicos, sentir o frio na espinha ou desvendar segredos sombrios.</p>
            
            <p>Mais do que uma loja, somos um espaço criado para alimentar a curiosidade e o gosto pela leitura. Aqui, você encontra desde clássicos consagrados até os lançamentos mais aguardados, sempre com foco na qualidade e no poder que uma boa história tem de transformar o leitor. Seja para fugir da realidade ou encará-la de um jeito diferente, a Bibliotec é o seu portal para experiências literárias intensas.</p>

            <div class="mission-vision">
                <div>
                    <h3>Sobre o Trabalho</h3>
                    <p>Este site é um trabalho da disciplina SW, feito para aprendermos a criar um sistema de login usando PHP. Ele funciona como uma livraria simples, focada nos gêneros terror, suspense e fantasia, unindo a prática de programação com um projeto literário.</p>
                </div>
                <div>
                    <h3>Sobre Mim</h3>
                    <p>Meu nome é Anna Beatriz. Tenho 17 anos e estudo na ETEC onde estou fazendo quase dois anos. Gosto de ler, jogar, assistir e aprender coisas novas.</p>
                </div>
            </div>

            <p style="margin-top: 50px; text-align: center; font-size: 1.3rem; font-weight: 600;">Junte-se a nós e venha ver os livros que temos disponíveis</p>
            <p style="text-align: center; margin-top: 20px;"><a href="categorias.php" class="btn-primary" style="padding: 15px 30px; font-size: 1.1rem;">Conhecer o Catálogo</a></p>
        </section>
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
    </script>
</body>
</html>