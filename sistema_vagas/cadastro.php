<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro - Portal de Vagas</title>
    <link rel="stylesheet" href="includes/style.css"> </head>
<body class="bg-user">
    <div class="form-container">
        <h2>Crie sua Conta</h2>
        <form action="processa_cadastro.php" method="POST" enctype="multipart/form-data">
            <label for="nome">Nome Completo:</label>
            <input type="text" id="nome" name="nome" required>

            <label for="email">E-mail:</label>
            <input type="email" id="email" name="email" required>

            <label for="senha">Senha:</label>
            <input type="password" id="senha" name="senha" required>

            <label for="linkedin">Link do seu LinkedIn (opcional):</label>
            <input type="url" id="linkedin" name="linkedin">

            <label for="foto">Sua Foto (opcional):</label>
            <input type="file" id="foto" name="foto" accept="image/*">

            <button type="submit" class="btn">Cadastrar</button>
        </form>
        <p style="text-align: center; margin-top: 1rem;">
            Já tem uma conta? <a href="login.php">Faça login</a>
        </p>
    </div>
</body>
</html>