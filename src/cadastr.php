<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>LOHVC</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <script src="js/bootstrap.js"></script>
    <script src="js/jquery.js"></script>
    <style>
        .error-container {
            text-align: center; /* Centralize o conteúdo horizontalmente */
        }

        .error-message {
            color: #721c24;
            background-color: #f8d7da;
            border: 1px solid #f5c6cb;
            padding: 10px;
            margin: 10px auto; /* Margens superior e inferior de 10px e margens esquerda e direita automáticas para centralizar */
            border-radius: 4px;
            max-width: 300px;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-4 mt-5">
                <div class="card">
                    <div class="card-body">
                        <h2 class="text-center">Cadastro</h2>
                        <form method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="nome">Nome:</label>
                                <input type="text" name="nome" id="nome" class="form-control" placeholder="Digite o nome">
                            </div>
                            <div class="form-group">
                                <label for="data">Data de Nascimento:</label>
                                <input type="date" name="data" id="data" class="form-control" placeholder="Digite a data de nascimento">
                            </div>
                            <div class="form-group">
                                <label for="cpf">CPF:</label>
                                <input type="text" oninput="mascara(this)" name="cpf" id="cpf" class="form-control" placeholder="Digite o CPF">
                            </div>
                            <div class="form-group">
                                <label for="telef">Telefone:</label>
                                <input type="text" maxlength="15" onkeyup="handlePhone(event)" name="telef" id="telef" class="form-control" placeholder="Digite o telefone">
                            </div>
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="text" name="email" id="email" class="form-control" placeholder="Digite o email">
                            </div>
                            <div class="form-group">
                                <label for="senha">Senha:</label>
                                <input type="password" name="senha" id="senha" class="form-control" placeholder="Digite a senha">
                            </div>
                            <button type="submit" name="btnSalvar" class="btn btn-primary btn-block">Salvar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
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
</body>

</html>

<?php
include_once("conexao.php");

$pdo = conectar();

if (isset($_POST['btnSalvar'])) {
    $nome = $_POST['nome'];
    $data = $_POST['data'];
    $cpf = $_POST['cpf'];
    $telef = $_POST['telef'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Validação simplificada - verifica se os campos não estão vazios
    if (empty($nome) || empty($data) || empty($cpf) || empty($telef) || empty($email) || empty($senha)) {
        echo '<div class="error-container"><div class="error-message">Todos os campos são obrigatórios.</div></div>';
        exit();
    }

    // Validar o CPF (você pode usar uma função de validação de CPF)
    if (!validarCPF($cpf)) {
        echo '<div class="error-container"><div class="error-message">CPF inválido.</div></div>';
        exit();
    }

    // Validar o email (você pode usar a função filter_var para isso)
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo '<div class="error-container"><div class="error-message">Email inválido.</div></div>';
        exit();
    }

    // Criar o SQL de inserção
    $sql = "INSERT INTO tb_clientes (nome_cli, dtanasc_cli, cpf_cli, telf_cli, email_cli, senha_cli) VALUES (:nome, :data, :cpf, :telef, :email, :senha)";

    // Preparar o SQL para execução (EVITA SQL INJECTION)
    $stmt = $pdo->prepare($sql);

    // Trocar pelos valores recebidos via formulário
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':data', $data);
    $stmt->bindParam(':cpf', $cpf);
    $stmt->bindParam(':telef', $telef);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':senha', $senha);

    if ($stmt->execute()) {
        echo "Cliente cadastrado com sucesso";
        header("Location: index.php");
    } else {
        echo "Erro ao cadastrar o cliente";
    }
}


// Função para validar o CPF
function validarCPF($cpf) {
    // Implemente a lógica de validação do CPF aqui
    // Retorne true se o CPF for válido, caso contrário, retorne false
    return true; // Exemplo simples
}

?>