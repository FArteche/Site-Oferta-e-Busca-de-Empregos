<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: login_admin.php");
    exit();
}
require '../includes/conexao.php';

$id_vaga = $_GET['id_vaga'] ?? 0;

$sql = "SELECT u.nome, u.email, u.linkedin, u.foto, v.titulo 
        FROM usuarios u
        JOIN candidaturas c ON u.id = c.id_usuario
        JOIN vagas v ON v.id = c.id_vaga
        WHERE c.id_vaga = ?";
$stmt = mysqli_prepare($conexao, $sql);
mysqli_stmt_bind_param($stmt, "i", $id_vaga);
mysqli_stmt_execute($stmt);
$resultado = mysqli_stmt_get_result($stmt);

$titulo_vaga = "Vaga não encontrada";
if(mysqli_num_rows($resultado) > 0) {
    mysqli_data_seek($resultado, 0); 
    $primeiro_candidato = mysqli_fetch_assoc($resultado);
    $titulo_vaga = $primeiro_candidato['titulo'];
    mysqli_data_seek($resultado, 0);
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Candidatos para: <?= htmlspecialchars($titulo_vaga) ?></title>
    <link rel="stylesheet" href="../includes/style.css">
</head>
<body class="bg-admin">
    <header class="header">
        <h1>Candidatos</h1>
        <a href="gerenciar_vagas.php">Voltar</a>
    </header>
    <div class="container">
        <h2>Vaga: "<?= htmlspecialchars($titulo_vaga) ?>"</h2>
        <hr style="margin: 2rem 0;">
        <?php if (mysqli_num_rows($resultado) > 0): ?>
            <?php while ($candidato = mysqli_fetch_assoc($resultado)): ?>
                <div class="candidato-card">
                    <img src="../<?= htmlspecialchars($candidato['foto'] ?? 'uploads/placeholder.jpg') ?>" alt="Foto de <?= htmlspecialchars($candidato['nome']) ?>">
                    <div>
                        <h3 style="margin: 0;"><?= htmlspecialchars($candidato['nome']) ?></h3>
                        <p style="margin: 0.2rem 0;">Email: <?= htmlspecialchars($candidato['email']) ?></p>
                        <?php if(!empty($candidato['linkedin'])): ?>
                            <p style="margin: 0.2rem 0;">LinkedIn: <a href="<?= htmlspecialchars($candidato['linkedin']) ?>" target="_blank">Ver Perfil</a></p>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>Ainda não há candidatos para esta vaga.</p>
        <?php endif; ?>
    </div>
</body>
</html>