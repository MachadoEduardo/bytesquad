<?php
require 'assets/classes/respostas.class.php';

$resposta = new Respostas();

if (isset($_GET['id_resposta'])) {
    $id_resposta = intval($_GET['id_resposta']);
    if ($resposta->deletar($id_resposta)) {
        echo '<script type="text/javascript">alert("Resposta excluída com sucesso!");</script>';
    } else {
        echo '<script type="text/javascript">alert("Erro ao excluir resposta!");</script>';
    }
    header('Location: gerenciarResposta.php');
    exit;
}