<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerar PDF</title>
    <link rel="stylesheet" href="./../../assets/css/style.css">
</head>
<body>
    <main class="tela-de-login">
        <h2>Gerar pdf</h2>
        <form action="processar_formulario.php" method="post">
            <div>
                <label for="cpf">Digite seu CPF:</label>
                <input type="cpf" id="cpf" name="cpf">
            </div>
            <div>
                <label for="garantia">N° da garantia:</label>
                <input type="garantia" id="garantia" name="garantia">
            </div>
            <div>
                <button type="submit">Gerar PDF</button>
            </div>
        </form>
    </main>
</body>
</html>