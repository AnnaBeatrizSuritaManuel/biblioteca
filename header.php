<?php
$pagina_atual = basename($_SERVER['PHP_SELF']);
$eh_pagina_admin = strpos($_SERVER['PHP_SELF'], '/admin/') !== false;
$base_path = $eh_pagina_admin ? '../' : '';
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bibliotec</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="<?= $base_path ?>assets/css/estilo.css">
</head>
<body>
    <!-- HEADER SIMPLES SEM DIVS EXTRAS -->
    <header class="navbar">
        <div class="nav-container">
            <a href="<?= $base_path ?>index.php" class="logo">
                <span class="logo-icon">
                </span>
                Bibliotec
            </a>
            
            <nav class="nav-links">
                <?php if($eh_pagina_admin): ?>
                    <!-- Menu ADMIN -->
                    <a href="../index.php">Site Principal</a>
                    <a href="dashboard.php" class="<?= $pagina_atual == 'dashboard.php' ? 'active' : '' ?>">Dashboard</a>
                    <a href="livros.php" class="<?= $pagina_atual == 'livros.php' ? 'active' : '' ?>">Livros</a>
                    <a href="usuarios.php" class="<?= $pagina_atual == 'usuarios.php' ? 'active' : '' ?>">Usuários</a>
                    <a href="emprestimos.php" class="<?= $pagina_atual == 'emprestimos.php' ? 'active' : '' ?>">Empréstimos</a>
                    <a href="autores.php" class="<?= $pagina_atual == 'autores.php' ? 'active' : '' ?>">Autores</a>
                <?php else: ?>
                    <!-- Menu NORMAL -->
                    <a href="index.php" class="<?= $pagina_atual == 'index.php' ? 'active' : '' ?>">Início</a>
                    <a href="categorias.php" class="<?= $pagina_atual == 'categorias.php' ? 'active' : '' ?>">Categorias</a>
                    <a href="sobre.php" class="<?= $pagina_atual == 'sobre.php' ? 'active' : '' ?>">Sobre</a>
                <?php endif; ?>
                
                <?php if(isset($_SESSION['usuario_id'])): ?>
                    <div class="user-menu">
                        <span class="user-greeting">Olá, <?= htmlspecialchars($_SESSION['usuario_nome']) ?>!</span>
                        <?php if($_SESSION['usuario_tipo'] == 'admin'): ?>
                            <span class="admin-badge">ADMIN</span>
                        <?php endif; ?>
                        
                        <?php if($eh_pagina_admin): ?>
                            <a href="../usuario.php" class="btn btn-secondary">
                                <i class="fas fa-user"></i> Perfil
                            </a>
                            <a href="../logout.php" class="btn btn-outline">
                                <i class="fas fa-sign-out-alt"></i> Sair
                            </a>
                        <?php else: ?>
                            <a href="usuario.php" class="btn btn-secondary">
                                <i class="fas fa-user"></i> Perfil
                            </a>
                            <?php if($_SESSION['usuario_tipo'] == 'admin'): ?>
                                <a href="admin/dashboard.php" class="btn btn-outline">
                                    <i class="fas fa-cog"></i> Admin
                                </a>
                            <?php endif; ?>
                            <a href="logout.php" class="btn btn-outline">
                                <i class="fas fa-sign-out-alt"></i> Sair
                            </a>
                        <?php endif; ?>
                    </div>
                <?php else: ?>
                    <a href="login.php" class="btn btn-secondary">Entrar</a>
                <?php endif; ?>
            </nav>
            
            <button class="mobile-menu-btn">
                <i class="fas fa-bars"></i>
            </button>
        </div>
    </header>

    <!-- CONTEÚDO PRINCIPAL -->
    <main class="main-content">
        <div class="container">
            <!-- Mensagens de alerta -->
            <?php if(isset($_SESSION['sucesso'])): ?>
                <div class="alert alert-sucesso">
                    <?= $_SESSION['sucesso'] ?>
                    <?php unset($_SESSION['sucesso']); ?>
                </div>
            <?php endif; ?>
            
            <?php if(isset($_SESSION['erro'])): ?>
                <div class="alert alert-erro">
                    <?= $_SESSION['erro'] ?>
                    <?php unset($_SESSION['erro']); ?>
                </div>
            <?php endif; ?>