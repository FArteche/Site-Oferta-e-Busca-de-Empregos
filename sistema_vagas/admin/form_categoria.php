<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: login_admin.php");
    exit();
}
require '../includes/conexao.php';

$categoria = ['id' => '', 'nome' => ''];
$titulo_pagina = "Adicionar Nova Categoria";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM categorias WHERE id = ?";
    $stmt = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);
    $categoria = mysqli_fetch_assoc($resultado);
    $titulo_pagina = "Editar Categoria";
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title><?= $titulo_pagina ?></title>
    <link rel="stylesheet" href="../includes/style.css">
</head>
<body class="bg-admin">
    <header class="header">
        <h1><?= $titulo_pagina ?></h1>
        <a href="gerenciar_categorias.php">Voltar</a>
    </header>
    <div class="form-container">
        <form action="processa_categoria.php" method="POST">
            <input type="hidden" name="id" value="<?= $categoria['id'] ?>">
            <label for="nome">Nome da Categoria:</label>
            <input type="text" id="nome" name="nome" value="<?= htmlspecialchars($categoria['nome']) ?>" required>
            <button type="submit">Salvar</button>
        </form>
    </div>
</body>
</html>