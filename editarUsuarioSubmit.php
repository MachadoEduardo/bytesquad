<?php
require 'assets/classes/usuarios.class.php';

$usuario = new Usuarios();

// Verificando se algum dos campos necessários não estão preenchidos
if (!empty($_POST['id']) && !empty($_POST['nome']) && !empty($_POST['email']) && !empty($_POST['senha']) && !empty($_POST['permissoes_usuario']) 
&& !empty($_POST['url_foto']) && !empty($_POST['telefone']) && !empty($_POST['id_redesocial'])) {
    // Atribuindo os valores para as variáveis
    $id = intval($_POST['id']);
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $permissoes_usuario = $_POST['permissoes_usuario'];
    $ativo_usuario = $_POST['ativo_usuario'];
    $url_foto = $_POST['url_foto'];
    $telefone = $_POST['telefone'];
    $id_redesocial = $_POST['id_redesocial'];

    $usuario->editar($id, $nome, $email, $senha, $permissoes_usuario, $ativo_usuario, $url_foto, $telefone, $id_redesocial); // Chama o método de editar
}