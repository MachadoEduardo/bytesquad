
<?php
session_start(); // Inicia a sessão
require 'assets/classes/conexao.class.php'; // Inclui a conexão com o banco

if (isset($_POST['login'])) {
    $usuario = filter_input(INPUT_POST, 'usuario', FILTER_SANITIZE_STRING);
    $senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_STRING);
    
    // Verificar se o campo usuário e senha foram preenchidos
    if (!empty($usuario) && !empty($senha)) {
        $conexao = new Conexao();
        $sql = $conexao->conectar()->prepare("SELECT id_administrativo, senha_admin FROM administrativo WHERE usuario = :usuario");
        $sql->bindParam(':usuario', $usuario, PDO::PARAM_STR);
        $sql->execute();
        
        if ($sql->rowCount() > 0) {
            $dados = $sql->fetch(PDO::FETCH_ASSOC);
            // Verificar a senha com hash
            if (password_verify($senha, $dados['senha_admin'])) {
                $_SESSION['id_administrativo'] = $dados['id_administrativo']; // Armazena o ID do administrador na sessão
                header("Location: index.php"); // Redireciona para o painel
                exit;
            } else {
                echo '<script>alert("Usuário ou senha inválidos!");</script>';
                header("Location: index.php"); // Redireciona para o painel
                exit;
            }
        } else {
            echo '<script>alert("Usuário ou senha inválidos!");</script>';
            header("Location: index.php");
        }
    } else {
        echo '<script>alert("Por favor, preencha todos os campos!");</script>';
    }
}