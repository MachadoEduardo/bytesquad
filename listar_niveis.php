<?php
session_start();
if (!isset($_SESSION['Logado'])) {
    header("Location: telaLogin.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['logout'])) {
    session_unset();
    session_destroy();

    header("Location: home.php");
    exit();
}

include 'assets/classes/usuarios.class.php';
include 'assets/classes/niveis.class.php';

$usuario = new Usuarios();
$niveis = new Niveis();
?>

<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://fonts.googleapis.com/css?family=Potta One' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Hora de aprender - Bytesquad</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;700&display=swap');

        h2 {
            color: rgb(0, 0, 0);
            font-family: 'Potta One';
        }

        p {
            font-family: 'Quicksand', sans-serif;
            font-weight: bold;
        }

        #levels {
            position: relative;
            display: inline-block;
            margin: 15px;
            padding: 15px 30px;
            text-align: center;
            font-size: 18px;
            letter-spacing: 1px;
            text-decoration: none;
            color: #0A9991;
            background: transparent;
            cursor: pointer;
            transition: ease-out 0.5s;
            border: 2px solid #0A9991;
            border-radius: 10px;
            box-shadow: inset 0 0 0 0 #0A9991;
        }

        #levels:hover {
            color: white;
            box-shadow: inset 0 -100px 0 0 #0A9991;
        }

        #levels:active {
            transform: scale(0.9);
        }

        :root {
            --duo-green: #58CC02;
            --duo-light-green: #9CFF7D;
            --duo-blue: #1CB0F6;
        }

        body {
            background-image: url('./assets/img/background.png');
            background-size: cover;
            height: 100vh;
            overflow: hidden;
        }

        .duo-progress {
            background: #e6e6e6;
            height: 8px;
            border-radius: 4px;
        }

        .duo-progress-bar {
            background: var(--duo-green);
            height: 100%;
            border-radius: 4px;
            transition: width 0.3s ease;
        }

        .duo-level {
            background: white;
            border: 3px solid var(--duo-green);
            border-radius: 16px;
            padding: 1.5rem;
            transition: all 0.2s ease;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            position: relative;
        }

        .duo-level:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 12px rgba(0, 0, 0, 0.1);
        }

        .duo-level.completed {
            background: var(--duo-light-green);
            border-color: var(--duo-green);
        }

        .duo-level.locked {
            background: #f0f0f0;
            border-color: #d0d0d0;
            cursor: not-allowed;
        }

        .duo-level-number {
            color: var(--duo-green);
            font-weight: 700;
            font-size: 1.5rem;
        }
    </style>
</head>

<body>
    <div class="flex">
        <?php include 'assets/inc/sidebar.inc.php'; ?>

        <div class="flex-1 p-8 md:ml-64">
            <div class="max-w-5xl mx-auto">
                <h1 class="text-4xl font-bold mb-6 text-[#fefefe]">Níveis</h1>

                <div class="bg-white rounded-2xl p-6 shadow-sm mb-8">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="bg-[#E8F9FF] p-3 rounded-xl">
                            <svg class="w-8 h-8 text-[#1CB0F6]" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-xl font-bold text-[#3C3C3C]">Use seus conhecimentos em tecnologia!</p>
                            <div class="duo-progress mt-2 w-48">
                                <div class="duo-progress-bar" style="width: 30%"></div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4">
                        <span class="inline-block bg-[#1CB0F6] text-white px-4 py-1 rounded-full text-sm font-medium">
                            Tema: Desenvolvimento Web
                        </span>
                    </div>
                </div>

                <a href="nivel-exemplo.php">
                    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-4">
                        <?php for ($i = 1; $i <= 15; $i++): ?>
                            <button class="duo-level <?= $i <= 5 ? 'completed' : '' ?>">
                                <div class="duo-level-number"><?= $i ?></div>
                                <?php if ($i <= 5): ?>
                                    <svg class="w-8 h-8 text-[#58CC02] absolute top-2 right-2" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z" />
                                    </svg>
                                <?php endif; ?>
                            </button>
                        <?php endfor; ?>
                    </div>
                </a>

            </div>
        </div>
    </div>
</body>

</html>