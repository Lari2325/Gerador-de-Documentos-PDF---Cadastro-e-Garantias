<?php
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: ../../../../index.php');
    exit();
}

require_once("../../../databaseconnect.php");

if((isset($_POST['nome']))){
    $nome = $_POST['nome'];

    $query = "INSERT INTO tb_piscina (modelo_piscina) VALUES (:nome)";

    $stmt = $pdo->prepare($query);

    $params = array(
        ':nome' => $nome
    );  

    $stmt->execute($params);

    header('Location: ./index.php');
}