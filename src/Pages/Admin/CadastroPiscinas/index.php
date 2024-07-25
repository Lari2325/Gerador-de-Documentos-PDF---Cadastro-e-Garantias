<?php
    session_start();

    if (!isset($_SESSION['user'])) {
        header('Location: ../../../../index.php');
        exit();
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela de Cadastro de Piscina</title>
    <link rel="stylesheet" href="../../assets/css/style.css">
</head>
<body>
    <?php 
        $saida = ".";
        include("./../menu.php");
    ?>
    <main>
        <h2>Cadastrar Piscinas</h2>
        <form action="./processar_formulario.php" method="post">
            <div>
                <label for="nome">Digite o modelo de Piscina:</label>
                <input type="nome" id="nome" name="nome" required>
            </div>
            <div>
                <button type="submit">Cadastrar</button>
            </div>
        </form>

        <?php
            include("./listar_piscina.php");
        ?>
    </main>

</body>
</html>