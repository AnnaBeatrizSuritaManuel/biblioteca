<?php
session_start();
require "config.php";

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $email = $_POST['email'];
    $senha = md5($_POST['senha']);

    $sql = $pdo->prepare("SELECT * FROM usuarios WHERE email=? AND senha=?");
    $sql->execute([$email, $senha]);

    if($sql->rowCount() > 0){
        $user = $sql->fetch();
        $_SESSION['user'] = $user;
        header("Location: admin.php");
        exit;
    } else {
        $erro = "Email ou senha incorretos!";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<title>Login</title>
<link rel="stylesheet" href="assets/style.css">
</head>
<body>
<form method="POST" class="login-box">
    <h2>Entrar</h2>
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="senha" placeholder="Senha" required>
    <button type="submit">Entrar</button>
    <?php if(isset($erro)) echo "<p class='error'>$erro</p>"; ?>
</form>
</body>
</html>
