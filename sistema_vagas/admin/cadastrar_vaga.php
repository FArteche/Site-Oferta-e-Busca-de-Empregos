<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: login_admin.php");
    exit();
}
require '../includes/conexao.php';
$sql_categorias = "SELECT id, nome FROM categorias ORDER BY nome ASC";
$resultado_categorias = mysqli_query($conexao, $sql_categorias);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Nova Vaga</title>
    <link rel="stylesheet" href="../includes/style.css">
</head>
<body class="bg-admin">
    <header class="header">
        <h1>Nova Vaga</h1>
        <a href="painel_admin.php">Voltar ao Painel</a>
    </header>
    
    <div class="form-container">
        <h2>Detalhes da Vaga</h2>
        <form action="processa_cadastro_vaga.php" method="POST" enctype="multipart/form-data">
            <label for="titulo">Título da Vaga:</label>
            <input type="text" name="titulo" id="titulo" required>

            <label for="id_categoria">Categoria:</label>
            <select name="id_categoria" id="id_categoria" required>
                <option value="">Selecione uma categoria</option>
                <?php
                if (mysqli_num_rows($resultado_categorias) > 0) {
                    while ($categoria = mysqli_fetch_assoc($resultado_categorias)) {
                        echo "<option value='" . $categoria['id'] . "'>" . htmlspecialchars($categoria['nome']) . "</option>";
                    }
                }
                ?>
            </select>

            <label for="descricao">Descrição:</label>
            <textarea name="descricao" id="descricao" rows="5" required></textarea>

            <label for="empresa">Empresa:</label>
            <input type="text" name="empresa" id="empresa">

            <label for="localizacao">Localização (Ex: Cidade, Estado):</label>
            <input type="text" name="localizacao" id="localizacao">

            <label for="salario">Salário (opcional):</label>
            <input type="number" step="0.01" name="salario" id="salario">

            <label for="contato_email">Email para Contato:</label>
            <input type="email" name="contato_email" id="contato_email" required>
            
            <label for="imagem_empresa">Imagem da Vaga/Empresa (opcional):</label>
            <input type="file" name="imagem_empresa" id="imagem_empresa" accept="image/*">
            
            <button type="submit">Cadastrar Vaga</button>
        </form>
    </div>
</body>
</html>