<?php
include_once("conexao.php");

$pdo = conectar();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Lohvc</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/login.css">
    <script src="js/bootstrap.js"></script>
    <script src="js/jquery.js"></script>
</head>

<body>
    <div class="d-flex justify-content-center">
        <h2>Criar Cursos</h2>
    </div>
    <form method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label>Nome/Tipo do curso:</label>
            <input type="text" name="tipo" class="form-control col-3">
            <label>Descrição:</label>
            <input type="text" name="descr" class="form-control col-3">
            <label>Duração:</label>
            <input type="number" name="durc" class="form-control col-3">
            <label>Preço:</label>
            <input type="number" name="prec" class="form-control col-3">
        </div>
        <button class="text-success" type="submit" name="btnSalvar" class="btn btn-primary">Salvar</button>
    </form>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
</body>

<script>
function criaMascara(mascaraInput) {
  const maximoInput = document.getElementById(`${mascaraInput}Input`).maxLength;
  let valorInput = document.getElementById(`${mascaraInput}Input`).value;
  let valorSemPonto = document.getElementById(`${mascaraInput}Input`).value.replace(/([^0-9])+/g, "");
  const mascaras = {
    CPF: valorInput.replace(/[^\d]/g, "").replace(/(\d{3})(\d{3})(\d{3})(\d{2})/, "$1.$2.$3-$4"),
    Celular: valorInput.replace(/[^\d]/g, "").replace(/^(\d{2})(\d{5})(\d{4})/, "($1) $2-$3"),
    CEP: valorInput.replace(/[^\d]/g, "").replace(/(\d{5})(\d{3})/, "$1-$2"),
    CNJ: valorInput.replace(/[^\d]/g, "").replace(/(\d{7})(\d{2})(\d{4})(\d{1})(\d{2})(\d{4})/, "$1-$2.$3.$4.$5.$6"),
  };

  valorInput.length === maximoInput ? document.getElementById(`${mascaraInput}Input`).value = mascaras[mascaraInput]
 : document.getElementById(`${mascaraInput}Input`).value = valorSemPonto;
};
</script>

</html>
<?php
//fazer o teste se foi pressionado o botão
if (isset($_POST['btnSalvar'])) {

    $tipo = $_POST['tipo'];
    $descr = $_POST['descr'];
    $durc = $_POST['durc'];
    $prec = $_POST['prec'];

    //validação simplificada - se o campo tá vazio
    if (empty($tipo)) {
        echo "Necessário informar o tipo";
        exit();
    }


    if (empty($descr)) {
        echo "Necessário informar a descrição";
        exit();
    }

    if (empty($durc)) {
        echo "Necessário informar a duração";
        exit();
    }

    
    if (empty($prec)) {
        echo "Necessário informar o preço";
        exit();
    }


    // criar o SQL de inserção
    $sql = "INSERT INTO tb_cursos (tipo_curs, desc_curs, dur_curs, preco_curs) VALUES (:tipo, :descr, :durc, :prec)"; //variavel magica

    // preparar o SQL para execução (EVITA SQL INJECTION)
    
    $stmt = $pdo->prepare($sql);

    // trocar pelo valor da variavel magica pelo recebido via formulário
    $stmt->bindParam(':tipo', $tipo);
    $stmt->bindParam(':descr', $descr);
    $stmt->bindParam(':durc', $durc);
    $stmt->bindParam(':prec', $prec);


    // mandar realizar o codigo 
    if ($stmt->execute()) {
        //mostra mensagem de execução com sucesso
        echo "Categoria inserida com sucesso!";
        // envio a execução para outra pagina
        // header("Location: pagina.php");
    } else {
        echo "Erro ao inserir categoria";
    }
}
?>