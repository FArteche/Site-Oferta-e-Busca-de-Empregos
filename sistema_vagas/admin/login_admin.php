<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login do Administrador</title>
    <link rel="stylesheet" href="../includes/style.css"> </head>
<body class="bg-admin">
    <div class="form-container">
        <h2>Login do Administrador</h2>
        <form action="processa_login_admin.php" method="POST">
            <label for="email">Seu e-mail:</label>
            <input type="email" name="email" id="email" required>

            <label for="senha">Sua senha:</label>
            <input type="password" name="senha" id="senha" required>

            <button type="submit" class="btn">Entrar</button>
        </form>
        <p style="text-align: center; margin-top: 1rem;">
            <a href="../login.php">Voltar ao login de usuário</a>
        </p>
    </div>
</body>
</html>