<?php
include 'assets/classes/niveis.class.php';

$nivel = new Niveis();

if (
    !empty($_POST['nome_nivel']) &&
    isset($_POST['tempo_nivel']) &&
    !empty($_POST['dificuldade']) &&
    isset($_POST['id_administrativo']) &&
    isset($_POST['xp_necessario']) &&
    isset($_POST['nivel_requerido'])
) {
    // Captura do formulário e atribui esse valor nas variáveis
    $nome_nivel = $_POST['nome_nivel'];
    $tempo_nivel = $_POST['tempo_nivel'];
    $dificuldade = $_POST['dificuldade'];
    $id_administrativo = $_POST['id_administrativo'];
    $xp_necessario = $_POST['xp_necessario'];
    $nivel_requerido = $_POST['nivel_requerido'];

    if ($nivel->adicionar($nome_nivel, $tempo_nivel, $dificuldade, $id_administrativo, $xp_necessario, $nivel_requerido)) {
        echo '<script type="text/javascript">alert("Cadastrado com sucesso!");</script>';
        header('Location: gerenciarNivel.php');
        exit;
    } else {
        echo '<script type="text/javascript">alert("Nível já cadastrado!");</script>';
    }
}

