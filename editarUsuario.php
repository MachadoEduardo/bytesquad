<?php
require 'assets/classes/usuarios.class.php';

$usuario = new Usuarios();

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $dados = $usuario->buscarUsuario($id); // Pega os dados do usuário pelo ID
}
?>

<form action="editarUsuarioSubmit.php" method="POST">
    <input type="hidden" name="id" value="<?php echo $dados['id']; ?>">
    <div class="mb-3">
        <label for="nome" class="form-label">Nome</label>
        <input type="text" class="form-control" id="nome" name="nome" value="<?php echo $dados['nome_usuario']; ?>" required>
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email" value="<?php echo $dados['email_usuario']; ?>" required>
    </div>
    <div class="mb-3">
        <label for="senha" class="form-label">Senha</label>
        <input type="password" class="form-control" id="senha" name="senha" required>
    </div>
    <button type="submit" class="btn btn-primary">Salvar alterações</button>
</form>
