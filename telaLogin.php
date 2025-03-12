<?php
session_start();
require './assets/classes/administrador.class.php';
require './assets/classes/usuarios.class.php';

if (!empty($_POST['usuario']) && !empty($_POST['senha'])) {
    $usuario = trim($_POST['usuario']);
    $senha = $_POST['senha']; // Agora usamos a senha diretamente, sem md5.

    $admin = new Administrador();
    $usuarioClass = new Usuarios();
    if ($admin->fazerLogin($usuario, $senha)) {
        header("Location: index.php");
        exit;
    } else if ($usuarioClass->fazerLogin($usuario, $senha)) {
        header("Location: home.php");
        exit;
    } else {
        echo '<span style="color: red;">Usuário e/ou senha incorreto!</span>';
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Potta One' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Login - ByteSquad</title>
    <style>
        h1 {
            font-family: 'Potta One';
            font-size: 22px;
        }

        body {
            background-image: url('./assets/img/background.png');
            background-size: cover;
            height: 100vh;
            overflow: hidden;
        }

        button {
            font-family: 'Poppins';
            font-size: 22px;
        }

        #title {
            z-index: 1;
        }

        #button_bg {
            position: absolute;
            z-index: -1;
            background-color: rgb(3, 110, 93);
            height: 78px;
            width: 242px;
            top: 68%;
            left: 50%;
            transform: translate(-50%, -50%);
            border-radius: 40px;
        }

        label {
            text-shadow: -1px -1px 0 black,
            1px -1px 0 black,
            -1px 1px 0 black,
            1px 1px 0 black ;
            font-family: 'Potta One';
        }

        div button {
            -webkit-text-stroke: 1.3px #0E716B;
        }
    </style>
    <title>Login</title>
</head>

<body>
    <main>
        <a href=".php"><img src="assets/img/settingsIcon.png" class="absolute h-20 p-2 m-2"></a>

        <div class="container d-flex justify-content-center align-items-center vh-100">
            <div class="login-container">
                <div id="title">
                    <img src="assets/img/entrar.png">
                </div>
                <br>
                <br>
                <form method="POST">
                    <div class="mb-3">
                        <label for="usuario" class="form-label text-[#5DFDF3] text-2xl">Nome de usuário</label>
                        <input type="text" placeholder="Nome de usuário" class="form-control border-2 border-black z-10" id="usuario" name="usuario" required>
                    </div>
                    <div class="mb-3">
                        <label for="senha" class="form-label text-[#5DFDF3] text-2xl">Senha</label>
                        <input type="password" placeholder="Senha" class="form-control border-2 border-black z-1" id="senha" name="senha" required>
                    </div>
                    <p class="text-right">
                        <a href="esqueceuSenha.php" class="hover:text-cyan-500">Esqueci a senha</a>
                    </p>
                    <br>
                    <div class="hover:-translate-y-2 flex justify-center">
                        <button type="submit" name="login" class="bg-[#42D1C9] text-white rounded-full font-black text-4xl h-20 w-60 hover:bg-[#0bb0b5]">Feito!</button>
                        <div id="button_bg"></div>
                    </div>

                </form>
                <br>
                <p class="text-center">
                    Não possui uma conta?
                    <a href="cadastro.php" class="hover:text-cyan-500">Cadastre-se</a>
                </p>

                <p class="text-center text-muted mt-3">© 2024 ByteSquad</p>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>