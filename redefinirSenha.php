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
    <link href='https://fonts.googleapis.com/css?family=Play' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Potta One' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            background-image: url('./assets/img/background.png');
            background-size: cover;
            height: 100vh;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        #submit {
            text-shadow: -1px -1px 0 #0E716B,
                1px -1px 0 #0E716B,
                -1px 1px 0 #0E716B,
                1px 1px 0 #0E716B;
        }

        #return {
            text-shadow: -1px -1px 0 black,
                1px -1px 0 black,
                -1px 1px 0 black,
                1px 1px 0 black;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-header text-center">
                        <h1 class="font-[Play] text-[2rem]">Redefinir Senha</h1>
                    </div>
                    <div class="card-body">
                        <?php if (!empty($erro)): ?>
                            <div class="alert alert-danger text-center">
                                <?= $erro; ?>
                            </div>
                        <?php endif; ?>
                        <form method="POST">
                            <div class="mb-3">
                                <label for="nova_senha" class="form-label font-[Play] text-[1.2rem]">Digite sua nova senha:</label>
                                <input type="password" name="nova_senha" id="nova_senha" class="form-control placeholder:font-[Play]" required placeholder="Nova senha">
                            </div>
                            <div class="mb-3">
                                <label for="confirmar_senha" class="form-label font-[Play] text-[1.2rem]">Confirme a nova senha:</label>
                                <input type="password" name="confirmar_senha" id="confirmar_senha" class="form-control placeholder:font-[Play]" required placeholder="Confirmar nova senha">
                            </div>
                            <div class="d-flex justify-content-center gap-3">
                                <button type="submit" id="submit" class="font-[Poppins] text-[2rem] btn-verificar font-bold cursor-pointer transition-all bg-[#42D1C9] text-white px-6 py-2 rounded-full border-[#0E716B] border-[2px] hover:brightness-110 hover:-translate-y-[1px] hover:border-b-[6px] active:border-b-[2px] active:brightness-90 active:translate-y-[2px]">Pronto!</button>
                            </div>
                        </form>
                        <div class="d-flex justify-content-center gap-3 my-2">
                                <a href="esqueceuSenha.php">
                                    <button id="return" class="font-[Poppins] text-[2rem] btn-voltar font-bold border-black border-[1px] cursor-pointer transition-all bg-[#fefefe] text-white px-6 py-2 rounded-full border-[#000000] hover:brightness-110 hover:-translate-y-[1px] hover:border-b-[6px] active:border-b-[2px] active:brightness-90 active:translate-y-[2px]">Voltar</button>
                                </a>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>