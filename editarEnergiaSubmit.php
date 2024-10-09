<?php
require 'assets/classes/energia.class.php';

$energia = new Energia();

// Verificando se algum dos campos necessários não estão preenchidos
if (!empty($_POST['id_energia']) && !empty($_POST['id']) && !empty($_POST['quantidade_energia']) && !empty($_POST['tempo_energia']) && !empty($_POST['preco_energia']) && !empty($_POST['pacote_energia'])) {
    // Atribuindo os valores para as variáveis
    $id_energia = intval($_POST['id_energia']);
    $id = $_POST['id'];
    $quantidade_energia = $_POST['quantidade_energia'];
    $tempo_energia = $_POST['tempo_energia'];
    $preco_energia = $_POST['preco_energia'];
    $pacote_energia = $_POST['pacote_energia'];

    $energia->editar($id_energia, $id, $quantidade_energia, $tempo_energia, $preco_energia, $pacote_energia); // Chama o método de editar
}
