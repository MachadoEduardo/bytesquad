<?php
include 'assets/classes/energia.class.php';

$energia = new Energia();

if (!empty($_POST['pacote_energia']) && !empty($_POST['id'])) {
    // Captura do formulário e atribui esse valor nas variáveis
    $id = $_POST['id'];
    $quantidade_energia = $_POST['quantidade_energia'];
    $tempo_energia = $_POST['tempo_energia'];
    $preco_energia = $_POST['preco_energia'];
    $pacote_energia = $_POST['pacote_energia'];

    if ($energia->adicionar($id, $quantidade_energia, $tempo_energia, $preco_energia, $pacote_energia)) {  // Insere no banco de dados
        echo '<script type="text/javascript">alert("Cadastrado com sucesso!");</script>';
        header('Location: gerenciarEnergia.php'); // Redireciona com JavaScript
        exit;
    } else {
        echo '<script type="text/javascript">alert("Pacote de energia já cadastrado!");</script>';
    }
}

