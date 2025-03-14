<?php
require '../bytesquad/assets/classes/usuarios.class.php';

if (!empty($_POST['usuario'])) {
    $nome_usuario = addslashes($_POST['usuario']);
    $usuario = new Usuarios();

    if ($usuario->verificarUsuario($nome_usuario)) {
        // Se o usuario existe no banco, redireciona para definir nova senha
        header("Location: redefinirSenha.php?usuario=" . urlencode($nome_usuario));
        exit;
    } else {
        $erro = "Usuario não encontrado.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Esqueceu a senha</title>
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

        label {
            font-family: 'Play';
            font-size: 1.2rem;
        }
        
        #verify{
            text-shadow: -2px -2px 0 #0E716B,
            2px -2px 0 #0E716B,
            -2px 2px 0 #0E716B,
            2px 2px 0 #0E716B ;
        }

        #return{
            text-shadow: -1.2px -1.2px 0 black,
            1.2px -1.2px 0 black,
            -1.2px 1.2px 0 black,
            1.2px 1.2px 0 black ;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-2xl border-[2px] border-black rounded-2xl">
                    <div id="card-header" class="card-header text-center">
                        <h1 class="font-[Play] text-[2rem]">Esqueceu sua senha</h1>
                    </div>
                    <div class="card-body d-flex flex-column align-items-center">
                        <?php if (isset($erro)): ?>
                            <div class="alert alert-danger text-center w-100">
                                <?= $erro; ?>
                            </div>
                        <?php endif; ?>
                        <?php if (isset($sucesso)): ?>
                            <div class="alert alert-success text-center w-100">
                                <?= $sucesso; ?>
                            </div>
                        <?php endif; ?>

                        <form method="POST" class="p-2 w-100">
                            <div class="mb-3">
                                <label for="usuario" class="form-label font-[Play] text-[1.2rem]">Digite seu usuario:</label>
                                <input type="text" name="usuario" id="usuario" class="placeholder:font-[Poppins] form-control rounded-xl border-[2px] border-black" required placeholder="Nome de usuário">
                                <p id="description" class="font-[Play] my-2">Iremos verificar se o seu usuário existe dentro do nosso banco de dados e se corresponde a uma conta do ByteSquad.</p>
                            </div>
                            <div class="d-flex justify-content-center gap-3">
                                <button type="submit" id="verify" class="font-[Poppins] text-[2rem] btn-verificar cursor-pointer transition-all font-bold bg-[#42D1C9] text-white px-6 py-2 rounded-full border-[#0E716B] border-[2px] hover:brightness-110 hover:-translate-y-[1px] hover:border-b-[6px] active:border-b-[2px] active:brightness-90 active:translate-y-[2px]">
                                    Avançar
                                </button>                         
                                <a href="telaLogin.php">
                                    <button type="button" id="return" class="font-[Poppins] text-[2rem] btn-voltar border-black border-[1px] font-bold cursor-pointer transition-all bg-[#fefefe] text-white px-6 py-2 rounded-full border-[#000000] hover:brightness-110 hover:-translate-y-[1px] hover:border-b-[6px] active:border-b-[2px] active:brightness-90 active:translate-y-[2px]">
                                    Voltar
                                </button>
                                </a>
                            </div>
                        </form>            

</html>