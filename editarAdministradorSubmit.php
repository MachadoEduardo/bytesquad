<?php
require 'assets/classes/administrador.class.php';

$admin = new Administrador();

if (!empty($_POST['id_administrativo']) && !empty($_POST['usuario']) && !empty($_POST['senha_admin']) && !empty($_POST['permissoes_admin'])) {
    $id = intval($_POST['id_administrativo']);
    $usuario = $_POST['usuario'];
    $senha_admin = $_POST['senha_admin'];
    $permissoes_admin = $_POST['permissoes_admin'];

    $admin->editar($id, $usuario, $senha_admin, $permissoes_admin); // Chama o método de editar
}
?>