<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela de login</title>
    <link rel="stylesheet" href="./src/Pages/assets/css/style.css">
</head>
<body>
    <main class="tela-de-login">
        <h2>Login</h2>
        <form action="./src/Pages/Admin/TelaLogin/processar_formulario.php" method="post">
            <div>
                <label for="user">Usuário:</label>
                <input type="user" id="user" name="user" required>
            </div>
            <div>
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div>
                <button type="submit">Login</button>
            </div>
        </form>
    </main>
</body>
</html>