<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Gerador de Hash de Senha</title>
    <style>
        body { font-family: sans-serif; padding: 2rem; background-color: #f0f2f5; }
        .container { max-width: 500px; margin: auto; background: white; padding: 2rem; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); }
        input[type="text"] { width: 100%; padding: 0.5rem; margin-bottom: 1rem; }
        input[type="submit"] { background-color: #007bff; color: white; padding: 0.7rem; border: none; cursor: pointer; width: 100%;}
        .hash-result { margin-top: 1.5rem; padding: 1rem; background-color: #e9ecef; border: 1px solid #ced4da; word-wrap: break-word; }
    </style>
</head>
<body class="bg-user">
    <div class="container">
        <h2>Gerador de Hash de Senha (BCRYPT)</h2>
        <form method="POST" action="gerar_hash.php">
            <label for="senha_para_hash">Digite a senha que você quer usar:</label>
            <input type="text" name="senha_para_hash" id="senha_para_hash" required>
            <input type="submit" value="Gerar Hash">
        </form>

        <?php
        // Verifica se o formulário foi enviado
        if (isset($_POST['senha_para_hash'])) {
            // Pega a senha do formulário
            $senha = $_POST['senha_para_hash'];

            // Gera o hash usando o algoritmo padrão e seguro do PHP
            $hash = password_hash($senha, PASSWORD_DEFAULT);

            // Exibe o hash gerado
            echo "<h3>Hash Gerado:</h3>";
            echo "<div class='hash-result'>" . htmlspecialchars($hash) . "</div>";
            echo "<p>Copie este valor e cole na coluna 'senha' do seu banco de dados.</p>";
        }
        ?>
    </div>
</body>
</html>