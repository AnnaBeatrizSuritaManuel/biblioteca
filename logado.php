<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>bibliotec - Login Concluído</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --primary-dark: #1a1a1a;
            --primary-main: #2C3E50;
            --primary-light: #34495E;
            --secondary-dark: #465c78;
            --secondary-main: #7f8c8d;
            --secondary-light: #95a5a6;
            --background: #f8f9fa;
            --surface: #ffffff;
            --text-primary: #2c3e50;
            --text-secondary: #5d6d7e;
            --text-muted: #7f8c8d;
            --border: #e0e0e0;
            --shadow: rgba(44, 62, 80, 0.1);
            --shadow-hover: rgba(44, 62, 80, 0.2);
            --success: #27ae60;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            line-height: 1.6;
            background-color: var(--background);
            color: var(--text-primary);
            font-weight: 400;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }

        .success-container {
            text-align: center;
            max-width: 500px;
            width: 100%;
        }

        .success-card {
            background: var(--surface);
            padding: 3rem;
            border-radius: 16px;
            box-shadow: 0 8px 32px var(--shadow);
            border: 1px solid var(--border);
        }

        .success-icon {
            width: 80px;
            height: 80px;
            background: var(--success);
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 2rem;
            color: white;
            font-size: 2.5rem;
        }

        .success-title {
            font-size: 2rem;
            margin-bottom: 1rem;
            color: var(--primary-dark);
        }

        .success-message {
            color: var(--text-secondary);
            margin-bottom: 2.5rem;
            font-size: 1.1rem;
            line-height: 1.6;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 12px 24px;
            border-radius: 8px;
            font-weight: 500;
            font-size: 0.95rem;
            cursor: pointer;
            transition: all 0.3s ease;
            border: none;
            font-family: 'Inter', sans-serif;
            gap: 8px;
            text-decoration: none;
        }

        .btn-primary {
            background-color: var(--primary-main);
            color: white;
        }

        .btn-primary:hover {
            background-color: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px var(--shadow-hover);
        }

        .btn-secondary {
            background-color: transparent;
            color: var(--primary-main);
            border: 1px solid var(--border);
        }

        .btn-secondary:hover {
            background-color: var(--background);
            border-color: var(--primary-main);
        }

        .button-group {
            display: flex;
            gap: 1rem;
            justify-content: center;
            flex-wrap: wrap;
        }

        @media (max-width: 480px) {
            .success-card {
                padding: 2rem;
            }

            .button-group {
                flex-direction: column;
            }

            .btn {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="success-container">
        <div class="success-card">
            <div class="success-icon">
                <i class="fas fa-check"></i>
            </div>
            
            <h1 class="success-title">Login Concluído!</h1>
            
            <p class="success-message">
                Bem-vinda de volta, Lara! Seu login foi realizado com sucesso. 
                Agora você pode acessar todos os recursos da sua conta.
            </p>
            
            <div class="button-group">
                <a href="usuario.php" class="btn btn-primary">
                    <i class="fas fa-user"></i>
                    Meu Perfil
                </a>
                
                <a href="index.php" class="btn btn-secondary">
                    <i class="fas fa-home"></i>
                    Página Inicial
                </a>
            </div>
        </div>
    </div>
</body>
</html>