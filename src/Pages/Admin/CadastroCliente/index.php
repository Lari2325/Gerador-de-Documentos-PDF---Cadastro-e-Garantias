<?php
    session_start();

    if (!isset($_SESSION['user'])) {
        header('Location: ../../../../index.php');
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Cliente</title>
    <link rel="stylesheet" href="../../assets/css/style.css">
</head>
<body>
    <?php 
        $saida = ".";
        include("./../menu.php");
    ?>

    <main>
        <h1>Cadastro de Cliente</h1>
        <form action="processar_formulario.php" method="post">
            <label for="nome_completo">Nome Completo:</label>
            <input type="text" id="nome_completo" name="nome_completo" maxlength="100" required>
            
            <label for="cpf">CPF:</label>
            <input type="text" id="cpf" name="cpf" maxlength="11" required>
            
            <label for="rg">RG:</label>
            <input type="text" id="rg" name="rg" maxlength="20" required>
            
            <label for="cep">CEP:</label>
            <input type="text" id="cep" name="cep" maxlength="8" required>
            <button type="button" onclick="buscarEndereco()">Buscar</button>
            
            <label for="endereco">Endereço:</label>
            <input type="text" id="endereco" name="endereco" maxlength="255" disabled>
            
            <label for="numero_da_casa">Número Residencial:</label>
            <input type="text" id="numero_da_casa" name="numero_da_casa" maxlength="255" required>
            
            <label for="cidade">Cidade:</label>
            <input type="text" id="cidade" name="cidade" maxlength="100" disabled>
            
            <label for="uf">UF:</label>
            <input type="text" id="uf" name="uf" maxlength="2" disabled>
            
            <label for="celular_telefone">Celular/Telefone:</label>
            <input type="text" id="celular_telefone" name="celular_telefone" maxlength="15" required>
            
            <label for="email">E-mail:</label>
            <input type="email" id="email" name="email" maxlength="100" required>
            
            <label for="dt_nascimento">Data de Nascimento:</label>
            <input type="date" id="dt_nascimento" name="dt_nascimento" required>
            
            <label for="estado_civil">Estado Civil:</label>
            <select id="estado_civil" name="estado_civil" required>
                <option value="solteiro">Solteiro(a)</option>
                <option value="casado">Casado(a)</option>
                <option value="divorciado">Divorciado(a)</option>
                <option value="viuvo">Viúvo(a)</option>
                <option value="outro">Outro</option>
            </select>
            
            <button type="submit">Enviar</button>
        </form>
    </main>

    <script>
        async function buscarEndereco() {
            const cep = document.getElementById('cep').value;
            if (cep.length === 8) {
                try {
                    const response = await fetch(`https://viacep.com.br/ws/${cep}/json/`);
                    const data = await response.json();
                    if (!data.erro) {
                        document.getElementById('endereco').value = data.logradouro || '';
                        document.getElementById('cidade').value = data.localidade || '';
                        document.getElementById('uf').value = data.uf || '';
                        document.getElementById('endereco').disabled = false;
                        document.getElementById('cidade').disabled = false;
                        document.getElementById('uf').disabled = false;
                    } else {
                        alert("CEP não encontrado.");
                    }
                } catch (error) {
                    alert("Erro ao buscar o CEP.");
                }
            } else {
                alert("CEP deve conter 8 dígitos.");
            }
        }
    </script>
</body>
</html>