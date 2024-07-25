<?php
session_start();

require_once("../../../databaseconnect.php");

if (isset($_POST['user']) && isset($_POST['password'])) {
    $user = $_POST['user'];
    $password = $_POST['password'];

    $query = "SELECT * FROM tb_admin WHERE usuario = :user AND senha = :password";

    try {
        $stmt = $pdo->prepare($query);

        $stmt->bindParam(':user', $user, PDO::PARAM_STR);
        $stmt->bindParam(':password', $password, PDO::PARAM_STR);

        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            // Usuário autenticado com sucesso
            $_SESSION['user'] = $user; 
            echo "Login bem-sucedido!";
            header('Location: ../index.php');
            exit();
        } else {
            echo "Usuário ou senha incorretos.";
        }
    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage();
    }
} else {
    echo "Por favor, preencha o usuário e senha.";
}