<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: login_admin.php");
    exit();
}

require '../includes/conexao.php';

if (isset($_GET['id'])) {
    $id_vaga = $_GET['id'];

    $sql_status_atual = "SELECT status FROM vagas WHERE id = ?";
    $stmt = mysqli_prepare($conexao, $sql_status_atual);
    mysqli_stmt_bind_param($stmt, "i", $id_vaga);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);
    $vaga = mysqli_fetch_assoc($resultado);

    $novo_status = $vaga['status'] == 1 ? 0 : 1;

    // 3. Atualiza o banco de dados com o novo status
    $sql_update = "UPDATE vagas SET status = ? WHERE id = ?";
    $stmt_update = mysqli_prepare($conexao, $sql_update);
    mysqli_stmt_bind_param($stmt_update, "ii", $novo_status, $id_vaga);
    mysqli_stmt_execute($stmt_update);
}

// 4. Redireciona de volta para a página de gerenciamento
header("Location: gerenciar_vagas.php");
exit();
?>