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
    <title>Listagem de Documentos</title>
    <link rel="stylesheet" href="../../assets/css/style.css">
</head>
<body>

<?php

$saida = ".";
include("./../menu.php");

require_once("../../../databaseconnect.php");

// Processar exclusão de documento
if (isset($_POST['delete'])) {
    $id_documento = $_POST['id_documento'];
    $sql = "DELETE FROM tb_documento WHERE id_documento = :id_documento";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id_documento', $id_documento, PDO::PARAM_INT);
    if ($stmt->execute()) {
        header('Location: ' . $_SERVER['PHP_SELF'] . '?success=true');
        exit();
    } else {
        echo "Erro ao excluir documento.";
    }
}

// Processar salvamento de alterações
if (isset($_POST['save'])) {
    $id_documento = $_POST['id_documento'];
    $data_compra = $_POST['data_compra'];
    $data_instalacao = $_POST['data_instalacao'];
    $numero_garantia = $_POST['numero_garantia'];
    $id_cliente = $_POST['id_cliente'];
    $id_revendedor = $_POST['id_revendedor'];
    $id_piscina = $_POST['id_piscina'];

    $sql = "UPDATE tb_documento SET data_compra = :data_compra, data_instalacao = :data_instalacao, numero_garantia = :numero_garantia, id_cliente = :id_cliente, id_revendedor = :id_revendedor, id_piscina = :id_piscina WHERE id_documento = :id_documento";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':data_compra', $data_compra);
    $stmt->bindParam(':data_instalacao', $data_instalacao);
    $stmt->bindParam(':numero_garantia', $numero_garantia);
    $stmt->bindParam(':id_cliente', $id_cliente);
    $stmt->bindParam(':id_revendedor', $id_revendedor);
    $stmt->bindParam(':id_piscina', $id_piscina);
    $stmt->bindParam(':id_documento', $id_documento);
    if ($stmt->execute()) {
        header('Location: ' . $_SERVER['PHP_SELF'] . '?success=true');
        exit();
    } else {
        echo "Erro ao atualizar documento.";
    }
}

// Buscar documentos
$searchTerm = '';
if (isset($_GET['search'])) {
    $searchTerm = $_GET['search'];
}

$sql = "SELECT d.id_documento, d.data_compra, d.data_instalacao, d.numero_garantia, 
            c.id_cliente, c.nome_completo AS nome_cliente, r.id_revendedor, r.nome AS nome_revendedor, 
            p.id_piscina, p.modelo_piscina 
        FROM tb_documento d
        JOIN tb_cliente c ON d.id_cliente = c.id_cliente
        JOIN tb_revendedor r ON d.id_revendedor = r.id_revendedor
        JOIN tb_piscina p ON d.id_piscina = p.id_piscina
        WHERE d.id_documento LIKE :search
        OR c.nome_completo LIKE :search
        OR r.nome LIKE :search
        OR p.modelo_piscina LIKE :search";

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':search', '%' . $searchTerm . '%', PDO::PARAM_STR);
$stmt->execute();

$documentos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<main>
    <h1>Listagem de Documentos</h1>
    <section>
        <form method="get" action="">
            <input type="text" name="search" value="<?php echo htmlspecialchars($searchTerm); ?>" placeholder="Buscar Documentos">
            <button type="submit">Buscar</button>
        </form>
        
        <div class="container-table">
            <table>
                <thead>
                    <tr>
                        <th>Data Compra</th>
                        <th>Data Instalação</th>
                        <th>Número Garantia</th>
                        <th>Nome Cliente</th>
                        <th>Nome Revendedor</th>
                        <th>Modelo Piscina</th>
                        <th>Editar</th>
                        <th>Excluir</th>
                        <th>Salvar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        if (count($documentos) > 0) {
                            foreach ($documentos as $documento) {
                                $isEditing = isset($_POST['edit']) && $_POST['edit'] == $documento['id_documento'];
                                $isSaveEnabled = $isEditing;
        
                                echo "<tr>";
                                echo "<form method='post' action='' onsubmit='return checkInput(this);'>";
                                echo "<td><input type='date' name='data_compra' value='" . htmlspecialchars($documento['data_compra']) . "'" . ($isEditing ? "" : " disabled") . "></td>";
                                echo "<td><input type='date' name='data_instalacao' value='" . htmlspecialchars($documento['data_instalacao']) . "'" . ($isEditing ? "" : " disabled") . "></td>";
                                echo "<td><input type='text' name='numero_garantia' value='" . htmlspecialchars($documento['numero_garantia']) . "'" . ($isEditing ? "" : " disabled") . "></td>";
        
                                $id_cliente = $documento['id_cliente'];
                                $id_revendedor = $documento['id_revendedor'];
                                $id_piscina = $documento['id_piscina'];
        
                                echo "<td><select name='id_cliente'" . ($isEditing ? "" : " disabled") . ">";
                                $clientes = $pdo->query("SELECT id_cliente, nome_completo FROM tb_cliente")->fetchAll(PDO::FETCH_ASSOC);
                                foreach ($clientes as $cliente) {
                                    $selected = $id_cliente == $cliente['id_cliente'] ? "selected" : "";
                                    echo "<option value='" . $cliente['id_cliente'] . "' $selected>" . htmlspecialchars($cliente['nome_completo']) . "</option>";
                                }
                                echo "</select></td>";
        
                                echo "<td><select name='id_revendedor'" . ($isEditing ? "" : " disabled") . ">";
                                $revendedores = $pdo->query("SELECT id_revendedor, nome FROM tb_revendedor")->fetchAll(PDO::FETCH_ASSOC);
                                foreach ($revendedores as $revendedor) {
                                    $selected = $id_revendedor == $revendedor['id_revendedor'] ? "selected" : "";
                                    echo "<option value='" . $revendedor['id_revendedor'] . "' $selected>" . htmlspecialchars($revendedor['nome']) . "</option>";
                                }
                                echo "</select></td>";
        
                                echo "<td><select name='id_piscina'" . ($isEditing ? "" : " disabled") . ">";
                                $piscinas = $pdo->query("SELECT id_piscina, modelo_piscina FROM tb_piscina")->fetchAll(PDO::FETCH_ASSOC);
                                foreach ($piscinas as $piscina) {
                                    $selected = $id_piscina == $piscina['id_piscina'] ? "selected" : "";
                                    echo "<option value='" . $piscina['id_piscina'] . "' $selected>" . htmlspecialchars($piscina['modelo_piscina']) . "</option>";
                                }
                                echo "</select></td>";
        
                                echo "<input type='hidden' name='id_documento' value='" . htmlspecialchars($documento['id_documento']) . "'>";
                                echo "<td><button type='submit' name='edit' value='" . htmlspecialchars($documento['id_documento']) . "'>Editar</button></td>";
                                echo "<td><button type='submit' name='delete' value='Excluir' onclick='return confirm(\"Você tem certeza que deseja excluir?\")'>Excluir</button></td>";
                                echo "<td><button type='submit' name='save' value='Salvar'" . ($isSaveEnabled ? "" : " disabled") . ">Salvar</button></td>";
                                echo "</form>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='9'>Nenhum documento encontrado</td></tr>";
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </section>
</main>

<script>
    function checkInput(form) {
        const inputs = form.querySelectorAll('input[name="data_compra"], input[name="data_instalacao"], input[name="numero_garantia"], select[name="id_cliente"], select[name="id_revendedor"], select[name="id_piscina"]');
        for (const input of inputs) {
            if (input.value === '' || input.value === null) {
                alert('Todos os campos devem ser preenchidos.');
                return false;
            }
        }
        return true;
    }
</script>

</body>
</html>