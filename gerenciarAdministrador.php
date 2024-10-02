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
                    <th>Usuario</th>
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
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#editarModal<?php echo $item['id_administrativo']; ?>">
                                Editar Administrador
                            </button>
                            <a href="deletarAdministrador.php?id=<?php echo $item['id_administrativo']; ?>"
                                class="btn btn-sm btn-danger"
                                onclick="return confirm('Você tem certeza que deseja excluir <?php echo $item['usuario'] ?>? ')">Excluir</a>
                        </td>
                    </tr>
                    <?php
                endforeach
                ?>
            </tbody>
        </table>

        <!-- Criando um modal dentro de um foreach, para que dessa forma, exista um modal para cada um dos administradores da tabela. Assim, ao clicar no modal automaticamente
        as informações do usuário serão exibidas dentro do formulário -->
        <?php foreach ($lista as $item): ?>
            <!-- Modal de Edição -->
            <div class="modal fade" id="editarModal<?php echo $item['id_administrativo']; ?>" tabindex="-1" role="dialog"
                aria-labelledby="editarModalLabel<?php echo $item['id_administrativo']; ?>" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editarModalLabel<?php echo $item['id_administrativo']; ?>">Editar
                                Administrador</h5>
                        </div>
                        <!-- Corpo do modal, nesse caso, o formulário -->
                        <div class="modal-body">
                            <form action="editarAdministradorSubmit.php" method="POST">
                                <input type="hidden" name="id_administrativo"
                                    value="<?php echo $item['id_administrativo']; ?>">
                                <div class="mb-3">
                                    <label for="usuario" class="form-label">Usuario</label>
                                    <input type="text" class="form-control" id="usuario" name="usuario"
                                        value="<?php echo $item['usuario']; ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="senha_admin" class="form-label">Senha</label>
                                    <input type="password" class="form-control" id="senha_admin" name="senha_admin"
                                        value="<?php echo '**********'; ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="permissoes_admin" class="form-label">Permissões</label>
                                    <input type="text" class="form-control" id="permissoes_admin" name="permissoes_admin"
                                        value="<?php echo $item['permissoes_admin']; ?>" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Salvar alterações</button>
                            </form>
                        </div>
                        <!-- Footer do modal, nesse caso, o botão de fechar -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Adicionar Administrador
    </button>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Adicionar Administrador</h5>
                </div>

                <div class="modal-body">
                    <!-- Formulário para Adicionar/Editar Usuário -->
                    <div class="card-body">
                        <form action="adicionarAdministradorSubmit.php" method="POST">
                            <div class="mb-3">
                                <label for="usuario" class="form-label">Usuario</label>
                                <input type="text" class="form-control" id="usuario" name="usuario" required>
                            </div>
                            <div class="mb-3">
                                <label for="senha_admin" class="form-label">Senha</label>
                                <input type="password" class="form-control" id="senha_admin" name="senha_admin"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label for="permissoes_admin" class="form-label">Permissões</label>
                                <input type="text" class="form-control" id="permissoes_admin" name="permissoes_admin"
                                    required>
                            </div>
                            <input type="submit" class="btn btn-success" name="btCadastrar" value="Salvar" />
                            <button type="reset" class="btn btn-secondary">Limpar</button>
                        </form>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>
</main>

<?php include 'assets/inc/footer.inc.php'; ?>

<!-- Inclua os scripts necessários para o Bootstrap 5.x -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>