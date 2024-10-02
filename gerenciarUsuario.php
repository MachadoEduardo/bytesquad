<?php include 'assets/inc/header.inc.php';
include 'assets/classes/usuarios.class.php';
$usuario = new Usuarios();
?>

<main class="container mt-5">
    <div class="header-content mb-4">
        <h1>Gerenciar Usuários</h1>
        <p>Seção dedicada à criação, edição, leitura e exclusão de usuários.</p>
    </div>

    <!-- Tabela de Usuários -->
    <div class="table-responsive mb-4">
        <table class="table table-bordered table-hover">
            <thead class="thead-light">
                <tr>
                    <!-- Criando os cabeçalhos da tabela -->
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Senha</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <!-- Adicionar mais usuários usando foreach -->
                <?php
                $lista = $usuario->listar();
                foreach ($lista as $item):
                    ?>
                    <!-- Exemplo de linha de usuário -->
                    <tr>
                        <td><?php echo $item['id'] ?></td>
                        <td><?php echo $item['nome_usuario'] ?></td>
                        <td><?php echo $item['email_usuario'] ?></td>
                        <td><?php echo $item['senha_usuario'] ?></td>
                        <td>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#editarModal<?php echo $item['id']; ?>">
                                Editar Usuário
                            </button>
                            <a href="deletarUsuario.php?id=<?php echo $item['id']; ?>"
                                class="btn btn-sm btn-danger" onclick="return confirm('Você tem certeza que deseja excluir <?php echo $item['nome_usuario']?>? ')">Excluir</a>
                        </td>
                    </tr>
                    <?php
                endforeach
                ?>
            </tbody>
        </table>

        <!-- Criando um modal dentro de um foreach, para que dessa forma, exista um modal para cada um dos usuários da tabela. Assim, ao clicar no modal automaticamente as informações do 
         usuário serão exibidas dentro do formulário -->
        <?php foreach ($lista as $item): ?>
            <!-- Modal de Edição -->
            <div class="modal fade" id="editarModal<?php echo $item['id']; ?>" tabindex="-1" role="dialog"
                aria-labelledby="editarModalLabel<?php echo $item['id']; ?>" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editarModalLabel<?php echo $item['id']; ?>">Editar Usuário</h5>
                        </div>
                        <!-- Corpo do modal, nesse caso, o formulário -->
                        <div class="modal-body">
                            <div class="card-body">
                                <!-- editarUsuarioSubmit -->
                                <form action="editarUsuarioSubmit.php" method="POST">
                                    <input type="hidden" name="id" value="<?php echo $item['id']; ?>">
                                    <div class="mb-3">
                                        <label for="nome<?php echo $item['id']; ?>" class="form-label">Nome</label>
                                        <input type="text" class="form-control" id="nome<?php echo $item['id']; ?>"
                                            name="nome" value="<?php echo $item['nome_usuario']; ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="email<?php echo $item['id']; ?>" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="email<?php echo $item['id']; ?>"
                                            name="email" value="<?php echo $item['email_usuario']; ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="senha<?php echo $item['id']; ?>" class="form-label">Senha</label>
                                        <input type="password" class="form-control" id="senha<?php echo $item['id']; ?>"
                                            name="senha" value="********" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Salvar alterações</button>
                                </form>
                            </div>
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
        Adicionar Usuário
    </button>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Adicionar Usuário</h5>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <form action="adicionarUsuarioSubmit.php" method="POST">
                            <div class="mb-3">
                                <label for="userName" class="form-label">Nome</label>
                                <input type="text" class="form-control" id="userName" name="userName" required>
                            </div>
                            <div class="mb-3">
                                <label for="userEmail" class="form-label">Email</label>
                                <input type="email" class="form-control" id="userEmail" name="userEmail" required>
                            </div>
                            <div class="mb-3">
                                <label for="userPassword" class="form-label">Senha</label>
                                <input type="password" class="form-control" id="userPassword" name="userPassword"
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