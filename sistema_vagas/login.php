<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Portal de Vagas</title>
    <link rel="stylesheet" href="includes/style.css"> </head>
<body class="bg-user">
    <div class="form-container">
        <h2>Login de Usuário</h2>
        <form action="processa_login_usuario.php" method="POST">
            <label for="email">E-mail:</label>
            <input type="email" name="email" id="email" required>

            <label for="senha">Senha:</label>
            <input type="password" name="senha" id="senha" required>

            <button type="submit" class="btn">Entrar</button>
        </form>
        <p style="text-align: center; margin-top: 1rem;">
            Não tem uma conta? <a href="cadastro.php">Cadastre-se</a><br>
            É administrador? <a href="admin/login_admin.php">Acesse aqui</a>
        </p>
    </div>
</body>
</html>