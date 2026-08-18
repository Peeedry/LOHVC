<?php
include_once('conexao.php');

$pdo = conectar();

$id = $_GET['id'];

$sqlc = "SELECT * FROM tb_professores WHERE id_prof = :id";
$stmc = $pdo->prepare($sqlc);
$stmc->bindParam(':id', $id);
$stmc->execute();

if ($stmc->rowCount() > 0) {
    $sqlex = "DELETE FROM tb_professores WHERE id_prof = $id";
    $stmex = $pdo->query($sqlex);
    echo "Categoria excluída com sucesso!";
} else {
    echo "Categoria não encontrada!";
}

header('Location: consuprof.php');