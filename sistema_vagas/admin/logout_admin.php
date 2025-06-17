<?php
// logout.php

// 1. Inicia a sessão para poder acessá-la.
session_start();

// 2. Limpa todas as variáveis da sessão.
// Isso remove todos os dados armazenados, como 'admin_id' e 'admin_nome'.
$_SESSION = array();

// 3. Destrói a sessão.
// Isso remove o cookie de sessão do navegador e invalida a sessão no servidor.
session_destroy();

// 4. Redireciona o usuário para a página de login.
// Após o logout, o usuário deve voltar para a tela de login.
header("Location: login_admin.php");

// 5. Encerra o script para garantir que nenhum código adicional seja executado.
exit();
?>