<?php
// Configurações do banco de dados
    $host = 'localhost';
    $db = 'Luhvc';
    $user = 'postgres';
    $password = '123';
try {
    $pdo = new PDO("pgsql:host=$host;port=5432;dbname=$db;", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Recebendo os dados do formulário
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Consulta segura para verificar as credenciais
    $query = "SELECT * FROM tb_professores WHERE nome_prof = :username AND senha_prof = :password";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $password);
    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        echo "<!DOCTYPE html>
        <html>
        <head>
            <title>Login Bem-Sucedido</title>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    background-color: #f4f4f4;
                    margin: 0;
                    padding: 0;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    height: 100vh;
                }
        
                .success-container {
                    background-color: #ffffff;
                    border-radius: 5px;
                    padding: 20px;
                    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
                    text-align: center;
                }
            </style>
        </head>
        <body>
            <div class=\"success-container\">
                <h2>Login bem-sucedido!</h2>
                <p>Bem-vindo, " . $user['nome_prof'] . ".</p>
            </div>
        </body>
        </html>";
    } else {
        echo "<!DOCTYPE html>
        <html>
        <head>
            <title>Login Falhou</title>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    background-color: #f4f4f4;
                    margin: 0;
                    padding: 0;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    height: 100vh;
                }
        
                .error-container {
                    background-color: #ffffff;
                    border-radius: 5px;
                    padding: 20px;
                    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
                    text-align: center;
                }
            </style>
        </head>
        <body>
            <div class=\"error-container\">
                <h2>Credenciais inválidas.</h2>
                <p>Tente novamente.</p>
            </div>
        </body>
        </html>";
    }
} catch (PDOException $e) {
    echo "Erro: " . $e->getMessage();
}




