<?php
session_start();

// Função de login
function login($email, $password) {
    global $conn;
    
    $email = $conn->real_escape_string($email);
    $sql = "SELECT * FROM users WHERE email = '$email' AND status = 'active'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        
        // Verificar senha
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            $_SESSION['user_email'] = $user['email'];
            $_SESSION['user_role'] = $user['role'];
            $_SESSION['user_image'] = $user['profile_image'];
            
            return true;
        }
    }
    
    return false;
}

// Função de registro
function register($name, $email, $password, $phone = '') {
    global $conn;
    
    $email = $conn->real_escape_string($email);
    $name = $conn->real_escape_string($name);
    $phone = $conn->real_escape_string($phone);
    
    // Verificar se email já existe
    $check = $conn->query("SELECT id FROM users WHERE email = '$email'");
    if ($check->num_rows > 0) {
        return ['success' => false, 'message' => 'Email já cadastrado'];
    }
    
    // Hash da senha
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);
    
    $sql = "INSERT INTO users (name, email, password, phone) 
            VALUES ('$name', '$email', '$hashed_password', '$phone')";
    
    if ($conn->query($sql) === TRUE) {
        return ['success' => true, 'message' => 'Usuário criado com sucesso'];
    } else {
        return ['success' => false, 'message' => 'Erro ao criar usuário'];
    }
}

// Função de logout
function logout() {
    session_destroy();
    header('Location: /gym-website-pro/');
    exit;
}

// Função para verificar se está logado
function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

// Função para verificar se é admin
function isAdmin() {
    return isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin';
}

// Função para verificar se é trainer
function isTrainer() {
    return isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'trainer';
}

// Função para obter dados do usuário
function getUserData($user_id) {
    global $conn;
    $user_id = (int)$user_id;
    $result = $conn->query("SELECT * FROM users WHERE id = $user_id");
    return $result->fetch_assoc();
}

// Função para atualizar perfil
function updateProfile($user_id, $name, $phone, $image = null) {
    global $conn;
    
    $user_id = (int)$user_id;
    $name = $conn->real_escape_string($name);
    $phone = $conn->real_escape_string($phone);
    
    if ($image) {
        $image = $conn->real_escape_string($image);
        $sql = "UPDATE users SET name = '$name', phone = '$phone', profile_image = '$image' WHERE id = $user_id";
    } else {
        $sql = "UPDATE users SET name = '$name', phone = '$phone' WHERE id = $user_id";
    }
    
    return $conn->query($sql);
}

// Função para mudar senha
function changePassword($user_id, $old_password, $new_password) {
    global $conn;
    
    $user_id = (int)$user_id;
    $user = getUserData($user_id);
    
    if (!password_verify($old_password, $user['password'])) {
        return ['success' => false, 'message' => 'Senha atual incorreta'];
    }
    
    $hashed_password = password_hash($new_password, PASSWORD_BCRYPT);
    $sql = "UPDATE users SET password = '$hashed_password' WHERE id = $user_id";
    
    if ($conn->query($sql) === TRUE) {
        return ['success' => true, 'message' => 'Senha alterada com sucesso'];
    } else {
        return ['success' => false, 'message' => 'Erro ao alterar senha'];
    }
}

// Função para criar usuário admin (secreto)
function createAdminUser($email, $password, $secret_key = 'FITZONE_ADMIN_2024') {
    global $conn;
    
    // Verificar chave secreta
    if ($secret_key !== 'FITZONE_ADMIN_2024') {
        return ['success' => false, 'message' => 'Chave secreta inválida'];
    }
    
    $email = $conn->real_escape_string($email);
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);
    
    $sql = "INSERT INTO users (name, email, password, role) 
            VALUES ('Admin', '$email', '$hashed_password', 'admin')";
    
    if ($conn->query($sql) === TRUE) {
        return ['success' => true, 'message' => 'Admin criado com sucesso'];
    } else {
        return ['success' => false, 'message' => 'Erro ao criar admin'];
    }
}

?>
