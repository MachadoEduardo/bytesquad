<?php
session_start();
unset($_SESSION['Logado']); // Remove a variável de sessão
session_destroy(); // Destrói toda a sessão
header("Location: telaLogin.php"); // Redireciona para a tela de login
exit;
?>
