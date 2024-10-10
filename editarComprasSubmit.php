<?php
require 'assets/classes/compras.class.php';

$compras = new Compras();

// Verificando se algum dos campos necessários não estão preenchidos
if (!empty($_POST['id_compra']) && !empty($_POST['formapagamento']) && !empty($_POST['preco_compra']) && !empty($_POST['historico_compra']) && !empty($_POST['id'])) {
    // Atribuindo os valores para as variáveis
    $id_compra = intval($_POST['id_compra']);
    $formapagamento = $_POST['formapagamento'];
    $preco_compra = $_POST['preco_compra'];
    $historico_compra = $_POST['historico_compra'];
    $id = $_POST['id'];

    $compras->editar($id_compra, $formapagamento, $preco_compra, $historico_compra, $id); // Chama o método de editar
}
