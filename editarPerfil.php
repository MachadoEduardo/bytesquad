<?php
session_start();
include 'assets/classes/usuarios.class.php';

$usuario = new Usuarios();
$dadosUsuario = $usuario->buscarUsuario($_GET['id']);

if (!$dadosUsuario) {
    echo "Usuário não encontrado.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Editar Perfil</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 font-[Poppins]">
    <div class="min-h-screen flex items-center justify-center p-6">
        <div class="bg-white shadow-lg rounded-xl p-8 w-full max-w-3xl">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Editar Perfil</h2>

            <form action="editarPerfilSubmit.php" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <input type="hidden" name="id" value="<?php echo $dadosUsuario['id']; ?>">

                <div>
                    <label class="text-gray-600">Nome</label>
                    <input type="text" name="nome_usuario" value="<?php echo $dadosUsuario['nome_usuario']; ?>" class="w-full p-2 border rounded-md" required>
                </div>

                <div>
                    <label class="text-gray-600">Email</label>
                    <input type="email" name="email_usuario" value="<?php echo $dadosUsuario['email_usuario']; ?>" class="w-full p-2 border rounded-md" required>
                </div>

                <div>
                    <label class="text-gray-600">Foto (URL)</label>
                    <input type="text" name="url_foto" value="<?php echo $dadosUsuario['url_foto']; ?>" class="w-full p-2 border rounded-md">
                </div>

                <div>
                    <label class="text-gray-600">Telefone</label>
                    <input type="text" name="telefone" value="<?php echo $dadosUsuario['telefone']; ?>" class="w-full p-2 border rounded-md">
                </div>

                <div class="col-span-1 md:col-span-2">
                    <label class="text-gray-600">Confirme sua senha atual</label>
                    <input type="password" name="senha_atual" placeholder="Digite sua senha atual para confirmar" class="w-full p-2 border rounded-md" required>
                </div>

                <div class="col-span-1 md:col-span-2">
                    <label class="text-gray-600">Nova senha (opcional)</label>
                    <input type="password" name="nova_senha" placeholder="Nova senha (ou deixe em branco)" class="w-full p-2 border rounded-md">
                </div>

                <div class="col-span-1 md:col-span-2 text-right">
                    <button type="submit" class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">
                        Salvar Alterações
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>