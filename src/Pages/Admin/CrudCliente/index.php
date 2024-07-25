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
    <title>Listagem de Cliente</title>
    <link rel="stylesheet" href="../../assets/css/style.css">
</head>
<body>
    
<?php
    $saida = ".";
    include("./../menu.php");

    require_once("../../../databaseconnect.php");

    function isEditing($id) {
        return isset($_POST['edit']) && $_POST['edit'] == $id;
    }

    function isSaveEnabled($id) {
        return isset($_POST['edit']) && $_POST['edit'] == $id && isset($_POST['nome_changed']) && $_POST['nome_changed'];
    }

    $searchTerm = '';
    if (isset($_GET['search'])) {
        $searchTerm = $_GET['search'];
    }

    // Modified SQL query to search across multiple fields
    $sql = "SELECT id_cliente, nome_completo, cpf, rg, endereco, numero_casa, cidade, uf, cep, celular_telefone, email, dt_nascimento, estado_civil 
            FROM tb_cliente 
            WHERE nome_completo LIKE :search 
            OR cpf LIKE :search 
            OR rg LIKE :search 
            OR endereco LIKE :search 
            OR numero_casa LIKE :search 
            OR cidade LIKE :search 
            OR uf LIKE :search 
            OR cep LIKE :search 
            OR celular_telefone LIKE :search 
            OR email LIKE :search 
            OR dt_nascimento LIKE :search 
            OR estado_civil LIKE :search";

    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':search', '%' . $searchTerm . '%', PDO::PARAM_STR);
    $stmt->execute();

    // Process delete request
    if (isset($_POST['delete'])) {
        $id = $_POST['id'];
        $sql = "DELETE FROM tb_cliente WHERE id_cliente = :id";
        $stmtDelete = $pdo->prepare($sql);
        $stmtDelete->bindParam(':id', $id, PDO::PARAM_INT);
        if ($stmtDelete->execute()) {
            header("Location: " . $_SERVER['PHP_SELF'] . "?success=true");
            exit();
        } else {
            echo "Erro ao excluir cliente";
        }
    }

    // Process save request
    if (isset($_POST['save'])) {
        $id = $_POST['id'];
        $nome_completo = $_POST['nome_completo'];
        $cpf = $_POST['cpf'];
        $rg = $_POST['rg'];
        $endereco = $_POST['endereco'];
        $numero_casa = $_POST['numero_casa'];
        $cidade = $_POST['cidade'];
        $uf = $_POST['uf'];
        $cep = $_POST['cep'];
        $celular_telefone = $_POST['celular_telefone'];
        $email = $_POST['email'];
        $dt_nascimento = $_POST['dt_nascimento'];
        $estado_civil = $_POST['estado_civil'];

        $sql = "UPDATE tb_cliente SET nome_completo = :nome_completo, cpf = :cpf, rg = :rg, endereco = :endereco, numero_casa = :numero_casa, cidade = :cidade, uf = :uf, cep = :cep, celular_telefone = :celular_telefone, email = :email, dt_nascimento = :dt_nascimento, estado_civil = :estado_civil WHERE id_cliente = :id";
        $stmtSave = $pdo->prepare($sql);
        $stmtSave->bindParam(':nome_completo', $nome_completo, PDO::PARAM_STR);
        $stmtSave->bindParam(':cpf', $cpf, PDO::PARAM_STR);
        $stmtSave->bindParam(':rg', $rg, PDO::PARAM_STR);
        $stmtSave->bindParam(':endereco', $endereco, PDO::PARAM_STR);
        $stmtSave->bindParam(':numero_casa', $numero_casa, PDO::PARAM_STR);
        $stmtSave->bindParam(':cidade', $cidade, PDO::PARAM_STR);
        $stmtSave->bindParam(':uf', $uf, PDO::PARAM_STR);
        $stmtSave->bindParam(':cep', $cep, PDO::PARAM_STR);
        $stmtSave->bindParam(':celular_telefone', $celular_telefone, PDO::PARAM_STR);
        $stmtSave->bindParam(':email', $email, PDO::PARAM_STR);
        $stmtSave->bindParam(':dt_nascimento', $dt_nascimento, PDO::PARAM_STR);
        $stmtSave->bindParam(':estado_civil', $estado_civil, PDO::PARAM_STR);
        $stmtSave->bindParam(':id', $id, PDO::PARAM_INT);
        if ($stmtSave->execute()) {
            header("Location: " . $_SERVER['PHP_SELF'] . "?success=true");
            exit();
        } else {
            echo "Erro ao atualizar cliente";
        }
    }
?>

<main>
    <h1>Listagem de Clientes</h1>
    <section>
        <form method="get" action="">
            <input type="text" name="search" value="<?php echo htmlspecialchars($searchTerm); ?>" placeholder="Buscar Clientes">
            <button type="submit">Buscar</button>
        </form>
        <div class="container-table">
            <table>
                <thead>
                    <tr>
                        <th>Nome Completo</th>
                        <th>CPF</th>
                        <th>RG</th>
                        <th>Endereço</th>
                        <th>Número Casa</th>
                        <th>Cidade</th>
                        <th>UF</th>
                        <th>CEP</th>
                        <th>Celular/Telefone</th>
                        <th>Email</th>
                        <th>Data Nascimento</th>
                        <th>Estado Civil</th>
                        <th>Editar</th>
                        <th>Apagar</th>
                        <th>Salvar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($stmt->rowCount() > 0) {
                        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            $isEditing = isEditing($row["id_cliente"]);
                            $isSaveEnabled = isSaveEnabled($row["id_cliente"]);
                            echo "<tr>";
                            echo "<form method='post' action='' oninput='checkInput(this)'>";
                            echo "<td><input type='text' name='nome_completo' value='" . htmlspecialchars($row["nome_completo"]) . "'" . ($isEditing ? "" : " disabled") . "></td>";
                            echo "<td><input type='text' name='cpf' value='" . htmlspecialchars($row["cpf"]) . "'" . ($isEditing ? "" : " disabled") . "></td>";
                            echo "<td><input type='text' name='rg' value='" . htmlspecialchars($row["rg"]) . "'" . ($isEditing ? "" : " disabled") . "></td>";
                            echo "<td><input type='text' name='endereco' value='" . htmlspecialchars($row["endereco"]) . "'" . ($isEditing ? "" : " disabled") . "></td>";
                            echo "<td><input type='text' name='numero_casa' value='" . htmlspecialchars($row["numero_casa"]) . "'" . ($isEditing ? "" : " disabled") . "></td>";
                            echo "<td><input type='text' name='cidade' value='" . htmlspecialchars($row["cidade"]) . "'" . ($isEditing ? "" : " disabled") . "></td>";
                            echo "<td><input type='text' name='uf' value='" . htmlspecialchars($row["uf"]) . "'" . ($isEditing ? "" : " disabled") . "></td>";
                            echo "<td><input type='text' name='cep' value='" . htmlspecialchars($row["cep"]) . "'" . ($isEditing ? "" : " disabled") . "></td>";
                            echo "<td><input type='text' name='celular_telefone' value='" . htmlspecialchars($row["celular_telefone"]) . "'" . ($isEditing ? "" : " disabled") . "></td>";
                            echo "<td><input type='email' name='email' value='" . htmlspecialchars($row["email"]) . "'" . ($isEditing ? "" : " disabled") . "></td>";
                            echo "<td><input type='date' name='dt_nascimento' value='" . htmlspecialchars($row["dt_nascimento"]) . "'" . ($isEditing ? "" : " disabled") . "></td>";
                            echo "<td><select name='estado_civil'" . ($isEditing ? "" : " disabled") . ">";
                            $estados_civis = ['solteiro', 'casado', 'divorciado', 'viuvo', 'outro'];
                            foreach ($estados_civis as $estado) {
                                $selected = $row["estado_civil"] == $estado ? "selected" : "";
                                echo "<option value='$estado' $selected>" . ucfirst($estado) . "</option>";
                            }
                            echo "</select></td>";
                            echo "<input type='hidden' name='id' value='" . $row["id_cliente"] . "'>";
                            echo "<td><button type='submit' name='edit' value='" . $row["id_cliente"] . "'>Editar</button></td>";
                            echo "<td><button type='submit' name='delete' value='Apagar'>Apagar</button></td>";
                            echo "<td><button type='submit' name='save' value='Salvar'" . ($isSaveEnabled ? "" : " disabled") . ">Salvar</button></td>";
                            echo "<input type='hidden' name='nome_changed' value='" . ($isEditing ? "false" : "true") . "'>";
                            echo "</form>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='14'>Nenhum cliente encontrado</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </section>
</main>

<script>
function checkInput(form) {
    const inputs = form.querySelectorAll('input[name="nome_completo"], input[name="cpf"], input[name="rg"], input[name="endereco"], input[name="numero_casa"], input[name="cidade"], input[name="uf"], input[name="cep"], input[name="celular_telefone"], input[name="email"], input[name="dt_nascimento"], select[name="estado_civil"]');
    const saveButton = form.querySelector('button[name="save"]');
    const originalValues = Array.from(inputs).map(input => input.defaultValue);

    let isChanged = false;

    inputs.forEach((input, index) => {
        if (input.type === 'select-one') {
            if (input.value !== originalValues[index]) {
                isChanged = true;
            }
        } else if (input.value !== originalValues[index]) {
            isChanged = true;
        }
    });

    form.querySelector('input[name="nome_changed"]').value = isChanged ? "true" : "false";
    saveButton.disabled = !isChanged;
}

window.addEventListener('load', function() {
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.get('success') === 'true') {
        location.href = './';
    }
});
</script>

</body>
</html>