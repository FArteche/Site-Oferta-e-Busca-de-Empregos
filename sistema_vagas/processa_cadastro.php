<?php
require 'includes/conexao.php';

$nome = $_POST['nome'];
$email = $_POST['email'];
$senha = $_POST['senha'];
$linkedin = $_POST['linkedin'];

$senha_hash = password_hash($senha, PASSWORD_DEFAULT);

$caminho_foto = null;
if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
    // A pasta uploads está na raiz, então o caminho está correto
    $diretorio_upload = 'uploads/';
    $nome_arquivo = uniqid() . '_' . basename($_FILES['foto']['name']);
    $caminho_foto = $diretorio_upload . $nome_arquivo;

    if (!move_uploaded_file($_FILES['foto']['tmp_name'], $caminho_foto)) {
        die("Erro ao fazer upload da foto.");
    }
}

$sql = "INSERT INTO usuarios (nome, email, senha, linkedin, foto) VALUES (?, ?, ?, ?, ?)";
$stmt = mysqli_prepare($conexao, $sql);
mysqli_stmt_bind_param($stmt, "sssss", $nome, $email, $senha_hash, $linkedin, $caminho_foto);

if (mysqli_stmt_execute($stmt)) {
    header("Location: login.php");
    exit();
} else {
    die("Erro ao cadastrar: " . mysqli_error($conexao));
}
?>