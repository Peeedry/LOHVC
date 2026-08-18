<?php
session_start();
include_once('conexao.php');

$pdo = conectar();

$id = $_GET['id'];

$sql = "SELECT * FROM tb_professores WHERE id_prof = :id";

$stmc = $pdo->prepare($sql);
$stmc->bindParam(':id', $id);
$stmc->execute();

$re = $stmc->fetch(PDO::FETCH_OBJ);

/*
COMO USAR:
FETCH_ASSOC = $re['idcategoria']
FETCH_OBJ = $re->idcategoria
*/
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Alteração do Cliente</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/bootstrap.js"></script>
    <script src="js/jquery.js"></script>
</head>

<body>
    <h2>Alteração do Professor</h2>
    <form method="POST">
        <div class="form-group">
            <label>Nome:</label><br>
            <input type="text" name="nome_e" value="<?php echo $re->nome_prof; ?>"><br>
            <label>Data de Nacismento:</label><br>
            <input type="date" name="dta_e" value="<?php echo $re->dtanasc_prof; ?>"><br>
            <label>CPF:</label><br>
            <input type="text" name="cpf_e" value="<?php echo $re->cpf_prof; ?>"><br>
            <label>Telefone:</label><br>
            <input type="tel" name="telf_e" value="<?php echo $re->telf_prof; ?>"><br>
            <label>Email:</label><br>
            <input type="text" name="email_e" value="<?php echo $re->email_prof; ?>"><br>
            <label>Senha:</label><br>
            <input type="password" name="senha_e" value="<?php echo $re->senha_prof; ?>"><br>
        </div>
        <button type="submit" class="btn btn-success" name="btnAlterar">Alterar</button>
    </form>
</body>

</html>
<?php
// teste se botão foi pressionado
if (isset($_POST['btnAlterar'])) {

    //pego o valor do input (alterado ou não)
    $nome_e = $_POST['nome_e'];
    $dta_e = $_POST['dta_e'];
    $cpf_e = $_POST['cpf_e'];
    $telf_e = $_POST['telf_e'];
    $email_e = $_POST['email_e'];
    $senha_e = $_POST['senha_e'];



    //verifico se tem conteudo
    if (empty($nome_e)) {
        echo "Necessário informar a descricao da categoria";
        exit();
    }

    //crio o sql de alteração
    $sqlup = "UPDATE tb_professores SET nome_prof = :nome, dtanasc_prof = :data, cpf_prof = :cpf, telf_prof = :telef, email_prof = :email, senha_prof  = :senha
             WHERE id_prof = :id";

    //preparo do sql
    $stmup = $pdo->prepare($sqlup);

    // troco os parametros :descricao e :id
    $stmup->bindParam(':nome', $nome_e);
    $stmup->bindParam(':data', $dta_e);
    $stmup->bindParam(':cpf', $cpf_e);
    $stmup->bindParam(':telef', $telf_e);
    $stmup->bindParam(':email', $email_e);
    $stmup->bindParam(':senha', $senha_e);
    $stmup->bindParam(':id', $id);

    //executo o sql
    if ($stmup->execute()) {
        echo "Alterado com sucesso!";
        header("Location: consuprof.php");
    } else {
        echo "Erro ao alterar!";
    }
}

?>