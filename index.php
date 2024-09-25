<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../agenda/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <title>ByteSquad</title>
    <style>
    </style>
</head>

<body class="bg-light">

<?php include 'assets/inc/header.inc.php'; ?>

    <!-- Conteúdo Principal -->
    <main class="container mt-5">
        <div class="header-content">
            <h1>Bem vindo a seção administrativa!</h1>
            <h5>Segmento da aplicação dedicada ao gerenciamento das configurações.</h5>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link link-blue fs-3" href="gerenciarUsuario.php">• Gerenciar usuários</a>
                    <p>Aba para criar, editar e/ou excluir os usuários do sistema.</p>
                </li>
                <li class="nav-item">
                    <a class="nav-link link-blue fs-3" href="gerenciarNivel.php">• Gerenciar níveis</a>
                    <p>Aba para criar, editar e/ou excluir os níveis do sistema.</p>
                </li>
                <li class="nav-item">
                    <a class="nav-link link-blue fs-3" href="gerenciarAdministrador.php">• Gerenciar administradores</a>
                    <p>Aba para criar, editar e/ou excluir os administradores do sistema.</p>
                </li>
                <li class="nav-item">
                    <a class="nav-link link-blue fs-3" href="">• Gerenciar compras</a>
                    <p>Aba para criar, editar e/ou excluir as configurações de compra de sistema.</p>
                </li>
                <li class="nav-item">
                    <a class="nav-link link-blue fs-3" href="">• Gerenciar configurações</a>
                    <p>Aba para criar, editar e/ou excluir a aba de configurações do sistema.</p>
                </li>
                <li class="nav-item">
                    <a class="nav-link link-blue fs-3" href="">• Gerenciar dicas</a>
                    <p>Aba para criar, editar e/ou excluir os pacotes de dicas do sistema.</p>
                </li>
                <li class="nav-item">
                    <a class="nav-link link-blue fs-3" href="">• Gerenciar energia</a>
                    <p>Aba para criar, editar e/ou excluir os pacotes de energia do sistema.</p>
                </li>
            </ul>
        </div>

    </main>

    <?php include 'assets/inc/footer.inc.php'; ?>

    <!-- Inclua os scripts necessários para o Bootstrap 5.x -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.min.js"></script>

</body>

</html>