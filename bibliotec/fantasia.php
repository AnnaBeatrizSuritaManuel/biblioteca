<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>bibliotec - Livros de Fantasia</title>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;600;700&display=swap" rel="stylesheet">
    
    <style>
        /* Cores principais - #8C2C2C como primária e #361A1A como secundária */
        :root {
            --global-primary: #8C2C2C;
            --global-secondary: #361A1A;
            --global-accent: #8C2C2C;
            --global-light: #E6CECE;
            --global-background: #F8F0F0;
            --global-dark: #2C1818;
            --shadow-light: rgba(140, 44, 44, 0.2);
            --card-bg: #FFFFFF;
            --modal-bg: rgba(54, 26, 26, 0.95);
            --modal-content-bg: #FFFFFF;
            --navbar-bg: #E6CECE;
        }

        /* Configurações gerais */
        * { margin: 0; padding: 0; box-sizing: border-box; }
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
        a { text-decoration: none; color: var(--global-primary); transition: color 0.3s; }
        
        /* Layout principal */
        main { 
            padding-top: 80px; 
            min-height: calc(100vh - 80px - 60px); 
            background-color: var(--global-background);
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
        
        /* Menu de navegação */
        .navbar {  
            display: flex;  
            justify-content: space-between;  
            align-items: center;  
            padding: 15px 5%; 
            background-color: var(--navbar-bg);
            box-shadow: 0 2px 20px var(--shadow-light);  
            position: fixed; top: 0; width: 100%; z-index: 1000;  
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
        .nav-links a[href="categorias.php"] { color: var(--global-primary); } 
        .nav-links a.active, .nav-links a:hover { color: var(--global-primary); } 
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
        .nav-links a.active:not(.btn-login):after { width: 100%; }
        
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
        .menu-toggle { display: none; background: none; border: none; cursor: pointer; padding: 10px; }
        .menu-toggle .bar { display: block; width: 25px; height: 3px; margin: 4px auto; background-color: var(--global-dark);  transition: all 0.3s ease-in-out; }
        
        @media (max-width: 768px) {
            .nav-links {
                display: none; 
                flex-direction: column; 
                position: absolute; 
                top: 70px; 
                left: 0; 
                width: 100%;
                background-color: var(--navbar-bg); 
                box-shadow: 0 5px 20px var(--shadow-light); 
                padding: 10px 0;
            }
            .nav-links.open { display: flex; }
            .nav-links a { margin: 8px 0; padding: 12px 5%; font-size: 1.1rem; text-align: center; border-bottom: 1px solid rgba(140, 44, 44, 0.1); margin-left: 0; }
            .btn-login { margin: 10px auto; width: 80%; }
            .menu-toggle { display: block; }
            
            /* Animação do menu */
            .menu-toggle.open .bar:nth-child(1) { transform: translateY(7px) rotate(45deg); }
            .menu-toggle.open .bar:nth-child(2) { opacity: 0; }
            .menu-toggle.open .bar:nth-child(3) { transform: translateY(-7px) rotate(-45deg); }
        } 

        /* Seção de livros de fantasia */
        .fantasia-container {
            padding: 60px 5%;
            text-align: center; 
        }
        
        .fantasia-container h1 {
            font-size: 3.5rem;
            color: var(--global-primary); 
            margin-bottom: 15px;
            text-transform: uppercase;
            letter-spacing: 3px;
            text-shadow: 2px 2px 4px rgba(140, 44, 44, 0.3);
        }

        .fantasia-container p.subtitle {
            font-size: 1.3rem;
            color: var(--global-secondary); 
            margin-bottom: 50px;
            font-weight: 500;
        }

        /* Grid de livros */
        .book-list {
            display: flex;
            flex-wrap: wrap;
            justify-content: center; 
            gap: 40px;
            max-width: 1300px;
            margin: 0 auto;
        }

        /* Cards de livros */
        .book-card {
            background-color: var(--card-bg); 
            border: 3px solid var(--global-light); 
            border-radius: 15px;
            padding: 25px;
            width: 100%;
            max-width: 280px;
            box-shadow: 0 8px 25px var(--shadow-light);
            transition: all 0.4s ease;
            text-align: left; 
            cursor: pointer; 
        }

        .book-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 35px rgba(140, 44, 44, 0.25);
            border-color: var(--global-primary);
        }

        .book-card img {
            width: 100%;
            height: auto;
            border-radius: 10px;
            margin-bottom: 20px;
            border: 2px solid var(--global-light);
            transition: transform 0.3s ease;
        }

        .book-card:hover img {
            transform: scale(1.05);
        }

        .book-card h3 {
            font-size: 1.4rem;
            color: var(--global-primary); 
            margin-bottom: 8px;
        }

        .book-card .author {
            color: var(--global-secondary); 
            font-weight: 600;
            display: block;
            margin-bottom: 12px;
        }

        /* Janelas pop-up */
        .modal {
            display: none; 
            position: fixed; 
            z-index: 2000; 
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: var(--modal-bg); 
            padding-top: 60px;
        }

        .modal-content {
            background-color: var(--modal-content-bg); 
            margin: 5% auto; 
            padding: 40px;
            border: 3px solid var(--global-primary); 
            width: 85%;
            max-width: 750px;
            border-radius: 20px;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.4);
            display: flex;
            gap: 35px;
            animation: fadeIn 0.4s ease;
            color: var(--global-dark);
        }

        /* Animação do pop-up */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .modal-content .book-image {
            flex: 0 0 220px; 
            max-height: 320px;
            overflow: hidden;
            border-radius: 12px;
        }
        
        .modal-content .book-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 10px;
            border: 3px solid var(--global-primary);
        }

        .modal-details {
            flex-grow: 1;
            text-align: left;
        }

        .modal-details h2 {
            color: var(--global-primary);
            font-size: 2.2rem;
            margin-bottom: 10px;
        }

        .modal-details .author {
            color: var(--global-secondary); 
            font-size: 1.2rem;
            margin-bottom: 25px;
            display: block;
            font-weight: 600;
        }

        .modal-details p {
            color: var(--global-dark); 
            font-size: 1.1rem;
            margin-bottom: 30px;
            line-height: 1.7;
        }

        /* Botão para fechar pop-up */
        .close-btn {
            float: right;
            font-size: 32px;
            font-weight: bold;
            color: var(--global-primary);
            transition: color 0.3s;
            cursor: pointer;
            line-height: 1;
        }

        .close-btn:hover,
        .close-btn:focus {
            color: var(--global-secondary);
            text-decoration: none;
            cursor: pointer;
        }

        /* Responsividade do modal */
        @media (max-width: 768px) {
            .modal-content {
                flex-direction: column;
                margin: 20px;
                padding: 30px;
                gap: 25px;
            }
            .modal-content .book-image {
                flex: none;
                max-width: 200px;
                margin: 0 auto 20px auto;
            }
            .modal-details {
                text-align: center;
            }
            .modal-details .author {
                text-align: center;
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
    </style>
</head>
<body>

    <!-- Pop-up de detalhes do livro -->
    <div id="bookModal" class="modal">
        <div class="modal-content">
            <span class="close-btn">&times;</span>
            <div class="book-image">
                <img id="modalImage" src="" alt="Capa do Livro">
            </div>
            <div class="modal-details">
                <h2 id="modalTitle"></h2>
                <span id="modalAuthor" class="author"></span>
                <p id="modalDescription"></p>
                <button class="btn-primary" onclick="closeModal()" style="width: 100%; padding: 15px; font-size: 1.1rem;">Fechar Detalhes</button>
            </div>
        </div>
    </div>

    <!-- Menu de navegação -->
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

    <!-- Conteúdo principal -->
    <main>
        <div class="fantasia-container">
            <h1>Fantasia & Magia</h1>
            <p class="subtitle">Leia estes livros e embarque em jornadas incríveis, onde a magia é real e as lendas ganham vida.</p>

            <!-- Lista de livros -->
            <div class="book-list">
                
                <div class="book-card" onclick="openModal('O Senhor dos Anéis', 'J.R.R. Tolkien', 'img/senhor dos aneis.png', 'Uma das obras mais influentes da fantasia. Conta a jornada de Frodo Bolseiro para destruir o Um Anel, enfrentando perigos e batalhas numa terra mágica chamada Terra Média.', 'Fantasia épica')">
                    <img src="img/senhor dos aneis.png" alt="Capa do Livro O Senhor dos Anéis"> 
                    <h3>O Senhor dos Anéis</h3>
                    <span class="author">J.R.R. Tolkien</span>
                    <p style="color: var(--global-secondary); font-size: 0.95rem;">Fantasia épica</p>
                    <a href="javascript:void(0)" class="btn-primary" style="margin-top: 15px; width: 100%;">Ver Detalhes</a>
                </div>

                <div class="book-card" onclick="openModal('As Crônicas de Nárnia', 'C.S. Lewis', 'img/narnia.png', 'Uma série encantadora que mistura aventura e moralidade. Crianças descobrem um mundo mágico chamado Nárnia, vivendo aventuras épicas repletas de magia, batalhas e criaturas fantásticas.', 'Fantasia clássica')">
                    <img src="img/narnia.png" alt="Capa do Livro As Crônicas de Nárnia">
                    <h3>As Crônicas de Nárnia</h3>
                    <span class="author">C.S. Lewis</span>
                    <p style="color: var(--global-secondary); font-size: 0.95rem;">Fantasia clássica</p>
                    <a href="javascript:void(0)" class="btn-primary" style="margin-top: 15px; width: 100%;">Ver Detalhes</a>
                </div>

                <div class="book-card" onclick="openModal('As Crônicas de Spiderwick', 'Holly Black & Tony DiTerlizzi', 'img/spiderwick.png', 'Uma série fantástica sobre três irmãos que descobrem um mundo secreto habitado por fadas, duendes e criaturas mágicas, enquanto enfrentam mistérios e perigos.', 'Fantasia infantil / aventura')">
                    <img src="img/spiderwick.png" alt="Capa do Livro Mistborn">
                    <h3>As Crônicas de Spiderwick</h3>
                    <span class="author">Holly Black & Tony DiTerlizzi</span>
                    <p style="color: var(--global-secondary); font-size: 0.95rem;">Fantasia infantil / aventura</p>
                    <a href="javascript:void(0)" class="btn-primary" style="margin-top: 15px; width: 100%;">Ver Detalhes</a>
                </div>

                <div class="book-card" onclick="openModal('Harry Potter e a Pedra Filosofal', 'J.K. Rowling', 'img/harry.png', 'Primeiro livro da série Harry Potter. Harry descobre que é um bruxo e ingressa na Escola de Magia de Hogwarts, onde aprende magia, faz amigos e enfrenta seu destino.', 'Fantasia juvenil / mágica')">
                    <img src="img/harry.png" alt="Capa do Livro Harry Potter e a Pedra Filosofal">
                    <h3>Harry Potter e a Pedra Filosofal</h3>
                    <span class="author">J.K. Rowling</span>
                    <p style="color: var(--global-secondary); font-size: 0.95rem;">Fantasia juvenil / mágica</p>
                    <a href="javascript:void(0)" class="btn-primary" style="margin-top: 15px; width: 100%;">Ver Detalhes</a>
                </div>
            </div>
        </div>
    </main>

    <footer>
        <p>&copy; 2025 bibliotec. Todos os direitos reservados. Feito com magia. ✨</p>
    </footer>

    <script>
        // Menu para celular
        document.querySelector('.menu-toggle').addEventListener('click', function() {
            const navLinks = document.querySelector('.nav-links');
            this.classList.toggle('open');
            navLinks.classList.toggle('open');
        });

        // Pop-up de detalhes
        const modal = document.getElementById('bookModal');
        const span = document.getElementsByClassName('close-btn')[0];

        // Função para abrir o pop-up
        function openModal(title, author, image, description) {
            document.getElementById('modalTitle').textContent = title;
            document.getElementById('modalAuthor').textContent = 'Por: ' + author;
            document.getElementById('modalImage').src = image;
            document.getElementById('modalDescription').textContent = description;
            modal.style.display = "block";
        }

        // Função para fechar o pop-up
        function closeModal() {
            modal.style.display = "none";
        }

        // Fechar pop-up ao clicar no X
        span.onclick = closeModal;

        // Fechar pop-up ao clicar fora
        window.onclick = function(event) {
            if (event.target == modal) {
                closeModal();
            }
        }
    </script>
</body>
</html>