<?php
$page_title = 'Serviços';
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

    <section class="services">
        <div class="container">
            <div class="section-header">
                <div class="section-badge">
                    <span class="badge-dot"></span>
                    <span>Nossos Serviços</span>
                </div>
                <h2>Tudo que você precisa para sua transformação</h2>
                <p>Serviços completos de fitness e bem-estar</p>
            </div>

            <div class="services-grid">
                <div class="service-card">
                    <div class="service-icon">
                        <i class="fas fa-dumbbell"></i>
                    </div>
                    <h3>Musculação</h3>
                    <p>Programas personalizados de musculação com acompanhamento de personal trainer experiente.</p>
                    <div class="accent-line"></div>
                </div>

                <div class="service-card">
                    <div class="service-icon">
                        <i class="fas fa-running"></i>
                    </div>
                    <h3>Cardio</h3>
                    <p>Treinos cardiovasculares intensos para melhorar resistência e queimar calorias.</p>
                    <div class="accent-line"></div>
                </div>

                <div class="service-card">
                    <div class="service-icon">
                        <i class="fas fa-spa"></i>
                    </div>
                    <h3>Yoga</h3>
                    <p>Aulas de yoga para flexibilidade, equilíbrio e bem-estar mental.</p>
                    <div class="accent-line"></div>
                </div>

                <div class="service-card">
                    <div class="service-icon">
                        <i class="fas fa-heartbeat"></i>
                    </div>
                    <h3>Pilates</h3>
                    <p>Pilates para fortalecer core, melhorar postura e flexibilidade.</p>
                    <div class="accent-line"></div>
                </div>

                <div class="service-card">
                    <div class="service-icon">
                        <i class="fas fa-fire"></i>
                    </div>
                    <h3>CrossFit</h3>
                    <p>Treinos funcionais de alta intensidade para máximo desempenho.</p>
                    <div class="accent-line"></div>
                </div>

                <div class="service-card">
                    <div class="service-icon">
                        <i class="fas fa-utensils"></i>
                    </div>
                    <h3>Nutrição</h3>
                    <p>Consultoria nutricional personalizada com nutricionistas especializados.</p>
                    <div class="accent-line"></div>
                </div>

                <div class="service-card">
                    <div class="service-icon">
                        <i class="fas fa-user-tie"></i>
                    </div>
                    <h3>Personal Trainer</h3>
                    <p>Acompanhamento individual com profissionais certificados.</p>
                    <div class="accent-line"></div>
                </div>

                <div class="service-card">
                    <div class="service-icon">
                        <i class="fas fa-brain"></i>
                    </div>
                    <h3>Coaching Mental</h3>
                    <p>Suporte psicológico e motivacional para sua jornada fitness.</p>
                    <div class="accent-line"></div>
                </div>

                <div class="service-card">
                    <div class="service-icon">
                        <i class="fas fa-heartbeat"></i>
                    </div>
                    <h3>Avaliação Física</h3>
                    <p>Avaliação completa de saúde e composição corporal.</p>
                    <div class="accent-line"></div>
                </div>
            </div>

            <div style="text-align: center; margin-top: 3rem;">
                <?php if (isLoggedIn()): ?>
                    <a href="calendar.php" class="btn btn-primary">
                        <i class="fas fa-calendar"></i> Agendar Serviço
                    </a>
                <?php else: ?>
                    <a href="register.php" class="btn btn-primary">
                        <i class="fas fa-user-plus"></i> Começar Agora
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <?php include '../includes/footer.php'; ?>
</body>
</html>
