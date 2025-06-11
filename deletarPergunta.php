<?php
require 'assets/classes/perguntas.class.php';

$pergunta = new Perguntas();

if (isset($_GET['id_pergunta'])) {
    $id_pergunta = intval($_GET['id_pergunta']);
    if ($pergunta->deletar($id_pergunta)) {
        echo '<script type="text/javascript">alert("Pergunta excluída com sucesso!");</script>';
    } else {
        echo '<script type="text/javascript">alert("Erro ao excluir pergunta!");</script>';
    }
    header('Location: gerenciarPergunta.php');
    exit;
}