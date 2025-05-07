<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Potta One' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        h1 {
            font-family: 'Potta One';
            font-size: 22px;
        }

        body {
            background-image: url('./assets/img/background.png');
            background-size: cover;
            background-position: center;
            min-height: 100vh;
            overflow-x: hidden;
        }

        button {
            font-family: 'Poppins';
            font-size: 22px;
        }

        #title {
            z-index: 1;
        }

        main button {
            font-family: 'Poppins';
            font-weight: bold;
            font-size: 30px;
            width: 20vh;
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
        <a href="config.php"><img src="assets/img/settingsIcon.png" class="absolute h-20 p-2 m-2"></a>

        <div class="flex flex-col min-h-screen justify-center items-center gap-6 w-full max-w-md mx-auto px-4">
            <div id="title">
                <img src="assets/img/logoByteSquad.png" class="max-w-[800px] w-full">
            </div>
            <a href="cadastro.php">
                <button class="w-full max-w-[300px] text-[1.5rem] sm:text-[2rem] btn-verificar cursor-pointer transition-all font-bold bg-[#42D1C9] text-white px-6 py-2 rounded-full border-[#0E716B] border-[2px] hover:brightness-110 hover:-translate-y-[1px] hover:border-b-[6px] active:border-b-[2px] active:brightness-90 active:translate-y-[2px]">
                    Cadastrar
                </button>
            </a>
            <a href="telaLogin.php">
                <button class="w-full max-w-[300px] text-[1.5rem] sm:text-[2rem] btn-verificar cursor-pointer transition-all font-bold bg-[#42D1C9] text-white px-6 py-2 rounded-full border-[#0E716B] border-[2px] hover:brightness-110 hover:-translate-y-[1px] hover:border-b-[6px] active:border-b-[2px] active:brightness-90 active:translate-y-[2px]">
                    Logar</button>
            </a>
            <a href="sobre.php">
                <button class="w-full max-w-[300px] text-[1.5rem] sm:text-[2rem] btn-verificar cursor-pointer transition-all font-bold bg-[#42D1C9] text-white px-6 py-2 rounded-full border-[#0E716B] border-[2px] hover:brightness-110 hover:-translate-y-[1px] hover:border-b-[6px] active:border-b-[2px] active:brightness-90 active:translate-y-[2px]">
                    Sobre</button>
            </a>
        </div>
    </main>

</body>

<!--  -->