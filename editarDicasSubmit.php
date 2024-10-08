<?php
require 'assets/classes/dicas.class.php';

$dicas = new Dicas();

// Verificando se algum dos campos necessários não estão preenchidos
if (!empty($_POST['id_dicas']) && !empty($_POST['pacote_dicas']) && !empty($_POST['preco_dicas']) && !empty($_POST['quantidade_dicas']) && !empty($_POST['id'])) {
    // Atribuindo os valores para as variáveis
    $id_dicas = intval($_POST['id_dicas']);
    $pacote_dicas = $_POST['pacote_dicas'];
    $preco_dicas = $_POST['preco_dicas'];
    $quantidade_dicas = $_POST['quantidade_dicas'];
    $id = $_POST['id'];

    $dicas->editar($id_dicas, $pacote_dicas, $preco_dicas, $quantidade_dicas, $id); // Chama o método de editar
}
