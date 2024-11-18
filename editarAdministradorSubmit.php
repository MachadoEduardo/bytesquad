<?php
require 'assets/classes/administrador.class.php';

$admin = new Administrador();

// Verificando se algum dos campos necessários não estão preenchidos
if (!empty($_POST['id_administrativo']) && !empty($_POST['usuario']) && !empty($_POST['senha_admin']) && !empty($_POST['permissoes_admin'])) {
    // Atribuindo os valores para as variáveis
    $id = intval($_POST['id_administrativo']);
    $usuario = $_POST['usuario'];
    $senha_admin = md5($_POST['senha_admin']);
    $permissoes_admin = $_POST['permissoes_admin'];

    $admin->editar($id, $usuario, $senha_admin, $permissoes_admin); // Chama o método de editar
}
?>
