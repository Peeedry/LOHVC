<?php
// Função para criar a conexão PDO com o PostgreSQL
function conectarAoBanco() {
    $host = 'localhost';
    $db = 'Luhvc';
    $user = 'postgres';
    $password = '123';

    try {
        $pdo = new PDO("pgsql:host=$host;port=5432;dbname=$db;", $user, $password);
        return $pdo;
    } catch (PDOException $e) {
        die("Erro na conexão com o banco de dados: " . $e->getMessage());
    }
}

// Captura os dados do formulário
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Consulta SQL preparada para verificar o login
    $pdo = conectarAoBanco();
    $query = "SELECT * FROM tb_clientes WHERE nome_cli = :username AND senha_cli = :password";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    $stmt->bindParam(':password', $password, PDO::PARAM_STR);
    $stmt->execute();

    if ($stmt->rowCount() == 1) {
        // Login bem-sucedido
        session_start();
        $_SESSION['username'] = $username;
        header("Location: dashboard.php"); // Redirecionar para a página de dashboard após o login
    } else {
        // Login falhou
        echo "Usuário ou senha incorretos. <a href='login.php'>Tente novamente</a>";
    }
}
?>