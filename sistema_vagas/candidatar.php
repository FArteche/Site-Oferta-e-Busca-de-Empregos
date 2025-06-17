<?php
session_start();
if (!isset($_SESSION['usuario_id']) || !isset($_GET['vaga'])) {
    header("Location: index.php");
    exit();
}
require 'includes/conexao.php'; 

$id_vaga = $_GET['vaga'];
$id_usuario = $_SESSION['usuario_id'];

$sql_candidatura = "INSERT INTO candidaturas (id_vaga, id_usuario) VALUES (?, ?)";
$stmt = mysqli_prepare($conexao, $sql_candidatura);
mysqli_stmt_bind_param($stmt, "ii", $id_vaga, $id_usuario);

if (mysqli_stmt_execute($stmt)) {
    $sql_update_contador = "UPDATE vagas SET num_candidatos = num_candidatos + 1 WHERE id = ?";
    $stmt_update = mysqli_prepare($conexao, $sql_update_contador);
    mysqli_stmt_bind_param($stmt_update, "i", $id_vaga);
    mysqli_stmt_execute($stmt_update);
}

header("Location: index.php");
exit();
?>