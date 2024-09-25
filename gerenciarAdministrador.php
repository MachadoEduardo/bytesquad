<?php include 'assets/inc/header.inc.php';
include 'assets/classes/administrador.class.php';
$admin = new Administrador();
?>

<main class="container mt-5">
    <div class="header-content mb-4">
        <h1>Gerenciar Administradores</h1>
        <p>Seção dedicada à criação, edição, leitura e exclusão de Administradores.</p>
    </div>

    <!-- Tabela de Usuários -->
    <div class="table-responsive mb-4">
        <table class="table table-bordered table-hover">
            <thead class="thead-light">
                <tr>
                    <!-- Criando os cabeçalhos da tabela -->
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Senha</th>
                    <th>Permissões</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <!-- Adicionar mais usuários usando foreach -->
                <?php
                $lista = $admin->listar();
                foreach ($lista as $item):
                    ?>
                    <!-- Exemplo de linha de usuário -->
                    <tr>
                        <td><?php echo $item['id_administrativo'] ?></td>
                        <td><?php echo $item['usuario'] ?></td>
                        <td><?php echo $item['senha_admin'] ?></td>
                        <td><?php echo $item['permissoes_admin'] ?></td>
                        <td>
                            <a href="editarAdministrador.php?id=<?php echo $item['id_administrativo']; ?>"
                                class="btn btn-sm btn-primary">Editar</a>
                            <a href="deletarAdministrador.php?id=<?php echo $item['id_administrativo']; ?>"
                                class="btn btn-sm btn-danger">Excluir</a>
                        </td>
                    </tr>
                    <?php
                endforeach
                ?>
            </tbody>
        </table>
    </div>

    <!-- Formulário para Adicionar/Editar Usuário -->
    <div class="card-body">
        <form action="adicionarAdministradorSubmit.php" method="POST">
            <div class="mb-3">
                <label for="usuario" class="form-label">Nome</label>
                <input type="text" class="form-control" id="usuario" name="usuario" required>
            </div>
            <div class="mb-3">
                <label for="senha_admin" class="form-label">Senha</label>
                <input type="password" class="form-control" id="senha_admin" name="senha_admin" required>
            </div>
            <div class="mb-3">
                <label for="permissoes_admin" class="form-label">Permissões</label>
                <input type="text" class="form-control" id="permissoes_admin" name="permissoes_admin" required>
            </div>
            <input type="submit" class="btn btn-success" name="btCadastrar" value="Salvar" />
            <button type="reset" class="btn btn-secondary">Limpar</button>
        </form>
    </div>
</main>

<?php include 'assets/inc/footer.inc.php'; ?>

<!-- Inclua os scripts necessários para o Bootstrap 5.x -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>