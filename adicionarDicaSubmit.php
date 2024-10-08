<?php
include 'assets/classes/dicas.class.php';

$dicas = new Dicas();

if (!empty($_POST['pacote_dicas']) && !empty($_POST['id'])) {
    // Captura do formulário e atribui esse valor nas variáveis
    $pacote_dicas = $_POST['pacote_dicas'];
    $preco_dicas = $_POST['preco_dicas'];
    $quantidade_dicas = $_POST['quantidade_dicas'];
    $id = $_POST['id'];

    if ($dicas->adicionar($pacote_dicas, $preco_dicas, $quantidade_dicas, $id)) {  // Insere no banco de dados
        echo '<script type="text/javascript">alert("Cadastrado com sucesso!");</script>';
        header('Location: gerenciarDicas.php'); // Redireciona com JavaScript
        exit;
    } else {
        echo '<script type="text/javascript">alert("Pacote de dicas já cadastrado!");</script>';
    }
}

