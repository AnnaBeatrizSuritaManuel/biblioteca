<?php
    include_once 'conexao.php';

    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $consulta = "SELECT * FROM usuarios WHERE email = :email AND senha = :senha";  

    $stmt = $pdo->prepare($consulta);

    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':senha', $senha);


    $stmt->execute();

    $registros = $stmt->rowCount();


    if($registros == 1){
        //echo 'Ok Valido';
        header('Location: restrita.php');
    }else{
        //echo 'Não valido';
        header('Location: index.php');
    }

?>