<?php
$page_title = 'Comunidade';
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../config/auth.php';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title; ?> - AdaptiveMove</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <?php include '../includes/header.php'; ?>

    <section class="community">
        <div class="container">
            <div class="section-header">
                <div class="section-badge">
                    <span class="badge-dot"></span>
                    <span>Nossa Comunidade</span>
                </div>
                <h2>Histórias de Sucesso</h2>
                <p>Conheça as transformações de nossos membros</p>
            </div>

            <div class="services-grid">
                <div class="service-card">
                    <div class="service-icon">
                        <i class="fas fa-user-circle"></i>
                    </div>
                    <h3>João Silva</h3>
                    <p>"Perdi 25kg em 6 meses com a AdaptiveMove. A comunidade me motivou a não desistir!"</p>
                    <div class="accent-line"></div>
                </div>

                <div class="service-card">
                    <div class="service-icon">
                        <i class="fas fa-user-circle"></i>
                    </div>
                    <h3>Maria Santos</h3>
                    <p>"Ganhei muita confiança e força. Os personal trainers são incríveis!"</p>
                    <div class="accent-line"></div>
                </div>

                <div class="service-card">
                    <div class="service-icon">
                        <i class="fas fa-user-circle"></i>
                    </div>
                    <h3>Carlos Oliveira</h3>
                    <p>"Melhorei minha saúde cardiovascular e agora tenho mais energia no dia a dia."</p>
                    <div class="accent-line"></div>
                </div>

                <div class="service-card">
                    <div class="service-icon">
                        <i class="fas fa-user-circle"></i>
                    </div>
                    <h3>Ana Costa</h3>
                    <p>"Encontrei uma segunda família aqui. A motivação é constante!"</p>
                    <div class="accent-line"></div>
                </div>

                <div class="service-card">
                    <div class="service-icon">
                        <i class="fas fa-user-circle"></i>
                    </div>
                    <h3>Pedro Ferreira</h3>
                    <p>"Transformei meu corpo e minha mente. Recomendo para todos!"</p>
                    <div class="accent-line"></div>
                </div>

                <div class="service-card">
                    <div class="service-icon">
                        <i class="fas fa-user-circle"></i>
                    </div>
                    <h3>Lucia Martins</h3>
                    <p>"Aos 55 anos, nunca pensei que conseguiria. Aqui provei que é possível!"</p>
                    <div class="accent-line"></div>
                </div>
            </div>

            <div style="text-align: center; margin-top: 3rem;">
                <?php if (isLoggedIn()): ?>
                    <a href="profile.php" class="btn btn-primary">
                        <i class="fas fa-user"></i> Meu Perfil
                    </a>
                <?php else: ?>
                    <a href="register.php" class="btn btn-primary">
                        <i class="fas fa-user-plus"></i> Junte-se à Comunidade
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <?php include '../includes/footer.php'; ?>
</body>
</html>
