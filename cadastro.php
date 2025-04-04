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
    <title>Cadastro</title>
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

        label {
            text-shadow: -1px -1px 0 #0E716B,
                1px -1px 0 black,
                -1px 1px 0 black,
                1px 1px 0 black;
            font-family: 'Potta One';
        }

        div button {
            font-family: 'Poppins';
            display: flex;
            justify-content: center;
            text-shadow: -1px -1px 0 #0E716B,
                1px -1px 0 #0E716B,
                -1px 1px 0 #0E716B,
                1px 1px 0 #0E716B;
        }
    </style>
    <title>Home</title>
</head>

<body>
    <main>
        <a href=".php"><img src="assets/img/settingsIcon.png" class="absolute h-20 p-2 m-2"></a>

        <div class="container d-flex justify-content-center align-items-center vh-100">
            <div class="login-container">
                <div id="title">
                    <img src="assets/img/logoCadastro.png">
                </div>
                <br>
                <br>
                <?php
                session_start();
                if (isset($_SESSION['erros_cadastro'])): ?>
                    <div class="alert alert-danger">
                        <?php
                        foreach ($_SESSION['erros_cadastro'] as $erro) {
                            echo "<p>$erro</p>";
                        }
                        unset($_SESSION['erris_cadastro']);
                        ?>
                    </div>
                <?php endif; ?>

                <?php if (isset($_SESSION['sucesso_cadastro'])): ?>
                    <div class="alert alert-success">
                        <?php
                        echo $_SESSION['sucesso_cadastro'];
                        unset($_SESSION['sucesso_cadastro']);
                        ?>
                    </div>
                <?php endif; ?>
                <form action="adicionarUsuarioSubmit.php" method="POST">
                    <div class="mb-3">
                        <label for="userName" class="form-label text-[#5DFDF3] text-2xl">Nome de Usuário</label>
                        <input type="text" placeholder="Nome de usuário" class="form-control border-2 border-black z-10" id="userName" name="userName" required>
                    </div>
                    <div class="mb-3">
                        <label for="userEmail" class="form-label text-[#5DFDF3] text-2xl">E-mail</label>
                        <input type="email" placeholder="E-mail" class="form-control border-2 border-black z-10" id="userEmail" name="userEmail" required>
                    </div>
                    <div class="mb-3">
                        <label for="userPassword" class="form-label text-[#5DFDF3] text-2xl">Senha</label>
                        <input type="password" placeholder="Senha" class="form-control border-2 border-black z-1" id="userPassword" name="userPassword" required>
                    </div>
                    <div class="mb-3">
                        <label for="confirmPassword" class="form-label text-[#5DFDF3] text-2xl">Confirme a senha</label>
                        <input type="password" placeholder="Confirme sua senha" class="form-control border-2 border-black z-1" id="confirmPassword" name="confirmPassword" required>
                    </div>
                    <input type="checkbox" name="termos"> Eu aceito os <a href="" class="text-blue-500">Termos e Condições.</a>
                    <br>
                    <br>
                    <div class="hover:-translate-y-2 flex justify-center">
                        <a href="sobre.php">
                        <button type="submit" name="login" class="cursor-pointer transition-all h-[5rem] w-[12rem] bg-[#42D1C9]  text-white text-[3rem] items-center align-center px-6 py-2 rounded-full 
                        border-[#0E716B] border-b-[8px] border-r-[2px] border-l-[2px] border-t-[1px] hover:brightness-110 hover:-translate-y-[1px] hover:border-b-[6px] active:border-b-[2px] active:brightness-90 active:translate-y-[2px]">Feito!</button>
                        </a>
                    </div>

                </form>
                <br>
                <p class="text-center">
                    Já possui uma conta?
                    <a href="telaLogin.php" class="text-blue-500">Faça login</a>
                </p>

                <p class="text-center text-muted mt-3">© 2024 ByteSquad</p>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>