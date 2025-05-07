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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100 font-[Poppins]">
    <div class="min-h-screen flex items-center justify-center p-6">
        <div class="bg-white shadow-lg rounded-xl p-8 w-full max-w-3xl">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Editar Perfil</h2>
            
            <?php if (isset($_SESSION['erro'])): ?>
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6" role="alert">
                    <p><?php echo $_SESSION['erro']; ?></p>
                </div>
                <?php unset($_SESSION['erro']); ?>
            <?php endif; ?>

            <form action="editarPerfilSubmit.php" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <input type="hidden" name="id" value="<?php echo $dadosUsuario['id']; ?>">

                <div>
                    <label class="text-gray-600 block mb-2">Nome</label>
                    <input type="text" name="nome_usuario" value="<?php echo $dadosUsuario['nome_usuario']; ?>" class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-indigo-300 focus:border-indigo-500 transition" required>
                </div>

                <div>
                    <label class="text-gray-600 block mb-2">Email</label>
                    <input type="email" name="email_usuario" value="<?php echo $dadosUsuario['email_usuario']; ?>" class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-indigo-300 focus:border-indigo-500 transition" required>
                </div>

                <div class="md:col-span-2">
                    <label class="text-gray-600 block mb-3">Foto de Perfil</label>
                    <div class="flex flex-col sm:flex-row items-center gap-6">
                        <div class="relative">
                            <img id="preview-image" src="<?php echo $dadosUsuario['url_foto']; ?>" alt="Foto de perfil" class="w-32 h-32 rounded-full object-cover border-4 border-indigo-100">
                            <div class="absolute bottom-0 right-0 bg-indigo-500 text-white rounded-full w-8 h-8 flex items-center justify-center cursor-pointer hover:bg-indigo-600 transition" onclick="document.getElementById('foto').click()">
                                <i class="fas fa-camera"></i>
                            </div>
                        </div>
                        
                        <div class="flex-1 w-full">
                            <div class="relative border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-indigo-400 transition cursor-pointer" onclick="document.getElementById('foto').click()">
                                <input type="file" name="foto" id="foto" accept="image/*" class="hidden" onchange="previewImage(this)">
                                <i class="fas fa-cloud-upload-alt text-3xl text-gray-400 mb-2"></i>
                                <p class="text-gray-500">Clique para selecionar uma nova foto</p>
                                <p class="text-xs text-gray-400 mt-1">JPG, PNG ou GIF (Máx. 5MB)</p>
                            </div>
                            <input type="hidden" name="url_foto_antiga" value="<?php echo $dadosUsuario['url_foto']; ?>">
                        </div>
                    </div>
                </div>

                <div>
                    <label class="text-gray-600 block mb-2">Telefone</label>
                    <input type="text" name="telefone" value="<?php echo $dadosUsuario['telefone']; ?>" class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-indigo-300 focus:border-indigo-500 transition">
                </div>

                <div>
                    <label class="text-gray-600 block mb-2">Confirme sua senha atual</label>
                    <div class="relative">
                        <input type="password" name="senha_atual" id="senha_atual" placeholder="Digite sua senha atual para confirmar" class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-indigo-300 focus:border-indigo-500 transition pr-10" required>
                        <div class="absolute inset-y-0 right-0 flex items-center pr-3 cursor-pointer" onclick="togglePassword('senha_atual')">
                            <i class="fas fa-eye text-gray-400 hover:text-gray-600"></i>
                        </div>
                    </div>
                </div>

                <div>
                    <label class="text-gray-600 block mb-2">Nova senha (opcional)</label>
                    <div class="relative">
                        <input type="password" name="nova_senha" id="nova_senha" placeholder="Nova senha (ou deixe em branco)" class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-indigo-300 focus:border-indigo-500 transition pr-10">
                        <div class="absolute inset-y-0 right-0 flex items-center pr-3 cursor-pointer" onclick="togglePassword('nova_senha')">
                            <i class="fas fa-eye text-gray-400 hover:text-gray-600"></i>
                        </div>
                    </div>
                </div>

                <div class="col-span-1 md:col-span-2 flex justify-between mt-6">
                    <a href="perfil.php?id=<?php echo $dadosUsuario['id']; ?>" class="px-6 py-3 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">
                        Cancelar
                    </a>
                    <button type="submit" class="px-8 py-3 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition flex items-center gap-2">
                        <i class="fas fa-save"></i>
                        Salvar Alterações
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal de carregamento -->
    <div id="loading-modal" class="fixed inset-0 flex items-center justify-center z-50 hidden bg-black bg-opacity-50">
        <div class="bg-white p-5 rounded-lg shadow-lg text-center">
            <div class="animate-spin rounded-full h-12 w-12 border-t-2 border-b-2 border-indigo-500 mx-auto"></div>
            <p class="mt-3 text-gray-700">Salvando alterações...</p>
        </div>
    </div>

    <script>
        // Pré-visualização da imagem
        function previewImage(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                
                reader.onload = function(e) {
                    document.getElementById('preview-image').src = e.target.result;
                }
                
                reader.readAsDataURL(input.files[0]);
            }
        }
        
        // Alternar visibilidade da senha
        function togglePassword(fieldId) {
            const field = document.getElementById(fieldId);
            const icon = field.nextElementSibling.querySelector('i');
            
            if (field.type === 'password') {
                field.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                field.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }
        
        // Mostrar modal de carregamento ao enviar o formulário
        document.querySelector('form').addEventListener('submit', function() {
            document.getElementById('loading-modal').classList.remove('hidden');
        });
    </script>
</body>

</html>