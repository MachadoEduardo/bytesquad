<?php
session_start();
require './assets/classes/administrador.class.php';

if (!empty($_POST['usuario']) && !empty($_POST['senha'])) {
    $usuario = trim($_POST['usuario']);
    $senha = $_POST['senha']; // Agora usamos a senha diretamente, sem md5.

    $admin = new Administrador();
    if ($admin->fazerLogin($usuario, $senha)) {
        header("Location: index.php");
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
    <title>Login - ByteSquad</title>
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Roboto', sans-serif;
        }

        .login-container {
            margin-top: 100px;
            max-width: 400px;
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .login-container h1 {
            margin-bottom: 20px;
        }
    </style>
</head>

<body>

    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="login-container">
            <h1 class="text-center">Login</h1>
            <form method="POST">
                <div class="mb-3">
                    <label for="usuario" class="form-label">Usuário</label>
                    <input type="text" class="form-control" id="usuario" name="usuario" required>
                </div>
                <div class="mb-3">
                    <label for="senha" class="form-label">Senha</label>
                    <input type="password" class="form-control" id="senha" name="senha" required>
                </div>
                <button type="submit" name="login" class="btn btn-primary w-100">Entrar</button>
            </form>
            <p class="text-center">
                <a href="esqueceuSenha.php">Esqueceu a senha?</a>
            </p>

            <p class="text-center text-muted mt-3">© 2024 ByteSquad</p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>