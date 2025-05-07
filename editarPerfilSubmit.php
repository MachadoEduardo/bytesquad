<?php
session_start();
include 'assets/classes/usuarios.class.php';

// Verificar se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $nome = $_POST['nome_usuario'];
    $email = $_POST['email_usuario'];
    $telefone = $_POST['telefone'];
    $senhaAtual = $_POST['senha_atual'];
    $novaSenha = $_POST['nova_senha'];
    $urlFotoAntiga = $_POST['url_foto_antiga'];
    
    // Processar upload de foto se houver
    $url_foto = $urlFotoAntiga; // Manter a foto antiga por padrão
    
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
        $pasta_destino = 'uploads/';
        
        // Verificar se o diretório existe, se não, criar
        if (!is_dir($pasta_destino)) {
            mkdir($pasta_destino, 0755, true);
        }
        
        // Obter informações do arquivo
        $nome_arquivo = $_FILES['foto']['name'];
        $nome_temp = $_FILES['foto']['tmp_name'];
        $extensao = strtolower(pathinfo($nome_arquivo, PATHINFO_EXTENSION));
        
        // Verificar se é uma imagem válida
        $extensoes_permitidas = ['jpg', 'jpeg', 'png', 'gif'];
        
        if (in_array($extensao, $extensoes_permitidas)) {
            // Criar nome único para o arquivo
            $novo_nome = 'foto_' . uniqid() . '.' . $extensao;
            $caminho_completo = $pasta_destino . $novo_nome;
            
            // Mover o arquivo para o destino
            if (move_uploaded_file($nome_temp, $caminho_completo)) {
                // Se houver uma foto antiga e não for a foto padrão, apagar
                if ($urlFotoAntiga && $urlFotoAntiga != 'assets/img/perfil_padrao.jpg' && file_exists($urlFotoAntiga)) {
                    unlink($urlFotoAntiga);
                }
                
                $url_foto = $caminho_completo;
            } else {
                $_SESSION['erro'] = "Erro ao fazer upload da imagem.";
                header("Location: editarPerfil.php?id=$id");
                exit;
            }
        } else {
            $_SESSION['erro'] = "Apenas arquivos JPG, JPEG, PNG e GIF são permitidos.";
            header("Location: editarPerfil.php?id=$id");
            exit;
        }
    }
    
    // Atualizar dados do usuário
    $usuario = new Usuarios();
    $resultado = $usuario->editar($id, $nome, $email, $telefone, $senhaAtual, $novaSenha, $url_foto);
    
    if ($resultado) {
        $_SESSION['sucesso'] = "Perfil atualizado com sucesso!";
        header("Location: perfil.php?id=$id");
    } else {
        $_SESSION['erro'] = "Senha atual incorreta ou erro ao atualizar perfil.";
        header("Location: editarPerfil.php?id=$id");
    }
    exit;
}

// Se não for POST, redirecionar
header("Location: index.php");
exit;
?>