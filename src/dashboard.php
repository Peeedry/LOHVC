<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }
        header {
            background-color: #333;
            color: #fff;
            padding: 20px;
            text-align: center;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
            border-radius: 5px;
            margin-top: 20px;
        }
        h2 {
            color: #333;
        }
        p {
            color: #555;
        }
        a {
            color: #007bff;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <header>
        <h1>Página do Cliente</h1>
    </header>
    <div class="container">
        <h2>Bem-vindo, <?php echo $_SESSION['username']; ?></h2>
        <p>Esta é a sua página de cliente.</p>
        <p>Adicione aqui informações relevantes para o cliente.</p>
        <a href="logout.php">Sair</a>
    </div>
</body>
</html>