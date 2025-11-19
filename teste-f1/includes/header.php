<?php
// NÃO colocar session_start() aqui - já é feito nas páginas
$pagina_atual = basename($_SERVER['PHP_SELF']);
$eh_pagina_admin = strpos($_SERVER['PHP_SELF'], '/admin/') !== false;
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Bibliotec</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="<?= $eh_pagina_admin ? '../' : '' ?>assets/css/estilo.css">
</head>
<body>
    <div class="app-container">
        <header class="navbar">
            <div class="nav-container">
                <a href="<?= $eh_pagina_admin ? '../index.php' : 'index.php' ?>" class="logo">
                    <span class="logo-icon">📚</span>
                    Bibliotec
                </a>
                
                <nav class="nav-links">
                    <?php if($eh_pagina_admin): ?>
                        <!-- Menu para páginas ADMIN -->
                        <a href="../index.php">Site Principal</a>
                        <a href="dashboard.php" class="<?= $pagina_atual == 'dashboard.php' ? 'active' : '' ?>">Dashboard</a>
                        <a href="livros.php" class="<?= $pagina_atual == 'livros.php' ? 'active' : '' ?>">Livros</a>
                        <a href="usuarios.php" class="<?= $pagina_atual == 'usuarios.php' ? 'active' : '' ?>">Usuários</a>
                        <a href="emprestimos.php" class="<?= $pagina_atual == 'emprestimos.php' ? 'active' : '' ?>">Empréstimos</a>
                        <a href="autores.php" class="<?= $pagina_atual == 'autores.php' ? 'active' : '' ?>">Autores</a>
                    <?php else: ?>
                        <!-- Menu para páginas NORMAIS -->
                        <a href="index.php" class="<?= $pagina_atual == 'index.php' ? 'active' : '' ?>">Início</a>
                        <a href="categorias.php" class="<?= $pagina_atual == 'categorias.php' ? 'active' : '' ?>">Categorias</a>
                        <a href="sobre.php" class="<?= $pagina_atual == 'sobre.php' ? 'active' : '' ?>">Sobre</a>
                    <?php endif; ?>
                    
                    <?php if(isset($_SESSION['usuario_id'])): ?>
                        <div style="display: flex; align-items: center; gap: 1rem;">
                            <span style="color: var(--text-secondary);">
                                Olá, <?= htmlspecialchars($_SESSION['usuario_nome']) ?>!
                                <?php if($_SESSION['usuario_tipo'] == 'admin'): ?>
                                    <span style="background: var(--primary-main); color: white; padding: 2px 6px; border-radius: 4px; font-size: 0.7rem; margin-left: 0.5rem;">ADMIN</span>
                                <?php endif; ?>
                            </span>
                            
                            <?php if($eh_pagina_admin): ?>
                                <!-- Botões para ADMIN -->
                                <a href="../usuario.php" class="btn btn-secondary">
                                    <i class="fas fa-user"></i> Meu Perfil
                                </a>
                                <a href="../logout.php" class="btn btn-outline">
                                    <i class="fas fa-sign-out-alt"></i> Sair
                                </a>
                            <?php else: ?>
                                <!-- Botões para USUÁRIO NORMAL -->
                                <a href="usuario.php" class="btn btn-secondary">
                                    <i class="fas fa-user"></i> Meu Perfil
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
                
                <button class="btn btn-ghost mobile-menu-btn">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
        </header>

        <main>
            <div class="container">
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