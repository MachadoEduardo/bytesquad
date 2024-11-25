<?php
require '../bytesquad/assets/classes/administrador.class.php';

// Variáveis de erro e sucesso
$erro = '';
$sucesso = '';

// Verificando se os campos de senha foram enviados
if (!empty($_GET['usuario']) && !empty($_POST['nova_senha']) && !empty($_POST['confirmar_senha'])) {
    $usuario = addslashes($_GET['usuario']);
    $novaSenha = $_POST['nova_senha'];
    $confirmarSenha = $_POST['confirmar_senha'];

    // Verificando se as senhas coincidem
    if ($novaSenha !== $confirmarSenha) {
        $erro = "As senhas não coincidem.";
    } else {
        // Usar o método correto de criptografia
        $administrador = new Administrador();
        if ($administrador->atualizarSenha($usuario, $novaSenha)) {
            // Redireciona para a página de login após sucesso
            header("Location: telaLogin.php?mensagem=sucesso");
            exit;
        } else {
            $erro = "Ocorreu um erro ao redefinir sua senha.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redefinir Senha</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-header text-center">
                        <h1>Redefinir Senha</h1>
                    </div>
                    <div class="card-body">
                        <?php if (!empty($erro)): ?>
                            <div class="alert alert-danger text-center">
                                <?= $erro; ?>
                            </div>
                        <?php endif; ?>
                        <form method="POST">
                            <div class="mb-3">
                                <label for="nova_senha" class="form-label">Digite sua nova senha:</label>
                                <input type="password" name="nova_senha" id="nova_senha" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="confirmar_senha" class="form-label">Confirme a nova senha:</label>
                                <input type="password" name="confirmar_senha" id="confirmar_senha" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Redefinir Senha</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
