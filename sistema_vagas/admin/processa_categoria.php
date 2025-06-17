<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: login_admin.php");
    exit();
}
require '../includes/conexao.php';

$nome = $_POST['nome'];
$id = $_POST['id'];

if (empty($id)) { // Se não tem ID, é uma inserção
    $sql = "INSERT INTO categorias (nome) VALUES (?)";
    $stmt = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($stmt, "s", $nome);
} else { // Se tem ID, é uma atualização
    $sql = "UPDATE categorias SET nome = ? WHERE id = ?";
    $stmt = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($stmt, "si", $nome, $id);
}

if (mysqli_stmt_execute($stmt)) {
    header("Location: gerenciar_categorias.php");
} else {
    echo "Erro ao salvar categoria.";
}
exit();
?>