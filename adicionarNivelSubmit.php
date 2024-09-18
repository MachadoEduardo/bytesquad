<?php
include 'assets/classes/niveis.class.php';
$nivel = new Niveis();

if (!empty($_POST['levelName'])) {
    $nome_nivel = $_POST['levelName'];
    $tempo_nivel = $_POST['levelTime'];
    $dificuldade = $_POST['levelDifficult'];
    $questoes = $_POST['levelQuestion'];
    $respostas = $_POST['levelAnswer'];

    if ($nivel->adicionar($nome_nivel, $tempo_nivel, $dificuldade, $questoes, $respostas)) {
        echo '<script type="text/javascript">alert("Cadastrado com sucesso!");</script>';
        header('Location: gerenciarNivel.php');
        exit;
    } else {
        echo '<script type="text/javascript">alert("Nível já cadastrado!");</script>';
    }
}
?>