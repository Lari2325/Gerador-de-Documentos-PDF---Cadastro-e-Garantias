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
    <title>Cadastrar documento</title>
    <link rel="stylesheet" href="../../assets/css/style.css">
</head>
<body>
    <?php 
        $saida = ".";
        include("./../menu.php");

        require_once("../../../databaseconnect.php");

        $sqlClientes = "SELECT id_cliente, nome_completo FROM tb_cliente";
        $stmtClientes = $pdo->prepare($sqlClientes);
        $stmtClientes->execute();
        $clientes = $stmtClientes->fetchAll(PDO::FETCH_ASSOC);
        
        $sqlPiscinas = "SELECT id_piscina, modelo_piscina FROM tb_piscina";
        $stmtPiscinas = $pdo->prepare($sqlPiscinas);
        $stmtPiscinas->execute();
        $piscinas = $stmtPiscinas->fetchAll(PDO::FETCH_ASSOC);
      
        $sqlRevendedores = "SELECT id_revendedor, nome FROM tb_revendedor";
        $stmtRevendedores = $pdo->prepare($sqlRevendedores);
        $stmtRevendedores->execute();
        $revendedores = $stmtRevendedores->fetchAll(PDO::FETCH_ASSOC);
    ?>

    <main>
        <h1>Cadastrar documento</h1>
        <form method="post" action="processar_formulario.php">
            <label for="data_compra">Data da Compra:</label>
            <input type="date" id="data_compra" name="data_compra">
            
            <label for="data_instalacao">Data de Instalação:</label>
            <input type="date" id="data_instalacao" name="data_instalacao">

            <label for="numero_garantia">Número da Garantia:</label>
            <input type="text" id="numero_garantia" name="numero_garantia">

            <label for="id_cliente">Cliente:</label>
            <select id="id_cliente" name="id_cliente">
                <?php
                    foreach ($clientes as $cliente) {
                        echo "<option value=\"" . htmlspecialchars($cliente['id_cliente']) . " \"> " . htmlspecialchars($cliente['nome_completo']) . "</option>";
                    }
                ?>  
            </select>

            <label for="id_revendedor">Revendedor:</label>
            <select id="id_revendedor" name="id_revendedor">
                <?php
                    foreach ($revendedores as $revendedor) {
                        echo "<option value=\"" . htmlspecialchars($revendedor['id_revendedor']) . " \"> " . htmlspecialchars($revendedor['nome']) . "</option>";
                    }
                ?>  
            </select>

            <label for="id_piscina">Modelo da Piscina:</label>
            <select id="id_piscina" name="id_piscina">
                <?php
                    foreach ($piscinas as $piscina) {
                        echo "<option value=\"" . htmlspecialchars($piscina['id_piscina']) . " \"> " . htmlspecialchars($piscina['modelo_piscina']) . "</option>";
                    }
                ?>  
            </select>

            <button type="submit">Enviar</button>
        </form>
    </main>
</body>
</html>