<?php
require 'assets/classes/usuarios.class.php';

$usuario = new Usuarios();

if (!empty($_POST['id']) && !empty($_POST['nome']) && !empty($_POST['email']) && !empty($_POST['senha'])) {
    $id = intval($_POST['id']);
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $usuario->editar($id, $nome, $email, $senha); // Chama o método de editar
}

