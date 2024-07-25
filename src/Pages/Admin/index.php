<?php
    session_start();

    if (!isset($_SESSION['user'])) {
        header('Location: ./TelaLogin/index.php');
        exit();
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página inicial</title>
    <link rel="stylesheet" href="./../assets/css/style.css">
</head>
<body>
    <?php 
        $saida = "";
        include("./menu.php");
    ?>
    <main>
        <h1>Seja bem vindo</h1>
    </main>
</body>
</html>