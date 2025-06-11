<?php
include 'assets/classes/perguntas.class.php';

$pergunta = new Perguntas();

if (
    isset($_POST['id_nivel']) &&
    !empty($_POST['texto_pergunta']) &&
    isset($_POST['tipo_pergunta']) &&
    isset($_POST['ordem'])
) {
    $id_nivel = $_POST['id_nivel'];
    $texto_pergunta = $_POST['texto_pergunta'];
    $tipo_pergunta = $_POST['tipo_pergunta'];
    $ordem = $_POST['ordem'];

    if ($pergunta->adicionar($id_nivel, $texto_pergunta, $tipo_pergunta, $ordem)) {
        echo '<script type="text/javascript">alert("Pergunta cadastrada com sucesso!");</script>';
        header('Location: gerenciarPergunta.php');
        exit;
    } else {
        echo '<script type="text/javascript">alert("Pergunta já cadastrada para este nível!");</script>';
        header('Location: gerenciarPergunta.php');
        exit;
    }
}