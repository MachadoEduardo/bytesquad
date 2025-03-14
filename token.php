<?php
// Redirecionamento imediato se o formulário foi submetido
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if(isset($_GET['usuario'])) {
        header("Location: redefinirSenha.php?usuario=" . urlencode($_GET['usuario']));
        exit;
    }
}

// Verificação do usuário APENAS se não for POST
if (!isset($_GET['usuario']) && $_SERVER['REQUEST_METHOD'] !== 'POST') {
    $erro = "Usuário não encontrado.";
} else {
    $email_usuario = $_GET['usuario'];
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verificação - ByteSquad</title>
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

        #verify {
            text-shadow: -2px -2px 0 #0E716B,
                2px -2px 0 #0E716B,
                -2px 2px 0 #0E716B,
                2px 2px 0 #0E716B;
        }

        #return {
            text-shadow: -1.2px -1.2px 0 black,
                1.2px -1.2px 0 black,
                -1.2px 1.2px 0 black,
                1.2px 1.2px 0 black;
        }

        .inputs-container input.code-input {
            background-color: #f8f9fa;
            border-radius: 15px;
            border: 2px solid #e0e0e0;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            color: #6a1b9a;
            font-size: 2.5rem;
            font-weight: 900;
            height: 80px;
            width: 80px;
            text-align: center;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            caret-color: transparent;
        }

        .inputs-container input.code-input:hover {
            border-color: #9c27b0;
            transform: translateY(-2px);
        }

        .inputs-container input.code-input:focus {
            outline: none;
            border-color: #6a1b9a;
            box-shadow: 0 0 0 3px rgba(106, 27, 154, 0.2);
            background-color: #ffffff;
        }

        .inputs-container input.code-input:disabled {
            background-color: #f5f5f5;
            opacity: 0.7;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-2xl border-[2px] border-black rounded-2xl">
                    <div id="card-header" class="card-header text-center">
                        <h1 class="font-[Play] text-[2rem]">Insira o código</h1>
                    </div>
                    <div class="card-body d-flex flex-column align-items-center">
                        <?php if (isset($erro)): ?>
                            <div class="alert alert-danger text-center w-100">
                                <?= $erro; ?>
                            </div>
                        <?php endif; ?>

                        <form method="POST" class="p-2 w-100"> <!-- Redireciona para a tela de token.php -->
                            <div class="mb-3 text-center">
                                <label for="usuario" class="form-label font-[Play] text-[1.2rem] block mb-6">
                                    Código enviado ao e-mail
                                    <div class="text-purple-400 font-bold mt-1"><?php echo isset($email_usuario) ? htmlspecialchars($email_usuario) : 'não encontrado'; ?></div>
                                </label>
                                <div class="inputs-container flex justify-center gap-4">
                                    <input type="text" maxlength="1" name="first" id="first" data-previous="" data-next="second" class="code-input" autocomplete="off" inputmode="numeric" pattern="[0-9]*">
                                    <input type="text" maxlength="1" name="second" id="second" data-previous="first" data-next="third" class="code-input" autocomplete="off" inputmode="numeric" pattern="[0-9]*">
                                    <input type="text" maxlength="1" name="third" id="third" data-previous="second" data-next="fourth" class="code-input" autocomplete="off" inputmode="numeric" pattern="[0-9]*">
                                    <input type="text" maxlength="1" name="fourth" id="fourth" data-previous="third" data-next="" class="code-input" autocomplete="off" inputmode="numeric" pattern="[0-9]*">
                                </div>
                            </div>
                            <div class="d-flex justify-content-center gap-3">
                                <button type="submit" name="submit" id="verify" class="font-[Poppins] text-[2rem] btn-verificar cursor-pointer transition-all font-bold bg-[#42D1C9] text-white px-6 py-2 rounded-full border-[#0E716B] border-[2px] hover:brightness-110 hover:-translate-y-[1px] hover:border-b-[6px] active:border-b-[2px] active:brightness-90 active:translate-y-[2px]">
                                    Verificar
                                </button>
                                <a href="esqueceuSenha.php">
                                    <button type="button" id="return" class="font-[Poppins] text-[2rem] btn-voltar border-black border-[1px] font-bold cursor-pointer transition-all bg-[#fefefe] text-white px-6 py-2 rounded-full border-[#000000] hover:brightness-110 hover:-translate-y-[1px] hover:border-b-[6px] active:border-b-[2px] active:brightness-90 active:translate-y-[2px]">
                                        Voltar
                                    </button>
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const inputs = document.querySelectorAll('.code-input');
        
        inputs.forEach((input, index) => {
            // Handle input
            input.addEventListener('input', (e) => {
                if (input.value.length === 1) {
                    if (input.dataset.next) {
                        document.getElementById(input.dataset.next).focus();
                    }
                }
            });

            // Handle backspace
            input.addEventListener('keydown', (e) => {
                if (e.key === 'Backspace' && input.value === '') {
                    if (input.dataset.previous) {
                        document.getElementById(input.dataset.previous).focus();
                    }
                }
            });

            // Handle arrow keys
            input.addEventListener('keyup', (e) => {
                if (e.key === 'ArrowLeft' && input.dataset.previous) {
                    document.getElementById(input.dataset.previous).focus();
                }
                if (e.key === 'ArrowRight' && input.dataset.next) {
                    document.getElementById(input.dataset.next).focus();
                }
            });

            // Prevent paste
            input.addEventListener('paste', (e) => {
                e.preventDefault();
            });
        });

        // Auto-focus first input
        inputs[0].focus();
    });
</script>

</html>
