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
    <title>Leaderboards - ByteSquad</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;700&display=swap');
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .rank-item {
            animation: fadeIn 0.3s ease forwards;
            animation-delay: calc(var(--rank-index) * 0.05s);
            opacity: 0;
        }
        
        .tab-content {
            display: none;
        }
        
        .tab-content.active {
            display: block;
        }
    </style>
</head>
<body class="bg-gray-100 min-h-screen">
    <div class="flex">
    <?php include 'assets/inc/sidebar.inc.php'; ?>

        <!-- Conteúdo Principal -->
        <div class="lg:ml-64 w-full">
            <!-- Header Móvel -->
            <div class="lg:hidden bg-indigo-900 text-white p-4 flex justify-between items-center">
                <h1 class="text-xl font-bold">ByteSquad</h1>
                <button id="menuToggle" class="p-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>

            <!-- Conteúdo da Página -->
            <div class="p-6">
                <header class="mb-8">
                    <h1 class="text-3xl font-bold text-gray-800">Leaderboards</h1>
                    <p class="text-gray-600 mt-2">Veja os melhores jogadores e compare sua performance</p>
                </header>

                <!-- Visualização em Grid (Padrão) -->
                <div id="gridView" class="view-content active">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <!-- Leaderboard Tempo -->
                        <div class="bg-white rounded-xl shadow-md overflow-hidden">
                            <div class="bg-gradient-to-r from-blue-500 to-blue-600 p-4">
                                <div class="flex items-center">
                                    <div class="rounded-full bg-white p-2 mr-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <h3 class="text-xl font-bold text-white">Mais Rápidos</h3>
                                </div>
                                <p class="text-blue-100 text-sm mt-1">Classificação por menor tempo</p>
                            </div>
                            <div class="p-4">
                                <ul class="divide-y divide-gray-100">
                                    <li class="py-3 flex justify-between items-center rank-item" style="--rank-index: 1">
                                        <div class="flex items-center">
                                            <div class="w-8 h-8 bg-blue-100 text-blue-600 font-bold rounded-full flex items-center justify-center mr-3">1</div>
                                            <div>
                                                <p class="font-medium">Ana Silva</p>
                                                <p class="text-xs text-gray-500">Front-end Developer</p>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <p class="font-bold text-blue-600">01:42</p>
                                            <p class="text-xs text-gray-500">Tempo Médio</p>
                                        </div>
                                    </li>
                                    <li class="py-3 flex justify-between items-center rank-item" style="--rank-index: 2">
                                        <div class="flex items-center">
                                            <div class="w-8 h-8 bg-blue-100 text-blue-600 font-bold rounded-full flex items-center justify-center mr-3">2</div>
                                            <div>
                                                <p class="font-medium">Carlos Mendes</p>
                                                <p class="text-xs text-gray-500">Full-stack Developer</p>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <p class="font-bold text-blue-600">01:56</p>
                                            <p class="text-xs text-gray-500">Tempo Médio</p>
                                        </div>
                                    </li>
                                    <li class="py-3 flex justify-between items-center rank-item" style="--rank-index: 3">
                                        <div class="flex items-center">
                                            <div class="w-8 h-8 bg-blue-100 text-blue-600 font-bold rounded-full flex items-center justify-center mr-3">3</div>
                                            <div>
                                                <p class="font-medium">Julia Alves</p>
                                                <p class="text-xs text-gray-500">UI Designer</p>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <p class="font-bold text-blue-600">02:13</p>
                                            <p class="text-xs text-gray-500">Tempo Médio</p>
                                        </div>
                                    </li>
                                    <li class="py-3 flex justify-between items-center rank-item" style="--rank-index: 4">
                                        <div class="flex items-center">
                                            <div class="w-8 h-8 bg-blue-100 text-blue-600 font-bold rounded-full flex items-center justify-center mr-3">4</div>
                                            <div>
                                                <p class="font-medium">Pedro Souza</p>
                                                <p class="text-xs text-gray-500">Back-end Developer</p>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <p class="font-bold text-blue-600">02:31</p>
                                            <p class="text-xs text-gray-500">Tempo Médio</p>
                                        </div>
                                    </li>
                                    <li class="py-3 flex justify-between items-center rank-item" style="--rank-index: 5">
                                        <div class="flex items-center">
                                            <div class="w-8 h-8 bg-blue-100 text-blue-600 font-bold rounded-full flex items-center justify-center mr-3">5</div>
                                            <div>
                                                <p class="font-medium">Mariana Costa</p>
                                                <p class="text-xs text-gray-500">UX Designer</p>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <p class="font-bold text-blue-600">02:47</p>
                                            <p class="text-xs text-gray-500">Tempo Médio</p>
                                        </div>
                                    </li>
                                </ul>
                                <div class="mt-4 text-center">
                                    <a href="#" class="text-blue-600 hover:text-blue-800 text-sm font-medium">Ver Ranking Completo</a>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Leaderboard Pontos -->
                        <div class="bg-white rounded-xl shadow-md overflow-hidden">
                            <div class="bg-gradient-to-r from-purple-500 to-purple-600 p-4">
                                <div class="flex items-center">
                                    <div class="rounded-full bg-white p-2 mr-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-purple-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <h3 class="text-xl font-bold text-white">Mais Pontos</h3>
                                </div>
                                <p class="text-purple-100 text-sm mt-1">Classificação por pontuação</p>
                            </div>
                            <div class="p-4">
                                <ul class="divide-y divide-gray-100">
                                    <li class="py-3 flex justify-between items-center rank-item" style="--rank-index: 1">
                                        <div class="flex items-center">
                                            <div class="w-8 h-8 bg-purple-100 text-purple-600 font-bold rounded-full flex items-center justify-center mr-3">1</div>
                                            <div>
                                                <p class="font-medium">Rafael Oliveira</p>
                                                <p class="text-xs text-gray-500">Data Scientist</p>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <p class="font-bold text-purple-600">9,845</p>
                                            <p class="text-xs text-gray-500">Pontos Totais</p>
                                        </div>
                                    </li>
                                    <li class="py-3 flex justify-between items-center rank-item" style="--rank-index: 2">
                                        <div class="flex items-center">
                                            <div class="w-8 h-8 bg-purple-100 text-purple-600 font-bold rounded-full flex items-center justify-center mr-3">2</div>
                                            <div>
                                                <p class="font-medium">Camila Santos</p>
                                                <p class="text-xs text-gray-500">DevOps Engineer</p>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <p class="font-bold text-purple-600">8,712</p>
                                            <p class="text-xs text-gray-500">Pontos Totais</p>
                                        </div>
                                    </li>
                                    <li class="py-3 flex justify-between items-center rank-item" style="--rank-index: 3">
                                        <div class="flex items-center">
                                            <div class="w-8 h-8 bg-purple-100 text-purple-600 font-bold rounded-full flex items-center justify-center mr-3">3</div>
                                            <div>
                                                <p class="font-medium">Lucas Ferreira</p>
                                                <p class="text-xs text-gray-500">UX/UI Designer</p>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <p class="font-bold text-purple-600">7,943</p>
                                            <p class="text-xs text-gray-500">Pontos Totais</p>
                                        </div>
                                    </li>
                                    <li class="py-3 flex justify-between items-center rank-item" style="--rank-index: 4">
                                        <div class="flex items-center">
                                            <div class="w-8 h-8 bg-purple-100 text-purple-600 font-bold rounded-full flex items-center justify-center mr-3">4</div>
                                            <div>
                                                <p class="font-medium">Amanda Lima</p>
                                                <p class="text-xs text-gray-500">Mobile Developer</p>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <p class="font-bold text-purple-600">7,256</p>
                                            <p class="text-xs text-gray-500">Pontos Totais</p>
                                        </div>
                                    </li>
                                    <li class="py-3 flex justify-between items-center rank-item" style="--rank-index: 5">
                                        <div class="flex items-center">
                                            <div class="w-8 h-8 bg-purple-100 text-purple-600 font-bold rounded-full flex items-center justify-center mr-3">5</div>
                                            <div>
                                                <p class="font-medium">Bruno Castro</p>
                                                <p class="text-xs text-gray-500">Security Expert</p>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <p class="font-bold text-purple-600">6,891</p>
                                            <p class="text-xs text-gray-500">Pontos Totais</p>
                                        </div>
                                    </li>
                                </ul>
                                <div class="mt-4 text-center">
                                    <a href="#" class="text-purple-600 hover:text-purple-800 text-sm font-medium">Ver Ranking Completo</a>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Leaderboard Níveis -->
                        <div class="bg-white rounded-xl shadow-md overflow-hidden">
                            <div class="bg-gradient-to-r from-green-500 to-green-600 p-4">
                                <div class="flex items-center">
                                    <div class="rounded-full bg-white p-2 mr-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                                        </svg>
                                    </div>
                                    <h3 class="text-xl font-bold text-white">Mais Níveis</h3>
                                </div>
                                <p class="text-green-100 text-sm mt-1">Classificação por níveis completados</p>
                            </div>
                            <div class="p-4">
                                <ul class="divide-y divide-gray-100">
                                    <li class="py-3 flex justify-between items-center rank-item" style="--rank-index: 1">
                                        <div class="flex items-center">
                                            <div class="w-8 h-8 bg-green-100 text-green-600 font-bold rounded-full flex items-center justify-center mr-3">1</div>
                                            <div>
                                                <p class="font-medium">Gabriel Rocha</p>
                                                <p class="text-xs text-gray-500">Game Developer</p>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <p class="font-bold text-green-600">42</p>
                                            <p class="text-xs text-gray-500">Níveis Completados</p>
                                        </div>
                                    </li>
                                    <li class="py-3 flex justify-between items-center rank-item" style="--rank-index: 2">
                                        <div class="flex items-center">
                                            <div class="w-8 h-8 bg-green-100 text-green-600 font-bold rounded-full flex items-center justify-center mr-3">2</div>
                                            <div>
                                                <p class="font-medium">Isabela Costa</p>
                                                <p class="text-xs text-gray-500">Database Admin</p>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <p class="font-bold text-green-600">38</p>
                                            <p class="text-xs text-gray-500">Níveis Completados</p>
                                        </div>
                                    </li>
                                    <li class="py-3 flex justify-between items-center rank-item" style="--rank-index: 3">
                                        <div class="flex items-center">
                                            <div class="w-8 h-8 bg-green-100 text-green-600 font-bold rounded-full flex items-center justify-center mr-3">3</div>
                                            <div>
                                                <p class="font-medium">Thiago Martins</p>
                                                <p class="text-xs text-gray-500">QA Engineer</p>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <p class="font-bold text-green-600">35</p>
                                            <p class="text-xs text-gray-500">Níveis Completados</p>
                                        </div>
                                    </li>
                                    <li class="py-3 flex justify-between items-center rank-item" style="--rank-index: 4">
                                        <div class="flex items-center">
                                            <div class="w-8 h-8 bg-green-100 text-green-600 font-bold rounded-full flex items-center justify-center mr-3">4</div>
                                            <div>
                                                <p class="font-medium">Fernanda Dias</p>
                                                <p class="text-xs text-gray-500">Cloud Architect</p>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <p class="font-bold text-green-600">31</p>
                                            <p class="text-xs text-gray-500">Níveis Completados</p>
                                        </div>
                                    </li>
                                    <li class="py-3 flex justify-between items-center rank-item" style="--rank-index: 5">
                                        <div class="flex items-center">
                                            <div class="w-8 h-8 bg-green-100 text-green-600 font-bold rounded-full flex items-center justify-center mr-3">5</div>
                                            <div>
                                                <p class="font-medium">Gustavo Lima</p>
                                                <p class="text-xs text-gray-500">DevOps Specialist</p>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <p class="font-bold text-green-600">29</p>
                                            <p class="text-xs text-gray-500">Níveis Completados</p>
                                        </div>
                                    </li>
                                </ul>
                                <div class="mt-4 text-center">
                                    <a href="#" class="text-green-600 hover:text-green-800 text-sm font-medium">Ver Ranking Completo</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Visualização em Abas -->
                <div id="tabsView" class="view-content hidden">
                    <div class="bg-white rounded-xl shadow-md overflow-hidden">
                        <div class="flex border-b">
                            <button class="tab-btn flex-1 py-4 font-medium text-center border-b-2 border-blue-500 text-blue-600" data-tab="time">
                                <div class="flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    Mais Rápidos
                                </div>
                            </button>
                            <button class="tab-btn flex-1 py-4 font-medium text-center border-b-2 border-transparent text-gray-500 hover:text-gray-700" data-tab="points">
                                <div class="flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    Mais Pontos
                                </div>
                            </button>
                            <button class="tab-btn flex-1 py-4 font-medium text-center border-b-2 border-transparent text-gray-500 hover:text-gray-700" data-tab="levels">
                                <div class="flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                                    </svg>
                                    Mais Níveis
                                </div>
                            </button>
                        </div>
                        
                        <!-- Conteúdo das Abas -->
                        <div class="p-6">
                            <!-- Tab Tempo -->
                            <div id="timeTab" class="tab-content active">
                                <div class="flex justify-between items-center mb-6">
                                    <h3 class="text-xl font-bold text-gray-800">Ranking por Tempo</h3>
                                    <div class="relative">
                                        <select class="pl-3 pr-8 py-2 border border-gray-300 rounded-lg appearance-none focus:outline-none focus:ring-2 focus:ring-blue-500">
                                            <option>Todos os Níveis</option>
                                            <option>HTML Básico</option>
                                            <option>CSS Avançado</option>
                                            <option>JavaScript</option>
                                        </select>