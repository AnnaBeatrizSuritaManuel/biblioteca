<?php
session_start();
include 'includes/conexao.php';

$erro = '';
$sucesso = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = trim($_POST['nome'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $senha = $_POST['password'] ?? '';
    $telefone = trim($_POST['telefone'] ?? '');
    $etec_estudante = isset($_POST['etec_estudante']) ? 1 : 0;
    
    // Validar dados
    if (empty($nome) || empty($email) || empty($senha)) {
        $erro = "Preencha todos os campos obrigatórios!";
    } elseif (strlen($senha) < 6) {
        $erro = "A senha deve ter no mínimo 6 caracteres!";
    } elseif (strlen($nome) < 3) {
        $erro = "O nome deve ter pelo menos 3 caracteres!";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erro = "Digite um e-mail válido!";
    } else {
        try {
            // Verificar se email já existe
            $stmt = $pdo->prepare("SELECT id_usuario FROM USUARIO WHERE email = ?");
            $stmt->execute([$email]);
            
            if ($stmt->rowCount() > 0) {
                $erro = "Este email já está cadastrado!";
            } else {
                // Inserir novo usuário
                $senha_hash = password_hash($senha, PASSWORD_DEFAULT);
                
                $stmt = $pdo->prepare("INSERT INTO USUARIO (nome, email, senha, telefone, etec_estudante, tipo) VALUES (?, ?, ?, ?, ?, 'usuario')");
                $stmt->execute([$nome, $email, $senha_hash, $telefone, $etec_estudante]);
                
                $sucesso = "Cadastro realizado com sucesso!";
                
                // Redirecionar para login após 2 segundos
                header("refresh:2;url=login.php");
            }
        } catch(PDOException $e) {
            $erro = "Erro ao cadastrar: " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Bibliotec - Cadastro</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link rel="stylesheet" href="assets/css/estilo.css">
    <style>
        .form-label[required]::after {
            content: " *";
            color: var(--error);
        }

        .form-control:required {
            border-left: 3px solid var(--primary-main);
        }

        .requirement-list {
            background: var(--background);
            padding: 1.5rem;
            border-radius: 12px;
            margin: 1.5rem 0;
            border-left: 4px solid var(--primary-main);
            box-shadow: 0 2px 8px var(--shadow);
        }

        .requirement-item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 0.75rem;
            padding: 0.5rem;
            border-radius: 6px;
            transition: all 0.3s ease;
        }

        .requirement-item:hover {
            background: rgba(74, 124, 89, 0.05);
        }

        .requirement-item i {
            font-size: 1.1rem;
            width: 20px;
            text-align: center;
        }

        .checkbox-group {
            background: var(--background);
            padding: 1rem;
            border-radius: 8px;
            border: 2px dashed var(--primary-light);
            margin: 1rem 0;
        }

        .checkbox-group label {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            font-weight: 500;
            cursor: pointer;
        }

        .benefit-badge {
            background: var(--success);
            color: white;
            padding: 0.25rem 0.5rem;
            border-radius: 12px;
            font-size: 0.8rem;
            font-weight: 600;
            margin-left: 0.5rem;
        }
    </style>
</head>

<body>
    <?php include 'includes/header.php'; ?>

    <main>
        <div class="container">
            <div class="card" style="max-width: 500px; margin: 2rem auto;">
                <div class="card-body">
                    <h1 class="text-center">Crie sua conta</h1>
                    <p class="text-center text-muted">Cadastre-se para começar a explorar</p>

                    <?php if($erro): ?>
                        <div class="alert alert-erro"><?= $erro ?></div>
                    <?php endif; ?>
                    
                    <?php if($sucesso): ?>
                        <div class="alert alert-sucesso"><?= $sucesso ?></div>
                    <?php endif; ?>

                    <!-- Lista de Requisitos -->
                    <div class="requirement-list">
                        <h4 style="margin-bottom: 1rem; color: var(--primary-dark);">📋 Requisitos do Cadastro:</h4>
                        <div class="requirement-item">
                            <i class="fas fa-check-circle" style="color: var(--success);"></i>
                            <span><strong>Nome completo</strong> (mínimo 3 caracteres)</span>
                        </div>
                        <div class="requirement-item">
                            <i class="fas fa-check-circle" style="color: var(--success);"></i>
                            <span><strong>E-mail válido</strong> (exemplo@email.com)</span>
                        </div>
                        <div class="requirement-item">
                            <i class="fas fa-check-circle" style="color: var(--success);"></i>
                            <span><strong>Senha segura</strong> (mínimo 6 caracteres)</span>
                        </div>
                        <div class="requirement-item">
                            <i class="fas fa-info-circle" style="color: var(--info);"></i>
                            <span><strong>Telefone</strong> (opcional, formato: (11) 99999-9999)</span>
                        </div>
                    </div>

                    <form method="POST" id="cadForm">
                        <div class="form-group">
                            <label class="form-label" required>Nome completo</label>
                            <input type="text" name="nome" class="form-control" 
                                   value="<?= htmlspecialchars($_POST['nome'] ?? '') ?>" 
                                   placeholder="Digite seu nome completo" 
                                   required
                                   minlength="3">
                            <small class="text-muted">Mínimo 3 caracteres</small>
                        </div>

                        <div class="form-group">
                            <label class="form-label" required>E-mail</label>
                            <input type="email" name="email" class="form-control" 
                                   value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" 
                                   placeholder="seu@email.com" 
                                   required>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Telefone</label>
                            <input type="tel" name="telefone" class="form-control" 
                                   value="<?= htmlspecialchars($_POST['telefone'] ?? '') ?>"
                                   placeholder="(11) 99999-9999"
                                   pattern="\([0-9]{2}\) [0-9]{4,5}-[0-9]{4}">
                            <small class="text-muted">Formato: (11) 99999-9999</small>
                        </div>

                        <div class="form-group">
                            <label class="form-label" required>Senha</label>
                            <input type="password" name="password" class="form-control" 
                                   placeholder="Crie uma senha segura" 
                                   required
                                   minlength="6">
                            <small class="text-muted">Mínimo 6 caracteres</small>
                        </div>

                        <div class="form-group">
                            <label class="form-label" required>Confirmar senha</label>
                            <input type="password" name="password2" class="form-control" 
                                   placeholder="Digite a senha novamente" 
                                   required>
                        </div>

                        <!-- Checkbox Estudante ETEC -->
                        <div class="checkbox-group">
                            <label>
                                <input type="checkbox" name="etec_estudante" value="1" 
                                       <?= isset($_POST['etec_estudante']) ? 'checked' : '' ?>> 
                                <span>Sou estudante da ETEC Maria Cristina Medeiros</span>
                                <span class="benefit-badge">BENEFÍCIO</span>
                            </label>
                            <small class="text-muted" style="display: block; margin-top: 0.5rem; margin-left: 2rem;">
                                ✅ Empréstimos gratuitos para estudantes da ETEC!
                            </small>
                        </div>

                        <button type="submit" class="btn btn-primary" style="width: 100%;">
                            <i class="fas fa-user-plus"></i> Criar Conta
                        </button>

                        <p class="text-center mt-3">
                            Já tem conta? <a href="login.php">Entrar</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <?php include 'includes/footer.php'; ?>

    <script>
        const form = document.getElementById('cadForm');

        // Validação em tempo real
        document.querySelectorAll('input[required]').forEach(input => {
            input.addEventListener('blur', function() {
                validateField(this);
            });
        });

        function validateField(field) {
            const value = field.value.trim();
            const formGroup = field.closest('.form-group');
            
            // Remove mensagens de erro anteriores
            formGroup.querySelector('.error-message')?.remove();
            field.style.borderColor = '';
            
            if (field.hasAttribute('required') && !value) {
                showError(field, 'Este campo é obrigatório');
                return false;
            }
            
            if (field.type === 'email' && value && !isValidEmail(value)) {
                showError(field, 'Digite um e-mail válido');
                return false;
            }
            
            if (field.name === 'password' && value && value.length < 6) {
                showError(field, 'A senha deve ter no mínimo 6 caracteres');
                return false;
            }
            
            if (field.name === 'nome' && value && value.length < 3) {
                showError(field, 'O nome deve ter pelo menos 3 caracteres');
                return false;
            }
            
            return true;
        }

        function showError(field, message) {
            field.style.borderColor = 'var(--error)';
            const errorDiv = document.createElement('div');
            errorDiv.className = 'error-message';
            errorDiv.style.color = 'var(--error)';
            errorDiv.style.fontSize = '0.8rem';
            errorDiv.style.marginTop = '0.25rem';
            errorDiv.textContent = message;
            field.closest('.form-group').appendChild(errorDiv);
        }

        function isValidEmail(email) {
            return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
        }

        form.addEventListener('submit', (e) => {
            let isValid = true;
            
            // Valida todos os campos obrigatórios
            document.querySelectorAll('input[required]').forEach(field => {
                if (!validateField(field)) {
                    isValid = false;
                }
            });

            const pass = document.querySelector('input[name="password"]').value;
            const pass2 = document.querySelector('input[name="password2"]').value;

            if (pass !== pass2) {
                e.preventDefault();
                showError(document.querySelector('input[name="password2"]'), 'As senhas não coincidem');
                isValid = false;
            }

            if (!isValid) {
                e.preventDefault();
                alert('Por favor, corrija os erros no formulário antes de enviar.');
            }
        });

        // Formatação do telefone
        document.querySelector('input[name="telefone"]').addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value.length > 11) value = value.substring(0, 11);
            
            if (value.length > 0) {
                value = value.replace(/^(\d{2})(\d)/g, '($1) $2');
                if (value.length > 9) {
                    value = value.replace(/(\d{5})(\d)/, '$1-$2');
                } else if (value.length > 5) {
                    value = value.replace(/(\d{4})(\d)/, '$1-$2');
                }
            }
            
            e.target.value = value;
        });
    </script>
</body>
</html>