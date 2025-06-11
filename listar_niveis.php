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
$dadosUsuario = $usuario->buscarUsuario($_SESSION['Logado']);
?>

<!DOCTYPE html>
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

        :root {
            --duo-green: #58CC02;
            --duo-light-green: #9CFF7D;
            --duo-blue: #1CB0F6;
            --duo-orange: #FF9600;
            --duo-yellow: #FFC800;
            --duo-gray: #E5E5E5;
        }

        body {
            background-image: url('./assets/img/background.png');
            background-size: cover;
            min-height: 100vh;
            font-family: 'Quicksand', sans-serif;
        }

        h1, h2 {
            font-family: 'Potta One', cursive;
        }

        .level-path {
            position: relative;
            padding-top: 20px;
            max-width: 680px;
            margin: 0 auto;
        }

        .path-line {
            position: absolute;
            height: 100%;
            width: 14px;
            background-color: var(--duo-gray);
            left: 50%;
            top: 0;
            transform: translateX(-50%);
            z-index: 1;
            border-radius: 10px;
        }

        .level-node {
            position: relative;
            margin-bottom: 20px;
            z-index: 2;
            display: flex;
            justify-content: center;
        }

        .level-circle {
            width: 76px;
            height: 76px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: white;
            border: 4px solid var(--duo-gray);
            cursor: pointer;
            font-size: 1.75rem;
            font-weight: bold;
            color: #555;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            position: relative;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .level-circle:hover {
            transform: scale(1.05);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        }

        .level-completed .level-circle {
            background-color: var(--duo-green);
            border-color: #45a800;
            color: white;
        }

        .level-current .level-circle {
            background-color: var(--duo-orange);
            border-color: #e78600;
            color: white;
            animation: pulse 2s infinite;
        }

        .level-locked .level-circle {
            background-color: var(--duo-gray);
            border-color: #ccc;
            color: #999;
            cursor: not-allowed;
        }

        .checkmark {
            position: absolute;
            top: -10px;
            right: -10px;
            background-color: white;
            border-radius: 50%;
            width: 30px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 2px solid var(--duo-green);
        }

        .checkmark svg {
            color: var(--duo-green);
            width: 16px;
            height: 16px;
        }

        .level-trophy .level-circle {
            background-color: var(--duo-yellow);
            border-color: #d9a900;
        }

        .level-node:nth-child(odd) {
            transform: translateX(-40px);
        }

        .level-node:nth-child(even) {
            transform: translateX(40px);
        }

        @media (max-width: 640px) {
            .level-node:nth-child(odd),
            .level-node:nth-child(even) {
                transform: translateX(0);
            }
        }

        .progress-panel {
            background-color: white;
            border-radius: 16px;
            padding: 1.5rem;
            margin-bottom: 2rem;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .progress-bar {
            height: 10px;
            background-color: var(--duo-gray);
            border-radius: 5px;
            overflow: hidden;
            margin: 0.5rem 0;
        }

        .progress-fill {
            height: 100%;
            background-color: var(--duo-green);
            border-radius: 5px;
            transition: width 0.5s ease;
        }

        .theme-badge {
            background-color: var(--duo-blue);
            color: white;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.875rem;
            display: inline-block;
            margin-top: 0.5rem;
        }

        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }
        @keyframes shine {
            0% { transform: scale(1) rotate(0deg); }
            25% { transform: scale(1.1) rotate(-5deg); }
            50% { transform: scale(1.2) rotate(5deg); }
            75% { transform: scale(1.1) rotate(-2deg); }
            100% { transform: scale(1) rotate(0deg); }
        }

        .celebration {
            animation: shine 2s ease infinite;
        }
    </style>
</head>

<body class="bg-gray-100">
    <div class="flex">
        <?php include 'assets/inc/sidebar.inc.php'; ?>

        <div class="flex-1 p-4 md:ml-64">
            <div class="max-w-5xl mx-auto">
                <h1 class="text-3xl font-bold mb-6 text-white">Níveis</h1>

                <div class="progress-panel">
                    <div class="flex items-center gap-4">
                        <div class="bg-[#E8F9FF] p-3 rounded-xl">
                            <svg class="w-8 h-8 text-[#1CB0F6]" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z" />
                            </svg>
                        </div>
                        <div class="flex-1">
                            <p class="text-xl font-bold text-[#3C3C3C]">Use seus conhecimentos em tecnologia!</p>
                            <div class="progress-bar">
                                <div class="progress-fill" style="width: 30%"></div>
                            </div>
                            <span class="theme-badge">
                                Tema: Desenvolvimento Web
                            </span>
                        </div>
                    </div>
                </div>

                <div class="level-path">
                    <div class="path-line"></div>
                    
                    <?php 
                    $totalLevels = 15;
                    $completedLevels = 5;
                    
                    for ($i = 1; $i <= $totalLevels; $i++): 
                        $levelClass = '';
                        if ($i < $completedLevels) {
                            $levelClass = 'level-completed';
                        } elseif ($i == $completedLevels) {
                            $levelClass = 'level-current';
                        } else {
                            $levelClass = 'level-locked';
                        }
                        
                        if ($i == $totalLevels) {
                            $levelClass .= ' level-trophy';
                        }
                    ?>
                        <a href="<?= $i <= $completedLevels ? 'nivel-exemplo.php?id_nivel=' . $i : 'javascript:void(0)' ?>" 
                           class="level-node <?= $levelClass ?>">
                            <div class="level-circle">
                                <?php if ($i == $totalLevels): ?>
                                    <svg class="w-8 h-8 <?= $i <= $completedLevels ? 'text-white' : 'text-gray-400' ?>" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M19 5h-2V3H7v2H5c-1.1 0-2 .9-2 2v1c0 2.55 1.92 4.63 4.39 4.94.63 1.5 1.98 2.63 3.61 2.96V19H7v2h10v-2h-4v-3.1c1.63-.33 2.98-1.46 3.61-2.96C19.08 12.63 21 10.55 21 8V7c0-1.1-.9-2-2-2zM5 8V7h2v3.82C5.84 10.4 5 9.3 5 8zm14 0c0 1.3-.84 2.4-2 2.82V7h2v1z"/>
                                    </svg>
                                <?php else: ?>
                                    <?= $i ?>
                                <?php endif; ?>
                                
                                <?php if ($i < $completedLevels): ?>
                                    <div class="checkmark">
                                        <svg fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/>
                                        </svg>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </a>
                    <?php endfor; ?>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const progressBars = document.querySelectorAll('.progress-fill');
            progressBars.forEach(bar => {
                const width = bar.style.width;
                bar.style.width = '0';
                setTimeout(() => {
                    bar.style.width = width;
                }, 300);
            });
        });
    </script>
</body>

</html>