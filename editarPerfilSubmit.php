<?php
require 'assets/classes/usuarios.class.php';

$usuario = new Usuarios();

if (
    !empty($_POST['id']) &&
    !empty($_POST['nome_usuario']) &&
    !empty($_POST['email_usuario']) &&
    !empty($_POST['senha_atual'])
) {
    $id = intval($_POST['id']);
    $nome = $_POST['nome_usuario'];
    $email = $_POST['email_usuario'];
    $senhaAtual = $_POST['senha_atual'];
    $url_foto = $_POST['url_foto'];
    $telefone = $_POST['telefone'];
    $novaSenha = $_POST['nova_senha'] ?? '';

    $dadosUsuario = $usuario->buscarUsuario($id);

    if ($dadosUsuario) {
        // Verifica a senha atual
        if (password_verify($senhaAtual, $dadosUsuario['senha_usuario'])) {
            // Se o usuário quiser trocar a senha
            if (!empty($novaSenha)) {
                $senhaCriptografada = password_hash($novaSenha, PASSWORD_DEFAULT);
            } else {
                $senhaCriptografada = $dadosUsuario['senha_usuario']; // mantém a senha atual
            }

            $usuario->editarPerfil($id, $nome, $email, $senhaCriptografada, $url_foto, $telefone);
            header("Location: perfil.php");
            exit;
        } else {
            echo "<script>alert('Senha atual incorreta!'); history.back();</script>";
            exit;
        }
    } else {
        echo "Usuário não encontrado.";
        exit;
    }
} else {
    echo "Campos obrigatórios ausentes!";
}

