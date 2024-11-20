<?php 
session_start();
include 'assets/inc/header.inc.php';
include 'assets/classes/energia.class.php';
$energia = new Energia();
require_once './assets/classes/administrador.class.php';
$admin = new Administrador();

// On protected admin pages
if (!isset($_SESSION['Logado'])) {
    header("Location: login.php");
    exit;
}
?>

<main class="container mt-5">
    <div class="header-content mb-4">
        <h1>Gerenciar Pacotes de Energia</h1>
        <p>Secção dedicada à criação, edição, leitura e exclusão de pacotes de energia.</p>
    </div>

    <!-- Tabela de pacotes -->
    <div class="table-responsive mb-4">
        <table class="table table-bordered table-hover">
            <thead class="thead-light">
                <tr>
                    <!-- Criando os cabeçalhos da tabela -->
                    <th>ID</th>
                    <th>Usuário</th>
                    <th>Quantidade</th>
                    <th>Tempo</th>
                    <th>Preço</th>
                    <th>Pacote</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <!-- Adicionar mais pacotes usando foreach -->
                <?php
                $lista = $energia->listar();
                foreach ($lista as $item):
                    ?>
                    <!-- Exemplo de linha de pacotes -->
                    <tr>
                        <td><?php echo $item['id_energia'] ?></td>
                        <td><?php echo $item['id'] ?></td>
                        <td><?php echo $item['quantidade_energia'] ?></td>
                        <td><?php echo $item['tempo_energia'] ?></td>
                        <td><?php echo $item['preco_energia'] ?></td>
                        <td><?php echo $item['pacote_energia'] ?></td>
                        <td>
                        <?php if ($admin->temPermissoes('EDIT')): ?>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#editarModal<?php echo $item['id_energia']; ?>">
                                Editar Pacote
                            </button>
                        <?php endif; ?>
                        <?php if ($admin->temPermissoes('DELETE')): ?>
                            <a href="deletarEnergia.php?id_energia=<?php echo $item['id_energia']; ?>"
                                class="btn btn-sm btn-danger"
                                onclick="return confirm('Você tem certeza que deseja excluir o Pacote <?php echo $item['id_energia'] ?>? ')">Excluir</a>
                        <?php endif; ?>
                        </td>
                    </tr>
                    <?php
                endforeach
                ?>
            </tbody>
        </table>

        <!-- Criando um modal (de edição) dentro de um foreach, para que dessa forma, exista um modal para cada um dos pacotes da tabela. Assim, ao clicar no modal automaticamente 
        as informações do niveis serão exibidas dentro do formulário -->
        <?php foreach ($lista as $item): ?>
            <!-- Modal de Edição -->
            <div class="modal fade" id="editarModal<?php echo $item['id_energia']; ?>" tabindex="-1" role="dialog"
                aria-labelledby="editarModalLabel<?php echo $item['id_energia']; ?>" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editarModalLabel<?php echo $item['id_energia']; ?>">Editar Pacote
                            </h5>
                        </div>
                        <!-- Corpo do modal, nesse caso, o formulário -->
                        <div class="modal-body">
                            <div class="card-body">
                                <!-- editarEnergiaSubmit -->
                                <form action="editarEnergiaSubmit.php" method="POST">
                                    <input type="hidden" name="id_energia" value="<?php echo $item['id_energia']; ?>">
                                    <div class="mb-3">
                                        <label for="quantidade_energia<?php echo $item['id_energia']; ?>"
                                            class="form-label">Quantidade</label>
                                        <input type="text" class="form-control"
                                            id="quantidade_energia<?php echo $item['id_energia']; ?>"
                                            name="quantidade_energia" value="<?php echo $item['quantidade_energia']; ?>"
                                            required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="tempo_energia<?php echo $item['tempo_energia']; ?>"
                                            class="form-label">Tempo</label>
                                        <input type="text" class="form-control"
                                            id="tempo_energia<?php echo $item['id_energia']; ?>" name="tempo_energia"
                                            value="<?php echo $item['tempo_energia']; ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="preco_energia<?php echo $item['preco_energia']; ?>"
                                            class="form-label">Preço</label>
                                        <input type="text" class="form-control"
                                            id="preco_energia<?php echo $item['preco_energia']; ?>" name="preco_energia"
                                            value="<?php echo $item['preco_energia']; ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="pacote_energia<?php echo $item['pacote_energia']; ?>"
                                            class="form-label">Pacote</label>
                                        <input type="text" class="form-control"
                                            id="pacote_energia<?php echo $item['pacote_energia']; ?>" name="pacote_energia"
                                            value="<?php echo $item['pacote_energia']; ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="id<?php echo $item['id']; ?>">Usuário:</label>
                                        <select name="id" id="id" class="form-control" type="text">
                                            <?php
                                            $lista = $energia->listarUsuario();
                                            foreach ($lista as $item):
                                                ?>
                                                <option value="<?php echo $item['id']; ?>"><?php echo $item['id']; ?> -
                                                    <?php echo $item['nome_usuario']; ?>
                                                </option>
                                                <?php
                                            endforeach;
                                            ?>

                                        </select>

                                    </div>

                                    <button type="submit" class="btn btn-primary mt-4">Salvar alterações</button>
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

    <?php if ($admin->temPermissoes('ADD')): ?>
    <!-- Button trigger modal (botão o qual vai acionar o modal) -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Adicionar Pacote
    </button>
    <?php endif; ?>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Adicionar Pacote</h5>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <form action="adicionarEnergiaSubmit.php" method="POST">
                            <div class="form-group">
                                <label for="id">Usuário:</label>
                                <select name="id" id="id" class="form-control" type="text">
                                    <?php
                                    $lista = $energia->listarUsuario();
                                    foreach ($lista as $item):
                                        ?>
                                        <option value="<?php echo $item['id']; ?>"><?php echo $item['id']; ?> -
                                            <?php echo $item['nome_usuario']; ?>
                                        </option>
                                        <?php
                                    endforeach;
                                    ?>

                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="quantidade_energia" class="form-label">Quantidade</label>
                                <input type="text" class="form-control" id="quantidade_energia"
                                    name="quantidade_energia" required>
                            </div>
                            <div class="mb-3">
                                <label for="tempo_energia" class="form-label">Tempo</label>
                                <input type="text" class="form-control" id="tempo_energia" name="tempo_energia"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label for="preco_energia" class="form-label">Preço</label>
                                <input type="text" class="form-control" id="preco_energia" name="preco_energia"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label for="pacote_energia" class="form-label">Pacote</label>
                                <input type="text" class="form-control" id="pacote_energia" name="pacote_energia"
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