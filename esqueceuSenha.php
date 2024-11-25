<?php
require '../bytesquad/assets/classes/administrador.class.php';

if (!empty($_POST['usuario'])) {
    $usuario = addslashes($_POST['usuario']);
    $administrador = new Administrador();

    if ($administrador->verificarAdmin($usuario)) {
        // Se o usuario existe no banco, redireciona para definir nova senha
        header("Location: redefinirSenha.php?usuario=" . urlencode($usuario));
        exit;
    } else {
        $erro = "Usuario não encontrado.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Esqueceu a senha</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-header text-center">
                        <h1>Esqueceu sua senha</h1>
                    </div>
                    <div class="card-body">
                        <?php if (isset($erro)): ?>
                            <div class="alert alert-danger text-center">
                                <?= $erro; ?>
                            </div>
                        <?php endif; ?>
                        <?php if (isset($sucesso)): ?>
                            <div class="alert alert-success text-center">
                                <?= $sucesso; ?>
                            </div>
                        <?php endif; ?>

                        <form method="POST">
                            <div class="mb-3">
                                <label for="usuario" class="form-label">Digite seu usuario:</label>
                                <input type="text" name="usuario" id="usuario" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Verificar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>