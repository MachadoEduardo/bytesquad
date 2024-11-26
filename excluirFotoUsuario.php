<?php
require_once 'assets/classes/usuarios.class.php';
$usuario = new Usuarios();

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    if ($usuario->excluirFoto($id)) {
        header('Location: gerenciarUsuario.php');
    } else {
        echo "Erro ao excluir a foto.";
    }
} else {
    header('Location: gerenciarUsuario.php');
}
?>
