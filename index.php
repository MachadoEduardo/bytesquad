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

    <!-- Header -->
    <div class="header-bg"></div>
    <header class="container bg-dark mt-4 rounded d-flex justify-content-between align-items-center py-2">
        <div class="d-flex align-items-center">
            <p class="text-white fs-3 fw-bold mb-0">ByteSquad</p>
        </div>
        <div class="d-flex align-items-center">
            <div class="dropdown me-2">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    Serviços
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <li>
                        <h6 class="dropdown-header">Gerenciar</h6>
                    </li>
                    <li><a class="dropdown-item" href="gerenciarUsuario.php">Usuários</a></li>
                    <li><a class="dropdown-item" href="gerenciarAdministrador.php">Administradores</a></li>
                    <li><a class="dropdown-item" href="gerenciarNivel.php">Perguntas e respostas</a></li>
                    <li><a class="dropdown-item" href="#">Níveis de dificuldade</a></li>
                </ul>
            </div>
            <div class="dropdown me-2">
                <button class="btn btn-secondary" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    Sair
                </button>
            </div>


        </div>
    </header>

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
            </ul>
        </div>

    </main>

    <!-- Inclua os scripts necessários para o Bootstrap 5.x -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.min.js"></script>

</body>

</html>