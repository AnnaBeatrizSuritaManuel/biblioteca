<?php
$page_title = 'Contato';
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../config/auth.php';

$message = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['send_message'])) {
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $subject = $_POST['subject'] ?? '';
    $message_text = $_POST['message'] ?? '';

    if (empty($name) || empty($email) || empty($subject) || empty($message_text)) {
        $error = 'Por favor, preencha todos os campos!';
    } else {
        $message = 'Mensagem enviada com sucesso! Entraremos em contato em breve.';
    }
}
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
        .contact-container {
            min-height: calc(100vh - 80px);
            padding: 3rem 0;
            animation: fadeIn 0.6s ease-in;
        }

        .contact-content {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 3rem;
            margin-bottom: 3rem;
        }

        .contact-form {
            background: rgba(0, 212, 255, 0.05);
            border: 2px solid rgba(0, 212, 255, 0.2);
            border-radius: 1rem;
            padding: 2rem;
            animation: slideUp 0.6s ease-out;
        }

        .contact-form h3 {
            color: var(--accent-bright);
            margin-bottom: 1.5rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            color: var(--ice);
            margin-bottom: 0.5rem;
            font-weight: 500;
        }

        .form-group input,
        .form-group textarea,
        .form-group select {
            width: 100%;
            padding: 0.75rem;
            border: 2px solid rgba(0, 212, 255, 0.2);
            border-radius: 0.5rem;
            background: rgba(0, 0, 0, 0.3);
            color: var(--ice);
            font-family: var(--font-inter);
            transition: var(--transition);
            box-sizing: border-box;
        }

        .form-group input:focus,
        .form-group textarea:focus,
        .form-group select:focus {
            outline: none;
            border-color: var(--accent-bright);
            box-shadow: 0 0 1rem rgba(0, 212, 255, 0.3);
        }

        .form-group textarea {
            resize: vertical;
            min-height: 120px;
        }

        .btn-submit {
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

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(0, 212, 255, 0.4);
        }

        .contact-info {
            display: flex;
            flex-direction: column;
            gap: 2rem;
        }

        .info-box {
            background: rgba(0, 212, 255, 0.05);
            border: 2px solid rgba(0, 212, 255, 0.2);
            border-radius: 1rem;
            padding: 1.5rem;
            animation: slideUp 0.6s ease-out 0.1s backwards;
        }

        .info-box h4 {
            color: var(--accent-bright);
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .info-box p {
            color: var(--ice);
            line-height: 1.8;
        }

        .alert {
            padding: 1rem;
            border-radius: 0.5rem;
            margin-bottom: 1.5rem;
            animation: slideDown 0.4s ease-out;
        }

        .alert-error {
            background: rgba(255, 0, 0, 0.1);
            border: 1px solid rgba(255, 0, 0, 0.3);
            color: #ff6b6b;
        }

        .alert-success {
            background: rgba(0, 255, 0, 0.1);
            border: 1px solid rgba(0, 255, 0, 0.3);
            color: #51cf66;
        }

        .faq-section {
            background: rgba(0, 212, 255, 0.05);
            border: 2px solid rgba(0, 212, 255, 0.2);
            border-radius: 1rem;
            padding: 2rem;
            margin-top: 3rem;
        }

        .faq-section h3 {
            color: var(--accent-bright);
            margin-bottom: 1.5rem;
        }

        .faq-item {
            margin-bottom: 1rem;
            border-bottom: 1px solid rgba(0, 212, 255, 0.1);
            padding-bottom: 1rem;
        }

        .faq-item:last-child {
            border-bottom: none;
        }

        .faq-question {
            color: var(--accent-bright);
            font-weight: 600;
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .faq-answer {
            color: var(--ice);
            margin-top: 0.75rem;
            display: none;
        }

        .faq-answer.active {
            display: block;
        }

        @media (max-width: 768px) {
            .contact-content {
                grid-template-columns: 1fr;
            }
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>
    <?php include '../includes/header.php'; ?>

    <div class="contact-container">
        <div class="container">
            <div class="section-header" style="margin-bottom: 3rem;">
                <div class="section-badge">
                    <span class="badge-dot"></span>
                    <span>Entre em Contato</span>
                </div>
                <h2>Fale Conosco</h2>
                <p>Estamos aqui para ajudar você</p>
            </div>

            <div class="contact-content">
                <div class="contact-form">
                    <h3><i class="fas fa-envelope"></i> Envie uma Mensagem</h3>

                    <?php if ($error): ?>
                        <div class="alert alert-error">
                            <i class="fas fa-exclamation-circle"></i> <?php echo $error; ?>
                        </div>
                    <?php endif; ?>

                    <?php if ($message): ?>
                        <div class="alert alert-success">
                            <i class="fas fa-check-circle"></i> <?php echo $message; ?>
                        </div>
                    <?php endif; ?>

                    <form method="POST">
                        <div class="form-group">
                            <label for="name">Nome Completo</label>
                            <input type="text" id="name" name="name" placeholder="Seu nome" required>
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" placeholder="seu@email.com" required>
                        </div>

                        <div class="form-group">
                            <label for="subject">Assunto</label>
                            <select id="subject" name="subject" required>
                                <option value="">Selecione um assunto</option>
                                <option value="duvida">Dúvida</option>
                                <option value="sugestao">Sugestão</option>
                                <option value="reclamacao">Reclamação</option>
                                <option value="parceria">Parceria</option>
                                <option value="outro">Outro</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="message">Mensagem</label>
                            <textarea id="message" name="message" placeholder="Digite sua mensagem..." required></textarea>
                        </div>

                        <button type="submit" name="send_message" class="btn-submit">
                            <i class="fas fa-paper-plane"></i> Enviar Mensagem
                        </button>
                    </form>
                </div>

                <div class="contact-info">
                    <div class="info-box">
                        <h4><i class="fas fa-phone"></i> Telefone</h4>
                        <p>
                            <strong>Central:</strong> (11) 3000-0000<br>
                            <strong>Whatsapp:</strong> (11) 99999-9999<br>
                            <strong>Horário:</strong> Seg-Sex 08:00-20:00
                        </p>
                    </div>

                    <div class="info-box">
                        <h4><i class="fas fa-envelope"></i> Email</h4>
                        <p>
                            <strong>Suporte:</strong> suporte@adaptivemove.com<br>
                            <strong>Comercial:</strong> comercial@adaptivemove.com<br>
                            <strong>Dúvidas:</strong> info@adaptivemove.com
                        </p>
                    </div>

                    <div class="info-box">
                        <h4><i class="fas fa-map-marker-alt"></i> Localização</h4>
                        <p>
                            <strong>Matriz:</strong><br>
                            Avenida Paulista, 1000<br>
                            Bela Vista, São Paulo - SP<br>
                            CEP: 01311-100
                        </p>
                    </div>

                    <div class="info-box">
                        <h4><i class="fas fa-clock"></i> Horário de Funcionamento</h4>
                        <p>
                            <strong>Segunda a Sexta:</strong> 06:00 - 23:00<br>
                            <strong>Sábado:</strong> 08:00 - 20:00<br>
                            <strong>Domingo:</strong> 08:00 - 18:00
                        </p>
                    </div>
                </div>
            </div>

            <div class="faq-section">
                <h3><i class="fas fa-question-circle"></i> Perguntas Frequentes</h3>

                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFaq(this)">
                        <span>Como faço para me cadastrar?</span>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        Clique em "Cadastro" no menu superior, preencha seus dados e crie sua conta. É rápido e fácil!
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFaq(this)">
                        <span>Qual é o valor da mensalidade?</span>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        Temos planos a partir de R$ 99/mês. Visite uma de nossas unidades ou entre em contato para mais informações.
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFaq(this)">
                        <span>Posso fazer aula experimental?</span>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        Sim! Oferecemos uma aula experimental gratuita. Entre em contato conosco para agendar.
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFaq(this)">
                        <span>Vocês oferecem personal trainer?</span>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        Sim! Temos personal trainers especializados disponíveis. Consulte valores e disponibilidade.
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFaq(this)">
                        <span>Como funciona o calendário de treinos?</span>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        Após fazer login, você pode acessar o calendário para agendar seus treinos, acompanhar progresso e receber lembretes.
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleFaq(element) {
            const answer = element.nextElementSibling;
            answer.classList.toggle('active');
            element.querySelector('i').style.transform = answer.classList.contains('active') ? 'rotate(180deg)' : 'rotate(0deg)';
        }
    </script>

    <?php include '../includes/footer.php'; ?>
</body>
</html>
