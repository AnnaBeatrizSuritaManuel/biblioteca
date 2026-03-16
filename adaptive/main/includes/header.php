<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../config/auth.php';

$page_title = isset($page_title) ? $page_title : 'FitZone';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title; ?> - FitZone</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="<?php echo (strpos(__DIR__, 'pages') !== false || strpos(__DIR__, 'admin') !== false) ? '../assets/css/style.css' : 'assets/css/style.css'; ?>">
</head>
<body>
    <!-- Header/Navigation -->
    <header class="header">
        <div class="container">
            <div class="header-content">
                <div class="logo">
                    <i class="fas fa-dumbbell"></i>
                    <span>AdaptiveMove</span>
                </div>

                <nav class="nav">
                    <a href="<?php echo (strpos(__DIR__, 'pages') !== false || strpos(__DIR__, 'admin') !== false) ? '../' : ''; ?>index.php" class="nav-link">Home</a>
                    <a href="<?php echo (strpos(__DIR__, 'pages') !== false || strpos(__DIR__, 'admin') !== false) ? '../pages/services.php' : 'pages/services.php'; ?>" class="nav-link">Serviços</a>
                    <a href="<?php echo (strpos(__DIR__, 'pages') !== false || strpos(__DIR__, 'admin') !== false) ? '../pages/training.php' : 'pages/training.php'; ?>" class="nav-link">Treinos</a>
                    <a href="<?php echo (strpos(__DIR__, 'pages') !== false || strpos(__DIR__, 'admin') !== false) ? '../pages/map.php' : 'pages/map.php'; ?>" class="nav-link">Academias</a>
                    <a href="<?php echo (strpos(__DIR__, 'pages') !== false || strpos(__DIR__, 'admin') !== false) ? '../pages/plans.php' : 'pages/plans.php'; ?>" class="nav-link"><i class="fas fa-tag"></i> Planos</a>
                    <a href="<?php echo (strpos(__DIR__, 'pages') !== false || strpos(__DIR__, 'admin') !== false) ? '../pages/ods3.php' : 'pages/ods3.php'; ?>" class="nav-link"><i class="fas fa-heart"></i> ODS 3</a>
                    <a href="<?php echo (strpos(__DIR__, 'pages') !== false || strpos(__DIR__, 'admin') !== false) ? '../pages/contact.php' : 'pages/contact.php'; ?>" class="nav-link">Contato</a>
                </nav>

                <div class="header-actions">
                    <?php if (isLoggedIn()): ?>
                        <div class="user-menu">
                            <button class="user-btn" id="userBtn">
                                <?php if ($_SESSION['user_image']): ?>
                                    <img src="<?php echo $_SESSION['user_image']; ?>" alt="<?php echo $_SESSION['user_name']; ?>">
                                <?php else: ?>
                                    <i class="fas fa-user-circle"></i>
                                <?php endif; ?>
                                <span><?php echo $_SESSION['user_name']; ?></span>
                            </button>
                            <div class="dropdown-menu" id="dropdownMenu">
                                <a href="<?php echo (strpos(__DIR__, 'pages') !== false || strpos(__DIR__, 'admin') !== false) ? '../pages/profile.php' : 'pages/profile.php'; ?>" class="dropdown-item">
                                    <i class="fas fa-user"></i> Meu Perfil
                                </a>
                                <a href="<?php echo (strpos(__DIR__, 'pages') !== false || strpos(__DIR__, 'admin') !== false) ? '../pages/calendar.php' : 'pages/calendar.php'; ?>" class="dropdown-item">
                                    <i class="fas fa-calendar"></i> Meus Treinos
                                </a>
                                <?php if (isAdmin()): ?>
                                    <hr style="margin: 0.5rem 0; border: none; border-top: 1px solid rgba(0, 212, 255, 0.2);">
                                    <a href="<?php echo (strpos(__DIR__, 'pages') !== false || strpos(__DIR__, 'admin') !== false) ? '../admin/dashboard.php' : 'admin/dashboard.php'; ?>" class="dropdown-item">
                                        <i class="fas fa-crown"></i> Painel Admin
                                    </a>
                                <?php endif; ?>
                                <hr style="margin: 0.5rem 0; border: none; border-top: 1px solid rgba(0, 212, 255, 0.2);">
                                <a href="<?php echo (strpos(__DIR__, 'pages') !== false || strpos(__DIR__, 'admin') !== false) ? '../api/logout.php' : 'api/logout.php'; ?>" class="dropdown-item logout">
                                    <i class="fas fa-sign-out-alt"></i> Sair
                                </a>
                            </div>
                        </div>
                    <?php else: ?>
                        <a href="<?php echo (strpos(__DIR__, 'pages') !== false || strpos(__DIR__, 'admin') !== false) ? '../pages/login.php' : 'pages/login.php'; ?>" class="btn btn-outline" style="background: rgba(255, 0, 0, 0.1); border-color: #ff6b6b; color: #ff6b6b;" title="Login de Administrador">
                            <i class="fas fa-crown"></i> Admin
                        </a>
                        <a href="<?php echo (strpos(__DIR__, 'pages') !== false || strpos(__DIR__, 'admin') !== false) ? '../pages/login.php' : 'pages/login.php'; ?>" class="btn btn-outline">Login</a>
                        <a href="<?php echo (strpos(__DIR__, 'pages') !== false || strpos(__DIR__, 'admin') !== false) ? '../pages/register.php' : 'pages/register.php'; ?>" class="btn btn-primary">Cadastro</a>
                    <?php endif; ?>
                </div>

                <button class="mobile-menu-btn" id="mobileMenuBtn">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
        </div>
    </header>

    <script>
        // Menu dropdown
        document.getElementById('userBtn')?.addEventListener('click', function() {
            document.getElementById('dropdownMenu').classList.toggle('active');
        });

        // Fechar dropdown ao clicar fora
        document.addEventListener('click', function(e) {
            if (!e.target.closest('.user-menu')) {
                document.getElementById('dropdownMenu')?.classList.remove('active');
            }
        });

        // Menu mobile
        document.getElementById('mobileMenuBtn')?.addEventListener('click', function() {
            document.querySelector('.nav').classList.toggle('active');
        });
    </script>
</body>
</html>
