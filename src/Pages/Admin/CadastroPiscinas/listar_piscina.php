<?php
require_once("../../../databaseconnect.php");

if (isset($_POST['delete'])) {
    $id = $_POST['id'];
    $sql = "DELETE FROM tb_piscina WHERE id_piscina = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    if ($stmt->execute()) {
        header("Location: " . $_SERVER['PHP_SELF'] . "?success=true");
        exit();
    } else {
        echo "Erro ao excluir revendedor";
    }
}

if (isset($_POST['save'])) {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $sql = "UPDATE tb_piscina SET modelo_piscina = :nome WHERE id_piscina = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    if ($stmt->execute()) {
        header("Location: " . $_SERVER['PHP_SELF'] . "?success=true");
        exit();
    } else {
        echo "Erro ao atualizar piscina";
    }
}

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

$sql = "SELECT id_piscina, modelo_piscina FROM tb_piscina WHERE modelo_piscina LIKE :search";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':search', '%' . $searchTerm . '%', PDO::PARAM_STR);
$stmt->execute();
?>
<section>
    <form method="get" action="">
        <input type="text" name="search" value="<?php echo htmlspecialchars($searchTerm); ?>" placeholder="Buscar Piscinas">
        <button type="submit">Buscar</button>
    </form>
    <div class="container-table">
        <table>
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Editar</th>
                    <th>Apagar</th>
                    <th>Salvar</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($stmt->rowCount() > 0) {
                    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        $isEditing = isEditing($row["id_piscina"]);
                        $isSaveEnabled = isSaveEnabled($row["id_piscina"]);
                        echo "<tr>";
                        echo "<form method='post' action='' oninput='checkInput(this)'>";
                        echo "<td><input type='text' name='nome' value='" . htmlspecialchars($row["modelo_piscina"]) . "'" . ($isEditing ? "" : " disabled") . "></td>";
                        echo "<input type='hidden' name='id' value='" . $row["id_piscina"] . "'>";
                        echo "<td><button type='submit' name='edit' value='" . $row["id_piscina"] . "'>Editar</button></td>";
                        echo "<td><button type='submit' name='delete' value='" . $row["id_piscina"] . "'>Apagar</button></td>";
                        echo "<td><button type='submit' name='save' value='Salvar'" . ($isSaveEnabled ? "" : " disabled") . ">Salvar</button></td>";
                        echo "<input type='hidden' name='nome_changed' value='" . ($isEditing ? "false" : "true") . "'>";
                        echo "</form>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>Nenhuma piscina encontrada</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</section>

<script>
function checkInput(form) {
    const input = form.querySelector('input[name="nome"]');
    const saveButton = form.querySelector('button[name="save"]');
    const originalValue = input.defaultValue;

    if (input.value !== originalValue) {
        form.querySelector('input[name="nome_changed"]').value = "true";
        saveButton.disabled = false;
    } else {
        form.querySelector('input[name="nome_changed"]').value = "false";
        saveButton.disabled = true;
    }
}

window.addEventListener('load', function() {
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.get('success') === 'true') {
        location.href = './';
    }
});
</script>