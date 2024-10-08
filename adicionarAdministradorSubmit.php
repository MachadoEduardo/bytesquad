<?php
include 'assets/classes/administrador.class.php';
$admin = new Administrador();

if (!empty($_POST['usuario']) && !empty($_POST['senha_admin']) && !empty($_POST['permissoes_admin'])) { 
    // Captura do formulário e atribui esse valor nas variáveis
    $usuario = $_POST['usuario'];
    $senha = $_POST['senha_admin'];
    $permissoes = $_POST['permissoes_admin'];

    // Insere no banco de dados
    if ($admin->adicionar($usuario, $senha, $permissoes)) { 
        echo '<script type="text/javascript">alert("Cadastrado com sucesso!");</script>';
        echo '<script>window.location.href = "gerenciarAdministrador.php";</script>'; // Redireciona com JavaScript
        exit;
    } else {
        echo '<script type="text/javascript">alert("Administrador já cadastrado!");</script>';
    }
} else {
    echo '<script type="text/javascript">alert("Preencha todos os campos!");</script>';
}

