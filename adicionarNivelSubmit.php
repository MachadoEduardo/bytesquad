<?php
include 'assets/classes/niveis.class.php';
session_start(); // Inicia a sessão para capturar o id_administrador
$nivel = new Niveis();

if (!empty($_POST['nome_nivel'])) {
    $nome_nivel = $_POST['nome_nivel'];
    $tempo_nivel = $_POST['tempo_nivel'];
    $dificuldade = $_POST['dificuldade'];
    $questoes = $_POST['questoes'];
    $respostas = $_POST['respostas'];

    if ($nivel->adicionar($nome_nivel, $tempo_nivel, $dificuldade, $questoes, $respostas)) {
        echo '<script type="text/javascript">alert("Cadastrado com sucesso!");</script>';
        header('Location: gerenciarNivel.php');
        exit;
    } else {
        echo '<script type="text/javascript">alert("Nível já cadastrado!");</script>';
    }
}
?>
