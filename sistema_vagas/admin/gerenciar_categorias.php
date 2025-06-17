<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: login_admin.php");
    exit();
}
require '../includes/conexao.php';
$sql = "SELECT id, nome FROM categorias ORDER BY nome";
$resultado = mysqli_query($conexao, $sql);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Gerenciar Categorias</title>
    <link rel="stylesheet" href="../includes/style.css">
</head>
<body class="bg-admin">
    <header class="header">
        <h1>Categorias</h1>
        <a href="painel_admin.php">Voltar ao Painel</a>
    </header>
    <div class="container">
        <a href="form_categoria.php" class="btn" style="width: auto; margin-bottom: 1.5rem;">Adicionar Nova Categoria</a>
        <table>
            <thead>
                <tr>
                    <th>Nome da Categoria</th>
                    <th style="width: 150px;">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($cat = mysqli_fetch_assoc($resultado)): ?>
                <tr>
                    <td><?= htmlspecialchars($cat['nome']) ?></td>
                    <td>
                        <a href="form_categoria.php?id=<?= $cat['id'] ?>">Editar</a> |
                        <a href="excluir_categoria.php?id=<?= $cat['id'] ?>" onclick="return confirm('Tem certeza?')" style="color: #dc3545;">Excluir</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>