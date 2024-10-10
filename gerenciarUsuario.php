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
    <div class="table-responsive mb-5">
        <table class="table table-bordered table-hover">
            <thead class="thead-light">
                <tr>
                    <!-- Criando os cabeçalhos da tabela -->
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Senha</th>
                    <th>Permissões</th>
                    <th>Ativo</th>
                    <th>Foto</th>
                    <th>Telefone</th>
                    <th>Rede Social</th>
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
                        <td><?php echo $item['permissoes_usuario'] ?></td>
                        <td><?php echo $item['ativo_usuario'] ?></td>
                        <td><?php echo $item['url_foto'] ?></td>
                        <td><?php echo $item['telefone'] ?></td>
                        <td><?php echo $item['id_redesocial'] ?></td>
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

        <!-- Criando um modal (de edição) dentro de um foreach, para que dessa forma, exista um modal para cada um dos usuários da tabela. Assim, ao clicar no modal automaticamente 
        as informações do usuário serão exibidas dentro do formulário -->
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
                                    <div class="mb-3">
                                        <label for="permissoes_usuario<?php echo $item['permissoes_usuario']; ?>" class="form-label">Permissões</label>
                                        <input type="permissoes_usuario" class="form-control" id="permissoes_usuario<?php echo $item['id']; ?>"
                                            name="permissoes_usuario" value="<?php echo $item['permissoes_usuario']; ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="ativo_usuario<?php echo $item['ativo_usuario']; ?>" class="form-label">Ativo</label>
                                        <input type="ativo_usuario" class="form-control" id="ativo_usuario<?php echo $item['id']; ?>"
                                            name="ativo_usuario" value="<?php echo $item['ativo_usuario']; ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="url_foto<?php echo $item['url_foto']; ?>" class="form-label">Foto</label>
                                        <input type="url_foto" class="form-control" id="url_foto<?php echo $item['id']; ?>"
                                            name="url_foto" value="<?php echo $item['url_foto']; ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="telefone<?php echo $item['telefone']; ?>" class="form-label">Telefone</label>
                                        <input type="telefone" class="form-control" id="telefone<?php echo $item['id']; ?>"
                                            name="telefone" value="<?php echo $item['telefone']; ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="id_redesocial<?php echo $item['id_redesocial']; ?>">Rede Social</label>
                                        <select name="id_redesocial" id="id_redesocial" class="form-control" type="text">
                                            <?php
                                            $lista = $usuario->listarRedeSocial();
                                            foreach ($lista as $item):
                                                ?>
                                                <option value="<?php echo $item['id_redesocial']; ?>"><?php echo $item['id_redesocial']; ?>
                                                </option>
                                                <?php
                                            endforeach;
                                            ?>

                                        </select>

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
                            <div class="mb-3">
                                <label for="permissoes_usuario" class="form-label">Permissões</label>
                                <input type="text" class="form-control" id="permissoes_usuario" name="permissoes_usuario" required>
                            </div>
                            <div class="mb-3">
                                <label for="ativo_usuario" class="form-label">Ativo</label>
                                <input type="text" class="form-control" id="ativo_usuario" name="ativo_usuario" required>
                            </div>
                            <div class="mb-3">
                                <label for="url_foto" class="form-label">Foto</label>
                                <input type="text" class="form-control" id="url_foto" name="url_foto" required>
                            </div>
                            <div class="mb-3">
                                <label for="telefone" class="form-label">Telefone</label>
                                <input type="tel" class="form-control" id="telefone" name="telefone" required>
                            </div>
                            <div class="form-group">
                                <label for="id_redesocial">Rede Social:</label>
                                <select name="id_redesocial" id="id_redesocial" class="form-control" type="text">
                                    <?php
                                    $lista = $usuario->listarRedeSocial();
                                    foreach ($lista as $item):
                                        ?>
                                        <option value="<?php echo $item['id_redesocial']; ?>"><?php echo $item['id_redesocial']; ?>
                                        </option>
                                        <?php
                                    endforeach;
                                    ?>

                                </select>
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