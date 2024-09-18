<?php
require 'assets/classes/administrador.class.php';

$admin = new Administrador();

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $dados = $admin->buscarAdministrador($id); // Certifique-se de que essa função retorne os dados corretamente
} else {
    echo "ID do administrador não fornecido.";
    exit;
}
?>

<form action="editarAdministradorSubmit.php" method="POST">
    <input type="hidden" name="id_administrativo" value="<?php echo $dados['id_administrativo']; ?>">
    <div class="mb-3">
        <label for="usuario" class="form-label">Nome</label>
        <input type="text" class="form-control" id="usuario" name="usuario" value="<?php echo $dados['usuario']; ?>" required>
    </div>
    <div class="mb-3">
        <label for="senha_admin" class="form-label">Senha</label>
        <input type="password" class="form-control" id="senha_admin" name="senha_admin" value="<?php echo $dados['senha_admin']; ?>" required>
    </div>
    <div class="mb-3">
        <label for="permissoes_admin" class="form-label">Permissões</label>
        <input type="text" class="form-control" id="permissoes_admin" name="permissoes_admin" value="<?php echo $dados['permissoes_admin']; ?>" required>
    </div>
    <button type="submit" class="btn btn-primary">Salvar alterações</button>
</form>
