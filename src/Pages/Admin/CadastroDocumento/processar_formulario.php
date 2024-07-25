<?php
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: ../../../../index.php');
    exit();
}

require_once("../../../databaseconnect.php");

if (isset($_POST['data_compra']) &&
    isset($_POST['data_instalacao']) &&
    isset($_POST['numero_garantia']) &&
    isset($_POST['id_cliente']) &&
    isset($_POST['id_revendedor']) &&
    isset($_POST['id_piscina'])) {

    $dt_compra = $_POST['data_compra'];
    $dt_instalacao = $_POST['data_instalacao'];
    $numero_garantia = $_POST['numero_garantia'];
    $id_cliente = $_POST['id_cliente'];
    $id_revendedor = $_POST['id_revendedor'];
    $id_piscina = $_POST['id_piscina'];

    $query = "INSERT INTO tb_documento (data_compra, data_instalacao, numero_garantia, id_cliente, id_revendedor, id_piscina) 
              VALUES (:dt_compra, :dt_instalacao, :numero_garantia, :id_cliente, :id_revendedor, :id_piscina)";

    $stmt = $pdo->prepare($query);

    $params = array(
        ':dt_compra' => $dt_compra,
        ':dt_instalacao' => $dt_instalacao,
        ':numero_garantia' => $numero_garantia,
        ':id_cliente' => $id_cliente,
        ':id_revendedor' => $id_revendedor,
        ':id_piscina' => $id_piscina
    );

    try {
        $stmt->execute($params);
        header('Location: ./index.php');
        exit();
    } catch (PDOException $e) {
        echo "Erro ao inserir dados: " . htmlspecialchars($e->getMessage());
    }
}