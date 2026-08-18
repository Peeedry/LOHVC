<?php
include_once("conexao.php");

$pdo = conectar();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>LOHVC</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <script src="js/bootstrap.js"></script>
    <script src="js/jquery.js"></script>
</head>

<body class="fun">
    <div class="d-flex justify-content-center">
        <h2>Cadastro como Professor</h2>
    </div>
          <form method="post" enctype="multipart/form-data">
             <div class="mb-3">
             <label>Nome:</label>
             <input type="text" name="nome" value="" class="form-control col-3">
             </div>
             <label>Data de Nacismento:</label>
             <input type="date" name="data" value="" class="form-control col-3">
             <label>CPF:</label>
             <input  oninput="mascara(this)" type="text" name="cpf" class="form-control col-3">
             <label>Telefone:</label>
             <input type="tel" maxlength="15" onkeyup="handlePhone(event)" name="telef" class="form-control col-3">
             <label>Email:</label>
             <input type="text" name="email" class="form-control col-3">
             <label>Senha:</label>
             <input type="password" name="senha" class="form-control col-3">
        </div>
        <button class="text-success" type="submit" name="btnSalvar" class="btn btn-primary">Salvar</button>
    </form>
</body>

<script>

function mascara(i){
   
   var v = i.value;
   
   if(isNaN(v[v.length-1])){ // impede entrar outro caractere que não seja número
      i.value = v.substring(0, v.length-1);
      return;
   }
   
   i.setAttribute("maxlength", "14");
   if (v.length == 3 || v.length == 7) i.value += ".";
   if (v.length == 11) i.value += "-";

}

const handlePhone = (event) => {
  let input = event.target
  input.value = phoneMask(input.value)
}

const phoneMask = (value) => {
  if (!value) return ""
  value = value.replace(/\D/g,'')
  value = value.replace(/(\d{2})(\d)/,"($1) $2")
  value = value.replace(/(\d)(\d{4})$/,"$1-$2")
  return value
}

</script>

</html>
<?php
//fazer o teste se foi pressionado o botão
if (isset($_POST['btnSalvar'])) {

    $nome = $_POST['nome'];
    $data = $_POST['data'];
    $cpf = $_POST['cpf'];
    $telef = $_POST['telef'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    //validação simplificada - se o campo tá vazio
    if (empty($nome)) {
        echo "Necessário informar o nome";
        exit();
    }


    if (empty($cpf)) {
        echo "Necessário informar o CPF";
        exit();
    }

    if (empty($telef)) {
        echo "Necessário informar o telefone";
        exit();
    }

    if (empty($email)) {
        echo "Necessário informar o email";
        exit();
    }

    if (empty($senha)) {
        echo "Necessário informar a senha";
        exit();
    }

    function mybr($data)
    {
        $datam = implode("-", array_reverse(explode("/", $data)));
        return $datam;
    }
    
    // criar o SQL de inserção
    $sql = "INSERT INTO tb_professores (nome_prof, dtanasc_prof, cpf_prof, telf_prof, email_prof, senha_prof) VALUES (:nome, :data, :cpf, :telef, :email, :senha)"; //variavel magica

    // preparar o SQL para execução (EVITA SQL INJECTION)
    
    $stmt = $pdo->prepare($sql);

    // trocar pelo valor da variavel magica pelo recebido via formulário
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':data', $data);
    $stmt->bindParam(':cpf', $cpf);
    $stmt->bindParam(':telef', $telef);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':senha', $senha);


    // mandar realizar o codigo 
    if ($stmt->execute()) {
        //mostra mensagem de execução com sucesso
        echo "Categoria inserida com sucesso!";
        header("Location: loginprof.php");
    } else {
        echo "Erro ao inserir categoria";
    }
}
?>