<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>bibliotec - Sua Biblioteca Online</title>
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
            --hero-background: linear-gradient(135deg, #8C2C2C 0%, #361A1A 100%);
            --card-bg-light: #FFFFFF;
            --card-bg-medium: #F8F8F8;
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
 
        /* menu fixo */
        main {
            padding-top: 80px;
            min-height: calc(100vh - 80px - 60px);
        }
 
        .section-content {
            padding: 60px 5%;
            text-align: center;
            background-color: var(--global-background);
        }
 
        .section-content h2 {
            margin-bottom: 40px;
            font-size: 2rem;
            color: var(--global-primary);
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
            border: none;
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
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 30px;
            max-width: 1200px;
            margin: 0 auto;
        }
 
        .book-card, .category-card {
            background: var(--card-bg-light);
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 4px 15px var(--shadow-light);
            text-align: center;
            transition: all 0.3s ease;
            border: 2px solid transparent;
        }
 
        .book-card:hover, .category-card:hover {
            box-shadow: 0 8px 25px rgba(140, 44, 44, 0.2);
            transform: translateY(-5px);
            border-color: var(--global-primary);
        }
 
        .book-card img, .carousel-card img {
            width: 100%;
            max-height: 250px;
            object-fit: cover;
            border-radius: 10px;
            margin-bottom: 15px;
            border: 2px solid var(--global-light);
        }
 
        /* Seção principal */
        .hero-section {
            padding: 100px 5%;
            background: var(--hero-background);
            display: flex;
            gap: 50px;
            align-items: center;
            flex-wrap: wrap;
            color: white;
        }
 
        .hero-content {
            flex: 1 1 40%;
            min-width: 300px;
        }
 
        .hero-content h1 {
            font-size: 3.2rem;
            margin-bottom: 20px;
            line-height: 1.1;
            color: white;
        }
 
        .hero-content p {
            font-size: 1.2rem;
            margin-bottom: 30px;
            color: rgba(255, 255, 255, 0.9);
        }
 
        /* Carrossel 3D */
        .carousel-container {
            flex: 1 1 50%;
            perspective: 1000px;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 350px;
            overflow: hidden;
            position: relative;
        }
 
        .carousel-group {
            width: 220px;
            height: 100%;
            position: relative;
            transform-style: preserve-3d;
            transition: transform 0.8s ease-in-out;
        }
 
        .carousel-card {
            background: var(--card-bg-light);
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
            padding: 20px;
            text-align: center;
            border: 2px solid var(--global-light);
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            transition: all 0.3s ease;
            cursor: pointer;
        }
 
        /* Posicionamento 3D dos cards */
        .carousel-group .carousel-card:nth-child(1) {
            transform: rotateY(0deg) translateZ(300px);
        }
 
        .carousel-group .carousel-card:nth-child(2) {
            transform: rotateY(120deg) translateZ(300px);
        }
 
        .carousel-group .carousel-card:nth-child(3) {
            transform: rotateY(240deg) translateZ(300px);
        }
 
        .carousel-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 10px;
            margin-bottom: 15px;
            border: 2px solid var(--global-light);
        }
 
        /* Efeitos do carrossel */
        .carousel-card:hover {
            transform: scale(1.05) translateZ(320px);
            box-shadow: 0 15px 35px rgba(140, 44, 44, 0.3);
        }
 
        /* Botões de navegação do carrossel */
        .carousel-nav {
            position: absolute;
            width: 100%;
            top: 50%;
            transform: translateY(-50%);
            display: flex;
            justify-content: space-between;
            z-index: 10;
            padding: 0 15px;
        }
 
        .carousel-nav button {
            background: var(--global-primary);
            color: var(--global-light);
            border: none;
            padding: 12px 16px;
            border-radius: 50%;
            cursor: pointer;
            font-size: 1.2rem;
            line-height: 1;
            transition: all 0.3s ease;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
        }
 
        .carousel-nav button:hover {
            background: var(--global-secondary);
            transform: scale(1.1);
        }
 
        @media (max-width: 992px) {
            .hero-section {
                flex-direction: column;
                text-align: center;
                padding: 80px 5%;
            }
 
            .hero-content {
                order: 2;
                margin-top: 40px;
            }
 
            .carousel-container {
                order: 1;
                height: 300px;
            }
        }
 
        /* Janelas pop-up */
        .modal {
            position: fixed;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            background: rgba(54, 26, 26, 0.9);
            z-index: 9999;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.3s ease-in-out;
            display: flex;
            justify-content: center;
            align-items: center;
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
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            transform: scale(0.9);
            transition: transform 0.3s ease-in-out;
        }
 
        .modal:target .modal-content {
            transform: scale(1);
        }
 
        .modal-body {
            display: flex;
            gap: 30px;
            text-align: left;
        }
 
        .modal-body img {
            width: 180px;
            height: 240px;
            object-fit: cover;
            border-radius: 10px;
            flex-shrink: 0;
            border: 3px solid var(--global-primary);
        }
 
        .modal-text h3 {
            font-size: 1.8rem;
            color: var(--global-primary);
            margin-bottom: 10px;
        }
 
        .modal-text h4 {
            font-size: 1.1rem;
            font-weight: 500;
            color: var(--global-secondary);
            margin-bottom: 20px;
        }
 
        .modal-text p {
            font-size: 1rem;
            margin-bottom: 20px;
            line-height: 1.6;
        }
 
        /* Botão para fechar pop-up */
        .modal-close {
            position: absolute;
            top: 15px;
            right: 20px;
            color: var(--global-secondary);
            font-size: 2rem;
            font-weight: 300;
            line-height: 1;
            text-decoration: none;
            transition: color 0.3s;
        }
 
        .modal-close:hover {
            color: var(--global-primary);
        }
 
        @media (max-width: 600px) {
            .modal-body {
                flex-direction: column;
                text-align: center;
                align-items: center;
            }
            
            .modal-body img {
                width: 150px;
                height: 200px;
            }
        }
 
        /* Rodapé */
        footer {
            text-align: center;
            padding: 30px 20px;
            background-color: var(--global-primary);
            color: var(--global-light);
            font-size: 0.95rem;
        }
        
        footer p {
            margin: 0;
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
            <a href="index.php" class="active">Home</a>
            <a href="categorias.php">Categorias</a>
            <a href="sobre.php">Sobre</a>
            <a href="login.php" class="btn-login">Login</a>
        </nav>
        <button class="menu-toggle">
            <span class="bar"></span>
            <span class="bar"></span>
            <span class="bar"></span>
        </button>
    </header>
 
    <main>
        <section class="hero-section">
            <div class="hero-content">
                <h1>Suas aventuras literárias começam aqui</h1>
                <p>Descubra mundos incríveis através dos melhores livros de terror, suspense e fantasia.</p>
                <a href="categorias.php" class="btn-primary">Explorar Categorias</a>
            </div>
 
            <div class="carousel-container">
                <div class="carousel-nav">
                    <button class="prev-btn">&leftarrow;</button>
                    <button class="next-btn">&rightarrow;</button>
                </div>
 
                <div class="carousel-group">
                    <a href="#carousel-modal" class="carousel-card" data-title="O Pequeno Príncipe"
                        data-author="Antoine de Saint-Exupéry | Páginas: 96" data-image="img/pequeno principe.png"
                        data-sinopse="Uma das obras literárias mais vendidas de todos os tempos. A história de um piloto que cai no deserto do Saara e encontra um pequeno príncipe de outro planeta, explorando temas como amizade, amor e perda.">
                        <img src="img/pequeno principe.png" alt="O Pequeno Príncipe">
                        <h3>O Pequeno Príncipe</h3>
                    </a>
 
                    <a href="#carousel-modal" class="carousel-card" data-title="1984" data-author="George Orwell | Páginas: 416"
                        data-image="img/1984.png"
                        data-sinopse="Um clássico da literatura distópica, descrevendo um futuro totalitário onde o Estado controla até o pensamento dos cidadãos. É uma poderosa reflexão sobre liberdade, vigilância e poder.">
                        <img src="img/1984.png" alt="1984">
                        <h3>1984</h3>
                    </a>
 
                    <a href="#carousel-modal" class="carousel-card" data-title="O Código Da Vinci"
                        data-author="Dan Brown | Páginas: 432" data-image="img/codigo da vinte.png"
                        data-sinopse="Um thriller intrigante que combina arte, história e conspiração. O professor Robert Langdon investiga um assassinato no Louvre, mergulhando em segredos ligados à história da humanidade e à religião.">
                        <img src="img/codigo da vinte.png" alt="O Código Da Vinci">
                        <h3>O Código Da Vinci</h3>
                    </a>
                </div>
            </div>
        </section>
 
        <section class="section-content">
            <h2>Mais procurados desta semana</h2>
            <div class="cards-grid">
                <div class="book-card book-card-click">
                    <img src="img/nunca minta.png" alt="Livro Nunca Minta">
                    <h3>Nunca Minta</h3>
                    <p class="genre">Suspense</p>
                    <a href="#modal-labirinto" class="btn-secondary">Saiba Mais</a>
                </div>
                <div class="book-card book-card-click">
                    <img src="img/jogo dos deuses.png" alt="Os Jogos dos Deuses">
                    <h3>Os Jogos dos Deuses</h3>
                    <p class="genre">Fantasia</p>
                    <a href="#modal-reino" class="btn-secondary">Saiba Mais</a>
                </div>
                <div class="book-card book-card-click">
                    <img src="img/o paciente.png" alt="O Paciente">
                    <h3>O Paciente</h3>
                    <p class="genre">Terror Psicológico</p>
                    <a href="#modal-casa" class="btn-secondary">Saiba Mais</a>
                </div>
            </div>
        </section>
    </main>
 
    <div id="carousel-modal" class="modal">
        <div class="modal-content">
            <a href="#close" class="modal-close">&times;</a>
            <div class="modal-body">
                <img id="modal-img" src="" alt="Capa do Livro">
                <div class="modal-text">
                    <h3 id="modal-title"></h3>
                    <h4 id="modal-author"></h4>
                    <p id="modal-sinopse"></p>
                    <a href="#close" class="btn-primary">Fechar</a>
                </div>
            </div>
        </div>
    </div>
 
    <div id="modal-labirinto" class="modal">
        <div class="modal-content">
            <a href="#close" class="modal-close">&times;</a>
            <div class="modal-body">
                <img src="img/nunca minta.png" alt="Capa Nunca Minta">
                <div class="modal-text">
                    <h3>Nunca Minta</h3>
                    <h4>Autor: Freida McFadden | Páginas: 368</h4>
                    <p>Sinopse: Neste thriller psicológico, um casal isolado em uma casa remota começa a descobrir segredos perturbadores sobre o desaparecimento de uma jovem. A trama é repleta de reviravoltas e tensão, mantendo os leitores intrigados até a última página.</p>
                    <a href="#close" class="btn-primary">Fechar</a>
                </div>
            </div>
        </div>
    </div>
 
    <div id="modal-reino" class="modal">
        <div class="modal-content">
            <a href="#close" class="modal-close">&times;</a>
            <div class="modal-body">
                <img src="img/jogo dos deuses.png" alt="Capa Os Jogos dos Deuses">
                <div class="modal-text">
                    <h3>Os Jogos dos Deuses</h3>
                    <h4>Autor: Abigail Owen | Páginas: 480</h4>
                    <p>Sinopse: Neste romance de fantasia épica, os deuses antigos retornam ao mundo mortal, desencadeando uma série de eventos que desafiam o equilíbrio entre os mundos. A trama mistura mitologia, política e magia, oferecendo uma leitura envolvente para os fãs do gênero.</p>
                    <a href="#close" class="btn-primary">Fechar</a>
                </div>
            </div>
        </div>
    </div>
 
    <div id="modal-casa" class="modal">
        <div class="modal-content">
            <a href="#close" class="modal-close">&times;</a>
            <div class="modal-body">
                <img src="img/o paciente.png" alt="Capa O Paciente">
                <div class="modal-text">
                    <h3>O Paciente</h3>
                    <h4>Autor: Jasper DeWitt | Páginas: 320</h4>
                    <p>Sinopse: O jovem residente de psiquiatria, Dr. Parker, assume o caso de Joe, um paciente que está no hospital desde os 6 anos e vive isolado do mundo por ser considerado uma ameaça. Todos os que tentam tratá-lo se tornam loucos ou tiram a própria vida. O estilo narrativo remete à obra Frankenstein, de Mary Shelley, pois se desenrola através dos relatos do doutor Parker feitos em posts de um blog destinado aos médicos.</p>
                    <a href="#close" class="btn-primary">Fechar</a>
                </div>
            </div>
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
 
        // Carrossel 3D
        const carouselGroup = document.querySelector('.carousel-group');
        const prevButton = document.querySelector('.prev-btn');
        const nextButton = document.querySelector('.next-btn');
        const cards = document.querySelectorAll('.carousel-group .carousel-card');
        const totalCards = cards.length;
        const angle = 360 / totalCards;
        let rotationY = 0;
 
        // Gira o carrossel para esquerda ou direita
        function rotateCarousel(direction) {
            if (direction === 'next') {
                rotationY -= angle;
            } else if (direction === 'prev') {
                rotationY += angle;
            }
           
            carouselGroup.style.transform = `translateZ(-300px) rotateY(${rotationY}deg)`;
        }
 
        // Botões para girar o carrossel
        nextButton.addEventListener('click', () => rotateCarousel('next'));
        prevButton.addEventListener('click', () => rotateCarousel('prev'));
 
        // Posição inicial do carrossel
        carouselGroup.style.transform = `translateZ(-300px) rotateY(0deg)`;
 
        // Pop-up do carrossel
        cards.forEach(card => {
            card.addEventListener('click', (e) => {
                e.preventDefault();
               
                // Pega informações do livro clicado
                const title = card.getAttribute('data-title');
                const author = card.getAttribute('data-author');
                const image = card.getAttribute('data-image');
                const sinopse = card.getAttribute('data-sinopse');
 
                // Coloca as informações no pop-up
                document.getElementById('modal-title').textContent = title;
                document.getElementById('modal-author').textContent = author;
                document.getElementById('modal-img').src = image;
                document.getElementById('modal-img').alt = `Capa do livro ${title}`;
                document.getElementById('modal-sinopse').textContent = sinopse;
               
                // Mostra o pop-up
                window.location.hash = 'carousel-modal';
            });
        });
    </script>
</body>
</html>