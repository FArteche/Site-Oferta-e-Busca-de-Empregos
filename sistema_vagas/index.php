<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}
require 'includes/conexao.php';
$id_usuario_logado = $_SESSION['usuario_id'];
// ... (resto do código PHP do início do index.php) ...
$sql = "SELECT v.*, c.nome AS categoria_nome 
        FROM vagas v 
        JOIN categorias c ON v.id_categoria = c.id
        WHERE v.status = 1";
if (isset($_GET['categoria']) && !empty($_GET['categoria'])) {
    $sql .= " AND v.id_categoria = " . intval($_GET['categoria']);
}
$sql .= " ORDER BY v.data_criacao DESC";
$resultado_vagas = mysqli_query($conexao, $sql);
$resultado_categorias = mysqli_query($conexao, "SELECT * FROM categorias ORDER BY nome");
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vagas Disponíveis</title>
    <link rel="stylesheet" href="includes/style.css">
</head>
<body class="bg-user">
    <header class="header">
        <h1>Portal de Vagas</h1>
        <div>
            <span>Olá, <?= htmlspecialchars($_SESSION['usuario_nome']) ?>!</span>
            <a href="logout_usuario.php" class="logout">Sair</a>
        </div>
    </header>

    <div class="container">
        <h2>Encontre sua próxima oportunidade</h2>
        <form action="index.php" method="GET" style="margin-bottom: 2rem;">
            <label for="categoria">Filtrar por Categoria:</label>
            <select name="categoria" onchange="this.form.submit()">
                <option value="">Todas as Categorias</option>
                <?php while($cat = mysqli_fetch_assoc($resultado_categorias)): ?>
                    <option value="<?= $cat['id'] ?>" <?= (isset($_GET['categoria']) && $_GET['categoria'] == $cat['id']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($cat['nome']) ?>
                    </option>
                <?php endwhile; mysqli_data_seek($resultado_categorias, 0); ?>
            </select>
        </form>

        <div class="job-listing">
            <?php if(mysqli_num_rows($resultado_vagas) > 0): ?>
                <?php while($vaga = mysqli_fetch_assoc($resultado_vagas)): ?>
                    <div class="job-card">
                        <?php if (!empty($vaga['imagem_empresa'])): ?>
                            <img src="<?= htmlspecialchars($vaga['imagem_empresa']) ?>" alt="Imagem da Vaga">
                        <?php endif; ?>
                        <h3><?= htmlspecialchars($vaga['titulo']) ?></h3>
                        <div class="job-meta">
                            <span>🏢 <?= htmlspecialchars($vaga['empresa']) ?></span>
                            <span>📍 <?= htmlspecialchars($vaga['localizacao']) ?></span>
                            <span>📁 <?= htmlspecialchars($vaga['categoria_nome']) ?></span>
                        </div>
                        <p><?= nl2br(htmlspecialchars(substr($vaga['descricao'], 0, 150))) ?>...</p>

                        <?php
                        $sql_check_candidatura = "SELECT id FROM candidaturas WHERE id_vaga = ? AND id_usuario = ?";
                        $stmt_check = mysqli_prepare($conexao, $sql_check_candidatura);
                        mysqli_stmt_bind_param($stmt_check, "ii", $vaga['id'], $id_usuario_logado);
                        mysqli_stmt_execute($stmt_check);
                        $resultado_check = mysqli_stmt_get_result($stmt_check);
                        if(mysqli_num_rows($resultado_check) > 0):
                        ?>
                            <button class="btn" disabled>Candidatura Enviada</button>
                        <?php else: ?>
                            <a href="candidatar.php?vaga=<?= $vaga['id'] ?>" class="btn">Candidatar-se</a>
                        <?php endif; ?>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p>Nenhuma vaga encontrada com os filtros selecionados.</p>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>