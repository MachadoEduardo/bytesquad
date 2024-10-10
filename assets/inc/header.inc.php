<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <title>ByteSquad</title>
    <style>
        html{
            height: 100%;
        }
        body{
            position: relative;
            margin: 0;
            min-height: 100%;
            padding-bottom: 7.85rem;
        }
        footer{
            position: absolute;
            bottom: 0;
            right: 0;
            left: 0;
        }
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
                    <li><a class="dropdown-item" href="index.php">Home</a></li>
                    <li><a class="dropdown-item" href="gerenciarAdministrador.php">Administradores</a></li>
                    <li><a class="dropdown-item" href="gerenciarUsuario.php">Usuários</a></li>
                    <li><a class="dropdown-item" href="gerenciarNivel.php">Níveis</a></li>
                    <li><a class="dropdown-item" href="gerenciarDicas.php">Dicas</a></li>
                    <li><a class="dropdown-item" href="gerenciarEnergia.php">Energia</a></li>
                    <li><a class="dropdown-item" href="gerenciarCompra.php">Compras</a></li>
                    <li><a class="dropdown-item" href="gerenciarTabelaPontuacao.php">Tabela de pontuação</a></li>
                    <li><a class="dropdown-item" href="gerenciarRedeSocial.php">Rede Social</a></li>
                    <li><a class="dropdown-item" href="telaLogin.php">Login</a></li>
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