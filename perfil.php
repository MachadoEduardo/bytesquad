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

$usuario = new Usuarios();
$dadosUsuario = $usuario->buscarUsuario($_SESSION['Logado']);
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://fonts.googleapis.com/css?family=Potta One' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Hora de aprender - Bytesquad</title>
    <style>
        td {
            font-family: 'Poppins';
            font-size: 22px;
        }
    </style>
</head>

<body class="bg-gray-100 font-[Poppins]">
    <div class="flex min-h-screen">
        <?php include 'assets/inc/sidebar.inc.php'; ?>
        <div class="flex-1 p-6 md:ml-64">
            <div class="max-w-4xl mx-auto mt-8">
                <h1 class="text-3xl md:text-4xl font-bold text-gray-700 mb-8">Meu Perfil</h1>

                <?php if ($dadosUsuario): ?>
                    <div class="bg-white shadow-md rounded-2xl p-6 md:p-10 flex flex-col md:flex-row items-center gap-8">
                        <div class="flex-shrink-0">
                            <img src="<?php echo !empty($dadosUsuario['url_foto']) ? $dadosUsuario['url_foto'] : 'https://www.iconpacks.net/icons/2/free-icon-user-3296.png'; ?>"
                                alt="Foto do usuário"
                                class="w-32 h-32 md:w-40 md:h-40 rounded-full object-cover border-4 border-indigo-500 shadow-lg">
                        </div>

                        <div class="flex-1">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <h2 class="text-sm text-gray-500">Nome</h2>
                                    <p class="text-xl font-semibold text-gray-800"><?php echo $dadosUsuario['nome_usuario']; ?></p>
                                </div>

                                <div>
                                    <h2 class="text-sm text-gray-500">Email</h2>
                                    <p class="text-xl font-semibold text-gray-800"><?php echo $dadosUsuario['email_usuario']; ?></p>
                                </div>

                                <div>
                                    <h2 class="text-sm text-gray-500">Telefone</h2>
                                    <p class="text-xl font-semibold text-gray-800"><?php echo $dadosUsuario['telefone']; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-6 text-right">
                        <a href="editarPerfil.php?id=<?php echo $dadosUsuario['id']; ?>"
                            class="inline-block px-5 py-2 bg-indigo-600 text-white font-semibold rounded-lg hover:bg-indigo-700 transition">
                            Editar Perfil
                        </a>
                    </div>
                <?php else: ?>
                    <p class="text-red-600 font-medium">Usuário não encontrado.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>