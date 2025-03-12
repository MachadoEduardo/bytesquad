<?php
session_start();
require_once './assets/classes/usuarios.class.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Capturar dados do formulário
    $nome = $_POST['userName'] ?? '';
    $email = $_POST['userEmail'] ?? '';
    $senha = $_POST['userPassword'] ?? '';
    $confirmacao = $_POST['confirmPassword'] ?? '';
    
    // Validações básicas
    $erros = [];

    // Verificar campos obrigatórios
    if (empty($nome) || empty($email) || empty($senha) || empty($confirmacao)) {
        $erros[] = "Todos os campos obrigatórios devem ser preenchidos!";
    }

    // Verificar concordância com termos
    if (!isset($_POST['termos'])) {
        $erros[] = "Você deve aceitar os termos e condições!";
    }

    // Verificar senhas
    if ($senha !== $confirmacao) {
        $erros[] = "As senhas não coincidem!";
    }

    if (!empty($erros)) {
        $_SESSION['erros_cadastro'] = $erros;
        header("Location: cadastro.php");
        exit;
    }

    // Configurar valores padrão para campos não obrigatórios
    $permissoes = 'usuario'; // Permissão padrão para novos usuários
    $ativo = 1; // Usuário ativo por padrão
    $url_foto = null;
    $telefone = null;
    $id_redesocial = null;

    // Instanciar e cadastrar usuário
    $usuario = new Usuarios();
    $resultado = $usuario->adicionar(
        $email,
        $nome,
        $senha,
        $permissoes,
        $ativo,
        $url_foto,
        $telefone,
        $id_redesocial
    );

    // Tratar resultado
    if ($resultado === true) {
        $_SESSION['sucesso_cadastro'] = "Cadastro realizado com sucesso! Faça login.";
        header("Location: telaLogin.php");
    } else {
        $mensagem = is_string($resultado) ? $resultado : "Este e-mail já está cadastrado!";
        $_SESSION['erros_cadastro'] = [$mensagem];
        header("Location: cadastro.php");
    }
    exit;
} else {
    header("Location: cadastro.php");
    exit;
}