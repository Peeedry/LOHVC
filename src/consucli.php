<?php
//session_start();
include_once('conexao.php');

$pdo = conectar();

$sql = "SELECT * FROM tb_clientes";
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
    <title>Listagem de Clientes</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/bootstrap.js"></script>
    <script src="js/jquery.js"></script>
    
</head>

<body>
    <h2>
        <center>Listagem de Clientes</center>
    </h2>
    <table class="table table-striped table-bordered">
        <tr class="table">
            <th>ID:</th>
            <th>Nome:</th>
            <th>Data de Nacismento:</th>
            <th>Cpf:</th>
            <th>Telefone:</th>
            <th>Email:</th>
            <th>Senha:</th>
            <th>Tipo:</th>
            <th>Ativo:</th>
        </tr>
        <?php foreach ($resultado as $r) { ?>
            <tr>
                <td><?php echo $r['id_cli']; ?></td>
                <td><?php echo $r['nome_cli']; ?></td>
                <td><?php echo $r['dtanasc_cli']; ?></td>
                <td><?php echo $r['cpf_cli']; ?></td>
                <td><?php echo $r['telf_cli']; ?></td>
                <td><?php echo $r['email_cli']; ?></td>
                <td><?php echo $r['senha_cli']; ?></td>
                <td><?php echo $r['tipo']; ?></td>
                <td><?php echo $r['ativo_cli']; ?></td>
                <td><a href="altrecli.php?id=<?php echo $r['id_cli'] ?>" class="btn btn-warning">ALTERAÇÃO</a> - <a href="exclcli.php?id=<?php echo $r['id_cli'] ?>" class="btn btn-danger">EXCLUSÃO</a> </td>
            </tr>

        <?php } ?>
    </table>
</body>

</html>