<?php
require_once '../assets/classes/perguntas.class.php';
require_once '../assets/classes/respostas.class.php';

$data = json_decode(file_get_contents('php://input'), true);

$id_nivel = $data['id_nivel'];
$pergunta = $data['pergunta'];
$alternativas = $data['alternativas'];
$correta = $data['correta']; // 'A', 'B', 'C' ou 'D'

$perguntas = new Perguntas();
$respostas = new Respostas();

$id_pergunta = $perguntas->adicionarRetornandoId($id_nivel, $pergunta, 'multipla_escolha', 1); // ajuste ordem se quiser

if ($id_pergunta) {
    $letras = ['A', 'B', 'C', 'D'];
    foreach ($alternativas as $i => $alt) {
        $corretaFlag = ($letras[$i] == $correta) ? 1 : 0;
        $respostas->adicionar($id_pergunta, $alt, $corretaFlag, $i+1);
    }
    echo json_encode(['sucesso' => true]);
} else {
    echo json_encode(['sucesso' => false]);
}