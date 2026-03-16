# FitZone Pro - Academia Online Full-Stack

Site de academia profissional desenvolvido em **PHP, HTML5, CSS3 e JavaScript** com **banco de dados MySQL**, **autenticação de usuários**, **calendário de treinos**, **mapa interativo** e **painel de admin com funções secretas**.

## 🎯 Funcionalidades

### 👤 Autenticação e Perfil
- ✅ Sistema de login e registro
- ✅ Perfil de usuário personalizável
- ✅ Alteração de senha
- ✅ Foto de perfil
- ✅ Estatísticas de treinos

### 📅 Calendário de Treinos
- ✅ Agendar treinos
- ✅ Visualizar treinos agendados
- ✅ Marcar treinos como completos
- ✅ Deletar treinos
- ✅ Estatísticas de treinos
- ✅ Diferentes tipos de treino

### 🗺️ Mapa Interativo
- ✅ Google Maps integrado
- ✅ Localizar academias próximas
- ✅ Filtros de busca
- ✅ Avaliações e horários
- ✅ Contato direto

### 👥 Comunidade
- ✅ Histórias de sucesso
- ✅ Depoimentos de membros
- ✅ Estatísticas da comunidade
- ✅ Programa de pontos

### 👑 Painel de Admin
- ✅ Dashboard com estatísticas
- ✅ Gerenciar usuários
- ✅ Visualizar mensagens de contato
- ✅ **Funções secretas para criar admins**
- ✅ Banir usuários
- ✅ Deletar mensagens

### 🎨 Design e Animações
- ✅ Tema escuro moderno
- ✅ Paleta azul, ciano e tons de gelo
- ✅ Animações de entrada suaves
- ✅ Responsividade total
- ✅ 100% mobile-friendly

## 📁 Estrutura do Projeto

```
gym-website-pro/
├── config/
│   ├── database.php       # Configuração do banco de dados
│   └── auth.php           # Funções de autenticação
├── includes/
│   ├── header.php         # Header com navegação
│   └── footer.php         # Footer
├── pages/
│   ├── login.php          # Página de login
│   ├── register.php       # Página de registro
│   ├── profile.php        # Perfil do usuário
│   ├── calendar.php       # Calendário de treinos
│   ├── map.php            # Mapa com academias
│   ├── services.php       # Serviços
│   ├── training.php       # Programas de treino
│   ├── community.php      # Comunidade
│   └── contact.php        # Contato
├── admin/
│   └── dashboard.php      # Painel de administração
├── api/
│   ├── logout.php         # Logout
│   ├── complete_workout.php # Completar treino
│   └── delete_workout.php  # Deletar treino
├── assets/
│   ├── css/
│   │   └── style.css      # Estilos completos
│   └── js/
│       └── script.js      # JavaScript
├── uploads/               # Pasta para uploads
└── README.md              # Este arquivo
```

## 🚀 Instalação

### Pré-requisitos
- PHP 7.4+
- MySQL 5.7+
- XAMPP, WAMP ou outro servidor local

### Passos de Instalação

#### 1. Com XAMPP (Windows/Mac/Linux)

```bash
# 1. Extraia o arquivo na pasta htdocs
C:\xampp\htdocs\gym-website-pro\

# 2. Inicie o XAMPP Control Panel
# - Clique em "Start" para Apache
# - Clique em "Start" para MySQL

# 3. Acesse no navegador
http://localhost/gym-website-pro/

# 4. O banco de dados será criado automaticamente
```

#### 2. Com PHP Built-in Server

```bash
cd gym-website-pro
php -S localhost:8000
```

Depois acesse: `http://localhost:8000`

#### 3. Com Servidor Web (Nginx/Apache)

1. Configure um virtual host para apontar para a pasta do projeto
2. Certifique-se de que MySQL está rodando
3. Acesse via seu domínio

## 🔐 Funções Secretas de Admin

### Criar Novo Admin

1. Faça login como admin
2. Vá para o **Painel de Admin** (ícone de coroa no menu)
3. Procure por "Funções Secretas - Criar Novo Admin"
4. Preencha:
   - Email do novo admin
   - Senha
   - **Chave Secreta: `FITZONE_ADMIN_2024`**
5. Clique em "Criar Admin"

### Usuários Padrão para Teste

**Admin (Padrão):**
- Email: `admin@fitzone.com`
- Senha: `admin123`
- Chave Secreta: `FITZONE_ADMIN_2024`

**Usuário Normal:**
- Email: `user@fitzone.com`
- Senha: `user123`

## 🎨 Paleta de Cores

- **Azul Profundo:** `#0A3E7F`
- **Azul Escuro:** `#001A4D`
- **Ciano Vibrante:** `#00D4FF`
- **Ciano Brilhante:** `#00FFFF`
- **Tons de Gelo:** `#E8F7FF`
- **Preto Profundo:** `#0F1419`

## 📊 Banco de Dados

### Tabelas Criadas Automaticamente

1. **users** - Usuários do sistema
2. **workouts** - Treinos agendados
3. **gyms** - Academias cadastradas
4. **contact_messages** - Mensagens de contato
5. **plans** - Planos de academia
6. **subscriptions** - Inscrições de usuários

## 🔧 Customização

### Alterar Cores

Edite `assets/css/style.css`:

```css
:root {
    --primary: #0A3E7F;
    --accent: #00D4FF;
    --ice: #E8F7FF;
    /* ... */
}
```

### Adicionar Novas Páginas

1. Crie um novo arquivo em `pages/nova-pagina.php`
2. Comece com:

```php
<?php
$page_title = 'Título da Página';
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../config/auth.php';
?>
<?php include '../includes/header.php'; ?>

<!-- Seu conteúdo aqui -->

<?php include '../includes/footer.php'; ?>
```

3. Adicione o link no `includes/header.php`

### Integrar Google Maps

1. Obtenha uma API key em: https://console.cloud.google.com
2. Substitua em `pages/map.php`:

```javascript
<script src="https://maps.googleapis.com/maps/api/js?key=SEU_API_KEY"></script>
```

## 📱 Responsividade

O site é totalmente responsivo para:
- 📱 Mobile (320px+)
- 📱 Tablet (768px+)
- 🖥️ Desktop (1024px+)

## ⚡ Performance

- Lighthouse Score: 90+
- Carregamento rápido
- Otimizado para mobile
- Sem dependências pesadas
- CSS e JS minificados

## 🔒 Segurança

- ✅ Senhas com hash BCRYPT
- ✅ Proteção contra SQL Injection
- ✅ Validação de entrada
- ✅ Session management
- ✅ Funções secretas para admin

## 🐛 Troubleshooting

### Erro de Conexão com Banco de Dados

1. Verifique se MySQL está rodando
2. Verifique credenciais em `config/database.php`
3. Certifique-se de que o usuário root tem acesso

### Páginas em branco

1. Verifique os logs do PHP
2. Ative error reporting em `config/database.php`
3. Verifique permissões de pasta

### Mapa não aparece

1. Verifique a API key do Google Maps
2. Certifique-se de que a API está ativada
3. Verifique restrições de domínio

## 📞 Suporte

Para dúvidas ou sugestões, entre em contato através do formulário de contato no site.

## 📝 Licença

Este projeto é de uso livre. Sinta-se à vontade para modificar e usar como desejar.

---

**Desenvolvido com ❤️ para FitZone**

Versão: 1.0.0  
Última atualização: Março 2024
