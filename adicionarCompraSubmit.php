<?php
include 'assets/classes/compras.class.php';

$compras = new Compras();

if (!empty($_POST['id'])) {
    // Captura do formulário e atribui esse valor nas variáveis
    $formapagamento = $_POST['formapagamento'];
    $preco_compra = $_POST['preco_compra'];
    $historico_compra = $_POST['historico_compra'];
    $id = $_POST['id'];

    if ($compras->adicionar( $formapagamento, $preco_compra, $historico_compra, $id)) {  // Insere no banco de dados
        echo '<script type="text/javascript">alert("Cadastrado com sucesso!");</script>';
        header('Location: gerenciarCompra.php'); // Redireciona com JavaScript
        exit;
    } else {
        echo '<script type="text/javascript">alert("Pacote de compras já cadastrado!");</script>';
    }
}

