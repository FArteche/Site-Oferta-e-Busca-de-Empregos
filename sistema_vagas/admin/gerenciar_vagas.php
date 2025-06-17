<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: login_admin.php");
    exit();
}

require '../includes/conexao.php';

$sql = "SELECT v.id, v.titulo, v.status, c.nome AS categoria_nome 
        FROM vagas v 
        JOIN categorias c ON v.id_categoria = c.id 
        ORDER BY v.data_criacao DESC";

$resultado = mysqli_query($conexao, $sql);
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Gerenciar Vagas</title>
    <link rel="stylesheet" href="../includes/style.css">
</head>
<header class="header">
    <h1>Categorias</h1>
    <a href="painel_admin.php">Voltar ao Painel</a>
</header>

<body class="bg-admin">
    <div class="form-container">
        <h2>Gerenciar Vagas</h2>
        <p>Olá, <?php echo $_SESSION['admin_nome']; ?>! | <a href="cadastrar_vaga.php">Cadastrar Nova Vaga</a> | <a href="logout_admin.php">Sair</a></p>
        <hr>

        <table>
            <thead>
                <tr>
                    <th>Título da Vaga</th>
                    <th>Categoria</th>
                    <th>Candidatos</th>
                    <th>Status</th>
                    <th>Ação</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // A query já busca tudo que precisamos
                $sql = "SELECT v.id, v.titulo, v.status, v.num_candidatos, c.nome AS categoria_nome 
                    FROM vagas v 
                    JOIN categorias c ON v.id_categoria = c.id 
                    ORDER BY v.data_criacao DESC";
                $resultado = mysqli_query($conexao, $sql);
                ?>
                <?php if (mysqli_num_rows($resultado) > 0): ?>
                    <?php while ($vaga = mysqli_fetch_assoc($resultado)): ?>
                        <tr>
                            <td><?= htmlspecialchars($vaga['titulo']); ?></td>
                            <td><?= htmlspecialchars($vaga['categoria_nome']); ?></td>
                            <td>
                                <a href="visualizar_candidatos.php?id_vaga=<?= $vaga['id'] ?>">
                                    (<?= $vaga['num_candidatos'] ?>) Ver Candidatos
                                </a>
                            </td>
                            <td>
                                <?php if ($vaga['status'] == 1): ?>
                                    <span class="status-ativa">Ativa</span>
                                <?php else: ?>
                                    <span class="status-desativada">Desativada</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if ($vaga['status'] == 1): ?>
                                    <a href="mudar_status_vaga.php?id=<?= $vaga['id']; ?>" class="btn-toggle btn-desativar">Desativar</a>
                                <?php else: ?>
                                    <a href="mudar_status_vaga.php?id=<?= $vaga['id']; ?>" class="btn-toggle btn-ativar">Ativar</a>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5">Nenhuma vaga cadastrada ainda.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
</body>

</html>