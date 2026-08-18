<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    <form method="post" action="process_login.php">
        <label for="username">Usuário:</label>
        <input type="text" name="username" required><br><br>
        
        <label for="password">Senha:</label>
        <input type="password" name="password" required><br><br>
        
        <input type="submit" value="Login">
    </form>
</body>
</html>