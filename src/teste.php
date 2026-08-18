<?php
//session_start();
include_once("conexao.php");

$pdo = conectar();
?>

<!DOCTYPE html>
<html>
<head>
</style>
</head>
<body>

<form action="autentica.php" method="post">
    <label for="login">Login:</label>
    <input id="login" name="login" type="text" />
    <label for="senha">Senha</label>
    <input id="senha" name="senha" type="password" />
    <input type="submit" value="Enviar" />
</form>

</body>
</html>

<?php
$usuario = $_POST["usuario"];
$senha = $_POST["senha"];

$query = "SELECT * FROM tb_clientes WHERE nome_cli='$usuario' and senha_cli='$senha'";

$resultado = $pdo->query($query);

?>

