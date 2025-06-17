<?php
session_start();
require '../includes/conexao.php'; // Caminho Corrigido

$email = $_POST['email'];
$senha = $_POST['senha'];

$sql = "SELECT id, nome, senha FROM administradores WHERE email = ?";
$stmt = mysqli_prepare($conexao, $sql);
mysqli_stmt_bind_param($stmt, "s", $email);
mysqli_stmt_execute($stmt);
$resultado = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($resultado) == 1) {
    $admin = mysqli_fetch_assoc($resultado);
    if (password_verify($senha, $admin['senha'])) {
        $_SESSION['admin_id'] = $admin['id'];
        $_SESSION['admin_nome'] = $admin['nome'];
        header("Location: painel_admin.php"); // Caminho Corrigido
        exit();
    }
}
echo "Email ou senha inválidos.";
header("Refresh: 3; URL=login_admin.php"); // Caminho Corrigido
exit();
?>