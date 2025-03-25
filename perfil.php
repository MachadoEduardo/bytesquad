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

<body>
    <div class="flex">
        <?php include 'assets/inc/sidebar.inc.php'; ?>
        <div class="flex-1 p-8 md:ml-64">
            <div class="max-w-5xl mx-auto">
                <h1 class="text-4xl font-bold mb-6 text-gray-500">Perfil</h1>

                <div class="border flex">
                <?php
                if ($dadosUsuario): ?>
                    <?php if (!empty($dadosUsuario['url_foto'])): ?>
                        <img src="<?php echo $dadosUsuario['url_foto']; ?>" alt="Foto" style="width:100px; height:100px; object-fit:cover;">
                    <?php else: ?>
                        <img src="https://www.iconpacks.net/icons/2/free-icon-user-3296.png" alt="">
                    <?php endif; ?>
                    <div class="text-[32px] font-bold">
                    <?php echo $dadosUsuario['nome_usuario'] ?>
                    </div>
                        
                    <div class="text-[32px] font-bold">
                    <?php echo $dadosUsuario['email_usuario'] ?>
                    </div>

                    Telefone:
                    <?php echo $dadosUsuario['telefone'] ?>
                <?php else: ?>
                    <p>Usuário não encontrado.</p>
                <?php endif; ?>
                </div>
                
            </div>
        </div>

    </div>
</body>