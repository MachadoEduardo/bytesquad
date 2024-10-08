<?php
require 'assets/classes/usuarios.class.php';

$usuario = new Usuarios();

// Verificando se algum dos campos necessários não estão preenchidos
if (!empty($_POST['id']) && !empty($_POST['nome']) && !empty($_POST['email']) && !empty($_POST['senha'])) {
    // Atribuindo os valores para as variáveis
    $id = intval($_POST['id']);
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $usuario->editar($id, $nome, $email, $senha); // Chama o método de editar
}

