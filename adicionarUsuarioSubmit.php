<?php
include 'assets/classes/usuarios.class.php';
$usuario = new Usuarios();

if (!empty($_POST['userEmail'])) { // Captura do formulário
    $nome = $_POST['userName'];
    $email = $_POST['userEmail'];
    $senha = $_POST['userPassword'];

    if ($usuario->adicionar($email, $nome, $senha)) { // Insere no banco de dados
        echo '<script type="text/javascript">alert("Cadastrado com sucesso!");</script>';
        header('Location: gerenciarUsuario.php');
        exit;
    } else {
        echo '<script type="text/javascript">alert("Email já cadastrado!");</script>';
    }
}
?>
