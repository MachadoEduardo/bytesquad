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
            background: rgb(209, 77, 255);
            background: linear-gradient(-180deg, rgba(209, 77, 255, 1) 0%, rgba(22, 2, 37, 1) 100%);
            height: 100vh;
            overflow: hidden;
        }

        button {
            font-family: 'Poppins';
            font-size: 22px;
        }

        #cloud {
            position: absolute;
            z-index: -1;
            background-color: rgb(241, 241, 241);
            height: 800px;
            width: 100%;
            top: 100%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        #mini-cloud {
            position: absolute;
            z-index: -1;
            background-color: white;
            height: 300px;
            width: 16%;
            top: 50%;
            left: 97%;
            transform: translate(-50%, -50%);
            border-radius: 80%;
        }

        #mini-cloud-1 {
            position: absolute;
            z-index: -1;
            background-color: white;
            height: 300px;
            width: 16%;
            top: 58%;
            left: 85%;
            transform: translate(-50%, -50%);
            border-radius: 80%;
        }

        #mini-cloud-2 {
            position: absolute;
            z-index: -1;
            background-color: white;
            height: 300px;
            width: 16%;
            top: 64%;
            left: 73%;
            transform: translate(-50%, -50%);
            border-radius: 80%;
        }

        #mini-cloud-3 {
            position: absolute;
            z-index: -1;
            background-color: white;
            height: 300px;
            width: 16%;
            top: 53%;
            left: 60%;
            transform: translate(-50%, -50%);
            border-radius: 80%;
        }

        #mini-cloud-4 {
            position: absolute;
            z-index: -1;
            background-color: white;
            height: 300px;
            width: 16%;
            top: 64%;
            left: 45%;
            transform: translate(-50%, -50%);
            border-radius: 80%;
        }

        #mini-cloud-5 {
            position: absolute;
            z-index: -1;
            background-color: white;
            height: 300px;
            width: 16%;
            top: 45%;
            left: 35%;
            transform: translate(-50%, -50%);
            border-radius: 80%;
        }

        #mini-cloud-6 {
            position: absolute;
            z-index: -1;
            background-color: white;
            height: 300px;
            width: 16%;
            top: 48%;
            left: 25%;
            transform: translate(-50%, -50%);
            border-radius: 80%;
        }

        #mini-cloud-7 {
            position: absolute;
            z-index: -1;
            background-color: white;
            height: 300px;
            width: 16%;
            top: 62%;
            left: 14%;
            transform: translate(-50%, -50%);
            border-radius: 80%;
        }

        #mini-cloud-8 {
            position: absolute;
            z-index: -1;
            background-color: white;
            height: 300px;
            width: 16%;
            top: 52%;
            left: 1%;
            transform: translate(-50%, -50%);
            border-radius: 80%;
        }

        #mini-cloud-gray {
            position: absolute;
            z-index: 0;
            background-color: rgb(241, 241, 241);
            height: 280px;
            width: 13%;
            top: 53%;
            left: 97%;
            transform: translate(-50%, -50%);
            border-radius: 80%;
        }

        #mini-cloud-gray-1 {
            position: absolute;
            z-index: 0;
            background-color: rgb(241, 241, 241);
            height: 310px;
            width: 18%;
            top: 64%;
            left: 87%;
            transform: translate(-50%, -50%);
            border-radius: 80%;
        }

        #mini-cloud-gray-2 {
            position: absolute;
            z-index: 0;
            background-color: rgb(241, 241, 241);
            height: 310px;
            width: 18%;
            top: 71%;
            left: 73%;
            transform: translate(-50%, -50%);
            border-radius: 80%;
        }

        #mini-cloud-gray-3 {
            position: absolute;
            z-index: -1;
            background-color: rgb(241, 241, 241);
            height: 370px;
            width: 16%;
            top: 64%;
            left: 60%;
            transform: translate(-50%, -50%);
            border-radius: 80%;
        }

        #mini-cloud-gray-4 {
            position: absolute;
            z-index: -1;
            background-color: rgb(241, 241, 241);
            height: 370px;
            width: 20%;
            top: 71%;
            left: 44%;
            transform: translate(-50%, -50%);
            border-radius: 80%;
        }

        #mini-cloud-gray-5 {
            position: absolute;
            z-index: -0;
            background-color: rgb(241, 241, 241);
            height: 310px;
            width: 19%;
            top: 52%;
            left: 33%;
            transform: translate(-50%, -50%);
            border-radius: 80%;
        }

        #mini-cloud-gray-6 {
            position: absolute;
            z-index: 0;
            background-color: rgb(241, 241, 241);
            height: 310px;
            width: 20%;
            top: 55%;
            left: 28%;
            transform: translate(-50%, -50%);
            border-radius: 80%;
        }

        #mini-cloud-gray-7 {
            position: absolute;
            z-index: -1;
            background-color: rgb(241, 241, 241);
            height: 316px;
            width: 20%;
            top: 67%;
            left: 16%;
            transform: translate(-50%, -50%);
            border-radius: 80%;
        }

        #mini-cloud-gray-8 {
            position: absolute;
            z-index: -1;
            background-color: rgb(241, 241, 241);
            height: 376px;
            width: 17%;
            top: 65%;
            left: 2%;
            transform: translate(-50%, -50%);
            border-radius: 80%;
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
            top: 57%;
            left: 50%;
            transform: translate(-50%, -50%);
            border-radius: 40px;
        }
    </style>
    <title>Home</title>
</head>

<body>
    <main>
        <div id="cloud-background">
            <div id="cloud"></div>
            <div id="mini-cloud"></div>
            <div id="mini-cloud-gray"></div>
            <div id="mini-cloud-1"></div>
            <div id="mini-cloud-gray-1"></div>
            <div id="mini-cloud-2"></div>
            <div id="mini-cloud-gray-2"></div>
            <div id="mini-cloud-3"></div>
            <div id="mini-cloud-gray-3"></div>
            <div id="mini-cloud-4"></div>
            <div id="mini-cloud-gray-4"></div>
            <div id="mini-cloud-5"></div>
            <div id="mini-cloud-gray-5"></div>
            <div id="mini-cloud-6"></div>
            <div id="mini-cloud-gray-6"></div>
            <div id="mini-cloud-7"></div>
            <div id="mini-cloud-gray-7"></div>
            <div id="mini-cloud-8"></div>
            <div id="mini-cloud-gray-8"></div>
        </div>

        <div class="container d-flex justify-content-center align-items-center vh-100">
            <div class="login-container">
                <h1 class="text-center">Login</h1>
                <form method="POST">
                    <div class="mb-3">
                        <label for="usuario" class="form-label ">Usuário</label>
                        <input type="text" class="form-control border-2 border-black" id="usuario" name="usuario" required>
                    </div>
                    <div class="mb-3">
                        <label for="senha" class="form-label">Senha</label>
                        <input type="password" class="form-control border-2 border-black" id="senha" name="senha" required>
                    </div>
                    <div class="hover:-translate-y-2">
                    <button type="submit" name="login" class="bg-[#42D1C9] text-white rounded-full font-bold text-3xl h-20 w-60 hover:bg-[#0bb0b5]">Entrar</button>
                    <div id="button_bg"></div>
                    </div>
                    
                </form>
                <br>
                <p class="text-center">
                    <a href="esqueceuSenha.php">Não possui uma conta?</a>
                </p>

                <p class="text-center text-muted mt-3">© 2024 ByteSquad</p>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>