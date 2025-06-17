<?php
$servidor = "localhost";
$usuario = "root"; 
$senha = "";     
$banco = "sistema_vagas";

$conexao = mysqli_connect($servidor, $usuario, $senha, $banco);

if (!$conexao) {
    die("Falha na conexão: " . mysqli_connect_error());
}
// Define o charset para UTF-8
mysqli_set_charset($conexao, "utf8");
?>