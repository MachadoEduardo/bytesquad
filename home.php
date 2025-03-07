<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../agenda/css/bootstrap.min.css">
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

        <div class="flex flex-col min-h-screen justify-center items-center gap-6">
            <div id="title">
                <img src="assets/img/logo.png">
            </div>
            <button class="bg-[#42D1C9] text-white rounded-full font-bold text-3xl h-20 w-60 hover:bg-[#0bb0b5]">Cadastrar</button>
            <div id="button_bg"></div>
            <a href="telaLogin.php"><button class="bg-[#42D1C9] text-white rounded-full font-bold text-3xl h-20 w-60 hover:bg-[#0bb0b5]">Logar</button></a>
            <div id="button_bg_1"></div>
            <button class="bg-[#42D1C9] text-white rounded-full font-bold text-3xl h-20 w-60 hover:bg-[#0bb0b5]">Sobre</button>
            <div id="button_bg_2"></div>
        </div>
    </main>
</body>

<!--  -->