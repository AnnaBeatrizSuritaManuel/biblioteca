<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>bibliotec - Categorias</title>
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
            
            /* Cores diferentes para cada gênero */
            --terror-primary: #8C2C2C;
            --terror-secondary: #361A1A;
            --suspense-primary: #8C2C2C;
            --suspense-secondary: #5D1F1F;
            --fantasia-primary: #8C2C2C;
            --fantasia-secondary: #7A2C2C;
        }

        /* Configurações gerais */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            height: 100%;
        }

        
        body {
            font-family: 'Quicksand', sans-serif;
            line-height: 1.6;
            background-color: var(--global-background);
            color: var(--global-dark);
            
            min-height: 100%; 
            display: flex;
            flex-direction: column; 
        }
        
        main {
            padding-top: 80px; 
            flex-grow: 1; 
        }
        
        /* Rodapé */
        footer {
            text-align: center;
            padding: 30px 20px;
            background-color: var(--global-primary);
            color: var(--global-light);
            font-size: 0.95rem;
            flex-shrink: 0; 
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

        .section-content {
            padding: 80px 5% 60px 5%;
            text-align: center;
        }

        .section-content h2 {
            margin-bottom: 50px;
            font-size: 2.5rem;
        }

        /* Estilo dos botões */
        .btn-primary, .btn-secondary {
            display: inline-block;
            padding: 12px 24px;
            border-radius: 30px;
            font-weight: 600;
            text-align: center;
            transition: all 0.3s ease;
            cursor: pointer;
            font-family: 'Quicksand', sans-serif;
        }

        .btn-primary {
            background-color: var(--global-primary);
            color: var(--global-light);
            border: 2px solid var(--global-primary);
        }

        .btn-primary:hover {
            background-color: #7a2626;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(140, 44, 44, 0.3);
        }

        .btn-secondary {
            background-color: transparent;
            color: var(--global-primary);
            border: 2px solid var(--global-primary);
        }

        .btn-secondary:hover {
            background-color: var(--global-primary);
            color: var(--global-light);
            transform: translateY(-2px);
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

        .btn-login {
            background-color: var(--global-primary);
            color: var(--global-light) !important;
            padding: 8px 20px;
            border-radius: 25px;
            margin-left: 20px;
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

        /* Grid de cards */
        .cards-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 40px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .category-card {
            background: var(--global-light);
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 8px 25px var(--shadow-light);
            text-align: center;
            transition: all 0.4s ease;
            border: 3px solid transparent;
        }

        .category-card:hover {
            box-shadow: 0 15px 40px rgba(140, 44, 44, 0.15);
            transform: translateY(-8px);
        }

        .category-card img {
            max-height: 180px;
            object-fit: contain;
            border-radius: 15px;
            margin-bottom: 20px;
            width: 100%;
            transition: transform 0.3s ease;
        }

        .category-card:hover img {
            transform: scale(1.05);
        }

        /* Botões dentro dos cards */
        .card-actions {
            display: flex;
            justify-content: space-around;
            margin-top: 25px;
            gap: 15px;
        }

        .card-actions .btn-secondary, .card-actions .btn-primary {
            padding: 10px 20px;
            font-size: 1rem;
            flex: 1;
        }

        /* Cores especiais para cada categoria */

        /* Terror - vermelho e marrom */
        .category-card.terror {
            border: 3px solid var(--terror-primary);
            background: linear-gradient(135deg, #F8E8E8 0%, #F0D6D6 100%);
        }

        .category-card.terror h3 {
            color: var(--terror-primary);
        }

        .category-card.terror .btn-secondary {
            color: var(--terror-primary);
            border-color: var(--terror-primary);
        }

        .category-card.terror .btn-secondary:hover {
            background-color: var(--terror-primary);
            color: var(--global-light);
        }

        .category-card.terror .btn-primary {
            background-color: var(--terror-secondary);
            border-color: var(--terror-secondary);
        }

        .category-card.terror .btn-primary:hover {
            background-color: #4a2525;
        }

        /* Suspense - vermelho escuro */
        .category-card.suspense {
            border: 3px solid var(--suspense-primary);
            background: linear-gradient(135deg, #F8E8E8 0%, #F0D6D6 100%);
        }

        .category-card.suspense h3 {
            color: var(--suspense-primary);
        }

        .category-card.suspense .btn-secondary {
            color: var(--suspense-primary);
            border-color: var(--suspense-primary);
        }

        .category-card.suspense .btn-secondary:hover {
            background-color: var(--suspense-primary);
            color: var(--global-light);
        }

        .category-card.suspense .btn-primary {
            background-color: var(--suspense-secondary);
            border-color: var(--suspense-secondary);
        }

        .category-card.suspense .btn-primary:hover {
            background-color: #4a1a1a;
        }

        /* Fantasia - vermelho médio */
        .category-card.fantasia {
            border: 3px solid var(--fantasia-primary);
            background: linear-gradient(135deg, #F8E8E8 0%, #F0D6D6 100%);
        }

        .category-card.fantasia h3 {
            color: var(--fantasia-primary);
        }

        .category-card.fantasia .btn-secondary {
            color: var(--fantasia-primary);
            border-color: var(--fantasia-primary);
        }

        .category-card.fantasia .btn-secondary:hover {
            background-color: var(--fantasia-primary);
            color: var(--global-light);
        }

        .category-card.fantasia .btn-primary {
            background-color: var(--fantasia-secondary);
            border-color: var(--fantasia-secondary);
            color: var(--global-light);
        }

        .category-card.fantasia .btn-primary:hover {
            background-color: #6a2525;
        }

        /* Janelas pop-up */
        .modal {
            position: fixed;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            background: rgba(54, 26, 26, 0.95);
            z-index: 9999;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.3s ease-in-out;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .modal:target {
            opacity: 1;
            pointer-events: auto;
        }

        .modal-content {
            background: var(--global-light);
            padding: 40px;
            border-radius: 20px;
            position: relative;
            width: 90%;
            max-width: 700px;
            box-shadow: 0 25px 60px rgba(0, 0, 0, 0.3);
            transform: scale(0.9);
            transition: transform 0.3s ease-in-out;
            border: 3px solid var(--global-primary);
        }

        .modal:target .modal-content {
            transform: scale(1);
        }

        .modal-content h3 {
            font-size: 2.2rem;
            margin-bottom: 20px;
            text-align: center;
            color: var(--global-primary);
        }

        .modal-content p {
            margin-bottom: 20px;
            font-size: 1.1rem;
            line-height: 1.7;
            text-align: justify;
        }

        .modal-content strong {
            color: var(--global-primary);
        }

        /* Botão para fechar pop-up */
        .modal-close {
            position: absolute;
            top: 15px;
            right: 20px;
            color: var(--global-secondary);
            font-size: 2.5rem;
            font-weight: 300;
            line-height: 1;
            text-decoration: none;
            transition: color 0.3s;
        }

        .modal-close:hover {
            color: var(--global-primary);
        }

        .modal-content .btn-primary {
            display: block;
            margin: 25px auto 0;
            width: 200px;
            text-align: center;
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
            <a href="categorias.php" class="active">Categorias</a>
            <a href="sobre.php">Sobre</a>
            <a href="login.php" class="btn-login">Login</a>
        </nav>
        <button class="menu-toggle">
            <span class="bar"></span>
            <span class="bar"></span>
            <span class="bar"></span>
        </button>
    </header>

    <main class="section-content">
        <h2>Explore Nossos Gêneros Literários</h2>
        <div class="cards-grid">

            <div class="category-card terror">
                <img src="img/terrorlogo.png" alt="Ícone Terror">
                <h3>Terror</h3>
                <p class="genre">Arrepios e Histórias Sobrenaturais</p>
                <div class="card-actions">
                    <a href="#modal-terror" class="btn-secondary">Saiba Mais</a>
                    <a href="terror.php" class="btn-primary">Ver Livros</a>
                </div>
            </div>

            <div class="category-card suspense">
                <img src="img/suspenselogo.png" alt="Ícone Suspense">
                <h3>Suspense</h3>
                <p class="genre">Mistérios, Crimes e Reviravoltas</p>
                <div class="card-actions">
                    <a href="#modal-suspense" class="btn-secondary">Saiba Mais</a>
                    <a href="suspense.php" class="btn-primary">Ver Livros</a>
                </div>
            </div>

            <div class="category-card fantasia">
                <img src="img/fantasialogo.png" alt="Ícone Fantasia">
                <h3>Fantasia</h3>
                <p class="genre">Mundos Mágicos e Jornadas Épicas</p>
                <div class="card-actions">
                    <a href="#modal-fantasia" class="btn-secondary">Saiba Mais</a>
                    <a href="fantasia.php" class="btn-primary">Ver Livros</a>
                </div>
            </div>

        </div>
    </main>

    <div id="modal-terror" class="modal">
        <div class="modal-content">
            <a href="#close" class="modal-close">&times;</a>
            <h3>Gênero Terror: A Origem do Medo</h3>
            <p>O gênero de terror surgiu no final do século XVIII, influenciado pelas mudanças sociais e culturais da época, como o Iluminismo e a Revolução Industrial, que provocaram um aumento nas incertezas e no medo do desconhecido. O terror, inicialmente literário, explorava temas como o sobrenatural, a morte e os limites da razão, como em obras góticas como *Frankenstein* e *Drácula*.</p>
            <p>Com o tempo, o gênero se expandiu para o cinema no século XX, aproveitando os avanços tecnológicos para criar atmosferas de medo e suspense, como em *Nosferatu* e *Psicose*. O terror se diversificou com a chegada do slasher e do terror psicológico, refletindo as tensões e os medos da sociedade em cada época. Hoje, o gênero continua a evoluir, explorando temas contemporâneos e sociais, e encontrou novo espaço nas plataformas de streaming, mantendo sua relevância ao abordar os medos coletivos e individuais.</p>
            <p><strong>Temas Principais:</strong> Sobrenatural, horror corporal, ameaças psicológicas e o mal na natureza humana.</p>
            <a href="#close" class="btn-primary">Fechar</a>
        </div>
    </div>

    <div id="modal-suspense" class="modal">
        <div class="modal-content">
            <a href="#close" class="modal-close">&times;</a>
            <h3>Gênero Suspense: A Arte da Tensão</h3>
            <p>O gênero de suspense surgiu no século XIX, influenciado pela literatura gótica e policial. Escritores como Edgar Allan Poe e Arthur Conan Doyle foram pioneiros ao criarem histórias que misturavam mistério, investigação e tensão psicológica. Essas narrativas buscavam prender o leitor através do medo do desconhecido e da expectativa pelo desfecho.</p>
            <p>No cinema, o suspense ganhou força no século XX com diretores como Alfred Hitchcock, que ficou conhecido como o "mestre do suspense", com filmes como *Psicose* e *Janela Indiscreta*. Com o tempo, o gênero passou a se misturar com o thriller, o terror e o drama, mantendo-se atual em filmes e séries que exploram crimes, segredos e reviravoltas. Até hoje, o suspense continua atraindo o público por seu poder de provocar tensão e surpresa.</p>
            <p><strong>Temas Principais:</strong> Conspirações políticas, investigação criminal, espionagem e a caçada por um segredo ou fugitivo.</p>
            <a href="#close" class="btn-primary">Fechar</a>
        </div>
    </div>

    <div id="modal-fantasia" class="modal">
        <div class="modal-content">
            <a href="#close" class="modal-close">&times;</a>
            <h3>Gênero Fantasia: Construindo Mundos</h3>
            <p>O gênero fantasia surgiu na literatura antiga, mas ganhou força a partir do século XIX, com autores como George MacDonald e, mais tarde, J.R.R. Tolkien, considerado um dos grandes nomes do gênero com *O Senhor dos Anéis*. A fantasia é marcada por mundos imaginários, seres mágicos, mitologia e elementos sobrenaturais, oferecendo uma fuga da realidade e permitindo a criação de universos complexos e cheios de aventuras.</p>
            <p>No cinema, a fantasia se popularizou com filmes como *O Mágico de Oz* (1939) e, mais recentemente, com grandes franquias como *Harry Potter* e *O Senhor dos Anéis*. O gênero continua forte até hoje, também presente em séries e jogos, conquistando públicos de todas as idades. A fantasia encanta por permitir a imaginação livre e por abordar, através de mundos mágicos, temas humanos como coragem, amizade, bem e mal.</p>
            <p><strong>Temas Principais:</strong> Magia, criaturas míticas, jornadas, construção de mundos (world-building) e profecias.</p>
            <a href="#close" class="btn-primary">Fechar</a>
        </div>
    </div>

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