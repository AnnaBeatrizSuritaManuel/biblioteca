<?php
$page_title = 'Programas de Treino';
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

    <section class="training">
        <div class="container">
            <div class="section-header">
                <div class="section-badge">
                    <span class="badge-dot"></span>
                    <span>Programas de Treino</span>
                </div>
                <h2>Escolha seu programa ideal</h2>
                <p>Treinos personalizados para cada objetivo</p>
            </div>

            <div class="services-grid">
                <div class="service-card">
                    <div class="service-icon">
                        <i class="fas fa-dumbbell"></i>
                    </div>
                    <h3>Ganho de Massa</h3>
                    <p>Programa focado em hipertrofia muscular com exercícios compostos e progressão de carga.</p>
                    <div class="accent-line"></div>
                </div>

                <div class="service-card">
                    <div class="service-icon">
                        <i class="fas fa-weight"></i>
                    </div>
                    <h3>Perda de Peso</h3>
                    <p>Combinação de cardio e musculação para máxima queima de calorias.</p>
                    <div class="accent-line"></div>
                </div>

                <div class="service-card">
                    <div class="service-icon">
                        <i class="fas fa-heart"></i>
                    </div>
                    <h3>Saúde Cardiovascular</h3>
                    <p>Treinos para fortalecer o coração e melhorar resistência.</p>
                    <div class="accent-line"></div>
                </div>

                <div class="service-card">
                    <div class="service-icon">
                        <i class="fas fa-fire"></i>
                    </div>
                    <h3>HIIT</h3>
                    <p>Treino de alta intensidade com intervalos para máxima eficiência.</p>
                    <div class="accent-line"></div>
                </div>

                <div class="service-card">
                    <div class="service-icon">
                        <i class="fas fa-spa"></i>
                    </div>
                    <h3>Flexibilidade</h3>
                    <p>Programa de alongamento e mobilidade para melhor qualidade de vida.</p>
                    <div class="accent-line"></div>
                </div>

                <div class="service-card">
                    <div class="service-icon">
                        <i class="fas fa-brain"></i>
                    </div>
                    <h3>Bem-estar Mental</h3>
                    <p>Treinos que combinam exercício físico com meditação e mindfulness.</p>
                    <div class="accent-line"></div>
                </div>
            </div>

            <div style="text-align: center; margin-top: 3rem;">
                <?php if (isLoggedIn()): ?>
                    <a href="calendar.php" class="btn btn-primary">
                        <i class="fas fa-calendar"></i> Começar Treino
                    </a>
                <?php else: ?>
                    <a href="register.php" class="btn btn-primary">
                        <i class="fas fa-user-plus"></i> Cadastre-se
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <?php include '../includes/footer.php'; ?>
</body>
</html>
