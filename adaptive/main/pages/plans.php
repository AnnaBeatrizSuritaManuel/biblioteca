<?php
$page_title = 'Planos e Preços';
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
    <style>
        .plans-container {
            min-height: calc(100vh - 80px);
            padding: 3rem 0;
            animation: fadeIn 0.6s ease-in;
        }

        .plans-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin: 3rem 0;
        }

        .plan-card {
            background: rgba(0, 212, 255, 0.05);
            border: 2px solid rgba(0, 212, 255, 0.2);
            border-radius: 1rem;
            padding: 2rem;
            position: relative;
            transition: var(--transition);
            animation: slideUp 0.6s ease-out;
        }

        .plan-card:hover {
            border-color: var(--accent-bright);
            background: rgba(0, 212, 255, 0.1);
            transform: translateY(-10px);
        }

        .plan-card.featured {
            border: 2px solid var(--accent-bright);
            background: rgba(0, 212, 255, 0.1);
            transform: scale(1.05);
        }

        .plan-badge {
            position: absolute;
            top: -15px;
            right: 20px;
            background: linear-gradient(135deg, var(--accent) 0%, var(--accent-bright) 100%);
            color: var(--dark);
            padding: 0.5rem 1rem;
            border-radius: 2rem;
            font-size: 0.8rem;
            font-weight: 700;
        }

        .plan-name {
            color: var(--accent-bright);
            font-size: 1.5rem;
            margin-bottom: 0.5rem;
            margin-top: 1rem;
        }

        .plan-description {
            color: var(--gray);
            font-size: 0.9rem;
            margin-bottom: 1.5rem;
        }

        .plan-price {
            font-size: 2.5rem;
            color: var(--accent-bright);
            font-weight: 700;
            margin-bottom: 0.25rem;
        }

        .plan-period {
            color: var(--gray);
            font-size: 0.9rem;
            margin-bottom: 1.5rem;
        }

        .plan-features {
            list-style: none;
            padding: 0;
            margin-bottom: 2rem;
        }

        .plan-features li {
            color: var(--ice);
            padding: 0.75rem 0;
            border-bottom: 1px solid rgba(0, 212, 255, 0.1);
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .plan-features li:last-child {
            border-bottom: none;
        }

        .plan-features i {
            color: var(--accent-bright);
            width: 20px;
        }

        .plan-button {
            width: 100%;
            padding: 1rem;
            background: linear-gradient(135deg, var(--accent) 0%, var(--accent-bright) 100%);
            color: var(--dark);
            border: none;
            border-radius: 0.5rem;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
        }

        .plan-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(0, 212, 255, 0.4);
        }

        .plan-button:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        .comparison-table {
            background: rgba(0, 212, 255, 0.05);
            border: 2px solid rgba(0, 212, 255, 0.2);
            border-radius: 1rem;
            padding: 2rem;
            margin-top: 3rem;
            overflow-x: auto;
        }

        .comparison-table h3 {
            color: var(--accent-bright);
            margin-bottom: 1.5rem;
        }

        .comparison-table table {
            width: 100%;
            border-collapse: collapse;
        }

        .comparison-table th {
            background: rgba(0, 212, 255, 0.1);
            color: var(--accent-bright);
            padding: 1rem;
            text-align: left;
            border-bottom: 2px solid rgba(0, 212, 255, 0.2);
        }

        .comparison-table td {
            color: var(--ice);
            padding: 1rem;
            border-bottom: 1px solid rgba(0, 212, 255, 0.1);
        }

        .comparison-table tr:hover {
            background: rgba(0, 212, 255, 0.05);
        }

        .check {
            color: #51cf66;
        }

        .cross {
            color: #ff6b6b;
        }

        @media (max-width: 768px) {
            .plan-card.featured {
                transform: scale(1);
            }

            .plans-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <?php include '../includes/header.php'; ?>

    <div class="plans-container">
        <div class="container">
            <div class="section-header">
                <div class="section-badge">
                    <span class="badge-dot"></span>
                    <span>Planos</span>
                </div>
                <h2>Escolha seu Plano Ideal</h2>
                <p>Acesso ilimitado a todos os nossos serviços</p>
            </div>

            <div class="plans-grid">
                <!-- Plano Basic -->
                <div class="plan-card">
                    <div class="plan-name">
                        <i class="fas fa-star"></i> Basic
                    </div>
                    <p class="plan-description">Perfeito para iniciantes</p>
                    <div class="plan-price">R$ 99</div>
                    <div class="plan-period">/mês</div>

                    <ul class="plan-features">
                        <li><i class="fas fa-check"></i> Acesso à academia</li>
                        <li><i class="fas fa-check"></i> Aulas em grupo</li>
                        <li><i class="fas fa-check"></i> Calendário de treinos</li>
                        <li><i class="fas fa-check"></i> Suporte por email</li>
                        <li><i class="fas fa-times"></i> Personal trainer</li>
                        <li><i class="fas fa-times"></i> Nutricionista</li>
                        <li><i class="fas fa-times"></i> Coaching mental</li>
                    </ul>

                    <?php if (isLoggedIn()): ?>
                        <button class="plan-button" onclick="selectPlan('basic', 99)">
                            <i class="fas fa-check"></i> Selecionar Plano
                        </button>
                    <?php else: ?>
                        <a href="register.php" class="plan-button" style="display: block; text-align: center; text-decoration: none;">
                            <i class="fas fa-user-plus"></i> Cadastrar Agora
                        </a>
                    <?php endif; ?>
                </div>

                <!-- Plano Pro -->
                <div class="plan-card featured">
                    <div class="plan-badge">
                        <i class="fas fa-fire"></i> MAIS POPULAR
                    </div>
                    <div class="plan-name">
                        <i class="fas fa-crown"></i> Pro
                    </div>
                    <p class="plan-description">Para quem quer resultados</p>
                    <div class="plan-price">R$ 199</div>
                    <div class="plan-period">/mês</div>

                    <ul class="plan-features">
                        <li><i class="fas fa-check"></i> Acesso à academia</li>
                        <li><i class="fas fa-check"></i> Aulas em grupo</li>
                        <li><i class="fas fa-check"></i> Calendário de treinos</li>
                        <li><i class="fas fa-check"></i> Suporte 24/7</li>
                        <li><i class="fas fa-check"></i> 4 sessões personal</li>
                        <li><i class="fas fa-check"></i> Consultoria nutricional</li>
                        <li><i class="fas fa-times"></i> Coaching mental diário</li>
                    </ul>

                    <?php if (isLoggedIn()): ?>
                        <button class="plan-button" onclick="selectPlan('pro', 199)">
                            <i class="fas fa-check"></i> Selecionar Plano
                        </button>
                    <?php else: ?>
                        <a href="register.php" class="plan-button" style="display: block; text-align: center; text-decoration: none;">
                            <i class="fas fa-user-plus"></i> Cadastrar Agora
                        </a>
                    <?php endif; ?>
                </div>

                <!-- Plano Elite -->
                <div class="plan-card">
                    <div class="plan-name">
                        <i class="fas fa-diamond"></i> Elite
                    </div>
                    <p class="plan-description">Máximo desempenho</p>
                    <div class="plan-price">R$ 399</div>
                    <div class="plan-period">/mês</div>

                    <ul class="plan-features">
                        <li><i class="fas fa-check"></i> Acesso à academia</li>
                        <li><i class="fas fa-check"></i> Aulas em grupo</li>
                        <li><i class="fas fa-check"></i> Calendário de treinos</li>
                        <li><i class="fas fa-check"></i> Suporte 24/7</li>
                        <li><i class="fas fa-check"></i> Personal trainer ilimitado</li>
                        <li><i class="fas fa-check"></i> Nutricionista dedicado</li>
                        <li><i class="fas fa-check"></i> Coaching mental diário</li>
                    </ul>

                    <?php if (isLoggedIn()): ?>
                        <button class="plan-button" onclick="selectPlan('elite', 399)">
                            <i class="fas fa-check"></i> Selecionar Plano
                        </button>
                    <?php else: ?>
                        <a href="register.php" class="plan-button" style="display: block; text-align: center; text-decoration: none;">
                            <i class="fas fa-user-plus"></i> Cadastrar Agora
                        </a>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Tabela de Comparação -->
            <div class="comparison-table">
                <h3><i class="fas fa-table"></i> Comparação de Planos</h3>
                <table>
                    <thead>
                        <tr>
                            <th>Funcionalidade</th>
                            <th>Basic</th>
                            <th>Pro</th>
                            <th>Elite</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Acesso à Academia</td>
                            <td><i class="fas fa-check check"></i></td>
                            <td><i class="fas fa-check check"></i></td>
                            <td><i class="fas fa-check check"></i></td>
                        </tr>
                        <tr>
                            <td>Aulas em Grupo</td>
                            <td><i class="fas fa-check check"></i></td>
                            <td><i class="fas fa-check check"></i></td>
                            <td><i class="fas fa-check check"></i></td>
                        </tr>
                        <tr>
                            <td>Calendário de Treinos</td>
                            <td><i class="fas fa-check check"></i></td>
                            <td><i class="fas fa-check check"></i></td>
                            <td><i class="fas fa-check check"></i></td>
                        </tr>
                        <tr>
                            <td>Suporte</td>
                            <td>Email</td>
                            <td>24/7</td>
                            <td>24/7 Dedicado</td>
                        </tr>
                        <tr>
                            <td>Personal Trainer</td>
                            <td><i class="fas fa-times cross"></i></td>
                            <td>4 sessões/mês</td>
                            <td>Ilimitado</td>
                        </tr>
                        <tr>
                            <td>Nutricionista</td>
                            <td><i class="fas fa-times cross"></i></td>
                            <td><i class="fas fa-check check"></i></td>
                            <td><i class="fas fa-check check"></i></td>
                        </tr>
                        <tr>
                            <td>Coaching Mental</td>
                            <td><i class="fas fa-times cross"></i></td>
                            <td><i class="fas fa-times cross"></i></td>
                            <td><i class="fas fa-check check"></i></td>
                        </tr>
                        <tr>
                            <td>Acesso ao Mapa</td>
                            <td><i class="fas fa-check check"></i></td>
                            <td><i class="fas fa-check check"></i></td>
                            <td><i class="fas fa-check check"></i></td>
                        </tr>
                        <tr>
                            <td>Histórico de Treinos</td>
                            <td><i class="fas fa-check check"></i></td>
                            <td><i class="fas fa-check check"></i></td>
                            <td><i class="fas fa-check check"></i></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        function selectPlan(planName, price) {
            alert(`Você selecionou o plano ${planName.toUpperCase()} - R$ ${price}/mês\n\nRedirecionando para pagamento...`);
            // Aqui você pode adicionar integração com Stripe ou outro gateway de pagamento
            // window.location.href = `payment.php?plan=${planName}&price=${price}`;
        }
    </script>

    <?php include '../includes/footer.php'; ?>
</body>
</html>
