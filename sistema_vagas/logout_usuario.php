<?php
// logout_usuario.php
session_start();

// Limpa e destrói a sessão, desconectando o usuário
session_unset();
session_destroy();

// Redireciona para a página de login de usuário
header("Location: login.php");
exit();
?>