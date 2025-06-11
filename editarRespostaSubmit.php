<?php
require 'assets/classes/respostas.class.php';

$resposta = new Respostas();

if (
    isset($_POST['id_resposta']) &&
    isset($_POST['id_pergunta']) &&
    !empty($_POST['texto_resposta']) &&
    isset($_POST['correta']) &&
    isset($_POST['ordem'])
) {
    $id_resposta = intval($_POST['id_resposta']);
    $id_pergunta = $_POST['id_pergunta'];
    $texto_resposta = $_POST['texto_resposta'];
    $correta = $_POST['correta'];
    $ordem = $_POST['ordem'];

    if ($resposta->editar($id_resposta, $id_pergunta, $texto_resposta, $correta, $ordem)) {
        echo '<script type="text/javascript">alert("Resposta editada com sucesso!");</script>';
        header('Location: gerenciarResposta.php');
        exit;
    } else {
        echo '<script type="text/javascript">alert("Erro ao editar resposta!");</script>';
        header('Location: gerenciarResposta.php');
        exit;
    }
}