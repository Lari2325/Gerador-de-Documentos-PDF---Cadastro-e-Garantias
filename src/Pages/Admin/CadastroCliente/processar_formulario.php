<?php
session_start();


if (!isset($_SESSION['user'])) {
    header('Location: ../../../../index.php');
    exit();
}

require_once("../../../databaseconnect.php");

var_dump($_POST);

if (
    isset($_POST['nome_completo']) && 
    isset($_POST['cpf']) && 
    isset($_POST['rg']) && 
    isset($_POST['cep']) &&
    isset($_POST['endereco']) &&
    isset($_POST['numero_da_casa']) &&
    isset($_POST['cidade']) &&
    isset($_POST['uf']) &&
    isset($_POST['celular_telefone']) &&
    isset($_POST['email']) &&
    isset($_POST['dt_nascimento']) &&
    isset($_POST['estado_civil'])
) {
    $nome = $_POST['nome_completo'];
    $cpf = $_POST['cpf'];
    $rg = $_POST['rg'];
    $endereco = $_POST['endereco'];
    $cidade = $_POST['cidade'];
    $uf = $_POST['uf'];
    $cep = $_POST['cep'];
    $celular_telefone = $_POST['celular_telefone'];
    $email = $_POST['email'];
    $dt_nascimento = $_POST['dt_nascimento'];
    $estado_civil = $_POST['estado_civil'];
    $numero_da_casa = $_POST['numero_da_casa'];

    $query = "INSERT INTO tb_cliente (nome_completo, cpf, rg, endereco, cidade, uf, cep, celular_telefone, email, dt_nascimento, estado_civil, numero_casa) VALUES (:nome, :cpf, :rg, :endereco, :cidade, :uf, :cep, :celular_telefone, :email, :dt_nascimento, :estado_civil, :numero)";

    try {
        $stmt = $pdo->prepare($query);

        $params = array(
            ':nome' => $nome,
            ':cpf' => $cpf,
            ':rg' => $rg,
            ':endereco' => $endereco,
            ':cidade' => $cidade,
            ':uf' => $uf,
            ':cep' => $cep,
            ':celular_telefone' => $celular_telefone,
            ':email' => $email,
            ':dt_nascimento' => $dt_nascimento,
            ':estado_civil' => $estado_civil,
            ':numero' => $numero_da_casa
        );  

        $stmt->execute($params);

        header('Location: ./index.php');
        exit;
    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage();
    }
} else {
    echo "Todos os campos são necessários.";
}