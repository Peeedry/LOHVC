<?php
include_once('conexao.php');

$pdo = conectar();

$id = $_GET['id'];

$sqlc = "SELECT * FROM tb_clientes WHERE id_cli = :id";
$stmc = $pdo->prepare($sqlc);
$stmc->bindParam(':id', $id);
$stmc->execute();

if ($stmc->rowCount() > 0) {
    $sqlex = "DELETE FROM tb_clientes WHERE id_cli = $id";
    $stmex = $pdo->query($sqlex);
    echo "Categoria excluída com sucesso!";
} else {
    echo "Categoria não encontrada!";
}

header('Location: consucli.php');