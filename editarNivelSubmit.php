<?php
require 'assets/classes/niveis.class.php';

$nivel = new Niveis();

// Verificando se algum dos campos necessários não estão preenchidos
if (!empty($_POST['id_nivel']) && !empty($_POST['nome_nivel']) && !empty($_POST['tempo_nivel']) && !empty($_POST['dificuldade']) && !empty($_POST['questoes']) && !empty($_POST['respostas'])
&& !empty($_POST['id_administrativo'])) {
    // Atribuindo os valores para as variáveis
    $id_nivel = intval($_POST['id_nivel']);
    $nome_nivel = $_POST['nome_nivel'];
    $tempo_nivel = $_POST['tempo_nivel'];
    $dificuldade = $_POST['dificuldade'];
    $questoes = $_POST['questoes'];
    $respostas = $_POST['respostas'];
    $id_administrativo = $_POST['id_administrativo'];

    $nivel->editar($id_nivel, $nome_nivel, $tempo_nivel, $dificuldade, $questoes, $respostas, $id_administrativo); // Chama o método de editar
}

