<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>bibliotec - Sucesso!</title>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;600;700&display=swap" rel="stylesheet">
    
    <style>
        /* Cores principais - #8C2C2C como primária e #361A1A como secundária */
        :root {
            --global-primary: #8C2C2C;
            --global-secondary: #361A1A;
            --global-accent: #8C2C2C;
            --global-light: #E6CECE;
            --global-background: #F5F5F5;
            --global-dark: #2C1818;
            --shadow-light: rgba(140, 44, 44, 0.1);
            --success-color: #8C2C2C;
        }

        /* Configurações gerais  */
        body {
            font-family: 'Quicksand', sans-serif;
            background-color: var(--global-background); 
            color: var(--global-dark);
            
            /* Centraliza o card de sucesso na tela */
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            text-align: center;
            padding: 20px;
        }

        /* --- CARD DE SUCESSO --- */
        .sucesso-container {
            background-color: var(--global-light);
            padding: 70px 50px;
            border-radius: 25px;
            box-shadow: 0 15px 40px var(--shadow-light);
            width: 100%;
            max-width: 500px;
            border: 3px solid var(--global-primary);
        }

        /* Círculo do Ícone */
        .icon-circle {
            display: inline-flex;
            justify-content: center;
            align-items: center;
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background-color: var(--success-color);
            margin-bottom: 30px;
            box-shadow: 0 5px 15px rgba(140, 44, 44, 0.3);
        }

        /* O Checkmark */
        .checkmark {
            color: white;
            font-size: 60px;
            font-weight: 700;
            line-height: 1;
        }

        /* Título */
        h1 {
            color: var(--global-primary);
            font-size: 2.5em;
            margin-bottom: 20px;
            font-weight: 700;
        }

        /* Parágrafo de instrução */
        p {
            color: var(--global-dark);
            margin-bottom: 40px;
            line-height: 1.6;
            font-weight: 400;
            font-size: 1.1rem;
        }

        /* Contêiner para alinhar os botões */
        .button-group {
            display: flex;
            justify-content: center;
            gap: 20px;
            flex-wrap: wrap;
        }

        /* Botão Primário (Ir para a Tela de Usuário) */
        .btn-primary-action {
            display: inline-block;
            padding: 15px 30px;
            border-radius: 30px;
            font-weight: 600;
            text-align: center;
            transition: all 0.3s ease;
            cursor: pointer;
            
            background-color: var(--global-primary);
            color: white;
            border: 2px solid var(--global-primary);
            text-decoration: none;
            font-family: 'Quicksand', sans-serif;
            font-size: 1.1rem;
        }

        .btn-primary-action:hover {
            background-color: #7a2626;
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(140, 44, 44, 0.3);
        }

        /* Botão Secundário (Voltar para a Home) */
        .btn-secondary-action {
            display: inline-block;
            padding: 15px 30px;
            border-radius: 30px;
            font-weight: 600;
            text-align: center;
            transition: all 0.3s ease;
            cursor: pointer;
            
            background-color: transparent;
            color: var(--global-primary);
            border: 2px solid var(--global-primary);
            text-decoration: none;
            font-family: 'Quicksand', sans-serif;
            font-size: 1.1rem;
        }

        .btn-secondary-action:hover {
            background-color: var(--global-primary);
            color: var(--global-light);
            transform: translateY(-3px);
        }

        @media (max-width: 480px) {
            .sucesso-container {
                padding: 50px 30px;
            }
            
            .button-group {
                flex-direction: column;
                gap: 15px;
            }
            
            .btn-primary-action,
            .btn-secondary-action {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="sucesso-container">
        <div class="icon-circle">
            <span class="checkmark">✓</span>
        </div>
        
        <h1>Login Concluído com Sucesso!</h1>
        <p>Bem-vindo(a) ao site. Escolha para onde deseja navegar.</p>
        
        <div class="button-group">
            <a href="usuario.php" class="btn-primary-action">Minha Conta</a>
            <a href="index.php" class="btn-secondary-action">Voltar para a Home</a>
        </div>
    </div>
</body>
</html>