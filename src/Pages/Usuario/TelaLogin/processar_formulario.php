<?php
session_start();
require_once("../../../databaseconnect.php");

if(isset($_POST['cpf']) && isset($_POST['garantia'])){
    $cpf = $_POST['cpf'];
    $garantia = $_POST['garantia'];

    $query = "SELECT 
                tb_cliente.nome_completo, tb_cliente.cpf, tb_cliente.rg, tb_cliente.endereco, tb_cliente.cidade, tb_cliente.uf, tb_cliente.cep, tb_cliente.celular_telefone, tb_cliente.email, tb_cliente.dt_nascimento, tb_cliente.estado_civil, tb_cliente.numero_casa,
                tb_revendedor.nome as revendedor_nome,
                tb_piscina.modelo_piscina,
                tb_documento.data_compra, tb_documento.data_instalacao, tb_documento.numero_garantia 
              FROM tb_documento 
              INNER JOIN tb_cliente ON tb_documento.id_cliente = tb_cliente.id_cliente 
              INNER JOIN tb_revendedor ON tb_documento.id_revendedor = tb_revendedor.id_revendedor
              INNER JOIN tb_piscina ON tb_documento.id_piscina = tb_piscina.id_piscina
              WHERE tb_documento.numero_garantia = :garantia AND tb_cliente.cpf = :cpf";

    try {
        $stmt = $pdo->prepare($query);

        $stmt->bindParam(':garantia', $garantia, PDO::PARAM_STR);
        $stmt->bindParam(':cpf', $cpf, PDO::PARAM_STR);

        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            $_SESSION['user_data'] = $result;
            echo "Login bem-sucedido!";
            header('Location: ../GerarPDF/index.php');
            exit();
        } else {
            echo "CPF ou N° de garantia incorretos.";
        }
    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage();
    }
} else {
    echo "Por favor, preencha o CPF e N° de garantia.";
}