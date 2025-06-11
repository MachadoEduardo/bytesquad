<?php
require 'assets/classes/niveis.class.php';

$nivel = new Niveis();

// Verificando se algum dos campos necessários não estão preenchidos
if (
    !empty($_POST['id_nivel']) &&
    !empty($_POST['nome_nivel']) &&
    isset($_POST['tempo_nivel']) &&
    !empty($_POST['dificuldade']) &&
    isset($_POST['id_administrativo']) &&
    isset($_POST['xp_necessario']) &&
    isset($_POST['nivel_requerido'])
) {
    // Atribuindo os valores para as variáveis
    $id_nivel = intval($_POST['id_nivel']);
    $nome_nivel = $_POST['nome_nivel'];
    $tempo_nivel = $_POST['tempo_nivel'];
    $dificuldade = $_POST['dificuldade'];
    $id_administrativo = $_POST['id_administrativo'];
    $xp_necessario = $_POST['xp_necessario'];
    $nivel_requerido = $_POST['nivel_requerido'];

    $nivel->editar($id_nivel, $nome_nivel, $tempo_nivel, $dificuldade, $id_administrativo, $xp_necessario, $nivel_requerido); // Chama o método de editar
}

