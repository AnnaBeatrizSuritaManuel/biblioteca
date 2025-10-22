<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>bibliotec - Meu Perfil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
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
        body {
            font-family: 'Quicksand', sans-serif;
            background-color: var(--global-background);
            display: flex; 
            flex-direction: column; 
            min-height: 100vh; 
        }
        
        .content-wrap {
            flex-grow: 1; 
        }

        /* --- ESTILOS DO MENU DE NAVEGAÇÃO --- */
        .navbar-custom {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 5%;
            background-color: var(--global-light);
            box-shadow: 0 2px 20px var(--shadow-light);
            position: sticky;
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
        
        .nav-links-custom {
            display: flex;
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .nav-links-custom li {
            margin-left: 20px;
        }
        
        .nav-links-custom a {
            text-decoration: none;
            font-weight: 600;
            font-size: 1rem;
            color: var(--global-dark);
            padding: 8px 0;
            position: relative;
            transition: color 0.3s;
        }
        
        .nav-links-custom a.active, .nav-links-custom a:hover {
            color: var(--global-primary);
        }

        /* Indicador de link ativo*/
        .nav-links-custom a:after {
            content: '';
            position: absolute;
            width: 0;
            height: 3px;
            background: var(--global-primary);
            bottom: -5px;
            left: 0;
            transition: width 0.3s;
        }

        .nav-links-custom a:hover:after,
        .nav-links-custom a.active:after {
            width: 100%;
        }

        /* Estilo para o botão de Perfil/Sair */
        .btn-profile-link {
            background-color: var(--global-primary);
            color: var(--global-light) !important;
            padding: 8px 20px;
            border-radius: 25px;
            text-decoration: none;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            transition: all 0.3s ease;
        }
        .btn-profile-link:hover {
            background-color: var(--global-secondary);
            color: white !important;
            transform: translateY(-2px);
        }

        /* Cabeçalho do Perfil */
        .profile-header {
            background: linear-gradient(135deg, var(--global-primary) 0%, var(--global-secondary) 100%);
            color: white;
            padding: 60px 0;
            margin-bottom: 40px;
        }
        .profile-header .display-5 {
            color: white;
        }
        .profile-avatar {
            width: 100px;
            height: 100px;
            background-color: var(--global-light);
            color: var(--global-primary);
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 3rem;
            border: 4px solid white;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        /* Cards e Botões */
        .profile-card {
            background-color: var(--global-light);
            border: 2px solid var(--global-primary);
            border-radius: 20px;
            box-shadow: 0 8px 25px var(--shadow-light);
            height: 100%;
            transition: all 0.3s ease;
        }

        .profile-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 30px rgba(140, 44, 44, 0.15);
        }

        .card-title {
            color: var(--global-primary);
            font-weight: 700;
        }
        .btn-primary {
            background-color: var(--global-primary);
            border-color: var(--global-primary);
            border-radius: 30px;
            transition: all 0.3s ease;
            padding: 10px 20px;
            font-weight: 600;
        }
        .btn-primary:hover {
            background-color: var(--global-secondary);
            border-color: var(--global-secondary);
            transform: translateY(-2px);
        }

        /* Menu Lateral (Nav-Pills) */
        .nav-pills .nav-link {
            color: var(--global-dark);
            border-radius: 15px;
            margin-bottom: 10px;
            padding: 12px 20px;
            transition: all 0.3s ease;
        }
        .nav-pills .nav-link i {
            color: var(--global-primary);
        }
        .nav-pills .nav-link.active {
            background-color: var(--global-primary);
            color: white !important;
        }
        .nav-pills .nav-link.active i {
            color: white;
        }
        
        /* Estilo para Livros Já Lidos */
        .list-group-item {
            background-color: transparent;
            border-color: rgba(140, 44, 44, 0.2);
            padding: 15px 20px;
            transition: all 0.3s ease;
        }

        .list-group-item:hover {
            background-color: rgba(140, 44, 44, 0.1);
        }

        .list-group-item strong {
            color: var(--global-dark);
        }

        /* Formulários */
        .form-control {
            border: 2px solid #d4b8b8;
            border-radius: 10px;
            padding: 12px 15px;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: var(--global-primary);
            box-shadow: 0 0 8px rgba(140, 44, 44, 0.3);
        }

        /* --- rodapé --- */
        .footer-basic {
            text-align: center;
            padding: 30px 20px;
            background-color: var(--global-primary);
            color: var(--global-light);
            font-size: 0.95rem;
            margin-top: 50px;
            width: 100%;
        }

        .badge-custom {
            background-color: var(--global-primary);
        }
    </style>
</head>
<body>
    
    <header class="navbar-custom">
        <div class="logo">
            <span class="logo-icon">📚</span>
            bibliotec
        </div> 
        <ul class="nav-links-custom">
            <li><a href="index.php">Home</a></li>
            <li><a href="categorias.php">Categorias</a></li>
            <li><a href="sobre.php">Sobre</a></li>
            
            <li class="nav-item dropdown">
                <a class="nav-link btn-profile-link dropdown-toggle active" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="margin-left: 20px;">
                    <i class="fas fa-user me-2"></i> Lara Santos
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><h6 class="dropdown-header">Opções de Usuário</h6></li>
                    <li><a class="dropdown-item" href="usuario.php"><i class="fas fa-id-card me-2"></i> Meu Perfil</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item text-danger" href="index.php"><i class="fas fa-sign-out-alt me-2"></i> Sair da Conta</a></li>
                </ul>
            </li>
        </ul>
    </header>

    <div class="content-wrap">
        <div class="profile-header">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-12 text-center">
                        <div class="profile-avatar mb-4">
                            <i class="fas fa-user"></i>
                        </div>
                        <h1 class="display-5 fw-bold">Lara Santos</h1>
                        <p class="lead">leitora.lara.s@exemplo.com | Membro desde: 15/03/2025</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                
                <div class="col-md-3 mb-4">
                    <div class="profile-card p-4">
                        <h5 class="card-title mb-4"><i class="fas fa-bookmark me-2"></i>Minha Biblioteca</h5>
                        <ul class="nav nav-pills flex-column">
                            <li class="nav-item">
                                <a class="nav-link active" href="#dados" data-bs-toggle="pill">
                                    <i class="fas fa-user me-2"></i>Dados Pessoais
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#lidos" data-bs-toggle="pill">
                                    <i class="fas fa-glasses me-2"></i>Livros Já Lidos
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#config" data-bs-toggle="pill">
                                    <i class="fas fa-edit me-2"></i>Editar Perfil
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="col-md-9">
                    <div class="tab-content">
                        
                        <div class="tab-pane fade show active" id="dados">
                            <div class="profile-card p-4">
                                <h4 class="card-title mb-4"><i class="fas fa-user-circle me-2"></i>Dados Pessoais</h4>
                                <div class="row text-start">
                                    <div class="col-md-6">
                                        <p><strong>Nome Completo:</strong> Lara Santos</p>
                                        <p><strong>E-mail:</strong> leitora.lara.s@exemplo.com</p>
                                        <p><strong>Telefone:</strong> (11) 98765-4321</p>
                                    </div>
                                    <div class="col-md-6">
                                        <p><strong>Status:</strong> <span class="badge badge-custom">Ativo</span></p>
                                        <p><strong>Localização:</strong> Rio de Janeiro, RJ</p>
                                        <p><strong>Biografia:</strong> Amante de thrillers e tudo que me tire o sono.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="lidos">
                            <div class="profile-card p-4">
                                <h4 class="card-title mb-4"><i class="fas fa-glasses me-2"></i>Livros Já Lidos</h4>
                                <p class="text-muted text-start mb-4">Seus livros favoritos e recentes</p>
                                
                                <ul class="list-group list-group-flush text-start">
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <div>
                                            <strong>O Iluminado</strong> <br><small class="text-muted">Stephen King (Terror)</small>
                                        </div>
                                        <span class="badge bg-danger rounded-pill">Clássico</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <div>
                                            <strong>Garota Exemplar (Gone Girl)</strong> <br><small class="text-muted">Gillian Flynn (Suspense)</small>
                                        </div>
                                        <span class="badge bg-info rounded-pill">Psicológico</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <div>
                                            <strong>O Silêncio dos Inocentes</strong> <br><small class="text-muted">Thomas Harris (Suspense)</small>
                                        </div>
                                        <span class="badge bg-info rounded-pill">Thriller</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        
                        <div class="tab-pane fade" id="config">
                            <div class="profile-card p-4 text-start">
                                <h4 class="card-title mb-4"><i class="fas fa-edit me-2"></i>Editar Perfil</h4>
                                <p class="text-muted mb-4">Altere suas informações pessoais.</p>

                                <form action="#" method="POST"> 
                                    <div class="mb-3">
                                        <label for="editNome" class="form-label">Nome Completo</label>
                                        <input type="text" class="form-control" id="editNome" value="Lara Santos"> 
                                    </div>
                                    <div class="mb-3">
                                        <label for="editEmail" class="form-label">E-mail</label>
                                        <input type="email" class="form-control" id="editEmail" value="leitora.lara.s@exemplo.com">
                                    </div>
                                    <div class="mb-3">
                                        <label for="editTelefone" class="form-label">Telefone</label>
                                        <input type="tel" class="form-control" id="editTelefone" value="(11) 98765-4321">
                                    </div>
                                    <div class="mb-3">
                                        <label for="editEndereco" class="form-label">Endereço (Cidade/Estado)</label>
                                        <input type="text" class="form-control" id="editEndereco" value="Rio de Janeiro, RJ">
                                    </div>
                                    <div class="mb-3">
                                        <label for="editBio" class="form-label">Biografia</label>
                                        <textarea class="form-control" id="editBio" rows="3">Amante de thrillers e tudo que me tire o sono.</textarea>
                                    </div>
                                    
                                    <button type="button" class="btn btn-primary mt-3" id="btnSalvarSimulacao">
                                        <i class="fas fa-save me-2"></i>Salvar Alterações
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <footer class="footer-basic">
        <div class="container">
            <p>&copy; 2025 bibliotec. Todos os direitos reservados.</p>
        </div>
    </footer>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Simulação de salvamento
        document.getElementById('btnSalvarSimulacao').addEventListener('click', function() {
            alert('Alterações salvas com sucesso!');
        });
    </script>
</body>
</html>