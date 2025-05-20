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
    <title>Caixa de Entrada - ByteSquad</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;700&display=swap');
        .message-item {
            transition: all 0.2s ease;
        }
        
        .message-item:hover {
            background-color: #f9fafb;
        }
        
        .unread {
            border-left: 4px solid #4f46e5;
        }
        
        .message-enter {
            opacity: 0;
            transform: translateY(10px);
        }
        
        .message-enter-to {
            opacity: 1;
            transform: translateY(0);
        }
        
        .message-leave-to {
            opacity: 0;
            transform: translateX(-10px);
        }
        
        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }
        
        .pulse {
            animation: pulse 2s infinite;
        }
    </style>
</head>
<body class="bg-gray-100 min-h-screen">
    <div class="flex h-screen">
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
                <header class="flex justify-between items-center mb-6">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-800">Caixa de Entrada</h1>
                        <p class="text-gray-600 mt-1">Gerencie suas mensagens e notificações</p>
                    </div>
                    <div class="flex space-x-2">
                        <button id="refreshBtn" class="p-2 rounded-full hover:bg-gray-200 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                            </svg>
                        </button>
                        <button id="markAllReadBtn" class="bg-indigo-100 text-indigo-700 px-4 py-2 rounded-lg text-sm font-medium hover:bg-indigo-200 transition-colors flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Marcar tudo como lido
                        </button>
                    </div>
                </header>

                <!-- Menu de Filtro -->
                <div class="bg-white rounded-xl shadow-sm mb-6">
                    <div class="flex overflow-x-auto">
                        <button class="tab-btn flex-1 py-4 px-4 font-medium text-center border-b-2 border-indigo-500 text-indigo-600 whitespace-nowrap">
                            <div class="flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                                Todas Mensagens
                                <span class="ml-2 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white bg-indigo-500 rounded-full">12</span>
                            </div>
                        </button>
                        <button class="tab-btn flex-1 py-4 px-4 font-medium text-center border-b-2 border-transparent text-gray-500 hover:text-gray-700 whitespace-nowrap">
                            <div class="flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 01-6 0v-1m6 0H9" />
                                </svg>
                                Notificações
                                <span class="ml-2 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white bg-red-500 rounded-full">6</span>
                            </div>
                        </button>
                        <button class="tab-btn flex-1 py-4 px-4 font-medium text-center border-b-2 border-transparent text-gray-500 hover:text-gray-700 whitespace-nowrap">
                            <div class="flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Conquistas
                                <span class="ml-2 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white bg-green-500 rounded-full">3</span>
                            </div>
                        </button>
                        <button class="tab-btn flex-1 py-4 px-4 font-medium text-center border-b-2 border-transparent text-gray-500 hover:text-gray-700 whitespace-nowrap">
                            <div class="flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                                </svg>
                                Mensagens
                                <span class="ml-2 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white bg-blue-500 rounded-full">3</span>
                            </div>
                        </button>
                    </div>
                </div>

                <!-- Barra de Pesquisa -->
                <div class="relative mb-6">
                    <input type="text" placeholder="Pesquisar mensagens..." class="pl-10 pr-4 py-3 w-full rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                </div>

                <!-- Lista de Mensagens -->
                <div class="bg-white rounded-xl shadow-sm overflow-hidden" id="messageList">
                    <!-- Mensagem Não Lida - Sistema -->
                    <div class="message-item unread p-4 border-b border-gray-100">
                        <div class="flex items-start">
                            <div class="flex-shrink-0 mr-4">
                                <div class="w-10 h-10 rounded-full bg-indigo-100 flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                </div>
                            </div>
                            <div class="flex-1">
                                <div class="flex justify-between items-start">
                                    <h3 class="font-medium text-gray-900">Novo nível disponível</h3>
                                    <div class="flex items-center">
                                        <span class="text-sm text-gray-500">1h atrás</span>
                                        <div class="ml-2 h-2 w-2 bg-indigo-500 rounded-full"></div>
                                    </div>
                                </div>
                                <p class="mt-1 text-gray-600">Um novo nível "Fundamentos de API RESTful" foi adicionado à plataforma. Experimente agora!</p>
                                <div class="mt-3 flex">
                                    <a href="#" class="text-indigo-600 font-medium text-sm hover:text-indigo-800 mr-4">Ver nível</a>
                                    <button class="text-gray-500 text-sm hover:text-gray-700">Marcar como lido</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Mensagem Não Lida - Conquista -->
                    <div class="message-item unread p-4 border-b border-gray-100">
                        <div class="flex items-start">
                            <div class="flex-shrink-0 mr-4">
                                <div class="w-10 h-10 rounded-full bg-yellow-100 flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-yellow-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7" />
                                    </svg>
                                </div>
                            </div>
                            <div class="flex-1">
                                <div class="flex justify-between items-start">
                                    <h3 class="font-medium text-gray-900">Conquista desbloqueada!</h3>
                                    <div class="flex items-center">
                                        <span class="text-sm text-gray-500">3h atrás</span>
                                        <div class="ml-2 h-2 w-2 bg-indigo-500 rounded-full"></div>
                                    </div>
                                </div>
                                <p class="mt-1 text-gray-600">Parabéns! Você desbloqueou a conquista "Mestre do CSS" por completar todos os níveis relacionados a CSS.</p>
                                <div class="mt-3 flex">
                                    <a href="#" class="text-indigo-600 font-medium text-sm hover:text-indigo-800 mr-4">Ver conquista</a>
                                    <button class="text-gray-500 text-sm hover:text-gray-700">Marcar como lido</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Mensagem Não Lida - Leaderboard -->
                    <div class="message-item unread p-4 border-b border-gray-100">
                        <div class="flex items-start">
                            <div class="flex-shrink-0 mr-4">
                                <div class="w-10 h-10 rounded-full bg-green-100 flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                                    </svg>
                                </div>
                            </div>
                            <div class="flex-1">
                                <div class="flex justify-between items-start">
                                    <h3 class="font-medium text-gray-900">Você subiu no ranking!</h3>
                                    <div class="flex items-center">
                                        <span class="text-sm text-gray-500">6h atrás</span>
                                        <div class="ml-2 h-2 w-2 bg-indigo-500 rounded-full"></div>
                                    </div>
                                </div>
                                <p class="mt-1 text-gray-600">Você subiu para o 5º lugar no leaderboard "Mais Pontos". Continue assim!</p>
                                <div class="mt-3 flex">
                                    <a href="#" class="text-indigo-600 font-medium text-sm hover:text-indigo-800 mr-4">Ver leaderboard</a>
                                    <button class="text-gray-500 text-sm hover:text-gray-700">Marcar como lido</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Mensagem Não Lida - Admin -->
                    <div class="message-item unread p-4 border-b border-gray-100">
                        <div class="flex items-start">
                            <div class="flex-shrink-0 mr-4">
                                <div class="w-10 h-10 rounded-full bg-purple-100 flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                    </svg>
                                </div>
                            </div>
                            <div class="flex-1">
                                <div class="flex justify-between items-start">
                                    <h3 class="font-medium text-gray-900">Mensagem do Administrador</h3>
                                    <div class="flex items-center">
                                        <span class="text-sm text-gray-500">12h atrás</span>
                                        <div class="ml-2 h-2 w-2 bg-indigo-500 rounded-full"></div>
                                    </div>
                                </div>
                                <p class="mt-1 text-gray-600">Haverá manutenção programada do sistema no dia 25/05 das 23h às 01h. O acesso estará indisponível durante este período.</p>
                                <div class="mt-3 flex">
                                    <a href="#" class="text-indigo-600 font-medium text-sm hover:text-indigo-800 mr-4">Mais detalhes</a>
                                    <button class="text-gray-500 text-sm hover:text-gray-700">Marcar como lido</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Mensagem Lida - Desafio -->
                    <div class="message-item p-4 border-b border-gray-100">
                        <div class="flex items-start">
                            <div class="flex-shrink-0 mr-4">
                                <div class="w-10 h-10 rounded-full bg-red-100 flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                            </div>
                            <div class="flex-1">
                                <div class="flex justify-between items-start">
                                    <h3 class="font-medium text-gray-900">Desafio semanal disponível</h3>
                                    <span class="text-sm text-gray-500">2d atrás</span>
                                </div>
                                <p class="mt-1 text-gray-600">O desafio semanal "Desenvolvimento de Interface Responsiva" já está disponível para você participar.</p>
                                <div class="mt-3 flex">
                                    <a href="#" class="text-indigo-600 font-medium text-sm hover:text-indigo-800">Ver desafio</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Mensagem Lida - Feedback -->
                    <div class="message-item p-4 border-b border-gray-100">
                        <div class="flex items-start">
                            <div class="flex-shrink-0 mr-4">
                                <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                                    </svg>
                                </div>
                            </div>
                            <div class="flex-1">
                                <div class="flex justify-between items-start">
                                    <h3 class="font-medium text-gray-900">Feedback sobre sua solução</h3>
                                    <span class="text-sm text-gray-500">3d atrás</span>
                                </div>
                                <p class="mt-1 text-gray-600">Um mentor deixou feedback sobre sua solução para o desafio "Construção de API". Confira agora!</p>
                                <div class="mt-3 flex">
                                    <a href="#" class="text-indigo-600 font-medium text-sm hover:text-indigo-800">Ver feedback</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Paginação -->
                <div class="mt-6 flex justify-between items-center">
                    <div class="text-sm text-gray-600">
                        Mostrando 1-6 de 12 mensagens
                    </div>
                    <div class="flex space-x-1">
                        <button class="px-3 py-1 rounded border border-gray-300 bg-white text-gray-500 hover:bg-gray-50">Anterior</button>
                        <button class="px-3 py-1 rounded border border-indigo-500 bg-indigo-500 text-white">1</button>
                        <button class="px-3 py-1 rounded border border-gray-300 bg-white text-gray-700 hover:bg-gray-50">2</button>
                        <button class="px-3 py-1 rounded border border-gray-300 bg-white text-gray-500 hover:bg-gray-50">Próxima</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal de Mensagem Detalhada (oculto por padrão) -->
        <div id="messageModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
            <div class="bg-white rounded-xl shadow-lg max-w-2xl w-full mx-4 max-h-[90vh] overflow-auto">
                <div class="p-6 border-b border-gray-200">
                    <div class="flex justify-between items-start">
                        <div class="flex items-center">
                            <div class="w-10 h-10 rounded-full bg-indigo-100 flex items-center justify-center mr-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-bold text-xl text-gray-900">Novo nível disponível</h3>
                                <p class="text-sm text-gray-500">Sistema • 1h atrás</p>
                            </div>
                        </div>
                        <button id="closeModal" class="text-gray-500 hover:text-gray-700">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
                <div class="p-6">
                    <div class="prose max-w-none">
                        <p>Olá!</p>
                        <p>Temos o prazer de anunciar que um novo nível foi disponibilizado em nossa plataforma:</p>
                        <h4>Fundamentos de API RESTful</h4>
                        <p>Este nível irá ensinar a você:</p>
                        <ul>
                            <li>O que são APIs RESTful e como funcionam</li>
                            <li>Métodos HTTP comuns (GET, POST, PUT, DELETE)</li>
                            <li>Como estruturar endpoints de API</li>
                            <li>Boas práticas para design de API</li>
                            <li>Códigos de status HTTP e seu significado</li>
                        </ul>
                        <p>Este conteúdo é perfeito para quem deseja aprofundar seus conhecimentos em desenvolvimento web e entender como os serviços modernos se comunicam.</p>
                        <p>Complete este nível para ganhar 150 pontos e desbloquear a conquista "Arquiteto de API".</p>
                    </div>
                    <div class="mt-6 bg-gray-50 p-4 rounded-lg">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <div class="w-12 h-12 bg-indigo-100 rounded-lg flex items-center justify-center mr-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-