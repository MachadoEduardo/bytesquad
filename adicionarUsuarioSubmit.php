<?php
include 'assets/classes/usuarios.class.php';
$usuario = new Usuarios();

if (!empty($_POST['userEmail'])) {
    // Captura do formulário e atribui esse valor nas variáveis
    $nome = $_POST['userName'];
    $email = $_POST['userEmail'];
    $senha = $_POST['userPassword'];
    $permissoes_usuario = $_POST['permissoes_usuario'];
    $ativo_usuario = $_POST['ativo_usuario'];
    $url_foto = $_POST['url_foto'];
    $telefone = $_POST['telefone'];
    $id_redesocial = $_POST['id_redesocial'];

    if ($usuario->adicionar($email, $nome, $senha, $permissoes_usuario, $ativo_usuario, $url_foto, $telefone, $id_redesocial)) { // Insere no banco de dados
        echo '<script type="text/javascript">alert("Cadastrado com sucesso!");</script>';
        header('Location: gerenciarUsuario.php'); // Redireciona com JavaScript
        exit;
    } else {
        echo '<script type="text/javascript">alert("Email já cadastrado!");</script>';
    }
}
?>
