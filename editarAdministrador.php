<?php
require 'assets/classes/administrador.class.php';

$admin = new Administrador();

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $dados = $admin->buscarAdministrador($id); // Certifique-se de que essa função retorne os dados corretamente
} else {
    echo "ID do administrador não fornecido.";
    exit;
}
?>
