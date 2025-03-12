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
            height: 80px;
            width: 242px;
            top: 62%;
            left: 50%;
            transform: translate(-50%, -50%);
            border-radius: 40px;
        }

        #button_bg_1 {
            position: absolute;
            z-index: -1;
            background-color: rgb(3, 110, 93);
            height: 80px;
            width: 242px;
            top: 73%;
            left: 50%;
            transform: translate(-50%, -50%);
            border-radius: 40px;
        }

        #button_bg_2 {
            position: absolute;
            z-index: -1;
            background-color: rgb(3, 110, 93);
            height: 80px;
            width: 242px;
            top: 84%;
            left: 50%;
            transform: translate(-50%, -50%);
            border-radius: 40px;
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
            1px 1px 0 #0E716B ;
        }
    </style>
    <title>Home</title>
</head>

<body>
    <main>
        <a href=".php"><img src="assets/img/settingsIcon.png" class="absolute h-20 p-2 m-2"></a>

        <div class="flex flex-col min-h-screen justify-center items-center gap-6">
            <div id="title">
                <img src="assets/img/logoByteSquad.png">
            </div>
            <br>
            <a href="cadastro.php">
                <button class="cursor-pointer transition-all bg-[#42D1C9] text-white px-6 py-2 rounded-full border-[#0E716B] border-b-[8px] border-r-[2px] border-l-[2px] border-t-[1px] hover:brightness-110 
                hover:-translate-y-[1px] hover:border-b-[6px] active:border-b-[2px] active:brightness-90 active:translate-y-[2px]">
                Cadastrar</button>
            </a>
            <a href="telaLogin.php">
                <button class="cursor-pointer transition-all bg-[#42D1C9] text-white px-6 py-2 rounded-full border-[#0E716B] border-b-[8px] border-r-[2px] border-l-[2px] border-t-[1px] hover:brightness-110 
                hover:-translate-y-[1px] hover:border-b-[6px] active:border-b-[2px] active:brightness-90 active:translate-y-[2px]">
                Logar</button>
            </a>
            <a href="sobre.php">
                <button class="cursor-pointer transition-all bg-[#42D1C9] text-white px-6 py-2 rounded-full border-[#0E716B] border-b-[8px] border-r-[2px] border-l-[2px] border-t-[1px] hover:brightness-110 
                hover:-translate-y-[1px] hover:border-b-[6px] active:border-b-[2px] active:brightness-90 active:translate-y-[2px]">
                Sobre</button>
            </a>
        </div>
    </main>

</body>

<!--  -->