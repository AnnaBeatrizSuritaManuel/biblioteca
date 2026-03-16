<?php
$page_title = 'ODS 3 - Saúde e Bem-estar';
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../config/auth.php';
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
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
        .ods-container {
            min-height: calc(100vh - 80px);
            padding: 3rem 0;
            animation: fadeIn 0.6s ease-in;
        }

        .ods-header {
            background: linear-gradient(135deg, #00D4FF 0%, #00FFFF 100%);
            color: #0F1419;
            padding: 3rem 0;
            margin-bottom: 3rem;
            border-radius: 1rem;
        }

        .ods-header h1 {
            font-size: 2.5rem;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .ods-header p {
            font-size: 1.1rem;
            opacity: 0.9;
        }

        .ods-badge {
            display: inline-block;
            background: rgba(0, 0, 0, 0.2);
            padding: 0.5rem 1rem;
            border-radius: 2rem;
            font-weight: 600;
            margin-bottom: 1rem;
        }

        .content-section {
            background: rgba(0, 212, 255, 0.05);
            border: 2px solid rgba(0, 212, 255, 0.2);
            border-radius: 1rem;
            padding: 2rem;
            margin-bottom: 2rem;
            animation: slideUp 0.6s ease-out;
        }

        .content-section h2 {
            color: var(--accent-bright);
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .content-section h3 {
            color: var(--accent);
            margin-top: 1.5rem;
            margin-bottom: 1rem;
        }

        .content-section p {
            color: var(--ice);
            line-height: 1.8;
            margin-bottom: 1rem;
        }

        .benefits-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin: 2rem 0;
        }

        .benefit-card {
            background: rgba(0, 212, 255, 0.05);
            border: 2px solid rgba(0, 212, 255, 0.1);
            border-radius: 0.75rem;
            padding: 1.5rem;
            text-align: center;
            transition: var(--transition);
        }

        .benefit-card:hover {
            border-color: var(--accent-bright);
            background: rgba(0, 212, 255, 0.1);
            transform: translateY(-5px);
        }

        .benefit-icon {
            font-size: 2.5rem;
            color: var(--accent-bright);
            margin-bottom: 1rem;
        }

        .benefit-card h4 {
            color: var(--accent-bright);
            margin-bottom: 0.75rem;
        }

        .benefit-card p {
            color: var(--gray);
            font-size: 0.9rem;
        }

        .stats-section {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.5rem;
            margin: 2rem 0;
        }

        .stat-box {
            background: rgba(0, 212, 255, 0.1);
            border: 2px solid rgba(0, 212, 255, 0.2);
            border-radius: 0.75rem;
            padding: 1.5rem;
            text-align: center;
        }

        .stat-number {
            font-size: 2rem;
            color: var(--accent-bright);
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .stat-label {
            color: var(--gray);
            font-size: 0.9rem;
        }

        .goals-list {
            list-style: none;
            padding: 0;
        }

        .goals-list li {
            padding: 1rem;
            margin-bottom: 0.75rem;
            background: rgba(0, 212, 255, 0.05);
            border-left: 4px solid var(--accent-bright);
            border-radius: 0.5rem;
            color: var(--ice);
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .goals-list i {
            color: var(--accent-bright);
            font-size: 1.2rem;
            flex-shrink: 0;
        }

        .cta-section {
            background: linear-gradient(135deg, #00D4FF 0%, #00FFFF 100%);
            color: #0F1419;
            padding: 2rem;
            border-radius: 1rem;
            text-align: center;
            margin-top: 3rem;
        }

        .cta-section h3 {
            color: #0F1419;
            margin-bottom: 1rem;
        }

        .cta-section p {
            color: #0F1419;
            margin-bottom: 1.5rem;
        }

        .btn-cta {
            display: inline-block;
            padding: 1rem 2rem;
            background: #0F1419;
            color: #00D4FF;
            text-decoration: none;
            border-radius: 0.5rem;
            font-weight: 600;
            transition: var(--transition);
        }

        .btn-cta:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        }

        @media (max-width: 768px) {
            .ods-header h1 {
                font-size: 1.8rem;
            }

            .benefits-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <?php include '../includes/header.php'; ?>

    <div class="ods-container">
        <div class="container">
            <div class="ods-header">
                <div class="ods-badge">
                    <i class="fas fa-globe"></i> Objetivo de Desenvolvimento Sustentável
                </div>
                <h1>
                    <i class="fas fa-heart"></i> ODS 3: Saúde e Bem-estar
                </h1>
                <p>Assegurar uma vida saudável e promover o bem-estar para todos, em todas as idades</p>
            </div>

            <!-- Sobre ODS 3 -->
            <div class="content-section">
                <h2><i class="fas fa-info-circle"></i> O que é ODS 3?</h2>
                <p>
                    O Objetivo de Desenvolvimento Sustentável 3 (ODS 3) faz parte da Agenda 2030 da Organização das Nações Unidas (ONU). 
                    Este objetivo visa assegurar uma vida saudável e promover o bem-estar para todos, em todas as idades, reconhecendo que 
                    a saúde é fundamental para o desenvolvimento sustentável.
                </p>
                <p>
                    A FitZone está comprometida em contribuir para o alcance da ODS 3, promovendo estilos de vida saudáveis, atividade física 
                    regular e bem-estar mental através de programas de fitness acessíveis e inclusivos.
                </p>
            </div>

            <!-- Metas da ODS 3 -->
            <div class="content-section">
                <h2><i class="fas fa-bullseye"></i> Metas Principais da ODS 3</h2>
                <ul class="goals-list">
                    <li>
                        <i class="fas fa-check-circle"></i>
                        <span><strong>Meta 3.1:</strong> Reduzir a taxa de mortalidade materna para menos de 70 por 100 mil nascidos vivos</span>
                    </li>
                    <li>
                        <i class="fas fa-check-circle"></i>
                        <span><strong>Meta 3.4:</strong> Reduzir em um terço a mortalidade prematura por doenças não transmissíveis</span>
                    </li>
                    <li>
                        <i class="fas fa-check-circle"></i>
                        <span><strong>Meta 3.5:</strong> Reforçar a prevenção e o tratamento do abuso de substâncias</span>
                    </li>
                    <li>
                        <i class="fas fa-check-circle"></i>
                        <span><strong>Meta 3.6:</strong> Reduzir pela metade as mortes e ferimentos causados por acidentes</span>
                    </li>
                    <li>
                        <i class="fas fa-check-circle"></i>
                        <span><strong>Meta 3.8:</strong> Alcançar cobertura universal de saúde e acesso a medicamentos essenciais</span>
                    </li>
                    <li>
                        <i class="fas fa-check-circle"></i>
                        <span><strong>Meta 3.a:</strong> Fortalecer a implementação da Convenção-Quadro para o Controle do Tabaco</span>
                    </li>
                </ul>
            </div>

            <!-- Benefícios da Atividade Física -->
            <div class="content-section">
                <h2><i class="fas fa-dumbbell"></i> Benefícios da Atividade Física para a Saúde</h2>
                <p>
                    A atividade física regular é essencial para manter a saúde e o bem-estar. Estudos científicos comprovam que exercitar-se 
                    regularmente reduz o risco de diversas doenças crônicas e melhora significativamente a qualidade de vida.
                </p>

                <div class="benefits-grid">
                    <div class="benefit-card">
                        <div class="benefit-icon"><i class="fas fa-heart"></i></div>
                        <h4>Saúde Cardiovascular</h4>
                        <p>Fortalece o coração, reduz pressão arterial e melhora a circulação sanguínea</p>
                    </div>

                    <div class="benefit-card">
                        <div class="benefit-icon"><i class="fas fa-brain"></i></div>
                        <h4>Saúde Mental</h4>
                        <p>Reduz ansiedade, depressão e melhora o bem-estar emocional geral</p>
                    </div>

                    <div class="benefit-card">
                        <div class="benefit-icon"><i class="fas fa-weight"></i></div>
                        <h4>Controle de Peso</h4>
                        <p>Ajuda a manter peso saudável e previne obesidade</p>
                    </div>

                    <div class="benefit-card">
                        <div class="benefit-icon"><i class="fas fa-bone"></i></div>
                        <h4>Força Óssea</h4>
                        <p>Aumenta densidade óssea e previne osteoporose</p>
                    </div>

                    <div class="benefit-card">
                        <div class="benefit-icon"><i class="fas fa-lungs"></i></div>
                        <h4>Capacidade Respiratória</h4>
                        <p>Melhora função pulmonar e resistência cardiovascular</p>
                    </div>

                    <div class="benefit-card">
                        <div class="benefit-icon"><i class="fas fa-smile"></i></div>
                        <h4>Qualidade de Vida</h4>
                        <p>Aumenta energia, melhora sono e autoestima</p>
                    </div>
                </div>
            </div>

            <!-- Estatísticas de Saúde -->
            <div class="content-section">
                <h2><i class="fas fa-chart-bar"></i> Estatísticas Globais de Saúde</h2>
                <div class="stats-section">
                    <div class="stat-box">
                        <div class="stat-number">1.3B</div>
                        <div class="stat-label">Pessoas com atividade física insuficiente</div>
                    </div>

                    <div class="stat-box">
                        <div class="stat-number">71M</div>
                        <div class="stat-label">Mortes por doenças não transmissíveis</div>
                    </div>

                    <div class="stat-box">
                        <div class="stat-number">30%</div>
                        <div class="stat-label">Redução de risco com exercício regular</div>
                    </div>

                    <div class="stat-box">
                        <div class="stat-number">150min</div>
                        <div class="stat-label">Atividade recomendada por semana</div>
                    </div>
                </div>
            </div>

            <!-- Compromisso da FitZone -->
            <div class="content-section">
                <h2><i class="fas fa-handshake"></i> Compromisso da FitZone com ODS 3</h2>
                <h3>Nossa Missão</h3>
                <p>
                    A FitZone está dedicada a promover saúde e bem-estar para todos através de programas de fitness acessíveis, 
                    inclusivos e baseados em evidências científicas. Acreditamos que a atividade física regular é um direito fundamental 
                    e uma ferramenta poderosa para melhorar a qualidade de vida.
                </p>

                <h3>Nossas Ações</h3>
                <ul class="goals-list">
                    <li>
                        <i class="fas fa-check-circle"></i>
                        <span>Oferecer programas de fitness variados e adaptados para todas as idades e níveis de condicionamento</span>
                    </li>
                    <li>
                        <i class="fas fa-check-circle"></i>
                        <span>Promover educação sobre saúde, nutrição e bem-estar mental</span>
                    </li>
                    <li>
                        <i class="fas fa-check-circle"></i>
                        <span>Criar uma comunidade inclusiva que apoia e motiva seus membros</span>
                    </li>
                    <li>
                        <i class="fas fa-check-circle"></i>
                        <span>Oferecer programas especiais para grupos vulneráveis e de baixa renda</span>
                    </li>
                    <li>
                        <i class="fas fa-check-circle"></i>
                        <span>Colaborar com profissionais de saúde para garantir qualidade e segurança</span>
                    </li>
                    <li>
                        <i class="fas fa-check-circle"></i>
                        <span>Usar tecnologia para tornar o fitness mais acessível e personalizado</span>
                    </li>
                </ul>
            </div>

            <!-- Call to Action -->
            <div class="cta-section">
                <h3><i class="fas fa-rocket"></i> Junte-se ao Movimento pela Saúde</h3>
                <p>
                    Contribua para o alcance da ODS 3 transformando sua vida através da atividade física regular. 
                    Comece sua jornada de saúde e bem-estar hoje mesmo!
                </p>
                <?php if (!isLoggedIn()): ?>
                    <a href="register.php" class="btn-cta">
                        <i class="fas fa-user-plus"></i> Começar Agora
                    </a>
                <?php else: ?>
                    <a href="calendar.php" class="btn-cta">
                        <i class="fas fa-calendar"></i> Agendar Treino
                    </a>
                <?php endif; ?>
            </div>

            <!-- Recursos Adicionais -->
            <div class="content-section" style="margin-top: 3rem;">
                <h2><i class="fas fa-book"></i> Recursos Adicionais</h2>
                <p>
                    Para mais informações sobre ODS 3 e saúde global, visite:
                </p>
                <ul class="goals-list">
                    <li>
                        <i class="fas fa-external-link-alt"></i>
                        <span><a href="https://www.un.org/sustainabledevelopment/health/" target="_blank" style="color: var(--accent-bright); text-decoration: none;">Site Oficial da ONU - ODS 3</a></span>
                    </li>
                    <li>
                        <i class="fas fa-external-link-alt"></i>
                        <span><a href="https://www.who.int/" target="_blank" style="color: var(--accent-bright); text-decoration: none;">Organização Mundial da Saúde (OMS)</a></span>
                    </li>
                    <li>
                        <i class="fas fa-external-link-alt"></i>
                        <span><a href="https://www.gov.br/cidadania/pt-br/acesso-a-informacao/acoes-e-programas/objetivos-de-desenvolvimento-sustentavel" target="_blank" style="color: var(--accent-bright); text-decoration: none;">Governo Brasileiro - ODS</a></span>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <?php include '../includes/footer.php'; ?>
</body>
</html>
