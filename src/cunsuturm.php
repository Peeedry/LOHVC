<?php
//session_start();
include_once('conexao.php');

$pdo = conectar();

$sql = "SELECT * FROM tb_turmas";
$stmt = $pdo->prepare($sql);
$stmt->execute();
// buscando todos as linhas da tabela
$resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);

// buscando um unico registro
// $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Listagem de Turmas</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/bootstrap.js"></script>
    <script src="js/jquery.js"></script>
</head>

<body>
    <h2>
        <center>Listagem de Turmas</center>
    </h2>
    <table class="table table-striped table-bordered">
        <tr class="table">
            <th>ID:</th>
            <th>Data de Inicio:</th>
            <th>Data de Terminio:</th>
            <th>Duração/Meses:</th>
            <th>Preço:</th>
            <th>Ativo:</th>
        </tr>
        <?php foreach ($resultado as $r) { ?>
            <tr>
                <td><?php echo $r['id_turm']; ?></td>
                <td><?php echo $r['data_inicio_turm']; ?></td>
                <td><?php echo $r['data_term_turm']; ?></td>
                <td><?php echo $r['quat_turm']; ?></td>
                <td><?php echo $r['id_curs']; ?></td>
                <td><?php echo $r['ativo_turm']; ?></td>
            </tr>

        <?php } ?>
    </table>
</body>

</html>