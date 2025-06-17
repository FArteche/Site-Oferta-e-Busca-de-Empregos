<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: login_admin.php");
    exit();
}
require '../includes/conexao.php';

$id = $_GET['id'];
// NOTA DE SEGURANÇA: Numa aplicação real, você deve decidir
// o que fazer com as vagas que pertencem a esta categoria.
// A configuração `ON DELETE CASCADE` no banco apagaria as vagas,
// o que pode não ser o ideal. Outra opção seria impedir a exclusão
// se houver vagas associadas.

$sql = "DELETE FROM categorias WHERE id = ?";
$stmt = mysqli_prepare($conexao, $sql);
mysqli_stmt_bind_param($stmt, "i", $id);

if(mysqli_stmt_execute($stmt)){
    header("Location: gerenciar_categorias.php");
} else {
    echo "Erro ao excluir categoria.";
}
exit();
?>