<?php
include 'assets/classes/niveis.class.php';

$nivel = new Niveis();

if (!empty($_POST['nome_nivel']) && !empty($_POST['id_administrativo'])) {
    // Captura do formulário e atribui esse valor nas variáveis
    $nome_nivel = $_POST['nome_nivel'];
    $tempo_nivel = $_POST['tempo_nivel'];
    $dificuldade = $_POST['dificuldade'];
    $questoes = $_POST['questoes'];
    $respostas = $_POST['respostas'];
    $id_administrativo = $_POST['id_administrativo'];

    if ($nivel->adicionar($nome_nivel, $tempo_nivel, $dificuldade, $questoes, $respostas, $id_administrativo)) {  // Insere no banco de dados
        echo '<script type="text/javascript">alert("Cadastrado com sucesso!");</script>';
        header('Location: gerenciarNivel.php'); // Redireciona com JavaScript
        exit;
    } else {
        echo '<script type="text/javascript">alert("Nível já cadastrado!");</script>';
    }
}

