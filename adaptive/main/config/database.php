<?php
// Configuração do Banco de Dados
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'fitzone_db');

// Criar conexão
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS);

// Verificar conexão
if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}

// Criar banco de dados se não existir
$sql = "CREATE DATABASE IF NOT EXISTS " . DB_NAME;
if ($conn->query($sql) === TRUE) {
    // Selecionar banco
    $conn->select_db(DB_NAME);
} else {
    die("Erro ao criar banco de dados: " . $conn->error);
}

// Criar tabelas
$tables = [
    // Tabela de usuários
    "CREATE TABLE IF NOT EXISTS users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(100) NOT NULL,
        email VARCHAR(100) UNIQUE NOT NULL,
        password VARCHAR(255) NOT NULL,
        phone VARCHAR(20),
        profile_image VARCHAR(255),
        role ENUM('user', 'admin', 'trainer') DEFAULT 'user',
        status ENUM('active', 'inactive', 'banned') DEFAULT 'active',
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )",
    
    // Tabela de treinos
    "CREATE TABLE IF NOT EXISTS workouts (
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT NOT NULL,
        title VARCHAR(100) NOT NULL,
        description TEXT,
        date DATE NOT NULL,
        time TIME NOT NULL,
        duration INT,
        type VARCHAR(50),
        status ENUM('scheduled', 'completed', 'cancelled') DEFAULT 'scheduled',
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
    )",
    
    // Tabela de academias
    "CREATE TABLE IF NOT EXISTS gyms (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(100) NOT NULL,
        address VARCHAR(255) NOT NULL,
        latitude DECIMAL(10, 8) NOT NULL,
        longitude DECIMAL(11, 8) NOT NULL,
        phone VARCHAR(20),
        email VARCHAR(100),
        website VARCHAR(255),
        opening_hours VARCHAR(100),
        rating DECIMAL(3, 2),
        image_url VARCHAR(255),
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )",
    
    // Tabela de mensagens de contato
    "CREATE TABLE IF NOT EXISTS contact_messages (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(100) NOT NULL,
        email VARCHAR(100) NOT NULL,
        subject VARCHAR(255) NOT NULL,
        message TEXT NOT NULL,
        status ENUM('new', 'read', 'replied') DEFAULT 'new',
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )",
    
    // Tabela de planos
    "CREATE TABLE IF NOT EXISTS plans (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(100) NOT NULL,
        price DECIMAL(10, 2) NOT NULL,
        duration INT,
        features TEXT,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )",
    
    // Tabela de inscrições
    "CREATE TABLE IF NOT EXISTS subscriptions (
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT NOT NULL,
        plan_id INT NOT NULL,
        start_date DATE NOT NULL,
        end_date DATE NOT NULL,
        status ENUM('active', 'expired', 'cancelled') DEFAULT 'active',
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
        FOREIGN KEY (plan_id) REFERENCES plans(id) ON DELETE CASCADE
    )"
];

// Executar criação de tabelas
foreach ($tables as $table) {
    if ($conn->query($table) === FALSE) {
        // Silenciosamente falha se tabela já existe
    }
}

// Inserir dados padrão
$check_gyms = $conn->query("SELECT COUNT(*) as count FROM gyms");
$result = $check_gyms->fetch_assoc();

if ($result['count'] == 0) {
    $gyms_data = [
        "INSERT INTO gyms (name, address, latitude, longitude, phone, email, website, opening_hours, rating) VALUES 
        ('FitZone Paulista', 'Avenida Paulista, 1000, São Paulo', -23.5505, -46.6333, '(11) 3456-7890', 'paulista@fitzone.com', 'www.fitzone.com', '6h-22h', 4.8),
        ('FitZone Vila Mariana', 'Rua Vergueiro, 500, São Paulo', -23.5890, -46.6234, '(11) 3456-7891', 'vilamariana@fitzone.com', 'www.fitzone.com', '6h-22h', 4.7),
        ('FitZone Pinheiros', 'Rua Bandeira, 300, São Paulo', -23.5550, -46.6700, '(11) 3456-7892', 'pinheiros@fitzone.com', 'www.fitzone.com', '6h-22h', 4.9),
        ('FitZone Consolação', 'Avenida Consolação, 2000, São Paulo', -23.5450, -46.6550, '(11) 3456-7893', 'consolacao@fitzone.com', 'www.fitzone.com', '6h-22h', 4.6)"
    ];
    
    foreach ($gyms_data as $gym) {
        $conn->query($gym);
    }
}

// Inserir planos padrão
$check_plans = $conn->query("SELECT COUNT(*) as count FROM plans");
$result = $check_plans->fetch_assoc();

if ($result['count'] == 0) {
    $plans_data = [
        "INSERT INTO plans (name, price, duration, features) VALUES 
        ('Básico', 99.00, 30, 'Acesso à academia,Aulas em grupo,App mobile'),
        ('Premium', 199.00, 30, 'Tudo do Básico,Personal trainer,Nutrição,Aulas online'),
        ('Elite', 299.00, 30, 'Tudo do Premium,Suporte 24/7,Programa personalizado,Massagem terapêutica')"
    ];
    
    foreach ($plans_data as $plan) {
        $conn->query($plan);
    }
}

// Função para fechar conexão
function closeDB() {
    global $conn;
    $conn->close();
}

// Manter conexão aberta para uso nas páginas
?>
