<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: login_admin.php");
    exit();
}
require '../includes/conexao.php';

// Coleta os dados do formulário
$titulo = $_POST['titulo'];
$id_categoria = $_POST['id_categoria'];
$descricao = $_POST['descricao'];
$empresa = $_POST['empresa'];
$localizacao = $_POST['localizacao'];
$salario = !empty($_POST['salario']) ? $_POST['salario'] : NULL;
$contato_email = $_POST['contato_email'];

// LÓGICA PARA UPLOAD DA IMAGEM
$caminho_imagem = null;
if (isset($_FILES['imagem_empresa']) && $_FILES['imagem_empresa']['error'] == 0) {
    $diretorio_upload = '../uploads/';
    $nome_arquivo = uniqid() . '_' . basename($_FILES['imagem_empresa']['name']);
    $caminho_imagem = $diretorio_upload . $nome_arquivo;

    if (!move_uploaded_file($_FILES['imagem_empresa']['tmp_name'], $caminho_imagem)) {
        die("Erro ao fazer upload da imagem da vaga.");
    }
}

// Prepara a query SQL com o novo campo de imagem
$sql = "INSERT INTO vagas (titulo, id_categoria, descricao, empresa, localizacao, salario, contato_email, imagem_empresa) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = mysqli_prepare($conexao, $sql);

// "ssisssss" = string, string, integer, string...
mysqli_stmt_bind_param($stmt, "sisssdss", $titulo, $id_categoria, $descricao, $empresa, $localizacao, $salario, $contato_email, $caminho_imagem);

if (mysqli_stmt_execute($stmt)) {
    header("Location: gerenciar_vagas.php");
} else {
    echo "Erro ao cadastrar a vaga: " . mysqli_error($conexao);
}
mysqli_stmt_close($stmt);
mysqli_close($conexao);
?>