<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: login_admin.php");
    exit();
}
$nome_admin = $_SESSION['admin_nome'];
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel do Administrador</title>
    <link rel="stylesheet" href="../includes/style.css"> </head>
<body class="bg-admin">
    <header class="header">
        <h1>Painel Administrativo</h1>
        <a href="logout_admin.php" class="logout">Sair</a>
    </header>

    <div class="container">
        <h2 style="margin-bottom: 2rem;">Bem-vindo(a), <strong><?= htmlspecialchars($nome_admin); ?></strong>!</h2>

        <div class="job-listing"> <div class="job-card">
                <h3>Gerenciar Vagas</h3>
                <p>Crie novas vagas, edite, ative ou desative as ofertas existentes.</p>
                <a href="gerenciar_vagas.php" class="btn">Acessar</a>
            </div>
            <div class="job-card">
                <h3>Gerenciar Categorias</h3>
                <p>Adicione, edite ou remova as categorias para organizar as vagas.</p>
                <a href="gerenciar_categorias.php" class="btn">Acessar</a>
            </div>
        </div>
    </div>
</body>
</html>