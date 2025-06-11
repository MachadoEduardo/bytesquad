<?php
require_once '../assets/classes/perguntas.class.php';
require_once '../assets/classes/respostas.class.php';

$pergunta = new Perguntas();
$resposta = new Respostas();

$id_nivel = isset($_GET['id_nivel']) ? intval($_GET['id_nivel']) : 0;
$perguntas = $pergunta->listar($id_nivel);

foreach ($perguntas as &$p) {
    $p['respostas'] = $resposta->listar($p['id_pergunta']);
}

header('Content-Type: application/json');
echo json_encode($perguntas);