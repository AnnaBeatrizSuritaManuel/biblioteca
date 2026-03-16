<?php
$page_title = 'Home';
require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/config/auth.php';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FitZone - Academia Online</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        .hero-extra {
            animation: fadeInUp 0.8s ease-out 0.2s backwards;
        }

        .cta-buttons {
            display: flex;
            gap: 1rem;
            justify-content: center;
            flex-wrap: wrap;
            margin-top: 2rem;
        }

        .scroll-indicator {
            position: absolute;
            bottom: 2rem;
            left: 50%;
            transform: translateX(-50%);
            animation: bounce 2s infinite;
        }

        .scroll-indicator i {
            font-size: 2rem;
            color: var(--accent-bright);
        }
    </style>
</head>
<body>
    <?php include 'includes/header.php'; ?>

    <!-- Hero Section -->
    <section class="hero">
        <div class="container">
            <div class="hero-content">
                <div class="hero-badge">
                    <span class="badge-dot"></span>
                    <span>Bem-vindo à FitZone</span>
                </div>
                <h1 class="hero-title">Transforme Seu Corpo, Transforme Sua Vida</h1>
                <p class="hero-description hero-extra">
                    Junte-se a milhares de membros que já alcançaram seus objetivos fitness. 
                    Com treinos personalizados, comunidade ativa e suporte 24/7, sua transformação começa aqui.
                </p>

                <div class="cta-buttons">
                    <?php if (isLoggedIn()): ?>
                        <a href="pages/calendar.php" class="btn btn-primary">
                            <i class="fas fa-calendar"></i> Meus Treinos
                        </a>
                        <a href="pages/map.php" class="btn btn-outline">
                            <i class="fas fa-map"></i> Academias
                        </a>
                        <a href="pages/ods3.php" class="btn btn-outline">
                            <i class="fas fa-heart"></i> ODS 3
                        </a>
                    <?php else: ?>
                        <a href="pages/register.php" class="btn btn-primary">
                            <i class="fas fa-user-plus"></i> Começar Agora
                        </a>
                        <a href="pages/login.php" class="btn btn-outline">
                            <i class="fas fa-sign-in-alt"></i> Fazer Login
                        </a>
                        <a href="pages/ods3.php" class="btn btn-outline">
                            <i class="fas fa-heart"></i> ODS 3
                        </a>
                    <?php endif; ?>
                </div>
            </div>

            <div class="scroll-indicator">
                <i class="fas fa-chevron-down"></i>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="services">
        <div class="container">
            <div class="section-header">
                <div class="section-badge">
                    <span class="badge-dot"></span>
                    <span>Por que FitZone</span>
                </div>
                <h2>Recursos Exclusivos</h2>
                <p>Tudo que você precisa para alcançar seus objetivos</p>
            </div>

            <div class="services-grid">
                <div class="service-card">
                    <div class="service-icon">
                        <i class="fas fa-calendar-check"></i>
                    </div>
                    <h3>Calendário de Treinos</h3>
                    <p>Agende seus treinos, acompanhe seu progresso e receba lembretes automáticos para não perder nenhuma sessão.</p>
                    <div class="accent-line"></div>
                </div>

                <div class="service-card">
                    <div class="service-icon">
                        <i class="fas fa-map-location-dot"></i>
                    </div>
                    <h3>Localize Academias</h3>
                    <p>Encontre as academias FitZone mais próximas de você com mapa interativo e informações completas de cada unidade.</p>
                    <div class="accent-line"></div>
                </div>

                <div class="service-card">
                    <div class="service-icon">
                        <i class="fas fa-user-circle"></i>
                    </div>
                    <h3>Perfil Personalizado</h3>
                    <p>Crie seu perfil, acompanhe estatísticas e customize suas preferências de treino e notificações.</p>
                    <div class="accent-line"></div>
                </div>

                <div class="service-card">
                    <div class="service-icon">
                        <i class="fas fa-dumbbell"></i>
                    </div>
                    <h3>Treinos Variados</h3>
                    <p>Acesso a diversos tipos de treino: musculação, cardio, yoga, pilates, CrossFit, HIIT e muito mais.</p>
                    <div class="accent-line"></div>
                </div>

                <div class="service-card">
                    <div class="service-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <h3>Comunidade Ativa</h3>
                    <p>Conecte-se com outros membros, compartilhe experiências e receba motivação diária da comunidade.</p>
                    <div class="accent-line"></div>
                </div>

                <div class="service-card">
                    <div class="service-icon">
                        <i class="fas fa-headset"></i>
                    </div>
                    <h3>Suporte 24/7</h3>
                    <p>Nossa equipe está sempre disponível para ajudar com dúvidas, dicas e suporte personalizado.</p>
                    <div class="accent-line"></div>
                </div>
            </div>
        </div>
    </section>

    <!-- ODS 3 Section -->
    <section class="services">
        <div class="container">
            <div class="section-header">
                <div class="section-badge">
                    <span class="badge-dot"></span>
                    <span>Compromisso Social</span>
                </div>
                <h2>ODS 3: Saúde e Bem-estar</h2>
                <p>Contribuindo para os Objetivos de Desenvolvimento Sustentável da ONU</p>
            </div>

            <div class="services-grid">
                <div class="service-card">
                    <div class="service-icon">
                        <i class="fas fa-heart"></i>
                    </div>
                    <h3>Saúde para Todos</h3>
                    <p>Promovemos acesso igualitário a programas de fitness e bem-estar para todas as idades e condições físicas.</p>
                    <div class="accent-line"></div>
                </div>

                <div class="service-card">
                    <div class="service-icon">
                        <i class="fas fa-globe"></i>
                    </div>
                    <h3>Desenvolvimento Sustentável</h3>
                    <p>Alinhados com a Agenda 2030 da ONU, trabalhamos para criar uma sociedade mais saudável e sustentável.</p>
                    <div class="accent-line"></div>
                </div>

                <div class="service-card">
                    <div class="service-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <h3>Comunidade Inclusiva</h3>
                    <p>Criamos espaços seguros e acolhedores onde todos podem trabalhar em sua saúde sem discriminação.</p>
                    <div class="accent-line"></div>
                </div>
            </div>

            <div style="text-align: center; margin-top: 2rem;">
                <a href="pages/ods3.php" class="btn btn-primary">
                    <i class="fas fa-heart"></i> Saiba Mais sobre ODS 3
                </a>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="hero" style="padding: 4rem 0; background: linear-gradient(135deg, #00D4FF 0%, #00FFFF 100%); min-height: auto;">
        <div class="container" style="text-align: center;">
            <h2 style="color: #0F1419; margin-bottom: 1.5rem;">Pronto para começar sua transformação?</h2>
            <p style="color: #0F1419; font-size: 1.1rem; margin-bottom: 2rem; max-width: 600px; margin-left: auto; margin-right: auto;">
                Junte-se a milhares de membros satisfeitos e comece sua jornada fitness hoje mesmo!
            </p>
            <?php if (!isLoggedIn()): ?>
                <a href="pages/register.php" class="btn btn-primary" style="background: #0F1419; color: #00D4FF;">
                    <i class="fas fa-rocket"></i> Começar Agora
                </a>
            <?php else: ?>
                <a href="pages/calendar.php" class="btn btn-primary" style="background: #0F1419; color: #00D4FF;">
                    <i class="fas fa-calendar"></i> Agendar Treino
                </a>
            <?php endif; ?>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-section">
                    <h4><i class="fas fa-dumbbell"></i> FitZone</h4>
                    <p style="color: var(--gray); margin-bottom: 1rem;">
                        Transformando vidas através do fitness e bem-estar.
                    </p>
                    <div style="display: flex; gap: 1rem;">
                        <a href="#" style="color: var(--accent-bright); text-decoration: none;"><i class="fas fa-facebook"></i></a>
                        <a href="#" style="color: var(--accent-bright); text-decoration: none;"><i class="fas fa-instagram"></i></a>
                        <a href="#" style="color: var(--accent-bright); text-decoration: none;"><i class="fas fa-twitter"></i></a>
                        <a href="#" style="color: var(--accent-bright); text-decoration: none;"><i class="fas fa-youtube"></i></a>
                    </div>
                </div>

                <div class="footer-section">
                    <h4>Links Rápidos</h4>
                    <a href="pages/services.php">Serviços</a>
                    <a href="pages/training.php">Treinos</a>
                    <a href="pages/map.php">Academias</a>
                    <a href="pages/contact.php">Contato</a>
                </div>

                <div class="footer-section">
                    <h4>Suporte</h4>
                    <a href="pages/contact.php">Fale Conosco</a>
                    <a href="#">FAQ</a>
                    <a href="#">Termos de Uso</a>
                    <a href="#">Privacidade</a>
                </div>

                <div class="footer-section">
                    <h4>Contato</h4>
                    <p style="color: var(--gray);">
                        <i class="fas fa-phone"></i> (11) 3456-7890<br>
                        <i class="fas fa-envelope"></i> contato@fitzone.com<br>
                        <i class="fas fa-map-marker-alt"></i> Avenida Paulista, 1000
                    </p>
                </div>
            </div>

            <div class="footer-bottom">
                <p>&copy; 2024 FitZone. Todos os direitos reservados. | Desenvolvido com <i class="fas fa-heart" style="color: #ff6b6b;"></i> para sua saúde</p>
            </div>
        </div>
    </footer>

    <script>
        // Smooth scroll
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({ behavior: 'smooth' });
                }
            });
        });

        // Animação ao scroll
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -100px 0px'
        };

        const observer = new IntersectionObserver(function(entries) {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('fade-in');
                }
            });
        }, observerOptions);

        document.querySelectorAll('.service-card').forEach(card => {
            observer.observe(card);
        });
    </script>
</body>
</html>
