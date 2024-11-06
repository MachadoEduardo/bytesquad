<?php
session_start();
require_once './assets/classes/administrador.class.php';
$admin = new Administrador();

// On protected admin pages
if (!isset($_SESSION['Logado'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../agenda/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <title>ByteSquad</title>
</head>

<body class="bg-light">

    <?php include 'assets/inc/header.inc.php'; ?>

    <!-- Conteúdo Principal -->
    <main class="container mt-5">
        <div class="header-content">
            <h1>Bem-vindo à seção administrativa!</h1>
            <h5>Segmento da aplicação dedicado ao gerenciamento das configurações.</h5>
            <ul class="nav flex-column">
            <li class="nav-item">
                    <a class="nav-link link-blue fs-3" href="gerenciarAdministrador.php">• Gerenciar administradores</a>
                    <p>Aba para criar, listar, editar e/ou excluir os administradores do sistema.</p>
                </li>
                <li class="nav-item">
                    <a class="nav-link link-blue fs-3" href="gerenciarUsuario.php">• Gerenciar usuários</a>
                    <p>Aba para criar, listar, editar e/ou excluir os usuários do sistema.</p>
                </li>
                <li class="nav-item">
                    <a class="nav-link link-blue fs-3" href="gerenciarNivel.php">• Gerenciar níveis</a>
                    <p>Aba para criar, listar, editar e/ou excluir os níveis do sistema.</p>
                </li>
                <li class="nav-item">
                    <a class="nav-link link-blue fs-3" href="gerenciarDicas.php">• Gerenciar pacotes de dicas</a>
                    <p>Aba para criar, listar, editar e/ou excluir os pacotes de dicas do sistema.</p>
                </li>
                <li class="nav-item">
                    <a class="nav-link link-blue fs-3" href="gerenciarEnergia.php">• Gerenciar pacotes de energia</a>
                    <p>Aba para criar, listar, editar e/ou excluir os pacotes de energia do sistema.</p>
                </li>
                <li class="nav-item">
                    <a class="nav-link link-blue fs-3" href="gerenciarCompra.php">• Gerenciar compras</a>
                    <p>Aba para criar, listar, editar e/ou excluir as compras do sistema.</p>
                </li>
                <li class="nav-item">
                    <a class="nav-link link-blue fs-3" href="gerenciarTabelaPontuacao.php">• Gerenciar tabelas de pontuação</a>
                    <p>Aba para listar e/ou excluir as configurações de tabelas de pontuação do sistema.</p>
                </li>
                <li class="nav-item">
                    <a class="nav-link link-blue fs-3" href="gerenciarRedeSocial.php">• Gerenciar credenciais de rede social</a>
                    <p>Aba para listar e/ou excluir os registros de rede social do sistema.</p>
                </li>
            </ul>
        </div>
    </main>

    <?php include 'assets/inc/footer.inc.php'; ?>

    <!-- Inclua os scripts necessários para o Bootstrap 5.x -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
